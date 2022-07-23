@extends('frontend.index')
@section('content')


<main class="main">
    <div class="page-header text-center" style="background-image: url('{{ asset('public/frontend')}}/assets/images/page-header-bg.jpg')">
        <div class="container-fluid">
            <h1 class="page-title">Checkout<span>Shop</span></h1>
        </div>
        <!-- End .container-fluid -->
    </div>
    <!-- End .page-header -->
    <nav aria-label="breadcrumb" class="breadcrumb-nav">
        <div class="container-fluid">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Shop</a></li>
                <li class="breadcrumb-item active" aria-current="page">Checkout</li>
            </ol>
        </div>
        <!-- End .container-fluid -->
    </nav>
    <!-- End .breadcrumb-nav -->

    <div class="page-content">
        <div class="checkout">
            <div class="container-fluid">
                <div class="checkout-discount">
                    <form action="#">
                        <input type="text" class="form-control" required id="checkout-discount-input">
                        <label for="checkout-discount-input" class="text-truncate">Have a coupon? <span>Click here to enter your code</span></label>
                    </form>
                </div>
                <!-- End .checkout-discount -->
                <form method="post" action="{{ url('Shipping_Details/'.Auth()->user()->id) }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        
                            <div class="col-lg-4">
                                <h2 class="checkout-title">Billing Details</h2>
                                <!-- End .checkout-title -->
                                
                                <label>Name *</label>
                                <input type="text" class="form-control" name="name" value="{{ Auth()->user()->name }}" placeholder="Enter Your Name" required>
    
                                <label>Phone *</label>
                                <input type="text" class="form-control" name="phone" value="{{ Auth()->user()->phone }}" placeholder="Enter Your Phone" required>
    
                                <label>Email *</label>
                                <input type="text" class="form-control" name="email" value="{{ Auth()->user()->email }}" placeholder="Enter Your Email" required>
    
                                <label>Country  *</label>
                                <select class="form-control" name="country" required>
                                    <option value="">--Please Select Country--</option>
                                    <option value="Bangladesh" selected="selected">Bangladesh</option>
                                    <option value="India">India</option>
                                </select>
    
                                <label>Address *</label>
                                <input type="text" class="form-control" name="address" value="{{ Auth()->user()->address }}" placeholder="Enter Your Address" required>
    
                                <div class="row">
                                    <div class="col-sm-6">
                                        <label>Upazila *</label>
                                        <input type="text" class="form-control" name="upazila" required>
                                    </div>
                                    <!-- End .col-sm-6 -->
    
                                    <div class="col-sm-6">
                                    <label>District  *</label>
                                    <select class="form-control" name="district" required>
                                            <option value="">--Please Select District--</option>
                                            <option value="Dhaka" selected="selected">Dhaka</option>
                                            <option value="Chittgong">Chittgong</option>
                                            <option value="Cumilla">Cumilla</option>
                                            <option value="Rajsahi">Rajsahi</option>
                                            <option value="Sylhet">Sylhet</option>
                                            <option value="Jashore ">Jashore </option>
                                            <option value="Barisal">Barisal</option>
                                    </select>
                                    </div>
                                    <!-- End .col-sm-6 -->
                                </div>
                                <!-- End .row -->
    
                                <label>Payment Method *</label>
                                <select class="form-control"  name="payment_method">
                                    <option value="">--Please Select Payment Method--</option>
                                    <option value="Bkash" selected="selected">Bkash</option>
                                    <option value="Nagad">Nagad</option>
                                    <option value="Rocket">Rocket</option>
                                    <option value="Cash on Delivery">Cash on Delivery</option>
                                </select>
    
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="checkout-create-acc" required>
                                    <label class="custom-control-label" for="checkout-create-acc">I've read and accept the
                                        <a href="" target="_blank" style="color:red;text-decoration:none">
                                            terms and conditions</a>
                                    </label>
                                </div>
                                <!-- End .custom-checkbox -->
    
                                <button type="submit" name="submit" class="btn btn-outline-primary-2 btn-order btn-block">
                                    <span class="btn-text">Place Order</span>
                                    <span class="btn-hover-text">Proceed to Checkout</span>
                                </button>
                                
                            </div>
                        <!-- End .col-lg-4 -->
                        <aside class="col-lg-8">
                            <div class="summary table-responsive pb-0">
                                <h3 class="summary-title">Cart Details</h3>
                                <!-- End .summary-title -->

                                <table class="table table-cart table-mobile">
                                    <thead>
                                        <tr>
                                            <th>Product</th>
                                            <th>Product Name</th>
                                            <th class="text-center">Quantity</th>
                                            <th>Price</th>
                                            <th>Subtotal</th>
                                        </tr>
                                    </thead>

                                    <tbody>

                                        @php
								            $Cart=Cart::content();
								        @endphp

                                    @foreach ($Cart as $CartDataShow)

                                        <tr>

                                            <td class="product-col">
                                                <div class="product" style="background: #f9f9f9 !important;">
                                                    <figure class="product-media">
                                                        <a href="#">
                                                            <img src="{{ url($CartDataShow->options->image) }}" alt="Product image">
                                                        </a>
                                                    </figure>
        
                                                </div><!-- End .product -->
                                            </td>
                                            <td class="product-col">
                                                <h3 class="product-title">
                                                    <p>{{$CartDataShow->name}}</p>
                                                </h3><!-- End .product-title -->
                                            </td>
                                            <td class="quantity-col text-center">{{$CartDataShow->qty}}</td>
                                            <td class="price-col">{{$CartDataShow->price}}.00</td>
                                            
                                            @php
                                                $Price       	 =   $CartDataShow->price;
                                                $Qty             =   $CartDataShow->qty;
                                                $Total    		 =   $Price * $Qty;
                                            @endphp
    
                                        <td class="total-col">{{$Total}}.00</td>
                                            
                                        </tr>


                                        @endforeach

                                        <tr class="summary-subtotal">
                                            <td></td>
                                            <td></td>
                                            <td>Subtotal:</td>
                                            <td></td>
                                            <td>&#2547;{{Cart::subtotal()}}</td>
                                        </tr>
                                        <!-- End .summary-subtotal -->
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td>Shipping Charge:</td>
                                            <td></td>
                                            <td>&#2547;00.00</td>
                                        </tr>
                                        <tr class="summary-total">
                                            <td></td>
                                            <td></td>
                                            <td>Grand Total:</td>  
                                            <td></td>
                                            <td>&#2547;{{Cart::subtotal()}}</td>
                                        </tr>
                                        <!-- End .summary-total -->
                                    </tbody>
                                    
                                </table>
                                <!-- End .table table-summary -->

                                <div class="accordion-summary">
                                    <div class="card">
                                        <div class="card-body text-center" style="font-size: 16px;">
                                            <span>Do you want to update Product Quantity ?</span> <a href="{{ url('Cart') }}">Click here.</a>
                                        </div>
                                    </div>
                                    <!-- End .card -->                  
                                </div>
                                <!-- End .accordion -->
                            </div>
                            <!-- End .summary -->
                        </aside>
                        <!-- End .col-lg-8 -->
                    </div>
                    <!-- End .row -->
                </form>
            </div>
            <!-- End .container-fluid -->
        </div>
        <!-- End .checkout -->
    </div>
    <!-- End .page-content -->
</main>
<!-- End .main -->




@endsection