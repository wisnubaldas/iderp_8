<?php

namespace App\Models\AcuraMaster;

use Illuminate\Database\Eloquent\Model;

class AreaJual extends Model
{
    protected $connection = 'cost';
    protected $table = 'm_area_jual';
    protected $fillable = ['kode', 'area','status','price_group'];
    // protected $primaryKey = 'coa_id';
    // protected $timestamp = false;

    // protected $casts = [
    //     'customer' => 'array',
    //     'tgl'=>'datetime:d-m-Y'
    // ];
    
    
}
