@php
$Setting = DB::table('settinginformation')->first();
@endphp

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>{{ $Setting->title }}</title>
    <meta name="keywords" content="HTML5 Template">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Favicon -->
    <link rel="icon" type="image/png" sizes="32x32" href="{{ url($Setting->favicon) }}">
    <link rel="stylesheet"
        href="{{ asset('public/frontend') }}/assets/vendor/line-awesome/line-awesome/line-awesome/css/line-awesome.min.css">
    <!-- Plugins CSS File -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('public/frontend') }}/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('public/frontend') }}/assets/css/plugins/owl-carousel/owl.carousel.css">
    <link rel="stylesheet" href="{{ asset('public/frontend') }}/assets/css/plugins/magnific-popup/magnific-popup.css">
    <link rel="stylesheet" href="{{ asset('public/frontend') }}/assets/css/plugins/jquery.countdown.css">
    <!-- Main CSS File -->
    <link rel="stylesheet" href="{{ asset('public/frontend') }}/assets/css/style.css">
    <link rel="stylesheet" href="{{ asset('public/frontend') }}/assets/css/skins/skin-demo-14.css">
    <link rel="stylesheet" href="{{ asset('public/frontend') }}/assets/css/demos/demo-14.css">
    <link rel="stylesheet" href="{{ asset('public/frontend') }}/assets/css/plugins/nouislider/nouislider.css">
    <link rel="stylesheet" href="{{ asset('public/frontend') }}/assets/css/skins/skin-demo-13.css">
    <link rel="stylesheet" href="{{ asset('public/frontend') }}/assets/css/demos/demo-13.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!--ajax-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    
</head>


