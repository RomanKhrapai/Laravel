<?php

namespace App\Services;

use App\Models\Company;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;



class PdfGenerationService
{

    public function SavePdf($userId, $baseURL)
    {
        try {
            $currentDate = Carbon::now();
            $previousDate = Carbon::now()->subMonth();

            $companies = $this->getCompaniesWithReviews($previousDate, $currentDate, $userId);

            $data = [
                'title' => 'Report Rating and reviews for the last month',
                'date' => $currentDate,
                'previousDate' => $previousDate,
                'companies' => $companies,
            ];

            $filePath = 'public/pdf/';
            $fileName = 'reviews-' . $userId . '.pdf';

            $pdf = Pdf::loadView('PDF.reviews', $data);
            $file = Storage::put($filePath . $fileName, $pdf->output());

            $fullFileDir = Storage::path($filePath);
            chmod($fullFileDir, 0777);

            $fullFilePath = Storage::path($filePath . $fileName);
            chmod($fullFilePath, 0777);

            $fileUrl = Storage::url($filePath . $fileName);
            $fullFileUrl = $baseURL . $fileUrl;

            return ['file' => $fullFileUrl, 'message' => 'success', 'error' => false];
        } catch (\Throwable $th) {
            return ['file' => null, 'message' => 'error', 'error' => true];
        }
    }

    protected function getCompaniesWithReviews($previousDate, $currentDate, $userId)
    {
        return Company::withAvg(['receivedReviews' => function ($query) use ($previousDate, $currentDate) {
            $query->whereBetween('created_at', [$previousDate, $currentDate]);
        }], 'vote')
            ->withCount(['receivedReviews' => function ($query) use ($previousDate, $currentDate) {
                $query->whereBetween('created_at', [$previousDate, $currentDate]);
            }])
            ->with(['receivedReviews' => function ($query) use ($previousDate, $currentDate) {
                $query->whereBetween('created_at', [$previousDate, $currentDate]);
            }])
            ->where('user_id', $userId)
            ->whereHas('receivedReviews', function ($query) use ($previousDate, $currentDate) {
                $query->whereBetween('created_at', [$previousDate, $currentDate]);
            })
            ->get();
    }
}
