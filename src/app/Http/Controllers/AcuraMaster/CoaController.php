<?php

namespace App\Http\Controllers\AcuraMaster;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AcuraMaster\Coa;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\CoaImport;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;
use DataTables;
class CoaController extends Controller
{
    public $userDepo;
    public function index($coa = null)
    {
        $this->userDepo = auth()->user()->m_depo_id;
        if($coa)
        {
            return $this->grid($coa);
        }
        $coas =Coa::whereHas('depo', function (Builder $query) {
            if($this->userDepo){
                return $query->where('m_depo.id', '=', $this->userDepo);
            }
            return $query;
        })->get()->toArray();
        $tree = $this->buildTree($coas);

        return view('backend.master-acura.coa')
                    ->with('tree',$tree)
                    ->with('pageTitle',['name'=>'General Leadger','link'=>'#']);
    }
    public function check_id($id)
    {
        return Coa::find($id);
    }
    private static function buildTreeFromObjects($items) {
        $childs = [];
    
        foreach ($items as $item)
            $childs[$item->coa_induk][] = $item;
    
        foreach ($items as $item) if (isset($childs[$item->coa_id]))
            $item->coa_induk = $childs[$item->coa_id];
        
        return $childs;
    }

    private function buildTree(array &$elements, $parentId = 0) {
        $branch = array();
        foreach ($elements as $element) {
            if ($element['coa_induk'] == $parentId) {
                $children = $this->buildTree($elements, $element['coa_id']);
                if ($children) {
                    $element['children'] = $children;
                }
                $branch[$element['coa_id']] = $element;
                unset($elements[$element['coa_id']]);
            }
        }
        return $branch;
    }
    protected function import_coa()
    {
        return Excel::import(new CoaImport,'../database/factories/csv/CoA_bandung.csv', null, \Maatwebsite\Excel\Excel::CSV);
    }
    protected function grid($coa)
    {
        return Coa::with(['depo'=>function($query){
            if($this->userDepo){
                return $query->where('m_depo.id',$this->userDepo);
            }
            return $query;
        }])->where('coa_id',$coa)->get();
    }
}
