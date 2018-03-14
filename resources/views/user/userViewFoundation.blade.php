@extends('layouts.horizontalMaster')

@section('title')
@endsection

@section('additional_styles')
        <style type="text/css">
            .card {
                overflow: hidden;
                padding: 0;
                border: none;
                border-radius: .28571429rem;
                box-shadow: 0 1px 3px 0 #d4d4d5, 0 0 0 1px #d4d4d5;
            }

            .card-block {
                position: relative;
                margin: 0;
                padding: 1em;
                border: none;
                border-top: 1px solid rgba(34, 36, 38, .1);
                box-shadow: none;
            }

            .card-img-top {
                display: block;
                width: 100%;
                height: 220px;
                object-fit: cover;
            }

            .card-title {
                font-size: 1.28571429em;
                font-weight: 700;
                line-height: 1.2857em;
            }

            .card-footer {
                font-size: 1em;
                position: static;
                top: 0;
                left: 0;
                max-width: 100%;
                padding: .75em 1em;
                color: rgba(0, 0, 0, .4);
                border-top: 1px solid rgba(0, 0, 0, .05) !important;
                background: #fff;
            }

            .profile {
                position: absolute;
                top: -12px;
                display: inline-block;
                overflow: hidden;
                box-sizing: border-box;
                width: 25px;
                height: 25px;
                margin: 0;
                border: 1px solid #fff;
                border-radius: 50%;
            }

            .profile-avatar {
                display: block;
                width: 100%;
                height: auto;
                border-radius: 50%;
            }
                   #map {
        height: 400px;
        width: 100%;
       }
        </style>
@endsection

@section('page_title')
@endsection

@section('content')
                <br>
                <div class="row">
                    <div class="col-md-2">
                        <img src="{{ $user->foundation->image_url }}" class="img-responsive" style="height: 250px; width: 250px; object-fit: cover;">
                    </div>
                    <div class="col-md-8">
                        <h1>{{ $user->name }}</h1>
                        <h5>Email: {{ $user->foundation->email }}</h5>
                        <br>
                        <p>{{ $user->foundation->description }}</p>
                    </div>
                    <div class="col-md-2">
                        <button class="btn pull-right" style="margin-top: 10px;">View Portfolio</button> <!-- background color sa ethelon nya color sa text #fafafa -->
                    </div>
                </div>
                <br>
                <div class="row" style="padding: 10px;">                    
                    <div class="col-md-12" style="padding-left: 0px;">
                        <h4 class="page-title">Location</h4>
                        <span style="font-size: 14px;"><span class="fa fa-map-marker fa-fw">&nbsp;</span>{{ $user->foundation->location }}</span>
                        <br><br>
                        
                    </div>
                </div>
                <div id="map">
                        </div>
                <div class="row">
                	<div class="col-md-12">
                	<h4 class="page-title">Activities</h4>
                </div>
                </div>

                <div class="row" style="margin-left: 0px; margin-right: 0px;">
                	@foreach($user->foundation->activities as $activity)
                    <div class="col-md-2">
                        <div class="card">
                            <img class="card-img-top" src="{{ $activity->image_url }}"> <!-- pic sa activity -->
                            <div class="card-block">
                                <h4>{{ $activity->name }}</h4>
                                <p>{{ $activity->description }}...</p>
                            </div>
                            <div class="card-footer">
                                <small>Date created: {{ $activity->created_at }}</small> <!-- date created sa activity (if naa mo ani) -->
                                <button type="button" class="btn btn-secondary pull-right btn-sm view" value="{{ $activity->activity_id }}" style="margin-top: -5px;">view</button>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

            </div>
@endsection

@section('additional_scripts')
    <script>
      function initMap() {
        var myLatLng = {lat:parseFloat({{$user->foundation->lat}}),lng:parseFloat({{$user->foundation->long}})};
        var map = new google.maps.Map(document.getElementById('map'), {
            center: myLatLng,
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

        placeMarker(myLatLng);
      }
    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAh9Zof4j3ivJSWjB_YEnAvDsCjwr8h978&callback=initMap">
    </script>

    <script>
        $(document).ready(function(){
            $(".view").on('click', function(){
                window.location = "{{ url('/activity/view') }}"+"/"+$(this).val();
            });
        });
    </script>
@endsection