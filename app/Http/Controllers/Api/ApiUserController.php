<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ApiUserController extends Controller
{
    public function index(Request $request)
    {

        $user = $request->user()->only(['id', 'role_id', 'name', 'telephone', 'email', 'image']);


        return response()->json([
            'user' => $user,
        ]);
    }
}
