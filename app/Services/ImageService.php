<?php

namespace App\Services;

use App\Models\Vacancy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Profession;
use App\Models\Area;
use App\Models\Skill;
use FFI\Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;

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
}
