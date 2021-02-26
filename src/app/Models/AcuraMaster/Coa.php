<?php

namespace App\Models\AcuraMaster;

use Illuminate\Database\Eloquent\Model;

class Coa extends Model
{
    // protected $connection = 'cost';
    protected $table = 'm_coa';
    // protected $primaryKey = 'coa_id';
    // protected $timestamp = false;

    // protected $casts = [
    //     'customer' => 'array',
    //     'tgl'=>'datetime:d-m-Y'
    // ];
    public function depo()
    {
        return $this->belongsToMany(Depo::class)->using(CoaDepo::class)->withPivot('coa_id', 'depo_id');
    }
    
}
