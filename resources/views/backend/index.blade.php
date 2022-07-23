@php
$setting = DB::table('settinginformation')->first();
@endphp

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="MHS">
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <!--favicon icon-->
  <link rel="icon" type="image/png" href="{{ url($setting->favicon) }}">
  <title>Tech Zone | Dashboard</title>
  <!--google font-->
  <link href="http://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">
  <!--common style-->
  <link href="{{ asset('public/backend')}}/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="{{ asset('public/backend')}}/assets/vendor/lobicard/css/lobicard.css" rel="stylesheet">
  <link href="{{ asset('public/backend')}}/assets/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <link href="{{ asset('public/backend')}}/assets/vendor/simple-line-icons/css/simple-line-icons.css" rel="stylesheet">
  <link href="{{ asset('public/backend')}}/assets/vendor/themify-icons/css/themify-icons.css" rel="stylesheet">
  <link href="{{ asset('public/backend')}}/assets/vendor/weather-icons/css/weather-icons.min.css" rel="stylesheet">
  <!--easy pie chart-->
  <link href="{{ asset('public/backend')}}/assets/vendor/jquery-easy-pie-chart/jquery.easy-pie-chart.css" rel="stylesheet">
  <!--bs4 data table-->
  <link href="{{ asset('public/backend')}}/assets/vendor/data-tables/dataTables.bootstrap4.min.css" rel="stylesheet">
  <!--summernote-->
  <link href="{{ asset('public/backend')}}/assets/vendor/summernote/summernote-bs4.css" rel="stylesheet">
  <!--select2-->
  <link href="{{ asset('public/backend')}}/assets/vendor/select2/css/select2.css" rel="stylesheet">
  <!--custom css-->
  <link href="{{ asset('public/backend')}}/assets/css/main.css" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('public/backend')}}/assets/css/toast.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.6.2/css/buttons.dataTables.min.css">
  <!--ajax-->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <!--uikit-->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.11.1/dist/css/uikit.min.css" />

  <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
  <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script> 


</head>
<body class="app header-fixed left-sidebar-fixed right-sidebar-fixed right-sidebar-overlay right-sidebar-hidden">


  {{-- ...............Scrollbar Start.............. --}}

  <style>
/* width */
::-webkit-scrollbar {
  width: 4px;
}

/* Track */
::-webkit-scrollbar-track {
  background: #ddd; 
}

/* Handle */
::-webkit-scrollbar-thumb {
  background: #fd8900; 
}

/* Handle on hover */
::-webkit-scrollbar-thumb:hover {
  background: #fd8900; 
}


/*......data table image hover.....*/

* {
  box-sizing: border-box;
}

.zoom:hover {
  -ms-transform: scale(1.5); /* IE 9 */
  -webkit-transform: scale(1.5); /* Safari 3-8 */
  transform: scale(1.5); 
}


</style>

{{-- ...............Scrollbar End.............. --}}



<!--===========header start===========-->
<header class="app-header navbar">

  <!--brand start-->
  <div class="navbar-brand">
    <a class="" href="{{url('/backend')}}" style="text-decoration:none">
      <strong style="font-size: 22px;">
        <span style="color: red; font-family: Franklin Gothic Medium;">Admin</span> 
        <span style="color: black; font-family: Franklin Gothic Medium;">Panel</span>
      </strong>
    </a>
  </div>
  <!--brand end-->

  <!--left side nav toggle start-->
  <ul class="nav navbar-nav mr-auto" style="margin-top: -1px;">
    <li class="nav-item d-lg-none">
      <button class="navbar-toggler mobile-leftside-toggler" type="button"><i class="ti-align-right"></i></button>
    </li>
    <li class="nav-item d-md-down-none">
      <a class="nav-link navbar-toggler left-sidebar-toggler" href="#"><i class=" ti-align-right"></i></a>
    </li>
  </ul>
  <!--left side nav toggle end-->

  <!--right side nav start-->
  <ul class="nav navbar-nav ml-auto">
    <li class="nav-item dropdown dropdown-slide" style="margin-right: 10px; margin-top: -20px;">
      <a class="nav-link nav-pill user-avatar" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
        <img src="{{Auth()->user()->image}}">
      </a>
      <div class="dropdown-menu dropdown-menu-right dropdown-menu-accout">
        <div class="dropdown-header pb-3">
          <div class="media d-user">
            <img class="align-self-center mr-3" src="{{Auth()->user()->image}}">
            <div class="media-body">
              <h5 class="mt-0 mb-0">{{Auth()->user()->name}}</h5>
              <span>{{Auth()->user()->email}}</span>
            </div>
          </div>
        </div>

        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
        document.getElementById('logout-form').submit();">
        <i class=" ti-lock"></i> {{ __('Logout') }}</a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
          @csrf
        </form>
      </div>
    </li>
  </ul>

  <!--right side nav end-->
