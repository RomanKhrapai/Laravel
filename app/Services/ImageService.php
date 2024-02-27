<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ImageService
{

    public function StoreTempImage($file)
    {
        $userId = Auth::id();
        $fileName =  $userId . '.jpg';

        $file->move(storage_path('app/public/temp'), $fileName);

        $url = 'temp/' . $fileName;

        return [
            'message' => 'successful',
            'url' => $url,
            'fullUrl' => URL::asset(Storage::url($url)),
            'id' => $userId
        ];
    }

    public function saveImageUser(User $user, $data,)
    {
        try {

            $imageUrl = $data['image'];

            if ($imageUrl && !File::exists(storage_path('app/public/' . $imageUrl))) {
                throw ValidationException::withMessages([
                    'image' => 'Problem file.',
                ]);
            } elseif ($imageUrl && $imageUrl !== $user->image) {
                $uniqueName = Str::uuid()->toString();
                $extension = pathinfo($imageUrl, PATHINFO_EXTENSION);
                $newPath = 'images/users/avatars/' . $uniqueName . '.' . $extension;
                Storage::disk('public')->move($imageUrl, $newPath);
                $data['image'] = $newPath;

                $newUrl = str_replace("/storage/", "", $user->image);
                if (isset($user->image) && Storage::exists('public/' . $newUrl)) {
                    Storage::delete('public/' .  $newUrl);
                }
            } else {
                $data['image'] = $imageUrl;

                $newUrl = str_replace("/storage/", "", $user->image);
                if (!$imageUrl && isset($user->image) && Storage::exists('public/' . $newUrl)) {
                    Storage::delete('public/' . $newUrl);
                }
            }
        } catch (ValidationException $validator) {
            return  ['errors' => $validator->errors()];
        }
        return $data;
    }

    public function saveNewImageUser($data)
    {
        try {

            $imageUrl = $data['image'];

            if ($imageUrl && !File::exists(storage_path('app/public/' . $imageUrl))) {
                throw ValidationException::withMessages([
                    'image' => 'Problem file.',
                ]);
            } elseif ($imageUrl) {
                $uniqueName = Str::uuid()->toString();
                $extension = pathinfo($imageUrl, PATHINFO_EXTENSION);
                $newPath = 'images/users/avatars/' . $uniqueName . '.' . $extension;
                Storage::disk('public')->move($imageUrl, $newPath);
                $data['image'] = $newPath;
            }
        } catch (ValidationException $validator) {
            return  ['errors' => $validator->errors()];
        }
        return $data;
    }
}
