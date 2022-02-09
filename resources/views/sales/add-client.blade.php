@extends('sales.layouts.master')
@section('page_title')
    Sky Park | Add Client
@endsection
@section('content')
      <h2 class="MainTitle mb-5 ms-4"> add client</h2>
      <form class="card p-3 py-4  w-100 w-sm-80 m-auto mb-4 ">
        <label class="form-label fs-4"><i class="fas fa-phone-square-alt me-2"></i> Phone</label>
        <div class="d-flex">
          <input type="text" class="form-control" placeholder="Phone Number">
          <button type="submit" class="input-group-text ms-2 bg-gradient-primary px-4 text-body"><i
              class="fas fa-search text-white"></i></button>
        </div>
      </form>
      <form action="ticket.html" class="card p-2 py-4 mt-3 ">
        <div class="row">
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
          <div class="col-sm-6 p-2">
            <label class="form-label"> <i class="far fa-tv-retro me-1"></i> reference </label>
            <select class="form-control" id="choices-reference">
              <option value="friend	">friend </option>
              <option value="Facebook">Facebook</option>
              <option value="web site">web site</option>
              <option value="web site">other</option>
            </select>
          </div>
          <div class="col-sm-6 p-2">
            <label class="form-label"> <i class="fas fa-users-crown me-1"></i> family size</label>
            <div class="input-group">
              <input class="form-control" type="number" placeholder="Type here...">
            </div>
          </div>
        </div>
        <div class="text-center w-80 w-sm-30 m-auto">
          <button type="submit" class="btn btn-lg bg-gradient-primary btn-lg w-100 mt-4 mb-0">ADD</button>
        </div>
      </form>
@endsection

@section('js')
    <script>
        $('#main-family').addClass('active')
        $('.createClient').addClass('active')
        $('#familySale').addClass('show')
    </script>
@endsection
