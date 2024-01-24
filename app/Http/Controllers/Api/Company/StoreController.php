<?php

namespace App\Http\Controllers\Api\Company;

use App\Http\Controllers\Api\Company\BaseController;
use App\Http\Requests\Company\StoreRequest;
use App\Http\Resources\CompanyResource;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class StoreController extends BaseController
{

    public function __invoke(StoreRequest $request)
    {
        $data = $request->validated();

        $vacancy = $this->service->store($data);

        return $vacancy instanceof Company ? new CompanyResource($vacancy) : $vacancy;
    }
}
