<?php

namespace App\View\Components;

use Illuminate\View\Component;

class nav extends Component
{
    public $items ;

    public function __construct()
    {
        $this->items= config('nav');
    }


    public function render()
    {
        return view('components.nav');
    }
}
