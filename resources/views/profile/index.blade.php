@extends('layouts.hybridMaster')

@section('page_title')
    Profile
@endsection
@section('additional_styles')
    <style>
       #map {
        height: 400px;
        width: 100%;
       }
    </style>
@endsection

@section('content')
<div class="row">
    <div class="col-md-6">
        <div class="text-center card-box">
            <div>
                <img src="{{ \Auth::user()->foundation->image_url }}" class="img-circle img-thumbnail m-b-10" alt="profile-image" style="height: 200px;width: 200px;">

                <p class="text-muted font-13 m-b-30" style="color:black !important; padding-top: 10px;">
                    {{ \Auth::user()->foundation->description }}
                </p>

                <div class="text-left">
                    <p class="text-muted font-13" style="color:black !important"><strong>Foundation :</strong> <span class="m-l-15">{{ \Auth::user()->name }}</span></p>

                    <p class="text-muted font-13" style="color:black !important"><strong>Email :</strong><span class="m-l-15">{{ \Auth::user()->email }}</span></p>

                    <p class="text-muted font-13" style="color:black !important"><strong>Location :</strong> <span class="m-l-15">{{ \Auth::user()->foundation->location }}</span></p>
                    @if(\Auth::user()->foundation->facebook_url)
                    <p class="text-muted font-13" style="color:black !important"><strong>Facebook :</strong> <span class="m-l-15">{{ \Auth::user()->foundation->facebook_url }}</span></p>
                    @endif
                    @if(\Auth::user()->foundation->facebook_url)
                    <p class="text-muted font-13" style="color:black !important"><strong>Website :</strong> <span class="m-l-15">{{ \Auth::user()->foundation->website_url }}</span></p>
                    @endif
                </div>
                <div id="map"></div>
                <br>
                <button type="button" class="btn btn-custom btn-rounded waves-effect waves-light">Edit Profile</button>
            </div>

        </div>

    </div>                     
</div>
@endsection

@section('additional_scripts')
    <script>
      function initMap() {
        var uluru = {lat: -25.363, lng: 131.044};
        var map = new google.maps.Map(document.getElementById('map'), {
            center: {lat:parseFloat({{ \Auth::user()->foundation->lat }}), lng: parseFloat({{ \Auth::user()->foundation->long }}) },
            zoom: 16,
            minZoom: 1,
            mapTypeId: 'roadmap'
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
        var myLatLng = {lat:parseFloat({{\Auth::user()->foundation->lat}}),lng:parseFloat({{\Auth::user()->foundation->long}})};
        placeMarker(myLatLng);
      }
    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAh9Zof4j3ivJSWjB_YEnAvDsCjwr8h978&callback=initMap">
    </script>
@endsection