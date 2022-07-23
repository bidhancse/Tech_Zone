
<form method="POST" class="btn-submit">

  @csrf

  <input type="hidden" name="" id="id" value="{{ $Data->id }}">

  <div class="form-row">

   <div class="form-group col-md-12">
    <label>Question</label>
    <input type="text" class="form-control input" placeholder="Enter Question..." name="question"  id="question"  value="{{ $Data->question }}">
  </div>

  <div class="form-group col-md-12">
    <label>Details</label>
    <textarea id="details" class="form-control" name="details" rows="5" style="border-radius: 0px; outline: none;">{{ $Data->details }}</textarea>
   </select>
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
    var data = $(this).serialize();
    $.ajax({
      url:'{{ url('updatefaq') }}/'+id,
      method:'POST',
      data:data,
      success:function(response){
        UIkit.notification({
          message: 'Data Update Done',
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