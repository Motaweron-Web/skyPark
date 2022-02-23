<div class="modal-header">
    <h5 class="modal-title" id="example-Modal3">Edit Admin</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
    <form id="updateForm" method="POST" enctype="multipart/form-data" action="{{route('admins.update',$admin->id)}}" >
    @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name" class="form-control-label">Photo</label>
            <input type="file" id="testDrop" class="dropify" name="photo" data-default-file="{{get_user_photo($admin->photo)}}"/>
        </div>
        <div class="form-group">
            <label for="name" class="form-control-label">Name</label>
            <input type="text" class="form-control" name="name" id="name" value="{{$admin->name}}">
        </div>
        <div class="form-group">
            <label for="email" class="form-control-label">Email</label>
            <input type="text" class="form-control" name="email" id="email" value="{{$admin->email}}">
        </div>
        <div class="form-group">
            <label for="password" class="form-control-label">Password</label>
            <input type="password" class="form-control" name="password" id="password" placeholder="********">
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-success" id="updateButton">Update</button>
        </div>
    </form>
</div>
<script>
    $('.dropify').dropify()
</script>
