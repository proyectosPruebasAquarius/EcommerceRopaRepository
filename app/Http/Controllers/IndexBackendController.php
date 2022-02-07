<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;
use App\Models\Color;
use App\Models\Estilo;
use App\Models\Inventario;
use App\Models\Marca;
use App\Models\MetodoPago;
use App\Models\Oferta;
use App\Models\Producto;
use App\Models\Proveedor;
use App\Models\SubCategoria;
use App\Models\Talla;
use App\Models\Venta;
use Illuminate\Support\Facades\Crypt;
use DB;


class IndexBackendController extends Controller
{
    public function indexCategoria()
    {
        $categorias = Categoria::select('nombre', 'id as id_categoria', 'estado')->get();

        return view('backend.categorias')->with('categorias', $categorias);
    }

    public function indexSub()
    {
        $subcategorias = SubCategoria::select('nombre', 'id as id_subcategoria', 'estado')->get();

        return view('backend.sub-categorias')->with('subcategorias', $subcategorias);
    }

    public function indexTalla()
    {
        $tallas = Talla::select('nombre', 'id as id_talla', 'estado')->get();

        return view('backend.tallas')->with('tallas', $tallas);
    }

    public function indexColor()
    {
        $colores = Color::select('nombre', 'id as id_color', 'estado', 'color')->get();

        return view('backend.colores')->with('colores', $colores);
    }

    public function indexEstilo()
    {
        $estilos = Estilo::select('nombre', 'id as id_estilo', 'estado')->get();

        return view('backend.estilos')->with('estilos', $estilos);
    }

    public function indexMarca()
    {
        $marcas = Marca::select('nombre', 'id as id_marca', 'estado')->get();

        return view('backend.marcas')->with('marcas', $marcas);
    }

    public function indexOferta()
    {
        $ofertas = Oferta::select('nombre', 'id as id_oferta', 'estado')->get();

        return view('backend.ofertas')->with('ofertas', $ofertas);
    }

    public function indexProveedor()
    {
        $proveedores = Proveedor::select('nombre', 'id as id_proveedor', 'estado', 'nombre_contacto', 'tel_contacto', 'telefono', 'direccion')->get();

        return view('backend.proveedores')->with('proveedores', $proveedores);
    }

    public function indexMetodo()
    {
        $metodos = MetodoPago::select('nombre', 'id as id_metodo', 'estado', 'qr', 'numero', 'cuenta_asociado')->get();

        return view('backend.metodos-pagos')->with('metodos', $metodos);
    }
    public function indexProducto()
    {
        $productos = Producto::join('proveedores', 'proveedores.id', '=', 'productos.id_proveedor')->join('marcas', 'marcas.id', '=', 'productos.id_marca')->join('estilos', 'estilos.id', '=', 'productos.id_estilo')
            ->select('productos.id as id_producto', 'productos.nombre', 'productos.descripcion', 'productos.cod', 'productos.imagen', 'productos.estado', 'productos.id_detalle_producto', 'marcas.nombre as marca_nombre', 'productos.id_marca as marca'
                , 'productos.id_estilo as estilo', 'estilos.nombre as estilo_nombre', 'proveedores.id as proveedor', 'proveedores.nombre as proveedor_nombre')->get();
        return view('backend.productos')->with('productos', $productos);
    }

    public function indexInventario()
    {
        $inventarios = Inventario::join('productos', 'productos.id', '=', 'inventarios.id_producto')->leftJoin('ofertas', 'ofertas.id', '=', 'inventarios.id_oferta')
            ->select('precio_compra', 'precio_venta', 'precio_descuento', 'inventarios.id as id_inventario', 'inventarios.estado', 'stock', 'min_stock', 'productos.nombre as producto_nombre', 'ofertas.nombre as descuento_nombre'
                , 'productos.id as producto', 'ofertas.id as descuento', 'productos.cod')->get();

        return view('backend.inventarios')->with('inventarios', $inventarios);
    }

    public function indexVenta()
    {
        $ventas = Venta::join('direcciones', 'direcciones.id', '=', 'ventas.id_direccion')->join('metodos_pagos', 'metodos_pagos.id', '=', 'ventas.id_metodo_pago')->join('users', 'users.id', '=', 'ventas.id_usuario')
            ->select('direcciones.direccion', 'metodos_pagos.nombre as metodo_pago', 'ventas.estado as estado', 'ventas.id as id_venta', 'ventas.total', 'ventas.created_at as fecha', 'users.name as cliente')
            ->orderBy('ventas.id', 'ASC')->get();

        return view('backend.ventas')->with('ventas', $ventas);
    }



  

}
