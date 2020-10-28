<?php

namespace App\Models\Report;

use Illuminate\Database\Eloquent\Model;

class BarangRetur extends Model
{
    protected $connection = 'acura_conn';
    protected $table = 'barang_retur';
    protected $primaryKey = 'id_brt';
}
