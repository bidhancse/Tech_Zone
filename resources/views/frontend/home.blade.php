@extends('frontend.index')
@section('content')


<main class="main">
 <div class="container-fluid">
  <div class="row">
   <div id="carouselExampleFade" class="carousel slide carousel-fade" data-bs-ride="carousel" style="padding: 0 20px 0 20px;">
    <div class="carousel-inner">
     @if(isset($Slider))
     @foreach($Slider as $SliderActiveShow)

     <div class="carousel-item @if($loop->first) active @endif">
      <img src="{{url($SliderActiveShow->image)}}" class="d-block w-100" alt="..." style="max-height: 500px;">
     </div>

     @endforeach
     @endif
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="prev">
     <span class="carousel-control-prev-icon" aria-hidden="true"></span>
     <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="next">
     <span class="carousel-control-next-icon" aria-hidden="true"></span>
     <span class="visually-hidden">Next</span>
    </button>
   </div>
  </div><!-- End .row -->
 </div><!-- End .container-fluid -->

 <div class="mb-3"></div><!-- End .mb-3 -->

<div class="container-fluid">
    <h2 class="title text-center  mt-4">Featured Category</h2><!-- End .title text-center -->
    <p class="text-center mb-4">Get Your Desired Product from Featured Category!</p>
    <div class="row" style="padding: 0 5px 0 5px;">

        @php
            $Items = DB::table('iteminformation')->where('status', 1)->get();
        @endphp

        @foreach($Items as $ItemsShow)
            <div class="col-lg-2 col-md-3 col-6">
                <div class="cat-item">
                    <a href="{{ url('Item/'.$ItemsShow->id, $ItemsShow->item_name) }}" class="cat-item-inner">
                        <span class="cat-icon"><img  src="{{url($ItemsShow->image)}}" alt="{{ $ItemsShow->item_name }}" width="48" height="48"></span>
                        <p>{{ $ItemsShow->item_name }}</p>
                    </a>
                </div>
            </div>
        @endforeach
        
    </div>
</div>


