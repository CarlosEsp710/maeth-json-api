<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PermissionResource;
use App\Http\Resources\RoleResource;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{

    public function index(Request $request)
    {
        abort_unless(!$request->user()->can('roles:index'), 403);

        $roles = Role::all();

        return RoleResource::collection($roles);
    }

    public function permissions(Request $request)
    {
        abort_unless(!$request->user()->can('roles:index'), 403);

        $permissions = Permission::all();

        return PermissionResource::collection($permissions);
    }


    public function create(Request $request)
    {
        abort_unless(!$request->user()->can('roles:create'), 403);

        $request->validate([
            'name' => 'required',
            'permissions' => 'required|array',
        ]);


        $role = Role::firstOrCreate(['name' => $request->name]);

        $role->permissions()->sync($request->permissions);

        return RoleResource::make($role);
    }


    public function read(Request $request, Role $role)
    {
        abort_unless(!$request->user()->can('roles:read'), 403);

        return RoleResource::make($role);
    }


    public function update(Request $request, Role $role)
    {
        abort_unless(!$request->user()->can('roles:update'), 403);

        $request->validate([
            'name' => 'required',
            'permissions' => 'required|array',
        ]);

        $role->update(['name' => $request->name]);

        $role->permissions()->sync($request->permissions);

        return RoleResource::make($role);
    }


    public function delete(Request $request, Role $role)
    {
        abort_unless(!$request->user()->can('roles:delete'), 403);

        $role->delete();

        return response()->noContent();
    }
}
