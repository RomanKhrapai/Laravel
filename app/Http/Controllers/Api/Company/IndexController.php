<?php

namespace App\Http\Controllers\Api\Company;

use App\Http\Controllers\Api\Company\BaseController;
use App\Http\Filters\CompanyFilter;
use App\Http\Requests\Company\FilterRequest;
use App\Models\Company;
use App\Http\Resources\CompanyResource;
use Illuminate\Support\Facades\Auth;

class IndexController extends BaseController
{
    public function __invoke(FilterRequest $request)
    {
        $data = $request->validated();
        $page = $data['page'] ?? 1;
        $perPage = $data['per_page'] ?? 10;

        $user = Auth::user();

        if ($user && $user->role_id === 2) {
            $data['user_id'] = $user->id;
        }

        $filter = app()->make(CompanyFilter::class, ['queryParams' => array_filter($data)]);

        $companies = Company::filter($filter)->paginate($perPage, ['*'], 'page', $page);

        return  CompanyResource::collection($companies);
    }
}
