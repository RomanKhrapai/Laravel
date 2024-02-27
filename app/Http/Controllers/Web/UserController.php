<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use App\Models\Role;
use App\Services\ImageService;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Str;

class UserController extends Controller
{

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
    public function store(StoreUserRequest $request, ImageService $imageService)
    {
        $this->authorize('create', User::class);
        $data  = $request->validated();

        $data = $imageService->saveNewImageUser($data);

        if (isset($data['errors'])) {
            return redirect()->back()->withErrors($data);
        }

        $data['password'] = Hash::make($data['password']);
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
    public function update(UpdateUserRequest $request, User $user, ImageService $imageService)
    {
        $this->authorize('update', User::class);
        $data  = $request->validated();

        $data = $imageService->saveImageUser($user, $data);

        if (isset($data['errors'])) {
            return redirect()->back()->withErrors($data);
        }

        $password = $data['password'];
        if (!empty($password)) {
            $data['password'] = Hash::make($password);
        } else {
            unset($data['password']);
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

        $user->softDeletes();

        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }
}
