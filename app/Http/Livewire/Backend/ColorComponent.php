<?php

namespace App\Http\Livewire\Backend;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use App\Models\Color;
class ColorComponent extends Component
{

    public $nombre,$id_color,$estado;
    protected $listeners = ['resetNamesTal' => 'resetInput','asignColor' =>'asignColor','dropByStateColor' => 'dropByState'];


    protected $rules = [
        'nombre' => 'required|min:3|max:100',
        
    ];
    protected $messages =[
        'nombre.required' => 'El Nombre es Obligatorio',
        'nombre.min' => 'El Nombre debe contener un mínimo de :min caracteres',
        'nombre.max' => 'El Nombre debe contener un máximo de :max caracteres'
    ];
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function resetInput()
    {
        $this->resetErrorBag();
        $this->resetValidation();
        $this->reset(['nombre','id_color','estado']);
    }

    public function asignColor($color)
    {
        $this->id_color = $color['id_color'];
        $this->nombre = $color['nombre'];
        $this->estado = $color['estado'];
    }

    public function createData()
    {
        $this->validate();
 
        if ($this->id_color) {
            try {
               
                Color::where('id',$this->id_color)->update([
                    'nombre' => $this->nombre,
                    'estado' => $this->estado
                ]);
                session(['alert' => ['type' => 'success', 'message' => 'Color Actualizado con éxito.','position' =>'center']]); 
                return redirect()->to('/administracion/colores');
                $this->dispatchBrowserEvent('closeModal'); 
            } catch (\Throwable $th) {
                $this->dispatchBrowserEvent('closeModal'); 
                session(['alert' => ['type' => 'error', 'message' => 'Ocurrio un Error.','position' =>'center']]);
                return redirect()->to('administracion/colores');
            }
        } else {
            try {
                $color = new Color;
                $color->nombre = $this->nombre;
                $color->save();
                session(['alert' => ['type' => 'success', 'message' => 'Color Guardado con éxito.','position' =>'center']]); 
                return redirect()->to('/administracion/colores');
                $this->dispatchBrowserEvent('closeModal'); 
            } catch (\Throwable $th) {
                $this->dispatchBrowserEvent('closeModal'); 
                session(['alert' => ['type' => 'error', 'message' => 'Ocurrio un Error.','position' =>'center']]);
                return redirect()->to('administracion/colores');
            }
        }                              
    }
    public function dropByState($id)
    {
        try {
            Color::where('id',$id)->update(['estado' => 0]);               
            session(['alert' => ['type' => 'success', 'message' => 'Color desactivado con éxito.']]);
            return redirect()->to('administracion/colores');
        } catch (\Exception $th) {
           
            $this->alert('error', 'Ocurrió un error porfavor intentelo mas tarde.', [
                'position' => 'center'
            ]);
        }
    }


    public function render()
    {
        return view('livewire.backend.color-component');
    }
}
