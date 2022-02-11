<div>
    <div class="row">
        <div class="col-lg-3 col-md-3">
            <ul class="nav nav-tabs" role="tablist">
                @forelse (json_decode($product->imagen) as $image)
                    <li class="nav-item">
                        <a class="nav-link @if ($loop->first) active @endif" data-toggle="tab" href="#tabs-{{ $loop->index }}" role="tab">
                            <div class="product__thumb__pic set-bg" data-setbg="{{ asset('storage/'.$image) }}">
                            </div>
                        </a>
                    </li>
                @empty
                    
                @endforelse
                {{-- <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#tabs-2" role="tab">
                        <div class="product__thumb__pic set-bg" data-setbg="{{ $product->imagen ? asset('storage/'.json_decode($product->imagen)[0]) : asset('frontend/img/no-picture-frame.svg') }}">
                        </div>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#tabs-3" role="tab">
                        <div class="product__thumb__pic set-bg" data-setbg="{{ $product->imagen ? asset('storage/'.json_decode($product->imagen)[0]) : asset('frontend/img/no-picture-frame.svg') }}">
                        </div>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#tabs-4" role="tab">
                        <div class="product__thumb__pic set-bg" data-setbg="{{ $product->imagen ? asset('storage/'.json_decode($product->imagen)[0]) : asset('frontend/img/no-picture-frame.svg') }}">
                            <i class="fa fa-play"></i>
                        </div>
                    </a>
                </li> --}}
            </ul>
        </div>
        <div class="col-lg-6 col-md-9">
            <div class="tab-content">
                @forelse (json_decode($product->imagen) as $image)
                    <div class="tab-pane @if ($loop->first) active @endif" id="tabs-{{ $loop->index }}" role="tabpanel">
                        <div class="product__details__pic__item">
                            <img src="{{ asset('storage/'.$image) }}" alt="">
                        </div>
                    </div>
                @empty
                    
                @endforelse
                
            </div>
        </div>
    </div>
</div>
