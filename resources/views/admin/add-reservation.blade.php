@extends('admin.layouts.master')
@section('page_title')
    Sky Park | Add Reservation
@endsection
@section('content')
      <h2 class="MainTiltle mb-5 ms-4"> Add Reservation </h2>

      <form  action="reservation-info.html" class="card p-2 py-4 mt-3 ">
        <div class="row">
          <div class="col-sm-6 p-2">
            <label class="form-label"> <i class="fas fa-fire me-1"></i> Reservation Type </label>
            <select class="form-control" id="choices-Reservation">
              <option value="Event">Event</option>
              <option value="Birthday">Birthday</option>
              <option value="School">School</option>
              <option value="Corporate">Corporate</option>
            </select>
          </div>
          <div class="col-sm-6 p-2">
            <label class="form-label"> <i class="fas fa-user me-1"></i> Client Name</label>
            <div class="input-group">
              <input class="form-control" type="text" placeholder="Type here...">
            </div>
          </div>
          <div class="col-sm-6 p-2">
            <label class="form-label"> <i class="fas fa-envelope me-1"></i> Email</label>
            <div class="input-group">
              <input class="form-control" type="email" placeholder="Type here...">
            </div>
          </div>
          <div class="col-sm-6 p-2">
            <label class="form-label"><i class="fas fa-phone-square me-1"></i> Phone</label>
            <div class="input-group">
              <input class="form-control" type="number" placeholder="Type here...">
            </div>
          </div>
          <div class="col-sm-4 p-2">
            <label class="form-label "><i class="fas fa-venus-mars me-1"></i> gender</label>
            <div class="choose">
              <div class="genderOption">
                <input type="radio" class="btn-check" name="gender" id="option1">
                <label class=" mb-0 btn btn-outline" for="option1">
                  <span class="me-2"> <i class="fas fa-male"></i> </span>
                  <span> male </span>
                </label>
              </div>
              <div class="genderOption">
                <input type="radio" class="btn-check" name="gender" id="option2">
                <label class=" mb-0 btn btn-outline" for="option2">
                  <span class="me-2"> <i class="fas fa-female"></i> </span>
                  <span> female </span>
                </label>
              </div>
            </div>
          </div>
          <div class="col-sm-4 p-2">
            <label class="form-label"> <i class="fas fa-flag me-1"></i> Governorate </label>
            <select class="form-control" id="choices-governorate">
              <option value="Alexandria">Alexandria</option>
              <option value="Aswan">Aswan</option>
              <option value="Cairo">Cairo</option>
            </select>
          </div>
          <div class="col-sm-4 p-2">
            <label class="form-label"> <i class="fas fa-city me-1"></i> City </label>
            <select class="form-control" id="choices-city">
              <option value="El Nozha	">El Nozha </option>
              <option value="Abdeen">Abdeen</option>
              <option value="Ain Shams">Ain Shams</option>
            </select>
          </div>

          <div class="col-12 p-2">
            <label class="form-label"> <i class="fas fa-birthday-cake me-1"></i> Birthday Info </label>
            <div class="BirthdayInfo" >
              <div class="row ">
                <div class="col-sm-4 p-2">
                  <label class="form-label"> <i class="fas fa-user me-1"></i> Name</label>
                  <div class="input-group">
                    <input class="form-control" type="text" placeholder="Type here...">
                  </div>
                </div>
                <div class="col-sm-4 p-2">
                  <label class="form-label"> <i class="fas fa-envelope me-1"></i> Email</label>
                  <div class="input-group">
                    <input class="form-control" type="email" placeholder="Type here...">
                  </div>
                </div>
                <div class="col-sm-4 p-2">
                  <label class="form-label"><i class="fas fa-phone-square me-1"></i> Phone</label>
                  <div class="input-group">
                    <input class="form-control" type="number" placeholder="Type here...">
                  </div>
                </div>
                <div class="col-sm-6 p-2">
                  <label class="form-label "><i class="fas fa-venus-mars me-1"></i> gender</label>
                  <div class="choose">
                    <div class="genderOption">
                      <input type="radio" class="btn-check" name="AdminGender" id="Gender1">
                      <label class=" mb-0 btn btn-outline" for="Gender1">
                        <span class="me-2"> <i class="fas fa-male"></i> </span>
                        <span> male </span>
                      </label>
                    </div>
                    <div class="genderOption">
                      <input type="radio" class="btn-check" name="AdminGender" id="Gender2">
                      <label class=" mb-0 btn btn-outline" for="Gender2">
                        <span class="me-2"> <i class="fas fa-female"></i> </span>
                        <span> female </span>
                      </label>
                    </div>
                  </div>
                </div>

              </div>
            </div>

          </div>


        </div>
        <div class="text-center w-80 w-sm-30 m-auto">
          <button type="submit" class="btn btn-lg bg-gradient-primary btn-lg w-100 mt-4 mb-0">Confirm</button>
        </div>
      </form>
@endsection
@section('js')
  <script>
    ////////////////////////////////////////////
    // choice Js
    ////////////////////////////////////////////
    if (document.getElementsByClassName('choices-Reservation')) {
      var element = document.getElementById('choices-Reservation');
      const options = new Choices(element, {
        searchEnabled: false
      });
    }
    if (document.getElementsByClassName('choices-governorate')) {
      var element = document.getElementById('choices-governorate');
      const options = new Choices(element);
    }
    if (document.getElementById('choices-city')) {
      var element = document.getElementById('choices-city');
      const options = new Choices(element);
    }
    if (document.getElementById('choices-reference')) {
      var element = document.getElementById('choices-reference');
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

