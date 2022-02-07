<div>
    <section class="shopping-cart spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="shopping__cart__table">
                        <table>
                            <thead>
                                <tr>
                                    <th>Producto</th>
                                    <th>Cantidad</th>
                                    <th>Total</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($cart as $key => $value)
                                    <tr>
                                        <td class="product__cart__item">
                                            <div class="product__cart__item__pic">
                                                <img src="{{ $value['attributes']['image'] ? asset('storage/'.json_decode($value['attributes']['image'])[0]) : asset('frontend/img/no-picture-frame.svg') }}" alt="Product Image" width="90" height="90">
                                            </div>
                                            <div class="product__cart__item__text">
                                                <h6><a href="{{ route('details', $value['name']) }}">{{ $value['name'] }}</a></h6>
                                                <h5>${{ $value['price'] }}</h5>
                                            </div>
                                        </td>
                                        <td class="quantity__item">
                                            <div class="quantity">
                                                
                                                    <livewire:frontend.update-qty :item="$value" :key="$value['id']"/>                                                    
                                                
                                            </div>
                                        </td>
                                        <td class="cart__price">$ {{ number_format($value['price'] * $value['quantity'], 2, '.', '') }}</td>
                                        <td class="cart__close"><i class="fa fa-close" role="button" wire:click="removeFromCart(@js($value['id']))"></i></td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="mx-auto text-center">
                                            {{ __('Ocurrio un error, hacegurese que su carrito no este vacio o recargue la pagina.') }}
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="continue__btn">
                                <a href="{{ route('productos') }}">Continuar Comprando</a>
                            </div>
                        </div>
                        {{-- <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="continue__btn update__btn">
                                <a href="#"><i class="fa fa-spinner"></i> Actualizar Carrito</a>
                            </div>
                        </div> --}}
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="cart__discount">
                        <h6>Código de Descuento</h6>
                        <form action="#">
                            <input type="text" placeholder="Código del cupón">
                            <button type="submit">Aplicar</button>
                        </form>
                    </div>
                    <div class="cart__total sticky-top">
                        <h6>Total del Carrito</h6>
                        <ul>
                            <li>Subtotal <span>$ {{ \Cart::getSubTotal() }}</span></li>
                            <li>Total <span>$ {{ \Cart::getTotal() }}</span></li>
                        </ul>
                        <a href="{{ route('checkout') }}" class="primary-btn">Finalizar Compra</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @push('scripts')
        <script>
            
            /* window.addEventListener('reloadCart', () => {

            alert('Name updated to: ');

            }) */

            /* Livewire.on('reloadCart', e => {

                alert('hola' + e)
                var proQty = $('.pro-qty-2');
                proQty.prepend('<span class="fa fa-angle-left dec qtybtn"></span>');
                proQty.append('<span class="fa fa-angle-right inc qtybtn"></span>');

            }) */

            window.addEventListener('render-span', e => {

                /* e.forEach(el => {
                    alert('Name updated to: ' + el);
                }) */

            })
        </script>
    @endpush
</div>
