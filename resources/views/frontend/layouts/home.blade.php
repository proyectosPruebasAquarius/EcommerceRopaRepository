@extends('frontend.blank')

@section('title', 'Ecommerce - Inicio')

@section('content')
    <!-- Hero Section Begin -->
<section class="hero">
    <div class="hero__slider owl-carousel">
        @forelse ($banners as $banner)
            <div class="hero__items set-bg" data-setbg="{{ asset($banner->imagen) }}">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-5 col-lg-7 col-md-8">
                            <div class="hero__text">
                                @if($banner->sub_titulo)
                                    <h6>{{ $banner->sub_titulo }}</h6>
                                @endif
                                <h2>{{ $banner->titulo }}</h2>
                                <p>{{ $banner->descripcion }}</p>
                                <a href="{{ route('productos') }}" class="primary-btn">Comprar ahora <span class="arrow_right"></span></a>
                                <div class="hero__social">
                                    <a href="#"><i class="fa fa-facebook"></i></a>
                                    <a href="#"><i class="fa fa-twitter"></i></a>
                                    <a href="#"><i class="fa fa-pinterest"></i></a>
                                    <a href="#"><i class="fa fa-instagram"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            
        @endforelse
        {{-- 
        <div class="hero__items set-bg" data-setbg="{{ asset('frontend/img/hero/hero-2.jpg') }}">
            <div class="container">
                <div class="row">
                    <div class="col-xl-5 col-lg-7 col-md-8">
                        <div class="hero__text">
                            <h6>Summer Collection</h6>
                            <h2>Fall - Winter Collections 2030</h2>
                            <p>A specialist label creating luxury essentials. Ethically crafted with an unwavering commitment to exceptional quality.</p>
                            <a href="#" class="primary-btn">Shop now <span class="arrow_right"></span></a>
                            <div class="hero__social">
                                <a href="#"><i class="fa fa-facebook"></i></a>
                                <a href="#"><i class="fa fa-twitter"></i></a>
                                <a href="#"><i class="fa fa-pinterest"></i></a>
                                <a href="#"><i class="fa fa-instagram"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
    </div>
</section>
<!-- Hero Section End -->

<!-- Banner Section Begin -->
<section class="banner spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-7 offset-lg-4">
                <div class="banner__item">
                    <div class="banner__item__pic">
                        <img src="{{ asset('frontend/img/banner/banner-1.jpg') }}" alt="">
                    </div>
                    <div class="banner__item__text">
                        <h2>Collección de Ropa 2030</h2>
                        <a href="{{ route('productos') }}">Comprar ahora</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="banner__item banner__item--middle">
                    <div class="banner__item__pic">
                        <img src="{{ asset('frontend/img/banner/banner-2.jpg') }}" alt="">
                    </div>
                    <div class="banner__item__text">
                        <h2>Accesorios</h2>
                        <a href="{{ route('productos') }}">Comprar Ahora</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-7">
                <div class="banner__item banner__item--last">
                    <div class="banner__item__pic">
                        <img src="{{ asset('frontend/img/banner/banner-3.jpg') }}" alt="">
                    </div>
                    <div class="banner__item__text">
                        <h2>Zapatos Veraniegos 2030</h2>
                        <a href="{{ route('productos') }}">Comprar ahora</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Banner Section End -->

<!-- Product Section Begin -->
<section class="product spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <ul class="filter__controls">
                    <li class="active" data-filter="*">Más Vendidos</li>
                    <li data-filter=".new-arrivals">Nuevos Productos</li>
                    <li data-filter=".hot-sales">Ofertas</li>
                </ul>
            </div>
        </div>
        <div class="row product__filter">
            @forelse ($productos as $pr)
                @php
                    $createdAt = new DateTime($pr->created_at);
                    $actualDate = new DateTime('NOW');                    
                @endphp
                <div class="col-lg-3 col-md-6 col-sm-6 col-md-6 col-sm-6 mix @if ($pr->precio_descuento) hot-sales new-arrivals @else new-arrivals @endif">
                    <div class="product__item" onclick="location.href = @js(route('details', $pr->nombre))">
                        <div class="product__item__pic set-bg" data-setbg="{{ asset('storage/'.json_decode($pr->imagen)[0]) }}">
                            {{-- @if($createdAt->diff($actualDate)->format('%a') <= 7 && $pr->precio_descuento) 
                                <span class="label" style="color: #fff; background: #111111">Oferta</span>
                            @else --}}
                            @if ($pr->precio_descuento) 
                                <span class="label" style="color: #fff; background: #111111">Oferta</span>
                            @else
                                <span class="label">Nuevo</span>
                            @endif                            
                            <ul class="product__hover">
                                <li>
                                    <a href="#"><img src="{{ asset('frontend/img/icon/heart.png') }}" alt=""></a>
                                </li>
                                <li>
                                    <a href="#"><img src="{{ asset('frontend/img/icon/compare.png') }}" alt=""> <span>Compare</span></a>
                                </li>
                                <li>
                                    <a href="#"><img src="{{ asset('frontend/img/icon/search.png') }}" alt=""></a>
                                </li>
                            </ul>
                        </div>
                        <div class="product__item__text">
                            <h6>{{ $pr->nombre }}</h6>
                            <a href="#" class="add-cart">+ Add To Cart</a>
                            @php
                                $opiniones = DB::table('opiniones')->where('id_producto', $pr->id_producto);                                    
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
                            @if ($pr->precio_descuento)
                                <h5>${{ $pr->precio_descuento }} <span class="discount">${{ $pr->precio_venta }}</span></h5>
                            @else
                                <h5>${{ $pr->precio_venta }}</h5>
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
            @empty
                
            @endforelse
        </div>
    </div>
</section>
<!-- Product Section End -->

<!-- Categories Section Begin -->
<section class="categories spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="categories__text">
                    <h2><a href="{{ route('productos') }}">Ropa en Oferta</a> <br /> <span><a href="{{ route('productos') }}">Zapatos</a></span> <br /> <a href="{{ route('productos') }}">Accesorios</a></h2>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="categories__hot__deal">
                    <img src="{{ asset('frontend/img/product-sale.png') }}" alt="">
                    <div class="hot__deal__sticker">
                        <span>Oferta</span>
                        <h5>$29.99</h5>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 offset-lg-1">
                <div class="categories__deal__countdown">
                    <span>Oferta de la semana</span>
                    <h2>Mochila de lona con multiples bolsillos</h2>
                    {{-- Para cambiar el texto direjase al archivo main.js --}}
                    <div class="categories__deal__countdown__timer" id="countdown">
                        <div class="cd-item">
                            <span>3</span>
                            <p>Days</p>
                        </div>
                        <div class="cd-item">
                            <span>1</span>
                            <p>Hours</p>
                        </div>
                        <div class="cd-item">
                            <span>50</span>
                            <p>Minutes</p>
                        </div>
                        <div class="cd-item">
                            <span>18</span>
                            <p>Seconds</p>
                        </div>
                    </div>
                    <a href="{{ route('productos') }}" class="primary-btn">Comprar ahora</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Categories Section End -->

<!-- Instagram Section Begin -->
<section class="instagram spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="instagram__pic">
                    <div class="instagram__pic__item set-bg" data-setbg="{{ asset('frontend/img/instagram/instagram-1.jpg') }}"></div>
                    <div class="instagram__pic__item set-bg" data-setbg="{{ asset('frontend/img/instagram/instagram-2.jpg') }}"></div>
                    <div class="instagram__pic__item set-bg" data-setbg="{{ asset('frontend/img/instagram/instagram-3.jpg') }}"></div>
                    <div class="instagram__pic__item set-bg" data-setbg="{{ asset('frontend/img/instagram/instagram-4.jpg') }}"></div>
                    <div class="instagram__pic__item set-bg" data-setbg="{{ asset('frontend/img/instagram/instagram-5.jpg') }}"></div>
                    <div class="instagram__pic__item set-bg" data-setbg="{{ asset('frontend/img/instagram/instagram-6.jpg') }}"></div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="instagram__text">
                    <h2>Instagram</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                    <h3>#Ropa_Fashion</h3>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Instagram Section End -->

<!-- Latest Blog Section Begin -->
<section class="latest spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title">
                    <span>Últimas Noticias</span>
                    <h2>Nuevas Noticias Sobre Moda</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="blog__item">
                    <div class="blog__item__pic set-bg" data-setbg="{{ asset('frontend/img/blog/blog-1.jpg') }}"></div>
                    <div class="blog__item__text">
                        <span><img src="{{ asset('frontend/img/icon/calendar.png') }}" alt=""> 16 Febrero 2020</span>
                        <h5>Café y moda</h5>
                        <a href="#">Leer más</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="blog__item">
                    <div class="blog__item__pic set-bg" data-setbg="{{ asset('frontend/img/blog/blog-2.jpg') }}"></div>
                    <div class="blog__item__text">
                        <span><img src="{{ asset('frontend/img/icon/calendar.png') }}" alt=""> 21 Febrero 2020</span>
                        <h5>Camisetas de verano</h5>
                        <a href="#">Leer más</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="blog__item">
                    <div class="blog__item__pic set-bg" data-setbg="{{ asset('frontend/img/blog/blog-3.jpg') }}"></div>
                    <div class="blog__item__text">
                        <span><img src="{{ asset('frontend/img/icon/calendar.png') }}" alt=""> 28 Febrero 2020</span>
                        <h5>El beneficio a la salud de usar gafas de sol</h5>
                        <a href="#">Leer más</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Latest Blog Section End -->
@endsection