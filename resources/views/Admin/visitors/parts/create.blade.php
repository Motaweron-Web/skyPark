<div class="modal-header">
    <h5 class="modal-title" id="example-Modal3">New Visitor Type</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
    <form id="addForm" class="addForm" method="POST" enctype="multipart/form-data" action="{{route('visitors.store')}}">
        @csrf
        <div class="form-group">
            <label for="photo" class="form-control-label">Photo</label>
            <input type="file" required class="dropify" name="photo"
                   accept="image/png, image/gif, image/jpeg,image/jpg"/>
            <span class="form-text text-danger text-center">accept only png, gif, jpeg, jpg</span>
        </div>

        <div class="form-group">
            <label for="title" class="form-control-label">Title</label>
            <input type="text" required class="form-control" name="title">
        </div>

        @foreach($shifts as $shift)
            <div class="form-group">
                <label for="{{$shift->id}}" class="form-control-label">Price
                    From {{date('h:i A', strtotime($shift->from))}} To {{date('h:i A', strtotime($shift->to))}}</label>
                <input required type="number" min="1" class="form-control" name="price[]">
                <input type="hidden" name="shifts_id[]" value="{{$shift->id}}">
            </div>
        @endforeach

        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" id="addButton">Create</button>
        </div>
    </form>
</div>

<script>
    $('.dropify').dropify()
</script>
