<?php

namespace App\Models\Marketing;

use Illuminate\Database\Eloquent\Model;

class DepoSurvey extends Model
{
    // protected $connection = 'acura_conn';
    protected $table = 'mr_depo_survey';
    // protected $primaryKey = 'id_brt';
    protected $casts = [
        'customer' => 'array',
        's_start'=>'datetime:d-m-Y H:i:s',
        's_end'=>'datetime:d-m-Y H:i:s'
    ];
    protected $fillable = ['notif_id'];
    // public function depo()
    // {
    //     return $this->hasOne('App\Models\Report\Depo', 'id_depo', 'depo');
    // }
    public function status()
    {
        return $this->hasOne('App\Models\Marketing\StatusSurvey', 'id', 'status_id');
    }
    public function notif()
    {
        return $this->hasOne('App\Models\Marketing\NotifSurvey', 'id', 'notif_id');
    }
    // public function ukuran()
    // {
    //     return $this->hasOne('App\Models\Blog\Ukuran', 'id', 'ukuran');
    // }
}
