<?php

namespace App\Models\Report;

use Illuminate\Database\Eloquent\Model;

class BarangTransaksi extends Model
{
    protected $connection = 'acura_conn';
    protected $table = 'barang_transaksi';
    protected $primaryKey = 'id_btr';
}
