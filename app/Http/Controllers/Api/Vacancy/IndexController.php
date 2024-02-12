<?php

namespace App\Http\Controllers\Api\Vacancy;

use App\Http\Controllers\Api\Vacancy\BaseController;
use App\Http\Filters\VacancyFilter;
use App\Http\Requests\Vacancy\FilterRequest;
use App\Models\Vacancy;
use App\Http\Resources\VacancyResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class IndexController extends BaseController
{
    public function __invoke(FilterRequest $request)
    {


        $data = $request->validated();
        $page = $data['page'] ?? 1;
        $perPage = $data['per_page'] ?? 10;

        $user = Auth::user();

        if (isset($user) && $user->role_id === 2) {
            $data['user_id'] = $user->id;
        } else {
            $data['closed'] = true;
        }

        $filter = app()->make(VacancyFilter::class, ['queryParams' => array_filter($data)]);

        $vacancies = Vacancy::filter($filter)->paginate($perPage, ['*'], 'page', $page);
        return  VacancyResource::collection($vacancies);
    }
}
