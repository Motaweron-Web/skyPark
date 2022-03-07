@extends('site.layouts.master')
@section('content')
  <content>

    <!-- Main Banner  -->
    <section class="mainBanner">
      <button onclick="goBack()" class="Back">
        <i class="fas fa-angle-left"></i>
      </button>
      <ul>
        <li>
          <a href="{{route('/')}}"> home </a>
        </li>
        <li>
          <a href="{{route('groups')}}" class="active">GROUPS </a>
        </li>
      </ul>
    </section>

    <!-- groups -->
    <section class="groups">
      <div class="container">
        <div class="group">
          <div class="row align-items-center">
            <div class="col-md-6 p-3 order-md-2 ">
              <img src="img/group.svg" >
            </div>
            <div class="col-md-6 p-3 order-md-1">
              <div class="info">
                <h1 class="title"> GROUPS </h1>
                <p>
                  If you want to spice up your adventure, then gather up your group of friends or fellow adventurers and
                  set your sails towards {{$setting->title}}.

                </p>
              </div>
            </div>
          </div>
        </div>
        <div class="group">
          <div class="row align-items-center">
            <div class="col-md-6 p-3 ">
              <img src="img/team.svg" >
            </div>
            <div class="col-md-6 p-3">
              <div class="info">
                <h1 class="title"> TEAM BUILDING </h1>
                <p>
                  Do you think that your team’s bonds need some enhancement like our ropes are attached to the wooden
                  platforms? Reach our team and let them organize an unforgettable team-building day for your employees.
                </p>
              </div>
            </div>
          </div>
        </div>
        <div class="group">
          <div class="row align-items-center">
            <div class="col-md-6 p-3 order-md-2 ">
              <img src="img/birthday.svg" >
            </div>
            <div class="col-md-6 p-3 order-md-1">
              <div class="info">
                <h1 class="title"> BIRTHDAYS </h1>
                <p>
                  Do you think that a Birthday challenge is what your kids need to fire up their joy? We think so too.


                </p>
              </div>
            </div>
          </div>
        </div>


      </div>
    </section>



  </content>
@endsection
