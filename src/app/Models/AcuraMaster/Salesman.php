<?php

namespace App\Models\AcuraMaster;

use Illuminate\Database\Eloquent\Model;

class Salesman extends Model
{
    protected $connection = 'cost';
    protected $table = 'm_salesman';
    protected $fillable = ['id_sales', 'name', 'tgl_masuk','status','m_depo_id'];
    // protected $primaryKey = 'coa_id';
    // protected $timestamp = false;

    // protected $casts = [
    //     'customer' => 'array',
    //     'tgl'=>'datetime:d-m-Y'
    // ];
    
    public function depo()
    {
        return $this->belongsTo(Depo::class,'m_depo_id');
    }
    public function salesman_box()
    {
        return $this->hasMany(SalesBox::class);
    }
}
