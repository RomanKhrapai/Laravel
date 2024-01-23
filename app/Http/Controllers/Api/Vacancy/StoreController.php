<?php

namespace App\Http\Controllers\Api\Vacancy;

use App\Http\Controllers\Api\Vacancy\BaseController;
use App\Http\Requests\Vacancy\StoreApiVacancyRequest;
use App\Http\Resources\VacancyResource;
use App\Models\Vacancy;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class StoreController extends BaseController
{

    public function __invoke(StoreApiVacancyRequest $request)
    {
        $data = $request->validated();

        $vacancy = $this->service->store($data);

        return $vacancy instanceof Vacancy ? new VacancyResource($vacancy) : $vacancy;
    }
}
