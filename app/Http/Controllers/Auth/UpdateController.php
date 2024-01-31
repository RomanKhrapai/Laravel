<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UpdateController extends Controller
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


    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function password(Request $request)
    {
        $validateUser = Validator::make($request->all(), [
            'oldPassword' => 'nullable|string|min:8',
            'password' => 'required|string|min:8',
            'role' => ['required', Rule::in([2, 3])],
        ]);

        if ($validateUser->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validateUser->errors()
            ], 422);
        }
        $user = User::find(Auth::user()->id);
        if (
            !(Hash::check($request->oldPassword, $user->password) ||
                Hash::check('', $user->password))
        ) {
            return response()->json([
                'message' => 'old password not correct'
            ], 401);
        }

        if ($user) {
            $user->update([
                'password' => Hash::make($request->password),
                'role_id' => $request->role
            ]);

            $userAgent = $request->header('User-Agent');
            $user->tokens()
                ->where('name', $userAgent)
                ->delete();

            $token = $user->createToken($userAgent)->plainTextToken;

            return response()->json([
                'access_token' => $token,
            ]);
        } else {
            return response()->json([
                'message' => 'User not found',
            ], 404);
        }
    }
}
