<div class="modal-header">
    <h5 class="modal-title" id="example-Modal3">Edit Visitor</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
    <form id="updateForm" method="POST" enctype="multipart/form-data" action="{{route('visitors.update',$visitor->id)}}" >
    @csrf
        @method('PUT')
        <input type="hidden" name="id" value="{{$visitor->id}}">
        <div class="form-group">
            <label for="photo" class="form-control-label">Photo</label>
            <input type="file" class="dropify" name="photo"
                   accept="image/png, image/gif, image/jpeg,image/jpg"
                   data-default-file="{{get_user_photo($visitor->photo)}}"/>
            <span class="form-text text-danger text-center">accept only png, gif, jpeg, jpg</span>
        </div>

        <div class="form-group">
            <label for="title" class="form-control-label">Title</label>
            <input type="text" required class="form-control" name="title" value="{{$visitor->title}}">
        </div>

        @foreach($details as $detail)
            <div class="form-group">
                <label for="{{$detail->id}}" class="form-control-label">Price
                    From {{date('h:i A', strtotime($detail->shifts->from))}} To {{date('h:i A', strtotime($detail->shifts->to))}}</label>
                <input required type="number" min="1" class="form-control" name="price[]" value="{{$detail->price}}">
                <input type="hidden" name="details_id[]" value="{{$detail->id}}">
            </div>
        @endforeach

        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-success" id="updateButton">Update</button>
        </div>
    </form>
</div>
<script>
    $('.dropify').dropify()
</script>