<div class="container-fluid">

  @php
    $ItemOne = DB::table('iteminformation')->where('status',1)->limit('1')->get();
    $Category = DB::table('categoryinformation')->where('status',1)->limit('5')->get();
  @endphp

  @foreach( $ItemOne as $ItemOneShow )

  <div class=" trending-products">
   <div class="heading heading-flex mb-3">
    <div class="heading-left">
     <h2 class="title">{{ $ItemOneShow->item_name }}</h2><!-- End .title -->
    </div><!-- End .heading-left -->

    <div class="heading-right">
     <ul class="nav nav-pills justify-content-center" role="tablist">
      <li class="nav-item">
       <a class="nav-link active" id="trending-all-link" data-toggle="tab" href="#All" role="tab" aria-controls="trending-all-tab" aria-selected="true">All</a>
      </li>

      @if(isset($Category))
      @foreach( $Category as $CategoryShow)
      @if($ItemOneShow->id == $CategoryShow->item_id)

      <li class="nav-item">
       <a class="nav-link" data-toggle="tab" href="#category{{ $CategoryShow->id }}" role="tab" aria-controls="trending-elec-tab" aria-selected="false">{{ $CategoryShow->category_name }}</a>
      </li>

      @endif
      @endforeach
      @endif

     </ul>
    </div><!-- End .heading-right -->
   </div><!-- End .heading -->

   <div class="tab-content tab-content-carousel">
    <div class="tab-pane p-0 fade show active" id="All" role="tabpanel" aria-labelledby="trending-all-link">
     <div class="owl-carousel owl-simple carousel-equal-height carousel-with-shadow" data-toggle="owl" 
     data-owl-options='{
      "nav": false, 
      "dots": true,
      "margin": 20,
      "loop": false,
      "responsive": {
       "0": {
        "items":1
       },
       "480": {
        "items":2
       },
       "768": {
        "items":3
       },
       "992": {
        "items":4
       },
       "1200": {
        "items":4,
        "nav": true
       },
       "1600": {
        "items":5,
        "nav": true
       }
      }
     }'>


    @php
        $Items = DB::table('productinformation')->where('item_id',$ItemOneShow->id)->orderBy('id','DESC')->get();
    @endphp

    @if(isset($Items))
    @foreach($Items as $ItemsShow)
    @if($ItemOneShow->id == $ItemsShow->item_id)


     <div class="product text-center">
      <figure class="product-media">

       @php
       $dis_percentig = $ItemsShow->discount_price / $ItemsShow->sale_price*100;
       @endphp

       @if(isset($ItemsShow->discount_price))
       <span class="product-label label-top">{{ceil($dis_percentig)}} % OFF</span>
       @endif
       <a href="{{ url('productdetails/'.$ItemsShow->id) }}">
        <img src="{{ url($ItemsShow->image) }}" alt="Product image" class="product-image">
       </a>

       <div class="product-action-vertical">

        @if (Auth::check())
        <a href="{{ url('wishlist/'.$ItemsShow->id) }}" class="btn-product-icon btn-wishlist btn-expandable"><span>add to wishlist</span></a>
        @else
        <a href="#signin-modal" data-toggle="modal" class="btn-product-icon btn-wishlist btn-expandable"><span>add to wishlist</span></a>
        @endif
       </div><!-- End .product-action-vertical -->

       <div class="product-action">
        <a href="{{ url('productdetails/'.$ItemsShow->id) }}" class="btn-product btn-cart" title="Add to cart" style="border: none;"><span>add to cart</span></a>
       </div><!-- End .product-action --><!-- End .product-action -->
      </figure><!-- End .product-media -->

      <div class="product-body">

       @php
       $content = substr($ItemsShow->product_name,0,40);
       $sale_price = $ItemsShow->sale_price;
       $dis_price = $ItemsShow->discount_price;
       $present_price = $sale_price-$dis_price;
       @endphp


       <h3 class="product-title"><a href="{{ url('productdetails/'.$ItemsShow->id) }}">{!! $content !!}</a></h3><!-- End .product-title -->
       <div class="product-price">

        @if(isset($dis_price))
        <del>{{$ItemsShow->sale_price}}</del> &nbsp;&nbsp;
        @endif
        <span class="out-price">Tk {{$present_price}}.00</span>
       </div><!-- End .product-price -->
      </div><!-- End .product-body -->
     </div><!-- End .product -->

     @endif
     @endforeach
     @endif

    </div><!-- End .owl-carousel -->
   </div><!-- .End .tab-pane -->

   @foreach( $Category as $CategoryShow)

   <div class="tab-pane p-0 fade" id="category{{ $CategoryShow->id }}" role="tabpanel" aria-labelledby="trending-elec-link">
    <div class="owl-carousel owl-simple carousel-equal-height carousel-with-shadow" data-toggle="owl" 
    data-owl-options='{
     "nav": false, 
     "dots": true,
     "margin": 20,
     "loop": false,
     "responsive": {
      "0": {
       "items":1
      },
      "480": {
       "items":2
      },
      "768": {
       "items":3
      },
      "992": {
       "items":4
      },
      "1200": {
       "items":4,
       "nav": true
      },
      "1600": {
       "items":5,
       "nav": true
      }
     }
    }'>


    @php
    $CategoryProduct = DB::table('productinformation')->where('category_id',$CategoryShow->id)->orderBy('id','DESC')->get();
    @endphp

    @if(isset($CategoryProduct))
    @foreach($CategoryProduct as $CategoryProductShow)
    @if($CategoryShow->id == $CategoryProductShow->category_id)

    <div class="product text-center">
     <figure class="product-media">

      @php
      $dis_percentig = $CategoryProductShow->discount_price / $CategoryProductShow->sale_price*100;
      @endphp

      @if(isset($CategoryProductShow->discount_price))
      <span class="product-label label-top">{{ceil($dis_percentig)}} % OFF</span>
      @endif
      <a href="{{ url('productdetails/'.$CategoryProductShow->id) }}">
       <img src="{{ url($CategoryProductShow->image) }}" alt="Product image" class="product-image">
      </a>

      <div class="product-action-vertical">

       @if (Auth::check())
       <a href="{{ url('wishlist/'.$CategoryProductShow->id) }}" class="btn-product-icon btn-wishlist btn-expandable"><span>add to wishlist</span></a>
       @else
       <a href="#signin-modal" data-toggle="modal" class="btn-product-icon btn-wishlist btn-expandable"><span>add to wishlist</span></a>
       @endif
      </div><!-- End .product-action-vertical -->

      <div class="product-action">
       <a href="{{ url('productdetails/'.$CategoryProductShow->id) }}" class="btn-product btn-cart" title="Add to cart" style="border: none;"><span>add to cart</span></a>
      </div><!-- End .product-action --><!-- End .product-action -->
     </figure><!-- End .product-media -->

     <div class="product-body">

      @php
      $content = substr($CategoryProductShow->product_name,0,40);
      $sale_price = $CategoryProductShow->sale_price;
      $dis_price = $CategoryProductShow->discount_price;
      $present_price = $sale_price-$dis_price;
      @endphp


      <h3 class="product-title"><a href="{{ url('productdetails/'.$CategoryProductShow->id) }}">{!! $content !!}</a></h3><!-- End .product-title -->
      <div class="product-price">

       @if(isset($dis_price))
       <del>{{$CategoryProductShow->sale_price}}</del> &nbsp;&nbsp;
       @endif
       <span class="out-price">Tk {{$present_price}}.00</span>
      </div><!-- End .product-price -->
     </div><!-- End .product-body -->
    </div><!-- End .product -->

    @endif
    @endforeach
    @endif

   </div><!-- End .owl-carousel -->
  </div><!-- .End .tab-pane -->

  @endforeach

 </div><!-- End .tab-content -->
