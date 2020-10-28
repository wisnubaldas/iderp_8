<?php

namespace App\Models\Report;

use Illuminate\Database\Eloquent\Model;
use JamesDordoy\LaravelVueDatatable\Traits\LaravelVueDatatableTrait;
class MasterTarget extends Model
{
    use LaravelVueDatatableTrait;
    public $table = 'm_target';
    protected $hidden = ['created_at','updated_at'];
    protected $fillable = ['m_depo_id', 'target'];

    // public function sub_menu()
    // {
    //     return $this->hasMany('App\Models\Admin\MenuModel', 'parent_id');
    // }
    // public function parent()
    // {
    //     return $this->belongsTo('App\Models\Admin\MenuModel', 'id');
    // }
}
