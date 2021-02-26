<?php

namespace App\View\Components\Form;

use Illuminate\View\Component;

class Modal extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $form_input;
    public $title;
    public function __construct($formInput, $title)
    {
        $this->form_input = $formInput;
        $this->title = $title;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.form.modal');
    }
}
