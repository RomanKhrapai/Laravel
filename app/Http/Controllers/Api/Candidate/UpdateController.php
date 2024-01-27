<?php

namespace App\Http\Controllers\Api\Candidate;

use App\Http\Controllers\Api\Candidate\BaseController;
use App\Models\Area;
use Illuminate\Http\Request;

class UpdateController extends BaseController
{
    public function __invoke(Request $request)
    {

        return response()->json('$areas');
    }
}
