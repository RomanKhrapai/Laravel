<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use App\Models\Role;
use App\Models\Permission;
use App\Models\User;


class RoleController extends Controller
{
    public function __construct(
        protected Role $role
    ) {
        // $this->middleware('auth');
        // $this->middleware('admin');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny', Role::class);

        $roles = Role::orderBy('name', 'ASC')->paginate(5);
        if ($roles->isEmpty()) {
            abort(404);
        }
        return view('roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Role::class);

        $permissions = Permission::get();

        return view('roles.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRoleRequest $request)
    {
        $this->authorize('create', Role::class);

        $data = $request->except('_token', 'permissions');
        $role = Role::create($data);
        $permissions = $request->input('permissions', []);
        $role->permissions()->attach($permissions);

        return redirect()->route('roles.show', ['role' => $role])->with('success', ['id' => $role->id]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        $this->authorize('view', User::class, Role::class);

        return view('roles.show', ['role' => $role]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        $this->authorize('update', User::class, Role::class);

        $permissions = Permission::all();
        return view('roles.edit', compact('role', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRoleRequest $request, Role $role)
    {
        $this->authorize('update', User::class, Role::class);

        $data = $request->except('_token', 'permissions');
        $role->update($data);
        $permissions = $request->input('permissions', []);
        $role->permissions()->sync($permissions);
        return redirect()->route('roles.show', ['role' => $role])->with('success', ['id' => $role->id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        $this->authorize('delete', User::class, Role::class);

        $role->permissions()->detach();
        $role->delete();

        return redirect()->route('roles.index')->with('success', 'Role deleted successfully.');
    }
}
