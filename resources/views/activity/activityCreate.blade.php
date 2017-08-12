@extends('layouts.master')

@section('additional_styles')
  <link rel="stylesheet" href="{{ asset('reactorAssets/styles/webfont.css').'?'.rand() }}">
  <link rel="stylesheet" href="{{ asset('reactorAssets/styles/climacons-font.css').'?'.rand() }}">
  <link rel="stylesheet" href="{{ asset('reactorAssets/vendor/bootstrap/dist/css/bootstrap.css').'?'.rand() }}">
  <link rel="stylesheet" href="{{ asset('reactorAssets/styles/font-awesome.css').'?'.rand() }}">
  <link rel="stylesheet" href="{{ asset('reactorAssets/styles/card.css').'?'.rand() }}">
  <link rel="stylesheet" href="{{ asset('reactorAssets/styles/sli.css').'?'.rand() }}">
  <link rel="stylesheet" href="{{ asset('reactorAssets/styles/animate.css').'?'.rand() }}">
  <link rel="stylesheet" href="{{ asset('reactorAssets/styles/app.css').'?'.rand() }}">
  <link rel="stylesheet" href="{{ asset('reactorAssets/styles/app.skins.css').'?'.rand() }}">
    <!-- page stylesheets -->
    <link rel="stylesheet" href="{{ asset('reactorAssets/vendor/bootstrap3-wysihtml5-bower/dist/bootstrap3-wysihtml5.min.css') }}">
    <link rel="stylesheet" href="{{ asset('reactorAssets/vendor/summernote/dist/summernote.css') }}">
    <!-- end page stylesheets -->
    <link rel="stylesheet" href="{{ asset('reactorAssets/vendor/blueimp-file-upload/css/jquery.fileupload.css') }}">
    <link rel="stylesheet" href="{{ asset('reactorAssets/vendor/blueimp-file-upload/css/jquery.fileupload-ui.css') }}">
    <!-- page stylesheets -->
    <link rel="stylesheet" href="{{ asset('reactorAssets/vendor/chosen_v1.4.0/chosen.min.css') }}">
    <link rel="stylesheet" href="{{ asset('reactorAssets/vendor/jquery.tagsinput/src/jquery.tagsinput.css') }}">
    <link rel="stylesheet" href="{{ asset('reactorAssets/vendor/checkbo/src/0.1.4/css/checkBo.min.css') }}">
    <link rel="stylesheet" href="{{ asset('reactorAssets/vendor/intl-tel-input/build/css/intlTelInput.css') }}">
    <link rel="stylesheet" href="{{ asset('reactorAssets/vendor/bootstrap-daterangepicker/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('reactorAssets/vendor/bootstrap-datepicker/dist/css/bootstrap-datepicker3.css') }}">
    <link rel="stylesheet" href="{{ asset('reactorAssets/vendor/clockpicker/dist/bootstrap-clockpicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('reactorAssets/vendor/mjolnic-bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('reactorAssets/vendor/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.css') }}">
    <link rel="stylesheet" href="{{ asset('reactorAssets/vendor/jquery-labelauty/source/jquery-labelauty.css') }}">
    <link rel="stylesheet" href="{{ asset('reactorAssets/vendor/multiselect/css/multi-select.css') }}">
    <link rel="stylesheet" href="{{ asset('reactorAssets/vendor/ui-select/dist/select.css') }}">
    <link rel="stylesheet" href="{{ asset('reactorAssets/vendor/select2/dist/css/select2.css') }}">
    <link rel="stylesheet" href="{{ asset('reactorAssets/vendor/selectize/dist/css/selectize.css') }}">
    <!-- end page stylesheets -->
    <!-- page stylesheets -->
    <link rel="stylesheet" href="{{ asset('reactorAssets/vendor/chosen_v1.4.0/chosen.min.css') }}">
    <link rel="stylesheet" href="{{ asset('reactorAssets/vendor/checkbo/src/0.1.4/css/checkBo.min.css') }}">
    <!-- end page stylesheets -->
    <style>
              #map {
        height: 100%;
      }
    </style>
@endsection
@section('content')
<div class="container"> 
            <header class="clearfix">
                <h1>Activity <span>with Expanding Preview</span></h1> 
            </header>
