<?php

namespace App\View\Components;

use App\Models\Cat;
use Illuminate\View\Component;

class Navbar extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
                // to read category names by array
                 $data['cats'] = Cat::select('id', 'name')->active()->get();
                 return view('components.navbar')->with($data);
    }
}
