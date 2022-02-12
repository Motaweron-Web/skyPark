@extends('sales.layouts.master')
@section('page_title')
    Sky Park | Reservations
@endsection
@section('content')
      <h2 class="MainTiltle mb-5 ms-4"> Reservations </h2>
      <form class="card p-2 py-4 w-100 w-sm-80 m-auto ">
        <div class="row">
          <div class="col-12 p-2">
            <div class="row align-items-end">
              <div class="col-sm-9 p-1">
                <label class="form-label fs-4"> <i class="fas fa-ticket-alt me-2"></i> Search </label>
                <div class="d-flex">
                  <input type="text" class="form-control" placeholder="Type here...">
                  <button type="submit" class="input-group-text ms-2 bg-gradient-primary px-4 text-body"><i
                      class="fas fa-search text-white"></i></button>
                </div>
              </div>
              <div class="col-sm-3 p-1">
                <a href="{{route('capacity.index')}}?month={{date('Y-m')}}" class="btn bg-gradient-primary w-100 p-3 text-white"> <i
                    class="fal fa-plus-octagon fs-5 me-2 "></i> Add Reservation </a>
              </div>
            </div>
          </div>
          <div class="col-sm-6 p-2">
            <label class="form-label"> Customer Type </label>
            <select class="form-control" id="choices-type">
              <option value=""> All </option>
              <option value=""> School </option>
              <option value=""> Birthday </option>
              <option value=""> Event </option>
            </select>
          </div>
          <div class="col-sm-6 p-2">
            <label class="form-label"> shift </label>
            <select class="form-control" id="choices-shift">
              <option value="">10 am : 12 pm</option>
              <option value="">11 am : 01 pm</option>
              <option value="">12 pm : 02 pm</option>
              <option value="">01 pm : 03 pm</option>
            </select>
          </div>
        </div>

      </form>
      <form class="card p-2 py-4 mt-3 ">
        <!-- table -->
        <table class=" customDataTable table table-bordered nowrap">
          <thead>
            <tr>
              <th>ID</th>
              <th>Date</th>
              <th>Type</th>
              <th> Customer Name </th>
              <th>Responsible Name </th>
              <th>contact number</th>
              <th>Shift </th>
              <th>Quantity </th>
              <th>note</th>
              <th>actions</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>#SADSA566</td>
              <td> 18 / 10 / 2022 </td>
              <td> Birthday </td>
              <td>mahmoud </td>
              <td>gamal elkomy </td>
              <td>0123456789</td>
              <td>10am : 12pm</td>
              <td> 20 </td>
              <td>  </td>
              <td>
                <span class="controlIcons">
                  <span class="icon" data-bs-toggle="tooltip" title="edit"> <i class="far fa-edit me-2"></i> Edit </span>
                  <span class="icon" data-bs-toggle="tooltip" title=" delete "> <i class="far fa-trash-alt me-2"></i> Delete </span>
                  <span class="icon" data-bs-toggle="tooltip" title=" details "> <i class="fas fa-eye me-2"></i></i> Show </span>
                  <span class="icon" data-bs-toggle="tooltip" title="Access"> <i class="fal fa-check me-2"></i> Access </span>

                </span>
              </td>
            </tr>

          </tbody>


        </table>

      </form>
@endsection
@section('js')
  <script>
      $('#main-group').addClass('active')
      $('.createReservation').addClass('active')
      $('#groupSale').addClass('show')
    ////////////////////////////////////////////
    // choice Js
    ////////////////////////////////////////////
    if (document.getElementById('choices-type')) {
      var element = document.getElementById('choices-type');
      const options = new Choices(element, {
        searchEnabled: false
      });
    }
    if (document.getElementById('choices-shift')) {
      var element = document.getElementById('choices-shift');
      const options = new Choices(element, {
        searchEnabled: false
      });
    }
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

