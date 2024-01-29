<?php

namespace App\Services\Review;

use App\Models\Review;
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

            $review = Review::create($data);
            DB::commit();
        } catch (Exception $exception) {
            DB::rollBack();
            return $exception->getMessage();
        }
        return $review;
    }

    public function update()
    {
    }
}
