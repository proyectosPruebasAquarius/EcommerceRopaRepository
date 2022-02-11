<div>
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
                            <div class="product__item" onclick="location.href = @js(route('details', $rl->nombre))">
                                <div class="product__item__pic set-bg" data-setbg="{{ $rl->imagen ? asset('storage/'.json_decode($rl->imagen)[0]) : asset('frontend/img/no-picture-frame.svg') }}">
                                    @php
                                        $createdAt = new DateTime($rl->created_at);
                                        $actualDate = new DateTime('NOW');
                                        //$actualDate = $actualDate->format('Y-m-d H:i:s')
                                    @endphp
                                    @if($createdAt->diff($actualDate)->format('%a') <= 7)
                                        {{-- $createdAt->diff($actualDate)->format('%R%adías') --}}
                                        <span class="label">{{ __('Nuevo') }}</span>
                                    @elseif ($rl->precio_descuento)
                                        <span class="label" style="color: #fff; background: #111111">{{ __('Oferta') }}</span>
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
                                    @php
                                        $opiniones = DB::table('opiniones')->where('id_producto', $rl->id_producto);                                    
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
                                    @if ($rl->precio_descuento)
                                        <h5>{{ $rl->precio_descuento }} <span class="discount">${{ $rl->precio_venta }}</span></h5>
                                    @else
                                        <h5>${{ $rl->precio_venta }}</h5>
                                    @endif
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
</div>
