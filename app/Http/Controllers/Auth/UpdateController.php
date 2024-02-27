<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\UpdatePasswordRequest;
use App\Http\Requests\Auth\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Jobs\SendChangePasswordMail;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Str;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use App\Services\ImageService;

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

    public function password(UpdatePasswordRequest $request)
    {
        $data = $request->validated();
        $user = User::findOrFail(Auth::id());

        $user->update([
            'password' => Hash::make($data['password']),
            'role_id' => $data['role']
        ]);

        $userAgent = $request->header('User-Agent');
        $user->tokens()
            ->where('name', $userAgent)
            ->delete();

        $token = $user->createToken($userAgent)->plainTextToken;

        SendChangePasswordMail::dispatch($user);

        return response()->json(['access_token' => $token,]);
    }


    public function user(UpdateUserRequest $request, ImageService $imageService)
    {
        $data  = $request->validated();
        $user = User::findOrFail(Auth::id());

        $data = $imageService->saveImageUser($user, $data);

        if (isset($data['errors'])) {
            return response()->json($data);
        }

        $user->update($data);

        return response()->json(['user' => new UserResource($user)], 201);
    }
}
