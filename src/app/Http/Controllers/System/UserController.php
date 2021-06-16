<?php

namespace App\Http\Controllers\System;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\AcuraMaster\Depo;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;
use App\Traits\UserTrait;
use DataTables;
class UserController extends Controller
{
    use UserTrait;
    
    public function __construct() {
        $this->get_option();
    }
    public function index($grid = null)
    {
        if($grid)
        {
            return $this->user_grid();
        }
        return view('backend.system.user');
    }

    
    public function add_user()
    {
        return view('backend.system.user_add');
    }
    public function set_active(Request $request)
    {
        $user = User::find($request->id);
        if($user->active == 0){
            $user->active = 1;
        }else{
            $user->active = 0;
        }
        $user->save();
    }
    public function add_role(Request $request)
    {
        if($request->isMethod('POST'))
        {
            $request->validate([
                'role'=>'required'
            ]);

            Role::create(['name'=>$request->role]);
            return back();
        }
        $role_permission = Role::with('permissions')->get();
        $role = Role::pluck('name', 'id');
        $permission = Permission::pluck('name','id');
        return view('backend.system.role',compact('role','role_permission','permission'));
    }
    public function delete_role($id)
    {
        Role::find($id)->delete();
        return back();
    }
    public function add_permission(Request $request)
    {
        if($request->isMethod('POST'))
        {
            $request->validate([
                'permission'=>'required'
            ]);
            Permission::create(['name'=>$request->permission]);
            return back();
        }
        $per = Permission::pluck('name', 'id');
        return view('backend.system.permission',compact('per'));
    }
    public function delete_permission($id)
    {
        Permission::find($id)->delete();
        return back();
    }
    // sync role and permision
    public function async_can($id_role,$method,$id_permission)
    {
        $this->syncron_role_permission($id_role,$method,$id_permission);
        return back();
    }
    public function save_user(Request $request)
    {
         User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        return back();
    }
    public function delete_user($id)
    {
        User::find($id)->delete();
        return back();
    }
}
