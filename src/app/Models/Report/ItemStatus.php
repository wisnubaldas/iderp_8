<?php

namespace App\Models\Report;

use Illuminate\Database\Eloquent\Model;

class ItemStatus extends Model
{
    protected $connection = 'acura_conn';
    protected $table = 'item_status';
    protected $primaryKey = 'kode_item';
    public $incrementing = false;
    // In Laravel 6.0+ make sure to also set $keyType
    protected $keyType = 'string';
}
