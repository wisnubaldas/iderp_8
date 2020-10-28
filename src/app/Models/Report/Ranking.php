<?php

namespace App\Models\Report;

use Illuminate\Database\Eloquent\Model;

class Ranking extends Model
{
    protected $table = 'r_ranking';
    protected $fillable = ['date','data_ranking'];
}
