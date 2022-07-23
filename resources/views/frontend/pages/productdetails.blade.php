@extends('frontend.index')
@section('content')



<main class="main">
    <nav aria-label="breadcrumb" class="breadcrumb-nav mb-2">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Products</a></li>
                <li class="breadcrumb-item"><a href="#">{{ $ProductDetails->item_name }}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $ProductDetails->product_name }}</li>
            </ol>
        </div><!-- End .container -->
    </nav><!-- End .breadcrumb-nav -->

    <div class="page-content">
        <div class="container">
            <div class="product-details-top">
                <div class="row">
                    <div class="col-md-6">
                        <div class="product-gallery product-gallery-vertical">
                            <div class="row">
                                <figure class="product-main-image">
                                    <img id="product-zoom" src="{{ url($ProductDetails->image) }}" data-zoom-image="{{ url($ProductDetails->image) }}" alt="product image">

                                    <a href="{{ url($ProductDetails->image) }}" id="btn-product-gallery" class="btn-product-gallery">
                                        <i class="icon-arrows"></i>
                                    </a>
                                </figure><!-- End .product-main-image -->

                                <div id="product-zoom-gallery" class="product-image-gallery">
                                    <a class="product-gallery-item active" href="{{ url($ProductDetails->image) }}" data-image="{{ url($ProductDetails->image) }}" data-zoom-image="{{ url($ProductDetails->image) }}">
                                        <img src="{{ url($ProductDetails->image) }}" alt="product image">
                                    </a>

                                    <a class="product-gallery-item" href="{{ url($ProductDetails->image) }}" data-image="{{ url($ProductDetails->image) }}" data-zoom-image="{{ url($ProductDetails->image) }}">
                                        <img src="{{ url($ProductDetails->image) }}" alt="product image">
                                    </a>

                                    <a class="product-gallery-item" href="{{ url($ProductDetails->image) }}" data-image="{{ url($ProductDetails->image) }}" data-zoom-image="{{ url($ProductDetails->image) }}">
                                        <img src="{{ url($ProductDetails->image) }}" alt="product image">
                                    </a>

                                    <a class="product-gallery-item" href="{{ url($ProductDetails->image) }}" data-image="{{ url($ProductDetails->image) }}" data-zoom-image="{{ url($ProductDetails->image) }}">
                                        <img src="{{ url($ProductDetails->image) }}" alt="product image">
                                    </a>
                                </div><!-- End .product-image-gallery -->
                            </div><!-- End .row -->
                        </div><!-- End .product-gallery -->
                    </div><!-- End .col-md-6 -->

                    <div class="col-md-6">
                        <div class="product-details">
                            <h1 class="product-title">{{ $ProductDetails->product_name }}</h1><!-- End .product-title -->
                            

                            @php
                            $sale_price = $ProductDetails->sale_price;
                            $dis_price = $ProductDetails->discount_price;
                            $present_price = $sale_price-$dis_price;
                            @endphp

                            <div class="product-price">
                             @if(isset($dis_price))
                             <del style="font-size: 20px; color: red;">BDT : {{$ProductDetails->sale_price}}.00</del> &nbsp;&nbsp;
                             @endif
                             <span style="color: #00d17e;">BDT : {{$present_price}}.00</span>
                         </div><!-- End .product-price -->

                         @if( $ProductDetails->stock_status == 1)
                         <p style="color: #000;">Availability : <span style="color: #00d17e;">In Stock</span></p>
                         @else
                         <p style="color: #000;">Availability : <span style="color: #f00;">Stock Out</span></p>
                         @endif

                         <div class="product-content">
                            <p>{!! $ProductDetails->short_details !!}</p>
                        </div><!-- End .product-content -->

                    <form method="post" enctype="multipart/form-data" action="{{ url('AddtoCart/'.$ProductDetails->id)}}">
                    @csrf

                        @if($ProductDetails->product_color)
                        <div class="details-filter-row details-row-size">
                            <label for="product_color">Color:</label>
                            <div class="select-custom">
                                <select name="product_color" id="product_color" class="form-control">
                                    <option value="#" selected="selected">Select a Color</option>

                                    @foreach($ProductColor as $ProductColorShow)
                                    <option value="{{ $ProductColorShow }}">{{ $ProductColorShow }}</option>
                                    @endforeach
                                </select>
                            </div><!-- End .select-custom -->
                        </div><!-- End .details-filter-row -->
                        @else
                        @endif

                        <div class="details-filter-row details-row-size">
                            <label for="quentity">Qty:</label>
                            <div class="product-details-quantity">
                                <input type="number" id="quentity" name="quentity" class="form-control" value="1" min="1" max="10" step="1" data-decimals="0" required>
                            </div><!-- End .product-details-quantity -->
                        </div><!-- End .details-filter-row -->

                        <div class="product-details-action">
                            <button type="submit" class="btn-product btn-cart">Add to Cart</button>
                            
                            <div class="details-action-wrapper">

                                @if (Auth::check())
                                <a href="{{ url('wishlist/'.$ProductDetails->id) }}" class="btn-product btn-wishlist" title="Wishlist"><span>Add to Wishlist</span></a>
                                @else
                                <a href="#signin-modal" data-toggle="modal" class="btn-product btn-wishlist" title="Wishlist"><span>Add to Wishlist</span></a>
                                @endif
                                
                            </div><!-- End .details-action-wrapper -->
                        </div><!-- End .product-details-action -->

                        
                    </form>



                        <div class="product-details-footer">
                            <div class="product-cat">
                                <span>Category:</span>
                                <a href="#">{{$ProductDetails->item_name}}</a>,
                                <a href="#">{{$ProductDetails->category_name}}</a>,
                                <a href="#">{{$ProductDetails->subcategory_name}}</a>
                            </div><!-- End .product-cat -->

                            <div class="social-icons social-icons-sm">
                                <span class="social-label">Share:</span>
                                <div class="addthis_inline_share_toolbox"></div>
                            </div>
                        </div><!-- End .product-details-footer -->
                    </div><!-- End .product-details -->
                </div><!-- End .col-md-6 -->
            </div><!-- End .row -->
        </div><!-- End .product-details-top -->

        <div class="product-details-tab">
            <ul class="nav nav-pills justify-content-center" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="product-desc-link" data-toggle="tab" href="#product-desc-tab" role="tab" aria-controls="product-desc-tab" aria-selected="true">Description</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="product-shipping-link" data-toggle="tab" href="#product-shipping-tab" role="tab" aria-controls="product-shipping-tab" aria-selected="false">Shipping & Returns</a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane fade show active" id="product-desc-tab" role="tabpanel" aria-labelledby="product-desc-link">
                    <div class="product-desc-content">
                        <h3>Product Information</h3>
                        <p>{!! $ProductDetails->full_details !!}</p>
                    </div><!-- End .product-desc-content -->
                </div><!-- .End .tab-pane -->
                <div class="tab-pane fade" id="product-shipping-tab" role="tabpanel" aria-labelledby="product-shipping-link">
                    <div class="product-desc-content">
                        <h3>Delivery & returns</h3>
                        <p>We deliver to over 100 countries around the world. For full details of the delivery options we offer, please view our <a href="#">Delivery information</a><br>
                            We hope you’ll love every purchase, but if you ever need to return an item you can do so within a month of receipt. For full details of how to make a return, please view our <a href="#">Returns information</a></p>
                        </div><!-- End .product-desc-content -->
                    </div><!-- .End .tab-pane -->
                </div><!-- End .tab-content -->
            </div><!-- End .product-details-tab -->

            <h2 class="title text-center mb-4">You May Also Like</h2><!-- End .title text-center -->

            <div class="owl-carousel owl-simple carousel-equal-height carousel-with-shadow" data-toggle="owl" 
            data-owl-options='{
                "nav": false, 
                "dots": true,
                "margin": 20,
                "loop": false,
                "responsive": {
                    "0": {
                        "items":1
                    },
                    "480": {
                        "items":2
                    },
                    "768": {
                        "items":3
                    },
                    "992": {
                        "items":4
                    },
                    "1200": {
                        "items":6,
                        "nav": true,
                        "dots": false
                    }
                }
            }'>

            @foreach($ReletedProduct as $ReletedReletedProductshow)

            <div class="product product-7 text-center">
                <figure class="product-media">

                    @php
                    $dis_percentig = $ReletedReletedProductshow->discount_price / $ReletedReletedProductshow->sale_price*100;
                    @endphp

                    @if(isset($ReletedReletedProductshow->discount_price))
                    <span class="product-label label-top">{{ceil($dis_percentig)}} % OFF</span>
                    @endif
                    <a href="{{ url('productdetails/'.$ReletedReletedProductshow->id) }}">
                        <img src="{{ url($ReletedReletedProductshow->image) }}" alt="Product image" class="product-image">
                    </a>

                    <div class="product-action-vertical">
                        @if (Auth::check())
                        <a href="{{ url('wishlist/'.$ReletedReletedProductshow->id) }}" class="btn-product-icon btn-wishlist btn-expandable"><span>add to wishlist</span></a>
                        @else
                        <a href="#signin-modal" data-toggle="modal" class="btn-product-icon btn-wishlist btn-expandable"><span>add to wishlist</span></a>
                        @endif
                    </div><!-- End .product-action-vertical -->

                    <div class="product-action">
                        <a href="{{ url('productdetails/'.$ReletedReletedProductshow->id) }}" class="btn-product btn-cart" title="Add to cart" style="border: none;"><span>add to cart</span></a>
                    </div><!-- End .product-action --><!-- End .product-action -->
                </figure><!-- End .product-media -->

                <div class="product-body">

                    @php
                    $content = substr($ReletedReletedProductshow->product_name,0,40);
                    $sale_price = $ReletedReletedProductshow->sale_price;
                    $dis_price = $ReletedReletedProductshow->discount_price;
                    $present_price = $sale_price-$dis_price;
                    @endphp


                    <h3 class="product-title"><a href="{{ url('productdetails/'.$ReletedReletedProductshow->id) }}">{!! $content !!}</a></h3><!-- End .product-title -->
                    <div class="product-price">

                        @if(isset($dis_price))
                        <del>{{$ReletedReletedProductshow->sale_price}}</del> &nbsp;&nbsp;
                        @endif
                        <span class="out-price">Tk {{$present_price}}.00</span>
                    </div><!-- End .product-price -->
                </div><!-- End .product-body -->
            </div><!-- End .product -->

            @endforeach 
            
        </div><!-- End .owl-carousel -->
    </div><!-- End .container -->
</div><!-- End .page-content -->
</main><!-- End .main -->



@endsection