<?php

namespace App\Jobs;

use App\Events\SendPdf;
use App\Events\SendPdfError;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Services\PdfGenerationService;


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
        $pdfService = new PdfGenerationService();
        $dateFile = $pdfService->SavePdf($this->userId, $this->baseURL);

        if (empty($dateFile['error']) && isset($dateFile['file'])) {
            broadcast(new SendPdf($dateFile['file'], $this->userId));
            return;
        }

        broadcast(new SendPdfError("Error generate file", $this->userId));
    }
}
