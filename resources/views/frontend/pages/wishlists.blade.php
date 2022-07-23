@extends('frontend.index')
@section('content')

<main class="main">
    <div class="page-header text-center" style="background-image: url('{{ asset('public/frontend')}}/assets/images/page-header-bg.jpg')">
        <div class="container">
            <h1 class="page-title">Wishlist</h1>
        </div><!-- End .container -->
    </div><!-- End .page-header -->
    <nav aria-label="breadcrumb" class="breadcrumb-nav">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Wishlist</li>
            </ol>
        </div><!-- End .container -->
    </nav><!-- End .breadcrumb-nav -->

    <div class="page-content">
        <div class="container">
            <table class="table table-wishlist table-mobile">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Stock Status</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>

                <tbody>
                    
                    @forelse ($WishlistsData as $WishlistsDataShow)

                    <tr>
                        <td class="product-col">
                            <div class="product">
                                <figure class="product-media">
                                    <a href="#">
                                        <img src="{{ url($WishlistsDataShow->image) }}" alt="Product image">
                                    </a>
                                </figure>

                                <h3 class="product-title">
                                    <a href="#">{{ $WishlistsDataShow->product_name }}</a>
                                </h3><!-- End .product-title -->
                            </div><!-- End .product -->
                        </td>

                        @php
                            $sale_price = $WishlistsDataShow->sale_price;
                            $dis_price = $WishlistsDataShow->discount_price;
                            $present_price = $sale_price-$dis_price;
                        @endphp


                        <td class="price-col">{{$present_price}}.00 BDT</td>
                        <td class="stock-col">
                            @if($WishlistsDataShow->stock_status == 1)
                            <span class="in-stock">In stock</span>
                            @else
                            <span class="in-stock text-danger">Out of stock</span>
                            @endif
                        </td>
                        <td class="action-col">
                            <a href="{{ url('productdetails/'.$WishlistsDataShow->id) }}" class="btn btn-block btn-outline-primary-2"><i class="icon-cart-plus"></i>Add to Cart</a>
                        </td>
                        <td class="remove-col"><a href="{{ url('Wishlist-Product-Delete/'.$WishlistsDataShow->id) }}" class="btn-remove"><i class="icon-close"></i></a></td>
                    </tr>

                    @empty
                        
                    <tr>
                        <td colspan="5">
                            <h4 class="text-danger text-center">Wishlist product not Added</h4>
                        </td>
                    </tr>


                    @endforelse

            
                </tbody>
            </table><!-- End .table table-wishlist -->
        </div><!-- End .container -->
    </div><!-- End .page-content -->
</main><!-- End .main -->

@endsection