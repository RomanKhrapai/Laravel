<?php

namespace App\Http\Controllers\Api\Files;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Files\UploadImageRequest;
use App\Services\ImageService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UploadImageController extends Controller
{

    public $service;

    public function __construct(ImageService $service)
    {
        $this->service = $service;
    }

    public function upload(UploadImageRequest $request)
    {
        $file = $request->file('file');

        $data = $this->service->StoreTempImage($file);

        return response()->json($data);
    }
}
