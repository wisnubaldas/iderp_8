<?php

namespace App\Models\Report;

use Illuminate\Database\Eloquent\Model;

class BarangMpo extends Model
{
    protected $connection = 'acura_conn';
    protected $table = 'barang_mpo';
    protected $primaryKey = 'id_bmp';
}
