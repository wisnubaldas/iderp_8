<?php

namespace App\Models\Report;

use Illuminate\Database\Eloquent\Model;

class TmpStok extends Model
{
    protected $table = 'tmp_r_stok';
    protected $fillable = ['id_depo','kode_barang','kw','tg_jual','umur','rppb','stok','tgl_lahir'];
}
