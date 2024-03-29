<?php

namespace App\Http\Controllers\Api\Candidate;

use App\Http\Controllers\Api\Vacancy\BaseController;
use App\Http\Filters\VacancyFilter;
use App\Http\Requests\Candidate\FilterRequest;

use App\Http\Resources\VacancyResource;
use App\Models\Candidate;
use App\Models\Vacancy;
use Illuminate\Support\Facades\Log;

class OffersController extends BaseController
{
    public function __invoke(FilterRequest $request, Candidate $candidate)
    {

        $data = $request->validated();
        $page = $data['page'] ?? 1;
        $perPage = $data['per_page'] ?? 10;

        $data['profession_id'] = $candidate->profession_id;
        $data['salary'] = $candidate->salary;
        $data['experience_months'] = $candidate->experience_months;
        $data['area_id'] = $candidate->area_id;
        $data['nature_id'] = $candidate->type_id;

        $params = ['queryParams' => array_filter($data)];
        $params['queryParams']['closed'] = true;

        $filter = app()->make(VacancyFilter::class, $params);

        $query  = Vacancy::withAvg('receivedReviews', 'vote')
            ->withCount('receivedReviews')
            ->filter($filter)
            ->orderBy('created_at', 'asc');
        // $sql = $query->toSql();
        // Log::info($sql);
        $vacancies = $query->paginate($perPage, ['*'], 'page', $page);

        return VacancyResource::collection($vacancies);
    }
}
