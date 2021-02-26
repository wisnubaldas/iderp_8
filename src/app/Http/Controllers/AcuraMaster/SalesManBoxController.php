<?php

namespace App\Http\Controllers\AcuraMaster;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AcuraMaster\SalesBox;
use DataTables;
class SalesManBoxController extends Controller
{
    public $head_salesman = ['id','salesman_id','tgl_1','tgl_2','jml'];
    public $form_data = [
        ['name'=>'id','id'=>'id','type'=>'input','attribute'=>'readonly'],
        ['name'=>'salesman_id','id'=>'salesman_id','type'=>'input'],
        ['name'=>'tgl_1','id'=>'tgl_2','type'=>'date'],
        ['name'=>'tgl_2','id'=>'tgl_2','type'=>'date'],
        ['name'=>'jml','id'=>'jml','type'=>'input'],
    ];
    public function index()
    {
        return view('backend.master-acura.salesbox')
                ->with('form_input',$this->form_data)
                ->with('salesman',array_merge($this->head_salesman, ['depo','action']));
    }
    public function grid()
    {
        $sal = SalesBox::with(['salesman'=>function($q){
                return $q->with('depo');
        }])->select($this->head_salesman);
        return DataTables::eloquent($sal)
                        ->addColumn('action', function ($man) {
                             $r = '<div class="btn-group">';
                             $r .= '<button data-link="'.url('acura-master/salesmanbox/edit/'.$man->id).'" onClick="getEdit(this)"  class="btn btn-xs btn-primary edit_sales"><i class="fa fa-scissors" aria-hidden="true"></i> Edit</button>';
                             $r .= '<a href="/delete/'.$man->id.'" class="btn btn-xs btn-danger"><i class="fa fa-eraser" aria-hidden="true"></i> Delete</a>';
                             $r .= '</div>';
                             return $r;
                        })
                        ->addColumn('depo', function ($man) {
                            return $man->salesman->depo->nama_depo;
                       })
                        ->editColumn('salesman_id',function($man){
                            return $man->salesman->name;
                        })
                        ->toJson();
    }
    
    public function edit($id)
    {
        $sal = SalesBox::find($id);
        $data = [
            ['value'=>$sal->id,'name'=>'id','id'=>'id','type'=>'input','attribute'=>'readonly'],
            ['value'=>$sal->id_sales,'name'=>'id_sales','id'=>'id_sales','type'=>'input'],
            ['value'=>$sal->tgl_1,'name'=>'tgl_1','id'=>'tgl_1','type'=>'date'],
            ['value'=>$sal->tgl_2,'name'=>'tgl_2','id'=>'tgl_2','type'=>'date'],
            ['value'=>$sal->jml,'name'=>'jml','id'=>'jml','type'=>'input'],
        ];
        
        return view('components.form.modal')
                ->with('form_input',$data)
                ->render();
    }
    public function save(Request $request)
    {
        $sal = SalesBox::updateOrCreate(['id' => $request->id],[
            'id_sales'=>$request->id_sales, 'tgl_1'=>$request->tgl_1,'tgl_2'=>$request->tgl_2, 'jml'=>$request->jml
        ]);
        // $sal->id_sales = $request->id_sales; 
        // $sal->name = $request->name;
        // $sal->tgl_masuk = $request->tgl_masuk;
        // $sal->save();
        return back();
    }
    
}
