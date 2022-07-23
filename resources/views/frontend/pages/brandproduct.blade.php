@extends('frontend.index')
@section('content')



<main class="main">
    <nav aria-label="breadcrumb" class="breadcrumb-nav mb-2">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ url('Brands') }}">Brands</a></li>
                <li class="breadcrumb-item"><a href="">{{ $BrandName->brand_name }}</a></li>
            </ol>
        </div><!-- End .container -->
    </nav><!-- End .breadcrumb-nav -->

    <div class="page-content">
        <div class="container-fluid">

            <div class="products">
                <div class="row justify-content-center">

                    @forelse($BrandProduct as $BrandProductShow)

                    <div class="col-6 col-md-4 col-lg-2">
                        <div class="product product-7 text-center">
                            <figure class="product-media">

                                @php
                                $dis_percentig = $BrandProductShow->discount_price / $BrandProductShow->sale_price*100;
                                @endphp

                                @if(isset($BrandProductShow->discount_price))
                                <span class="product-label label-top">{{ceil($dis_percentig)}} % OFF</span>
                                @endif

                                <a href="{{ url('productdetails/'.$BrandProductShow->id) }}">
                                    <img src="{{ url($BrandProductShow->image) }}" alt="Product image" class="product-image">
                                </a>

                                <div class="product-action-vertical">
                                    @if (Auth::check())
                                    <a href="{{ url('wishlist/'.$BrandProductShow->id) }}" class="btn-product-icon btn-wishlist btn-expandable"><span>add to wishlist</span></a>
                                    @else
                                    <a href="#signin-modal" data-toggle="modal" class="btn-product-icon btn-wishlist btn-expandable"><span>add to wishlist</span></a>
                                    @endif
                                </div><!-- End .product-action-vertical -->

                                <div class="product-action">
                                    <a href="{{ url('productdetails/'.$BrandProductShow->id) }}" class="btn-product btn-cart"><span>add to cart</span></a>
                                </div><!-- End .product-action -->
                            </figure><!-- End .product-media -->

                            <div class="product-body">

                                @php
                                $content = substr($BrandProductShow->product_name,0,40);
                                $sale_price = $BrandProductShow->sale_price;
                                $dis_price = $BrandProductShow->discount_price;
                                $present_price = $sale_price-$dis_price;
                                @endphp

                                <h3 class="product-title"><a href="{{ url('productdetails/'.$BrandProductShow->id) }}">{!! $content !!}</a></h3><!-- End .product-title -->
                                <div class="product-price">

                                    @if(isset($dis_price))
                                    <del>{{$BrandProductShow->sale_price}}</del> &nbsp;&nbsp;
                                    @endif
                                    <span class="out-price">Tk {{$present_price}}.00</span>
                                </div><!-- End .product-price -->

                            </div><!-- End .product-body -->
                        </div><!-- End .product -->
                    </div><!-- End .col-sm-6 col-md-4 col-lg-3 -->

                    @empty

                    <center>
                        <h4 class="text-danger">No Product Found</h4>
                    </center>

                    @endforelse

                </div><!-- End .row -->

            </div><!-- End .products -->


        </div><!-- End .container -->
    </div><!-- End .page-content -->
</main><!-- End .main -->


@endsection