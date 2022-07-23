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
        <div class="col-lg-8 col-8">
          <div class="card-title mt-2">
            Completd Order Information
          </div>
        </div>
      </div>
    </div>
    <div class="card-body" style="overflow-x:auto;">
      <table id="example" class="table table-bordered table-striped text-center" cellspacing="0">
       <thead>
        <tr>
         <th>Invoice Id</th>
         <th>Order Date</th>
         <th>Bill To Name</th>
         <th>Phone</th>
         <th>Email</th>
         <th>Payment</th>
         <th>Status</th>
         <th>Action</th>
       </tr>
     </thead>
     <tbody>

      @foreach($CompletdOrder as $CompletdOrderShow)
      <tr>
        <td>
          <a href="{{ url('invoice/'.$CompletdOrderShow->id)}}" class="text-dark">{{ $CompletdOrderShow->id}}</a>
        </td>
        <td>
          {{ $CompletdOrderShow->order_date}}
        </td>
        <td>
          {{ $CompletdOrderShow->name}}
        </td>
        <td>
          {{ $CompletdOrderShow->phone}}
        </td>
        <td>
          {{ $CompletdOrderShow->email}}
        </td>
        <td>
          {{ $CompletdOrderShow->payment_method}}
        </td>
        <td>
          @if($CompletdOrderShow->status==0)
          <span class="orderstatus bg-dark">Pending</span>
          @elseif($CompletdOrderShow->status==1)
          <span class="orderstatus1 bg-primary">Processing</span>
          @elseif($CompletdOrderShow->status==2)
          <span class="orderstatus2 bg-success">Shipping</span>
          @elseif($CompletdOrderShow->status==3)
          <span class="orderstatus3 bg-info">Completd</span>
          @endif
        </td>
        <td>
          <form method="POST" class="btn-submit" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="" id="id" value="{{ $CompletdOrderShow->id }}">
            <select name="status" class="form-control w-75" style="float:left; clear:right; outline:none;">
              <option value="0">Pending</option>
              <option value="1">Processing</option>
              <option value="2">Shipping</option>
              <option value="3">Completd</option>
            </select>
            <button type="submit" style="float:right; border:0px; color:#FF5500; padding-top:5px;">
              <i class="fa fa-edit"></i>
            </button>
          </form>
        </td>
      </tr>

      @endforeach

    </tbody>
  </table>
</div>
</div>
</div>
</div>
</div>
</main>


{{-- Update --}}
<script type="text/javascript">

  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  $(".btn-submit").submit(function(e){
    e.preventDefault();
    var id = $('#id').val();
    var data = $(this).serialize();
    $.ajax({
      url:'{{ url('Update-Order-Status') }}/'+id,
      method:'POST',
      data:data,
      success:function(response){
        UIkit.notification({
          message: 'Order Status Change Done',
          status: 'dark',
          pos: 'top-right',
          timeout: 2000
        });
       
       window.location="";
      },
      error:function(error){
        console.log(error)
      }
    });
  });
</script>


@endsection