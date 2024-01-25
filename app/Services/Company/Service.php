<?php

namespace App\Services\Company;

use App\Models\Company;
use Illuminate\Support\Facades\DB;
use FFI\Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class Service
{

    public function store($data)
    {
        try {
            DB::beginTransaction();
            $data['user_id'] = Auth::user()->id;

            if (isset($data['image'])) {
                $imageUrl = $data['image'];
                if ($imageUrl && !File::exists(storage_path('app/public/' . $imageUrl))) {
                    throw ValidationException::withMessages([
                        'image' => 'Problem file.',
                    ]);
                } elseif ($imageUrl) {
                    $uniqueName = Str::uuid()->toString();
                    $extension = pathinfo($imageUrl, PATHINFO_EXTENSION);
                    $newPath = 'images/companies/avatars/' . $uniqueName . '.' . $extension;
                    Storage::disk('public')->move($imageUrl, $newPath);
                    $data['image'] = $newPath;
                }
            }

            $company = Company::create($data);
            DB::commit();
        } catch (Exception $exception) {
            DB::rollBack();
            return $exception->getMessage();
        }
        return $company;
    }

    public function update()
    {
    }
}
