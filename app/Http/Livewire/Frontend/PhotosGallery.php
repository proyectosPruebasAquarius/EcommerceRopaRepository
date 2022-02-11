<?php

namespace App\Http\Livewire\Frontend;

use Livewire\Component;

class PhotosGallery extends Component
{
    public $product = array();
    
    public function render()
    {
        return view('livewire.frontend.photos-gallery');
    }
}
