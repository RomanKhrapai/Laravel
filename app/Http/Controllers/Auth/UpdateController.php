<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\UpdatePasswordRequest;
use App\Http\Requests\Auth\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Jobs\SendChangePasswordMail;
use App\Mail\ChangePasswordMail;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;

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

    public function password(UpdatePasswordRequest $request, User $user)
    {
        $data = $request->validated();

        if (
            (Auth::user()->id !== $user->id)
        ) {
            return response()->json(['message' => 'no permission'], 401);
        }

        if (
            !(Hash::check($data['oldPassword'], $user->password) ||
                Hash::check('', $user->password))
        ) {
            return response()->json(['message' => 'old password not correct'], 401);
        }

        if ($user) {
            $user->update([
                'password' => Hash::make($data['password']),
                'role_id' => $data['role']
            ]);

            $userAgent = $request->header('User-Agent');
            $user->tokens()
                ->where('name', $userAgent)
                ->delete();

            $token = $user->createToken($userAgent)->plainTextToken;

            // Mail::to($user->email)->send(new ChangePasswordMail(Auth::user()));
            SendChangePasswordMail::dispatch($user);

            return response()->json(['access_token' => $token,]);
        } else return response()->json(['message' => 'User not found',], 404);
    }


    public function user(UpdateUserRequest $request, User $user)
    {
        if (Auth::user()->id !== $user->id) {
            return response()->json(['message' => 'no permission'], 401);
        }

        $data  = $request->validated();

        $imageUrl = $data['image'];
        $data['image'] = null;

        if ($imageUrl && !File::exists(storage_path('app/public/' . $imageUrl))) {
            throw ValidationException::withMessages([
                'image' => 'Problem file.',
            ]);
        } elseif ($imageUrl && $imageUrl !== $user->image) {
            $uniqueName = Str::uuid()->toString();
            $extension = pathinfo($imageUrl, PATHINFO_EXTENSION);
            $newPath = 'images/users/avatars/' . $uniqueName . '.' . $extension;
            Storage::disk('public')->move($imageUrl, $newPath);
            $data['image'] = $newPath;

            $newUrl = str_replace("/storage/", "", $user->image);
            if (isset($user->image) && Storage::exists('public/' . $newUrl)) {
                Storage::delete('public/' .  $newUrl);
            }
        } else {
            $data['image'] = $imageUrl;

            $newUrl = str_replace("/storage/", "", $user->image);
            if (!$imageUrl && isset($user->image) && Storage::exists('public/' . $newUrl)) {
                Storage::delete('public/' . $newUrl);
            }
        }

        $user->update($data);

        return response()->json(['user' => new UserResource($user)], 201);
    }
}
