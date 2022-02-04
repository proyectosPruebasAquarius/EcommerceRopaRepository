<div>
    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__text">
                        <h4>Shop</h4>
                        <div class="breadcrumb__links">
                            <a href="{{ url('/') }}">Inicio</a>
                            <span>{{ __('Productos') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Shop Section Begin -->
    <section class="shop spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="shop__sidebar">
                        <div class="shop__sidebar__search">
                            <form>
                                <input type="text" placeholder="Buscar..." wire:model="search">
                                <button type="submit" disabled><span class="icon_search"></span></button>
                            </form>
                        </div>
                        <div class="shop__sidebar__accordion">
                            <div class="accordion" id="accordionExample">
                                <div class="card">
                                    <div class="card-heading">
                                        <a data-toggle="collapse" data-target="#collapseOne">Categorias</a>
                                    </div>
                                    <div id="collapseOne" class="collapse show" data-parent="#accordionExample">
                                        <div class="card-body">
                                            <div class="shop__sidebar__categories">
                                                <ul class="nice-scroll">
                                                    @forelse ($categorias as $categoria)
                                                        @php
                                                            $count = \DB::table('productos')->join('detalles_productos', 'productos.id_detalle_producto', '=', 'detalles_productos.id')->where('detalles_productos.id_categoria', $categoria->id)->count();
                                                        @endphp
                                                        <li><a type="button" wire:click="filterByCategory(@js($categoria->id))" @if ($categoria->id == $category) class="active" @endif>{{ $categoria->nombre }} ({{ $count }})</a></li>
                                                    @empty
                                                        
                                                    @endforelse
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-heading">
                                        <a data-toggle="collapse" data-target="#collapseTwo">Marcas</a>
                                    </div>
                                    <div id="collapseTwo" class="collapse show" data-parent="#accordionExample">
                                        <div class="card-body">
                                            <div class="shop__sidebar__brand">
                                                <ul>
                                                    @forelse ($marcas as $m)
                                                        <li><a type="button" wire:click="filterByBrand(@js($m->id))" @if ($m->id == $marca) class="active" @endif>{{ $m->nombre }}</a></li>
                                                    @empty
                                                        
                                                    @endforelse
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-heading">
                                        <a data-toggle="collapse" data-target="#collapseThree">Filtrar por Precio</a>
                                    </div>
                                    <div id="collapseThree" class="collapse show" data-parent="#accordionExample">
                                        <div class="card-body">
                                            <div class="shop__sidebar__price">
                                                <ul>
                                                    <li><a type="button" wire:click="filterByPrice([0.00, 50.00])" @if($filtPrecios == [0.00, 50.00]) class="active" @endif>$0.00 - $50.00</a></li>
                                                    <li><a type="button" wire:click="filterByPrice([50.00, 100.00])" @if($filtPrecios == [50.00, 100.00]) class="active" @endif>$50.00 - $100.00</a></li>
                                                    <li><a type="button" wire:click="filterByPrice([100.00, 150.00])" @if($filtPrecios == [100.00, 150.00]) class="active" @endif>$100.00 - $150.00</a></li>
                                                    <li><a type="button" wire:click="filterByPrice([150.00, 200.00])" @if($filtPrecios == [150.00, 200.00]) class="active" @endif>$150.00 - $200.00</a></li>
                                                    <li><a type="button" wire:click="filterByPrice([200.00, 250.00])" @if($filtPrecios == [200.00, 250.00]) class="active" @endif>$200.00 - $250.00</a></li>
                                                    <li><a type="button" wire:click="filterByPrice([250.00, 10000.00])" @if($filtPrecios == [250.00, 10000.00]) class="active" @endif>250.00+</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-heading">
                                        <a data-toggle="collapse" data-target="#collapseFour">Tallas</a>
                                    </div>
                                    <div id="collapseFour" class="collapse show" data-parent="#accordionExample">
                                        <div class="card-body">
                                            <div class="shop__sidebar__size">
                                                @forelse ($tallas as $talla)
                                                    <label for="{{ $loop->index }}" @if (in_array($talla->nombre, $filtTallas)) class="active" @endif>{{ $talla->nombre }}
                                                        <input type="radio" id="{{ $loop->index }}" wire:click="filterBySize(@js($talla->nombre))">
                                                    </label>
                                                @empty
                                                    
                                                @endforelse                                               
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-heading">
                                        <a data-toggle="collapse" data-target="#collapseFive">Colores</a>
                                    </div>
                                    <div id="collapseFive" class="collapse show" data-parent="#accordionExample">
                                        <div class="card-body">
                                            <div class="shop__sidebar__color ml-3">
                                                @forelse ($colors as $color)
                                                    <label style="background: {{ $color->color }}" for="sp-{{ $loop->index }}" @if (in_array($color->color, $filtColors)) class="active" @endif>
                                                        <input type="radio" id="sp-{{ $loop->index }}"  wire:click="filterByColor(@js($color->color))">
                                                    </label>
                                                @empty
                                                    
                                                @endforelse
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-heading">
                                        <a data-toggle="collapse" data-target="#collapseSix">Tags</a>
                                    </div>
                                    <div id="collapseSix" class="collapse show" data-parent="#accordionExample">
                                        <div class="card-body">
                                            <div class="shop__sidebar__tags">
                                                <a href="#">Product</a>
                                                <a href="#">Bags</a>
                                                <a href="#">Shoes</a>
                                                <a href="#">Fashio</a>
                                                <a href="#">Clothing</a>
                                                <a href="#">Hats</a>
                                                <a href="#">Accessories</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="shop__product__option">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="shop__product__option__left">
                                    <p>Mostrando {{ $actualCount }}–{{ $pagination }} de {{ $totalCount }} resultados</p>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="shop__product__option__right">
                                    <p>Ordener por:</p>
                                    <select wire:model="sortOrder">
                                        <option value="productos.nombre, asc" selected>A - Z</option>
                                        <option value="productos.nombre, desc">Z - A</option>
                                        <option value="inventarios.precio_venta, asc">Menor a Mayor</option>
                                        <option value="inventarios.precio_venta, desc">Mayor a Menor</option>                                        
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        @forelse ($inventarios as $inventario)
                            <div class="col-lg-4 col-md-6 col-sm-6">
                                <div class="product__item" style="cursor: pointer;" onclick="location.href = @js(route('details', $inventario->nombre))">
                                    <div class="product__item__pic set-bg" data-setbg="{{ $inventario->imagen ? asset('storage/'.json_decode($inventario->imagen)[0]) : 'frontend/img/no-picture-frame.svg' }}">
                                        <ul class="product__hover">
                                            <li><a href="#"><img src="{{ asset('frontend/img/icon/heart.png') }}" alt=""></a></li>
                                            <li><a href="#"><img src="{{ asset('frontend/img/icon/compare.png') }}" alt=""> <span>Compare</span></a>
                                            </li>
                                            <li><a href="#"><img src="{{ asset('frontend/img/icon/search.png') }}" alt=""></a></li>
                                        </ul>
                                    </div>
                                    <div class="product__item__text">
                                        <h6>{{ $inventario->nombre }}</h6>
                                        <a href="#" class="add-cart">+ Agregar al carrito</a>
                                        <div class="rating">
                                            <i class="fa fa-star-o"></i>
                                            <i class="fa fa-star-o"></i>
                                            <i class="fa fa-star-o"></i>
                                            <i class="fa fa-star-o"></i>
                                            <i class="fa fa-star-o"></i>
                                        </div>
                                        <h5>${{ $inventario->precio_venta }}</h5>
                                        @php
                                            $colores = \DB::table('detalles_colores')->join('colores', 'detalles_colores.id_color', '=', 'colores.id')->join('productos', 'detalles_colores.id_producto', '=', 'productos.id')
                                            ->where('detalles_colores.id_producto', $inventario->id_producto)->select('detalles_colores.*',  'colores.nombre')->get();
                                        @endphp
                                        <div class="product__color__select">
                                            @forelse ($colores as $color)
                                                @if($loop->first)
                                                    <label class="active" for="pc-{{ $loop->index }}" style="background: {{ $color->color }} !important">
                                                        <input type="radio" id="pc-{{ $loop->index }}">
                                                    </label>
                                                @else
                                                    <label for="pc-{{ $loop->index }}" style="background: {{ $color->color }}">
                                                        <input type="radio" id="pc-{{ $loop->index }}">
                                                    </label>
                                                @endif
                                                
                                                {{-- <label class="active black" for="pc-5">
                                                    <input type="radio" id="pc-5">
                                                </label>
                                                <label class="grey" for="pc-6">
                                                    <input type="radio" id="pc-6">
                                                </label> --}}
                                            @empty
                                                
                                            @endforelse
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-12">
                                <span class="text-center mx-auto">
                                    @if ($search)
                                        <p class="text-muted">No se encontraron productos que coincidan con tú busqueda.</p>
                                        <img src="{{ asset('frontend/img/no-search-match.svg') }}" alt="No data">
                                    @else
                                        <p class="text-muted">No se encontraron productos, por favor intentelo más tarde...</p>
                                        <img src="{{ asset('frontend/img/empty-state-grid.svg') }}" alt="No data">
                                    @endif
                                </span>
                            </div>
                        @endforelse
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="product__pagination">
                                {{ $inventarios->links('livewire::custom-pagination') }} 
                                {{--<a class="active" href="#">1</a>
                                <a href="#">2</a>
                                <a href="#">3</a>
                                <span>...</span>
                                <a href="#">21</a>--}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shop Section End -->

    @push('scripts')
        <script>
            window.addEventListener('reload-select', () => {

                $("select").niceSelect();

                var head= document.getElementsByTagName('head')[0];
                var script= document.createElement('script');
                script.src= 'frontend/js/main.js';
                head.appendChild(script);
            })

            $(".shop__product__option__right").on('change', 'select', function() {
                var sortBy = $("select").val();
                // do whatever with the value
                // console.log(sortBy);
                @this.sortOrder = sortBy;
            });
        </script>
    @endpush
</div>
