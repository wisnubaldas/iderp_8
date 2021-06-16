<?php

namespace App\Models\Report;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RataPencapaian extends Model
{
    use HasFactory;
    protected $table = 'rata_pencapaian';
    protected $fillable = ['depo_id','tgl','qty','profit'];
}
