<?php

namespace App\Models\Report;

use Illuminate\Database\Eloquent\Model;

class BarangUmur extends Model
{
    protected $connection = 'acura_conn';
    protected $table = 'barang_umur';
    protected $primaryKey = 'id_bum';
}
