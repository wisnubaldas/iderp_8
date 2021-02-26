<?php

namespace App\Http\Controllers\AcuraMaster;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AcuraMaster\AngkutanH;
use DataTables;
class AngkutanController extends Controller
{
    public $head_salesman = ['id','kode','tipe_angkutan','tipe_harga','tipe_jalan','status'];
    public $form_data = [
        ['name'=>'id','id'=>'id','type'=>'input','attribute'=>'readonly'],
        ['name'=>'kode','id'=>'kode','type'=>'input'],
        ['name'=>'tipe_angkutan','id'=>'tipe_angkutan','type'=>'select','data'=>[
            ['id'=>'Truk Pick Up','value'=>'TPU'],
            ['id'=>'Truk Colt Diesel Engkel','value'=>'TCDE'],
            ['id'=>'Truk Colt Diesel Double','value'=>'TCDD'],
            ['id'=>'Truk Fuso','value'=>'TF'],
            ['id'=>'Truk Tronton','value'=>'TTn'],
            ['id'=>'Truk Wingbox','value'=>'TW'],
            ['id'=>'Truk Trailer','value'=>'TTr'],
            ['id'=>'Truk Container','value'=>'TC'],
        ]],
        ['name'=>'tipe_harga','id'=>'tipe_harga','type'=>'select','data'=>[
            ['id'=>'Harga Perjalanan','value'=>'Harga Perjalanan'],
            ['id'=>'Harga Berat KG','value'=>'Harga Berat KG']
        ]],
        ['name'=>'tipe_jalan','id'=>'tipe_jalan','type'=>'select','data'=>[
            ['id'=>'Dalam Kota','value'=>'DK'],
            ['id'=>'Luar Kota','value'=>'LK'],
            ['id'=>'Antar Pulau','value'=>'AP'],
        ]],
        ['name'=>'status','id'=>'status','type'=>'select','data'=>[
            ['id'=>'Active','value'=>1],
            ['id'=>'Deactive','value'=>0],
        ]],
    ];
    public function index()
    {
        return view('backend.master-acura.angkutan')
                ->with('form_input',$this->form_data)
                ->with('salesman',array_merge($this->head_salesman, ['action']));
    }
    public function grid()
    {
        $sal = AngkutanH::select($this->head_salesman);
        return DataTables::eloquent($sal)
                        ->addColumn('action', function ($man) {
                             $r = '<div class="btn-group">';
                             $r .= '<button data-link="'.url('acura-master/angkutan/edit/'.$man->id).'" onClick="getEdit(this)"  class="btn btn-xs btn-primary edit_sales"><i class="fa fa-scissors" aria-hidden="true"></i> Edit</button>';
                             $r .= '<a href="/delete/'.$man->id.'" class="btn btn-xs btn-danger"><i class="fa fa-eraser" aria-hidden="true"></i> Delete</a>';
                             $r .= '</div>';
                             return $r;
                        })
                        ->toJson();
    }
    
    public function edit($id)
    {
        $sal = AngkutanH::find($id);
        $data = [
            ['value'=>$sal->id,'name'=>'id','id'=>'id','type'=>'input','attribute'=>'readonly'],
            ['value'=>$sal->kode,'name'=>'kode','id'=>'kode','type'=>'input'],
            ['value'=>$sal->tipe_angkutan,'name'=>'tipe_angkutan','id'=>'tipe_angkutan','type'=>'input'],
            ['value'=>$sal->tipe_harga,'name'=>'tipe_harga','id'=>'tipe_harga','type'=>'input'],
            ['value'=>$sal->tipe_jalan,'name'=>'tipe_jalan','id'=>'tipe_jalan','type'=>'input'],
            ['value'=>$sal->status,'name'=>'status','id'=>'status','type'=>'input'],
        ];
        
        return view('components.form.modal')
        ->with('form_input',$data)
        ->render();
    }
    public function save(Request $request)
    {
        // dd($request->all());
        $sal = AngkutanH::updateOrCreate(['id' => $request->id],[
            'kode'=>$request->kode, 'tipe_angkutan'=>$request->tipe_angkutan,'tipe_harga'=>$request->tipe_harga,'tipe_jalan'=>$request->tipe_jalan,'status'=>$request->status
        ]);
        return back();
    }
    
}
