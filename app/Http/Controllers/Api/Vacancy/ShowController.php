<?php

namespace App\Http\Controllers\Api\Vacancy;

use App\Http\Controllers\Api\Vacancy\BaseController;
use App\Models\Vacancy;
use App\Http\Resources\VacancyResource;

class ShowController extends BaseController
{
    public function __invoke(Vacancy $vacancy)
    {
        return new VacancyResource($vacancy);
    }
    // (Request $request)
    // {
    //     $limit = $request->query('limit', 20);
    //     $name = $request->query('name');

    //     $areas = Area::query()
    //         ->byName($name)
    //         ->take($limit)
    //         ->get(['id', 'name'])
    //         ->toArray();

    //     return response()->json($areas);
    // }
}
