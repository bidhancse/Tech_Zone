@extends('backend.index')
@section('content')

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
                  Manage FAQ
                </div>
              </div>
              <div class="col-lg-4 col-4">
                <a href="{{url('FAQ')}}"  class="btn btn-primary text-white btn-sm float-right " style=" border-radius: 0px;">Insert FAQ</a>
              </div>
            </div>
          </div>
          <div class="card-body" style="overflow-x:auto;">
            <table id="bs4-table" class="table table-bordered table-striped " cellspacing="0">
              <thead>
                <tr>
                  <th>Sl.</th>
                  <th>Question</th>
                  <th>Details</th>
                  <th><center>Action</center></th>
                </tr>
              </thead>
              <tbody>

                @php
                $i = 1;
                @endphp

                @foreach($Data as $DataShow)

                <tr id="tr{{ $DataShow->id }}">
                  <td>{{ $i++}}</td>
                  <td>{{ $DataShow->question }}</td>
                  <td>{!! $DataShow->details !!}</td>
                  <td>
                    <center>
                      <span class="btn btn-info btn-sm edit"  data-toggle="modal" data-target=".bd-example-modal-lg" data-id="{{ $DataShow->id }}" style="padding-left: 10px; padding-right: 10px;"><i class="fa fa-edit"></i></span>

                      <span class="btn btn-danger btn-sm delete"  data-id="{{ $DataShow->id }}" onclick="return confirm('Are You sure ?')" style="padding-left: 10px; padding-right: 10px;"><i class="fa fa-trash"></i></span>
                    </center>
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
                <h3 class="modal-title">Update FAQ Information</h3>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <div class="modal-body">

            </div>
        </div>
    </div>
</div>


{{-- Delete --}}
<script>
  $(".delete").click(function(){
    var id = $(this).data("id");

    $.ajax(
    {
      url: "{{ url('deletefaq') }}/"+id,
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
      url: "{{ url('editfaq') }}/"+id,
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