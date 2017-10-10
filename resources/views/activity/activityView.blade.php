@extends('layouts.hybridMaster')

@section('title')
    Ethelon | Activity
@endsection
@section('additional_styles')

@endsection
@section('content')
  <div class="row">
    <div class="col-md-8">
      <div class="card-box task-detail">
          <div class="dropdown pull-right">
              <a href="#" class="dropdown-toggle card-drop" data-toggle="dropdown" aria-expanded="false">
                  <i class="zmdi zmdi-more-vert"></i>
              </a>
              <ul class="dropdown-menu" role="menu">
                  <li><a href="#"></a></li>
                  <li><a href="#">Another action</a></li>
                  <li><a href="#">Something else here</a></li>
                  <li class="divider"></li>
                  <li><a href="#">Separated link</a></li>
              </ul>
          </div>
          <img src="{{ $activity->image_url }}" class="thumb-img" style="border-radius:0px !important;object-fit:cover;height:300px;width:calc(100% + 40px);margin-top: -43px !important;margin-left: -20px !important;border-top-left-radius: 5px !important;border-top-right-radius: 5px !important;">

          <h4 class="font-600 m-b-20" style="color:red;">{{ $activity->name }}</h4>
          
          <h5 class="font-600 m-b-5">Description</h5>
          <p class="text-muted" style="color:#797979 !important;">
              {{ $activity->description }}
          </p>
          <h5 class="font-600 m-b-5">Skills Needed</h5>
          @foreach($activity->skills as $skill)
          <p class="text-muted" style="color:#797979 !important;">

              {{ $skill->name }}
          </p>
          @endforeach
          <h5 class="font-600 m-b-5">Location</h5>
          <p class="text-muted" style="color:#797979 !important;">
              {{ $activity->location }}
          </p>
          <ul class="list-inline task-dates">
              <li>
                  <h5 class="font-600 m-b-5">Start Date</h5>
                  <p> 22 March 2016 <small class="text-muted">1:00 PM</small></p>
              </li>

              <li>
                  <h5 class="font-600 m-b-5">End Date</h5>
                  <p> 17 April 2016 <small class="text-muted">12:00 PM</small></p>
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
              <h5 class="font-600">Attached Files </h5>

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
                          <button type="submit" id="delete" class="btn btn-danger waves-effect waves-light">
                              Delete
                          </button>
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
  <script type="text/javascript">
    $(document).ready(function(){

      $('#back').on('click', function(){
        window.location = "{{url('/activity')}}";
      });

      $('#edit').on('click', function(){
        window.location = "{{url('/activity/edit/'.$activity->activity_id)}}";
      });

      $('#delete').on('click', function(){
        window.location = "{{url('/activity/delete/'.$activity->activity_id)}}";
      });

            $('#qrCode').on('click', function(){
        window.location = "{{url('/webtest/'.$activity->activity_id)}}";
      });

    });
  </script>
@endsection 