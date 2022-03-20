<div class="modal-header">
    <h5 class="modal-title" id="example-Modal3">Add Coupon</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
    <form id="addForm" class="addForm" method="POST" enctype="multipart/form-data" action="{{route('reference.store')}}">
        @csrf
        <div class="form-group">
            <label for="ticket_num" class="form-control-label">Sale Number</label>
            <input type="text" required class="form-control" name="ticket_num" id="ticket_num" value="{{$random}}">
        </div>

        <div class="form-group">
            <label for="client_name" class="form-control-label">Corporation Name</label>
            <input type="text" required class="form-control" name="client_name" id="client_name">
        </div>

        <div class="form-group">
            <label for="paid_amount" class="form-control-label">Paid Amount</label>
            <input type="number" required min="0" class="form-control" name="paid_amount" id="paid_amount">
        </div>

        <div class="form-group">
            <label for="note" class="form-control-label">Note</label>
            <textarea rows="3" type="text" class="form-control" name="note" id="note" required></textarea>
        </div>

        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" id="addButton">Create</button>
        </div>
    </form>
</div>

