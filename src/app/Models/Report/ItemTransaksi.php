<?php

namespace App\Models\Report;

use Illuminate\Database\Eloquent\Model;

class ItemTransaksi extends Model
{
    protected $connection = 'acura_conn';
    protected $table = 'item_transaksi';
    protected $primaryKey = 'id_itr';
}