</header>
<!--===========header end===========-->

<!--===========app body start===========-->
<div class="app-body">

  <!--left sidebar start-->
  <div class="left-sidebar">
    <nav class="sidebar-menu">
      <ul id="nav-accordion">


        <li class="nav-title">
          <h5 class="text-uppercase">Menu</h5>
        </li>



        <li class="sub-menu">
          <a href="javascript:;" class="@if(request()->path() === 'Create-Admin' || request()->path() === 'Manage-Admin'){{'active'}}@else @endif">
            <i class="icon-grid text-info"></i>
            <span>Admin Setup</span>
          </a>
          <ul class="sub">
            <li>
              <a href="{{url('Create-Admin')}}" class="@if(request()->path() === 'Create-Admin'){{'text-info'}}@else @endif">Create Admin</a>
            </li>
            <li>
              <a href="{{url('Manage-Admin')}}" class="@if(request()->path() === 'Manage-Admin'){{'text-info'}}@else @endif">Manage Admin</a>
            </li>
          </ul>

          <li class="sub-menu">
            <a href="javascript:;" class="@if(request()->path() === 'Item' || request()->path() === 'Manage-Item'){{'active'}}@else @endif">
              <i class="icon-grid text-success "></i>
              <span>Item Information</span>
            </a>
            <ul class="sub">
              <li>
                <a href="{{url('Item')}}" class="@if(request()->path() === 'Item'){{'text-success'}}@else @endif">Item Add</a>
              </li>
              <li>
                <a href="{{url('Manage-Item')}}" class="@if(request()->path() === 'Manage-Item'){{'text-success'}}@else @endif">Manage Item</a>
              </li>

            </li>     
          </ul>

          <li class="sub-menu">
            <a href="javascript:;" class="@if(request()->path() === 'Category' || request()->path() === 'Manage-Category'){{'active'}}@else @endif">
              <i class="icon-grid text-danger"></i>
              <span>Category Information</span>
            </a>
            <ul class="sub">
              <li>
                <a href="{{url('Category')}}" class="@if(request()->path() === 'Category'){{'text-danger'}}@else @endif">Category Add</a>
              </li>
              <li>
                <a href="{{url('Manage-Category')}}" class="@if(request()->path() === 'Manage-Category'){{'text-danger'}}@else @endif">Manage Category</a>
              </li>
            </ul>


            <li class="sub-menu">
              <a href="javascript:;" class="@if(request()->path() === 'Sub-Category' || request()->path() === 'Manage-SubCategory'){{'active'}}@else @endif">
                <i class="icon-grid text-primary"></i>
                <span>SubCategory Information</span>
              </a>
              <ul class="sub">
                <li>
                  <a href="{{url('Sub-Category')}}" class="@if(request()->path() === 'Sub-Category'){{'text-primary'}}@else @endif">Sub Category Add</a>
                </li>
                <li>
                  <a href="{{url('Manage-SubCategory')}}" class="@if(request()->path() === 'Manage-SubCategory'){{'text-primary'}}@else @endif">Manage Sub Category</a>
                </li>
              </li>     
            </ul>

            <li class="sub-menu">
              <a href="javascript:;" class="@if(request()->path() === 'Brand' || request()->path() === 'Manage-Brand'){{'active'}}@else @endif">
                <i class="icon-grid text-info"></i>
                <span>Brand Information</span>
              </a>
              <ul class="sub">
                <li>
                  <a href="{{url('Brand')}}" class="@if(request()->path() === 'Brand'){{'text-info'}}@else @endif">Brand Add</a>

                </li>
                <li>
                  <a href="{{url('Manage-Brand')}}" class="@if(request()->path() === 'Manage-Brand'){{'text-info'}}@else @endif">Manage Brand</a>

                </li>
              </ul>
            </li>

            <li class="sub-menu">
              <a href="javascript:;" class="@if(request()->path() === 'Product' || request()->path() === 'Manage-Product' || request()->path() === 'ViewAllProduct'){{'active'}}@else @endif">
                <i class="icon-grid text-danger"></i>
                <span>Product Information</span>
              </a>
              <ul class="sub">
                <li>
                  <a href="{{url('Product')}}" class="@if(request()->path() === 'Product'){{'text-danger'}}@else @endif">Product Add</a>
                </li>
                <li>
                  <a href="{{url('Manage-Product')}}" class="@if(request()->path() === 'Manage-Product'){{'text-danger'}}@else @endif">Manage Product</a>
                </li>
                <li>
                  <a href="{{url('ViewAllProduct')}}" class="@if(request()->path() === 'ViewAllProduct'){{'text-danger'}}@else @endif" target="_blank">View All Product</a>
                </li>
              </ul>
            </li>

            <li class="sub-menu">
              <a  href="javascript:;" class="@if(request()->path() === 'All-Order-Info' || request()->path() === 'Pending-Order' || request()->path() === 'Processing-Order' || request()->path() === 'Shipping-Order' || request()->path() === 'Complete-Order' || request()->path() === 'Order-Report'){{'active'}}@else @endif">
                <i class="icon-grid text-success"></i>
                <span>Order Infomation</span>
              </a>
              <ul class="sub">
                <li>
                  <a href="{{url('All-Order-Info')}}" class="@if(request()->path() === 'All-Order-Info'){{'text-success'}}@else @endif">All Order Infomation</a>
                </li>
                <li>
                  <a href="{{url('Pending-Order')}}" class="@if(request()->path() === 'Pending-Order'){{'text-success'}}@else @endif">Pending Order</a>
                </li>
                <li>
                  <a href="{{url('Processing-Order')}}" class="@if(request()->path() === 'Processing-Order'){{'text-success'}}@else @endif">Processing Order</a>
                </li>
                <li>
                  <a href="{{url('Shipping-Order')}}" class="@if(request()->path() === 'Shipping-Order'){{'text-success'}}@else @endif">Shipping Order</a>
                </li>
                <li>
                  <a href="{{url('Complete-Order')}}" class="@if(request()->path() === 'Complete-Order'){{'text-success'}}@else @endif">Completd Order</a>
                </li>
                <li>
                  <a href="{{url('Order-Report')}}" class="@if(request()->path() === 'Order-Report'){{'text-success'}}@else @endif">Monthly Order Report</a>
                </li>
              </ul>
            </li>

            <li class="sub-menu">
              <a href="javascript:;" class="@if(request()->path() === 'Slider' || request()->path() === 'Manage-Slider' || request()->path() === 'Settings' || request()->path() === 'About' || request()->path() === 'Contact' || request()->path() === 'Privacypolicy' || request()->path() === 'Termcondition' || request()->path() === 'Howtobuy' || request()->path() === 'FAQ' || request()->path() === 'Manage-FAQ'){{'active'}}@else @endif">
                <i class="icon-grid text-primary"></i>
                <span>Website Setting</span>
              </a>
              <ul class="sub">
                <li>
                  <a href="{{url('Slider')}}" class="@if(request()->path() === 'Slider'){{'text-primary'}}@else @endif">Slider</a>
                </li>
                <li>
                  <a href="{{url('Manage-Slider')}}" class="@if(request()->path() === 'Manage-Slider'){{'text-primary'}}@else @endif">Manage Slider</a>
                </li>
                <li>
                  <a href="{{url('Settings')}}" class="@if(request()->path() === 'Settings'){{'text-primary'}}@else @endif">Setting</a>
                </li>
                <li>
                  <a href="{{url('About')}}" class="@if(request()->path() === 'About'){{'text-primary'}}@else @endif">About</a>
                </li>
                <li>
                  <a href="{{url('Contact')}}" class="@if(request()->path() === 'Contact'){{'text-primary'}}@else @endif">Contact</a>
                </li>
                <li>
                  <a href="{{url('Privacypolicy')}}" class="@if(request()->path() === 'Privacypolicy'){{'text-primary'}}@else @endif">Privacy & Policy</a>
                </li>
                <li>
                  <a href="{{url('Termcondition')}}" class="@if(request()->path() === 'Termcondition'){{'text-primary'}}@else @endif">Term & Condition</a>
                </li>
                <li>
                  <a href="{{url('Howtobuy')}}" class="@if(request()->path() === 'Howtobuy'){{'text-primary'}}@else @endif">How To Buy</a>
                </li>
                <li>
                  <a href="{{url('FAQ')}}" class="@if(request()->path() === 'FAQ'){{'text-primary'}}@else @endif">FAQ</a>
                </li>
                <li>
                  <a href="{{url('Manage-FAQ')}}" class="@if(request()->path() === 'Manage-FAQ'){{'text-primary'}}@else @endif">Manage FAQ</a>
                </li>
              </ul>
            </li>

            <li class="sub-menu">
              <a href="javascript:;" class="@if(request()->path() === 'Customer-Message'){{'active'}}@else @endif">
                <i class="icon-grid text-info"></i>
                <span>Customer Message</span>
              </a>
              <ul class="sub">
                <li>
                  <a href="{{url('Customer-Message')}}" class="@if(request()->path() === 'Customer-Message'){{'text-info'}}@else @endif">Customer Message</a>
                </li>
              </ul>
            </li>        
          </li>
        </nav>
      </div>


      @yield('content')


      <!--left sidebar end-->
    </div>
    <!--===========footer start===========-->
    <footer class="app-footer">
      <div class="container-fluid">
         <div class="text-center">
          <span>
           <?php echo date("Y"); ?> © Copyright Develop By <a href="https://www.facebook.com/Bidhan716/">Bidhan Nath</a>
         </span>
       </div>
     </div>
   </div>
 </footer>
 <!--===========footer end===========-->

 <!-- Placed js at the end of the page so the pages load faster -->
 <script src="{{ asset('public/backend')}}/assets/js/scripts.js"></script>
 <script src="{{ asset('public/backend')}}/assets/vendor/jquery/jquery.min.js"></script>
 <script src="{{ asset('public/backend')}}/assets/vendor/jquery-ui-1.12.1/jquery-ui.min.js"></script>
 <script src="{{ asset('public/backend')}}/assets/vendor/popper.min.js"></script>
 <script src="{{ asset('public/backend')}}/assets/vendor/bootstrap/js/bootstrap.min.js"></script>
 <script src="{{ asset('public/backend')}}/assets/vendor/jquery-ui-touch/jquery.ui.touch-punch-improved.js"></script>
 <script class="include" type="text/javascript" src="{{ asset('public/backend')}}/assets/vendor/jquery.dcjqaccordion.2.7.js"></script>
 <script src="{{ asset('public/backend')}}/assets/vendor/lobicard/js/lobicard.js"></script>
 <script src="{{ asset('public/backend')}}/assets/vendor/jquery.scrollTo.min.js"></script>

 <!--datatables-->
 <script src="{{ asset('public/backend')}}/assets/vendor/data-tables/jquery.dataTables.min.js"></script>
 <script src="{{ asset('public/backend')}}/assets/vendor/data-tables/dataTables.bootstrap4.min.js"></script>
 <!--chartjs-->
