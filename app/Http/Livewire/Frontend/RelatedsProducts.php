<?php

namespace App\Http\Livewire\Frontend;

use Livewire\Component;

class RelatedsProducts extends Component
{
    public $product = array();
    
    public function render()
    {
        return view('livewire.frontend.relateds-products');
    }
}
