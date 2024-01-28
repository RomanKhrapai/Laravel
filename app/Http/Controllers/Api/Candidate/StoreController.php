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

        $candidate = $this->service->store($data);

        return $candidate instanceof Candidate ? new CandidateResource($candidate) : $candidate;
    }
}