<script src="{{ asset('public/backend')}}/assets/vendor/chartjs/Chart.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>


 <script>
  $(document).ready(function() {
    $('#bs4-table').DataTable();
  } );
</script>

<!--uikit-->
<script src="https://cdn.jsdelivr.net/npm/uikit@3.11.1/dist/js/uikit.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/uikit@3.11.1/dist/js/uikit-icons.min.js"></script>

<!--tostar-->
<script>
  @if (Session::has('messege'))

  var type="{{ Session::get('alert-type', 'info') }}"

  switch(type){

    case 'info':
    toastr.options.positionClass = 'toast-top-right';
    toastr.info("{{ Session::get('messege') }}");

    break;

    case 'success':
    toastr.options.positionClass = 'toast-top-right';
    toastr.success("{{ Session::get('messege') }}");

    break;

    case 'warning':
    toastr.options.positionClass = 'toast-top-right';
    toastr.warning("{{ Session::get('messege') }}");

    break;

    case 'error':
    toastr.options.positionClass = 'toast-top-right';
    toastr.error("{{ Session::get('messege') }}");

    break;

  }

  @endif

</script>

<!--summernote-->
<script src="{{ asset('public/backend')}}/assets/vendor/summernote/summernote-bs4.min.js"></script>
<script>
  $(document).ready(function() {
    $('.summernote').summernote({
  height: 100,                 // set editor height
  minHeight: null,             // set minimum height of editor
  maxHeight: null,             // set maximum height of editor
  focus: true                  // set focus to editable area after initializing summernote
});
  });
