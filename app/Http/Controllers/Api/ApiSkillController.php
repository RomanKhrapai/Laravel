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
        // dd(Auth::check(), Auth::user(), $request);

        // $token = $request->header('X-CSRF-TOKEN');
        // if (!Auth::check() || !$token || $token !== csrf_token()) {
        //     abort(404);
        // }
        return Skill::where('profession_id', $request->query('value'))->get(['id', 'name'])->toArray();
    }
}
