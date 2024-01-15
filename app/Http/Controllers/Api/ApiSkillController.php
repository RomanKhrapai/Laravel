<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Skill;

class ApiSkillController extends Controller
{
    public function byProfesion(Request $request)
    {
        return Skill::where('profession_id', $request->query('value'))->get(['id', 'name'])->toArray();
    }
}
