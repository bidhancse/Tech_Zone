@extends('frontend.index')
@section('content')


<main class="main">
    <div class="page-header text-center" style="background-image: url('{{ asset('public/frontend')}}/assets/images/page-header-bg.jpg')">
        <div class="container">
            <h1 class="page-title">My Account</h1>
        </div><!-- End .container -->
    </div><!-- End .page-header -->
    <nav aria-label="breadcrumb" class="breadcrumb-nav mb-3">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">My Account</li>
            </ol>
        </div><!-- End .container -->
    </nav><!-- End .breadcrumb-nav -->





        <div class="container-fluid">
            <article class="card mb-5">
                <header class="card-header"> My Orders / Tracking </header>
                <div class="card-body">
                    <h6>Invoice ID: {{$OrderTrack->id}}</h6>
                    <article class="card">
                        <div class="card-body row">
                            <div class="col-lg-3 col-6"> <strong>Estimated Delivery time:</strong> <br>29 nov 2019 </div>
                            <div class="col-lg-3 col-6"> <strong>Shipping BY:</strong> <br> BLUEDART, | <i class="fa fa-phone"></i> +1598675986 </div>
                            <div class="col-lg-3 col-6"> <strong>Status:</strong> <br> 
                                @if($OrderTrack->status==0)
                                    <p>Order confirmed</p>
                                @elseif($OrderTrack->status==1)
                                    <p>Order Processing</p>
                                @elseif($OrderTrack->status==2)
                                    <p>Order Shipping</p>
                                @elseif($OrderTrack->status==3)
                                    <p>Order Completd</p>
                                @endif
                            
                            </div>
                            <div class="col-lg-3 col-6"> <strong>Tracking #:</strong> <br> {{$OrderTrack->tracking_code}} </div>
                        </div>
                    </article>
                    <div class="track">

                        @if($OrderTrack->status==0)
                            <div class="step active"> <span class="icon"> <i class="fa fa-check"></i> </span> <span class="text">Order confirmed</span> </div>
                            <div class="step"> <span class="icon"> <i class="fa fa-user"></i> </span> <span class="text"> Processing</span> </div>
                            <div class="step"> <span class="icon"> <i class="fa fa-truck"></i> </span> <span class="text"> Shipping </span> </div>
                            <div class="step"> <span class="icon"> <i class="fa fa-box"></i> </span> <span class="text">Delivered</span> </div>

                        @elseif($OrderTrack->status==1)
                            <div class="step active"> <span class="icon"> <i class="fa fa-check"></i> </span> <span class="text">Order confirmed</span> </div>
                            <div class="step active"> <span class="icon"> <i class="fa fa-user"></i> </span> <span class="text"> Processing</span> </div>
                            <div class="step"> <span class="icon"> <i class="fa fa-truck"></i> </span> <span class="text"> Shipping </span> </div>
                            <div class="step"> <span class="icon"> <i class="fa fa-box"></i> </span> <span class="text">Delivered</span> </div>

                        @elseif($OrderTrack->status==2)
                            <div class="step active"> <span class="icon"> <i class="fa fa-check"></i> </span> <span class="text">Order confirmed</span> </div>
                            <div class="step active"> <span class="icon"> <i class="fa fa-user"></i> </span> <span class="text"> Processing</span> </div>
                            <div class="step active"> <span class="icon"> <i class="fa fa-truck"></i> </span> <span class="text"> Shipping </span> </div>
                            <div class="step"> <span class="icon"> <i class="fa fa-box"></i> </span> <span class="text">Delivered</span> </div>

                        @elseif($OrderTrack->status==3)
                            <div class="step active"> <span class="icon"> <i class="fa fa-check"></i> </span> <span class="text">Order confirmed</span> </div>
                            <div class="step active"> <span class="icon"> <i class="fa fa-user"></i> </span> <span class="text"> Processing</span> </div>
                            <div class="step active"> <span class="icon"> <i class="fa fa-truck"></i> </span> <span class="text"> Shipping </span> </div>
                            <div class="step active"> <span class="icon"> <i class="fa fa-box"></i> </span> <span class="text">Delivered</span> </div>

                        @endif
            
                    </div>
                    <hr>
                    <ul class="row">

                        @php
                            $total=0;
                        @endphp

                        @foreach ($OrderProduct as $OrderProductShow)

                        @php
                            $total += $OrderProductShow->total_price;
                        @endphp
                            
                        <li class="col-md-6">
                            <figure class="itemside mb-3">
                                <div class="aside"><img src="{{url($OrderProductShow->image)}}" class="img-sm border"></div>
                                <figcaption class="info align-self-center">
                                    <p class="title" style="font-size: 13px">{{ $OrderProductShow->product_name }}</p> 
                                    <span class="text-muted">{{ $OrderProductShow->total_price }}.00 TK </span>
                                </figcaption>
                            </figure>
                        </li>

                        @endforeach

                    </ul>
                    <hr>
                    <h5>Total Amount : {{  $total }}.00 Tk</h5>

                    <hr>
                    <a href="{{ url('/') }}" class="btn btn-warning" data-abc="true"> <i class="icon-long-arrow-left"></i> Continue Shopping</a>
                </div>
            </article>
        </div>
</main><!-- End .main -->



<style>
    @import url('https://fonts.googleapis.com/css?family=Open+Sans&display=swap');body{font-family: 'Open Sans',serif}.card{position: relative;display: -webkit-box;display: -ms-flexbox;display: flex;-webkit-box-orient: vertical;-webkit-box-direction: normal;-ms-flex-direction: column;flex-direction: column;min-width: 0;word-wrap: break-word;background-color: #fff;background-clip: border-box;border: 1px solid rgba(0, 0, 0, 0.1);border-radius: 0.10rem}.card-header:first-child{border-radius: calc(0.37rem - 1px) calc(0.37rem - 1px) 0 0}.card-header{padding: 0.75rem 1.25rem;margin-bottom: 0;background-color: #fff;border-bottom: 1px solid rgba(0, 0, 0, 0.1)}.card-body{padding: 10px !important;}.track{position: relative;background-color: #ddd;height: 7px;display: -webkit-box;display: -ms-flexbox;display: flex;margin-bottom: 80px;margin-top: 50px}.track .step{-webkit-box-flex: 1;-ms-flex-positive: 1;flex-grow: 1;width: 25%;margin-top: -18px;text-align: center;position: relative}.track .step.active:before{background: #FF5722}.track .step::before{height: 7px;position: absolute;content: "";width: 100%;left: 0;top: 18px}.track .step.active .icon{background: #eb5829;color: #fff}.track .icon{display: inline-block;width: 40px;height: 40px;line-height: 40px;position: relative;border-radius: 100%;background: #ddd}.track .step.active .text{font-weight: 400;color: #000}.track .text{display: block;margin-top: 7px}.itemside{position: relative;display: -webkit-box;display: -ms-flexbox;display: flex;width: 100%}.itemside .aside{position: relative;-ms-flex-negative: 0;flex-shrink: 0}.img-sm{width: 80px;height: 80px;padding: 7px}ul.row, ul.row-sm{list-style: none;padding: 0}.itemside .info{padding-left: 15px;padding-right: 7px}.itemside .title{display: block;margin-bottom: 5px;color: #212529}p{margin-top: 0;margin-bottom: 1rem}.btn-warning{color: #ffffff;background-color: #eb5829;border-color: #eb5829;border-radius: 1px}.btn-warning:hover{color: #ffffff;background-color: #ff2b00;border-color: #ff2b00;border-radius: 1px}
</style>


@endsection