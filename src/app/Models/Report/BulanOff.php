<?php

namespace App\Models\Report;

use Illuminate\Database\Eloquent\Model;

class BulanOff extends Model
{
    protected $connection = 'acura_conn';
    protected $table = 'bulan_off';
    protected $primaryKey = 'id_bo';
}
