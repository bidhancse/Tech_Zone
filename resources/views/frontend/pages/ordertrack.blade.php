@extends('frontend.index')
@section('content')


<main class="main">
    <div class="page-header text-center" style="background-image: url('{{ asset('public/frontend')}}/assets/images/page-header-bg.jpg')">
        <div class="container">
            <h1 class="page-title">Order Tracking</h1>
        </div><!-- End .container -->
    </div><!-- End .page-header -->
    <nav aria-label="breadcrumb" class="breadcrumb-nav mb-3">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Order Tracking</li>
            </ol>
        </div><!-- End .container -->
    </nav><!-- End .breadcrumb-nav -->

    <div class="page-content">
        <div class="container-fluid">
            <div class="touch-container row justify-content-center">
                <div class="col-md-9 col-lg-7">

                    <div class="card">
                        <div class="card-body">
                            <div class="text-center">
                                <h2 class="title mb-3" style="border-bottom: 1px solid #d8d8d8; padding-bottom: 15px;">Check Your Order Status</h2><!-- End .title mb-2 -->
                            </div><!-- End .text-center -->

    
                            <form method="GET" action="{{ url('Tracking-Status') }}">
                   

                                <input type="text" class="form-control" name="order_track_code" placeholder=" Enter Order Tracking Code">
        
                                <div class="text-center">
                                    <button type="submit" class="btn btn-outline-primary-2 btn-minwidth-sm">
                                        <span>Track Order</span>
                                        <i class="icon-long-arrow-right"></i>
                                    </button>
                                </div><!-- End .text-center -->
                            </form><!-- End .contact-form -->
                        </div>
                    </div>
                </div><!-- End .col-md-9 col-lg-7 -->
            </div><!-- End .row -->
        </div><!-- End .container -->
    </div><!-- End .page-content -->
</main><!-- End .main -->

<style>
    .card{
        padding: 20px;
        background: #fbfbfb;
        border-radius: 5px;
        box-shadow: rgba(17, 17, 26, 0.1) 0px 0px 16px;
    }
    .card-body{
        padding: 20px;
        border: 1px dashed #d6d6d6;

    }
</style>

@endsection