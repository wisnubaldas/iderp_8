<?php

namespace App\Models\Report;

use Illuminate\Database\Eloquent\Model;

class ItemGjb extends Model
{
    protected $connection = 'acura_conn';
    protected $table = 'item_gjb';
    protected $primaryKey = 'kode_item';
}
