<?php

namespace App\Http\Controllers\Api\Company;

use App\Http\Controllers\Api\Company\BaseController;
use App\Models\Company;
use App\Http\Resources\CompanyResource;

class ShowController extends BaseController
{
    public function __invoke(Company $company)
    {
        return new CompanyResource($company);
    }
}
