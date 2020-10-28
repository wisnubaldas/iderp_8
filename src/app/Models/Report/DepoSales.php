<?php

namespace App\Models\Report;

use Illuminate\Database\Eloquent\Model;

class DepoSales extends Model
{
    protected $connection = 'acura_conn';
    protected $table = 'depo_sales';
    protected $primaryKey = 'id_dsl';
}
