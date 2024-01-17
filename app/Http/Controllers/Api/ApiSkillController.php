<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;
use Illuminate\Support\Facades\Response;


use App\Models\Skill;

class ApiSkillController extends Controller
{
    public function byProfesion(Request $request)
    {
        $token = $request->header('X-CSRF-TOKEN');
        if (!$token || $token !== csrf_token()) {
            abort(404);
        }
        // dd(csrf_token(), $token, $request);
        return Skill::where('profession_id', $request->query('value'))->get(['id', 'name'])->toArray();
    }
}
