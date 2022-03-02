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
          <a href="index.html"> home </a>
        </li>
        <li>
          <a href="#!" class="active">about us </a>
        </li>
      </ul>
    </section>
    <!-- about us page -->
    <section class="aboutUsPage">
      <div class="container">
        <h1 class="title"> about us </h1>
        <div class="row">
          <div class="col-md-7 p-2 m-auto">
            <p>At {{$setting->title}}, your courage will be put to test. Nothing can satisfy your lust for adventure as a set of
              professional obstacle courses elevated on three levels. and the higher up you go, the more challenging it
              will get. So, take a deep breath and set your sails towards {{$setting->title}} to prove yourself the ultimate champ.
            </p>
            <p>Obstacle courses are established on four levels, Junior, Novice, Intermediate, and Expert. Each path goes
              another level higher than the one before and features some more challenging obstacles. No, we didn’t
              forget about our little ones. Children up to 5 years old have their own special route with obstacles
              tailored to match their age. Once you succeed to complete your mission and reach the finish line, your
              lips won’t refrain from keeping a smile on hold for the next couple of days. </p>
          </div>

        </div>
      </div>
    </section>

    <!-- counter -->
    <div class="counter">
      <div class="container">
        <div class="counterBox">
          <div class="row">
            <div class="col-lg-3 col-sm-6 p-2">
              <div class="counterItem">
                <div class="icon">
                  <i class="fad fa-chalkboard-teacher"></i>
                </div>
                <div class="info">
                  <h3>
                    <span class="odometer" data-count="4">00</span>
                    <span class="sign-icon">+</span>
                  </h3>
                  <p>COURSES</p>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-sm-6 p-2">
              <div class="counterItem">
                <div class="icon">
                  <i class="fad fa-ski-jump"></i>
                </div>
                <div class="info">
                  <h3>
                    <span class="odometer" data-count="45">00</span>
                    <span class="sign-icon">+</span>
                  </h3>
                  <p>OBSTACLES </p>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-sm-6 p-2">
              <div class="counterItem">
                <div class="icon">
                  <i class="fad fa-users-crown"></i>
                </div>
                <div class="info">

                  <h3>
                    <span class="odometer" data-count="15">00</span>
                    <span class="sign-icon">+</span>
                  </h3>
                  <p>INSTRUCTORS</p>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-sm-6 p-2">
              <div class="counterItem">
                <div class="icon">
                  <i class="fas fa-smile-beam"></i>
                </div>
                <div class="info">

                  <h3>
                    <span class="odometer" data-count="500">00</span>
                    <span class="sign-icon">+</span>
                  </h3>
                  <p>HAPPY ADVENTURERS</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
    <!-- PHILOSOPHY -->
    <section class="philosophy">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-md-6 p-2">
            <div class="video">
              <video controls muted src="video/video.mp4"></video>
            </div>
          </div>
          <div class="col-md-6 p-2">
            <div class="philosophyInfo">
              <h3 class="titleTow text-muted m-0"> Self Accomplishment Is </h3>
              <h1 class="title"> OUR PHILOSOPHY </h1>
              <p>Diamonds are formed through millions of years of intense heat and pressure, but watch how they came out
                to be. It’s just the same with humans, we always learn and come out better after passing through
                hardships and overcoming them. That’s what we aim at spreading through {{$setting->title}}. Once you decide to
                cling your harness to the course, there’s only one way down and that’s right at the end of your path.
                But as soon as you overcome your challenge you won’t be the same person who came up; A new, more joyful,
                more confident being who is always willing to take the risk and prove to himself that he is stronger.
              </p>

            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- CHALLENGING -->
    <section class="challenging">
      <div class="container">
        <p class=" titleTow text-muted m-0"> Unmatched Concept </p>
        <h1 class="title"> CHALLENGING <br> YET ENERGIZING </h1>
        <div class="row">
          <div class="col-md-7 p-2 ">
            <p>{{$setting->title}} is special in its aura, where you will get the feeling of being an adventurer going through the
              jungles, as it’s decorated with leaves wall-paintings and garnished with lots of leafy plantings. The park
              is also all built from wood and bamboo that fits and completes the whole concept. In addition, obstacles
              are created with difference of age in-mind, so kids as well as adults can have fun without going through
              much risk.

            </p>
          </div>

        </div>
      </div>
    </section>


  </content>
@endsection
