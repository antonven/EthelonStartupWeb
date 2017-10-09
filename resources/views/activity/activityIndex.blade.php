@extends('layouts.hybridMaster')

@section('title')
    Ethelon | Activity
@endsection
@section('additional_styles')

@endsection
@section('content')
    <div class="row">
        <div class="col-lg-2">
            <button type="button" id="createActivity" class="btn btn-danger btn-block btn-bordred waves-effect w-md waves-light">Add Activity</button>
        </div>
    </div>
    <br>
    

    <div class="row">
  
    @foreach($activities as $activity)
        <div class="col-lg-3">
            <div class="card-box project-box">
                <div class="label label-danger">Open</div>
                <!-- <p class="text-danger text-uppercase m-b-20 font-13">Web Design</p> -->
                <img src="{{ $activity->image_url }}" class="thumb-img" style="object-fit:cover;height:200px;width:calc(100% + 40px);margin-top: -20px !important;margin-left: -20px !important;border-radius: 0px !important;">
               
                <p>
                   
                <h4 class="m-t-0 m-b-5"><a href="webtest/{{$activity->activity_id}}" class="text-inverse" style="color:#ff5b5b !important;">{{ $activity->name }}</a></h4>
                <p class="text-muted font-13" style="color:black !important">{{ $activity->description }}...<a href="#" class="font-600 text-muted">view more</a>

                </p>

                <!-- <ul class="list-inline">
                    <li>
                        <h3 class="m-b-0">87</h3>
                        <p class="text-muted" style="color:#98a6ad !important">Questions</p>
                    </li>
                </ul> -->

                <div class="project-members m-b-20">
                    <span class="m-r-5 font-600">Volunteers :</span>
                    @if($volunteersArray)
                    @foreach($volunteersArray as $volunteerArray)
                      @if(isset($volunteerArray[$activity->activity_id]))
                        @foreach($volunteerArray[$activity->activity_id]->slice(0,10) as $volunteer)

                                  @if($volunteer->image_url != null)  
                                 <a href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="">
                                    <img src="{{ $volunteer->image_url }}" class="img-circle thumb-sm" />
                                 </a>
                                  @endif  
                            @endforeach
                       
                      @endif
                    @endforeach
                    @endif

                </div>
                        @foreach($volunteersArray as $volunteerArray)
                             @if(isset($volunteerArray[$activity->activity_id]))    
                                     <p class="font-600 m-b-5">Needed Volunteers {{ count($volunteerArray[$activity->activity_id]) }}/100 <span class="text-danger pull-right">{{ (count($volunteerArray[$activity->activity_id])/100)*100 }}%</span></p>
                    <div class="progress progress-bar-danger-alt progress-sm m-b-5">
                    <div class="progress-bar progress-bar-danger progress-animated wow animated animated"
                         role="progressbar" aria-valuenow="{{ (count($volunteerArray[$activity->activity_id])/100)*100 }}" aria-valuemin="0" aria-valuemax="100"
                         style="width: {{ (count($volunteerArray[$activity->activity_id])/100)*100 }}%;">
                    </div><!-- /.progress-bar .progress-bar-danger -->
                    </div><!-- /.progress .no-rounded -->

                             @endif
                       @endforeach
               
            </div>
        </div>
    @endforeach
    </div>

@endsection

@section('additional_scripts')
    <script>
        $(document).ready(function(){
            $('#createActivity').on('click',function(){
               window.location = "{{url('/activity/create')}}"; 
            });
        });
    </script>
@endsection 