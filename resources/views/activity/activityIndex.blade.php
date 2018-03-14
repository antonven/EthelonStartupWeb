@extends('layouts.hybridMaster')

@section('title')
    Ethelon | Activity
@endsection
@section('additional_styles')

@endsection
@section('page_title')
    Activity Page
@endsection
@section('content')
<br>

<div class="row">
    <div class="col-lg-3">
        <div class="card-box project-box addactbtn" id="createActivity" style="height: 424px; display: table; width: 100%;">
            <div style="text-align: center; display: table-cell; vertical-align: middle;">
                <span style="font-size: 26px; text-indent: 1px; padding: 3px 12px; border: 2px solid #797979; border-radius: 50%;">+</span>
                <h4 style="margin-top: 20px;">Add an activity</h4>
            </div>
        </div>
    </div>
     
<?php
    $itemCounter = 0;
    $isFirstRow = true;
?>
    @foreach($activities as $activity)
        @if($itemCounter == 0 && $isFirstRow == false)
            <div class="row">
        @endif
        <div class="col-lg-3">
            <div class="card-box project-box activity_card">
                @if($activity->status == 0)
                <div class="label label-danger">Open</div>
                @else
                <div class="label label-danger">Close</div>
                @endif

                <img src="{{ $activity->image_url }}" class="thumb-img" style="border-radius:0px !important;object-fit:cover;height:200px;width:calc(100% + 40px);margin-top: -20px !important;margin-left: -20px !important;border-top-left-radius: 5px !important;border-top-right-radius: 5px !important;">
               
                <p>
                   
                <h4 class="m-t-0 m-b-5"><a href="webtest/{{$activity->activity_id}}" class="text-inverse" style="color:#ff5b5b !important;">{{ $activity->name }}</a></h4>
                <p class="text-muted font-13" style="color:black !important;min-height: 80px;height:80px">{{ substr($activity->description,0,200) }}...<a href="{{ url('/activity/'.$activity->activity_id ) }}" class="font-600 text-muted">view more</a>
                <input type="text" class="activity_card_id" value="{{ url('/activity/'.$activity->activity_id ) }}" hidden>
                </p>

                <div class="project-members m-b-20">
                    <span class="m-r-5 font-600">Volunteers :</span>
                    @foreach($activity->volunteers->slice(0,2) as $volunteerList)
                        @if($volunteerList->volunteer->image_url)
                            <a href="#" data-toggle="tooltip" data-placement="top" title="{{ $volunteerList->volunteer->user->name }}" data-original-title="">
                            <img src="{{ $volunteerList->volunteer->image_url }}" class="img-circle thumb-sm" />
                            </a>
                        @else
                            <a href="#" data-toggle="tooltip" data-placement="top" title="{{ $volunteerList->volunteer->user->name }}" data-original-title="">
                            <img src="{{ url('/skills/avatar.png') }}" class="img-circle thumb-sm" />
                            </a>
                        @endif
                    @endforeach
                </div>

                    <p class="font-600 m-b-5">Progress <span class="text-danger pull-right">68%</span></p>
                                    <div class="progress progress-bar-danger-alt progress-sm m-b-5">
                                        <div class="progress-bar progress-bar-danger progress-animated wow animated animated"
                                             role="progressbar" aria-valuenow="68" aria-valuemin="0" aria-valuemax="100"
                                             style="width: 68%;">
                                        </div><!-- /.progress-bar .progress-bar-danger -->
                                    </div><!-- /.progress .no-rounded -->


            </div>
        </div>
        <?php
            $itemCounter++;
        ?>
        @if($itemCounter == 3 && $isFirstRow == true)
            </div>
            <?php
                $isFirstRow = false;
                $itemCounter = 0;
            ?>
        @endif
        @if($itemCounter == 4 && $isFirstRow == false)
            </div>
                        <?php
                
                $itemCounter = 0;
            ?>
        @endif
    @endforeach


@endsection

@section('additional_scripts')
    <script>
        $(document).ready(function(){
            $('#createActivity').on('click',function(){
               window.location = "{{url('/activity/create')}}"; 
            });
            $('.activity_card').on('click', function(){
                window.location = $(this).find('.activity_card_id').val();
            });
        });
    </script>
@endsection 