<div>
    <section class="checkout spad">
        <div class="container">
            <div class="checkout__form">
                <form wire:submit.prevent="venta">
                    @forelse ($direcciones as $direccion)
                        {{ $direccion }}
                    @empty
                    <div class="row">
                        <div class="col-lg-8 col-md-6">
                            <h6 class="coupon__code"><span class="icon_tag_alt"></span> Have a coupon? <a href="#">Click
                            here</a> to enter your code</h6>
                            <h6 class="checkout__title">Datos de envío</h6>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Dirección de envío<span>*</span></p>
                                        <input type="text" wire:model="direccion" @error('direccion') class="invalid" @enderror>
                                        @error('direccion') <span class="error text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Referencia de envío</p>
                                        <input type="text" wire:model="referencia" @error('referencia') class="invalid" @enderror>
                                        @error('referencia') <span class="error text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Departamento<span>*</span></p>
                                        <select class="custom-select expand_select @error('departamento') invalid @enderror" wire:model="departamento">
                                            @forelse ($departamentos as $dp)
                                                @if($loop->first)
                                                    <option selected value="" style="display: none;">Seleccione un departamento</option>    
                                                @else
                                                    <option value="{{ $dp->id }}">{{ $dp->nombre }}</option>
                                                @endif                                        
                                            @empty
                                            <option>Ocurrió un error, intentelo de nuevo recargando la pagina.</option>
                                            @endforelse
                                        </select>
                                        @error('departamento') <span class="error text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Municipio<span>*</span></p>
                                        <select class="custom-select expand_select @error('id_municipio') invalid @enderror" wire:model="id_municipio">
                                            @forelse ($municipios as $mp)
                                                @if($loop->first)
                                                    <option value="" style="display: none;">Seleccione un municipio</option>    
                                                @else
                                                    <option value="{{ $mp->id }}">{{ $mp->nombre }}</option>
                                                @endif                                        
                                            @empty
                                            <option>Seleccione un departamento.</option>
                                            @endforelse
                                        </select>
                                        @error('id_municipio') <span class="error text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>
                            <br>
                            <h6 class="checkout__title">Datos de facturación</h6>   
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Dirección de facturación<span>*</span></p>
                                        <input type="text" wire:model="direccionFacturaciones" @error('direccionFacturaciones') class="invalid" @enderror>
                                        @error('direccionFacturaciones') <span class="error text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Referencia de facturación</p>
                                        <input type="text" wire:model="referenciaFacturaciones" @error('referenciaFacturaciones') class="invalid" @enderror>
                                        @error('referenciaFacturaciones') <span class="error text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Departamento<span>*</span></p>
                                        <select class="custom-select expand_select @error('departamentoF') invalid @enderror" wire:model="departamentoF">
                                            @forelse ($departamentos as $dp)
                                                @if($loop->first)
                                                    <option selected value="" style="display: none;">Seleccione un departamento</option>    
                                                @else
                                                    <option value="{{ $dp->id }}">{{ $dp->nombre }}</option>
                                                @endif                                        
                                            @empty
                                            <option>Ocurrió un error, intentelo de nuevo recargando la pagina.</option>
                                            @endforelse
                                        </select>
                                        @error('departamentoF') <span class="error text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Municipio<span>*</span></p>
                                        <select class="custom-select expand_select @error('id_municipioFacturaciones') invalid @enderror" wire:model="id_municipioFacturaciones">
                                            @forelse ($municipiosF as $mp)
                                                @if($loop->first)
                                                    <option value="" style="display: none;">Seleccione un municipio</option>    
                                                @else
                                                    <option value="{{ $mp->id }}">{{ $mp->nombre }}</option>
                                                @endif                                        
                                            @empty
                                            <option>Seleccione un departamento.</option>
                                            @endforelse
                                        </select>
                                        @error('id_municipioFacturaciones') <span class="error text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>                                                    
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="checkout__order">
                                <h4 class="order__title">Your order</h4>
                                <div class="checkout__order__products">Product <span>Total</span></div>
                                <ul class="checkout__total__products">
                                    <li>{{ json_encode($cart) }}</li>
                                    <li>01. Vanilla salted caramel <span>$ 300.0</span></li>
                                    <li>02. German chocolate <span>$ 170.0</span></li>
                                    <li>03. Sweet autumn <span>$ 170.0</span></li>
                                    <li>04. Cluten free mini dozen <span>$ 110.0</span></li>
                                </ul>
                                <ul class="checkout__total__all">
                                    <li>Subtotal <span>$750.99</span></li>
                                    <li>Total <span>$750.99</span></li>
                                </ul>
                                <div class="checkout__input__checkbox">
                                    <label for="acc-or">
                                        Create an account?
                                        <input type="checkbox" id="acc-or">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                <p>Lorem ipsum dolor sit amet, consectetur adip elit, sed do eiusmod tempor incididunt
                                ut labore et dolore magna aliqua.</p>
                                <div class="checkout__input__checkbox">
                                    <label for="payment">
                                        Check Payment
                                        <input type="checkbox" id="payment">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                <div class="checkout__input__checkbox">
                                    <label for="paypal">
                                        Paypal
                                        <input type="checkbox" id="paypal">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                <button type="submit" class="site-btn">PLACE ORDER</button>
                            </div>
                        </div>
                    </div>
                    @endforelse

                    <div class="row">
                        <div class="col-12">
                            <h5>Metodos de Pago</h5>
                        </div>
                        @forelse ($metodosPagos as $pago)
                            <div class="col-12">
                                <div class="col-12 text-center">                                                                
                                    <input type="radio" name="pago" id="{{ $pago->nombre }}" value="{{ $pago->id }}" wire:model="id_metodo_pago" @if ($id_metodo_pago == $pago->id) checked @endif>
                                    <label for="{{ $pago->nombre }}">{{ $pago->nombre }}</label>                                
                                </div>
                                <div class="col-12 align-self-center">
                                    <img src="{{ asset('frontend/img/logo.png') }}" alt="{{ $pago->nombre }}" class="img-fluid rounded mx-auto d-block">
                                </div>
                                <div class="col-12 form-group">
                                    <h5 class="text-center mt-3">Número de {{ strtolower($pago->nombre) == 'chivo wallet' ? 'BTC' : 'cuenta' }} {{ $pago->nombre }}</h5><br>
                                    <h5 class="text-danger text-center">{{ $pago->numero }}</h5>
                                    <h5><b>Porfavor, adjunte una captura de pantalla, donde se muestre una imagen legible del comprobante de trasacción, proveído por {{ strtolower($pago->nombre) == 'chivo wallet' ? 'chivo wallet' : 'su banco' }}.</b></h5>
                                    <div class="checkout__input">
                                        <p>Número de Trasacción<span>*</span></p>
                                        <input type="text" wire:model="numero" @error('numero') class="invalid" @enderror>
                                        @error('numero') <span class="error text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="col-12 form-group">                                
                                    <label for="up-{{ $loop->index }}">Adjunte captura de pantalla del recibo de Trasacción<span class="text-danger">*</span></label>
                                    <input type="file" class="form-control-file @error('imagen') is-invalid @enderror" id="up-{{ $loop->index }}" wire:model="imagen">             
                                    @error('imagen') <span class="error text-danger">{{ $message }}</span> @enderror               
                                </div>
                            </div>
                        @empty
                            <div class="col mt-5">
                                <h6>Metodos de pago no disponibles...</h6>
                            </div>
                        @endforelse
                    </div>
                </form>                
            </div>
        </div>
    </section>
</div>
