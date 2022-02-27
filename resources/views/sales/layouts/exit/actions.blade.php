

    @if($model->temp_status == 'in')
            <span class="icon tempStatus" data-bs-toggle="tooltip" data-status="out" data-id="{{$model->id}}" title="temp exit"> <i class="fas fa-sign-out me-2"></i>
        temp exit </span>
        @elseif($model->temp_status == 'out')
            <span class="icon tempStatus" data-bs-toggle="tooltip" data-status="in" data-id="{{$model->id}}" title="temp return"> <i class="fas fa-sign-in me-2"></i>
        temp return </span>
        @endif

      <span class="icon topUpHours" data-id="{{$model->id}}"
            title="topUp"> <i class="fas fa-alarm-plus me-2"></i>
        topUp</span>
      <a href="{{route('exit.show',base64_encode($model->id))}}" class="icon" data-bs-toggle="tooltip" title=" exit"> <i class="fad fa-door-open me-2"></i>
        exit</a>

