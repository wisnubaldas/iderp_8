<?php

namespace App\Models\AcuraMaster;

use Illuminate\Database\Eloquent\Relations\Pivot;

class CoaDepo extends Pivot
{
    // protected $connection = 'cost';
    protected $table = 'coa_depo';
    // protected $primaryKey = 'coa_id';
    // protected $timestamp = false;

    // protected $casts = [
    //     'customer' => 'array',
    //     'tgl'=>'datetime:d-m-Y'
    // ];
    public $incrementing = true;
    
}
