<?php

namespace App\Http\Controllers\Api\Vacancy;

use App\Http\Controllers\Api\Vacancy\BaseController;
use App\Models\Vacancy;
use Illuminate\Support\Facades\Auth;

class DeleteController extends BaseController
{
    public function __invoke(Vacancy $vacancy)
    {

        $user_id = Auth::user()->id;
        if ($user_id === $vacancy->company->user_id) {
            $vacancy->delete();
            return  response()->json('successful');
        }
        return response()->json(['error' => 'You are not authorized to perform this operation'], 403);
    }
}
