<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ApiUserController extends Controller
{
    public function index(Request $request)
    {

        $user = $request->user();
        $companies = $user->companies;
        // dd($user->id, $companies);
        $selectedCompanies = $companies->map(function ($company) {
            return $company->only(['id', 'name']);
        });

        return response()->json([
            'user' => $user->only(['role_id', 'name', 'email', 'image']),
            'companies' =>  $selectedCompanies,
            'test' => $user,
            'companiestest' => $companies,
        ]);
    }
}
