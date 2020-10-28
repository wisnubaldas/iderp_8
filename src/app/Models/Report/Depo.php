<?php

namespace App\Models\Report;

use Illuminate\Database\Eloquent\Model;

class Depo extends Model
{
    protected $connection = 'acura_conn';
    protected $table = 'depo';
    protected $primaryKey = 'id_depo';
    protected $keyType = 'string';
    public $incrementing = false;

    public function depo_regional()
    {
        return $this->hasOne('App\Models\Report\Regional', 'id_reg', 'id_reg');
    }
}
