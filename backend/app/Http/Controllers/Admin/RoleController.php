<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Roles\StoreRequest;
use App\Http\Requests\Admin\Roles\UpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:view roles')->only(['index', 'show']);
        $this->middleware('permission:create roles')->only(['create', 'store']);
        $this->middleware('permission:edit roles')->only(['edit', 'update']);
        $this->middleware('permission:delete roles')->only(['destroy']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::with('permissions')->paginate(10);
        
        return view('admin.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $permissions = Permission::all()->groupBy(function ($permission) {
            return explode(' ', $permission->name)[1] ?? 'general';
        });
        
        return view('admin.roles.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        try {
            $data = $request->validated();

            // Create the role
            $role = Role::create([
                'name' => $data['name'],
                'guard_name' => 'web'
            ]);

            // Sync permissions if provided
            if ($request->has('permissions') && !empty($request->permissions)) {
                $role->syncPermissions($request->permissions);
            }

            // Clear cache
            Cache::tags(['roles', 'admin'])->flush();

            return redirect()->route('admin.roles.index')
                ->with('success', 'Role created successfully.');
                
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Failed to create role: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        $role->load('permissions');
        
        return view('admin.roles.show', compact('role'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        $permissions = Permission::all()->groupBy(function ($permission) {
            return explode(' ', $permission->name)[1] ?? 'general';
        });
        
        $role->load('permissions');
        
        return view('admin.roles.edit', compact('role', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Role $role)
    {
        try {
            $data = $request->validated();

            // Update the role
            $role->update([
                'name' => $data['name']
            ]);

            // Sync permissions
            if ($request->has('permissions')) {
                $role->syncPermissions($request->permissions ?? []);
            } else {
                $role->syncPermissions([]);
            }

            // Clear cache
            Cache::tags(['roles', 'admin'])->flush();

            return redirect()->route('admin.roles.index')
                ->with('success', 'Role updated successfully.');
                
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Failed to update role: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        try {
            // Prevent deletion of super admin role
            if ($role->name === 'super-admin') {
                return redirect()->back()
                    ->with('error', 'Cannot delete super admin role.');
            }

            // Check if role is assigned to users
            if ($role->users()->count() > 0) {
                return redirect()->back()
                    ->with('error', 'Cannot delete role that is assigned to users.');
            }

            $role->delete();

            // Clear cache
            Cache::tags(['roles', 'admin'])->flush();

            return redirect()->route('admin.roles.index')
                ->with('success', 'Role deleted successfully.');
                
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Failed to delete role: ' . $e->getMessage());
        }
    }

    /**
     * Bulk actions for roles.
     */
    public function bulkAction(Request $request)
    {
        $request->validate([
            'action' => 'required|in:delete',
            'roles' => 'required|array',
            'roles.*' => 'exists:roles,id'
        ]);

        try {
            $roles = Role::whereIn('id', $request->roles)->get();
            
            switch ($request->action) {
                case 'delete':
                    foreach ($roles as $role) {
                        // Skip super admin role
                        if ($role->name === 'super-admin') {
                            continue;
                        }
                        
                        // Skip roles assigned to users
                        if ($role->users()->count() > 0) {
                            continue;
                        }
                        
                        $role->delete();
                    }
                    break;
            }

            // Clear cache
            Cache::tags(['roles', 'admin'])->flush();

            return redirect()->back()
                ->with('success', 'Bulk action completed successfully.');
                
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Failed to perform bulk action: ' . $e->getMessage());
        }
    }
}