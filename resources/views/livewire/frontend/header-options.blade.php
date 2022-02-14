<div>
    <nav class="header__menu mobile-menu">
        <ul>
            <li @if (request()->route()->getName() == 'inicio') class="active" @endif><a href="{{ url('/') }}">Inicio</a></li>            
            <li @if (request()->route()->getName() == 'productos') class="active" @endif><a href="#">Productos</a>
                <ul class="dropdown">
                    <li><a href="{{ route('productos') }}">{{ __('Todos los productos') }}</a></li>
                    {{-- <li><a href="./shop-details.html">Shop Details</a></li>
                    <li><a href="./shopping-cart.html">Shopping Cart</a></li>
                    <li><a href="./checkout.html">Check Out</a></li>
                    <li><a href="./blog-details.html">Blog Details</a></li> --}}

                    @inject('Categoria', 'App\Models\Categoria')
                    @php
                        $categorys = $Categoria::where('estado', 1)->get();
                        /* $categorys = $DetalleProducto::join('categorias', 'detalles_productos.id_categoria', '=', 'categorias.id')
                        ->join('sub_categorias', 'detalles_productos.id_sub_categoria', '=', 'sub_categorias.id')
                        ->select('sub_categorias.nombre as sub_categoria', 'categorias.nombre as categoria', 'detalles_productos.*')->get(); */
                        
                    @endphp
                    @forelse ($categorys as $c)                 
                        @php
                            $submenus = \DB::table('detalles_productos')->where('detalles_productos.id_categoria', $c->id)
                            ->join('sub_categorias', 'detalles_productos.id_sub_categoria', '=', 'sub_categorias.id')
                            ->select('sub_categorias.*', 'detalles_productos.id_categoria')->distinct()->get();
                        @endphp                                                       
                        <li @if (count($submenus)) class="subMenu" @endif><a type="button" wire:click="storeInSession(@js($c->nombre), 'category')">{{ $c->nombre }}</a>
                            @if(count($submenus))
                                <ul class="dropdown-submenu">
                                    <li class="d-block d-md-none"><a type="button" wire:click="storeInSession(@js($c->nombre), 'category')">Todos los productos</a></li>
                                    @forelse ($submenus as $sub)
                                        <li><a type="button" wire:click="storeInSession(@js(['id' => $sub->nombre, 'id_categoria' => $c->nombre]), 'sub-menu')">{{ $sub->nombre }}</a></li>
                                    @empty
                                        
                                    @endforelse                                                
                                </ul>
                            @endif                                        
                        </li>
                        
                    @empty
                        
                    @endforelse
                </ul>
            </li>
            <li @if (request()->route()->getName() == 'about') class="active" @endif><a href="{{ route('about') }}">Sobre Nosotros</a></li>
            <li @if (request()->route()->getName() == 'contact') class="active" @endif><a href="{{ route('contact') }}">Contactanos</a></li>
        </ul>
    </nav>
</div>
