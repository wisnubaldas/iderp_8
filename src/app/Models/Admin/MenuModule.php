<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class MenuModule extends Model
{
    protected $hidden = ['created_at','updated_at'];
    public function menus()
    {
        return $this->hasMany('App\Models\Admin\Menu', 'menu_modules_id');
    }
    public function users()
    {
        return $this->belongsToMany('App\Models\User','user_module')->using('App\Models\Admin\UserModule');
    }
}
