<?php

namespace App\Models\Report;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $connection = 'acura_conn';
    protected $table = 'item';
    protected $primaryKey = 'kode_item';
}
