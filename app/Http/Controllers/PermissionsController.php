<?php

namespace App\Http\Controllers;

use App\DataTables\Users\UsersDataTable;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionsController extends Controller
{

    public function index(UsersDataTable $dataTable)
    {
        //
    }

    //////////////////////////////////////////////////
    public function create()
    {
        $permission = Permission::create(['name' => 'edit articles']);
    }

    //////////////////////////////////////////////////
    public function store(Request $request)
    {
        //
    }

    //////////////////////////////////////////////////
    public function show($id)
    {
        //
    }

    //////////////////////////////////////////////////
    public function edit(User $user)
    {
        //
    }

    //////////////////////////////////////////////////
    public function update(Request $request, User $user)
    {
        //
    }

    //////////////////////////////////////////////////
    public function destroy($id)
    {
        //
    }

    //////////////////////////////////////////////
    public function assign(Request $request)
    {
        $roleId = 1;//$request->get('role_id');
        $permissionId = 1;//$request->get('permission_id');

        $role = Role::findById($roleId);
        $permission = Permission::findById($permissionId);

        if ($role && $permission) {
            $permissions[] = $permission;
            $role->syncPermissions($permissions);

            // $permission->syncRoles($roles);
        }
    }

    //////////////////////////////////////////////
    public function revoke(Request $request)
    {
        $roleId = 1;//$request->get('role_id');
        $permissionId = 1;//$request->get('permission_id');

        $role = Role::findById($roleId);
        $permission = Permission::findById($permissionId);

        if ($role && $permission) {
            $role->revokePermissionTo($permission);
           // $permission->removeRole($role);
        }
    }
}
