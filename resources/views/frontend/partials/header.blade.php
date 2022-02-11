<!-- Offcanvas Menu Begin -->
<div class="offcanvas-menu-overlay"></div>
<div class="offcanvas-menu-wrapper">
    <div class="offcanvas__option">
        <div class="offcanvas__links">
            <a href="#">Sign in</a>
            <a href="#">FAQs</a>
        </div>
        <div class="offcanvas__top__hover">
            <span>Usd <i class="arrow_carrot-down"></i></span>
            <ul>
                <li>USD</li>
                <li>EUR</li>
                <li>USD</li>
            </ul>
        </div>
    </div>
    <div class="offcanvas__nav__option">
        <a href="#" class="search-switch"><img src="{{ asset('frontend/img/icon/search.png') }}" alt=""></a>
        <a href="#"><img src="{{ asset('frontend/img/icon/heart.png') }}" alt=""></a>
        @php
            $cartCollection = Cart::getContent();
            /* $cartCollection->count(); */
        @endphp
        <a href="{{ route('carrito') }}"><img src="{{ asset('frontend/img/icon/cart.png') }}" alt=""> <span>{{ \Cart::getTotalQuantity() }}</span></a>
        <div class="price">${{ number_format(\Cart::getTotal(), '2', '.', '') }}</div>
    </div>
    {{-- <div id="mobile-menu-wrap"></div> --}}
    @livewire('frontend.mobile-menu')
    <div class="offcanvas__text">
        <p>Free shipping, 30-day return or refund guarantee.</p>
    </div>
</div>
<!-- Offcanvas Menu End -->

<!-- Header Section Begin -->
<header class="header sticky-top">
    {{-- <div class="header__top">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-7">
                    <div class="header__top__left">
                        <p>Free shipping, 30-day return or refund guarantee.</p>
                    </div>
                </div>
                <div class="col-lg-6 col-md-5">
                    <div class="header__top__right">
                        <div class="header__top__links">
                            @auth
                                <div class="header__top__hover">
                                    <span>{{ auth()->user()->name }} <i class="arrow_carrot-down"></i></span>
                                    <ul class="w-auto">
                                        <li><a href="{{ route('perfil') }}" class="text-dark">Perfil</a></li>
                                        <li><hr></li>
                                        <li class="text-center">
                                            <a class="text-dark" href="{{ route('logout') }}"
                                                onclick="event.preventDefault();
                                                            document.getElementById('logout-form').submit();">
                                                {{ __('Cerrar Sesión') }}
                                            </a>
        
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                                @csrf
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                                
                            @else
                                <a type="button" data-toggle="modal" data-target="#accederModal">Acceder</a>
                            @endauth
                            <a href="#">FAQs</a>
                        </div>
                        <div class="header__top__hover">
                            <span>Usd <i class="arrow_carrot-down"></i></span>
                            <ul>
                                <li>USD</li>
                                <li>EUR</li>
                                <li>USD</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-3">
                <div class="header__logo">
                    <a href="{{ url('/') }}"><img src="{{ asset('frontend/img/logo.png') }}" alt=""></a>
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                @livewire('frontend.header-options')
            </div>
            <div class="col-lg-3 col-md-3">
                <div class="header__nav__option">
                    {{-- <a href="#" class="search-switch"><img src="{{ asset('frontend/img/icon/search.png') }}" alt=""></a>
                    <a href="#"><img src="{{ asset('frontend/img/navbar-avatar.png') }}" alt="avatar"></a> --}}
                    {{-- <a href="#"><img src="{{ asset('frontend/img/icon/heart.png') }}" alt=""></a> --}}
                    {{-- <a href="{{ route('carrito') }}"><img src="{{ asset('frontend/img/icon/cart.png') }}" alt=""> <span>{{ \Cart::getTotalQuantity() }}</span></a>
                    <div class="price">${{ number_format(\Cart::getTotal(), '2', '.', '') }}</div> --}}
                    @livewire('frontend.cart-section')
                </div>
            </div>
        </div>
        <div class="canvas__open"><i class="fa fa-bars"></i></div>
    </div>
</header>
    
<!-- Header Section End -->