<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
        <meta name="author" content="Coderthemes">

        <!-- App Favicon -->
        <link rel="shortcut icon" href="{{ asset('adminitoAssets/assets/images/favicon.ico') }}">

        <!-- App titlee -->
        <title>Ethelon</title>

        <!-- form Uploads -->
        <link href="{{ asset('adminitoAssets/assets/plugins/fileuploads/css/dropify.min.css') }}" rel="stylesheet" type="text/css" />

        <!-- App CSS -->
        <link href="{{ asset('adminitoAssets/assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('adminitoAssets/assets/css/core.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('adminitoAssets/assets/css/components.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('adminitoAssets/assets/css/icons.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('adminitoAssets/assets/css/pages.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('adminitoAssets/assets/css/menu.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('adminitoAssets/assets/css/responsive.css') }}" rel="stylesheet" type="text/css" />

        <!-- HTML5 Shiv and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->

        <script src="{{ asset('adminitoAssets/assets/js/modernizr.min.js') }}"></script>
        <style>
            #map 
            {
                height: 100%;
            }
        </style>
    </head>
    <body>
        <form class="form-horizontal" method="POST" action="{{ route('register') }}" enctype="multipart/form-data"s>
        {{ csrf_field() }}
        <input type="text" name="lat" id="lat" hidden>
        <input type="text" name="long" id="long" hidden>
        <div class="clearfix"></div>
        <div class="wrapper-page">
            <div class="text-center">
                <a href="index.html" class="logo"><span>Ethelon</span></a>
                <h5 class="text-muted m-t-0 font-600"></h5>
            </div>
            <div class="m-t-40 card-box">
                <div class="text-center">
                    <h4 class="text-uppercase font-bold m-b-0">Register</h4>
                </div>
                <div class="panel-body">

                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <div class="col-xs-12">
                            <input class="form-control" type="email" required="" name="email" placeholder="Email">
                        </div>
                        @if ($errors->has('email'))
                        <center>
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        </center>
                        @endif
                    </div>

                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                        <div class="col-xs-12">
                            <input class="form-control" type="text" required="" name="name" placeholder="Foundation Name">
                        </div>
                        @if ($errors->has('name'))
                        <center>
                            <span class="help-block">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        </center>
                        @endif
                    </div>

                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        <div class="col-xs-12">
                            <input class="form-control" type="password" required="" name="password" placeholder="Password">
                        </div>
                        @if ($errors->has('password'))
                        <center>
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        </center>
                        @endif
                    </div>

                    <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                        <div class="col-xs-12">
                            <input class="form-control" type="password" required="" name="password_confirmation" placeholder="Confirm Password">
                        </div>
                        @if ($errors->has('password_confirmation'))
                        <center>
                            <span class="help-block">
                                <strong>{{ $errors->first('password_confirmation') }}</strong>
                            </span>
                        </center>
                        @endif
                    </div>

                    <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
                        <div class="col-xs-12">
                            <label class="control-label " for="contactPerson">Foundation Logo</label>
                            <input class="form-control dropify" type="file" required="" name="image" data-height="250" />
                        </div>
                        @if ($errors->has('image'))
                        <center>
                            <span class="help-block">
                                <strong>{{ $errors->first('image') }}</strong>
                            </span>
                        </center>
                        @endif
                    </div>

                    <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                        <div class="col-xs-12">
                            <textarea class="form-control" placeholder="description" name="description" style="resize: none;"></textarea>
                        </div>
                        @if ($errors->has('description'))
                        <center>
                            <span class="help-block">
                                <strong>{{ $errors->first('description') }}</strong>
                            </span>
                        </center>
                        @endif
                    </div>

                    <div class="form-group{{ $errors->has('location') ? ' has-error' : '' }}">
                        <div class="col-xs-12">
                            <input class="form-control" type="text" id="pac-input" required="" name="location" placeholder="Location">
                        </div>
                        @if ($errors->has('location'))
                        <center>
                            <span class="help-block">
                                <strong>{{ $errors->first('location') }}</strong>
                            </span>
                        </center>
                        @endif
                    </div>

                    <div class="form-group">
                        <div class="col-xs-12">
                            <div id="map" style="height:250px"></div>
                        </div>
                    </div>
                    <input type="text" name="lat" hidden>
                    <input type="text" name="long" hidden>

                    <div class="form-group">
                        <div class="col-xs-12">
                            <input class="form-control" type="text" name="websiteUrl" placeholder="Website Url">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-xs-12">
                            <input class="form-control" type="text" name="facebookUrl" placeholder="Facebook Url">
                        </div>
                    </div>
                    

                    <div class="form-group text-center m-t-40">
                        <div class="col-xs-12">
                            <button class="btn btn-danger btn-bordred btn-block waves-effect waves-light" type="submit">
                                Register
                            </button>
                        </div>
                    </div>

                </div>
            </div>
            <!-- end card-box -->

            <div class="row">
                <div class="col-sm-12 text-center">
                    <p class="text-muted" style="color:black !important;">Already have account?<a href="{{ route('login') }}" class="text-primary m-l-5"><b style="color:red !important;">Sign In</b></a></p>
                </div>
            </div>

        </div>
        <!-- end wrapper page -->
        </form>



        <script>
            var resizefunc = [];
        </script>
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
          center: {lat: 40.397, lng: 180.644},
          zoom: 1,
          minZoom: 1,
          mapTypeId: 'roadmap'
        });
        console.log(map.map);
        
        
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
          console.log(event.latLng.lng());
          console.log(event.latLng.lat());
          $('#long').val(event.latLng.lng());
          $('#lat').val(event.latLng.lat());
          console.log($('#long').val());
          console.log($('#lat').val());
        });
      }

    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAh9Zof4j3ivJSWjB_YEnAvDsCjwr8h978&libraries="
         async defer></script>
    <!-- END SCRIPT FOR MAPS -->

        <!-- jQuery  -->
        <script src="{{ asset('adminitoAssets/assets/js/jquery.min.js') }}"></script>
        <script src="{{ asset('adminitoAssets/assets/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('adminitoAssets/assets/js/detect.js') }}"></script>
        <script src="{{ asset('adminitoAssets/assets/js/fastclick.js') }}"></script>
        <script src="{{ asset('adminitoAssets/assets/js/jquery.slimscroll.js') }}"></script>
        <script src="{{ asset('adminitoAssets/assets/js/jquery.blockUI.js') }}"></script>
        <script src="{{ asset('adminitoAssets/assets/js/waves.js') }}"></script>
        <script src="{{ asset('adminitoAssets/assets/js/wow.min.js') }}"></script>
        <script src="{{ asset('adminitoAssets/assets/js/jquery.nicescroll.js') }}"></script>
        <script src="{{ asset('adminitoAssets/assets/js/jquery.scrollTo.min.js') }}"></script>

        <!-- file uploads js -->
        <script src="{{ asset('adminitoAssets/assets/plugins/fileuploads/js/dropify.min.js') }}"></script>

        <!-- App js -->
        <script src="{{ asset('adminitoAssets/assets/js/jquery.core.js') }}"></script>
        <script src="{{ asset('adminitoAssets/assets/js/jquery.app.js') }}"></script>

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

    </body>
</html>