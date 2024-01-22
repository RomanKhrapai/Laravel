<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Profession;
use Illuminate\Http\Request;

class ApiProfessionController extends Controller
{
    public function search(Request $request)
    {
        $limit = $request->query('limit', 20);
        $name = $request->query('name');

        $professions = Profession::query()
            ->byName($name)
            ->take($limit)
            ->get(['id', 'name'])
            ->toArray();

        return response()->json($professions);
    }
}
