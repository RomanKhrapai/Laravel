<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\LoginRequest;
use App\Http\Requests\User\RegisterRequest;
use App\Http\Requests\User\StoreRequest;
use App\Http\Resources\UserResource;
use App\Jobs\SendEmailQueueJob;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Notifications\RegisteredUserNotification;
use App\Notifications\WelcomeEmailNotification;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Validation\Rule;
use App\Models\Role;

class AuthController extends Controller
{
    public function t(Request $request)
    {

        return response()->json(['token' => '$token->plainTextToken']);
    }
    public function register(Request $request)
    {
        $validateUser = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'role_id' => ['required', 'integer', Rule::in([2, 3])],
            'password' => 'required|string|min:8'
        ]);

        if ($validateUser->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validateUser->errors()
            ], 422);
        }


        $user = User::create([
            'name' => $request->name,
            "role_id" => $request->role_id,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        return response()->json([
            'user' => new UserResource($user),
            'access_token' => $user->createToken('API Token')->plainTextToken
        ], 201);
    }

    public function login(Request $request)
    {

        $validateUser = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:8'
        ]);

        if ($validateUser->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validateUser->errors()
            ], 422);
        }

        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
                'email' => 'Authentication email or password is not valid.',
                'password' => 'Authentication email or password is not valid.'
            ], 401);
        }
        $user = User::where('email', $request['email'])->firstOrFail();

        Auth::login($user);
        $userAgent = $request->header('User-Agent');
        $user->tokens()
            ->where('name', $userAgent)
            ->delete();

        $token = $user->createToken($userAgent)->plainTextToken;

        return response()->json([
            'user' => new UserResource($user),
            'access_token' => $token,
        ]);
    }

    /**
     * Logout
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(Request $request)
    {
        $user = Auth::User();

        $request->user()->currentAccessToken()->delete();

        // if (!$user) {
        //     return response()->json(['message' => 'Logged out']);
        // } else {
        //     $user->tokens()->where('name', 'token-name')->delete();
        // }
        // Auth::guard('web')->logout();
        // Auth::guard('api')->tokens()->delete();
        // Auth::logout();

        // $request->session()->invalidate();
        // $request->session()->regenerateToken();

        return response()->json(['message' => 'Logged out', 'user' => $user]);
    }
}
