<?php

namespace App\Models\Blog;

use Illuminate\Database\Eloquent\Model;
class Ukuran extends Model
{
    protected $connection = 'cjfi';
    protected $hidden = ['created_at','updated_at'];
    protected $table = 'b_ukuran';
    // protected $dataTableColumns = [ 'id'=>[],'marker'=>[],'lokasi'=>[],'alamat'=>[],'phone_1'=>[],'phone_2'=>[],'fax'=>[],'perusahaan'=>[]];

    // protected $dataTableRelationships = [
    //     //
    // ];
}
