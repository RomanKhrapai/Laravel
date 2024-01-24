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
}
