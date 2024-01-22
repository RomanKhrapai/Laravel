<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;

class ApiCompanyController extends Controller
{
    public function searchCompanies(Request $request)
    {
        $limit = $request->query('limit', 20);
        $name = $request->query('name');

        return Company::query()
            ->byName($name)
            ->take($limit)
            ->get(['id', 'name'])
            ->toArray();
    }
}
