<div class="modal-header">
    <h5 class="modal-title" id="example-Modal3">Add New</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
    <form id="addForm" class="addForm" method="POST" enctype="multipart/form-data" action="{{route('coupons.store')}}">
        @csrf
        <div class="row">
            <div class="col-12">
                <div class="form-group">
                    <label for="client_name" class="form-control-label">Corporation Name</label>
                    <input type="text" required class="form-control" name="client_name" id="client_name">
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="email" class="form-control-label">Email</label>
                    <input type="text" required class="form-control" name="email" id="email">
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="phone" class="form-control-label">Phone</label>
                    <input type="text" required class="form-control" name="phone" id="phone"
                           oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');">
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="paid_amount" class="form-control-label">Paid Amount</label>
                    <input type="number" required min="0" class="form-control" name="paid_amount" id="paid_amount">
                </div>
            </div>

            <div class="col-6">
                <div class="form-group">
                    <label for="hours_count" class="form-control-label">Reservation Duration (h)</label>
                    <input type="number" value="1" required min="1" max="24" onKeyUp="if(this.value>24){this.value='24';}else if(this.value<=0){this.value='1';}" class="form-control" name="hours_count" id="hours_count">
                </div>
            </div>

            <div class="col-6">
                <div class="form-group">
                    <label for="coupon_start" class="form-control-label">Coupon Start at</label>
                    <input type="date" required class="form-control" name="coupon_start" id="coupon_start"
                           value="{{date('Y-m-d')}}">
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="coupon_end" class="form-control-label">Coupon End at</label>
                    <input type="date" required class="form-control" name="coupon_end" id="coupon_end"
                           value="{{date('Y-m-d')}}">
                </div>
            </div>
            <div class="col-12">
                <div class="form-group">
                    <label for="visitor_count" class="form-control-label">Visitors Count</label>
                    <input type="number" required min="0" class="form-control" name="visitor_count" id="visitor_count">
{{--                    <p class="text-gray fs-5">Enter Number Of Tickets To Reserve Them</p>--}}
                </div>
            </div>


        </div>


        <div class="form-group">
            <label for="note" class="form-control-label">Note</label>
            <textarea rows="3" type="text" class="form-control" name="note" id="note"></textarea>
        </div>

        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" id="addButton">Create</button>
        </div>
    </form>
</div>

