<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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

    public function callbackGoogle(Request $request)
    {
        $googleUser = Socialite::driver('google')->user();
        $user = User::where('email', '=', $googleUser->email)->first();

        if (!$user) {
            $user = User::create([
                'name' => $googleUser->name,
                'email' => $googleUser->email,
                'password' => Hash::make('')
            ]);
            // Auth::login($user);
            $token = $user->createToken('API Token')->plainTextToken;

            return  redirect()->away(env('APP_FRONT_URL') . '?new=true&token=' . $token);
        } elseif ($user->role_id == 2 || $user->role_id == 3 || !$user->role_id) {
            Auth::login($user);
            $userAgent = $request->header('User-Agent');
            $user->tokens()
                ->where('name', $userAgent)
                ->delete();

            $token = $user->createToken($userAgent)->plainTextToken;

            return  redirect()->away(env('APP_FRONT_URL') . '?token=' . $token);
        }
        Auth::login($user);
        return redirect()->route('home');
    }
}
