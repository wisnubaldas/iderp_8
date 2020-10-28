<?php

namespace App\Models\Report;

use Illuminate\Database\Eloquent\Model;

class BarangBeli extends Model
{
    protected $connection = 'acura_conn';
    protected $table = 'barang_beli';
    protected $primaryKey = 'id_bel';
}
