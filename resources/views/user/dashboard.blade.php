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

    <div class="page-content">
        <div class="dashboard">
            <div class="container">
                <div class="row">
                    <aside class="col-md-4 col-lg-3">
                        <ul class="nav nav-dashboard flex-column mb-3 mb-md-0" role="tablist" style="padding: 0px 20px 0px 20px; border: .1rem dashed #d7d7d7">
                            <li class="nav-item">
                                <a class="nav-link active" id="tab-dashboard-link" data-toggle="tab" href="#tab-dashboard" role="tab" aria-controls="tab-dashboard" aria-selected="true">Dashboard</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="tab-orders-link" data-toggle="tab" href="#tab-orders" role="tab" aria-controls="tab-orders" aria-selected="false">Orders Information</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="tab-address-link" data-toggle="tab" href="#tab-address" role="tab" aria-controls="tab-address" aria-selected="false">Adresses</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="tab-account-link" data-toggle="tab" href="#tab-account" role="tab" aria-controls="tab-account" aria-selected="false">Account Details</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="tab-password-link" data-toggle="tab" href="#tab-password" role="tab" aria-controls="tab-password" aria-selected="false">Change Password</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();" style="border-bottom: none !important;">Sign Out</a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </aside><!-- End .col-lg-3 -->

                    <div class="col-md-8 col-lg-9">
                        <div class="tab-content">
                            <div class="tab-pane fade show active" style="border: .1rem dashed #d7d7d7; margin-top: -10px; background: #fbfbfb" id="tab-dashboard" role="tabpanel" aria-labelledby="tab-dashboard-link">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class=" d-flex justify-content-center"> 
                                            <div class="card p-4"> 
                                                <div class="image d-flex flex-column justify-content-center align-items-center"> 
                                                        <div class="img-border">
                                                            @if(Auth()->user()->image)
                                                            <img class="image-hover" alt="100x100" src="{{ url( Auth()->user()->image ) }}">
                                                            @else
                                                            <img class="image-hover" alt="100x100" src="{{url('public/image/userimage')}}/1.jpg">
                                                            @endif
                                                        </div>
                                                    <span class="name mt-1">{{ Auth()->user()->name }}</span> 
                                                    <span>{{ Auth()->user()->email }}</span>
                                                    <span>{{ Auth()->user()->phone }}</span>  
                                                    <div class=" d-flex mt-2"> 
                                                        <a class="nav-link btn btn-primary" id="tab-account-link" data-toggle="tab" href="#tab-account" role="tab" aria-controls="tab-account" aria-selected="false">Edit Profile</a> 
                                                    </div>
                                                    <div class=" px-2 rounded mt-4 date "> <span class="join">Joined {{ Auth()->user()->join_date }}</span> 
                                                    </div> 
                                                </div> 
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class=" d-flex justify-content-center"> 
                                            <!-- Elements list -->
                                            <div class="container mt-3">
                                                <h3 class="summary-title">Order Status Information</h3>
                                                <div class="row elements">
                                                    <div class="col-lg-6 col-md-6 col-6">
                                                        @if(isset($PendingOrder))
                                                            <div class="element">
                                                                <div class="mt-2 text-center">
                                                                    <label>{{count($PendingOrder)}}</label>
                                                                    <p>Pending Order</p>
                                                                </div>
                                                            </div>
                                                        @endif
                                                    </div>
                                                    <div class="col-lg-6 col-md-6 col-6">
                                                        @if(isset($ProcessingOrder))
                                                            <div class="element">
                                                                <div class="mt-2 text-center">
                                                                    <label>{{count($ProcessingOrder)}}</label>
                                                                    <p>Processing Order</p>
                                                                </div>
                                                            </div>
                                                        @endif
                                                    </div>
                                                    <div class="col-lg-6 col-md-6 col-6">
                                                        @if(isset($ShippingOrder))
                                                            <div class="element">
                                                                <div class="mt-2 text-center">
                                                                    <label>{{count($ShippingOrder)}}</label>
                                                                    <p>Shipping Order</p>
                                                                </div>
                                                            </div>
                                                        @endif
                                                    </div>
                                                    <div class="col-lg-6 col-md-6 col-6">
                                                        @if(isset($CompeleteOrder))
                                                            <div class="element ">
                                                                <div class="mt-2 text-center">
                                                                    <label>{{count($CompeleteOrder)}}</label>
                                                                    <p>Delivered Order</p>
                                                                </div>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div><!-- End Elements list -->
                                        </div>
                                    </div>
                                </div>
                            </div><!-- .End .tab-pane -->

                            <div class="tab-pane fade p-4" id="tab-orders" style="border: .1rem dashed #d7d7d7; margin-top: -10px; background: #fbfbfb" role="tabpanel" aria-labelledby="tab-orders-link">
                                <table class="table  table-mobile">
                                    <thead>
                                        <tr>
                                            <th>Invoice Id</th>
                                            <th>Track Code</th>
                                            <th>Order Date</th>
                                            <th>Payment</th>
                                            <th>Stock Status</th>
                                        </tr>
                                    </thead>

                                    <tbody>

                                        @forelse ($OrderData as $OrderDataShow)

                                        <tr>
                                            <td class="price-col">{{ $OrderDataShow->id}}</td>
                                            <td class="price-col">{{ $OrderDataShow->tracking_code}}</td>
                                            <td class="price-col">{{ $OrderDataShow->order_date }}</td>
                                            <td class="stock-col">{{ $OrderDataShow->payment_method}}</td>
                                            <td class="action-col">
                                                <a href="{{ url('User/Order-Tracking/'.$OrderDataShow->id) }}" class="btn btn-block btn-outline-primary-2"><i class="fa fa-map-marker-alt"></i>Order Track</a>
                                            </td>
                                        </tr>

                                        @empty

                                        <tr>
                                            <td class="price-col text-center" colspan="5">
                                                <h4 class="text-danger">No Order Found !!</h4>
                                            </td>
                                        </tr>

                                        @endforelse

                                    </tbody>
                                </table><!-- End .table table-wishlist -->
                            </div><!-- .End .tab-pane -->


                            <div class="tab-pane fade p-4" id="tab-address" style="border: .1rem dashed #d7d7d7; margin-top: -10px; background: #fbfbfb" role="tabpanel" aria-labelledby="tab-address-link">

                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class=" d-flex justify-content-center">
                                            <div class="card card-dashboard ">
                                                <div class="card-body">
                                                    <h3 class="card-title">Billing Address</h3><!-- End .card-title -->

                                                    <p>
                                                        @if( Auth()->user()->address)
                                                        {{ Auth()->user()->name }}<br>
                                                        {{ Auth()->user()->phone }}<br>
                                                        {{ Auth()->user()->email }}<br>
                                                        {{ Auth()->user()->address }}<br>
                                                        @else
                                                        You have not set up this type of address yet.<br>
                                                        @endif
                                                    <a class="nav-link" id="tab-account-link" data-toggle="tab" href="#tab-account" role="tab" aria-controls="tab-account" aria-selected="false" style="margin-left: -10px;
                                                    color: #eb5829;">Edit <i class="icon-edit"></i></a></p>
                                                </div><!-- End .card-body -->
                                            </div><!-- End .card-dashboard -->
                                        </div>
                                    </div><!-- End .col-lg-6 -->

                                    <div class="col-lg-6">
                                        <div class=" d-flex justify-content-center">
                                            <div class="card card-dashboard">
                                                <div class="card-body">
                                                    <h3 class="card-title">Shipping Address</h3><!-- End .card-title -->

                                                    <p>
                                                        @if( Auth()->user()->address)
                                                        {{ Auth()->user()->address }}<br>
                                                        @else
                                                        You have not set up this type of address yet.<br>
                                                        @endif
                                                        
                                                    <a class="nav-link" id="tab-account-link" data-toggle="tab" href="#tab-account" role="tab" aria-controls="tab-account" aria-selected="false" style="margin-left: -10px;
                                                    color: #eb5829;">Edit <i class="icon-edit"></i></a></p>
                                                </div><!-- End .card-body -->
                                            </div><!-- End .card-dashboard -->
                                        </div>
                                    </div><!-- End .col-lg-6 -->
                                </div><!-- End .row -->
                            </div><!-- .End .tab-pane -->

                            <div class="tab-pane fade p-4" id="tab-account" style="border: .1rem dashed #d7d7d7; margin-top: -10px; background: #fbfbfb" role="tabpanel" aria-labelledby="tab-account-link">
                                <form method="post" action="{{url('Update-Profile/'.Auth()->user()->id)}}" enctype="multipart/form-data">
                                    @csrf
                                    <label>Name *</label>
                                    <input type="text" class="form-control" name="name" value="{{ Auth()->user()->name }}" required>
                                    
                                    <label>Email address *</label>
                                    <input type="email" class="form-control" name="email" value="{{ Auth()->user()->email }}" required>

                                    <label>Phone *</label>
                                    <input type="text" class="form-control" name="phone" value="{{ Auth()->user()->phone }}">

                                    <label>Address *</label>
                                    <textarea class="form-control" name="address" rows="2">{{ Auth()->user()->address }}</textarea>

                                    <label>Profile Picture</label>
                                    <input type="file" class="form-control mb-2" name="image" value="{{ Auth()->user()->image }}">
                                    <input type="hidden" value="{{ Auth()->user()->image }}" name="old_image">
                                    <button type="submit" class="btn btn-outline-primary-2">
                                        <span>SAVE CHANGES</span>
                                        <i class="icon-long-arrow-right"></i>
                                    </button>
                                </form>
                            </div><!-- .End .tab-pane -->

                            <div class="tab-pane fade p-4" id="tab-password" style="border: .1rem dashed #d7d7d7; margin-top: -10px; background: #fbfbfb" role="tabpanel" aria-labelledby="tab-password-link">
                                <form method="post" action="{{url('Update-Password')}}">
                                    @csrf
                                    <label>Old Password *</label>
                                    <input type="password" class="form-control" name="old_password" placeholder="Enter Old Password" required>
                                    
                                    <label>New Password *</label>
                                    <input type="password" class="form-control" name="new_password" placeholder="Enter New Password" required>

                                    <label>Confirm Password *</label>
                                    <input type="password" class="form-control" name="confirm_password" placeholder="Enter Confirm Password" required>

                                    <button type="submit" class="btn btn-outline-primary-2">
                                        <span>SAVE CHANGES</span>
                                        <i class="icon-long-arrow-right"></i>
                                    </button>
                                </form>
                            </div><!-- .End .tab-pane -->
                        </div>
                    </div><!-- End .col-lg-9 -->
                </div><!-- End .row -->
            </div><!-- End .container -->
        </div><!-- End .dashboard -->
    </div><!-- End .page-content -->
