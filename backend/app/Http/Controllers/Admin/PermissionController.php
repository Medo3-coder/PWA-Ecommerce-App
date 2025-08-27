<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class PermissionController extends Controller
{
    /**
     * Display a listing of permissions
     */
    public function index()
    {
        $permissions = Cache::remember('admin.permissions.index', 3600, function () {
            return Permission::with('roles')->orderBy('name')->get();
        });

        $permissionGroups = $permissions->groupBy(function ($permission) {
            return explode('.', $permission->name)[0];
        });

        return view('admin.permissions.index', compact('permissions', 'permissionGroups'));
    }

    /**
     * Show the form for creating a new permission
     */
    public function create()
    {
        $roles = Role::orderBy('name')->get();

        return view('admin.permissions.create', compact('roles'));
    }

    /**
     * Store a newly created permission
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:permissions,name',
            'roles' => 'array',
            'roles.*' => 'exists:roles,id'
        ]);

        $permission = Permission::create([
            'name' => $request->name,
            'guard_name' => 'web'
        ]);

        if ($request->has('roles')) {
            $permission->roles()->sync($request->roles);
        }

        Cache::tags(['permissions', 'admin'])->flush();

        return redirect()->route('admin.permissions.index')
            ->with('success', 'Permission created successfully.');
    }

    /**
     * Display the specified permission
     */
    public function show(Permission $permission)
    {
        $permission->load('roles', 'users');
        $roles = Role::orderBy('name')->get();

        return view('admin.permissions.show', compact('permission', 'roles'));
    }

    /**
     * Show the form for editing the specified permission
     */
    public function edit(Permission $permission)
    {
        // Prevent editing of system permissions
        if (in_array($permission->name, [
            'dashboard.view',
            'users.view', 'users.create', 'users.edit', 'users.delete',
            'roles.view', 'roles.create', 'roles.edit', 'roles.delete',
            'permissions.view', 'permissions.create', 'permissions.edit', 'permissions.delete'
        ])) {
            return redirect()->route('admin.permissions.index')
                ->with('error', 'System permissions cannot be edited.');
        }

        $permission->load('roles');
        $roles = Role::orderBy('name')->get();

        return view('admin.permissions.edit', compact('permission', 'roles'));
    }

    /**
     * Update the specified permission
     */
    public function update(Request $request, Permission $permission)
    {
        // Prevent editing of system permissions
        if (in_array($permission->name, [
            'dashboard.view',
            'users.view', 'users.create', 'users.edit', 'users.delete',
            'roles.view', 'roles.create', 'roles.edit', 'roles.delete',
            'permissions.view', 'permissions.create', 'permissions.edit', 'permissions.delete'
        ])) {
            return redirect()->route('admin.permissions.index')
                ->with('error', 'System permissions cannot be modified.');
        }

        $request->validate([
            'name' => 'required|string|max:255|unique:permissions,name,' . $permission->id,
            'roles' => 'array',
            'roles.*' => 'exists:roles,id'
        ]);

        $permission->update([
            'name' => $request->name
        ]);

        if ($request->has('roles')) {
            $permission->roles()->sync($request->roles);
        }

        Cache::tags(['permissions', 'admin'])->flush();

        return redirect()->route('admin.permissions.index')
            ->with('success', 'Permission updated successfully.');
    }

    /**
     * Remove the specified permission
     */
    public function destroy(Permission $permission)
    {
        // Prevent deletion of system permissions
        if (in_array($permission->name, [
            'dashboard.view',
            'users.view', 'users.create', 'users.edit', 'users.delete',
            'roles.view', 'roles.create', 'roles.edit', 'roles.delete',
            'permissions.view', 'permissions.create', 'permissions.edit', 'permissions.delete'
        ])) {
            return redirect()->route('admin.permissions.index')
                ->with('error', 'System permissions cannot be deleted.');
        }

        if ($permission->roles()->count() > 0 || $permission->users()->count() > 0) {
            return redirect()->route('admin.permissions.index')
                ->with('error', 'Cannot delete permission that is assigned to roles or users.');
        }

        $permission->delete();

        Cache::flush();

        return redirect()->route('admin.permissions.index')
            ->with('success', 'Permission deleted successfully.');
    }
}

