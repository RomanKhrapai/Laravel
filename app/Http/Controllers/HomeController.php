<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function __invoke()
    {
        $user = User::find(Auth::user()->id);

        if ($user && in_array($user->role_id, [2, 3])) {

            $token = $user->createToken('API Token')->plainTextToken;

            return  redirect()->away('http://localhost:5174?token=' . $token);
        }

        // Інакше відображайте головну сторінку
        return view('home');
    }
}