<form class="form-horizontal" role="form" action="{{ url('/activity/store') }}" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Activity Name</label>
                                <div class="col-sm-10">
                                    <div class="row">
                                        <div class="col-xs-9">
                                            <input type="text" class="form-control" name="activityName" required="required">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        
                        
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Activity Skills</label>
                                <div class="col-sm-10">
                                    <div class="row">
                                        <div class="col-xs-9">
                                            <select data-placeholder=" " multiple class="chosen" style="width: 100%;" name="activitySkills[]" required="required">
                                                <option>Environmental</option>
                                                <option>Culinary</option>
                                                <option>Sports</option>
                                                <option>Education</option>
                                                <option>Charity</option>
                                                <option>Livelyhood</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        
                        
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Activity Banner</label>
                                <div class="col-sm-10">
                                    <span class="btn btn-danger fileinput-button">
                                        <i class="icon-plus"></i>
                                        <span>Add files...</span>
                                        <input type="file" name="file" multiple>
                                    </span>
                                </div>
                            </div>
                        
                        
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Activity Description</label>
                                <div class="col-sm-10">
                                    <div class="row">
                                        <div class="col-xs-9">
                                            <textarea class="bootstrap-wysiwyg" placeholder="" name="activityDescription" required="required"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                    <div class="form-group">
                    <label class="col-sm-2 control-label">Number of volunteers</label>
                    </div>
       
        <div class="form-group">
            <label class="col-sm-2 control-label">Start Date/Time</label>
                <div class="col-sm-10">
                    <div class="row">
                        <div class="col-xs-9">
                        <div class='input-group date' id='datetimepicker1'>
                            <input type='text' class="form-control" />
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="form-group">
            <label class="col-sm-2 control-label">End Date/Time</label>
                <div class="col-sm-10">
                    <div class="row">
                        <div class="col-xs-9">
                        <div class='input-group date' id='datetimepicker1'>
                            <input type='text' class="form-control" />
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
    <div class="form-group">
        <label class="col-sm-2 control-label">Location</label>
            <div class="col-sm-10">
                <div class="row">
                    <div class="col-xs-9">
                    <!-- diri ang map -->
                    <div id="map" style="height:500px">
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
        
    <!-- hidden input diri para long lat sa maps -->
    <input type="text" id="long" name="long" hidden="hidden">
    <input type="text" id="lat" name="lat" hidden="hidden">
    
    <button type="submit" class="btn btn-danger btn-lg btn-icon mr5"><i class="icon-plus"></i><span>Create Event</span></button>
</form>
    </div>

@endsection

