@extends('layouts.neonMaster')

@section('page_title')
@endsection

@section('additional_styles')
@endsection

@section('sidebar')
    @include('neon_includes.sidebar')
@endsection

@section('header')
    @include('neon_includes.header')
@endsection

@section('content')
    <div class="row">
        <form id="rootwizard" method="post" action="{{ url('/activity/store') }}" class="form-horizontal form-wizard validate" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="steps-progress">
                        <div class="progress-indicator"></div>
                </div>

                <ul>
                        <li class="active">
                                <a href="#tab1" data-toggle="tab"><span>1</span>ACTIVITY INFO</a>
                        </li>
                        <li>
                                <a href="#tab2" data-toggle="tab"><span>2</span>TIME & LOCATION</a>
                        </li>
                        <li>
                                <a href="#tab3" data-toggle="tab"><span>3</span>CRITERIA AND GROUPS</a>
                        </li>
                        <li>
                                <a href="#tab4" data-toggle="tab"><span>4</span>FINISH</a>
                        </li>
                </ul>
                <hr>
                <div class="tab-content">

                        <div class="tab-pane active" id="tab1">

                                <div class="row">
                                        <div class="col-md-6 col-md-offset-3">
                                                <div class="form-group">
                                                        <label class="control-label" for="full_name">Activity Name</label>
                                                        <input class="form-control" name="activityName" id="full_name" data-validate="required" placeholder="" />
                                                </div>
                                        </div>
                                </div>

                                <div class="row">
                                        <div class="col-md-6 col-md-offset-3">
                                                <div class="form-group">
                                                        <label class="control-label">Activity Skills</label>

                                                                <select name="activitySkills[]" class="select2" multiple data-validate="required">
                                                                        <option value="Environmental" >Environmental</option>
                                                                        <option value="Youth Work" >Youth Work</option>
                                                                        <option value="Education" >Education</option>
                                                                        <option value="Livelihood" >Livelihood</option>
                                                                </select>
                                                </div>
                                        </div>
                                </div>

                                <div class="row">
                                        <div class="col-md-6 col-md-offset-3">
                                                <div class="form-group">
                                                        <label for="field-1" class="control-label">Picture</label>
                                                        <input type="file" name="file" class="form-control" id="field-file" data-validate="required" placeholder="Placeholder">
                                                </div>
                                        </div>
                                </div>

                                <div class="row">
                                        <div class="col-md-6 col-md-offset-3">
                                                <div class="form-group">
                                                        <label for="field-1" class="control-label">Description</label>
                                                        <textarea class="form-control wysihtml5" data-stylesheet-url="assets/css/wysihtml5-color.css" name="activityDescription" data-validate="required" id="sample_wysiwyg"></textarea>
                                                </div>
                                        </div>
                                </div>

                                <div class="row">
                                        <div class="col-md-6 col-md-offset-3">
                                                <div class="form-group">
                                                        <label for="field-1" class="control-label">Number of volunteers</label>
                                                        <div class="input-spinner ">
                                                                <button type="button" class="btn btn-default">-</button>
                                                                <input type="text" class="form-control size-5" value="0" data-min="0" data-max="9999" name="numberOfVolunteers" data-validate="required" />
                                                                <button type="button" class="btn btn-default">+</button>
                                                        </div>
                                                </div>
                                        </div>
                                </div>

                        </div>
                        <div class="tab-pane" id="tab2">
                            <div class="row">
                                    <div class="col-md-6 col-md-offset-3">
                                            <div class="form-group">
                                                    <label for="field-1" class="control-label">Start Date & Time</label>
                                                    <div class="date-and-time">
                                                        <input type="text" class="form-control datepicker" data-format="yyyy-mm-dd" name="startDate" data-validate="required">
                                                        <input type="text" class="form-control timepicker" data-template="dropdown" data-show-meridian="true" data-minute-step="1" name="startTime" data-validate="required"/>
                                                    </div>
                                            </div>
                                    </div>
                            </div>

                            <div class="row">
                                    <div class="col-md-6 col-md-offset-3">
                                            <div class="form-group">
                                                    <label for="field-1" class="control-label">End Date & Time</label>
                                                    <div class="date-and-time">
                                                        <input type="text" class="form-control datepicker" data-format="D, dd MM yyyy" name="endDate" data-validate="required">
                                                        <input type="text" class="form-control timepicker" data-template="dropdown" data-show-meridian="true" data-minute-step="1" name="endTime" data-validate="required" />
                                                    </div>
                                            </div>
                                    </div>
                            </div>
                            <div class="row">
                                    <div class="col-md-6 col-md-offset-3">
                                            <div class="form-group">
                                                    <label for="field-1" class="control-label">Location</label>
                                                    <div class="date-and-time">
                                                            <div id="map" style="height:500px"></div>
                                                    </div>
                                            </div>
                                    </div>
                            </div>
                        </div>
                    <div class="tab-pane" id="tab3">
                        <div class="row">
                            <div class="col-md-6 col-md-offset-3">
                                <div class="form-group">
                                    <label for="field-1" class="control-label">Criteria</label>
                    <script type="text/javascript">
                            // Code used to add Todo Tasks
                            jQuery(document).ready(function($)
                            {
                                    var $todo_tasks = $("#todo_tasks");

                                    $todo_tasks.find('input[type="text"]').on('keydown', function(ev)
                                    {
                                            if(ev.keyCode == 13)
                                            {
                                                    ev.preventDefault();

                                                    if($.trim($(this).val()).length)
                                                    {
                                                            var $todo_entry = $('<li><div class="checkbox checkbox-replace color-white"><label>'+$(this).val()+'</label></div></li>');
                                                            var $hidden = $('<input type="text" name="criteria[]" value="'+$(this).val()+'" hidden>');
                                                            $(this).val('');
                                                            $hidden.appendTo($(".tile-content"));
                                                            $todo_entry.appendTo($todo_tasks.find('.todo-list'));
                                                            $todo_entry.hide().slideDown('fast');
                                                            replaceCheckboxes();
                                                    }
                                            }
                                    });
                            });
                    </script>

                                    <div class="tile-block" id="todo_tasks">

                                            <div class="tile-header">
                                                    <i class="entypo-list"></i>

                                                    <a href="#">
                                                            Criteria
                                                            <span>Add criteria for the event</span>
                                                    </a>
                                            </div>

                                            <div class="tile-content">

                                                    <input type="text" class="form-control" placeholder="Add Task" />


                                                    <ul class="todo-list">
                                                    </ul>

                                            </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                        <div class="tab-pane" id="tab4">
                                <button type="submit" class="btn btn-default">Create Activity</button>
                        </div>



                        <ul class="pager wizard">
                                <li class="previous first">
                                        <a href="#">First</a>
                                </li>
                                <li class="previous">
                                        <a href="#"><i class="entypo-left-open"></i> Previous</a>
                                </li>

                                <li class="next last">
                                        <a href="#">Last</a>
                                </li>
                                <li class="next">
                                        <a href="#">Next <i class="entypo-right-open"></i></a>
                                </li>
                        </ul>

                </div>
            <!-- hidden input diri para long lat sa maps -->
            <input type="text" id="long" name="long" hidden="hidden">
            <input type="text" id="lat" name="lat" hidden="hidden">
        </form>
    </div>
