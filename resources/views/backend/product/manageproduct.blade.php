@extends('backend.index')
@section('content')

<!--main contents start-->
<main class="main-content" style="overflow: hidden;">
  <div class="page-title"></div>
  <div class="container-fluid">
    <div class="row">
      <div class=" col-sm-12">
        <div class="card card-shadow mb-4">
          <div class="card-header">
            <div class="row">
              <div class="col-lg-8 col-8">
                <div class="card-title mt-2">
                  Manage Product Information
                </div>
              </div>
              <div class="col-lg-4 col-4">
                <a href="{{url('Product')}}"  class="btn btn-primary text-white btn-sm float-right " style=" border-radius: 0px;">Product Insert</a>
              </div>
            </div>
          </div>
        </div>
        <div class="card-body bg-white" style="margin-top: -25px;">
          <table id="example" class="display nowrap table table-bordered table-striped" cellspacing="0" style="width: 100%;">
            <thead>
              <tr>
                <th>Sl.</th>
                <th>Product Code</th>
                <th>Item Name</th>
                <th>Brand Name</th>
                <th>Sale Price</th>
                <th>Picture</th>
                <th>Stock Status</th>
                <th>Status</th>                  
                <th>Action</th>
              </tr>
            </thead>
            <tbody>

              @php
              $i=1;
              @endphp

              @foreach($Data as $DataShow)

              <tr id="tr{{ $DataShow->id }}">
                <td>{{ $i++ }}</td>
                <td>{{ $DataShow->product_code }}</td>
                <td>{{ $DataShow->item_name }}</td>
                <td>{{ $DataShow->brand_name }}</td>
                <td>{{ $DataShow->sale_price }}</td>

                <td>
                  @if(isset($DataShow->image))
                  <img src="{{url($DataShow->image)}}" class="zoom" style="max-height: 50px;">
                  @else
                  <img src="{{url('public/image/productimage')}}/1.jpg" class="zoom" style="max-height:50px;">
                  @endif
                </td>

                <td>

                  <input data-id="{{$DataShow->id}}" class="toggle-class" type="checkbox" data-onstyle="success"data-offstyle="danger" data-toggle="toggle" data-on="Stock In" data-off="Stock Out" {{ $DataShow->stock_status ? 'checked' : '' }}>
                </td>

                <td>

                  <input data-id="{{$DataShow->id}}" class="productstatus" type="checkbox" data-onstyle="success"data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="Inactive" {{ $DataShow->status ? 'checked' : '' }}>

                </td>                 

                <td>

                  <span class="btn btn-info btn-sm edit"  data-toggle="modal" data-target=".bd-example-modal-lg" data-id="{{ $DataShow->id }}" style="padding-left: 10px; padding-right: 10px;"><i class="fa fa-edit"></i></span>

                  <span class="btn btn-danger btn-sm delete"  data-id="{{ $DataShow->id }}" onclick="return confirm('Are You sure ?')" style="padding-left: 10px; padding-right: 10px;"><i class="fa fa-trash"></i></span>

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
<!-- state end-->
</div>
</main>


{{-- Model --}}

<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Update Product Information</h5>
            <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
            </button>
        </div>
        <div class="modal-body"></div>
    
    </div>
  </div>                                     
</div>


{{--  Change Stock Status --}}
<script>

  $('.toggle-class').change(function () {
    var stock_status = $(this).prop('checked') == true ? '1' : '0';
    var id = $(this).data('id');
    console.log(id);
    console.log(stock_status);

    $.ajax({
      type: "get",
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      url: "{{ url('StockStatus') }}/"+id,
      data: {
        stock_status: stock_status, 
        id: id
      },
      success: function () {
        UIkit.notification({
          message: 'Stock Status Change Done',
          status: 'danger',
          pos: 'top-right',
          timeout: 2000
        });
      }
    });
  });
</script>


{{--  Change Status --}}
<script>

  $('.productstatus').change(function () {
    var status = $(this).prop('checked') == true ? '1' : '0';
    var id = $(this).data('id');
    console.log(id);
    console.log(status);

    $.ajax({
      type: "get",
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      url: "{{ url('ProductStatus') }}/"+id,
      data: {
        status: status, 
        id: id
      },
      success: function () {
        UIkit.notification({
          message: 'Status Change Done',
          status: 'danger',
          pos: 'top-right',
          timeout: 2000
        });
      }
    });
  });
</script>


{{-- Delete --}}
<script>
  $(".delete").click(function(){
    var id = $(this).data("id");

    $.ajax(
    {
      url: "{{ url('deleteproduct') }}/"+id,
      type: 'get',
      success: function ()
      {
        $('#tr'+id).hide();

        UIkit.notification({
          message: 'Data Delete Successfully Done',
          status: 'danger',
          pos: 'top-right',
          timeout: 2000
        });
      }
    });

  });
</script>


{{-- Edit --}}
<script>
  $(".edit").click(function(){
    var id = $(this).data("id");
    $.ajax(
    {
      url: "{{ url('editproduct') }}/"+id,
      type: 'get',
      data:{},
      success: function (data)
      {
        $('.modal-body').html(data);
      }
    });

  });
</script>


@endsection