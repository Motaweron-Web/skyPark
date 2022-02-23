<div class="modal-header">
    <h5 class="modal-title" id="example-Modal3">Add Product</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
    <form id="addForm" class="addForm" method="POST" enctype="multipart/form-data" action="{{route('product.store')}}">
        @csrf
        <div class="form-group">
            <label for="name" class="form-control-label">Title</label>
            <input type="text" class="form-control" name="title" id="title">
        </div>
        <div class="form-group ">
            <label class="form-label mt-0">Category</label>
            <select class="form-control" data-placeholder="Choose Category" name="category_id">
                @foreach($categories as $category)
                    <option value="{{$category->id}}">{{$category->title}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="name" class="form-control-label">Price</label>
            <input type="number" min="0" class="form-control" name="price" id="price">
        </div>
        <div class="form-group">
            Status
            <div class="material-switch pull-left mt-4">
                <input id="someSwitchOptionSuccess" name="status" type="checkbox" checked/>
                <label for="someSwitchOptionSuccess" class="label-success"></label>
            </div>
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

