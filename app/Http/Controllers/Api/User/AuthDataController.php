<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthDataController extends Controller
{
    public function __invoke(Request $request)
    {
        $user = $request->user();


        $companies =  $user->companies;
        $selectedCompanies = $companies->map(function ($company) {
            $vacancies = $company->vacancies->map(function ($vacancy) {
                return $vacancy->only(['id', 'title']);
            });
            return [
                'id' => $company->id,
                'name' => $company->name,
                'vacancies' => $vacancies
            ];
        });
        $candidates =  $user->candidates;
        $selectedCandidates = $candidates->map(function ($candidate) {
            return $candidate->only(['id', 'title']);
        });


        return response()->json([
            'companies' =>  $selectedCompanies,
            'candidates' =>  $selectedCandidates,
        ]);
    }
}
