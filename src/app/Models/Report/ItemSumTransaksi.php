<?php

namespace App\Models\Report;

use Illuminate\Database\Eloquent\Model;

class ItemSumTransaksi extends Model
{
    protected $connection = 'acura_conn';
    protected $table = 'item_sum_transaksi';
    protected $primaryKey = 'id_ist';
}
