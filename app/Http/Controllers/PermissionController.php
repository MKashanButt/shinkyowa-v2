<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePermissionRequest;
use App\Http\Requests\UpdatePermissionRequest;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    public function index()
    {
        $permissions = Permission::with('role')
            ->paginate(8);

        return view('admin.permission.index', compact('permissions'));
    }

    public function create()
    {
        $roles = Role::pluck('name', 'id');

        return view('admin.permission.create', compact('roles'));
    }

    public function store(StorePermissionRequest $request)
    {
        $validated = $request->validated();
        $validated['name'] = strtolower(str_replace(' ', '_', $validated['name']));

        $permission = Permission::create([
            'name' => $validated['name'],
        ]);

        $permission->role()->attach($validated['role_id']);

        return redirect()->route('permission.index')
            ->with('success', 'Permission created successfully!');
    }

    public function edit(Permission $permission)
    {
        $roles = Role::pluck('name', 'id');
        $permission['name'] = str_replace('_', ' ', $permission->name);

        return view('admin.permission.edit', compact('permission', 'roles'));
    }

    public function update(UpdatePermissionRequest $request, Permission $permission)
    {
        $validated = $request->validated();
        $validated['name'] = strtolower(str_replace(' ', '_', $validated['name']));

        $permission->update([
            'name' => $validated['name'],
        ]);

        $permission->role()->sync($validated['role_id']);

        return redirect()->route('permission.index')
            ->with('success', 'Permission updated successfully!');
    }

    public function destroy(Permission $permission)
    {
        $permission->delete();

        return redirect()->route('permission.index')
            ->with('success', 'Permission deleted successfully!');
    }
}
