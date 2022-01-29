<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;
use App\Models\SubCategoria;
use App\Models\Talla;
use App\Models\Color;
use App\Models\Estilo;
use App\Models\Marca;
use App\Models\Oferta;
use App\Models\Proveedor;
class CategoriaController extends Controller
{
    public function index()
    {
        $categorias = Categoria::select('nombre','id as id_categoria','estado')->get();

        return view('backend.categorias')->with('categorias', $categorias);
    }



    public function indexSub()
    {
        $subcategorias = SubCategoria::select('nombre','id as id_subcategoria','estado')->get();

        return view('backend.sub-categorias')->with('subcategorias', $subcategorias);
    }


    public function indexTalla()
    {
        $tallas = Talla::select('nombre','id as id_talla','estado')->get();

        return view('backend.tallas')->with('tallas', $tallas);
    }

    public function indexColor()
    {
        $colores = Color::select('nombre','id as id_color','estado')->get();

        return view('backend.colores')->with('colores', $colores);
    }

    public function indexEstilo()
    {
        $estilos = Estilo::select('nombre','id as id_estilo','estado')->get();

        return view('backend.estilos')->with('estilos', $estilos);
    }

    public function indexMarca()
    {
        $marcas = Marca::select('nombre','id as id_marca','estado')->get();

        return view('backend.marcas')->with('marcas', $marcas);
    }


    public function indexOferta()
    {
        $ofertas = Oferta::select('nombre','id as id_oferta','estado')->get();

        return view('backend.ofertas')->with('ofertas', $ofertas);
    }


    public function indexProveedor()
    {
        $proveedores = Proveedor::select('nombre','id as id_proveedor','estado','nombre_contacto','tel_contacto','telefono','direccion')->get();

        return view('backend.proveedores')->with('proveedores', $proveedores);
    }
}
