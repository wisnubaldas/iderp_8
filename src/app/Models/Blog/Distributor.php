<?php

namespace App\Models\Blog;

use Illuminate\Database\Eloquent\Model;
use JamesDordoy\LaravelVueDatatable\Traits\LaravelVueDatatableTrait;
class Distributor extends Model
{
    use LaravelVueDatatableTrait;
    protected $hidden = ['created_at','updated_at'];
    protected $table = 'b_distributors';
    protected $dataTableColumns = [ 'id'=>[],'marker'=>[],'lokasi'=>[],'alamat'=>[],'phone_1'=>[],'phone_2'=>[],'fax'=>[],'perusahaan'=>[]];

    protected $dataTableRelationships = [
        //
    ];

}
