@extends('layouts.hybridMaster')

@section('title')
    Ethelon
@endsection
@section('additional_styles')

@endsection

@section('content')
    @if($activities)
    @foreach($activities as $activity)
        <div class="col-lg-4">
            <div class="card-box project-box">
                <div class="label label-danger">Open</div>
                <!-- <p class="text-danger text-uppercase m-b-20 font-13">Web Design</p> -->
                <img src="{{ $activity->image_url }}" class="thumb-img" style="object-fit:cover;height:200px;width:calc(100% + 40px);margin-top: -20px !important;margin-left: -20px !important;border-radius: 0px !important;">
                <p></p>
                <h4 class="m-t-0 m-b-5"><a href="" class="text-inverse" style="color:#ff5b5b !important;">{{ $activity->name }}</a></h4>
                <p class="text-muted font-13" style="color:black !important">{{ $activity->description }}...<a href="#" class="font-600 text-muted">view more</a>
                </p>

                <ul class="list-inline">
                    <li>
                        <h3 class="m-b-0">87</h3>
                        <p class="text-muted" style="color:#98a6ad !important">Questions</p>
                    </li>
                </ul>

                <div class="project-members m-b-20">
                    <span class="m-r-5 font-600">Volunteers :</span>
                    @if($volunteers)
                    @foreach($volunteers as $volunteer)
                        @foreach($volunteer->activitiesJoined as $activityJoined)
                            @if($activityJoined->activity_id == $activity->activity_id)
                            <a href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="">
                                    <img src="{{ $volunteer->image_url }}" class="img-circle thumb-sm" alt="friend" />
                            </a>
                            @endif
                        @endforeach
                    @endforeach
                    @endif
                </div>

                <p class="font-600 m-b-5">Needed Volunteers <span class="text-danger pull-right">68%</span></p>
                <div class="progress progress-bar-danger-alt progress-sm m-b-5">
                    <div class="progress-bar progress-bar-danger progress-animated wow animated animated"
                         role="progressbar" aria-valuenow="68" aria-valuemin="0" aria-valuemax="100"
                         style="width: 68%;">
                    </div><!-- /.progress-bar .progress-bar-danger -->
                </div><!-- /.progress .no-rounded -->

            </div>
        </div>
    @endforeach
    @endif
    </div>
@endsection

@section('additional_scripts')

@endsection