</main><!-- End .main -->


<style>
    .card {
    width: 340px;
    background-color: #ffffff;
    border: none;
    margin-top: 20px;
    border-radius: 20px;
    box-shadow: rgba(17, 17, 26, 0.1) 0px 0px 16px;
    cursor: pointer;
    transition: all 0.5s;
    border-bottom: none !important;
     
}

.element{
    background-color: #ffffff;
    border: none;
    margin-top: 20px;
    border-radius: 5px;
    box-shadow: rgba(17, 17, 26, 0.1) 0px 0px 16px;
    cursor: pointer;
    transition: all 0.5s;
    border-bottom: none !important;
}

.img-border{
    padding: 8px;
    border: 2px dotted #d7d7d7;
    border-radius: 90px;
}


.image-hover {
  display: inline-block;
  vertical-align: middle;
  -webkit-transform: translateZ(0);
  transform: translateZ(0);
  box-shadow: 0 0 1px rgba(0, 0, 0, 0);
  -webkit-backface-visibility: hidden;
  backface-visibility: hidden;
  -moz-osx-font-smoothing: grayscale;
  -webkit-transition-duration: 0.3s;
  transition-duration: 0.3s;
  -webkit-transition-property: transform;
  transition-property: transform;
  height: 150px;
  width: 150px;
  border-radius: 90px;
}
.image-hover:hover, .image-hover:focus, .image-hover:active {
  -webkit-transform: scale(1.1);
  transform: scale(1.1);
}

.name {
    font-size: 22px;
    font-weight: bold
}

.join {
    font-size: 14px;
    color: #a0a0a0;
    font-weight: bold
}

.date {
    background-color: #ccc
}
</style>


@endsection