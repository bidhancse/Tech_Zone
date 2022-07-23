
<form method="POST" class="btn-submit">

  @csrf

  <input type="hidden" name="" id="id" value="{{ $Data->id }}">

  <div class="form-row">

   <div class="form-group col-md-6">
    <label>Item Name</label>
    <select class="form-control" name="item_id" id="item_id" required>
      <option>Select Item</option>
      @foreach($Item as $ItemShow)
      <option value="{{$ItemShow->id}}" <?php if($Data->item_id == $ItemShow->id){ echo "selected";} ?>>{{$ItemShow->item_name}}</option>
      @endforeach
    </select>
  </div>

  <div class="form-group col-md-6">
    <label>Category Name</label> <label class="text-danger">(Must be English **)</label>
    <select class="form-control" id="category_id" name="category_id" required>
      @foreach($Category as $CategoryShow)

      <option value="{{$CategoryShow->id}}" <?php if($Data->category_id == $CategoryShow->id ){ echo "selected";} ?>>{{ $CategoryShow->category_name }}</option>

      @endforeach
    </select>
  </div>

  <div class="form-group col-md-12">
   <label>Subcategory Name</label><label class="text-danger">(Must be English **)</label>
   <input type="text" class="form-control" id="subcategory_name" placeholder="Enter Subcategory Name" name="subcategory_name" required="" value="{{ $Data->subcategory_name }}">
 </div>

 <div class="form-group col-md-6">
  <label>Status</label>
  <select class="form-control" name="status" id="status" required="" >
    <option value="{{$Data->status}}">@if($Data->status == 1)Active @else Inactive @endif</option>
    @if($Data->status == 1)
    <option value="0">Inactive</option>
    @else
    <option value="1">Active</option>
    @endif
  </select>
</div>

<div class="form-group col-md-6">
  <label>Picture</label>
  <input type="file" class="form-control" style="border-radius: 0px;" id="image" name="image">
  @if(isset($Data->image))
  <img id="blah" src="{{url($Data->image)}}" style="max-height: 80px; margin-top: 5px;" class="zoom">
  @else
  <img src="{{url('public/image/categoryimage')}}/1.jpg" class="zoom" style="max-height:80px; margin-top: 5px;">
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
     url:"{{ url('updatesubcategory') }}/"+id,
     method:"POST",
     data:new FormData(this),
     dataType:'JSON',
     contentType: false,
     cache: false,
     processData: false,

     success:function(data)
     {
      console.log(data);

    },error: function(data) {

      console.log("error occured");



    },
  });
  });

</script>