</script>              

<script>
  $(document).ready(function() {
    $('.summernotes').summernote({
  height: 100,                 // set editor height
  minHeight: null,             // set minimum height of editor
  maxHeight: null,             // set maximum height of editor
  focus: true                  // set focus to editable area after initializing summernote
});
  });
</script>              

<script>
  $(document).ready(function() {
    $('#summernoteabout').summernote({
  height: 300,                 // set editor height
  minHeight: null,             // set minimum height of editor
  maxHeight: null,             // set maximum height of editor
  focus: true                  // set focus to editable area after initializing summernote
});
  });
</script>              


<!--select2-->
<script src="{{ asset('public/backend')}}/assets/vendor/select2/js/select2.min.js"></script>
<script src="{{ asset('public/backend')}}/assets/vendor/select2-init.js"></script>

<script>
  $(document).ready(function() {
    $('#table').DataTable();
  } );
</script>

<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js
"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js
"></script>
<script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.colVis.min.js"></script>
"></script>
<script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.flash.min.js"></script>
<script type="text/javascript">
  $(document).ready(function() {
    $('#example').DataTable( {
     responsive: true,
     "order": [[ 0, "desc" ]],
     "lengthMenu": [[10, 5, 15, 25, 50, -1], [10,5,15, 25, 50, "All"]],
     dom: 'Bfrtip',
     buttons: [
     {
      extend: 'copyHtml5',
      exportOptions: {
        columns: [ 0, ':visible' ]
      }
    },
    {
      extend: 'excelHtml5',
      exportOptions: {
        columns: ':visible'
      }
    },
    {
      extend: 'pdf',
      exportOptions: {
        columns: ':visible'
      }
    },
    {
      extend: 'print',
      exportOptions: {
       columns: ':visible'
     }
   },
   'colvis','pageLength'
   ]
 } );
  } );
</script>

</body>


</html>

