<?php

namespace App\Http\Livewire\Frontend;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Inventario;
use App\Models\Color;
use App\Models\Talla;
use App\Models\Marca;
use App\Models\Categoria;

class Grids extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    /* public $inventarios = array(); */
    public $colors = array();
    public $tallas = array();
    public $marcas = array();
    public $categorias = array();
    public $pagination = 12;
    public $sortField = 'productos.nombre';
    public $sortDirection = 'asc';
    public $sortOrder;
    public $search;
    public $filtColors = array();
    public $filtTallas = array();
    public $filtPrecios = array();
    public $marca;
    public $category;

    public function filterByColor($color)
    {
        if (in_array($color, $this->filtColors)) {
            
            if (($key = array_search($color, $this->filtColors)) !== false) {
                unset($this->filtColors[$key]);
            }
        } else {            
            array_push($this->filtColors, $color);
        }
    }

    public function filterBySize($size)
    {
        if (in_array($size, $this->filtTallas)) {
            /* \Debugbar::info($color); */
            if (($key = array_search($size, $this->filtTallas)) !== false) {
                unset($this->filtTallas[$key]);
            }
        } else {            
            array_push($this->filtTallas, $size);
        }
    }

    public function filterByPrice($precios)
    {
        if ($precios == $this->filtPrecios) {
            $this->reset('filtPrecios');            
        } else {            
            $this->filtPrecios = $precios;
        }
    }

    public function filterByBrand($brands)
    {
        if ($brands == $this->marca) {
            $this->reset('marca');            
        } else {            
            $this->marca = $brands;
        }
    }

    public function filterByCategory($category)
    {
        if ($category == $this->category) {
            $this->reset('category');            
        } else {            
            $this->category = $category;
        }
    }

    public function updatingSearch()
    {
        $this->resetPage();
        /* $this->dispatchBrowserEvent('reload-select'); */
    }

    public function updatedSortOrder()
    {
        $this->sortBy($this->sortOrder);
    }

    public function sortBy($order) 
    {
        /* \Debugbar::info($order); */
        $order = explode(', ', $order);
        foreach ($order as $key => $value) {
            if ($key == 0) {
                $this->sortField = $value;
            } else {
                $this->sortDirection = $value;
            }
            
        }
        /* $this->dispatchBrowserEvent('reload-select'); */
    }

    public function mount()
    {
        /* array_push($this->filtTallas, 'xs', '4xl');
        \Debugbar::info($this->filtTallas); */
    }

    public function render()
    {
        $search = '%'.$this->search.'%';
        $colors = $this->filtColors;
        $tallas = $this->filtTallas;
        $precios = $this->filtPrecios;
        $marca = $this->marca;
        $category = $this->category;

        $inventarios = Inventario::join('productos', 'inventarios.id_producto', '=', 'productos.id')
        ->leftJoin('detalles_colores', 'detalles_colores.id_producto', '=', 'productos.id')
        ->leftJoin('colores', 'detalles_colores.id_color', '=', 'colores.id')
        ->leftJoin('detalles_tallas', 'detalles_tallas.id_producto', '=', 'productos.id')
        ->leftJoin('tallas', 'detalles_tallas.id_talla', '=', 'tallas.id')
        ->join('detalles_productos', 'productos.id_detalle_producto', '=', 'detalles_productos.id')
        ->when($search, function ($query) use ($search) {
            $query->where('productos.nombre', 'like', $search);
        })
        ->when($colors, function ($query) use ($colors) {
            /* foreach ($colors as $color) { */
                $query->whereIn('colores.nombre', $colors);
                /* \Debugbar::info($color); */
            /* } */
        })
        ->when($tallas, function ($query) use ($tallas) {            
                $query->whereIn('tallas.nombre', $tallas);            
        })
        ->when($precios, function ($query) use ($precios) {            
            $query->whereBetween('inventarios.precio_venta', $precios);            
        })
        ->when($marca, function ($query) use ($marca) { 
            $query->where('productos.id_marca', $marca);
        })
        ->when($category, function ($query) use ($category) { 
            $query->where('detalles_productos.id_categoria', $category);
        })
        ->select('inventarios.*', 'productos.nombre', 'productos.imagen', 'productos.descripcion')
        ->where('inventarios.estado', 1)
        ->orderBy($this->sortField, $this->sortDirection)->distinct()->paginate($this->pagination);

        $this->colors = Color::where('estado', 1)->get();
        $this->tallas = Talla::where('estado', 1)->get();
        $this->marcas = Marca::where('estado', 1)->get(['nombre', 'id']);
        $this->categorias = Categoria::where('estado', 1)->get(['nombre', 'id']);
        $this->dispatchBrowserEvent('reload-select');
        return view('livewire.frontend.grids', [
            'inventarios' => $inventarios,
            'actualCount' => count($inventarios),
            'totalCount' => Inventario::where('estado', 1)->count(),
        ]);
    }
}
