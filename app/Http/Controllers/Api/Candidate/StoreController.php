<?php

namespace App\Http\Controllers\Api\Candidate;

use App\Http\Controllers\Api\Candidate\BaseController;
use App\Http\Requests\Candidate\StoreRequest;
use App\Http\Resources\CandidateResource;
use App\Models\Candidate;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class StoreController extends BaseController
{

    public function __invoke(StoreRequest $request)
    {
        $data = $request->validated();

        $vacancy = $this->service->store($data);

        return $vacancy instanceof Candidate ? new CandidateResource($vacancy) : $vacancy;
    }
}
