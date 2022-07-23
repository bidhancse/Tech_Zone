@extends('backend.index')
@section('content')


<!--main contents start-->
<main class="main-content">
  <div class="page-title">

  </div>

  <div class="container-fluid">

    <div class="row">
      <div class="col-lg-12">
        <div class="card card-shadow mb-4">
          <div class="card-header">
            <div class="row">
              <div class="col-lg-8 col-8">
                <div class="card-title mt-2">
                  Insert Brand Information
                </div>
              </div>

              <div class="col-lg-4 col-4">
                <a href="{{url('Manage-Brand')}}"  class="btn btn-primary text-white btn-sm float-right " style=" border-radius: 0px;">Manage Brand</a>
              </div>

            </div>

          </div>
          <div class="card-body">
            <form method="POST" class="btn-submit" enctype="multipart/form-data">

              <div class="row">
                <div class="col-lg-6">
                  <div class="form-group">
                    <label>Brand Name</label> <label class="text-danger">(Must be English **)</label>
                    <input type="text" class="form-control" id="brand_name" placeholder="Enter Brand Name" name="brand_name" required>
                  </div>
                </div>
              

              <div class="col-lg-6">
                <div class="form-group">
                  <label>Status</label>
                  <select class="form-control" name="status" id="status" required>
                    <option value="1">Active</option>
                    <option value="0">Inactive</option>
                  </select>
                </div>
              </div>
              </div>


              <div class="row">
                <div class="col-lg-12">
                  <div class="form-group">
                    <label>Picture</label>
                    <input type="file" class="form-control" id="image" name="image">
                  </div>
                </div>
              </div>


              <div class="form-group row">
                <div class="col-sm-9 mt-2">
                  <button type="submit" class="btn btn-info btn-sm" style=" border-radius: 0px;">Submit</button>
                  <button type="reset" class="btn btn-warning btn-sm" style=" border-radius: 0px;">Refresh</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

  </div>

</main>
<!--main contents end-->


{{-- Insert --}}
<script type="text/javascript">
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  $(".btn-submit").submit(function(e){
    e.preventDefault();

    $.ajax({
      headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
      url:"{{ url('insertbrand') }}",
      method:"POST",
      data:new FormData(this),
      dataType:'JSON',
      contentType: false,
      cache: false,
      processData: false,

      success:function(data)
      {
        alert("Hello")

      },error: function(data) {

        UIkit.notification({
          message: 'Data Insert Done',
          pos:     'top-right',
          status:  'success',
          timeout:  2000
        });

        $('#brand_name').val('');
        $('#status').val('');
        $('#image').val('');

      }
    })

  });

</script>



@endsection