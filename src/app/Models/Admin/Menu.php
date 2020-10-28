<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
class Menu extends Model
{
    public $table = 'menus';
    protected $hidden = ['created_at','updated_at'];
    protected $fillable = ['menu_modules_id', 'parent_id', 'title', 'icon', 'url', 'caret', 'active'];

    public function sub_menu()
    {
        return $this->hasMany('App\Models\Admin\MenuModel', 'parent_id');
    }
    public function parent()
    {
        return $this->belongsTo('App\Models\Admin\MenuModel', 'id');
    }
    public function column()
    {
        return $this->fillable;
    }
}
