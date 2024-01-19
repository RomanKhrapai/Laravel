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

        $this->authorizeResource(Role::class, 'role');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {


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
        $permissions = Permission::get();

        return view('roles.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRoleRequest $request)
    {
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
        return view('roles.show', ['role' => $role]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        $permissions = Permission::all();
        return view('roles.edit', compact('role', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRoleRequest $request, Role $role)
    {
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
        $role->permissions()->detach();
        $role->delete();

        return redirect()->route('roles.index')->with('success', 'Role deleted successfully.');
    }
}
