<?php

namespace App\Http\Controllers\Api\Company;

use App\Http\Controllers\Api\Company\BaseController;
use App\Http\Requests\Company\StoreRequest;
use App\Http\Resources\CompanyResource;
use App\Models\Company;

class StoreController extends BaseController
{

    public function __invoke(StoreRequest $request)
    {
        $data = $request->validated();

        $company = $this->service->store($data);

        return $company instanceof Company ? new CompanyResource($company) : $company;
    }
}
