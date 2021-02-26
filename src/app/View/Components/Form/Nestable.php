<?php

namespace App\View\Components\Form;

use Illuminate\View\Component;

class Nestable extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $tree;
    public function __construct($tree)
    {
        $this->tree = $tree;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.form.nestable');
    }
}
