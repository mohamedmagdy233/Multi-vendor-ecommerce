<?php

namespace App\View\Components;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\View\Component;

class Nav extends Component
{
    public $items;

    public $active;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($context = 'side')
    {
//        $this->items = $this->prepareItems(config('nav'));
       $this->items =config('nav');

        $this->active = Route::currentRouteName();
    }


    public function render()
    {
        return view('components.nav');
    }

    protected function prepareItems($items)
    {
        $user = Auth::user();
        foreach ($items as $key => $item) {
            if (isset($item['ability']) && !$user->can($item['ability'])) {
                unset($items[$key]);
            }
        }
        return $items;
    }
}
