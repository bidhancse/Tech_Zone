@extends('backend.index')
@section('content')

<style>
  .orderstatus {
    color: #f1f1f1;
    padding: 3px 12px;
    border-radius: 30px;
    font-size: 13px;
  }

  .orderstatus1 {
    color: #f1f1f1;
    padding: 3px 12px;
    border-radius: 30px;
    font-size: 13px;
  }

  .orderstatus2 {
    color: #f1f1f1;
    padding: 3px 12px;
    border-radius: 30px;
    font-size: 13px;
  }

  .orderstatus3 {
    color: #f1f1f1;
    padding: 3px 12px;
    border-radius: 30px;
    font-size: 13px;
  }
</style>
<!--main contents start-->
<main class="main-content">
 <div class="page-title"></div>
 <div class="container-fluid">
  <div class="row">
   <div class=" col-sm-12">
    <div class="card card-shadow mb-4">
     <div class="card-header">
      <div class="row">
        <div class="col-lg-4 col-12">
          <div class="card-title mt-2">
            Monthly Order Report
          </div>
        </div>
      </div>
    </div>

    <div class="card-body" style="overflow-x:auto;">
      <form method="POST" action="{{ url('Order-Report-Showing')}}" enctype="multipart/form-data">
        @csrf
        <div class="row container-fluid">
          <div class="col-lg-6">
           <div class="form-group">
            <label>Monthly Report From : </label>
            <div class="input-group">

              @php
              $date = date('d-m-y');
              @endphp

              <input type="date" required name="fromdate" max="{{$date}}" class="form-control">

            </div>
          </div>
        </div>

        <div class="col-lg-6">
          <div class="form-group">
            <label>Monthly Report To : </label>
            <div class="input-group">

              <input type="date" required name="todate" max="{{$date}}" class="form-control">

            </div>
          </div>
        </div>
      </div>
      <br>
      <center> 
        <button type="submit" class="btn btn-dark" style="border-radius: 0px;">Find Us</button>
      </center>
    </form>
  </div>
</div>
</div>
</div>
</div>
</main>


@endsection


