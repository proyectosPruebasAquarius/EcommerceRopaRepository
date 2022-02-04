@extends('frontend.blank')

@section('title')
    Ecommerce - {{ $product }}
@endsection

@section('content')
    @livewire('frontend.details', ['name' => $product])

    @push('scripts')
        <script defer>
            (function () {
                const colors = document.querySelector('.product__details__option__color');
                const query = Array.from(colors.querySelectorAll('label'));
                query.forEach(e => {
                    e.addEventListener('click', () => {
                        query.forEach(e => {
                            e.classList.remove('active')
                        })
                        console.log(e);
                        e.classList.add('active')
                    }, false);
                })
            }())

            window.addEventListener('reload-js', () => {                            
                /* var prueba = @js(asset('frontend/js/main.js'));
                Array.from(document.querySelectorAll(`script[src="${prueba}"]`)).forEach(element => {
                    element.remove();
                }); */
                var head= document.getElementsByTagName('head')[0];
                var script= document.createElement('script');
                script.src= @js(asset('frontend/js/main.js'));
                head.appendChild(script);       
            })                        
        </script>
    @endpush
@endsection