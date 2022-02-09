@extends('admin.layouts.master')
@section('page_title')
    Sky Park | Capacity
@endsection
@section('content')
      <h2 class="MainTiltle mb-5 ms-4"> Sky Park Capacity </h2>

      <div class="card p-2 py-4">
        <div class=" row ">
          <div class="col-lg-9 p-2">
            <div class="calendar">
              <div class="row justify-content-between align-items-end">
                <div class="col text-center text-sm-start">
                  <button class="btn btn-success"> today </button>
                </div>
                <div class="col">
                  <div class="months justify-content-center justify-content-lg-end">
                    <button class=" icon prev"> <i class="fad fa-chevron-left"></i> </button>
                    <p> 2022 <span> october </span> </p>
                    <button class=" icon next"> <i class="fad fa-chevron-right"></i> </button>
                  </div>
                </div>
              </div>
              <div class="calendarHead">
                <div class="day">Sat</div>
                <div class="day">Sun</div>
                <div class="day">Mon</div>
                <div class="day">Tue</div>
                <div class="day">Wed</div>
                <div class="day">Thu</div>
                <div class="day">Fri</div>
              </div>
              <div class="calendarBody">
                <div class="day prevMonth">
                  <span class="num"> 28</span>
                </div>
                <div class="day prevMonth">
                  <span class="num"> 29</span>
                </div>
                <div class="day prevMonth">
                  <span class="num"> 30</span>
                </div>
                <div class="day">
                  <span class="num"> 01</span>
                </div>
                <div class="day">
                  <span class="num"> 02</span>
                </div>
                <div class="day">
                  <span class="num"> 03</span>
                </div>
                <div class="day">
                  <span class="num"> 04</span>
                </div>
                <div class="day">
                  <span class="num"> 05</span>
                </div>
                <div class="day">
                  <span class="num"> 06</span>
                  <div class="events">
                    <div class="event"> <span class="icon"> <i class="fad fa-bus-school"></i> </span></div>
                    <div class="event"> <span class="icon"> <i class="fas fa-city"></i> </span></div>
                  </div>
                  <div class="capacityContainer">
                    <div class="capacityPercentage" style="width: 20%;">
                    </div>
                  </div>
                </div>
                <div class="day">
                  <span class="num"> 07</span>
                </div>
                <div class="day">
                  <span class="num"> 08</span>
                </div>
                <div class="day">
                  <span class="num"> 09</span>
                </div>
                <div class="day">
                  <span class="num"> 10</span>
                </div>
                <div class="day">
                  <span class="num"> 11</span>
                </div>
                <div class="day">
                  <span class="num"> 12</span>
                </div>
                <div class="day">
                  <span class="num"> 13</span>
                </div>
                <div class="day">
                  <span class="num"> 14</span>
                </div>
                <div class="day">
                  <span class="num"> 15</span>
                  <div class="events">
                    <div class="event"> <span class="icon"> <i class="fad fa-bus-school"></i> </span></div>
                    <div class="event"> <span class="icon"> <i class="fas fa-birthday-cake"></i> </span></div>
                  </div>
                  <div class="capacityContainer">
                    <div class="capacityPercentage" style="width: 30%;">
                    </div>
                  </div>
                </div>
                <div class="day">
                  <span class="num"> 16</span>
                </div>
                <div class="day">
                  <span class="num"> 17</span>
                </div>
                <div class="day active">
                  <span class="num"> 18</span>
                  <div class="events">
                    <div class="event"> <span class="icon"> <i class="fad fa-bus-school"></i> </span></div>
                    <div class="event"> <span class="icon"> <i class="fas fa-fire-alt"></i> </span></div>
                    <div class="event"> <span class="icon"> <i class="fas fa-birthday-cake"></i> </span></div>
                    <div class="event"> <span class="icon"> <i class="fas fa-city"></i> </span></div>

                  </div>
                  <div class="capacityContainer">
                    <div class="capacityPercentage" style="width: 60%;">
                    </div>
                  </div>
                </div>
                <div class="day">
                  <span class="num"> 19</span>
                </div>
                <div class="day">
                  <span class="num"> 20</span>
                </div>
                <div class="day">
                  <span class="num"> 21</span>
                </div>
                <div class="day">
                  <span class="num"> 22</span>
                </div>
                <div class="day">
                  <span class="num"> 23</span>
                </div>
                <div class="day">
                  <span class="num"> 24</span>
                </div>
                <div class="day">
                  <span class="num"> 25</span>
                </div>
                <div class="day">
                  <span class="num"> 26</span>
                </div>
                <div class="day">
                  <span class="num"> 27</span>
                </div>
                <div class="day">
                  <span class="num"> 28</span>
                </div>
                <div class="day">
                  <span class="num"> 29</span>
                </div>
                <div class="day">
                  <span class="num"> 30</span>
                </div>
                <div class="day">
                  <span class="num"> 31</span>
                </div>
                <div class="day prevMonth">
                  <span class="num"> 1 </span>
                </div>

              </div>
            </div>
          </div>
          <div class="col-lg-3 p-2">

            <div class="dayDetails bg-gradient-primary">

              <h1 class="dateNum"> 18 </h1>
              <p class="dateName"> Friday </p>


                <div class="capacityInfo">
                  <h4>Capacity <span> ( 900 : 1250 ) </span></h4>
                  <div class="capacityValue">80%</div>
                  <div class="capacityContainer" >
                    <div class="capacityPercentage" style="width: 80%;"></div>
                  </div>
                </div>


              <div class="details">
                <h6 class="title"> current events :</h6>
                <div class="event"> <span class="icon"> <i class="fad fa-bus-school"></i> </span>
                  <p> Elnahda school </p>
                </div>
                <div class="event"> <span class="icon"> <i class="fas fa-fire-alt"></i> </span>
                  <p> mostafa saeed </p>
                </div>
                <div class="event"> <span class="icon"> <i class="fas fa-birthday-cake"></i> </span>
                  <p> ahmed tarek </p>
                </div>
                <div class="event"> <span class="icon"> <i class="fas fa-city"></i> </span>
                <p> Elmotweron Company </p>
                </div>
              </div>
              <a href="{{route('add-reservation')}}" class="btn btn-white w-100"> <i class="fal fa-plus-octagon fs-5 me-2"></i> Add Reservation             </a>

            </div>



          </div>

        </div>
      </div>
@endsection

