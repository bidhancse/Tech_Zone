
<form method="POST" class="btn-submit">
  @csrf

  <input type="hidden" name="" id="id" value="{{ $Data->id }}">

  <div class="row">
    <div class="col-lg-6">
      <div class="form-group">
        <label>Name</label>
        <input type="text" class="form-control" name="name" value="{{ $Data->name }}" placeholder="Enter Name">
      </div>
    </div>

    <div class="col-lg-6">
      <div class="form-group">
        <label>Email</label> <label class="text-danger">(Must be English **)</label>
        <input type="text" class="form-control" name="email" value="{{ $Data->email }}" placeholder="Enter email">
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-lg-6">
      <div class="form-group">
        <label>Phone</label> <label class="text-danger">(Must be English **)</label>
        <input type="text" class="form-control" name="phone" value="{{ $Data->phone }}" placeholder="Enter Phone">
      </div>
    </div>

    <div class="col-lg-6">
      <div class="form-group">
        <label>Address</label>
        <input type="text" class="form-control" name="address" value="{{ $Data->address }}" placeholder="Enter Address" >
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-lg-12">
      <div class="form-group">
        <label>Password</label> <label class="text-danger">(Must be English **)</label> 
        <input type="password" class="form-control" name="password" placeholder="Enter Password">
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-lg-6">
      <div class="form-group">
        <label>Status</label>
        <select class="form-control" id="status" name="status">
          <option  value="{{$Data->status}}">@if($Data->status == 1)Active @else Inactive @endif</option>
          @if($Data->status == 1)
          <option value="0">Inactive</option>
          @else
          <option value="1">Active</option>
          @endif
        </select>
      </div>
    </div>

    <div class="col-lg-6">
      <div class="form-group">
        <label>Picture</label>
        <input type="file" class="form-control" id="image" name="image">
        @if(isset($Data->image))
        <img id="blah" src="{{url($Data->image)}}" style="max-height: 80px; margin-top: 5px;" class="zoom">
        @else
        <img src="{{url('public/image/adminimage')}}/1.jpg" class="zoom" style="max-height:80px; margin-top: 5px;">
        @endif

        <input type="hidden" value="{{ $Data->image }}" name="old_image">
      </div>
    </div>
  </div>

  <div class="modal-footer">
    <button type="button" class="btn btn-danger light" data-dismiss="modal">Close</button>
    <button type="submit" class="btn btn-info">Update</button>
  </div>
</form>


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
     url:"{{ url('updateadmin') }}/"+id,
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