<?php

namespace App\Http\Controllers\Api\Vacancy;

use App\Http\Controllers\Api\Vacancy\BaseController;
use App\Http\Filters\CandidateFilter;
use App\Http\Requests\Vacancy\FilterRequest;
use App\Http\Resources\CandidateResource;

use App\Models\Candidate;
use App\Models\Company;
use App\Models\Vacancy;

class OffersController extends BaseController
{
    public function __invoke(FilterRequest $request, Vacancy $vacancy)
    {
        $data = $request->validated();
        $page = $data['page'] ?? 1;
        $perPage = $data['per_page'] ?? 10;

        $data['profession_id'] = $vacancy->profession_id;
        $data['salary'] = $vacancy->salary;
        $data['experience_months'] = $vacancy->experience_months;
        $data['area_id'] = $vacancy->area_id;
        $data['type_id'] = $vacancy->type_id;


        $filter = app()->make(CandidateFilter::class, ['queryParams' => array_filter($data)]);

        $candidates = Candidate::filter($filter)
            ->orderBy('created_at', 'asc')
            ->paginate($perPage, ['*'], 'page', $page);

        return CandidateResource::collection($candidates);
    }
}
