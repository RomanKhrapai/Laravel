<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\Nature;
use App\Models\Type;

class ApiFormParametersController extends Controller
{
    public function index()
    {
        $natures = Nature::get(['id', 'name']);
        $types = Type::get(['id', 'name']);
        return response()->json(['natures' => $natures, 'types' => $types]);
    }
}
