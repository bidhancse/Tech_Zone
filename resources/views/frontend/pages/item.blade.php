@extends('frontend.index')
@section('content')
    <main class="main">
        <nav aria-label="breadcrumb" class="breadcrumb-nav mb-2">
            <div class="container">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="">{{ $ItemName->item_name }}</a></li>
                </ol>
            </div><!-- End .container -->
        </nav><!-- End .breadcrumb-nav -->

        <div class="page-content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-9">
                        <div class="toolbox">
                            <div class="toolbox-left">
                                <div class="toolbox-info">
                                    Showing <span>{{ Count($ItemProduct) }}</span> Products
                                </div><!-- End .toolbox-info -->
                            </div><!-- End .toolbox-left -->

                            <div class="toolbox-right">
                                <div class="toolbox-sort">
                                    <label for="sortby">Sort by:</label>
                                    <div class="select-custom">
                                        <select name="sortby" id="sortby" class="form-control">
                                            <option value="popularity" selected="selected">Most Popular</option>
                                            <option value="rating">Most Rated</option>
                                            <option value="date">Date</option>
                                        </select>
                                    </div>
                                </div><!-- End .toolbox-sort -->
                            </div><!-- End .toolbox-right -->
                        </div><!-- End .toolbox -->

                        <div class="products mb-3">
                            <div class="row justify-content-center">

                                @forelse($ItemProduct as $ItemProductShow)
                                    <div class="col-6 col-md-4 col-lg-4 col-xl-3">
                                        <div class="product product-7 text-center">
                                            <figure class="product-media">

                                                @php
                                                    $dis_percentig = ($ItemProductShow->discount_price / $ItemProductShow->sale_price) * 100;
                                                @endphp

                                                @if (isset($ItemProductShow->discount_price))
                                                    <span class="product-label label-top">{{ ceil($dis_percentig) }} %
                                                        OFF</span>
                                                @endif

                                                <a href="{{ url('productdetails/' . $ItemProductShow->id) }}">
                                                    <img src="{{ url($ItemProductShow->image) }}" alt="Product image"
                                                        class="product-image">
                                                </a>

                                                <div class="product-action-vertical">
                                                    @if (Auth::check())
                                                    <a href="{{ url('wishlist/'.$ItemProductShow->id) }}" class="btn-product-icon btn-wishlist btn-expandable"><span>add to wishlist</span></a>
                                                    @else
                                                    <a href="#signin-modal" data-toggle="modal" class="btn-product-icon btn-wishlist btn-expandable"><span>add to wishlist</span></a>
                                                    @endif
                                                </div><!-- End .product-action-vertical -->

                                                <div class="product-action">
                                                    <a href="{{ url('productdetails/' . $ItemProductShow->id) }}"
                                                        class="btn-product btn-cart"><span>add to cart</span></a>
                                                </div><!-- End .product-action -->
                                            </figure><!-- End .product-media -->

                                            <div class="product-body">

                                                @php
                                                    $content = substr($ItemProductShow->product_name, 0, 40);
                                                    $sale_price = $ItemProductShow->sale_price;
                                                    $dis_price = $ItemProductShow->discount_price;
                                                    $present_price = $sale_price - $dis_price;
                                                @endphp

                                                <h3 class="product-title"><a
                                                        href="{{ url('productdetails/' . $ItemProductShow->id) }}">{!! $content !!}</a>
                                                </h3><!-- End .product-title -->
                                                <div class="product-price">

                                                    @if (isset($dis_price))
                                                        <del>{{ $ItemProductShow->sale_price }}</del> &nbsp;&nbsp;
                                                    @endif
                                                    <span class="out-price">Tk {{ $present_price }}.00</span>
                                                </div><!-- End .product-price -->

                                            </div><!-- End .product-body -->
                                        </div><!-- End .product -->
                                    </div><!-- End .col-sm-6 col-lg-4 col-xl-3 -->
                                @empty

                                    <center>
                                        <h4 class="text-danger">No Product Found</h4>
                                    </center>
                                @endforelse


                            </div><!-- End .row -->

                            <hr>
                            @if ($ItemProduct)
                                <div class="float-right">
                                    {!! $ItemProduct->links() !!}
                                </div>
                            @endif

                        </div><!-- End .products -->

                    </div><!-- End .col-lg-9 -->
                    <aside class="col-lg-3 order-lg-first">
                        <div class="sidebar sidebar-shop">
                            <div class="widget widget-clean">
                                <label>Filters:</label>
                                <a href="#" class="sidebar-filter-clear">Clean All</a>
                            </div><!-- End .widget widget-clean -->

                            <div class="widget widget-collapsible">
                                <h3 class="widget-title">
                                    <a data-toggle="collapse" href="#widget-1" role="button" aria-expanded="true"
                                        aria-controls="widget-1">
                                        Category
                                    </a>
                                </h3><!-- End .widget-title -->

                                <div class="collapse show" id="widget-1">
                                    <div class="widget-body">
                                        <div class="filter-items filter-items-count">


                                            @foreach ($CategoryName as $CategoryNameShow)
                                                <div class="filter-item">
                                                    <div class="custom-control custom-checkbox">
                                                        <a href="{{ url('Category/' . $CategoryNameShow->id, $CategoryNameShow->category_name) }}"
                                                            style="color: #000;">{{ $CategoryNameShow->category_name }}</a>
                                                    </div><!-- End .custom-checkbox -->

                                                    @php
                                                        $ProductCount = DB::table('productinformation')
                                                            ->where('category_id', $CategoryNameShow->id)
                                                            ->get();
                                                    @endphp

                                                    <span class="item-count">{{ Count($ProductCount) }}</span>
                                                </div><!-- End .filter-item -->
                                            @endforeach

                                        </div><!-- End .filter-items -->
                                    </div><!-- End .widget-body -->
                                </div><!-- End .collapse -->
                            </div><!-- End .widget -->

                            <div class="widget widget-collapsible">
                                <h3 class="widget-title">
                                    <a data-toggle="collapse" href="#widget-5" role="button" aria-expanded="true"
                                        aria-controls="widget-5">
                                        Price
                                    </a>
                                </h3><!-- End .widget-title -->

                                <div class="collapse show" id="widget-5">
                                    <div class="widget-body">
                                        <div class="filter-price">
                                            <div class="filter-price-text">
                                                Price Range:
                                                <span id="filter-price-range"></span>
                                            </div><!-- End .filter-price-text -->

                                            <div wire:ignore id="price-slider"></div><!-- End #price-slider -->
                                        </div><!-- End .filter-price -->
                                    </div><!-- End .widget-body -->
                                </div><!-- End .collapse -->
                            </div><!-- End .widget -->


                            <div class="widget widget-collapsible">
                                <h3 class="widget-title">
                                    <a data-toggle="collapse" href="#widget-4" role="button" aria-expanded="true"
                                        aria-controls="widget-4">
                                        Brand
                                    </a>
                                </h3><!-- End .widget-title -->

                                <div class="collapse show" id="widget-4">
                                    <div class="widget-body">
                                        <div class="filter-items">


                                            @foreach ($BrandName as $BrandNameShow)
                                                <div class="filter-item">
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="{{ $BrandNameShow->brand_id }}">
                                                        <label class="custom-control-label"
                                                            for="{{ $BrandNameShow->brand_id }}">{{ $BrandNameShow->brand_name }}
                                                        </label>
                                                    </div><!-- End .custom-checkbox -->

                                                </div><!-- End .filter-item -->
                                            @endforeach


                                        </div><!-- End .filter-items -->
                                    </div><!-- End .widget-body -->
                                </div><!-- End .collapse -->
                            </div><!-- End .widget -->

                        </div><!-- End .sidebar sidebar-shop -->
                    </aside><!-- End .col-lg-3 -->
                </div><!-- End .row -->
            </div><!-- End .container -->
        </div><!-- End .page-content -->
    </main><!-- End .main -->
@endsection
