<?php

namespace App\Http\Controllers\Api\Company;

use App\Http\Controllers\Api\Company\BaseController;
use App\Models\Company;
use Illuminate\Support\Facades\Auth;

class DeleteController extends BaseController
{
    public function __invoke(Company $company)
    {
        $user_id = Auth::user()->id;
        if ($user_id === $company->user_id) {
            $company->delete();
            return  response()->json('successful');
        }
        return response()->json(['error' => 'You are not authorized to perform this operation'], 403);
    }
}