@endsection

@section('additional_scripts')
	<script src="{{ asset('neonAssets/js/gsap/main-gsap.js') }}"></script>
	<script src="{{ asset('neonAssets/js/jquery-ui/js/jquery-ui-1.10.3.minimal.min.js') }}"></script>
	<script src="{{ asset('neonAssets/js/bootstrap.js') }}"></script>
	<script src="{{ asset('neonAssets/js/joinable.js') }}"></script>
	<script src="{{ asset('neonAssets/js/resizeable.js') }}"></script>
	<script src="{{ asset('neonAssets/js/neon-api.js') }}"></script>
	<script src="{{ asset('neonAssets/js/jquery.bootstrap.wizard.min.js') }}"></script>
	<script src="{{ asset('neonAssets/js/jquery.validate.min.js') }}"></script>
	<script src="{{ asset('neonAssets/js/jquery.inputmask.bundle.min.js') }}"></script>
	<script src="{{ asset('neonAssets/js/selectboxit/jquery.selectBoxIt.min.js') }}"></script>
	<script src="{{ asset('neonAssets/js/bootstrap-datepicker.js') }}"></script>
	<script src="{{ asset('neonAssets/js/bootstrap-switch.min.js') }}"></script>
	<script src="{{ asset('neonAssets/js/jquery.multi-select.js') }}"></script>
	<script src="{{ asset('neonAssets/js/neon-chat.js') }}"></script>
	<script src="{{ asset('neonAssets/js/neon-custom.js') }}"></script>
	<script src="{{ asset('neonAssets/js/neon-demo.js') }}"></script>
    <script>
      // Note: This example requires that you consent to location sharing when
      // prompted by your browser. If you see the error "The Geolocation service
      // failed.", it means you probably did not give permission for the browser to
      // locate you.
      var map, infoWindow;
      function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: -34.397, lng: 150.644},
          zoom: 20
        });
        infoWindow = new google.maps.InfoWindow;

        // Try HTML5 geolocation.
        if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(function(position) {
            var pos = {
              lat: position.coords.latitude,
              lng: position.coords.longitude
            };

            infoWindow.setPosition(pos);
            infoWindow.setContent('Location found.');
            infoWindow.open(map);
            map.setCenter(pos);
          }, function() {
            handleLocationError(true, infoWindow, map.getCenter());
          });
        } else {
          // Browser doesn't support Geolocation
          handleLocationError(false, infoWindow, map.getCenter());
        }
        
        var marker;

        function placeMarker(location) {
          if ( marker ) {
            marker.setPosition(location);
          } else {
            marker = new google.maps.Marker({
              position: location,
              map: map
            });
          }
        }

        google.maps.event.addListener(map, 'click', function(event) {
          placeMarker(event.latLng);
          //input x ang long y ang lat
          console.log(event);
          console.log(event.ea.x);
          console.log(event.ea.y);
          $('#long').val(event.ea.x);
          $('#lat').val(event.ea.y);
          console.log($('#long').val());
          console.log($('#lat').val());
        });
        }

        function handleLocationError(browserHasGeolocation, infoWindow, pos) {
        infoWindow.setPosition(pos);
        infoWindow.setContent(browserHasGeolocation ?
                              'Error: The Geolocation service failed.' :
                              'Error: Your browser doesn\'t support geolocation.');
        infoWindow.open(map);
      }
     
    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCnOLaiuE2JgkqIlsyzsSvw_WKbSoEqdoM&callback=initMap">
    </script>
@endsection
