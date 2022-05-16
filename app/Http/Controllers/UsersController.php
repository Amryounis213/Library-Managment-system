<?php

namespace App\Http\Controllers;

use App\DataTables\Users\UsersDataTable;
use App\Models\User;
use App\Models\UserInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:users.show')->only(['index', 'show']);
        $this->middleware('permission:users.create')->only(['create', 'store']);
        $this->middleware('permission:users.edit')->only(['edit', 'update', 'status']);
        $this->middleware('permission:users.delete')->only(['destroy']);
    }

    //////////////////////////////////////////////////
    public function index(UsersDataTable $dataTable)
    {

        return $dataTable->render('pages.user.index.index');
    }

    //////////////////////////////////////////////////
    public function create()
    {
        $roles = Role::all();
        return view('pages.user.create.create', compact('roles'));
    }

    //////////////////////////////////////////////////
    public function store(Request $request)
    {
        $roleId = $request->get('role_id');
        $user = User::create(array_merge($request->all(), ['password' => Hash::make($request->password),]));
        if ($user) {
            UserInfo::create([
                'user_id' => $user->id,
            ]);
        }

        $this->assign($user, $roleId);
        return redirect()->route('user.index')
            ->with('success', 'تمت الإضافة بنجاح.');
    }

    //////////////////////////////////////////////////
    public function show($id)
    {
        $config = theme()->getOption('page');

        return User::find($id);
    }

    //////////////////////////////////////////////////
    public function edit(User $user)
    {
        $config = theme()->getOption('page', 'edit');
        $roles = Role::all();
        return view('pages.user.edit.edit', compact(['user', 'roles']));
    }

    //////////////////////////////////////////////////
    public function update(Request $request, User $user)
    {
        $roleId = $request->get('role_id');
        $this->revoke($user, $user->role_id);
        $user->update($request->all());
        $this->assign($user, $roleId);
        return redirect()->route('user.index')
            ->with('success', 'تم التعديل بنجاح');
    }

    //////////////////////////////////////////////////
    public function destroy($id): \Illuminate\Http\JsonResponse
    {
        $user = User::find($id);
        if ($user) {
            if (sizeof($user->orders) > 0) {
                return response()->json(['status' => 'error', 'message' => 'لا يمكن الحذف لوجود طلبات مرتبطه به!']);
            }
            $user->delete();
        }
        return response()->json(['status' => 'success', 'message' => 'تم الحذف بنجاح']);
    }

    //////////////////////////////////////////////////
    public function changePassword(Request $request, $id)
    {
        $user = User::find($id);
        $currentPassword = $request->input('current_password');
        $pass = $this->passes($user, $currentPassword);

        if (!$pass) {
            return response()->json(array(
                'success' => false,
                'message' => 'كلمة المرور الحالية غير صحيحة!',
            ), 500);
        }

        $user->update(['password' => Hash::make($request->input('password'))]);

        return response()->json(array(
            'success' => true,
            'message' => 'تم إعاده تعيين كلمة المرور بنجاح!',
        ), 200);
    }

    //////////////////////////////////////////////////
    public function passes($user, $value)
    {
        return Hash::check($value, $user->password);
    }

    //////////////////////////////////////////////
    public function updateStatus(Request $request): \Illuminate\Http\JsonResponse
    {
        $id = $request->get('id');
        $info = User::find($id);
        return updateModelStatus($info);
    }

    //////////////////////////////////////////////
    public function assign($user, $roleId)
    {
        $role = Role::findById($roleId);
        if ($role && $user) {
            $user->assignRole($role->name);
        }
    }

    //////////////////////////////////////////////
    public function revoke($user, $roleId)
    {
        $role = Role::findById($roleId);
        if ($role && $user) {
            $user->removeRole($role->name);
        }
    }
}
