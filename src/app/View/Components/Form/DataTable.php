<?php

namespace App\View\Components\Form;

use Illuminate\View\Component;

class DataTable extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $thead;
    public $link;
    public function __construct($thead,$link)
    {
        $this->thead = $thead;
        $this->link = $link;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.form.data-table');
    }
}
