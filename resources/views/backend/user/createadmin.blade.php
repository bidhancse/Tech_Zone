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
                  Create Admin 
                </div>
              </div>

              <div class="col-lg-4 col-4">
                <a href="{{url('Manage-Admin')}}"  class="btn btn-primary text-white btn-sm float-right " style=" border-radius: 0px;">Manage Admin</a>
              </div>
            </div>
          </div>
          <div class="card-body">
            <form method="POST" class="btn-submit" enctype="multipart/form-data">
              <div class="row">
                <div class="col-lg-6">
                  <div class="form-group">
                    <label>Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name" required>
                  </div>
                </div>

                <div class="col-lg-6">
                  <div class="form-group">
                    <label>Email</label> <label class="text-danger">(Must be English **)</label>
                    <input type="text" class="form-control" id="email" name="email" placeholder="Enter email" required>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-lg-6">
                  <div class="form-group">
                    <label>Phone</label> <label class="text-danger">(Must be English **)</label>
                    <input type="text" class="form-control" id="phone" name="phone" placeholder="Enter Phone" required>
                  </div>
                </div>

                <div class="col-lg-6">
                  <div class="form-group">
                    <label>Address</label>
                    <input type="text" class="form-control" id="address" name="address" placeholder="Enter Address" required >
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-lg-6">
                  <div class="form-group">
                    <label>Password</label> <label class="text-danger">(Must be English **)</label> 
                    <input type="password" class="form-control" id="password"  name="password" placeholder="Enter Password" required>
                  </div>
                </div>

                <div class="col-lg-6">
                  <div class="form-group">
                    <label>Confirm password</label> <label class="text-danger">(Must be English **)</label> 
                    <input type="password" class="form-control" id="confirmpassword" name="confirmpassword" id="txtConfirmPassword" placeholder="Enter Confirm password" required>
                    <span id='message'></span>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-lg-6">
                  <div class="form-group">
                    <label>Status</label>
                    <select class="form-control" name="status" required>
                      <option value="1">Active</option>
                      <option value="0">Inactive</option>
                    </select>
                  </div>
                </div>

                <div class="col-lg-6">
                  <div class="form-group">
                    <label>Picture</label>
                    <input id="image" type="file" class="form-control image" name="image">
                  </div>
                </div>
              </div>

              <div class="form-group row">
                <div class="col-sm-9 mt-2">
                  <button type="submit" class="btn btn-info btn-sm" id="btnSubmit" style=" border-radius: 0px;" onclick="return Validate()">Submit</button>
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

{{-- Password Match --}}
<script type="text/javascript">
  function Validate() {
    var password = document.getElementById("password").value;
    var confirmPassword = document.getElementById("txtConfirmPassword").value;
    if (password != confirmPassword) {
      alert("Passwords do not match.");
      return false;
    }
    return true;
  }
</script>


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
      url:"{{ url('insertadmin') }}",
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
          message: 'Admin Information Insert Done',
          pos:     'top-right',
          status: 'success',
          timeout:  2000
        });

        $('#name').val('');
        $('#email').val('');
        $('#phone').val('');
        $('#address').val('');
        $('#password').val('');
        $('#confirmpassword').val('');
        $('#image').val('');

      }
    })

  });
</script>

@endsection