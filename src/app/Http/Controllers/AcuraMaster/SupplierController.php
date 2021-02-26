<?php

namespace App\Http\Controllers\AcuraMaster;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AcuraMaster\Supplier;
use Illuminate\Support\Facades\Schema;
use DataTables;
class SupplierController extends Controller
{
    public $head;
    public $form_data;
    public function __construct()
    {
        $x = Supplier::fieldset();
        unset($x[18]);
        unset($x[17]);
        $this->head = $x; 
        $this->form_data($this->head);
    }
    public function index()
    {
        return view('backend.master-acura.supplier')->with('form_input',$this->form_data)
        ->with('salesman',array_merge($this->head, ['action']));
             
    }
    public function grid()
    {
        
        $sal = Supplier::select($this->head);
        return DataTables::eloquent($sal)
                ->addColumn('action', function ($man) {
                        $r = '<div class="btn-group">';
                        $r .= '<button data-link="'.url('acura-master/salesman/edit/'.$man->id).'" onClick="getEdit(this)"  class="btn btn-xs btn-primary edit_sales"><i class="fa fa-scissors" aria-hidden="true"></i> Edit</button>';
                        $r .= '<a href="/delete/'.$man->id.'" class="btn btn-xs btn-danger"><i class="fa fa-eraser" aria-hidden="true"></i> Delete</a>';
                        $r .= '</div>';
                        return $r;
                })
                ->toJson();
    }

    public function edit($id)
    {
        $sal = Supplier::find($id);
        $data = [
            ['value'=>$sal->id,'name'=>'id','id'=>'id','type'=>'input','attribute'=>'readonly'],
            ['value'=>$sal->id_sales,'name'=>'id_sales','id'=>'id_sales','type'=>'input'],
            ['value'=>$sal->name,'name'=>'name','id'=>'name','type'=>'input'],
            ['value'=>$sal->tgl_masuk,'name'=>'tgl_masuk','id'=>'tgl_masuk','type'=>'date'],
            ['value'=>$sal->status,'name'=>'status','id'=>'status','type'=>'boolean'],
        ];
        
        return view('components.form.modal')
        ->with('form_input',$data)
        ->render();
    }

    public function save(Request $request)
    {
        $sal = Supplier::updateOrCreate(['id' => $request->id],[
            'id_sales'=>$request->id_sales, 'name'=>$request->name,'tgl_masuk'=>$request->tgl_masuk
        ]);
        // $sal->id_sales = $request->id_sales; 
        // $sal->name = $request->name;
        // $sal->tgl_masuk = $request->tgl_masuk;
        // $sal->save();
        return back();
    }

    protected function form_data($data)
    {
        $this->form_data = collect($data)->transform(function ($item, $key) {
            switch ($key) {
                case 18:
                    return null;
                    break;
                case 17:
                    return null;
                    break;
                default:
                return  ['name'=>$item,'id'=>$item,'type'=>'input'];
            }
        })->filter()->toArray();
    }
}
