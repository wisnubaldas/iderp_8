<?php

namespace App\Models\Report;

use Illuminate\Database\Eloquent\Model;

class Regional extends Model
{
    protected $connection = 'acura_conn';
    protected $table = 'regional';
    protected $primaryKey = 'id_reg';
    public $incrementing = false;
    // In Laravel 6.0+ make sure to also set $keyType
    protected $keyType = 'string';
    public function depo_regional()
    {
        return $this->hasMany('App\Models\Report\Depo', 'id_reg', 'id_reg');
    }
}
