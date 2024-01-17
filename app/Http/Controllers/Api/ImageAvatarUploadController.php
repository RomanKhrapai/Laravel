<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ImageAvatarUploadRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ImageAvatarUploadController extends Controller
{
    public function upload(ImageAvatarUploadRequest $request)
    {
        $token = $request->header('X-CSRF-TOKEN');
        if (!$token || $token !== csrf_token()) {
            abort(404);
        }
        if (Auth::check()) {
            $userId = Auth::id();
            $file = $request->file('file');

            $fileName =  $userId . '.jpg';

            $file->move(storage_path('app/public/temp'), $fileName);
            return response()->json([
                'message' => 'successful',
                'url' => 'temp/' . $fileName,
                'id' => $userId
            ]);
        }
        return response()->json(['message' => "no auth"]);
    }
}
