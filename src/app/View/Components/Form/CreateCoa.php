<?php

namespace App\View\Components\Form;

use Illuminate\View\Component;

class CreateCoa extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $tree;
    public function __construct($tree)
    {
        $a = collect($this->flat_data($tree))
        ->map(function($a){
            return [
                'id'=>$a['coa_id'],
                'name'=>$a['coa_id'].' - '.$a['coa_nama'],
                'asset'=>$a];
        });
        $this->tree = $a->sortBy('id')->values();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.form.create-coa');
    }

    protected function flat_data($element)
    {
        $flatArray = array();
        foreach ($element as $key => $node) {
            if (array_key_exists('children', $node)) {
                $flatArray = array_merge($flatArray,$this->flat_data($node['children']));
                unset($node['children']);
                $flatArray[] = $node;
            } else {
                $flatArray[] = $node;
            }
        }
        return $flatArray;
    }
}
