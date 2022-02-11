<?php

namespace App\Http\Livewire\Frontend;

use Livewire\Component;

class HeaderOptions extends Component
{
    public function storeInSession($data, $type)
    {
        switch ($type) {
            case 'sub-menu':
                session(['sub-category' => $data]);
                return redirect()->to('/productos');
                break;
            
            default:
                session(['category' => $data]);
                return redirect()->to('/productos');
                break;
        }
    }

    public function render()
    {
        return view('livewire.frontend.header-options');
    }
}
