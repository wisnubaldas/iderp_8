<?php

namespace App\Models\AcuraMaster;

use Illuminate\Database\Eloquent\Model;

class SalesBox extends Model
{
    protected $connection = 'cost';
    protected $table = 'salesman_box';
    protected $fillable = ['salesman_id', 'tgl_1', 'tgl_2','jml'];
    protected $primaryKey = 'id';
    // protected $timestamp = false;

    // protected $casts = [
    //     'customer' => 'array',
    //     'tgl'=>'datetime:d-m-Y'
    // ];

   
    public function salesman()
    {
        // return $this->hasOneThrough(
        //     Salesman::class,
        //     Depo::class,
        // );
        return $this->belongsTo(Salesman::class);
    }
}
