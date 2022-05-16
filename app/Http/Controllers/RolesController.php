<?php

namespace App\Http\Controllers;

use App\DataTables\Roles\RolesDataTable;
use App\Models\PermissionsGroup;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Spatie\Permission\Models\Role;

class RolesController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:permissions.show')->only(['index', 'show']);
        $this->middleware('permission:permissions.create')->only(['create', 'store']);
        $this->middleware('permission:permissions.edit')->only(['edit', 'update', 'status']);
        $this->middleware('permission:permissions.delete')->only(['destroy']);
    }

    public function index(RolesDataTable $dataTable)
    {
        return $dataTable->render('pages.role.index.index');
    }

    //////////////////////////////////////////////////
    public function create()
    {
        $info = '';
        return view('pages.role.create.create', compact('info'));
    }

    //////////////////////////////////////////////////
    public function store(Request $request)
    {
        $role = Role::create(['name' => $request->name]);
        if($role){
            return redirect()->route('role.index')
                ->with('success', 'تمت الإضافة بنجاح.');
        }else{
            return redirect()->route('role.index')
                ->with('error', 'حدث خطأ!');
        }
    }

    //////////////////////////////////////////////////
    public function show($id)
    {
        //
    }

    //////////////////////////////////////////////////
    public function edit(Role $role)
    {
        if($role->id == 1 && auth()->user()->id != 1){
            return redirect()->route('role.index')
                ->with('danger', 'لا يمكن تعديل بيانات المشرف العام.');
        }
        return view('pages.role.edit.edit', compact('role'));
    }

    //////////////////////////////////////////////////
    public function update(Request $request, Role $role)
    {
        $role->update($request->all());
        return redirect()->route('role.index')
            ->with('success', 'تم التعديل بنجاح');
    }

    //////////////////////////////////////////////////
    public function destroy($id)
    {
        if($id == 1){
            return response()->json(['status' => 'error', 'message' => 'لا يمكن حذف صلاحيات المشرف العام!']);
        }
        $role = Role::findById($id);
        if ($role) {
            if ($role->permissions->count() > 0) {
                return response()->json(['status' => 'error', 'message' => 'لا يمكن حذف المجموعة، يرجعى إلغاء الصلاحيات أولا!']);
            }
            $users = User::all();
            $perUserCount = 0;
            foreach ($users as $user){
                if($user->hasRole($role->name)){
                    $perUserCount++;
                }
            }
            if ($perUserCount > 0) {
                return response()->json(['status' => 'error', 'message' => 'لا يمكن حذف المجموعة، يرجعى إلغاء المستخدمين أولا!']);
            }
            $role->delete();
        }
        return response()->json(['status' => 'success', 'message' => 'تم الحذف بنجاح']);
    }

    //////////////////////////////////////////////
    public function updateStatus(Request $request)
    {
        //
    }

    //////////////////////////////////////////////////
    public function permissions(Role $role)
    {
//        if($role->id == 1  && auth()->user()->id != 1){
//            return redirect()->route('role.index')
//                ->with('danger', 'لا يمكن تعديل صلاحيات المشرف العام.');
//        }
        $permissionGroup =  PermissionsGroup::all();
        return view('pages.role.edit.permissions', compact(['role','permissionGroup']));
    }

    //////////////////////////////////////////////////
    public function updatePermissions(Role $role, Request $request): \Illuminate\Http\RedirectResponse
    {
        $permissions = $request->get('permissions');
        foreach ($role->permissions as $permission) {
            $role->revokePermissionTo($permission);
        }
        if ($permissions && sizeof($permissions) > 0) {
            $role->syncPermissions($permissions);
            Cache::forget('spatie.permission.cache');
        }
        return redirect()->route('role.index')
            ->with('success', 'تم التعديل بنجاح.');
    }
}
