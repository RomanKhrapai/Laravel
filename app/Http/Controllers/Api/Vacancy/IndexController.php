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
        $sortfild = $data['sort'] ?? 'created_at';
        $sortDirection =  $data['is_desc'] ?? 'asc';
        if ($sortfild === 'vote') $sortfild = 'received_reviews_avg_vote';


        $user = Auth::user();

        if (isset($user) && $user->role_id === 2) {
            $data['user_id'] = $user->id;
        } else {
            $data['closed'] = true;
        }

        $filter = app()->make(VacancyFilter::class, ['queryParams' => array_filter($data)]);

        $vacancies = Vacancy::withAvg('receivedReviews', 'vote')
            ->withCount('receivedReviews')
            ->filter($filter)
            ->orderBy($sortfild, $sortDirection)
            ->paginate($perPage, ['*'], 'page', $page);

        return  VacancyResource::collection($vacancies);
    }
}
