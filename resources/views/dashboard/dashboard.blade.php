@extends('layouts.master')

@section('content')
      <div class="sidebar" data-color="red" data-image="{{ asset('assets/img/sidebar-1.jpg') }}">
          <!--
              Tip 1: You can change the color of the sidebar using: data-color="purple | blue | green | orange | red"

              Tip 2: you can also add an image using data-image tag
          -->

          <div class="logo">
              <a href="http://www.creative-tim.com" class="simple-text">
                  Ethelon
              </a>
          </div>

          <div class="sidebar-wrapper">
              <ul class="nav">
                  <li class="active">
                      <a href="{{ url('/') }}">
                          <i class="material-icons">dashboard</i>
                          <p>Dashboard</p>
                      </a>
                  </li>
                  <li>
                      <a href="{{ url('/activity') }}">
                          <i class="material-icons">content_paste</i>
                          <p>Activity</p>
                      </a>
                  </li>
                  <li>
                      <a href="{{ url('/profile') }}">
                          <i class="material-icons">person</i>
                          <p>Profile</p>
                      </a>
                  </li>
                  <li>
                      <a href="maps.html">
                          <i class="material-icons">location_on</i>
                          <p>Maps</p>
                      </a>
                  </li>
                  <li>
                      <a href="notifications.html">
                          <i class="material-icons text-gray">notifications</i>
                          <p>Notifications</p>
                      </a>
                  </li>
              </ul>
          </div>
      </div>

		<div class="main-panel">
		@include('layouts.navbar')
		<div class="row">

			
		</div>
        <div id="map">
        </div>
@endsection
@section('additional_scripts')
	
<!--  Google Maps Plugin    -->
	<script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBOCcWF3iyBm1ExL9-pT5_oT57gQCHajmw&callback=initMap">
    </script>
    <script>
        $().ready(function(){
            demo.initGoogleMaps();
        });
    </script>
@endsection
