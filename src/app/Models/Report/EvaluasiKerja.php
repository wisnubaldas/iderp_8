<?php

namespace App\Models\Report;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \Carbon\Carbon;
class EvaluasiKerja extends Model
{
    use HasFactory;
    protected $table = 'evaluasi_kerja';
    protected $fillable = ['depo_id','user_id','tgl','data_depo','data_form','data_param'];
    public function getTglAttribute($value)
    {
        return Carbon::parse($value)->format('Y-m');
    }
    public function user()
    {
        return $this->hasOne(\App\Models\User::class,'id','user_id');
    }
}
