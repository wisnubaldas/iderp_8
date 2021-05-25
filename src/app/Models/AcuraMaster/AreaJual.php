<?php

namespace App\Models\AcuraMaster;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class AreaJual extends Model
{
    protected $connection = 'cost';
    protected $table = 'area_jual';
    protected $fillable = ['kode', 'area','status','price_group','m_depo_id'];
    // protected $primaryKey = 'coa_id';
    // protected $timestamp = false;

    // protected $casts = [
    //     'customer' => 'array',
    //     'tgl'=>'datetime:d-m-Y'
    // ];
    
    public function depo()
    {
        return $this->belongsTo(Depo::class,'m_depo_id');
    }
    public function newQuery($excludeDeleted = true) {
        $userDepo = Auth::user()->m_depo_id;
        if($userDepo)
        {
            return parent::newQuery($excludeDeleted)->where('m_depo_id', '=', $userDepo);
        }
        return parent::newQuery($excludeDeleted);
        
    }

}
