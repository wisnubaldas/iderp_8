<?php

namespace App\Models\Report;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $connection = 'acura_conn';
    protected $table = 'brand';
    protected $primaryKey = 'kode_brand';
    public $incrementing = false;
    // In Laravel 6.0+ make sure to also set $keyType
    protected $keyType = 'string';
}
