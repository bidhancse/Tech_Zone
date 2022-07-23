@extends('frontend.index')
@section('content')


<main class="main">
    <div class="page-header text-center" style="background-image: url('{{ asset('public/frontend')}}/assets/images/page-header-bg.jpg')">
        <div class="container">
            <h1 class="page-title">Shopping Cart<span>Shop</span></h1>
        </div><!-- End .container -->
    </div><!-- End .page-header -->
    <nav aria-label="breadcrumb" class="breadcrumb-nav">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Shop</a></li>
                <li class="breadcrumb-item active" aria-current="page">Shopping Cart</li>
            </ol>
        </div><!-- End .container -->
    </nav><!-- End .breadcrumb-nav -->

    <div class="page-content">
        <div class="cart">
            <div class="container">
                <div class="row">
                    <div class="col-lg-9">
                        <table class="table table-cart table-mobile">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>QTY Update</th>
                                    <th>Total</th>
                                    <th></th>
                                </tr>
                            </thead>

                            <tbody>

                                @php
								$Cart=Cart::content();
								@endphp

                                @foreach ($Cart as $CartDataShow)
                                    
                                <tr>
                                    <td class="product-col">
                                        <div class="product">
                                            <figure class="product-media">
                                                <a href="#">
                                                    <img src="{{ url($CartDataShow->options->image) }}" alt="Product image">
                                                </a>
                                            </figure>

                                            <h3 class="product-title">
                                                <p>{{$CartDataShow->name}}</p>
                                            </h3><!-- End .product-title -->
                                        </div><!-- End .product -->
                                    </td>
                                    <td class="price-col">{{$CartDataShow->price}}.00</td>

                                    <form method="POST" action="{{ url('Qty_Update/'.$CartDataShow->rowId) }}">
                                        @csrf
                                    <td class="quantity-col">
                                        <div class="cart-product-quantity">
                                            
                                            <input type="number" name="qty" class="form-control" value="{{$CartDataShow->qty}}" min="1" max="10" step="1" data-decimals="0" required>
                                            
                                        </div><!-- End .cart-product-quantity -->
                                    </td>
                                    <td class="quantity-col">
                                        <button type="submit" class="btn btn-outline-dark-2" style="min-width: 100px !important;"><span>Update</span><i class="icon-refresh"></i></button>
                                    </td>
                                    </form>

                                    @php
										$Price       	 =   $CartDataShow->price;
										$Qty             =   $CartDataShow->qty;
										$Total    		 =   $Price * $Qty;
									@endphp

                                    <td class="total-col">{{$Total}}.00</td>
                                    <td class="remove-col">
                                        <a href="{{ url('Product_Remove/'.$CartDataShow->rowId) }}" class="btn-remove"><i class="icon-close"></i></a>
                                    </td>
                                </tr>

                                @endforeach


                            </tbody>
                        </table><!-- End .table table-wishlist -->

                        <div class="cart-bottom">
                            <div class="cart-discount">
                                <form action="#">
                                    <div class="input-group">
                                        <input type="text" class="form-control" required placeholder="coupon code">
                                        <div class="input-group-append">
                                            <button class="btn btn-outline-primary-2" type="submit"><i class="icon-long-arrow-right"></i></button>
                                        </div><!-- .End .input-group-append -->
                                    </div><!-- End .input-group -->
                                </form>
                            </div><!-- End .cart-discount -->

                            <a href="{{ url('Cart_Clear') }}" class="btn btn-outline-dark-2"><span>CART CLEAR</span><i class="icon-refresh"></i></a>
                        </div><!-- End .cart-bottom -->
                    </div><!-- End .col-lg-9 -->
                    <aside class="col-lg-3">
                        <div class="summary summary-cart">
                            <h3 class="summary-title">Cart Total</h3><!-- End .summary-title -->

                            <table class="table table-summary">
                                <tbody>
                                    <tr class="summary-subtotal">
                                        <td>Subtotal:</td>
                                        <td>&#2547;{{Cart::subtotal()}}</td>
                                    </tr><!-- End .summary-subtotal -->

                                    <tr class="summary-shipping-estimate">
                                        <td>Estimate for Your Country<br> <a href="{{ url('User/Dashboard') }}">Change address</a></td>
                                        <td>&nbsp;</td>
                                    </tr><!-- End .summary-shipping-estimate -->

                                    <tr class="summary-total">
                                        <td>Total:</td>
                                        <td>&#2547;{{Cart::subtotal()}}</td>
                                    </tr><!-- End .summary-total -->
                                </tbody>
                            </table><!-- End .table table-summary -->

                            <a href="{{ url('Checkout') }}" class="btn btn-outline-primary-2 btn-order btn-block">PROCEED TO CHECKOUT</a>
                        </div><!-- End .summary -->

                        <a href="{{ url('/') }}" class="btn btn-outline-dark-2 btn-block mb-3"><span>CONTINUE SHOPPING</span><i class="icon-refresh"></i></a>
                    </aside><!-- End .col-lg-3 -->
                </div><!-- End .row -->
            </div><!-- End .container -->
        </div><!-- End .cart -->
    </div><!-- End .page-content -->
</main><!-- End .main -->



@endsection