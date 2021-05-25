<?php

namespace App\Models\AcuraMaster;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
class Salesman extends Model
{
    // protected $connection = 'cost';
    protected $table = 'salesman';
    protected $fillable = ['id_sales', 'name', 'tgl_masuk','status','depo_id'];
    protected $primaryKey = 'id';
    // protected $timestamp = false;

    // protected $casts = [
    //     'customer' => 'array',
    //     'tgl'=>'datetime:d-m-Y'
    // ];
    
    public function depo()
    {
        return $this->belongsTo(Depo::class,'depo_id');
    }
    public function salesman_box()
    {
        return $this->hasMany(SalesBox::class);
    }

    // public function newQuery($excludeDeleted = true) {
    //     $userDepo = Auth::user()->m_depo_id;
    //     if($userDepo)
    //     {
    //         return parent::newQuery($excludeDeleted)->where('m_depo_id', $userDepo);
    //     }
    //     return parent::newQuery($excludeDeleted);
        
    // }
}
