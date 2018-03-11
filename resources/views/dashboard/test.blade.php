@extends('layouts.hybridMaster')

@section('additional_styles')
<style>
    #map {
        height: 100%;
    }
</style>
@endsection

@section('content')
    <!-- PROGRESSBAR WIZARD -->
    
    <div class="col-lg-7 col-md-offset-2">
        <div class="card-box p-b-0">
            
            <div class="dropdown pull-right">
                <a href="#" class="dropdown-toggle card-drop" data-toggle="dropdown" aria-expanded="false">
                    <i class="zmdi zmdi-more-vert"></i>
                </a>
                <ul class="dropdown-menu" role="menu">
                    <li><a href="#">Action</a></li>
                    <li><a href="#">Another action</a></li>
                    <li><a href="#">Something else here</a></li>
                    <li class="divider"></li>
                    <li><a href="#">Separated link</a></li>
                </ul>
            </div>

            <h4 class="header-title m-t-0 m-b-30">Wizard With Progress Bar</h4>
            <form id="commentForm2" method="get" action="">
                
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
                                <input  name="activityName" type="text" class="required form-control" placeholder="">
                            </div>
                            
                            <div class="form-group col-lg-8 col-lg-offset-2">
                                <label class="control-label " for="file">Picture</label>
                                <input type="file" class="dropify form-control" name="file" data-height="300" required="required" />
                            </div>
                            
                            <div class="form-group col-lg-8 col-lg-offset-2">
                                <label class="control-label " for="activityDescription">Description</label>
                                <textarea class="required form-control" name="activityDescription" rows="10" style="resize: none;"></textarea>
                            </div>

                            <div class="form-group col-lg-8 col-lg-offset-2">
                                <label class="control-label " for="activitySkills">Skills</label>
                                <select class="select2 select2-multiple required" name="activitySkills" multiple="multiple" multiple data-placeholder="">
                                    <option value="AL">Environment</option>
                                    <option value="AR">Livelihood</option>
                                    <option value="IL">Education</option>
                                    <option value="IA">Charity</option>
                                    <option value="KS">Sports</option>
                                    <option value="KY">Culinary</option>
                                    <option value="LA">Medicine</option>
                                    <option value="MN">Arts</option>
                                </select>
                            </div>
                            
                            <div class="form-group col-lg-8 col-lg-offset-2">
                                <div class="col-lg-6" style="padding-left: 0;">
                                    <label class="control-label " for="contactPerson">Contact Person</label>
                                    <input  name="contactPerson" type="text" class="required form-control" placeholder="">
                                </div>
                                <div class="col-lg-6" style="padding: 0;">
                                    <label class="control-label " for="contactNumber">Contact Number</label>
                                    <input  name="contactNumber" type="text" class="required form-control" placeholder="">
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    <div class="tab-pane p-t-10 fade" id="second">
                        <div class="row">
                            <div class="form-group col-lg-8 col-lg-offset-2">
                                <div class="col-lg-6" style="padding-left: 0;">
                                    <label class="control-label " for="startDate">Start Date</label>
                                    <input type="text" class=" required form-control" placeholder="mm/dd/yyyy" id="datepicker-autoclose" name="startDate">
                                </div>
                                <div class="col-lg-6" style="padding: 0;">
                                    <label class="control-label " for="startTime">Start Time</label>
                                    <div class="bootstrap-timepicker">
                                        <input id="timepicker3" name="startTime" type="text" class="required form-control">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group col-lg-8 col-lg-offset-2">
                                <div class="col-lg-6" style="padding-left: 0;">
                                    <label class="control-label " for="endDate">End Date</label>
                                    <input type="text" class=" required form-control" placeholder="mm/dd/yyyy" id="datepicker-autoclose2" name="endDate">
                                </div>
                                <div class="col-lg-6" style="padding: 0;">
                                    <label class="control-label " for="endTime">End Time</label>
                                    <div class="bootstrap-timepicker">
                                        <input id="timepicker4" name="endTime" type="text" class="required form-control">
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-group col-lg-8 col-lg-offset-2" id="mapWindow">
                                <label class="control-label " for="activityLocation">Location</label>
                                <div id="locationField">
                                    <input name="activityLocation" type="text" id="pac-input" class="required form-control" placeholder="">
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
                                
                            </div>
                            <div class="form-group col-lg-8 col-lg-offset-2">
                                <label class="control-label " for="activityName">Number of Groups</label>
                                <input  name="activityName" type="text" class="required form-control" placeholder="">
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane p-t-10 fade" id="fourth">
                        <div class="row">
                            <div class="form-group clearfix">
                                <div class="col-lg-3">
                                    <button type="submit" class="btn btn-default">Create Activity</button>
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
        $(window).load(function(){
            
            console.log('ambot');
            $('#createActivity').on('click', function(){
               window.location = "{{ url('/') }}";
            });
            
            $('#addCriterion').on('click', function (){
                //condition to check if input is not null/empty
                if($("#criteria").val() != null)
                {
                    //var $card = '<div class="panel panel-color panel-inverse" style="margin-bottom=0!important;"><div class="panel-heading"><h3 class="panel-title">'+$('#criteria').val()+'</h3></div></div><input type="text" name="activityCriteria[]" hidden>';
                    var $card = '<pre>'+$('#criteria').val()+'</pre>';
                    //add criteria to the list
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
                todayHighlight: true
            });
            jQuery('#datepicker-autoclose2').datepicker({
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
      function initAutocomplete() {
         map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: -33.8688, lng: 151.2195},
          zoom: 13,
          mapTypeId: 'roadmap'
        });
        google.maps.event.trigger(map, 'resize');

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
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAh9Zof4j3ivJSWjB_YEnAvDsCjwr8h978&libraries=places&callback=initAutocomplete"
         async defer></script>
    <!-- END SCRIPT FOR MAPS -->
@endsection