<?php

namespace App\Http\Controllers\Api\Review;

use App\Http\Controllers\Api\Review\BaseController;

use App\Http\Requests\Review\UpdateRequest;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;

class UpdateController extends BaseController
{
    public function __invoke(UpdateRequest $request, Review $review)
    {
        $data = $request->validated();

        if (Auth::user()->id !== $review->user_id) {
            return response()->json(['error' => 'You are not authorized to perform this operation'], 403);
        }
        $review->update($data);
        return  response()->json('successful');
    }
}
