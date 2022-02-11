<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="footer__about">
                    <div class="footer__logo">
                        <a href="#"><img src="{{ asset('frontend/img/footer-logo.png') }}" alt=""></a>
                    </div>
                    <p>Eslogan de la compañia.</p>
                    <a href="#"><img src="{{ asset('frontend/img/payment.png') }}" alt=""></a>
                </div>
            </div>
            <div class="col-lg-2 offset-lg-1 col-md-3 col-sm-6">
                <div class="footer__widget">
                    <h6>Productos</h6>
                    <ul>
                        <li><a href="{{ route('productos') }}">Productos</a></li>
                        {{-- <li><a href="#">Trending Shoes</a></li>
                        <li><a href="#">Accessories</a></li>
                        <li><a href="#">Sale</a></li> --}}
                    </ul>
                </div>
            </div>
            <div class="col-lg-2 col-md-3 col-sm-6">
                <div class="footer__widget">
                    <h6>Nuestra Tienda</h6>
                    <ul>
                        <li><a href="{{ route('contact') }}">Contactanos</a></li>
                        <li><a href="{{ route('about') }}">Sobre Nosotros</a></li>
                        {{-- <li><a href="#">Delivary</a></li>
                        <li><a href="#">Return & Exchanges</a></li> --}}
                        <li><a href="https://wa.me/50377948668" target="_blank">Whatsapp</a></li>
                        <li><a href="https://m.me/110812464804606" target="_blank">Facebook</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-3 offset-lg-1 col-md-6 col-sm-6">
                <div class="footer__widget">
                    <h6>Noticias</h6>
                    <div class="footer__newslatter">
                        <p>Se el primer en enterar de los nuevos productos, ofertas y mucho más.</p>
                        <form action="#">
                            <input type="text" placeholder="Tú Correo Electrónico">
                            <button type="submit"><span class="icon_mail_alt"></span></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="footer__copyright__text">
                    <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                    <p>Copyright ©
                        <script>
                            document.write(new Date().getFullYear());
                        </script>2020 All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
                    </p>
                    <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                </div>
            </div>
        </div>
    </div>
</footer>