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
                  Insert FAQ Information
                </div>
              </div>
              <div class="col-lg-4 col-4">
                <a href="{{url('Manage-FAQ')}}"  class="btn btn-primary text-white btn-sm float-right " style=" border-radius: 0px;">Manage FAQ</a>
              </div>
            </div>
          </div>

          <div class="card-body">
            <form method="POST" class="btn-submit">
              @csrf
              <div class="form-group">
                <label>Question</label> 
                <input type="text" class="form-control" id="question" placeholder="Enter Question" name="question">
              </div>

              <div class="row">
                <div class="col-lg-12">
                  <div class="form-group">
                    <label>Details</label>
                    <textarea id="details" class="form-control summernotes" name="details"></textarea>
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


<script type="text/javascript">

  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  $(".btn-submit").submit(function(e){
    e.preventDefault();

    var data = $(this).serialize();

    $.ajax({
      url:'{{ url('insertfaq') }}',
      method:'POST',
      data:data,
      success:function(response){
        UIkit.notification({
          message: 'FAQ Insert Done',
          status: 'dark',
          pos: 'top-right',
          timeout: 2000
        });

        $("#question").val('');
        $("#details").val('');
      },

      error:function(error){
        console.log(error);
      }
    });
  });

</script>



@endsection