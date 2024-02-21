<?php

namespace App\Http\Controllers\Api\Company;

use App\Http\Controllers\Api\Company\BaseController;
use App\Http\Filters\CompanyFilter;
use App\Http\Requests\Company\FilterRequest;
use App\Models\Company;
use App\Http\Resources\CompanyResource;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class IndexController extends BaseController
{
    public function __invoke(FilterRequest $request)
    {
        $data = $request->validated();
        $page = $data['page'] ?? 1;
        $perPage = $data['per_page'] ?? 12;
        $sortfild = $data['sort'] ?? 'created_at';
        $sortDirection =  $data['is_desc'] ?? 'asc';

        $user = Auth::user();

        if ($user && $user->role_id === 2) {
            $data['user_id'] = $user->id;
        }

        $filter = app()->make(CompanyFilter::class, ['queryParams' => array_filter($data)]);

        $companies = Company::withAvg('receivedReviews', 'vote')
            ->filter($filter)
            ->orderBy($sortfild, $sortDirection)
            ->paginate($perPage, ['*'], 'page', $page);

        return  CompanyResource::collection($companies);
    }
}
