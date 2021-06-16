<?php

namespace App\View\Components;

use Illuminate\View\Component;

class TableEvaluasiKerja extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $data_evaluasi;
    public $depo;
    public $param;
    public function __construct($dataEvaluasi,$depo,$param)
    {
        $this->param = $param;
        $this->data_evaluasi = $dataEvaluasi;
        $this->depo = $depo;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.table-evaluasi-kerja');
    }
}
