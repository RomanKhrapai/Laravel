<?php

namespace App\Http\Controllers\Api\Review;

use App\Http\Controllers\Api\Review\BaseController;
use App\Http\Requests\Review\StoreRequest;
use App\Http\Resources\ReviewResource;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class StoreController extends BaseController
{

    public function __invoke(StoreRequest $request)
    {
        $data = $request->validated();

        $review = $this->service->store($data);

        return $review instanceof Review ? new ReviewResource($review) : $review;
    }
}
