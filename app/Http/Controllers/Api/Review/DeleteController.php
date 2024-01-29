<?php

namespace App\Http\Controllers\Api\Review;

use App\Http\Controllers\Api\Review\BaseController;
use App\Models\Review;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DeleteController extends BaseController
{
    public function __invoke(Review $review)
    {
        if (Auth::user()->id === $review->user_id) {
            $review->delete();
            return  response()->json('successful');
        }
        return response()->json(['error' => 'You are not authorized to perform this operation'], 403);
    }
}
