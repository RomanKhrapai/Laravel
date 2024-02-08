<?php

namespace App\Jobs;

use App\Events\SendPdf;
use App\Events\SendPdfError;
use App\Models\Company;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;

class GeneratePDFReport implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;



    public $userId;
    public $baseURL;
    /**
     * Create a new job instance.
     */
    public function __construct($userId, $baseURL)
    {

        $this->userId = $userId;
        $this->baseURL = $baseURL;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {



        $currentDate = Carbon::now();
        $previousDate = Carbon::now()->subMonth();

        $companies = Company::withAvg('receivedReviews', 'vote')
            ->withCount('receivedReviews')
            ->with('receivedReviews')
            ->where('user_id', $this->userId)
            ->whereHas('receivedReviews', function ($query) use ($previousDate, $currentDate) {
                $query->whereBetween('created_at', [$previousDate, $currentDate]);
            })
            ->get();

        $data = [
            'title' => 'Report Rating and reviews for the last month',
            'date' => $currentDate,
            "previousDate" =>  $previousDate,
            'companies' => $companies,
        ];

        $filePath = 'public/pdf/';
        $fileName = 'reviews-' . $this->userId . '.pdf';

        $pdf = Pdf::loadView('PDF.reviews', $data);
        $file = Storage::put($filePath . $fileName, $pdf->output());


        if ($file) {
            $fullFileDir = Storage::path($filePath);
            chmod($fullFileDir, 0777);

            $fullFilePath = Storage::path($filePath . $fileName);
            chmod($fullFilePath, 0777);

            $fileUrl    = Storage::url($filePath . $fileName);
            $fullFileUrl  = $this->baseURL . $fileUrl;

            broadcast(new SendPdf($fullFileUrl, $this->userId));
            return;
        }
        broadcast(new SendPdfError("Error generate file", $this->userId));
    }
}
