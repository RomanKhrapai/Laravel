<?php

namespace App\Http\Controllers\Api\Vacancy;

use App\Http\Controllers\Api\Vacancy\BaseController;
use App\Http\Requests\Vacancy\StoreRequest;
use App\Http\Resources\VacancyResource;
use App\Models\Vacancy;

class StoreController extends BaseController
{

    public function __invoke(StoreRequest $request)
    {
        $data = $request->validated();

        $vacancy = $this->service->store($data);

        return $vacancy instanceof Vacancy ? new VacancyResource($vacancy) : $vacancy;
    }
}
