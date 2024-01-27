<?php

namespace App\Http\Controllers\Api\Candidate;

use App\Http\Controllers\Api\Candidate\BaseController;
use App\Models\Candidate;
use Illuminate\Support\Facades\Auth;

class DeleteController extends BaseController
{
    public function __invoke(Candidate $vacancy)
    {
        $user_id = Auth::user()->id;
        if ($user_id === $vacancy->company->user_id) {
            $vacancy->delete();
            return  response()->json('successful');
        }
        return response()->json(['error' => 'You are not authorized to perform this operation'], 403);
    }
}