</div><!-- End .bg-lighter -->

@endforeach

@foreach( $Item as $ItemShow) 

@php
    $products = DB::table('productinformation')->where('item_id',$ItemShow->id)->first();
@endphp

@if($products)

<div class="container-fluid" >
 <h2 class="title text-center mb-4 mt-4">{{ $ItemShow->item_name }}</h2><!-- End .title text-center -->

 <div class="owl-carousel owl-simple carousel-equal-height carousel-with-shadow" data-toggle="owl" 
 data-owl-options='{
  "nav": false, 
  "dots": true,
  "margin": 20,
  "loop": false,
  "responsive": {
   "0": {
    "items":2
   },
   "480": {
    "items":2
   },
   "768": {
    "items":3
   },
   "992": {
    "items":4
   },
   "1200": {
    "items":6,
    "nav": true,
    "dots": false
   }
  }
 }'>


 @php
 $Product = DB::table('productinformation')->where('item_id',$ItemShow->id)->inRandomOrder()->get();
 @endphp


 @foreach($Product as $Productshow)
 @if($ItemShow->id == $Productshow->item_id)


 <div class="product product-7 text-center">
  <figure class="product-media">

   @php
   $dis_percentig = $Productshow->discount_price / $Productshow->sale_price*100;
   @endphp

   @if(isset($Productshow->discount_price))
   <span class="product-label label-top">{{ceil($dis_percentig)}} % OFF</span>
   @endif
   <a href="{{ url('productdetails/'.$Productshow->id) }}">
    <img src="{{ url($Productshow->image) }}" alt="Product image" class="product-image">
   </a>

   <div class="product-action-vertical">

    @if (Auth::check())
    <a href="{{ url('wishlist/'.$Productshow->id) }}" class="btn-product-icon btn-wishlist btn-expandable"><span>add to wishlist</span></a>
    @else
    <a href="#signin-modal" data-toggle="modal" class="btn-product-icon btn-wishlist btn-expandable"><span>add to wishlist</span></a>
    @endif
   </div><!-- End .product-action-vertical -->

   <div class="product-action">
    <a href="{{ url('productdetails/'.$Productshow->id) }}" class="btn-product btn-cart" title="Add to cart" style="border: none;"><span>add to cart</span></a>
   </div><!-- End .product-action --><!-- End .product-action -->
  </figure><!-- End .product-media -->

  <div class="product-body">

   @php
   $content = substr($Productshow->product_name,0,40);
   $sale_price = $Productshow->sale_price;
   $dis_price = $Productshow->discount_price;
   $present_price = $sale_price-$dis_price;
   @endphp


   <h3 class="product-title"><a href="{{ url('productdetails/'.$Productshow->id) }}">{!! $content !!}</a></h3><!-- End .product-title -->
   <div class="product-price">

    @if(isset($dis_price))
    <del>{{$Productshow->sale_price}}</del> &nbsp;&nbsp;
    @endif
    <span class="out-price">Tk {{$present_price}}.00</span>
   </div><!-- End .product-price -->
  </div><!-- End .product-body -->
 </div><!-- End .product -->

 @endif
 @endforeach

</div><!-- End .owl-carousel -->
</div>

@endif
@endforeach

<div class="mb-3"></div><!-- End .mb-3 -->

<div class="container-fluid">
    <h2 class="title text-center mb-4 mt-4">Brands</h2><!-- End .title -->
 <div class="owl-carousel owl-simple brands-carousel" data-toggle="owl" 
 data-owl-options='{
  "nav": false, 
  "dots": true,
  "margin": 20,
  "loop": false,
  "responsive": {
   "0": {
    "items":10
   },
   "480": {
    "items":6
   },
   "768": {
    "items":3
   },
   "992": {
    "items":4
   },
   "1200": {
    "items":10,
    "nav": true,
    "dots": false
   }
  }
 }'>

 @foreach( $Brand as $BrandShow )

 <a href="{{ url('BrandProduct/'.$BrandShow->id) }}" class="brand">
  <img src="{{ url($BrandShow->image) }}" alt="Brand Name">
 </a>

 @endforeach

 <a href="{{ url('Brands') }}" class="brand">
  <center style="padding:1px;">
   <button class="btn" style=" font-size: 14px; color: #ff9900; border-radius: 0px;"><strong>More</strong>&nbsp;<i class="fa fa-arrow-right"
    aria-hidden="true" ></i></button>
   </center>
  </a>

 </div><!-- End .owl-carousel -->

</div><!-- End .container-fluid -->
<!-- End .Brand -->

<div class="mb-5"></div><!-- End .mb-5 -->
</main><!-- End .main -->


@endsection