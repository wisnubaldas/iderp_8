<?php

namespace App\Models\AcuraMaster;

use Illuminate\Database\Eloquent\Model;

class Depo extends Model
{
    // protected $connection = 'cost';
    protected $table = 'depo';
    // protected $fillable = ['kode', 'tipe_angkutan','tipe_harga','tipe_jalan','status'];
    // protected $primaryKey = 'coa_id';
    // protected $timestamp = false;

    // protected $casts = [
    //     'customer' => 'array',
    //     'tgl'=>'datetime:d-m-Y'
    // ];
    public function coa()
    {
        return $this->belongsToMany(Coa::class)->using(CoaDepo::class);
    }
    
}
