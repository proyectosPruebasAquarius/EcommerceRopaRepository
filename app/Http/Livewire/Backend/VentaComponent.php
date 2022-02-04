<?php

namespace App\Http\Livewire\Backend;

use Jantinnerezo\LivewireAlert\LivewireAlert;
use App\Models\Venta;
use App\Models\DetalleVenta;
use Livewire\Component;

class VentaComponent extends Component
{
    use LivewireAlert;
    public $id_venta,$detalle_venta = [],$estado,$productosVenta = [];
    protected $listeners = ['detalleVenta' =>'detalleVenta'];






    public function detalleVenta($id)
    {
        $this->dispatchBrowserEvent('reloadT');
        $this->detalle_venta = Venta::join('detalle_ventas', 'detalle_ventas.id_venta', '=', 'ventas.id')->join('users', 'users.id', '=', 'ventas.id_usuario')->join('direcciones', 'direcciones.id', 'ventas.id_direccion')
        ->join('municipios','municipios.id','=','direcciones.id_municipio')->join('departamentos','departamentos.id','=','municipios.id_departamento')
        ->join('direcciones_facturaciones', 'direcciones_facturaciones.id', 'ventas.id_facturacion')
        ->join('metodos_pagos', 'metodos_pagos.id', '=', 'ventas.id_metodo_pago')
        ->join('datos_ventas', 'datos_ventas.id_venta', '=', 'ventas.id')
        ->join('productos', 'productos.id', '=', 'detalle_ventas.id_producto')
            ->select('direcciones.direccion', 'users.telefono', 'direcciones_facturaciones.direccion as facturacion', 'direcciones_facturaciones.referencia as referencia_facturacion', 'ventas.total as totalVenta', 'ventas.estado as estadoVenta', 'datos_ventas.numero as numeroTransaccion',
                'datos_ventas.imagen as imagenDatoVenta', 'ventas.id as id_venta', 'users.id as id_usuario','users.name as cliente','users.email as correo','municipios.nombre as municipio','departamentos.nombre as departamento',
                'direcciones.referencia','metodos_pagos.nombre as metodo_pago','ventas.num_transaccion as numeroTransaccionVenta')->where('ventas.id', '=', $id)->distinct()->get();


        $this->productosVenta = DetalleVenta::join('productos', 'productos.id', '=', 'detalle_ventas.id_producto')->select('productos.nombre','detalle_ventas.precio_venta','detalle_ventas.oferta','productos.imagen','detalle_ventas.cantidad')
        ->where('detalle_ventas.id_venta', '=', $id)->get();

        
    }


    public function render()
    {
        return view('livewire.backend.venta-component');
    }
}
