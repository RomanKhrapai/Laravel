<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function redirectGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callbackGoogle()
    {
        $user = Socialite::driver('google')->user();
        $user = User::where('email', '=', $user->email)->first();
        if (!$user || !$user->role_id || $user->role_id === 2 || $user->role_id === 3) {

            return redirect()->route('login');
        }
        Auth::login($user);
        return redirect()->route('home');
    }

    public function regOrLogin($googleUser)
    {
        $user = User::where('email', '=', $googleUser->email)->first();
        if (!$user) {

            User::create([
                "name" => $googleUser->name,
                'email' => $googleUser->email,
                'password' => bcrypt(Str::random(40)),
            ]);
        } else {
            Auth::login($user);
        }
    }
}
