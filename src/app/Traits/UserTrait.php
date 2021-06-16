<?php

namespace App\Traits;
use App\Models\User;
use DataTables;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

trait UserTrait
{
    public $roles;
    public $permissions;
    
    public function get_option()
    {
        $this->roles = Role::pluck('name', 'id');
        $this->permissions = Permission::pluck('name', 'id');
        return $this;
    }

    public function syncron_role_permission($id_role,$method,$id_permission)
    {
        if($method == 'role')
        {
            $permission = Permission::find($id_permission);
            $role = Role::find($id_role)->givePermissionTo($permission);
        }
        if($method == 'revoke_role')
        {
            $permission = Permission::find($id_permission);
            $role = Role::find($id_role)->revokePermissionTo($permission);
        }
        if($method == 'user-roles')
        {
            User::find($id_role)->assignRole($id_permission);
        }
        if($method == 'user-permissions')
        {
            User::find($id_role)->givePermissionTo($id_permission);
        }
    }
    public function user_grid()
    {
        $users = User::select(['id','name','email','updated_at','depo_id','active'])->with(['permissions','roles']);
        return Datatables::of($users)
        ->addColumn('action', function ($user) {
            $r = $p = '';
            foreach ($this->get_option()->roles as $i => $v) {
                if(in_array($v,$user->roles->pluck('name')->toArray()))
                {
                        $ac = '<i class="fa fa-check float-right" aria-hidden="true"></i>';
                        $bg = 'bg-warning'; 
                }else{
                        $ac = $bg = '';
                }
                $r .= '<a class="dropdown-item '.$bg.'" href="/system/async/'.$user->id.'/user-roles/'.$i.'">'.ucfirst($v).' '.$ac.'</a>';
            }
            foreach ($this->get_option()->permissions as $i => $v) {
                if(in_array($v,$user->permissions->pluck('name')->toArray()))
                {
                        $ac = '<i class="fa fa-check float-right" aria-hidden="true"></i>';
                        $bg = 'bg-success'; 
                }else{
                        $ac = $bg = '';
                }
                $p .= '<a class="dropdown-item '.$bg.'" href="/system/async/'.$user->id.'/user-permissions/'.$i.'">'.ucfirst($v).' '.$ac.'</a>';
            }
            $button = '<div class="btn-group">';
            $button .= '<a href="#edit-'.$user->id.'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
            $button .= '<a href="/system/delete-user/'.$user->id.'" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-edit"></i> Delete</a>';
            $button .= '<div class="dropdown">
                            <a href="javascript:;" class="btn btn-warning btn-xs dropdown-toggle" type="button" id="dropdownMenuButton2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-plus" aria-hidden="true"></i> Roles
                            </a>
                            <div class="dropdown-menu scrollable-menu" aria-labelledby="dropdownMenuButton2">'.
                             $r     
                            .'</div>
                        </div>';
            $button .= '<div class="dropdown">
                            <button href="javascript:;" class="btn btn-success btn-xs dropdown-toggle" type="button" id="dropdownMenuButton2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-plus" aria-hidden="true"></i> Permission
                            </button>
                            <div class="dropdown-menu scrollable-menu" aria-labelledby="dropdownMenuButton2">'.
                            $p     
                            .'</div>
                        </div>';
            $button .= '</div>';
            return $button;
        })
        ->editColumn('updated_at',function($user){
            return $user->updated_at->format('d F Y H:i:s');
        })
        ->editColumn('active', function($user){
                if($user->active == 1)
                {
                    $cek = 'checked';
                }else{
                    $cek = '';
                }
                return '<div class="switch">
                <div class="onoffswitch">
                    <input type="checkbox" '.$cek.' class="onoffswitch-checkbox" data-user="'.$user->id.'" id="edit-'.$user->id.'" data-active="'.$user->active.'" onchange="handleChange(this);">
                    <label class="onoffswitch-label" for="edit-'.$user->id.'">
                        <span class="onoffswitch-inner"></span>
                        <span class="onoffswitch-switch"></span>
                    </label>
                </div>
            </div>';
        })
        ->rawColumns(['active','action','permission'])
        ->make();
    }
}