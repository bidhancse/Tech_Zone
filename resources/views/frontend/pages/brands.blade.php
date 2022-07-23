@extends('frontend.index')
@section('content')
    <style>
        /* Grow */
        .hvr-grow {
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
        }

        .hvr-grow:hover,
        .hvr-grow:focus,
        .hvr-grow:active {
            -webkit-transform: scale(1.1);
            transform: scale(1.1);
        }
    </style>

    <main class="main">
        <div class="page-header text-center"
            style="background-image: url('{{ asset('public/frontend') }}/assets/images/page-header-bg.jpg')">
            <div class="container">
                <h1 class="page-title">All Brands</h1>
            </div><!-- End .container -->
        </div><!-- End .page-header -->
        <nav aria-label="breadcrumb" class="breadcrumb-nav mb-2">
            <div class="container">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ url('About-Us') }}">All Brands</a></li>
                </ol>
            </div><!-- End .container -->
        </nav><!-- End .breadcrumb-nav -->

        <div class="page-content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">

                        <div class="cat-blocks-container">
                            <div class="row">

                                @foreach ($Brand as $BrandShow)
                                    <div class="col-4 col-md-1 col-lg-1 mt-1">
                                        <a href="{{ url('BrandProduct/' . $BrandShow->id) }}" style="height: 70px;"
                                            class="hvr-grow">
                                            <figure>
                                                <span>
                                                    <img src="{{ url($BrandShow->image) }}" alt="Category image"
                                                        style="box-shadow: rgba(0, 0, 0, 0.1) 0px 4px 12px;">
                                                </span>
                                            </figure>
                                        </a>
                                    </div><!-- End .col-6 col-md-4 col-lg-3 -->
                                @endforeach

                            </div><!-- End .row -->
                        </div><!-- End .cat-blocks-container -->
                    </div>
                </div>
            </div>
        </div>

    </main><!-- End .main -->
@endsection
