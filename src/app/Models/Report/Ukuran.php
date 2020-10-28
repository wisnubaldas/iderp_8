<?php

namespace App\Models\Report;

use Illuminate\Database\Eloquent\Model;

class Ukuran extends Model
{
    protected $connection = 'acura_conn';
    protected $table = 'ukuran';
    protected $primaryKey = 'kode_ukuran';
}
