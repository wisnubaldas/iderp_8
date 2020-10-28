<?php

namespace App\Models\Report;

use Illuminate\Database\Eloquent\Model;

class ItemProduksi extends Model
{
    protected $connection = 'acura_conn';
    protected $table = 'item_produksi';
    protected $primaryKey = 'kode_item';
}
