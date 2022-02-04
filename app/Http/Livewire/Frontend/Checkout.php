<?php

namespace App\Http\Livewire\Frontend;

use Livewire\Component;
use App\models\Direccion;
use App\models\DireccionFacturaccion;
use App\models\MetodoPago;
use App\models\Departamento;
use App\models\Municipio;
use App\models\DatoVenta;
use App\models\DetalleVenta;
use App\models\Venta;
use App\models\Inventario;
use App\models\User;
use Livewire\WithFileUploads;

class Checkout extends Component
{
    use WithFileUploads;

    // Direcciones
    public $direccion;
    public $referencia;
    public $id_municipio;
    public $departamento;
    public $municipios = array();
    // propiedad si se selecciona;
    public $id_direccion;
    
    // Direcciones de facturaciones
    public $direccionFacturaciones;
    public $referenciaFacturaciones;
    public $id_municipioFacturaciones;
    public $departamentoF;
    public $municipiosF = array();
    // propiedad si se selecciona;
    public $id_facturacion;

    public $id_metodo_pago;
    // Datos_ventas
    public $numero;
    public $imagen;

    protected $rules = [
        'direccion' => 'required_without:id_direccion|string|min:4|max:500',
        'referencia' => 'nullable|string|min:4|max:200',
        'departamento' => 'required_without:id_direccion',
        'id_municipio' => 'required_without:id_direccion',

        'direccionFacturaciones' => 'required_without:id_facturacion|string|min:4|max:500',
        'referenciaFacturaciones' => 'nullable|string|min:4|max:200',
        'departamentoF' => 'required_without:id_facturacion',
        'id_municipioFacturaciones' => 'required_without:id_facturacion',

        'id_direccion' => 'required_without_all:direccion,referencia,departamento,id_municipio',
        'id_facturacion' => 'required_without_all:direccionFacturaciones,referenciaFacturaciones,departamentoF,id_municipioFacturaciones',

        'id_metodo_pago' => 'required',
        'numero' => 'required|string|min:7|max:20',
        'imagen' => 'required|image|max:5024|mimes:png,jpg,jpeg',
    ];
    
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function updatedDepartamento($value)
    {
        $this->municipios = Municipio::where('id_departamento', $value)->get();
    }

    public function updatedDepartamentoF($value)
    {
        $this->municipiosF = Municipio::where('id_departamento', $value)->get();
    }

    public function venta()
    {

        $contentCart = \Cart::getContent();
        $totalCart = \Cart::getTotal();
        $id_direccion;

        try {
            $validatedData = $this->validate();
            $validatedData['id_user'] = auth()->user()->id;

            \DB::beginTransaction();
            $id_direccion = null;
            $facturacion = null;
            /* if (empty($request->recoger_tienda)) { */
                /* direccion de envio */
                if (empty($validatedData['id_direccion'])) {
                    $direccion = new Direccion;
                    $direccion->direccion = $validatedData['direccion'];                                        
                    $direccion->id_user =  $validatedData['id_user'];
                    $direccion->id_municipio = $validatedData['id_municipio'];
                    $direccion->referencia = $validatedData['referencia'];
                    $direccion->saveOrFail();
                    $id_direccion = $direccion->id;
                } else {
                    $id_direccion = $validatedData['id_direccion'];
                }
                
                /* direccion facturacion */
                if ($validatedData['id_facturacion']) {
                    $facturacion = $validatedData['id_facturacion'];
                } else {
                    $fct = new DireccionFacturaccion;
                    $fct->direccion = $validatedData['direccionFacturaciones'];
                    $fct->id_municipio = $validatedData['id_municipioFacturaciones'];
                    $fct->id_user = $validatedData['id_user'];
                    $fct->referencia = $validatedData['referenciaFacturaciones'];
                    $fct->saveOrFail();
    
                    $facturacion = $fct->id;
                }
            /* } */

            /* venta */
            $venta = new Venta;
            $venta->id_usuario = $validatedData['id_user'];
            $venta->total = $totalCart;
            $venta->num_transaccion = sha1(time());
            $venta->id_direccion = $id_direccion;
            $venta->id_metodo_pago = $validatedData['id_metodo_pago'];
            $venta->estado = strtolower($this->getMetodoPago($validatedData['id_metodo_pago'])) == "chivo wallet" || strtolower($this->getMetodoPago($validatedData['id_metodo_pago'])) == "banco agricola" ? 0 : 1;
            $venta->id_facturacion = $facturacion;
            $venta->recoger_tienda = 0;//$request->recoger_tienda;
            $venta->saveOrFail();

            foreach ($contentCart as $ct ) {
               $detail = new DetalleVenta;
               $detail->id_producto = $ct['attributes']['id_producto'];
               $detail->id_venta = $venta->id;
               $detail->cantidad = $ct->quantity;
               $detail->id_color = $ct['attributes']['color'];
               $detail->id_talla = $ct['attributes']['size'];
               $detail->precio_venta = $ct->price;
             
               $oferta = Inventario::join('ofertas','ofertas.id','=','inventarios.id_oferta')->select('ofertas.nombre as ofertas')->where('inventarios.id',$ct['attributes']['id_inventario'])->first();
              
               if (sizeof($oferta) <> 0) {
                  $detail->oferta = $oferta->ofertas;
               }else{
                   $detail->oferta = null;
               }
               $detail->save();
             
            }
            if (strtolower($this->getMetodoPago($validatedData['id_metodo_pago'])) == "chivo wallet" || strtolower($this->getMetodoPago($validatedData['id_metodo_pago'])) == "banco agricola") {
                
                //if ($request->hasfile('imagen')) {                    
                    $datoVenta = new DatoVenta;
                    $datoVenta->numero = $validatedData['numero'];
                    $imageExt = time().'.'.$validatedData['imagen']->extension();
                    $imageName = $validatedData['imagen']->storeAs('photo', $imageExt, 'public');
                    //$url = \Storage::url($imageName);
                    
                    $datoVenta->imagen = $imageExt;
                    $datoVenta->id_venta = $venta->id;
                    $datoVenta->save();
                //}

            }

            /* $admins = User::where('id_tipo_usuario', 1)->get();

            \Notification::send($admins, new EstadoVenta($venta)); */
            \Cart::clear();
            \DB::commit();
            return redirect()->to('/perfil');//redirect('/profile')->with('correlative',$venta->num_transaccion);
        } catch (Throwable $e) {
            \DB::rollback();
            throw $e;
            
        }
    }

    public function getMetodoPago($id)
    {
        return MetodoPago::where('id', $id)->value('nombre');
    }

    public function mount()
    {
        /* if (\Cart::isEmpty()) {
            return redirect()->to('/productos');
        } */
    }

    public function render()
    {
        $user = auth()->user()->id;
        $cart = \Cart::getContent()->toArray();
        $direcciones = Direccion::where('id_user', $user)->get();
        $facturaciones = DireccionFacturaccion::where('id_user', $user)->get();
        $metodosPagos = MetodoPago::get();
        $departamentos = Departamento::get();

        return view('livewire.frontend.checkout', [
            'cart' => $cart,
            'direcciones' => $direcciones,
            'facturaciones' => $facturaciones,
            'metodosPagos' => $metodosPagos,
            'departamentos' => $departamentos,
        ]);
    }
}