<body>
    <div class="page-wrapper bg-lighter ">
        <header class="header header-14">
            <div class="header-top" style="padding-top: 5px; padding-bottom: 5px;">
                <div class="container">
                    <div class="header-left">
                        <div class="top-menu">
                            <a href="#">Call: +88{{ $Setting->phone }}</a>
                        </div><!-- End .header-dropdown -->


                    </div><!-- End .header-left -->

                    <div class="header-right">
                        <ul class="top-menu">
                            @if (Auth::check())
                                <a href="{{ url('User/Dashboard') }}"><i class="icon-user"></i>My Account</a>
                            @else
                                <a href="#signin-modal" data-toggle="modal"><i class="icon-user"></i>Login</a>
                            @endif
                        </ul><!-- End .top-menu -->
                    </div><!-- End .header-right -->
                </div><!-- End .container -->
            </div><!-- End .header-top -->

            <div class="header-middle">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-auto col-lg-3 col-xl-3 col-xxl-2">
                            <button class="mobile-menu-toggler">
                                <span class="sr-only">Toggle mobile menu</span>
                                <i class="icon-bars"></i>
                            </button>
                            <a href="{{ url('/') }}" class="logo">
                                <img src="{{ url($Setting->image) }}" alt="Molla Logo" style="max-height: 40px;">
                            </a>
                        </div><!-- End .col-xl-3 col-xxl-2 -->

                        <div class="col col-lg-9 col-xl-9 col-xxl-10 header-middle-right">
                            <div class="row">
                                <div class="col-lg-8 col-xxl-4-5col d-none d-lg-block">
                                    <div
                                        class="header-search header-search-extended header-search-visible header-search-no-radius">
                                        <a href="#" class="search-toggle" role="button"><i
                                                class="icon-search"></i></a>

                                        <form method="get" action="{{ url('SearchProduct') }}">
                                            @csrf
                                            <div class="header-search-wrapper search-wrapper-wide">
                                                <label for="q" class="sr-only">Search</label>
                                                <input type="search" class="form-control" name="searchdata" id="q"
                                                    placeholder="Search product ..." required>

                                                <button class="btn btn-primary" type="submit"><i
                                                        class="icon-search"></i></button>
                                            </div><!-- End .header-search-wrapper -->
                                        </form>


                                    </div><!-- End .header-search -->
                                </div><!-- End .col-xxl-4-5col -->

                                <div class="col-lg-4 col-xxl-5col d-flex justify-content-end align-items-center">
                                    <div class="header-dropdown-link">

                                        @if (Auth::check())
                                        <a href="{{ url('Wishlists') }}" class="wishlist-link">

                                            @php
                                            $WishlistCount = DB::table('wishlists')->where('user_id',Auth()->user()->id)->get();
                                            @endphp

                                            <i class="icon-heart-o"></i>
                                            <span class="wishlist-count">{{ Count($WishlistCount)}}</span>
                                            <span class="wishlist-txt">Wishlist</span>
                                        </a>
                                        @else
                                        <a href="#signin-modal" data-toggle="modal" class="wishlist-link">
                                            <i class="icon-heart-o"></i>
                                            <span class="wishlist-count">0</span>
                                            <span class="wishlist-txt">Wishlist</span>
                                        </a>
                                        @endif <!-- End .wishlist -->

                                        <div class="dropdown cart-dropdown">
                                            <a href="#" class="dropdown-toggle" role="button" data-toggle="dropdown"
                                                aria-haspopup="true" aria-expanded="false" data-display="static">
                                                <i class="icon-shopping-cart"></i>
                                                <span class="cart-count">{{ Cart::count() }}</span>
                                                <span class="cart-txt">Cart</span>
                                            </a>

                                            <div class="dropdown-menu dropdown-menu-right">
                                                <div class="dropdown-cart-products">

                                                    @php
                                                        $Cart = Cart::content();
                                                    @endphp

                                                    @foreach ($Cart as $CartDataShow)
                                                        @php
                                                            $content = substr($CartDataShow->name, 0, 35);
                                                            $Price = $CartDataShow->price;
                                                            $Qty = $CartDataShow->qty;
                                                            $Total = $Price * $Qty;
                                                        @endphp

                                                        <div class="product">
                                                            <div class="product-cart-details">
                                                                <h4 class="product-title">
                                                                    <p style="color: #eb5829;">{!! $content !!}
                                                                    </p>
                                                                </h4>

                                                                <span class="cart-product-info">
                                                                    <span
                                                                        class="cart-product-qty">{{ $CartDataShow->qty }}</span>
                                                                    x {{ $CartDataShow->price }} =
                                                                    &#2547;{{ $Total }}
                                                                </span>
                                                            </div><!-- End .product-cart-details -->

                                                            <figure class="product-image-container">
                                                                <a href="product.html" class="product-image">
                                                                    <img src="{{ url($CartDataShow->options->image) }}"
                                                                        alt="product">
                                                                </a>
                                                            </figure>
                                                            <a href="{{ url('Product_Remove/' . $CartDataShow->rowId) }}"
                                                                class="btn-remove" title="Remove Product"><i
                                                                    class="icon-close"></i></a>
                                                        </div><!-- End .product -->
                                                    @endforeach

                                                </div><!-- End .cart-product -->

                                                <div class="dropdown-cart-total">
                                                    <span>Total</span>

                                                    <span
                                                        class="cart-total-price">&#2547;{{ Cart::subtotal() }}</span>
                                                </div><!-- End .dropdown-cart-total -->

                                                <div class="dropdown-cart-action">


                                                    @if (Auth::check())
                                                        <a href="{{ url('Cart') }}" class="btn btn-primary">View
                                                            Cart</a>
                                                        <a href="{{ url('Checkout') }}"
                                                            class="btn btn-outline-primary-2"><span>Checkout</span><i
                                                                class="icon-long-arrow-right"></i></a>
                                                    @else
                                                        <a href="#signin-modal" data-toggle="modal"
                                                            class="btn btn-primary">View Cart</a>
                                                        <a href="#signin-modal" data-toggle="modal"
                                                            class="btn btn-outline-primary-2"><span>Checkout</span><i
                                                                class="icon-long-arrow-right"></i></a>
                                                    @endif

                                                </div><!-- End .dropdown-cart-total -->
                                            </div><!-- End .dropdown-menu -->
                                        </div><!-- End .cart-dropdown -->
                                    </div>
                                </div><!-- End .col-xxl-5col -->
                            </div><!-- End .row -->
                        </div><!-- End .col-xl-9 col-xxl-10 -->
                    </div><!-- End .row -->
                </div><!-- End .container-fluid -->
            </div><!-- End .header-middle -->

            <div class="header-bottom sticky-header">
                <div class="container-fluid">
                    <div class="row">

                        <button class="mobile-menu-toggler">
                            <span class="sr-only">Toggle mobile menu</span>
                            <i class="icon-bars"></i>
                        </button>


                        <div class="col col-lg-12 col-xl-12 col-xxl-12 header-center">

                            <nav class="main-nav">
                                <ul class="menu sf-arrows">

                                    @php
                                        $Item = DB::table('iteminformation')
                                            ->orderBy('id', 'ASC')
                                            ->where('status', 1)
                                            ->get();
                                        $Category = DB::table('categoryinformation')
                                            ->where('status', 1)
                                            ->get();
                                        $SubCategory = DB::table('subcategoryinformation')
                                            ->where('status', 1)
                                            ->get();
                                    @endphp

                                    @foreach ($Item as $ItemShow)
                                        <li>
                                            <a href="{{ url('Item/'.$ItemShow->id, $ItemShow->item_name) }}"
                                                class="sf-with-ul"
                                                style="font-size: 12px;">{{ $ItemShow->item_name }}</a>

                                            <ul>

                                                @foreach ($Category as $CategoryShow)
                                                    @if ($ItemShow->id == $CategoryShow->item_id)
                                                        <li>
                                                            <a href="{{ url('Category/' . $CategoryShow->id, $CategoryShow->category_name) }}"
                                                                class="sf-with-ul">{{ $CategoryShow->category_name }}</a>

                                                            <ul>

                                                                @foreach ($SubCategory as $SubCategoryShow)
                                                                    @if ($CategoryShow->id == $SubCategoryShow->category_id)
                                                                        <li><a
                                                                                href="{{ url('SubCategory/' . $SubCategoryShow->id, $SubCategoryShow->subcategory_name) }}">{{ $SubCategoryShow->subcategory_name }}</a>
                                                                        </li>
                                                                    @endif
                                                                @endforeach

                                                            </ul>
                                                        </li>
                                                    @endif
                                                @endforeach

                                            </ul>
                                        </li>
                                    @endforeach

                                </ul><!-- End .menu -->
                            </nav><!-- End .main-nav -->
                        </div><!-- End .col-xl-9 col-xxl-10 -->
                    </div><!-- End .row -->
                </div><!-- End .container-fluid -->
            </div><!-- End .header-bottom -->
        </header><!-- End .header -->



        @yield('content')


        <footer class="footer" style="background-color: #000; padding-bottom: 20px;">
            <div class="footer-middle border-0">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12 col-lg-4">
                            <div class="widget widget-about">
                                <img src="{{ url($Setting->image) }}" class="footer-logo" alt="Footer Logo"
                                style="max-height: 55px;">
                                <span class="widget-about-title" style="color : #fff;">Got Question? Call us 24/7</span>
                                <h4 style="color : #eb5525;">+88{{ $Setting->phone }}</h4>

                                <div class="widget-about-info">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-8">
                                            <span class="widget-about-title" style="color : #fff;">Payment
                                                Method</span>
                                            <figure class="footer-payments">
                                                <img src="{{ asset('public/frontend') }}/assets/images/payments.png"
                                                    alt="Payment methods" width="272" height="20">
                                            </figure><!-- End .footer-payments -->
                                        </div><!-- End .col-sm-6 -->
                                    </div><!-- End .row -->
                                </div><!-- End .widget-about-info -->
                            </div><!-- End .widget about-widget -->
                        </div><!-- End .col-sm-12 col-lg-4 -->

                        <div class="col-sm-4 col-lg-2">
                            <div class="widget">
                                <h4 class="widget-title" style="color : #fff;">Useful Links</h4>
                                <!-- End .widget-title -->

                                <ul class="widget-list">
                                    <li><a href="{{ url('About-Us') }}">About Us</a></li>
                                    <li><a href="{{ url('Brands') }}">Brands</a></li>
                                    <li><a href="{{ url('faq') }}">FAQ</a></li>
                                    <li><a href="{{ url('Contact-Us') }}">Contact us</a></li>
                                </ul><!-- End .widget-list -->
                            </div><!-- End .widget -->
                        </div><!-- End .col-sm-4 col-lg-2 -->

                        <div class="col-sm-4 col-lg-2">
                            <div class="widget">
                                <h4 class="widget-title" style="color : #fff;">Customer Service</h4>
                                <!-- End .widget-title -->

                                <ul class="widget-list">
                                    <li><a href="#">Returns</a></li>
                                    <li><a href="{{ url('Buying-Process') }}">Buying Process</a></li>
                                    <li><a href="{{ url('Privacy&policy') }}">Privacy Policy</a></li>
                                    <li><a href="{{ url('Terms&conditions') }}">Terms and conditions</a></li>
                                </ul><!-- End .widget-list -->
                            </div><!-- End .widget -->
                        </div><!-- End .col-sm-4 col-lg-2 -->

                        <div class="col-sm-4 col-lg-2">
                            <div class="widget">
                                <h4 class="widget-title" style="color : #fff;">My Account</h4>
                                <!-- End .widget-title -->

                                <ul class="widget-list">
                                    <li><a href="#signin-modal" data-toggle="modal">Sign Up</a></li>
                                    <li><a href="#signin-modal" data-toggle="modal">Sign In</a></li>
                                    <li><a href="{{ url('Track-Your-Order') }}">Track Order</a></li>
                                    <li><a href="#">Help</a></li>
                                </ul><!-- End .widget-list -->
                            </div><!-- End .widget -->
                        </div><!-- End .col-sm-4 col-lg-2 -->

                        <div class="col-sm-4 col-lg-2">
                            <div class="widget widget-newsletter">
                                <h4 class="widget-title" style="color : #fff;">Social Media</h4>
                                <!-- End .widget-title -->

                                <p>Stay connected with our social media.</p><br>

                                <div class="social-icons social-icons-color">
                                    <a href="{{ url($Setting->facebook) }}" class="social-icon social-facebook"
                                        title="Facebook" target="_blank"><i class="icon-facebook-f"></i></a>
                                    <a href="{{ url($Setting->twitter) }}" class="social-icon social-twitter"
                                        title="Twitter" target="_blank"><i class="icon-twitter"></i></a>
                                    <a href="{{ url($Setting->instagram) }}" class="social-icon social-instagram"
                                        title="Instagram" target="_blank"><i class="icon-instagram"></i></a>
                                    <a href="{{ url($Setting->youtube) }}" class="social-icon social-youtube"
                                        title="Youtube" target="_blank"><i class="icon-youtube"></i></a>
                                    <a href="{{ url($Setting->facebook) }}" class="social-icon social-pinterest"
                                        title="Pinterest" target="_blank"><i class="icon-pinterest"></i></a>
                                </div><!-- End .soial-icons -->
                            </div><!-- End .widget -->
                        </div><!-- End .col-sm-4 col-lg-2 -->
                    </div><!-- End .row -->
                </div><!-- End .container-fluid -->
            </div><!-- End .footer-middle -->

            <div class="footer-bottom">
                <div class="container-fluid">
                    <p class="footer-copyright text-center" style="color: #fff;">Copyright &copy;
                        <script>
                            document.write(new Date().getFullYear());
                        </script>
                        Monarch Mart All rights reserved.
                    </p><!-- End .footer-copyright -->
                </div><!-- End .container-fluid -->
            </div><!-- End .footer-bottom -->
        </footer><!-- End .footer -->
    </div><!-- End .page-wrapper -->
    <button id="scroll-top" title="Back to Top"><i class="icon-arrow-up"></i></button>

    <!-- Mobile Menu -->
    <div class="mobile-menu-overlay"></div><!-- End .mobil-menu-overlay -->

    <div class="mobile-menu-container">
        <div class="mobile-menu-wrapper">
            <span class="mobile-menu-close"><i class="icon-close"></i></span>

            <form method="get" action="{{ url('SearchProduct') }}" class="mobile-search">
                @csrf
                <label for="mobile-search" class="sr-only">Search</label>
                <input type="search" class="form-control" name="searchdata" id="mobile-search"
                    placeholder="Search in..." required>
                <button class="btn btn-primary" type="submit"><i class="icon-search"></i></button>
            </form>

            <ul class="nav nav-pills-mobile" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="mobile-menu-link" data-toggle="tab" href="#mobile-menu-tab"
                        role="tab" aria-controls="mobile-menu-tab" aria-selected="true">Menu</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="mobile-cats-link" data-toggle="tab" href="#mobile-cats-tab"
                        role="tab" aria-controls="mobile-cats-tab" aria-selected="false">Categories</a>
                </li>
            </ul>

            <div class="tab-content">
                <div class="tab-pane fade show active" id="mobile-menu-tab" role="tabpanel"
                    aria-labelledby="mobile-menu-link">
                    <nav class="mobile-nav">
                        <ul class="mobile-menu">
                            <li><a href="{{ url('Brands') }}">Brands</a></li>
                            <li><a href="{{ url('About-Us') }}">About Us</a></li>
                            <li><a href="{{ url('Contact-Us') }}">Contact Us</a></li>
                            <li><a href="about-2.html">Sign Up</a></li>
                            <li><a href="about-2.html">Sign In</a></li>
                        </ul>
                    </nav><!-- End .mobile-nav -->
                </div><!-- .End .tab-pane -->

                <div class="tab-pane fade" id="mobile-cats-tab" role="tabpanel" aria-labelledby="mobile-cats-link">
                    <nav class="mobile-nav">
                        <ul class="mobile-menu">

                            @php
                                $Item = DB::table('iteminformation')
                                    ->orderBy('id', 'ASC')
                                    ->where('status', 1)
                                    ->get();
                                $Category = DB::table('categoryinformation')
                                    ->where('status', 1)
                                    ->get();
                                $SubCategory = DB::table('subcategoryinformation')
                                    ->where('status', 1)
                                    ->get();
                            @endphp

                            @foreach ($Item as $ItemShow)
                                <li>
                                    <a href="{{ url('Item/' . $ItemShow->id, $ItemShow->item_name) }}"
                                        style="font-size: 12px;">{{ $ItemShow->item_name }}</a>

                                    <ul>

                                        @foreach ($Category as $CategoryShow)
                                            @if ($ItemShow->id == $CategoryShow->item_id)
                                                <li>
                                                    <a
                                                        href="{{ url('Category/' . $CategoryShow->id, $CategoryShow->category_name) }}">{{ $CategoryShow->category_name }}</a>

                                                    <ul>

                                                        @foreach ($SubCategory as $SubCategoryShow)
                                                            @if ($CategoryShow->id == $SubCategoryShow->category_id)
                                                                <li><a
                                                                        href="{{ url('SubCategory/' . $SubCategoryShow->id, $SubCategoryShow->subcategory_name) }}">{{ $SubCategoryShow->subcategory_name }}</a>
                                                                </li>
                                                            @endif
                                                        @endforeach

                                                    </ul>
                                                </li>
                                            @endif
                                        @endforeach

                                    </ul>
                                </li>
                            @endforeach

                        </ul>
                    </nav><!-- End .mobile-nav -->

                </div><!-- .End .tab-pane -->

            </div><!-- End .tab-content -->

            <div class="social-icons mt-4">
                <a href="{{ url($Setting->facebook) }}" class="social-icon social-facebook" title="Facebook"
                    target="_blank"><i class="icon-facebook-f"></i></a>
                <a href="{{ url($Setting->twitter) }}" class="social-icon social-twitter" title="Twitter"
                    target="_blank"><i class="icon-twitter"></i></a>
                <a href="{{ url($Setting->instagram) }}" class="social-icon social-instagram" title="Instagram"
                    target="_blank"><i class="icon-instagram"></i></a>
                <a href="{{ url($Setting->youtube) }}" class="social-icon social-youtube" title="Youtube"
                    target="_blank"><i class="icon-youtube"></i></a>
                <a href="{{ url($Setting->facebook) }}" class="social-icon social-pinterest" title="Pinterest"
                    target="_blank"><i class="icon-pinterest"></i></a>
            </div><!-- End .social-icons -->
        </div><!-- End .mobile-menu-wrapper -->
    </div><!-- End .mobile-menu-container -->

    <!-- Sign in / Register Modal -->
    <div class="modal fade" id="signin-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="icon-close"></i></span>
                    </button>

                    <div class="form-box">
                        <div class="form-tab">
                            <ul class="nav nav-pills nav-fill" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="signin-tab" data-toggle="tab" href="#signin"
                                        role="tab" aria-controls="signin" aria-selected="true">Sign In</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="register-tab" data-toggle="tab" href="#register"
                                        role="tab" aria-controls="register" aria-selected="false">Register</a>
                                </li>
                            </ul>
                            <div class="tab-content" id="tab-content-5">
                                <div class="tab-pane fade show active" id="signin" role="tabpanel"
                                    aria-labelledby="signin-tab">

                                    <form method="POST" action="{{ route('login') }}">
                                        @csrf
                                        <div class="form-group">
                                            <label for="singin-email">Email address *</label>
                                            <input type="text"
                                                class="form-control @error('email') is-invalid @enderror" name="email"
                                                value="{{ old('email') }}" id="singin-email" required
                                                autocomplete="email" autofocus>

                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror

                                        </div><!-- End .form-group -->

                                        <div class="form-group">
                                            <label for="singin-password">Password *</label>
                                            <input type="password"
                                                class="form-control @error('password') is-invalid @enderror"
                                                id="singin-password" name="password" required
                                                autocomplete="current-password">

                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror

                                        </div><!-- End .form-group -->

                                        <div class="form-footer">
                                            <button type="submit" class="btn btn-outline-primary-2">
                                                <span>LOG IN</span>
                                                <i class="icon-long-arrow-right"></i>
                                            </button>

                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input"
                                                    id="signin-remember" required>
                                                <label class="custom-control-label" for="signin-remember">Remember
                                                    Me</label>
                                            </div><!-- End .custom-checkbox -->
                                            <a href="#" class="forgot-link">Forgot Your Password?</a>
                                        </div><!-- End .form-footer -->
                                    </form>
                                    <div class="form-choice">
                                        <p class="text-center">or sign in with</p>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <a href="#" class="btn btn-login btn-g">
                                                    <i class="icon-google"></i>
                                                    Login With Google
                                                </a>
                                            </div><!-- End .col-6 -->
                                            <div class="col-sm-6">
                                                <a href="#" class="btn btn-login btn-f">
                                                    <i class="icon-facebook-f"></i>
                                                    Login With Facebook
                                                </a>
                                            </div><!-- End .col-6 -->
                                        </div><!-- End .row -->
                                    </div><!-- End .form-choice -->
                                </div><!-- .End .tab-pane -->

                                <div class="tab-pane fade" id="register" role="tabpanel"
                                    aria-labelledby="register-tab">
                                    <form method="POST" action="{{ url('User-Signup') }}"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <div class="form-group col-lg-6">
                                                <label>Name *</label>
                                                <input type="text" class="form-control" name="name" required>
                                            </div><!-- End .form-group -->

                                            <div class="form-group col-lg-6">
                                                <label>Your email address *</label>
                                                <input type="email" class="form-control" name="email" required>
                                            </div><!-- End .form-group -->

                                            <div class="form-group col-lg-6">
                                                <label>Phone *</label>
                                                <input type="text" class="form-control" name="phone" required>
                                            </div><!-- End .form-group -->

                                            <div class="form-group col-lg-6">
                                                <label>Password *</label>
                                                <input type="password" class="form-control" name="password" required>
                                            </div><!-- End .form-group -->
                                        </div><!-- End .row -->

                                        <div class="form-footer">
                                            <button type="submit" class="btn btn-outline-primary-2">
                                                <span>SIGN UP</span>
                                                <i class="icon-long-arrow-right"></i>
                                            </button>

                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input"
                                                    id="register-policy" required>
                                                <label class="custom-control-label" for="register-policy">I agree to
                                                    the <a href="#">privacy policy</a> *</label>
                                            </div><!-- End .custom-checkbox -->
                                        </div><!-- End .form-footer -->
                                    </form>
                                    <div class="form-choice">
                                        <p class="text-center">or sign in with</p>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <a href="#" class="btn btn-login btn-g">
                                                    <i class="icon-google"></i>
                                                    Login With Google
                                                </a>
                                            </div><!-- End .col-6 -->
                                            <div class="col-sm-6">
                                                <a href="#" class="btn btn-login  btn-f">
                                                    <i class="icon-facebook-f"></i>
                                                    Login With Facebook
                                                </a>
                                            </div><!-- End .col-6 -->
                                        </div><!-- End .row -->
                                    </div><!-- End .form-choice -->
                                </div><!-- .End .tab-pane -->
                            </div><!-- End .tab-content -->
                        </div><!-- End .form-tab -->
                    </div><!-- End .form-box -->
                </div><!-- End .modal-body -->
            </div><!-- End .modal-content -->
        </div><!-- End .modal-dialog -->
    </div><!-- End .modal -->


    {{-- Start Mobile Menu --}}

    <div class="fixed-bottom p-2 d-md-none d-block text-center mobilefooter">
        <div class="row">
            <div class="col-md-5 col-5">
                <div class="row">
                    <div class="col">

                        <li><a href="" class="mobile-menu-toggler"><i style="color: #eb5829;" class="fa fa-bars"
                                    aria-hidden="true"></i></a></li>
                        <div class="title">Menu</div>
                    </div>
                    <div class="col">
                        <li>
                            @if (Auth::check())
                            <a href="{{ url('Wishlists') }}"><i style="color: #eb5829;" class="fa fa-heart"></i></a>
                            @else
                            <a href="#signin-modal" data-toggle="modal"><i style="color: #eb5829;" class="fa fa-heart"></i></a>
                            @endif
                        </li>
                        <div class="title">Wishlist</div>
                    </div>
                </div>
            </div>

            <div class="col-md-2 col-2 home">
                <a href="{{ url('/') }}"><i class="fa fa-home icons" aria-hidden="true"></i></a>
                <div class="title">Home</div>
            </div>


            <div class="col-md-5 col-5">
                <div class="row">
                    <div class="col">
                        <li>
                            @if (Auth::check())
                            <a href="{{ url('Cart') }}"><i style="color: #eb5829;" class="fa fa-shopping-cart"></i></a>
                            @else
                            <a href="#signin-modal" data-toggle="modal"><i style="color: #eb5829;" class="fa fa-shopping-cart"></i></a>
                            @endif
                        </li>
                        <div class="title">Cart</div>
                    </div>
                    <div class="col">

                        @if (Auth::check())
                            <li><a href="{{ url('User/Dashboard') }}"><i style="color: #eb5829;"
                                        class="fa fa-user"></i></a></li>
                            <div class="title">Profile</div>
                        @else
                            <li><a href="#signin-modal" data-toggle="modal"><i style="color: #eb5829;"
                                        class="fa fa-user"></i></a></li>
                            <div class="title">Login</div>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- End Mobile Menu --}}

    
    <!-- Plugins JS File -->
    <script src="{{ asset('public/frontend') }}/assets/js/jquery.min.js"></script>
    <script src="{{ asset('public/frontend') }}/assets/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('public/frontend') }}/assets/js/jquery.hoverIntent.min.js"></script>
    <script src="{{ asset('public/frontend') }}/assets/js/jquery.waypoints.min.js"></script>
    <script src="{{ asset('public/frontend') }}/assets/js/superfish.min.js"></script>
    <script src="{{ asset('public/frontend') }}/assets/js/owl.carousel.min.js"></script>
    <script src="{{ asset('public/frontend') }}/assets/js/bootstrap-input-spinner.js"></script>
    <script src="{{ asset('public/frontend') }}/assets/js/jquery.magnific-popup.min.js"></script>
    <script src="{{ asset('public/frontend') }}/assets/js/jquery.plugin.min.js"></script>
    <script src="{{ asset('public/frontend') }}/assets/js/jquery.countdown.min.js"></script>
    <script src="{{ asset('public/frontend') }}/assets/js/jquery.elevateZoom.min.js"></script>
    <!-- Main JS File -->
    <script src="{{ asset('public/frontend') }}/assets/js/main.js"></script>
    <script src="{{ asset('public/frontend') }}/assets/js/demos/demo-14.js"></script>
    <script src="{{ asset('public/frontend') }}/assets/js/wNumb.js"></script>
    <script src="{{ asset('public/frontend') }}/assets/js/nouislider.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
    <!-- Go to www.addthis.com/dashboard to customize your tools -->
    <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-62637b989217071a"></script>

    <!--toastr-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script>
    @if(Session::has('message'))
    toastr.options =
    {
        "closeButton" : true,
        "progressBar" : true
    }
            toastr.success("{{ session('message') }}");
    @endif

    @if(Session::has('error'))
    toastr.options =
    {
        "closeButton" : true,
        "progressBar" : true
    }
            toastr.error("{{ session('error') }}");
    @endif

    @if(Session::has('info'))
    toastr.options =
    {
        "closeButton" : true,
        "progressBar" : true
    }
            toastr.info("{{ session('info') }}");
    @endif

    @if(Session::has('warning'))
    toastr.options =
    {
        "closeButton" : true,
        "progressBar" : true
    }
            toastr.warning("{{ session('warning') }}");
    @endif
    </script>

    <style>
        .toast-message {
        -ms-word-wrap: break-word;
        word-wrap: break-word;

        font-size: 12px !important;
    }
    </style>    

</body>
</html>
