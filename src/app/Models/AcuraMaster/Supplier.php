<?php

namespace App\Models\AcuraMaster;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
class Supplier extends Model
{
    protected $connection = 'cost';
    protected $table = 'm_supplier';
    protected $fillable = ['code', 'name','addr_1','addr_2','city','zip_code','phone_1','phone_2','fax','npwp','limit','hari','rekening','coa_id','sup_desc','status'];
    // protected $primaryKey = 'coa_id';
    // protected $timestamp = false;

    // protected $casts = [
    //     'customer' => 'array',
    //     'tgl'=>'datetime:d-m-Y'
    // ];
    public static function fieldset()
    {
        return Schema::Connection('cost')->getColumnListing('m_supplier');
    }
    
}
