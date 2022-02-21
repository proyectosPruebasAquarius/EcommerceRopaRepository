<div>
    <div class="product__details__content">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col">
                    <div class="product__details__text">
                        <h4>{{ $product->nombre }}</h4>
                        @php
                            $opiniones = DB::table('opiniones')->where('id_producto', $product->id_producto);                                    
                            $countOp = $opiniones->avg('rating');
                            if (empty($countOp)) {
                                $countOp = 0;
                            }
                        @endphp
                        <div class="rating">
                            {{-- $countOp-floor($countOp)<=0.50?$countOp-floor($countOp):round($countOp) --}}
                            <i class="fa @if ($countOp > 0 && $countOp <= 0.50) fa-star-half-o @elseif($countOp >= 1) fa-star @else fa-star-o @endif"></i>
                            <i class="fa @if ($countOp > 0.50 && $countOp <= 1.50) fa-star-half-o @elseif($countOp >= 2) fa-star @else fa-star-o @endif"></i>
                            <i class="fa @if ($countOp > 1.50 && $countOp <= 2.50) fa-star-half-o @elseif($countOp >= 3) fa-star @else fa-star-o @endif"></i>
                            <i class="fa @if ($countOp > 2.50 && $countOp <= 3.50) fa-star-half-o @elseif($countOp >= 4) fa-star @else fa-star-o @endif"></i>
                            <i class="fa @if ($countOp > 3.50 && $countOp <= 4.50) fa-star-half-o @elseif($countOp == 5) fa-star @else fa-star-o @endif"></i>
                        </div>
                        @if (empty($product->precio_descuento))
                            <h3>${{ $product->precio_venta }}</h3>
                        @else
                            <h3>${{ $product->precio_descuento }} <span>{{ $product->precio_venta }}</span></h3>
                        @endif
                        {{-- <p>{{ $product->descripcion }}</p> --}}
                        <div class="product__details__option">
                            @php
                                $tallas = \DB::table('detalles_tallas')->join('tallas', 'detalles_tallas.id_talla', '=', 'tallas.id')
                                ->where([
                                    ['detalles_tallas.id_producto', $product->id_producto],
                                    ['tallas.estado', 1]
                                ])
                                ->select('detalles_tallas.*', 'tallas.nombre')->get();

                                $colores = \DB::table('detalles_colores')->join('colores', 'detalles_colores.id_color', '=', 'colores.id')
                                ->where([
                                    ['detalles_colores.id_producto', $product->id_producto],
                                    ['colores.estado', 1]
                                ])
                                ->select('detalles_colores.*', 'colores.color')->get();
                            @endphp

                            <div class="product__details__option__size">
                                <span>Talla:</span>                                    
                                @forelse ($tallas as $talla)
                                    <label for="{{ $loop->index }}" class="bg-white @if ($talla->id_talla == $size) active @endif">{{ $talla->nombre }}
                                        <input type="radio" id="{{ $loop->index }}" value="{{ $talla->id_talla }}" wire:model="size">
                                    </label>
                                @empty
                                    <span class="text-muted">No se encontraron tallas</span>
                                @endforelse
                            </div>
                            
                            <div class="product__details__option__color">
                                <span>Color:</span>
                                @forelse ($colores as $color)
                                    <label style="background: {{ $color->color }}" for="radio-color-{{ $loop->index }}" @if ($color->id_color == $style) class="active" @endif>
                                        {{-- wire:click="$set('color', @js($color->nombre))" --}}
                                        <input type="radio" id="radio-color-{{ $loop->index }}" value="{{ $color->id_color }}" wire:model="style">
                                    </label>
                                @empty
                                    <span class="text-muted">No se encontraron colores</span>
                                @endforelse
                            </div>
                        </div>
                        <div class="product__details__cart__option">
                            <div class="quantity bg-white">
                                @livewire('frontend.qty')
                            </div>
                            <a type="button" class="primary-btn text-white" wire:click="addToCart(@js($product))" onclick="addToCartTrigger()">agregar al carrito</a>
                        </div>
                        <div class="product__details__btns__option">
                            <a href="#"><i class="fa fa-heart"></i> agregar a lista de deseos</a>
                            <a href="#"><i class="fa fa-exchange"></i> Agregar para comparar</a>
                        </div>
                        <div class="product__details__last__option">
                            <h5><span>Guaranteed Safe Checkout</span></h5>
                            <img src="{{ asset('frontend/img/shop-details/details-payment.png') }}" alt="">
                            <ul>
                                <li><span>SKU:</span> {{ $product->cod }}</li>
                                <li><span>Categoría:</span> {{ $product->categoria }}</li>
                                
                                <li><span>Sub Categoría:</span> 
                                    {{ $product->sub_categoria }}
                                </li>
                                {{-- <li>
                                    <div class="accordion" id="accordionExample">

                                        <button class="btn" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                            Tallas
                                          </button>
                                        <div class="card">
                                           
                                            <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                                              <div class="card-body">
                                                <img src="{{ asset('frontend/img/tallas.png') }}" alt="Imagen de Tallas de ropa" class="img-responsive">
                                              </div>
                                            </div>
                                          </div>
                                    </div>
                                </li> --}}
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
    <script>
        let addToCartTrigger = () => {
            @this.qty = document.querySelector('input[type=text]').value
        }
    </script>
    @endpush
</div>
