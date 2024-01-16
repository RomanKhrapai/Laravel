<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ImageAvatarUploadRequest;

class ImageAvatarUploadController extends Controller
{
    public function upload(ImageAvatarUploadRequest $request)
    {

        $file = $request->file('file');
        $fileName = time() . '_' . $file->getClientOriginalName();

        $file->move(storage_path('app/public/temp'), $fileName);
        // dd($file, storage_path('app/public/temp'), $fileName);
        return response()->json(['message' => 'Файл успішно завантажено.', 'url' => $fileName]);
    }
}
