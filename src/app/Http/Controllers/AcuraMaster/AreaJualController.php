<?php

namespace App\Http\Controllers\AcuraMaster;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AcuraMaster\AreaJual;
use DataTables;
class AreaJualController extends Controller
{
    public $head_salesman = ['id','kode','area','status','price_group'];
    public $form_data = [
        ['name'=>'id','id'=>'id','type'=>'input','attribute'=>'readonly'],
        ['name'=>'kode','id'=>'kode','type'=>'input'],
        ['name'=>'area','id'=>'area','type'=>'input'],
        ['name'=>'status','id'=>'status','type'=>'input'],
        ['name'=>'price_group','id'=>'price_group','type'=>'input'],
    ];
    public function index()
    {
        return view('backend.master-acura.area-jual')
                ->with('form_input',$this->form_data)
                ->with('salesman',array_merge($this->head_salesman, ['action']));
    }
    public function grid()
    {
        $sal = AreaJual::select($this->head_salesman);
        return DataTables::eloquent($sal)
                        ->addColumn('action', function ($man) {
                             $r = '<div class="btn-group">';
                             $r .= '<button data-link="'.url('acura-master/area_jual/edit/'.$man->id).'" onClick="getEdit(this)"  class="btn btn-xs btn-primary edit_sales"><i class="fa fa-scissors" aria-hidden="true"></i> Edit</button>';
                             $r .= '<a href="/delete/'.$man->id.'" class="btn btn-xs btn-danger"><i class="fa fa-eraser" aria-hidden="true"></i> Delete</a>';
                             $r .= '</div>';
                             return $r;
                        })
                        ->toJson();
    }
    
    public function edit($id)
    {
        $sal = AreaJual::find($id);
        $data = [
            ['value'=>$sal->id,'name'=>'id','id'=>'id','type'=>'input','attribute'=>'readonly'],
            ['value'=>$sal->kode,'name'=>'kode','id'=>'kode','type'=>'input'],
            ['value'=>$sal->area,'name'=>'area','id'=>'area','type'=>'input'],
            ['value'=>$sal->price_group,'name'=>'price_group','id'=>'price_group','type'=>'input'],
            ['value'=>$sal->status,'name'=>'status','id'=>'status','type'=>'boolean'],
        ];
        
        return view('components.form.modal')
        ->with('form_input',$data)
        ->render();
    }
    public function save(Request $request)
    {
        $sal = AreaJual::updateOrCreate(['id' => $request->id],[
            'kode'=>$request->kode, 'area'=>$request->area,'price_group'=>$request->price_group,'status'=>$request->status
        ]);
        return back();
    }
    
    
}
