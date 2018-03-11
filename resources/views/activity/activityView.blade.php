<?php
  use Carbon\Carbon;
?>

@extends('layouts.hybridMaster')

@section('title')
    Ethelon | Activity
@endsection
@section('additional_styles')
  <!-- Sweet Alert css -->
  <link href="{{ asset('adminitoAssets/assets/plugins/bootstrap-sweetalert/sweet-alert.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
  <div class="row">
    <div class="col-md-8">
      <div class="card-box task-detail">
          <img src="{{ $activity->image_url }}" class="thumb-img" style="border-radius:0px !important;object-fit:cover;height:300px;width:calc(100% + 40px);margin-top: -20px !important;margin-left: -20px !important;border-top-left-radius: 5px !important;border-top-right-radius: 5px !important;">

          <h4 class="font-600 m-b-20" style="color:red;">{{ $activity->name }}</h4>
          
          <h5 class="font-600 m-b-5">Description</h5>
          <p class="text-muted" style="color:#797979 !important;">
              {{ $activity->description }}
          </p>
          <h5 class="font-600 m-b-5">Recommended Skills</h5>
          @foreach($activity->skills as $skill)
          <p class="text-muted" style="color:#797979 !important;">

              {{ '- '.$skill->name }}
          </p>
          @endforeach
          <h5 class="font-600 m-b-5">Location</h5>
          <p class="text-muted" style="color:#797979 !important;">
              {{ $activity->location }}
          </p>
          <ul class="list-inline task-dates">
              <li>
                  <h5 class="font-600 m-b-5">Start Date</h5>
                  <?php
                    $st = new \DateTime($activity->startDate);  
                    $stt = Carbon::instance($st);
                    $stt->setToStringFormat('jS \o\f F, Y g:i:s a');
                  ?>
                  <p> {{ $stt }}</p>
              </li>

              <li>
                  <h5 class="font-600 m-b-5">End Date</h5>
                  <?php
                    $dt = new \DateTime($activity->endDate);  
                    $dtt = Carbon::instance($dt);
                    $dtt->setToStringFormat('jS \o\f F, Y g:i:s a');
                  ?>
                <p>{{ $dtt }}</p>
              </li>
          </ul>
          <ul class="list-inline task-dates">
              <li>
                  <h5 class="font-600 m-b-5">Contact Person</h5>
                  <p> {{ $activity->contactperson }}</p>
              </li>

              <li>
                  <h5 class="font-600 m-b-5">Contact Number</h5>
                <p>{{ $activity->contact }}</p>
              </li>
          </ul>
          <div class="clearfix"></div>

          <div class="assign-team m-t-30">
              <h5 class="font-600 m-b-5">Volunteers</h5>
              <div>
                
                  <a href="#"> <img class="img-circle thumb-sm" alt="" src="assets/images/users/avatar-8.jpg"> </a>
                
              </div>
          </div>
          
          <div class="attached-files m-t-30">

              <div class="row">
                  <div class="col-sm-6">
                                        <div class="text-left m-t-30">
                                                <button type="submit" id="qrCode" class="btn btn-default waves-effect waves-light">
                              View QR Code
                          </button>
                                                </div>
                  </div>
                  <div class="col-sm-6">
                      <div class="text-right m-t-30">
                          <button type="submit" id="edit" class="btn btn-success waves-effect waves-light">
                              Edit
                          </button>
                          <button class="btn btn-danger waves-effect waves-light" id="delete">Delete</button>
                          <button type="button"
                                  class="btn btn-default waves-effect" id="back">Back
                          </button>
                      </div>
                  </div>
              </div>
          </div>

      </div>
  </div>
  </div>

@endsection

@section('additional_scripts')
  <!-- Sweet Alert js -->
  <script src="{{ asset('adminitoAssets/assets/plugins/bootstrap-sweetalert/sweet-alert.min.js') }}"></script>
  <script src="{{ asset('adminitoAssets/assets/pages/jquery.sweet-alert.init.js') }}"></script>
  <script type="text/javascript">
    $(document).ready(function(){

      $('#back').on('click', function(){
        window.location = "{{url('/activity')}}";
      });

      $('#edit').on('click', function(){
        window.location = "{{url('/activity/edit/'.$activity->activity_id)}}";
      });

       $('#delete').on('click', function(){
          deleteee("{{ $activity->activity_id }}");
       });

            $('#qrCode').on('click', function(){
        window.location = "{{url('/webtest/'.$activity->activity_id)}}";
      });

            function deleteee(id) {
        var aid= id;
        
                if(confirm("Are you sure you want to delete this comment?"))
                {
                    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                    $.ajax({
                        method: "get",
                        url: "{{ url('/activity/delete').'/'.$activity->activity_id }}",
                        data: {'_token': CSRF_TOKEN,
                               'id': id
                               },
                        success: function(id) {

                            window.location = "{{ url('/activity') }}";
                        },
                        error: function(a,b,c) {
                        console.log(b.responseText);
                    }
                    });
                }
                else
                {
                    
                }
        }

    });
  </script>
@endsection 