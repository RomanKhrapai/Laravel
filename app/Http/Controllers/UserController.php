<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Str;

class UserController extends Controller
{

    public function __construct(
        protected User $user
    ) {
        // $this->middleware('auth');
        // $this->middleware('admin');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny', User::class);

        $users = User::paginate(5);
        return view('users.index', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', User::class);

        $roles = Role::all();
        return view('users.create', ['roles' => $roles]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        $this->authorize('create', User::class);
        $imageUrl = $request->input('image');
        $password = $request->input('password');

        $data = $request->except('_token', 'password', 'password_confirmation', 'img', "image");

        if ($imageUrl && !File::exists(storage_path('app/public/' . $imageUrl))) {
            throw ValidationException::withMessages([
                'image' => 'Problem file.',
            ]);
        } elseif ($imageUrl) {
            $uniqueName = Str::uuid()->toString();
            $extension = pathinfo($imageUrl, PATHINFO_EXTENSION);
            $newPath = 'images/users/avatars/' . $uniqueName . '.' . $extension;
            Storage::disk('public')->move($imageUrl, $newPath);
            $data['image'] = $newPath;
        }

        $data['password'] = Hash::make($password);
        $user = User::create($data);

        return redirect()->route('users.show', ['user' => $user])->with('success', ['id' => $user->id]);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        $this->authorize('view', User::class);
        // dd($user);
        return view('users.show', ['user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $this->authorize('update', User::class);

        $roles = Role::all();
        return view('users.edit', ['user' => $user, 'roles' => $roles]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $this->authorize('update', User::class);

        $imageUrl = $request->input('image');
        $password = $request->input('password');

        $data = $request->except('_token', 'password', 'password_confirmation', 'img', "image");

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

        if (!empty($password)) {
            $data['password'] = Hash::make($password);
        }
        $user->update($data);

        return redirect()->route('users.show', ['user' => $user]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $this->authorize('delete', User::class);

        $user->delete();

        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }
}