@section('additional_scripts')
   <script src="{{ asset('reactorAssets/scripts/helpers/modernizr.js') }}"></script>
    <script src="{{ asset('reactorAssets/vendor/jquery/dist/jquery.js') }}"></script>
    <script src="{{ asset('reactorAssets/vendor/bootstrap/dist/js/bootstrap.js') }}"></script>
    <script src="{{ asset('reactorAssets/vendor/fastclick/lib/fastclick.js') }}"></script>
    <script src="{{ asset('reactorAssets/vendor/perfect-scrollbar/js/perfect-scrollbar.jquery.js') }}"></script>
    <script src="{{ asset('reactorAssets/scripts/helpers/smartresize.js') }}"></script>
    <script src="{{ asset('reactorAssets/scripts/constants.js') }}"></script>
    <script src="{{ asset('reactorAssets/scripts/main.js') }}"></script>
    <!-- page scripts -->
    <script src="{{ asset('reactorAssets/vendor/chosen_v1.4.0/chosen.jquery.min.js') }}"></script>
    <script src="{{ asset('reactorAssets/vendor/jquery.tagsinput/src/jquery.tagsinput.js') }}"></script>
    <script src="{{ asset('reactorAssets/vendor/checkbo/src/0.1.4/js/checkBo.min.js') }}"></script>
    <script src="{{ asset('reactorAssets/vendor/intl-tel-input//build/js/intlTelInput.min.js') }}"></script>
    <script src="{{ asset('reactorAssets/vendor/moment/min/moment.min.js') }}"></script>
    <script src="{{ asset('reactorAssets/vendor/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ asset('reactorAssets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js') }}"></script>
    <script src="{{ asset('reactorAssets/vendor/bootstrap-timepicker/js/bootstrap-timepicker.js') }}"></script>
    <script src="{{ asset('reactorAssets/vendor/clockpicker/dist/jquery-clockpicker.min.js') }}"></script>
    <script src="{{ asset('reactorAssets/vendor/mjolnic-bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js') }}"></script>
    <script src="{{ asset('reactorAssets/vendor/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.js') }}"></script>
    <script src="{{ asset('reactorAssets/vendor/select2/dist/js/select2.js') }}"></script>
    <script src="{{ asset('reactorAssets/vendor/selectize/dist/js/standalone/selectize.min.js') }}"></script>
    <script src="{{ asset('reactorAssets/vendor/jquery-labelauty/source/jquery-labelauty.js') }}"></script>
    <script src="{{ asset('reactorAssets/vendor/bootstrap-maxlength/src/bootstrap-maxlength.js') }}"></script>
    <script src="{{ asset('reactorAssets/vendor/typeahead.js/dist/typeahead.bundle.js') }}"></script>
    <script src="{{ asset('reactorAssets/vendor/multiselect/js/jquery.multi-select.js') }}"></script>
    <!-- end page scripts -->
    <!-- initialize page scripts -->
    <script src="{{ asset('reactorAssets/scripts/forms/plugins.js') }}"></script>
    <!-- end initialize page scripts -->
    <!-- page scripts -->
    <script src="{{ asset('reactorAssets/vendor/chosen_v1.4.0/chosen.jquery.min.js') }}"></script>
    <script src="{{ asset('reactorAssets/vendor/card/lib/js/jquery.card.js') }}"></script>
    <script src="{{ asset('reactorAssets/vendor/jquery-validation/dist/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('reactorAssets/vendor/checkbo/src/0.1.4/js/checkBo.min.js') }}"></script>
    <script src="{{ asset('reactorAssets/vendor/twitter-bootstrap-wizard/jquery.bootstrap.wizard.min.js') }}"></script>
    <!-- end page scripts -->
    <!-- initialize page scripts -->
    <script src="{{ asset('reactorAssets/scripts/forms/wizard.js') }}"></script>
    <!-- end initialize page scripts -->
    <!-- The jQuery UI widget factory, can be omitted if jQuery UI is already included -->
    <script src="{{ asset('reactorAssets/vendor/jquery.ui/ui/core.js') }}"></script>
    <script src="{{ asset('reactorAssets/vendor/jquery.ui/ui/widget.js') }}"></script>
    <script src="{{ asset('reactorAssets/vendor/jquery.ui/ui/mouse.js') }}"></script>
    <script src="{{ asset('reactorAssets/vendor/jquery.ui/ui/draggable.js') }}"></script>
    <script src="{{ asset('reactorAssets/vendor/blueimp-file-upload/js/jquery.iframe-transport.js') }}"></script>
    <!-- The basic File Upload plugin -->
    <script src="{{ asset('reactorAssets/vendor/blueimp-file-upload/js/jquery.fileupload.js') }}"></script>
    <!-- The File Upload processing plugin -->
    <script src="{{ asset('reactorAssets/vendor/blueimp-file-upload/js/jquery.fileupload-process.js') }}"></script>
    <!-- The File Upload image preview & resize plugin -->
    <script src="{{ asset('reactorAssets/vendor/blueimp-file-upload/js/jquery.fileupload-image.js') }}"></script>
    <!-- The File Upload audio preview plugin -->
    <script src="{{ asset('reactorAssets/vendor/blueimp-file-upload/js/jquery.fileupload-audio.js') }}"></script>
    <!-- The File Upload video preview plugin -->
    <script src="{{ asset('reactorAssets/vendor/blueimp-file-upload/js/jquery.fileupload-video.js') }}"></script>
    <!-- The File Upload validation plugin -->
    <script src="{{ asset('reactorAssets/vendor/blueimp-file-upload/js/jquery.fileupload-validate.js') }}"></script>
    <!-- The File Upload user interface plugin -->
    <script src="{{ asset('reactorAssets/vendor/blueimp-file-upload/js/jquery.fileupload-ui.js') }}"></script>
    <!-- end page scripts -->
    <!-- initialize page scripts -->
    <script src="{{ asset('reactorAssets/scripts/forms/upload.js') }}"></script>
    <!-- end initialize page scripts -->
    <!-- page scripts -->
    <script src="{{ asset('reactorAssets/vendor/bootstrap3-wysihtml5-bower/dist/bootstrap3-wysihtml5.all.min.js') }}"></script>
    <script src="{{ asset('reactorAssets/vendor/summernote/dist/summernote.min.js') }}"></script>
    <!-- end page scripts -->
    <!-- initialize page scripts -->
    <script src="{{ asset('reactorAssets/scripts/forms/wysiwyg.js') }}"></script>
    <!-- end initialize page scripts -->
    <script>
      // Note: This example requires that you consent to location sharing when
      // prompted by your browser. If you see the error "The Geolocation service
      // failed.", it means you probably did not give permission for the browser to
      // locate you.
      var map, infoWindow;
      function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: -34.397, lng: 150.644},
          zoom: 18
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
          console.log(event.da.x);
          console.log(event.da.y);
          $('#long').val(event.da.x);
          $('#lat').val(event.da.y);
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