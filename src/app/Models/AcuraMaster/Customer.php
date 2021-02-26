<?php

namespace App\Models\AcuraMaster;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $connection = 'cost';
    protected $table = 'm_customer';
    protected $fillable = ['code',
                            'cjn_code',
                            'cgr_code',
                            'wil_code',
                            'cus_name',
                            'cus_cont',
                            'cus_limit',
                            'cus_tenr',
                            'cus_rekg',
                            'cus_desc',
                            'limit_toleransi',
                            'status'];
    // protected $primaryKey = 'coa_id';
    // protected $timestamp = false;

    // protected $casts = [
    //     'customer' => 'array',
    //     'tgl'=>'datetime:d-m-Y'
    // ];
    public static function fieldset()
    {
        return \Schema::Connection('cost')->getColumnListing('m_customer');
    }
    
}
