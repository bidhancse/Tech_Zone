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
                  Update Setting Information
                </div>
              </div>
            </div>
          </div>

          <div class="card-body">
            <form method="POST" class="btn-submit" enctype="multipart/form-data">
              @csrf
              <input type="hidden" name="" id="id" value="{{ $Data->id }}">
              <div class="row">
                <div class="col-lg-6">
                  <div class="form-group">
                    <label>Title</label>
                    <input type="text" class="form-control" placeholder="Enter Title" name="title" value="{{$Data->title}}">
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="form-group">
                    <label>Email</label>
                    <input type="text" class="form-control" placeholder="Enter Email" name="email" value="{{$Data->email}}">
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-lg-6">
                  <div class="form-group">
                    <label>phone</label>
                    <input type="number" class="form-control" placeholder="Enter phone" name="phone" value="{{$Data->phone}}">
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="form-group">
                    <label>Facebook Url</label>
                    <input type="text" class="form-control" placeholder="Enter Facebook Url" name="facebook" value="{{$Data->facebook}}">
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-lg-4">
                  <div class="form-group">
                    <label>Instagram Url</label>
                    <input type="text" class="form-control" placeholder="Enter Instagram Url" name="instagram" value="{{$Data->instagram}}">
                  </div>
                </div>
                <div class="col-lg-4">
                  <div class="form-group">
                    <label>Twitter Url</label>
                    <input type="text" class="form-control" placeholder="Enter Twitter Url" name="twitter" value="{{$Data->twitter}}">
                  </div>
                </div>
                <div class="col-lg-4">
                  <div class="form-group">
                    <label>Youtube Url</label>
                    <input type="text" class="form-control" placeholder="Enter Youtube Url" name="youtube" value="{{$Data->youtube}}">
                  </div>
                </div>
              </div>


              <div class="row">
                <div class="col-lg-6">
                  <div class="form-group">
                    <label>Favicon</label>
                    <input type="file" class="form-control" name="favicon">
                    @if(isset($Data->favicon))
                    <img src="{{ url($Data->favicon) }}" style="max-height: 50px; outline: none;">
                    @endif
                    <input type="hidden" value="{{ $Data->image }}">
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="form-group">
                    <label>Picture</label>
                    <input type="file" class="form-control" name="image">
                    @if(isset($Data->image))
                    <img src="{{ url($Data->image) }}" style="max-height: 50px; outline: none;">
                    @endif
                    <input type="hidden" value="{{ $Data->image }}">
                  </div>
                </div>
              </div>


              <div class="form-group row">
                <div class="col-sm-9 mt-2">
                  <button type="submit" class="btn btn-info btn-sm" onclick="return confirm('Are You sure ?')" style=" border-radius: 0px; outline: none;">Update</button>
                  <button type="reset" class="btn btn-warning btn-sm" style=" border-radius: 0px; outline: none;">Refresh</button>
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

    $.ajax({
     headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
     url:"{{ url('updatesettings') }}/"+id,
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
        message: 'Data Update Successfully Done',
        pos:     'top-right',
        status: 'success',
        timeout:  2000
      });

      window.location="";
    },
  });
  });

</script>



@endsection