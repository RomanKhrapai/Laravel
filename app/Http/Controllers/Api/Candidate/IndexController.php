<?php

namespace App\Http\Controllers\Api\Candidate;

use App\Http\Controllers\Api\Candidate\BaseController;
use App\Http\Filters\CandidateFilter;
use App\Http\Requests\Candidate\FilterRequest;
use App\Models\Candidate;
use App\Http\Resources\CandidateResource;
use Illuminate\Support\Facades\Auth;

class IndexController extends BaseController
{
    public function __invoke(FilterRequest $request)
    {


        $data = $request->validated();
        $page = $data['page'] ?? 1;
        $perPage = $data['per_page'] ?? 2;

        $user = Auth::user();

        if ($user->role_id === 3) {
            $data['user_id'] = $user->id;
        }

        $filter = app()->make(CandidateFilter::class, ['queryParams' => array_filter($data)]);

        $candidates = Candidate::filter($filter)->paginate($perPage, ['*'], 'page', $page);

        return  CandidateResource::collection($candidates);
    }
}
