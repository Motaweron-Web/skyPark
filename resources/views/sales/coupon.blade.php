@extends('sales.layouts.master')
@section('page_title')
    {{$setting->title}} | Coupons
@endsection
@section('content')
    <h2 class="MainTiltle mb-5 ms-4"> Coupons </h2>
    <form class="card p-2 py-4 mt-3 ">

        <div class="d-flex justify-content-between align-items-center flex-wrap px-3 pb-3 border-bottom mb-3">
            <h6> Sky Park Coupons </h6>
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addCoupon">
                <i class="far fa-plus me-1"></i> Add New Coupon
            </button>
        </div>
        <!-- table -->
        <table class=" customDataTable table table-bordered nowrap" id="dataTable">
            <thead>
            <tr>
                <th>#</th>
                <th>Sale Number</th>
                <th>Corporation Name</th>
                <th>Phone</th>
                <th>Note</th>
                <th>Coupon Date</th>
                <th>Visitors</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>

            </tbody>
        </table>

    </form>

    <div class="modal fade" id="addCoupon" tabindex="-1" role="dialog" aria-labelledby="addCoupon" aria-hidden="true"
         data-bs-backdrop="static">
        <div class="modal-dialog modal-danger modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="modal-title-print">Add Coupon</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fal fa-times text-dark fs-4"></i>
                    </button>
                </div>
                <form action="#!">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-4 p-2">
                                <label class="form-label"> <i class="fas fa-building me-1"></i> Corporation Name
                                </label>
                                <div class="input-group">
                                    <input class="form-control" type="text" placeholder="Type here...">
                                </div>
                            </div>
                            <div class="col-sm-4 p-2">
                                <label class="form-label"> <i class="fas fa-phone-alt me-1"></i> Phone Number </label>
                                <div class="input-group">
                                    <input class="form-control" type="number" placeholder="Phone">
                                </div>
                            </div>
                            <div class="col-sm-4 p-2">
                                <label class="form-label"> <i class="fas fa-envelope me-1"></i> Email</label>
                                <div class="input-group">
                                    <input class="form-control" type="email" placeholder="Email">
                                </div>
                            </div>
                            <div class="col-sm-6 p-2">
                                <label class="form-label"> <i class="fas fa-money-bill-wave me-1"></i> Paid Amount
                                </label>
                                <div class="input-group">
                                    <input class="form-control" type="number" placeholder="Amount">
                                </div>
                            </div>
                            <div class="col-sm-6 p-2">
                                <label class="form-label"> <i class="fas fa-users me-1"></i> Visitors Count </label>
                                <div class="input-group">
                                    <input class="form-control" type="number" placeholder="Count">
                                </div>
                            </div>
                            <div class="col-sm-6 p-2">
                                <label class="form-label"> <i class="fas fa-calendar-alt me-1"></i> Coupon Start Date
                                </label>
                                <div class="input-group">
                                    <input class="form-control" type="date">
                                </div>
                            </div>
                            <div class="col-sm-6 p-2">
                                <label class="form-label"> <i class="fas fa-calendar-alt me-1"></i> Coupon End Date
                                </label>
                                <div class="input-group">
                                    <input class="form-control" type="date">
                                </div>
                            </div>
                            <div class="col-12 p-2">
                                <label class="form-label"><i class="fas fa-feather-alt me-1"></i> Note</label>
                                <textarea name="" id="" class="form-control" rows="5"
                                          placeholder="Add Note..."></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-dark ml-auto me-2" data-bs-dismiss="modal"> Close</button>
                        <button type="submit" class="btn btn-success"> Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        var loader = ` <div class="linear-background">
                            <div class="inter-crop"></div>
                            <div class="inter-right--top"></div>
                            <div class="inter-right--bottom"></div>
                        </div>
        `;

        var columns = [
            {data: 'id', name: 'id'},
            {data: 'ticket_num', name: 'ticket_num'},
            {data: 'client_name', name: 'client_name'},
            {data: 'phone', name: 'phone'},
            {data: 'note', name: 'note'},
            {data: 'coupon_start', name: 'coupon_start'},
            {data: 'coupon_end', name: 'coupon_end'},
            {data: 'view', name: 'view'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]

        // Get Edit View
        $(document).on('click', '.editBtn', function () {
            var id = $(this).data('id')
            var url = "{{route('coupons.edit',':id')}}";
            url = url.replace(':id', id)
            $('#modalContent').html(loader)
            $('#editOrCreate').modal('show')

            setTimeout(function () {
                $('#modalContent').load(url)
            }, 250)
            setTimeout(function () {
            }, 500)
        })

        // Get Add View
        $(document).on('click', '.addBtn', function () {
            $('#modalContent').html(loader)
            $('#editOrCreate').modal('show')
            setTimeout(function () {
                $('#modalContent').load('{{route('coupons.create')}}')
            }, 250)
        });

        // Add By Ajax
        $(document).on('submit','Form#addForm',function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            var url = $('#addForm').attr('action');
            $.ajax({
                url: url,
                type: 'POST',
                data: formData,
                beforeSend: function () {
                    $('#addButton').html('<span class="spinner-border spinner-border-sm mr-2" ' +
                        ' ></span> <span style="margin-left: 4px;">working</span>').attr('disabled', true);
                },
                success: function (data) {
                    if (data.status == 200) {
                        $('#dataTable').DataTable().ajax.reload();
                        toastr.success('Coupon added successfully');
                    }
                    else
                        toastr.error('There is an error');
                    $('#addButton').html(`Create`).attr('disabled', false);
                    $('#editOrCreate').modal('hide')
                },
                error: function (data) {
                    if (data.status === 500) {
                        toastr.error('There is an error');
                    } else if (data.status === 422) {
                        var errors = $.parseJSON(data.responseText);
                        $.each(errors, function (key, value) {
                            if ($.isPlainObject(value)) {
                                $.each(value, function (key, value){
                                    toastr.error(value, key);
                                });
                            }
                        });
                    } else
                        toastr.error('there in an error');
                    $('#addButton').html(`Create`).attr('disabled', false);
                },//end error method

                cache: false,
                contentType: false,
                processData: false
            });
        });

        // Update By Ajax
        $(document).on('submit','Form#updateForm',function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            var url = $('#updateForm').attr('action');
            $.ajax({
                url: url,
                type: 'POST',
                data: formData,
                beforeSend: function () {
                    $('#updateButton').html('<span class="spinner-border spinner-border-sm mr-2" ' +
                        ' ></span> <span style="margin-left: 4px;">working</span>').attr('disabled', true);
                },
                success: function (data) {
                    $('#updateButton').html(`Update`).attr('disabled', false);
                    if (data.status == 200){
                        $('#dataTable').DataTable().ajax.reload();
                        toastr.success('Coupon updated successfully');
                    }
                    else
                        toastr.error('There is an error');

                    $('#editOrCreate').modal('hide')
                },
                error: function (data) {
                    if (data.status === 500) {
                        toastr.error('There is an error');
                    } else if (data.status === 422) {
                        var errors = $.parseJSON(data.responseText);
                        $.each(errors, function (key, value) {
                            if ($.isPlainObject(value)) {
                                $.each(value, function (key, value){
                                    toastr.error(value, key);
                                });
                            }
                        });
                    } else
                        toastr.error('there in an error');
                    $('#updateButton').html(`Update`).attr('disabled', false);
                },//end error method

                cache: false,
                contentType: false,
                processData: false
            });
        });

    </script>
    <script>
        $('#coupon').addClass('active')
    </script>
@endsection
