<?php

namespace App\Models\Report;

use Illuminate\Database\Eloquent\Model;

class ItemUmur extends Model
{
    protected $connection = 'acura_conn';
    protected $table = 'item_umur';
    protected $primaryKey = 'kode_item';
    protected $keyType = 'string';
}
