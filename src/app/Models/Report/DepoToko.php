<?php

namespace App\Models\Report;

use Illuminate\Database\Eloquent\Model;

class DepoToko extends Model
{
    protected $connection = 'acura_conn';
    protected $table = 'depo_toko';
    protected $primaryKey = 'id_dtk';
}
