<div>
    <div class="navbar-cart">
        <a type="button" class="search-switch d-inline"><img src="{{ asset('frontend/img/icon/search.png') }}" alt=""></a>
                    
        @guest
        <a href="{{ route('login') }}"><img src="{{ asset('frontend/img/navbar-avatar.png') }}" alt="avatar"></a>
        @else
        <div class="dropdown">
            <a class="btn btn-sm dropdown-toggle  d-inline" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <img src="{{ asset('frontend/img/navbar-avatar.png') }}" alt="avatar"></a>
            </a>
            <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                @if (Auth::user()->id_tipo_usuario == 1)
                <a class="dropdown-item" type="button" href="{{ url('administracion/') }}">Administracion</a>
                <div class="dropdown-divider"></div>
                @endif
               


              <a class="dropdown-item" type="button" href="{{ route('perfil') }}">Perfil</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" type="button" href="{{ route('logout') }}"
              onclick="event.preventDefault();
                          document.getElementById('logout-form').submit();">Cerrar Sesión</a>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
            </div>
          </div>
        @endguest
        <div class="cart-items">
            <a href="javascript:void(0)" class="main-btn d-inline">
                <img src="{{ asset('frontend/img/icon/cart.png') }}" alt="">
                <span class="total-items">{{ Cart::getTotalQuantity()}}</span>
            </a>

            <div class="shopping-item">
                <div class="dropdown-cart-header">
                    <span>{{ Cart::getTotalQuantity()}} Productos</span>
                    @if(count($cart) > 0)
                        <a href="{{ url('/carrito') }}">Ver Carrito</a>
                    @endif        
                </div>
                <ul class="shopping-list" style="max-height: 280px; overflow-y: auto; position: relative;">
                    @forelse ($cart as $item)
                        <li>
                            <button class="remove mr-3" title="Remover este producto" wire:click.prevent="removeCart(@js($item['id']))"><i class="fa fa-times"></i></button>
                            <div class="cart-img-head">
                                <a class="cart-img" href="#"><img src="{{ $item['attributes']['image'] ? asset('storage/'.json_decode($item['attributes']['image'])[0]) : asset('frontend/img/no-picture-frame.svg') }}" alt="#"></a>
                            </div>
                            <div class="content text-left">
                                <h4><a href="{{ route('details', $item['name']) }}">
                                    {{ $item['name'] }}</a></h4>
                                <p class="quantity">{{ $item['quantity'] }}x - <span class="amount">${{ number_format($item['price'], 2, '.', '') }}</span></p>
                                <br>
                                <span>Talla: {{ $item['attributes']['size'] }}</span> <span>Color: {{ $item['attributes']['color'] }}</span>
                            </div>
                        </li>
                    @empty
                       <p class="text-center">{{ __('Carrito Vacio') }} </p>
                    @endforelse               
                </ul>
                <div class="bottom">
                    <div class="total">
                        <span>Total</span>
                        <span class="total-amount">${{ number_format(Cart::getTotal(), 2, '.', '') }}</span>
                    </div>
                    
                        @if(!\Cart::isEmpty())
                        <div class="button">
                            <a href="{{ route('checkout') }}" class="btn animate">Finalizar Compra</a>
                        </div>
                        @endif            
                    
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        <script>
            window.addEventListener('reload-scrollBar', () => {
                var ps = new PerfectScrollbar('.shopping-list', {
                    wheelSpeed: 1,
                    wheelPropagation: true,
                    minScrollbarLength: 20
                });
            })

            var ps = new PerfectScrollbar('.shopping-list', {
                wheelSpeed: 1,
                wheelPropagation: true,
                minScrollbarLength: 20
            });
        </script>
    @endpush
</div>
