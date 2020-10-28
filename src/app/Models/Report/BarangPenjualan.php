<?php

namespace App\Models\Report;

use Illuminate\Database\Eloquent\Model;

class BarangPenjualan extends Model
{
    protected $connection = 'acura_conn';
    protected $table = 'barang_penjualan';
    protected $primaryKey = 'id_bpj';
    // protected $dateFormat = 'Asia/Jakarta';
    public function retur()
    {
        return $this->hasOne('App\Models\Acura\BarangRetur','kode_barang','kode_barang');
    }
}
