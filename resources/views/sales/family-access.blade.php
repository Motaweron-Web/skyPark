@extends('admin.layouts.master')
@section('page_title')
    Sky Park | Family Access
@endsection
@section('content')
      <h2 class="MainTiltle mb-5 ms-4"> Family Access </h2>
      <form class="card p-3 py-4 w-100 w-sm-80 m-auto ">
          <label class="form-label fs-4"> <i class="fas fa-ticket-alt me-2"></i>Ticket Number</label>
          <div class="d-flex">
            <input type="text" class="form-control" placeholder="Type here...">
            <button type="submit" class="input-group-text ms-2 bg-gradient-primary px-4 text-body"><i
                class="fas fa-search text-white"></i></button>
          </div>
      </form>

      <form class="card p-2 py-4 mt-3 ">
        <!-- table -->
        <table class=" customDataTable table table-bordered nowrap">
          <thead>
            <tr>
              <th>Ticket Number</th>
              <th>Type</th>
              <th>Bracelet Number </th>
              <th>Name</th>
              <th>Birthday</th>
              <th>Gender</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>#SADSA566</td>
              <td>Kid</td>
              <td><input type="text" class="form-control" placeholder="Bracelet Number"></td>
              <td><input type="text" class="form-control" placeholder="Name"></td>
              <td><input type="date" class="form-control"></td>
              <td>
                <div class="choose">
                  <div class="genderOption">
                    <input type="radio" class="btn-check" name="gender" id="option1">
                    <label class=" mb-0 btn btn-outline" for="option1">
                      <span> <i class="fas fa-male"></i> </span>
                    </label>
                  </div>
                  <div class="genderOption">
                    <input type="radio" class="btn-check" name="gender" id="option2">
                    <label class=" mb-0 btn btn-outline" for="option2">
                      <span> <i class="fas fa-female"></i> </span>
                      <!-- <span> female </span> -->
                    </label>
                  </div>
                </div>
              </td>
              <td>
                <span class="controlIcons">
                  <span class="icon" data-bs-toggle="tooltip" title="check"> <i class="fal fa-check"></i> </span>
                </span>
              </td>
            </tr>

          </tbody>
        </table>

        <div class=" p-4">
          <label class="form-label fs-5"><i class="fas fa-feather-alt me-1"></i> Note</label>
          <textarea name="" id="" class="form-control" rows="6" placeholder="Add Note..."></textarea>
        </div>

        <div class="text-center w-80 w-sm-20 m-auto">
          <button type="button" data-bs-toggle="modal" data-bs-target="#modal-print"
            class="btn btn-lg bg-gradient-primary btn-lg w-100 mt-4 mb-0">Print</button>
        </div>


        <div class="modal fade" id="modal-print" tabindex="-1" role="dialog" aria-labelledby="modal-print"
          aria-hidden="true">
          <div class="modal-dialog modal-danger modal-dialog-centered modal-" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h6 class="modal-title" id="modal-title-print">Print Ticket</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                  <i class="fal fa-times text-dark fs-4"></i>
                </button>
              </div>
              <div class="modal-body">
                <div class="py-3 text-center">
                  <i class="fad fa-print fa-4x"></i>
                  <h5 class="text-gradient text-dark mt-4">Is receipt printed correctly ?</h5>
                  <!-- <p>Is receipt printed correctly ?</p> -->
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-success" data-bs-dismiss="modal">Yes</button>
                <button type="button" class="btn btn-link text-dark ml-auto">No</button>
              </div>
            </div>
          </div>
        </div>
      </form>
@endsection
@section('js')
    <script>
        ////////////////////////////////////////////
        // choice Js
        ////////////////////////////////////////////
        $(".controlIcons .icon").click(function () {
            $(this).addClass('checked')
        });
    </script>
    <script>
        $(document).ready(function () {
            var table = $('.customDataTable').DataTable({
                responsive: true,
                // "ordering": true,
                // columnDefs: [{
                //   'targets': [4, 5],
                //   'orderable': false
                // }, ]
            });
            new $.fn.dataTable.FixedHeader(table);
        });
    </script>
@endsection
