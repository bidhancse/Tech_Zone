
<form method="POST" class="btn-submit">

  @csrf

  <input type="hidden" name="" id="id" value="{{ $Data->id }}">

  <div class="form-row">

   <div class="form-group col-md-6">
    <label>Item Name</label>
    <input type="text" class="form-control input" placeholder="Enter Item Name..." name="item_name"  id="item_name" value="{{ $Data->item_name }}">
  </div>

  <div class="form-group col-md-6">
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

 <div class="form-group col-md-12">
  <label>Picture</label>
  <input type="file" class="form-control" style="border-radius: 0px;" id="image" name="image">
  @if(isset($Data->image))
  <img id="blah" src="{{url($Data->image)}}" style="max-height: 80px; margin-top: 5px;" class="zoom">
  @else
  <img src="{{url('public/image/itemimage')}}/1.jpg" class="zoom" style="max-height:80px; margin-top: 5px;">
  @endif

  <input type="hidden" value="{{ $Data->image }}" name="old_image">
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
     url:"{{ url('updateitem') }}/"+id,
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