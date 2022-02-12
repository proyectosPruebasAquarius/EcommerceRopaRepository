<div>
    <!-- Shop Details Section Begin -->
    <section class="shop-details">
        <div class="product__details__pic">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="product__details__breadcrumb">
                            <a href="{{ url('/') }}">Inicio</a>
                            <a href="{{ route('productos') }}">Productos</a>
                            <span>{{ $product->nombre }}</span>
                        </div>
                    </div>
                </div>
                @livewire('frontend.photos-gallery',  ['product' => $product])
            </div>
        </div>
        <div class="product__details__content">
            <div class="container">
                <div class="row d-flex justify-content-center">
                    <div class="col-lg-8">
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
                            <p>{{ $product->descripcion }}</p>
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
                                        <label for="{{ $loop->index }}" @if ($talla->id_talla == $size) class="active" @endif>{{ $talla->nombre }}
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
                                <div class="quantity">
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
                                    <li>
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
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="product__details__tab">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#tabs-5"
                                    role="tab">Description</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#tabs-6" role="tab">Customer
                                    Previews(5)</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#tabs-7" role="tab">Valoraciones</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="tabs-5" role="tabpanel">
                                    <div class="product__details__tab__content">
                                        <p class="note">Nam tempus turpis at metus scelerisque placerat nulla deumantos
                                            solicitud felis. Pellentesque diam dolor, elementum etos lobortis des mollis
                                            ut risus. Sedcus faucibus an sullamcorper mattis drostique des commodo
                                        pharetras loremos.</p>
                                        <div class="product__details__tab__content__item">
                                            <h5>Products Infomation</h5>
                                            <p>A Pocket PC is a handheld computer, which features many of the same
                                                capabilities as a modern PC. These handy little devices allow
                                                individuals to retrieve and store e-mail messages, create a contact
                                                file, coordinate appointments, surf the internet, exchange text messages
                                                and more. Every product that is labeled as a Pocket PC must be
                                                accompanied with specific software to operate the unit and must feature
                                            a touchscreen and touchpad.</p>
                                            <p>As is the case with any new technology product, the cost of a Pocket PC
                                                was substantial during it’s early release. For approximately $700.00,
                                                consumers could purchase one of top-of-the-line Pocket PCs in 2003.
                                                These days, customers are finding that prices have become much more
                                                reasonable now that the newness is wearing off. For approximately
                                            $350.00, a new Pocket PC can now be purchased.</p>
                                        </div>
                                        <div class="product__details__tab__content__item">
                                            <h5>Material used</h5>
                                            <p>Polyester is deemed lower quality due to its none natural quality’s. Made
                                                from synthetic materials, not natural like wool. Polyester suits become
                                                creased easily and are known for not being breathable. Polyester suits
                                                tend to have a shine to them compared to wool and cotton suits, this can
                                                make the suit look cheap. The texture of velvet is luxurious and
                                                breathable. Velvet is a great choice for dinner party jacket and can be
                                            worn all year round.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="tabs-6" role="tabpanel">
                                    <div class="product__details__tab__content">
                                        <div class="product__details__tab__content__item">
                                            <h5>Products Infomation</h5>
                                            <p>A Pocket PC is a handheld computer, which features many of the same
                                                capabilities as a modern PC. These handy little devices allow
                                                individuals to retrieve and store e-mail messages, create a contact
                                                file, coordinate appointments, surf the internet, exchange text messages
                                                and more. Every product that is labeled as a Pocket PC must be
                                                accompanied with specific software to operate the unit and must feature
                                            a touchscreen and touchpad.</p>
                                            <p>As is the case with any new technology product, the cost of a Pocket PC
                                                was substantial during it’s early release. For approximately $700.00,
                                                consumers could purchase one of top-of-the-line Pocket PCs in 2003.
                                                These days, customers are finding that prices have become much more
                                                reasonable now that the newness is wearing off. For approximately
                                            $350.00, a new Pocket PC can now be purchased.</p>
                                        </div>
                                        <div class="product__details__tab__content__item">
                                            <h5>Material used</h5>
                                            <p>Polyester is deemed lower quality due to its none natural quality’s. Made
                                                from synthetic materials, not natural like wool. Polyester suits become
                                                creased easily and are known for not being breathable. Polyester suits
                                                tend to have a shine to them compared to wool and cotton suits, this can
                                                make the suit look cheap. The texture of velvet is luxurious and
                                                breathable. Velvet is a great choice for dinner party jacket and can be
                                            worn all year round.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="tabs-7" role="tabpanel">
                                    <div class="product__details__tab__content">
                                        {{-- <p class="note">Nam tempus turpis at metus scelerisque placerat nulla deumantos
                                            solicitud felis. Pellentesque diam dolor, elementum etos lobortis des mollis
                                            ut risus. Sedcus faucibus an sullamcorper mattis drostique des commodo
                                        pharetras loremos.</p>
                                        <div class="product__details__tab__content__item">
                                            <h5>Products Infomation</h5>
                                            <p>A Pocket PC is a handheld computer, which features many of the same
                                                capabilities as a modern PC. These handy little devices allow
                                                individuals to retrieve and store e-mail messages, create a contact
                                                file, coordinate appointments, surf the internet, exchange text messages
                                                and more. Every product that is labeled as a Pocket PC must be
                                                accompanied with specific software to operate the unit and must feature
                                            a touchscreen and touchpad.</p>
                                            <p>As is the case with any new technology product, the cost of a Pocket PC
                                                was substantial during it’s early release. For approximately $700.00,
                                                consumers could purchase one of top-of-the-line Pocket PCs in 2003.
                                                These days, customers are finding that prices have become much more
                                                reasonable now that the newness is wearing off. For approximately
                                            $350.00, a new Pocket PC can now be purchased.</p>
                                        </div>
                                        <div class="product__details__tab__content__item">
                                            <h5>Material used</h5>
                                            <p>Polyester is deemed lower quality due to its none natural quality’s. Made
                                                from synthetic materials, not natural like wool. Polyester suits become
                                                creased easily and are known for not being breathable. Polyester suits
                                                tend to have a shine to them compared to wool and cotton suits, this can
                                                make the suit look cheap. The texture of velvet is luxurious and
                                                breathable. Velvet is a great choice for dinner party jacket and can be
                                            worn all year round.</p>
                                        </div> --}}
                                        @guest
                                            <div class="row">
                                                <div class="col text-center">
                                                    <p>Debes iniciar sesión para valorar.</p>
                                                </div>
                                            </div>
                                        @else
                                            @php
                                                $isAllowedToComment = \DB::table('detalle_ventas')->join('ventas', 'detalle_ventas.id_venta', '=', 'ventas.id')->where([
                                                    ['detalle_ventas.id_producto',  $product->id_producto],
                                                    ['ventas.id_usuario', auth()->user()->id]
                                                ])->count();
                                            @endphp

                                            @if ($isAllowedToComment)
                                                @livewire('frontend.reviews', ['id' => $product->id_producto])
                                            @endif

                                            @livewire('frontend.edit-review')
                                        @endguest
                                        @livewire('frontend.comments', ['id' => $product->id_producto])
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shop Details Section End -->

    <!-- Related Section Begin -->
    @livewire('frontend.relateds-products', ['product' => $product])
    <!-- Related Section End -->
    @push('scripts')
    <script>
        let addToCartTrigger = () => {
            @this.qty = document.querySelector('input[type=text]').value
        }
    </script>
    @endpush
</div>
