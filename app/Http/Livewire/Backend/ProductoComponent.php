<?php

namespace App\Http\Livewire\Backend;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use App\Models\Estilo;
use App\Models\Marca;
use App\Models\Categoria;
use App\Models\SubCategoria;
use App\Models\Talla;
use App\Models\DetalleColor;
use App\Models\DetalleTalla;
use App\Models\DetalleProducto;
use App\Models\Color;
use App\Models\Proveedor;
class ProductoComponent extends Component
{
    use LivewireAlert;
    public 
    $id_producto,
    $nombre,
    $cod,
    $descripcion,
    $proveedor,
    $proveedores = [],
    $marca,
    $imagen,
    $id_detalle_producto,
    $estilo,
    $color=[],
    $colores = [],
    $tallas = [],
    $talla = [],
    $categorias = [],
    $categoria,
    $sub_categorias = [],
    $subcat;

    protected $listeners = ['resetNamesProducto' => 'resetInput','asignProducto' =>'asignProducto','dropByStateProducto' => 'dropByState'];


    protected $rules = [
        'nombre' => 'required|min:4|max:100',
        'cod' => 'required|min:4|max:100',
        'descripcion' => 'required|min:10|max:1500',
        'marca' => 'required',
        'estilo' => 'required',
        'categoria' => 'required',
        'subcat' => 'required',
        'color' => 'required',
        'talla' => 'required',
    ];
    protected $messages =[
        'nombre.required' => 'El Nombre es Obligatorio',
        'cod.required' => 'El Codigo es Obligatorio',
        'marca.required' => 'La Marca es Obligatoria',
        'estilo.required' => 'El estilo es Obligatorio',
        'subcat.required' => 'La sub Categoria es Obligatoria',
        'color.required' => 'El color es Obligatorio',
        'talla.required' => 'La Talla es Obligatoria',
        'categoria.required' => 'La Categoria es Obligatoria',

        'descripcion.required' => 'La descripcion es Obligatoria',
        'descripcion.min' => 'La descripcion debe contener un mínimo de :min caracteres',
        'descripcion.max' => 'La descripcion debe contener un máximo de :max caracteres',
        'nombre.min' => 'El Nombre debe contener un mínimo de :min caracteres',
        'nombre.max' => 'El Nombre debe contener un máximo de :max caracteres'
    ];
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }


    public function createData()
    {
        
    }

    public function render()
    {
        $this->colores = Color::where('estado',1)->select('nombre','id')->get();
        $this->tallas = Talla::where('estado',1)->select('nombre','id')->get();
        $this->categorias = Categoria::where('estado',1)->select('nombre','id')->get();
        $this->sub_categorias = SubCategoria::where('estado',1)->select('nombre','id')->get();
        $this->proveedores = Proveedor::where('estado',1)->select('nombre','id')->get();
        return view('livewire.backend.producto-component');
    }
}
