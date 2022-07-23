@extends('backend.index')
@section('content')

<!--main contents start-->
<main class="main-content">
  <div class="page-title"></div>
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12">
        <div class="card card-shadow mb-4">
          <div class="card-header">
            <div class="row">
              <div class="col-lg-8 col-8">
                <div class="card-title mt-2">
            Manage Item Information
          </div>
        </div>

        <div class="col-lg-4 col-4">
          <a  href="{{url('Item')}}"  class="btn btn-dark text-white btn-sm float-right " style=" border-radius: 0px;">Item Insert</a>
        </div>

      </div>
    </div>
    <div class="card-body" style="overflow-x:auto;">
      <table id="example" class="table table-bordered table-striped text-center" cellspacing="0">
       <thead>
        <tr>
         <th>Show Sl.</th>
         <th>Item Id</th>
         <th>Item Name</th>
         <th>Status</th>
         <th>Picture</th>
         <th>Action</th>
       </tr>
     </thead>
     <tbody>

      @php
      $i = 1;
      @endphp

      @foreach($Item as $ItemShow)
      <tr id="tr{{ $ItemShow->id }}">
        <td>{{ $i++ }}</td>
        <td>{{ $ItemShow->id }}</td>
        <td>{{ $ItemShow->item_name }}</td>

        <td>
          <input data-id="{{$ItemShow->id}}" class="toggle-class" type="checkbox" data-onstyle="success"data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="Inactive" {{ $ItemShow->status ? 'checked' : '' }}>
        </td>

        <td>
          @if(isset($ItemShow->image))
          <img src="{{url($ItemShow->image)}}" style="max-height:50px;" class="zoom">
          @else
          <img src="{{url('public/image/itemimage')}}/1.jpg" class="zoom" style="max-height:50px;">
          @endif
        </td>

        <td>
          <span class="btn btn-info btn-sm edit"  data-toggle="modal" data-target=".bd-example-modal-lg" data-id="{{ $ItemShow->id }}" style="padding-left: 10px; padding-right: 10px;"><i class="fa fa-edit"></i></span>
          <span class="btn btn-danger btn-sm delete"  data-id="{{ $ItemShow->id }}" onclick="return confirm('Are You sure ?')" style="padding-left: 10px; padding-right: 10px;"><i class="fa fa-trash"></i></span>
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

{{-- Model --}}

<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title">Update Item Information</h3>
        <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
        </button>
      </div>
      <div class="modal-body">

      </div>
    </div>
  </div>
</div>


{{--  Change Status --}}
<script>

  $('.toggle-class').change(function () {
    var status = $(this).prop('checked') == true ? '1' : '0';
    var id = $(this).data('id');
    console.log(id);
    console.log(status);

    $.ajax({
      type: "get",
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      url: "{{ url('changeStatus') }}/"+id,
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
      url: "{{ url('deleteitem') }}/"+id,
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
      url: "{{ url('edititem') }}/"+id,
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