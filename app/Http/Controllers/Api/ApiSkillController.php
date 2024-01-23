<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use App\Models\Skill;

class ApiSkillController extends Controller
{
    public function byProfesion(Request $request)
    {
        $skills = Skill::where('profession_id', $request->query('id'))->get(['id', 'name']);
        return response()->json($skills);
    }
}
