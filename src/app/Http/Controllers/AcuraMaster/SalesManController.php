<?php

namespace App\Http\Controllers\AcuraMaster;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AcuraMaster\Salesman;
use DataTables;
class SalesManController extends Controller
{
    public $head_salesman = ['id','id_sales','name','tgl_masuk','status'];
    public $form_data = [
        ['name'=>'id','id'=>'id','type'=>'input','attribute'=>'readonly'],
        ['name'=>'id_sales','id'=>'id_sales','type'=>'input'],
        ['name'=>'name','id'=>'name','type'=>'input'],
        ['name'=>'tgl_masuk','id'=>'tgl_masuk','type'=>'date'],
        ['name'=>'status','id'=>'status','type'=>'boolean'],
    ];
    public function index(Request $request)
    {
        if ($request->ajax()) {
            if($request->active == 0)
            {
                return Salesman::find($request->id)->update(['status'=>1]);
            }
            return Salesman::find($request->id)->update(['status'=>0]);
        }

        return view('backend.master-acura.salesman')
                ->with('form_input',$this->form_data)
                ->with('salesman',array_merge($this->head_salesman, ['depo','status','action']));
    }
    public function grid()
    {
        $query =  Salesman::with('depo')->select('salesman.*');
        return DataTables::eloquent($query)
                            ->addColumn('action', function ($man) {
                                    $r = '<div class="btn-group">';
                                    $r .= '<button data-link="'.url('acura-master/salesman/edit/'.$man->id).'" onClick="getEdit(this)"  class="btn btn-xs btn-primary edit_sales"><i class="fa fa-scissors" aria-hidden="true"></i> Edit</button>';
                                    $r .= '<a href="/delete/'.$man->id.'" class="btn btn-xs btn-danger"><i class="fa fa-eraser" aria-hidden="true"></i> Delete</a>';
                                    $r .= '</div>';
                                    return $r;
                            })
                            ->addColumn('depo', function ($man) {
                                return $man->depo->nama_depo;
                            })
                            ->editColumn('status', function($user){
                                    if($user->status == 1)
                                    {
                                        $cek = 'checked';
                                    }else{
                                        $cek = '';
                                    }
                                    return '<div class="switch">
                                    <div class="onoffswitch">
                                        <input type="checkbox" '.$cek.' class="onoffswitch-checkbox" data-user="'.$user->id.'" id="edit-'.$user->id.'" data-active="'.$user->status.'" onchange="handleChange(this);">
                                        <label class="onoffswitch-label" for="edit-'.$user->id.'">
                                            <span class="onoffswitch-inner"></span>
                                            <span class="onoffswitch-switch"></span>
                                        </label>
                                    </div>
                                </div>';
                            })
                            ->rawColumns(['status','action'])
                            ->make(true);
    }
    
    public function edit($id)
    {
        $sal = Salesman::find($id);
        $data = [
            ['value'=>$sal->id,'name'=>'id','id'=>'id','type'=>'input','attribute'=>'readonly'],
            ['value'=>$sal->id_sales,'name'=>'id_sales','id'=>'id_sales','type'=>'input'],
            ['value'=>$sal->name,'name'=>'name','id'=>'name','type'=>'input'],
            ['value'=>$sal->tgl_masuk,'name'=>'tgl_masuk','id'=>'tgl_masuk','type'=>'date'],
            ['value'=>$sal->status,'name'=>'status','id'=>'status','type'=>'boolean'],
        ];
        
        return view('components.form.modal')->with('form_input',$data)->render();
    }
    public function save(Request $request)
    {
        $sal = Salesman::updateOrCreate(['id' => $request->id],[
            'id_sales'=>$request->id_sales, 'name'=>$request->name,'tgl_masuk'=>$request->tgl_masuk
        ]);
        // $sal->id_sales = $request->id_sales; 
        // $sal->name = $request->name;
        // $sal->tgl_masuk = $request->tgl_masuk;
        // $sal->save();
        return back();
    }
    
}
