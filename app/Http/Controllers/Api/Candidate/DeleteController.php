<?php

namespace App\Http\Controllers\Api\Candidate;

use App\Http\Controllers\Api\Candidate\BaseController;
use App\Models\Candidate;
use Illuminate\Support\Facades\Auth;

class DeleteController extends BaseController
{
    public function __invoke(Candidate $candidate)
    {
        $user_id = Auth::user()->id;
        if ($user_id === $candidate->user_id) {
            $candidate->delete();
            return  response()->json('successful');
        }
        return response()->json(['error' => 'You are not authorized to perform this operation'], 403);
    }
}
