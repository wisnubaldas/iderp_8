<?php

namespace App\Models\AcuraMaster;

use Illuminate\Database\Eloquent\Model;

class AngkutanH extends Model
{
    protected $connection = 'cost';
    protected $table = 'angkutan_h';
    protected $fillable = ['kode', 'tipe_angkutan','tipe_harga','tipe_jalan','status'];
    // protected $primaryKey = 'coa_id';
    // protected $timestamp = false;

    // protected $casts = [
    //     'customer' => 'array',
    //     'tgl'=>'datetime:d-m-Y'
    // ];
    
    
}
