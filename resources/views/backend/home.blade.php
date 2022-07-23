@extends('backend.index')
@section('content')


<!--main contents start-->
<main class="main-content">
    <!--page title start-->
    <div class="page-title">
        <div class="container-fluid p-0">
            <div class="row">
                <div class="col-lg-12 col-12">
                    <h4 class="mb-0"> Dashboard</h4>
                    <ol class="breadcrumb mb-0 pl-0 pt-1 pb-0">
                        <li class="breadcrumb-item"><a href="#" class="default-color">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

 <!--page title end-->


 <div class="container-fluid">

    <!--state widget start-->
    <div class="row">
        <div class="col-xl-3 col-sm-6 col-6 mb-4">
            <div class="card card-shadow">
                    <div class="card-body ">
                        @php
                        $registeruser=DB::table('users')->where('status',1)->orderBy('id','DESC')->get();
                        @endphp

                        <i class="icon-people text-primary f30" style="color: #36a2f5 !important;"></i>
                        <h6 class="mb-0 mt-3">Register Users</h6>
                        <p class="f12 mb-0 mt-1" style="color: red">{{ Count($registeruser)}} Users</p>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 col-6 mb-4">
                <div class="card card-shadow">
                    <div class="card-body ">
                        @php
                        $activeuser=DB::table('users')->where('status',1)->orderBy('id','DESC')->get();
                        @endphp
                        <i class="icon-people text-primary f30"></i>
                        <h6 class="mb-0 mt-3">Active Users</h6>
                        <p class="f12 mb-0 mt-1" style="color: #00b400;">{{ Count($activeuser)}} Users</p>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 col-6 mb-4">
                <div class="card card-shadow">
                    <div class="card-body ">
                        @php
                        $Inactiveuser=DB::table('users')->where('status',0)->orderBy('id','DESC')->get();
                        @endphp
                        <i class="icon-people text-primary f30"></i>
                        <h6 class="mb-0 mt-3">Inactive Users</h6>
                        <p class="f12 mb-0 mt-1" style="color: red;">{{ Count($Inactiveuser)}} Users</p>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 col-6 mb-4">
                <div class="card card-shadow">
                    <div class="card-body ">
                        @php
                        $totalOrder=DB::table('invoiceinformation')->get();
                        @endphp

                        <i class=" icon-basket-loaded text-info f30"></i>
                        <h6 class="mb-0 mt-3">Total Order</h6>
                        <p class="f12 mb-0 mt-1" style="color: #00b400;">{{ Count($totalOrder)}} Order Placed</p>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 col-6 mb-4">
                <div class="card card-shadow">
                    <div class="card-body ">
                        @php
                        $PandingOrder=DB::table('invoiceinformation')->where('status',0)->get();
                        @endphp
                        <i class=" icon-basket-loaded text-info f30"></i>
                        <h6 class="mb-0 mt-3">Order Panding</h6>
                        <p class="f12 mb-0 mt-1" style="color: red">{{ Count($PandingOrder)}} Order Placed</p>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-sm-6 col-6 mb-4">
                <div class="card card-shadow">
                    <div class="card-body ">
                        @php
                        $ProcessingOrder=DB::table('invoiceinformation')->where('status',1)->get();
                        @endphp
                        <i class=" icon-basket-loaded text-info f30"></i>
                        <h6 class="mb-0 mt-3">Order Processing</h6>
                        <p class="f12 mb-0 mt-1" style="color: #00b400;">{{ Count($ProcessingOrder)}} Order Placed</p>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 col-6 mb-4">
                <div class="card card-shadow">
                    <div class="card-body ">
                        @php
                        $ShippingOrder=DB::table('invoiceinformation')->where('status',2)->get();
                        @endphp
                        <i class=" icon-basket-loaded text-info f30"></i>
                        <h6 class="mb-0 mt-3">Order Shipping </h6>
                        <p class="f12 mb-0 mt-1" style="color: #00b400;">{{ Count($ShippingOrder)}} Order Placed</p>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 col-6 mb-4">
                <div class="card card-shadow">
                    <div class="card-body ">
                        @php
                        $CompletdOrder=DB::table('invoiceinformation')->where('status',3)->get();
                        @endphp
                        <i class=" icon-basket-loaded text-info f30"></i>
                        <h6 class="mb-0 mt-3">Order Completd</h6>
                        <p class="f12 mb-0 mt-1" style="color: #00b400;">{{ Count($CompletdOrder)}} Order Placed</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

</main>
<!--main contents end-->

@endsection