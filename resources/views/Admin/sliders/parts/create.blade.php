<div class="modal-header">
    <h5 class="modal-title" id="example-Modal3">Add Slider</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
    <form id="addForm" class="addForm" method="POST" enctype="multipart/form-data" action="{{route('sliders.store')}}">
        @csrf
        <div class="form-group">
            <label for="photo" class="form-control-label">Photo</label>
            <input type="file" class="dropify" name="photo" accept="image/png, image/gif, image/jpeg,image/jpg"/>
            <span class="form-text text-danger text-center">accept only png, gif, jpeg, jpg</span>
        </div>

        <div class="form-group">
            <label for="title" class="form-control-label">Main Title</label>
            <input type="text" class="form-control" name="title">
        </div>

        <div class="form-group">
            <label for="sub_title" class="form-control-label">Sub Title</label>
            <input type="text" class="form-control" name="sub_title">
        </div>

        <div class="form-group">
            <label for="button_text" class="form-control-label">Button Text</label>
            <input type="text" class="form-control" name="button_text">
        </div>

        <div class="form-group">
            <label for="button_link" class="form-control-label">Button Link</label>
            <input type="text" class="form-control" name="button_link">
        </div>

        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" id="addButton">Create</button>
        </div>
    </form>
</div>

<script>
    $('.dropify').dropify()
</script>
