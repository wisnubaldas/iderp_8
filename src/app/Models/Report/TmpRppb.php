<?php

namespace App\Models\Report;

use Illuminate\Database\Eloquent\Model;

class TmpRppb extends Model
{
    protected $table = 'tmp_r_rppb';
    protected $fillable = ['id_depo','kode_barang','kode_sj','kw','tg_jual','umur','net_jual','rppb','discontinue'];
}
