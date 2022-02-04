@extends('frontend.blank')

@section('title', 'Ecommerce - Productos')

@section('content')
    @livewire('frontend.grids')

    @push('scripts')
        <script defer>
            'use strict';
            
            $("select").niceSelect();
            
            /* (function () {
                let selector = document.querySelector('.nice-select');
                let current = selector.querySelector('.current');
                current.querySelector('ul').setAttribute('wire:model', 'sortOrder');
            }()) */
        </script>
    @endpush
@endsection