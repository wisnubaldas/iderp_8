<?php

namespace App\Models\Report;

use Illuminate\Database\Eloquent\Model;

class ItemStok extends Model
{
    protected $connection = 'acura_conn';
    protected $table = 'item_stok';
    protected $primaryKey = 'id_st';
    // public $incrementing = false;
    // In Laravel 6.0+ make sure to also set $keyType
    // protected $keyType = 'string';
}
