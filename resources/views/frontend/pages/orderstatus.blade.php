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
                                

                                    @if($OrderStatus == NULL)
                                    
                                    <h2 class="title mt-2 mb-2 text-danger">Order Track Code is Wrong !!</h2>

                                    @else

                                        @if($OrderStatus->status==0)

                                        <h2 class="title mt-2 mb-2 text-success">Your Order has Confirmed</h2>

                                        @elseif($OrderStatus->status==1)

                                        <h2 class="title mt-2 mb-2 text-secondary">Your Order under Processing</h2>

                                        @elseif($OrderStatus->status==2)

                                        <h2 class="title mt-2 mb-2 text-warning">Your Products On The Way</h2>

                                        @elseif($OrderStatus->status==3)

                                        <h2 class="title mt-2 mb-2 text-success">Your Order has Delivered</h2>

                                        @endif

                                    @endif
                                </h2><!-- End .title mb-2 -->
                            </div><!-- End .text-center -->
    
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