<?php

namespace App\View\Components\Form;

use Illuminate\View\Component;

class TipeHead extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $dataHead;
    public function __construct($dataHead)
    {
        $this->dataHead = $dataHead;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.form.tipe-head');
    }
}
