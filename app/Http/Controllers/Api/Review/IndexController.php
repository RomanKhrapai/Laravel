<?php

namespace App\Http\Controllers\Api\Review;

use App\Http\Controllers\Api\Review\BaseController;
use App\Http\Filters\ReviewFilter;
use App\Http\Requests\Review\FilterRequest;
use App\Models\Review;
use App\Http\Resources\ReviewResource;
use Illuminate\Support\Facades\Auth;

class IndexController extends BaseController
{
    public function __invoke(FilterRequest $request)
    {


        $data = $request->validated();
        $page = $data['page'] ?? 1;
        $perPage = $data['per_page'] ?? 10;



        $filter = app()->make(ReviewFilter::class, ['queryParams' => array_filter($data)]);

        $revievs = Review::filter($filter)->paginate($perPage, ['*'], 'page', $page);

        return  ReviewResource::collection($revievs);
    }
}
