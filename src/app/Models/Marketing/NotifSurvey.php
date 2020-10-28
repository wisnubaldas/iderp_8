<?php

namespace App\Models\Marketing;

use Illuminate\Database\Eloquent\Model;

class NotifSurvey extends Model
{
    // protected $connection = 'acura_conn';
    protected $table = 'mr_notif_survey';
    // protected $primaryKey = 'id_brt';
    // protected $timestamp = false;
    protected $casts = [
        'customer' => 'array',
        'tgl'=>'datetime:d-m-Y'
    ];
    public function depo_detail()
    {
        return $this->hasOne('App\Models\Report\Depo', 'id_depo', 'depo');
    }
    public function status()
    {
        return $this->hasOne('App\Models\Marketing\StatusSurvey', 'id', 'status_id');
    }
    public function ukuran()
    {
        return $this->hasOne('App\Models\Blog\Ukuran', 'id', 'ukuran_id');
    }
    public function image()
    {
        return $this->hasMany('App\Models\Marketing\ImageSurvey', 'notif_id', 'id');
    }
    public function depo_survey()
    {
        return $this->hasOne('App\Models\Marketing\DepoSurvey','notif_id','id');
    }
    
}
