<?php

namespace App\Models\Report;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TargetLama extends Model
{
    use HasFactory;
    protected $table = 'target_lama';
    protected $fillable = ['depo_id','tgl','qty','profit'];
}
