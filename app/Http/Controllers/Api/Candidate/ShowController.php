<?php

namespace App\Http\Controllers\Api\Candidate;

use App\Http\Controllers\Api\Candidate\BaseController;
use App\Models\Candidate;
use App\Http\Resources\CandidateResource;

class ShowController extends BaseController
{
    public function __invoke(Candidate $candidate)
    {
        return new CandidateResource($candidate);
    }
}
