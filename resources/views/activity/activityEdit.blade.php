<?php
    
    use Carbon\Carbon;


?>
@extends('layouts.hybridMaster')
@section('title')
    Ethelon | Edit Activity
@endsection
@section('additional_styles')
<style>
    #map {
        height: 100%;
    }
</style>
@endsection

@section('content')
    <!-- PROGRESSBAR WIZARD -->
    <div class="col-lg-10 col-md-offset-1">
        <div class="card-box p-b-0">
            

            <h4 class="header-title m-t-0 m-b-30">Edit Activity</h4>
            <form id="commentForm2" method="POST" action="{{url('/activity/edit').'/'.$activity->activity_id}}" enctype="multipart/form-data">
                {{ csrf_field() }}
            <input type="text" id="long" name="long" value="{{ $activity->long }}" hidden="hidden">
            <input type="text" id="lat" name="lat" value="{{ $activity->lat }}" hidden="hidden">
            <div id="progressbarwizard" class="pull-in">
                <!-- TABS -->
                <ul class="ul">
                    <li><a href="#first" data-toggle="tab">Activity Info</a></li>
                    <li><a href="#second" data-toggle="tab">Time & Location</a></li>
                    <li><a href="#third" data-toggle="tab">Criteria & Groups</a></li>
                    <li><a href="#fourth" data-toggle="tab">Finish</a></li>
                </ul>
                <!-- END OF TABS -->
                <div class="tab-content b-0 m-b-0">

                    <div id="bar" class="progress progress-striped progress-bar-primary-alt active">
                        <div class="bar progress-bar progress-bar-primary"></div>
                    </div>

                    <div class="tab-pane p-t-10 fade" id="first">
                        <div class="row">
                            <div class="form-group col-lg-8 col-lg-offset-2">
                                <label class="control-label " for="activityName">Activity Name</label>
                                <input  name="activityName" id="activityName" type="text" value="{{ $activity->name }}" class="required form-control" placeholder="">
                            </div>
                            
                            <div class="form-group col-lg-8 col-lg-offset-2">
                                <label class="control-label " for="file">Picture</label>
                                <input type="file" class="dropify form-control" name="file" data-default-file="{{ $activity->image_url }}" data-height="300"  />
                                <input type="text" value="{{ $activity->image_url }}" name="file2" hidden="">
                            </div>
                            
                            <div class="form-group col-lg-8 col-lg-offset-2">
                                <label class="control-label " for="activityDescription">Description</label>
                                <textarea class="required form-control" name="activityDescription" id="activityDescription" rows="10" style="resize: none;">{{ $activity->description }}</textarea>
                            </div>

                            <div class="form-group col-lg-8 col-lg-offset-2">
                                <label class="control-label " for="activitySkills">Skills and Interests</label>
                                <select class="select2 select2-multiple required" name="activitySkills[]" id="activitySkills" multiple="multiple" multiple data-placeholder="">
                                    @foreach($skills as $skill)
                                        @if($activity_skills->contains('name', $skill->skill))
                                        <option value="{{ $skill->skill }}" selected="">{{ $skill->skill }}</option>
                                        @else
                                        <option value="{{ $skill->skill }}" >{{ $skill->skill }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            
                            <div class="form-group col-lg-8 col-lg-offset-2">
                                <div class="col-lg-6" style="padding-left: 0;">
                                    <label class="control-label " for="contactPerson">Contact Person</label>
                                    <input  name="contactPerson" id="contactPerson" type="text" class="required form-control" value="{{ $activity->contactperson}}" placeholder="">
                                </div>
                                <div class="col-lg-6" style="padding: 0;">
                                    <label class="control-label " for="contactInfo">Contact Info</label>
                                    <input  name="contactInfo" id="contactInfo" type="text" class="required form-control" value="{{ $activity->contact }}" placeholder="">
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    <div class="tab-pane p-t-10 fade" id="second">
                    <?php
                        $startDate = Carbon::parse($activity->startDate);
                        $endDate = Carbon::parse($activity->endDate);
                        $regDate = Carbon::parse($activity->registration_deadline);
                    ?>
                                                <div class="row">
                            <div class="form-group col-lg-8 col-lg-offset-2">
                                <div class="col-lg-6" style="padding-left: 0;" id="date1">
                                    <label class="control-label " for="startDate">Start Date</label>
                                    <input type="text" class=" required form-control" placeholder="mm/dd/yyyy" value="{{ $startDate->month.'/'.$startDate->day.'/'.$startDate->year }}" id="datepicker-autoclose" name="startDate">
                                </div>
                                <div class="col-lg-6" style="padding: 0;" id="time1">
                                    <label class="control-label " for="startTime">Start Time</label>
                                    <div class="bootstrap-timepicker">
                                        <input id="timepicker3" name="startTime" type="text" value="{{ $startDate->hour.':'.$startDate->minute }}" class="required form-control">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group col-lg-8 col-lg-offset-2">
                                <div class="col-lg-6" style="padding-left: 0;" id="date2">
                                    <label class="control-label " for="endDate">End Date</label>
                                    <input type="text" class=" required form-control" placeholder="mm/dd/yyyy" value="{{ $endDate->month.'/'.$endDate->day.'/'.$endDate->year }}" id="datepicker-autoclose2" name="endDate" >
                                </div>
                                <div class="col-lg-6" style="padding: 0;" id="time2">
                                    <label class="control-label " for="endTime">End Time</label>
                                    <div class="bootstrap-timepicker">
                                        <input id="timepicker4" name="endTime" value="{{ $endDate->hour.':'.$endDate->minute }}" type="text" class="required form-control">
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-group col-lg-8 col-lg-offset-2">
                                <div class="col-lg-6" style="padding-left: 0;" id="date3">
                                    <label class="control-label " for="deadlineDate">Registration Deadline Date</label>
                                    <input type="text" class=" required form-control" placeholder="mm/dd/yyyy" value="{{ $regDate->month.'/'.$regDate->day.'/'.$regDate->year }}" id="datepicker-autoclose5" name="deadlineDate" >
                                </div>
                                <div class="col-lg-6" style="padding: 0;" id="time3">
                                    <label class="control-label " for="deadlineTime">Registration Deadline Time</label>
                                    <div class="bootstrap-timepicker">
                                        <input id="timepicker5" name="deadlineTime" type="text" value="{{ $regDate->hour.':'.$regDate->minute }}" class="required form-control">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group col-lg-8 col-lg-offset-2" id="mapWindow">
                                <label class="control-label " for="activityLocation">Location</label>
                                <div id="locationField">
                                    <input name="activityLocation" type="text" id="pac-input" class="required form-control" placeholder="" value="{{ $activity->location }}">
                                </div>
                            </div>
                            
                            <div class="form-group col-lg-8 col-lg-offset-2">
                                <div id="map" style="height:350px"></div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane p-t-10 fade" id="third">
                        <div class="row">
                            <div class="form-group col-lg-8 col-lg-offset-2">
                                <div class="col-lg-8" style="padding-left: 0;">
                                    <label class="control-label " for="Criteria">Criteria</label>
                                    <input  name="criteria" id="criteria" type="text" class="form-control" placeholder="">
                                </div>
                                <div class="col-lg-4" style="padding: 0;">
                                    <label class="control-label " for="Criteria"><span style="color: transparent;">a</span></label>
                                    <input type="button" class="btn-danger form-control" id="addCriterion" value="Add">
                                </div>
                            </div>
                            <div class="form-group col-lg-8 col-lg-offset-2" id="criteriaList">

                                @if($activity->criteria)
                                <?php 
                                    $count = 1;
                                ?>
                                    @foreach($activity->criteria as $criterion)
                                        <div class="row"><div class="col-md-10"><pre class="criteria crit{{$count}}">{{ $criterion->criteria }}</pre><input type="text" hidden name="criteria[]" value="{{ $criterion->criteria }}"></div><div class="pull-right col-md-2"><pre><center>X</center></pre></div></div>
                                        <?php
                                            $count++;
                                        ?>
                                    @endforeach
                                @endif
                            </div>
                            <div class="form-group col-lg-8 col-lg-offset-2">
                                <label class="control-label " for="group">Number of Groups</label>
                                <input  name="group" id="group" type="number" class="required form-control" value="{{ $activity->group }}" placeholder="">
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane p-t-10 fade" id="fourth">
                        <div class="row">
                            <div class="form-group col-lg-8 col-lg-offset-2">
                                <dl class="dl-horizontal m-b-0">
                                    <dt>
                                        Activity Name
                                    </dt>
                                    <dd id="displayActivityName">
                                        
                                    </dd>
                                    <dt>
                                        Activity Description
                                    </dt>
                                    <dd id="displayActivityDescription">
                                        
                                    </dd>
                                    <dt>
                                        Activity Skills
                                    </dt>
                                    <dd id="displayActivitySkills">
                                        
                                    </dd>
                                    <dt>
                                        Contact Person
                                    </dt>
                                    <dd id="displayContactPerson">
                                        
                                    </dd>
                                    <dd id="displayContactPersonInfo">
                                        
                                    </dd>
                                    <dt>
                                        Activity Time
                                    </dt>
                                    <dd id="displayStartDateTime">
                                        
                                    </dd>
                                    <dd id="displayEndDateTime">
                                        
                                    </dd>
                                    <dt>
                                        Location
                                    </dt>
                                    <dd id="displayLocation">
                                        
                                    </dd>
                                    <dt>
                                        Criteria
                                    </dt>
                                    <dd id="displayCriteria">
                                        
                                    </dd>
                                    <dt>
                                        Number of Groups
                                    </dt>
                                    <dd id="displayNumberGroups">
                                    </dd>
                                </dl>
                            </div>
                            <div class="form-group clearfix">
                                <div class="col-lg-3 col-lg-offset-5">
                                    <button type="submit" class="btn btn-danger btn-block btn-bordred waves-effect w-md waves-light">Update Activity</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <ul class="pager m-b-0 wizard">
                        <li class="previous first" style="display:none;"><a href="#">First</a>
                        </li>
                        <li class="previous"><a href="#" class="btn btn-primary waves-effect waves-light map">Previous</a></li>
                        <li class="next last" style="display:none;"><a href="#">Last</a></li>
                        <li class="next"><a href="#" id="nexttt" class="btn btn-primary waves-effect waves-light map">Next</a></li>
                    </ul>
                </div>
            </div>
            </form>
        </div>
    </div>
    <!-- END PROGRESSBAR -->
@endsection

@section('additional_scripts')
    <script type="text/javascript">
        var $criteria = "";
        var $critCount = 0;

        @foreach($activity->criteria as $criterion)
            $criteria = $criteria +' '+ "{{ $criterion->criteria }}";
        @endforeach

        $(window).load(function(){
            $('.remove').on('click', function(){
                alert('asdasd');
            });
            //display inputs before creating the activity
            $('#commentForm2').on('keyup keypress click mousemove', function(e){
               $('#displayActivityName').text($('#activityName').val());
               $('#displayActivityDescription').text($('#activityDescription').val());
               var $skills = [];
               $.each($('#activitySkills').val(), function(key,val){
                  $skills = $skills +"  "+val;
               });
               $('#displayActivitySkills').text($skills);
               $('#displayContactPerson').text($('#contactPerson').val());
               $('#displayContactPersonInfo').text($('#contactInfo').val());
               $('#displayStartDateTime').text($('#datepicker-autoclose').val()+' '+$('#timepicker3').val());
               $('#displayEndDateTime').text($('#datepicker-autoclose2').val()+' '+$('#timepicker4').val());
               $('#displayLocation').text($('#pac-input').val());
               console.log($criteria);
               $('#displayCriteria').text($criteria);
               $('#displayNumberGroups').text($('#group').val());
            });
            
            //disables submit form
            $('#commentForm2').on('keyup keypress', function(e){
                var keyCode = e.keyCode || e.which;
                if (keyCode === 13) { 
                  e.preventDefault();
                  return false;
                } 
            });
            
            $('#createActivity').on('click', function(){
               window.location = "{{ url('/') }}";
            });
            
            // adding criteria
            $('#addCriterion').on('click', function (){
                //condition to check if input is not null/empty
                if($("#criteria").val())
                {
                    if($critCount == 0)
                    {
                    $critCount = {{$count}};
                    }
                    else
                    {

                    }
                    $criteria = $criteria +' '+ $("#criteria").val();
                    //var $card = '<div class="panel panel-color panel-inverse" style="margin-bottom=0!important;"><div class="panel-heading"><h3 class="panel-title">'+$('#criteria').val()+'</h3></div></div><input type="text" name="activityCriteria[]" hidden>';
                    var $card = '<div class="row"><div class="col-md-10"><pre class="criteria crit'+$critCount+'">'+$('#criteria').val()+'</pre><input type="text" hidden name="criteria[]" value="'+$('#criteria').val()+'"></div><div class="pull-right col-md-2"><pre class="remove"><center>X</center></pre></div></div>';
                    //add criteria to the list
                    $critCount++;
                    $('#criteriaList').append($card);
                    $('#criteria').val("");
                }
            });


            
            //initialize the multiple select
            $(".select2").select2();
            
            //initialize the spinner
            $("input[name='demo3']").TouchSpin({
                buttondown_class: "btn btn-primary",
                buttonup_class: "btn btn-primary"
            });
            
            //initialize the date picker
            jQuery('#datepicker-autoclose').datepicker({
                autoclose: true,
                todayHighlight: true,
                startDate: new Date()
            }).on('changeDate', function(selected){
                $('#datepicker-autoclose2').prop("disabled", false);
                $('#datepicker-autoclose5').prop("disabled", false);
                var minDate = new Date(selected.date.valueOf());
                $('#datepicker-autoclose2').datepicker('setStartDate', minDate);
                var maxDate = new Date(selected.date.valueOf() - (1000 * 60 * 60 * 24 * 1));
                $('#datepicker-autoclose5').datepicker('setStartDate', new Date());
                $('#datepicker-autoclose5').datepicker('setEndDate', maxDate);
            });

            jQuery('#datepicker-autoclose2').datepicker({
                autoclose: true,
                todayHighlight: true
            });
            
            jQuery('#datepicker-autoclose5').datepicker({
                autoclose: true,
                todayHighlight: true
            });

            //initialize the time picker
            jQuery('#timepicker3').timepicker({
                minuteStep : 1,
                defaultTIme : true
            });
            jQuery('#timepicker4').timepicker({
                minuteStep : 1,
                defaultTIme : true
            });
            jQuery('#timepicker5').timepicker({
                minuteStep : 1,
            });
            
            //initialize the gallery/portfolio
            var $container = $('.portfolioContainer');
            $container.isotope({
                filter: '*',
                animationOptions: {
                    duration: 750,
                    easing: 'linear',
                    queue: false
                }
            });

            $('.portfolioFilter a').click(function(){
                $('.portfolioFilter .current').removeClass('current');
                $(this).addClass('current');

                var selector = $(this).attr('data-filter');
                $container.isotope({
                    filter: selector,
                    animationOptions: {
                        duration: 750,
                        easing: 'linear',
                        queue: false
                    }
                });
                return false;
            });
        });
        $(document).ready(function() {
            $('.image-popup').magnificPopup({
                type: 'image',
                closeOnContentClick: true,
                mainClass: 'mfp-fade',
                gallery: {
                    enabled: true,
                    navigateByImgClick: true,
                    preload: [0,1] // Will preload 0 - before current, and 1 after the current image
                }
            });
        });
        
    </script>
    <!-- SCRIPT FOR FORM WIZZARD -->
    <script type="text/javascript">
        $(document).ready(function() {
            $('#basicwizard').bootstrapWizard({'tabClass': 'nav nav-tabs navtab-wizard nav-justified bg-muted'});

            $('#progressbarwizard').bootstrapWizard({onTabShow: function(tab, navigation, index) {
                var $total = navigation.find('li').length;
                var $current = index+1;
                var $percent = ($current/$total) * 100;
                $('#progressbarwizard').find('.bar').css({width:$percent+'%'});
            },
            'tabClass': 'nav nav-tabs navtab-wizard nav-justified bg-muted'});

            $('#btnwizard').bootstrapWizard({'tabClass': 'nav nav-tabs navtab-wizard nav-justified bg-muted','nextSelector': '.button-next', 'previousSelector': '.button-previous', 'firstSelector': '.button-first', 'lastSelector': '.button-last'});

            var $validator = $("#commentForm2").validate({
                rules: {
                    emailfield: {
                        required: true,
                        email: true,
                        minlength: 3
                    },
                    namefield: {
                        required: true,
                        minlength: 3
                    },
                    urlfield: {
                        required: true,
                        minlength: 3,
                        url: true
                    }
                }
            });

            $('#nexttt').on('click', function(){
                var $valid = $("#commentForm2").valid();
                console.log($("#commentForm2"));
                    if (!$valid) {
                        $validator.focusInvalid();
                        return false;
                    }
            });
            $('#progressbarwizard').bootstrapWizard({
                'tabClass': 'nav nav-tabs navtab-wizard nav-justified bg-muted',
                'onNext': function (tab, navigation, index) {
                    var $valid = $("#commentForm2").valid();
                    if (!$valid) {
                        $validator.focusInvalid();
                        return false;
                    }
                }
            });

            $(".ul").on('click', function(){
                var $valid = $("#commentForm2").valid();
                if (!$valid) {
                    $validator.focusInvalid();
                    return false;
                }
            });

        });

    </script>
    <!-- END SCRIPT FOR FORM WIZZARD -->
    <!-- SCRIPT FOR FILE UPLOAD DROP -->
    <script type="text/javascript">
        $('.dropify').dropify({
            messages: {
                'default': 'Drag and drop a file here or click',
                'replace': 'Drag and drop or click to replace',
                'remove': 'Remove',
                'error': 'Ooops, something wrong appended.'
            },
            error: {
                'fileSize': 'The file size is too big (1M max).'
            }
        });
    </script>
    <!-- END SCRIPT FOR FILE UPLOAD DROP -->
    <!-- SCRIPT FOR MAPS -->
        <script>
      // This example adds a search box to a map, using the Google Place Autocomplete
      // feature. People can enter geographical searches. The search box will return a
      // pick list containing a mix of places and predicted search terms.

      // This example requires the Places library. Include the libraries=places
      // parameter when you first load the API. For example:
      // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">
      var map;
      var myLatLng = {lat:parseFloat({{$activity->lat}}),lng:parseFloat({{$activity->long}})};
      function initAutocomplete() {
         map = new google.maps.Map(document.getElementById('map'), {
          center: myLatLng,
          zoom: 16,
          minZoom: 1,
          mapTypeId: 'roadmap'
        });

        
        
        // Create the search box and link it to the UI element.
        var input = document.getElementById('pac-input');
        var searchBox = new google.maps.places.SearchBox(input);
        //map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

        // Bias the SearchBox results towards current map's viewport.
        map.addListener('bounds_changed', function() {
          searchBox.setBounds(map.getBounds());
        });

        var markers = [];
        // Listen for the event fired when the user selects a prediction and retrieve
        // more details for that place.
        searchBox.addListener('places_changed', function() {
          var places = searchBox.getPlaces();

          if (places.length == 0) {
            return;
          }

          // Clear out the old markers.
          markers.forEach(function(marker) {
            marker.setMap(null);
          });
          markers = [];

          // For each place, get the icon, name and location.
          var bounds = new google.maps.LatLngBounds();
          places.forEach(function(place) {
            if (!place.geometry) {
              console.log("Returned place contains no geometry");
              return;
            }
            var icon = {
              url: place.icon,
              size: new google.maps.Size(71, 71),
              origin: new google.maps.Point(0, 0),
              anchor: new google.maps.Point(17, 34),
              scaledSize: new google.maps.Size(25, 25)
            };
            

            if (place.geometry.viewport) {
              // Only geocodes have viewport.
              bounds.union(place.geometry.viewport);
            } else {
              bounds.extend(place.geometry.location);
            }
          });
          map.fitBounds(bounds);
        });
        
        
        
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

        placeMarker(myLatLng);
        google.maps.event.addListener(map, 'click', function(event) {
          placeMarker(event.latLng);
          //input x ang long y ang lat
          $('#long').val(event.latLng.lng());
          $('#lat').val(event.latLng.lat());
          console.log($('#long').val());
          console.log($('#lat').val());
        });
      }

    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAh9Zof4j3ivJSWjB_YEnAvDsCjwr8h978&libraries=places&callback=initAutocomplete"
         async defer></script>
    <!-- END SCRIPT FOR MAPS -->
    <!-- Form wizard -->
    <script src="{{ asset('adminitoAssets/assets/plugins/bootstrap-wizard/jquery.bootstrap.wizard.js').'?'.rand() }}"></script>
    <script src="{{ asset('adminitoAssets/assets/plugins/jquery-validation/dist/jquery.validate.min.js') }}"></script>
@endsection