<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;
use App\Models\SubCategoria;
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
}
