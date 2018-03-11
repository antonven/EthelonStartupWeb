@extends('layouts.hybridMaster')

@section('title')
    Ethelon | Activity
@endsection
@section('additional_styles')

@endsection
@section('content')
    <br>

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
    ?>
    @foreach($activities as $activity)
        @if($itemCounter == 0)
            <div class="row">
        @endif
        <div class="col-lg-3">
            <div class="card-box project-box activity_card">
                @if($activity->status == 0)
                <div class="label label-danger">Open</div>
                @else
                <div class="label label-danger">Close</div>
                @endif
                <!-- <p class="text-danger text-uppercase m-b-20 font-13">Web Design</p> -->
                <img src="{{ $activity->image_url }}" class="thumb-img" style="border-radius:0px !important;object-fit:cover;height:200px;width:calc(100% + 40px);margin-top: -20px !important;margin-left: -20px !important;border-top-left-radius: 5px !important;border-top-right-radius: 5px !important;">
               
                <p>
                   
                <h4 class="m-t-0 m-b-5"><a href="webtest/{{$activity->activity_id}}" class="text-inverse" style="color:#ff5b5b !important;">{{ $activity->name }}</a></h4>
                <p class="text-muted font-13" style="color:black !important;min-height: 80px;height:80px">{{ substr($activity->description,0,200) }}...<a href="{{ url('/activity/'.$activity->activity_id ) }}" class="font-600 text-muted">view more</a>
                <input type="text" class="activity_card_id" value="{{ url('/activity/'.$activity->activity_id ) }}" hidden>
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
                        @foreach($volunteerArray[$activity->activity_id]->slice(0,5) as $volunteer)

                                  @if($volunteer->image_url != null)  
                                 <a href="#" data-toggle="tooltip" data-placement="top" title="{{ $volunteer->name }}" data-original-title="">
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
                                     <p class="font-600 m-b-5">Needed Volunteers {{ count($volunteerArray[$activity->activity_id]) }}/{{ $activity->volunteersNeeded }} <span class="text-danger pull-right">{{ (count($volunteerArray[$activity->activity_id])/ $activity->volunteersNeeded )*100 }}%</span></p>
                    <div class="progress progress-bar-danger-alt progress-sm m-b-5">
                    <div class="progress-bar progress-bar-danger progress-animated wow animated animated"
                         role="progressbar" aria-valuenow="{{ (count($volunteerArray[$activity->activity_id])/100)*100 }}" aria-valuemin="0" aria-valuemax="100"
                         style="width: {{ (count($volunteerArray[$activity->activity_id])/$activity->volunteersNeeded)*100 }}%;">
                    </div><!-- /.progress-bar .progress-bar-danger -->
                    </div><!-- /.progress .no-rounded -->

                             @endif
                       @endforeach
               
            </div>
        </div>
        <?php
            $itemCounter++;
        ?>
        @if($itemCounter == 4)
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