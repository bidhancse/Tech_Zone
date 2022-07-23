@extends('frontend.index')
@section('content')


<main class="main">
   <div class="page-header text-center" style="background-image: url('{{ asset('public/frontend')}}/assets/images/page-header-bg.jpg')">
      <div class="container">
          <h1 class="page-title">Buying Process</h1>
      </div><!-- End .container -->
  </div><!-- End .page-header -->
   <nav aria-label="breadcrumb" class="breadcrumb-nav mb-2">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ url('Buying-Process') }}">Buying Process</a></li>
            </ol>
        </div><!-- End .container -->
    </nav><!-- End .breadcrumb-nav -->

<div class="mb-5"></div><!-- End .mb-4 -->

   <div class="page-content pb-0">
      <div class="container">
         <div class="row">
            <div class="col-lg-12 mb-3 mb-lg-0">
               <h2 class="title">Buying Process Tech Zone</h2><!-- End .title -->
               <p>{!! $BuyingProcess->details !!}</p>
            </div><!-- End .col-lg-12 -->
         </div><!-- End .row -->

         <div class="mb-5"></div><!-- End .mb-4 -->
      </div><!-- End .container -->
   </div><!-- End .page-content -->
</main><!-- End .main -->


@endsection