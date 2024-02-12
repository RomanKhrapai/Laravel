<?php

namespace App\Http\Controllers\Api\Vacancy;

use App\Http\Controllers\Api\Vacancy\BaseController;
use App\Http\Requests\Vacancy\UpdateRequest;
use App\Http\Resources\VacancyResource;
use App\Models\Vacancy;
use Illuminate\Support\Facades\Auth;

class UpdateController extends BaseController
{
    public function __invoke(UpdateRequest $request, Vacancy $vacancy)
    {
        if ($vacancy->company->user_id !== Auth::user()->id) {
            return response()->json(['error' => 'Unauthenticated.'], 401);
        }

        $data = $request->validated();
        $vacancy = $this->service->update($vacancy, $data);

        return $vacancy instanceof Vacancy ? new VacancyResource($vacancy) : $vacancy;
    }
}
