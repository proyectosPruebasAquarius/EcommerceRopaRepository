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
                <div class="row">
                    <div class="col-lg-3 col-md-3">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab">
                                    <div class="product__thumb__pic set-bg" data-setbg="{{ $product->imagen ? asset($product->imagen) : asset('frontend/img/no-picture-frame.svg') }}">
                                    </div>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tabs-2" role="tab">
                                    <div class="product__thumb__pic set-bg" data-setbg="{{ $product->imagen ? asset($product->imagen) : asset('frontend/img/no-picture-frame.svg') }}">
                                    </div>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tabs-3" role="tab">
                                    <div class="product__thumb__pic set-bg" data-setbg="{{ $product->imagen ? asset($product->imagen) : asset('frontend/img/no-picture-frame.svg') }}">
                                    </div>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tabs-4" role="tab">
                                    <div class="product__thumb__pic set-bg" data-setbg="{{ $product->imagen ? asset($product->imagen) : asset('frontend/img/no-picture-frame.svg') }}">
                                        <i class="fa fa-play"></i>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-lg-6 col-md-9">
                        <div class="tab-content">
                            <div class="tab-pane active" id="tabs-1" role="tabpanel">
                                <div class="product__details__pic__item">
                                    <img src="{{ $product->imagen ? asset($product->imagen) : asset('frontend/img/no-picture-frame.svg') }}" alt="">
                                </div>
                            </div>
                            <div class="tab-pane" id="tabs-2" role="tabpanel">
                                <div class="product__details__pic__item">
                                    <img src="{{ $product->imagen ? asset($product->imagen) : asset('frontend/img/no-picture-frame.svg') }}" alt="">
                                </div>
                            </div>
                            <div class="tab-pane" id="tabs-3" role="tabpanel">
                                <div class="product__details__pic__item">
                                    <img src="{{ $product->imagen ? asset($product->imagen) : asset('frontend/img/no-picture-frame.svg') }}" alt="">
                                </div>
                            </div>
                            <div class="tab-pane" id="tabs-4" role="tabpanel">
                                <div class="product__details__pic__item">
                                    <img src="{{ $product->imagen ? asset($product->imagen) : asset('frontend/img/no-picture-frame.svg') }}" alt="">
                                    <a href="https://www.youtube.com/watch?v=8PJ3_p7VqHw&list=RD8PJ3_p7VqHw&start_radio=1" class="video-popup"><i class="fa fa-play"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="product__details__content">
            <div class="container">
                <div class="row d-flex justify-content-center">
                    <div class="col-lg-8">
                        <div class="product__details__text">
                            <h4>{{ $product->nombre }}</h4>
                            <div class="rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star-o"></i>
                                <span> - 5 Reviews</span>
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shop Details Section End -->

    <!-- Related Section Begin -->
    @php
        $related = \DB::table('inventarios')->join('productos', 'inventarios.id_producto', '=', 'productos.id')
        ->join('detalles_productos', 'productos.id_detalle_producto', '=', 'detalles_productos.id')        
        ->select('inventarios.*', 'productos.nombre', 'productos.imagen', 'productos.descripcion')
        ->where([
            ['inventarios.estado', 1],
            ['detalles_productos.id_categoria', $product->id_categoria],
            ['inventarios.id', '!=', $product->id]
        ])
        ->distinct()->limit(4)->get();
    @endphp
    @if(count($related))
        <section class="related spad">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <h3 class="related-title">Productos Relacionados</h3>
                    </div>
                </div>
                <div class="row">
                    @foreach ($related as $rl)                                   
                        <div class="col-lg-3 col-md-6 col-sm-6 col-sm-6">
                            <div class="product__item">
                                <div class="product__item__pic set-bg" data-setbg="{{ $rl->imagen ? asset('storage/'.json_decode($rl->imagen)[0]) : asset('frontend/img/no-picture-frame.svg') }}">
                                    @php
                                        $createdAt = new DateTime($rl->created_at);
                                        $actualDate = new DateTime('NOW');
                                        //$actualDate = $actualDate->format('Y-m-d H:i:s')
                                    @endphp
                                    @if($createdAt->diff($actualDate)->format('%a') <= 7)
                                        {{-- $createdAt->diff($actualDate)->format('%R%adías') --}}
                                        <span class="label">{{ __('Nuevo') }}</span>
                                    @endif
                                    <ul class="product__hover">
                                        <li><a href="#"><img src="{{ asset('frontend/img/icon/heart.png') }}" alt=""></a></li>
                                        <li><a href="#"><img src="{{ asset('frontend/img/icon/compare.png') }}" alt=""> <span>Compare</span></a></li>
                                        <li><a href="#"><img src="{{ asset('frontend/img/icon/search.png') }}" alt=""></a></li>
                                    </ul>
                                </div>
                                <div class="product__item__text">
                                    <h6>{{ $rl->nombre }}</h6>
                                    <a href="#" class="add-cart">+ Agregar al carrito</a>
                                    <div class="rating">
                                        <i class="fa fa-star-o"></i>
                                        <i class="fa fa-star-o"></i>
                                        <i class="fa fa-star-o"></i>
                                        <i class="fa fa-star-o"></i>
                                        <i class="fa fa-star-o"></i>
                                    </div>
                                    <h5>${{ $rl->precio_venta }}</h5>
                                    <div class="product__color__select">
                                        <label for="pc-1">
                                            <input type="radio" id="pc-1">
                                        </label>
                                        <label class="active black" for="pc-2">
                                            <input type="radio" id="pc-2">
                                        </label>
                                        <label class="grey" for="pc-3">
                                            <input type="radio" id="pc-3">
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    {{-- <div class="col-lg-3 col-md-6 col-sm-6 col-sm-6">
                        <div class="product__item">
                            <div class="product__item__pic set-bg" data-setbg="img/product/product-2.jpg">
                                <ul class="product__hover">
                                    <li><a href="#"><img src="img/icon/heart.png" alt=""></a></li>
                                    <li><a href="#"><img src="img/icon/compare.png" alt=""> <span>Compare</span></a></li>
                                    <li><a href="#"><img src="img/icon/search.png" alt=""></a></li>
                                </ul>
                            </div>
                            <div class="product__item__text">
                                <h6>Piqué Biker Jacket</h6>
                                <a href="#" class="add-cart">+ Add To Cart</a>
                                <div class="rating">
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>
                                </div>
                                <h5>$67.24</h5>
                                <div class="product__color__select">
                                    <label for="pc-4">
                                        <input type="radio" id="pc-4">
                                    </label>
                                    <label class="active black" for="pc-5">
                                        <input type="radio" id="pc-5">
                                    </label>
                                    <label class="grey" for="pc-6">
                                        <input type="radio" id="pc-6">
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6 col-sm-6">
                        <div class="product__item sale">
                            <div class="product__item__pic set-bg" data-setbg="img/product/product-3.jpg">
                                <span class="label">Sale</span>
                                <ul class="product__hover">
                                    <li><a href="#"><img src="img/icon/heart.png" alt=""></a></li>
                                    <li><a href="#"><img src="img/icon/compare.png" alt=""> <span>Compare</span></a></li>
                                    <li><a href="#"><img src="img/icon/search.png" alt=""></a></li>
                                </ul>
                            </div>
                            <div class="product__item__text">
                                <h6>Multi-pocket Chest Bag</h6>
                                <a href="#" class="add-cart">+ Add To Cart</a>
                                <div class="rating">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star-o"></i>
                                </div>
                                <h5>$43.48</h5>
                                <div class="product__color__select">
                                    <label for="pc-7">
                                        <input type="radio" id="pc-7">
                                    </label>
                                    <label class="active black" for="pc-8">
                                        <input type="radio" id="pc-8">
                                    </label>
                                    <label class="grey" for="pc-9">
                                        <input type="radio" id="pc-9">
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6 col-sm-6">
                        <div class="product__item">
                            <div class="product__item__pic set-bg" data-setbg="img/product/product-4.jpg">
                                <ul class="product__hover">
                                    <li><a href="#"><img src="img/icon/heart.png" alt=""></a></li>
                                    <li><a href="#"><img src="img/icon/compare.png" alt=""> <span>Compare</span></a></li>
                                    <li><a href="#"><img src="img/icon/search.png" alt=""></a></li>
                                </ul>
                            </div>
                            <div class="product__item__text">
                                <h6>Diagonal Textured Cap</h6>
                                <a href="#" class="add-cart">+ Add To Cart</a>
                                <div class="rating">
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>
                                </div>
                                <h5>$60.9</h5>
                                <div class="product__color__select">
                                    <label for="pc-10">
                                        <input type="radio" id="pc-10">
                                    </label>
                                    <label class="active black" for="pc-11">
                                        <input type="radio" id="pc-11">
                                    </label>
                                    <label class="grey" for="pc-12">
                                        <input type="radio" id="pc-12">
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                </div>
            </div>
        </section>
    @endif
    <!-- Related Section End -->
    @push('scripts')
    <script>
        let addToCartTrigger = () => {
            @this.qty = document.querySelector('input[type=text]').value
        }
    </script>
    @endpush
</div>
