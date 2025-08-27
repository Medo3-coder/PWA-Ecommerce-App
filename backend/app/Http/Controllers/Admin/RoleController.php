<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Roles\StoreRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of roles
     */
    public function index()
    {
        $roles = Cache::remember('admin.roles.index', '3600', function () {
            return Role::with('permissions')->orderBy('name')->get();
        });

        return view('admin.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new role
     */
    public function create()
    {
        $permissions      = Permission::orderBy('name')->get();
        $permissionGroups = $permissions->groupBy(function ($permission) {
            return explode('.', $permission->name)[0];
        });

        return view('admin.roles.create', compact('permissions', 'permissionGroups'));
    }

    /**
     * Store a newly created role
     */
    public function store(StoreRequest $request)
    {
        try {
            $data = $request->validated();

            $role = Role::create([
                ...$data,
                'guard_name' => 'web',
            ]);

            // Sync permissions if provided
            if ($request->has('permissions') && ! empty($request->permissions)) {
                $role->syncPermissions($request->permissions);
            }
            Cache::flush();

            return redirect()->route('admin.roles.index')
                ->with('success', 'Role created successfully.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Failed to create role: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified role
     */
    public function show(Role $role)
    {
        $role->load('permissions', 'users');
        $permissions      = Permission::orderBy('name')->get();
        $permissionGroups = $permissions->groupBy(function ($permission) {
            return explode('.', $permission->name)[0];
        });

        return view('admin.roles.show', compact('role', 'permissions', 'permissionGroups'));
    }

    /**
     * Show the form for editing the specified role
     */
    public function edit(Role $role)
    {
        // Prevent editing of system roles
        if (in_array($role->name, ['super_admin', 'admin', 'user'])) {
            return redirect()->route('admin.roles.index')
                ->with('error', 'System roles cannot be edited.');
        }

        $role->load('permissions');
        $permissions      = Permission::orderBy('name')->get();
        $permissionGroups = $permissions->groupBy(function ($permission) {
            return explode('.', $permission->name)[0];
        });

        return view('admin.roles.edit', compact('role', 'permissions', 'permissionGroups'));
    }

    /**
     * Update the specified role
     */
    public function update(Request $request, Role $role)
    {
        // Prevent editing of system roles
        if (in_array($role->name, ['super_admin', 'admin', 'user'])) {
            return redirect()->route('admin.roles.index')
                ->with('error', 'System roles cannot be modified.');
        }

        $request->validate([
            'name'          => 'required|string|max:255|unique:roles,name,' . $role->id,
            'permissions'   => 'array',
            'permissions.*' => 'exists:permissions,id',
        ]);

        $role->update([
            'name' => $request->name,
        ]);

        if ($request->has('permissions')) {
            $role->syncPermissions($request->permissions);
        }

        Cache::tags(['roles', 'admin'])->flush();

        return redirect()->route('admin.roles.index')
            ->with('success', 'Role updated successfully.');
    }

    /**
     * Remove the specified role
     */
    public function destroy(Role $role)
    {
        // Prevent deletion of system roles
        if (in_array($role->name, ['super_admin', 'admin', 'user'])) {
            return redirect()->route('admin.roles.index')
                ->with('error', 'System roles cannot be deleted.');
        }

        if ($role->users()->count() > 0) {
            return redirect()->route('admin.roles.index')
                ->with('error', 'Cannot delete role that has assigned users.');
        }

        $role->delete();

        Cache::tags(['roles', 'admin'])->flush();

        return redirect()->route('admin.roles.index')
            ->with('success', 'Role deleted successfully.');
    }
}

