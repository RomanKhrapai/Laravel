<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ImageAvatarUploadRequest;
use App\Services\ImageService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ImageAvatarUploadController extends Controller
{

    public $service;

    public function __construct(ImageService $service)
    {
        $this->service = $service;
    }

    public function upload(ImageAvatarUploadRequest $request)
    {
        $file = $request->file('file');

        $data = $this->service->StoreTempImage($file);

        return response()->json($data);
    }
}
