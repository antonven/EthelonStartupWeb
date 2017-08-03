@extends('layouts.master')

@section('additionalScripts')
    
@endsection

@section('sidebar')
    @include('reactor_includes.sidebar')
@endsection

@section('topheader')
    @include('reactor_includes.topheader')
@endsection


@section('content')
    <div class="page-title">
        <div class="title">Activities</div>
    </div>
    <div class="m-b clearfix">
        <button id="newActivity" type="button" class="btn btn-default"><i class="fa fa-plus"></i>&nbsp;New Activity</button>
      <div class="pull-right">
        <button type="button" class="btn btn-default">
          <i class="icon-settings"></i>
        </button>
        <div class="btn-group">
          <button type="button" class="btn btn-default">
            <i class="icon-arrow-left"></i>
          </button>
          <button type="button" class="btn btn-default">
            <i class="icon-arrow-right"></i>
          </button>
        </div>
      </div>
    </div>
    <div class="row">
        @foreach($activities as $activity)
        <div class="col-md-3">
            <div class="card-group m-b">
                <div class="card bg-white">
                    <img class="card-img-top img-responsive" src="{{ url('/').'/file_attachments/'.$activity->image_url }}" alt="Card image">
                    <div class="card-block">
                      <h4 class="card-title">{{ $activity->name }}</h4>
                      <p class="card-text">{{ $activity->description }}</p>
                      <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small>
                      </p>
                    </div>
                </div>
            </div>  
        </div>
        @endforeach
    </div>
@endsection

@section('footer')
    @include('reactor_includes.footer')
@endsection

@section('additional_scripts')
    <!-- page scripts -->
    <script src="{{ asset('reactorAssets/vendor/flot/jquery.flot.js') }}"></script>
    <script src="{{ asset('reactorAssets/vendor/flot/jquery.flot.resize.js') }}"></script>
    <script src="{{ asset('reactorAssets/vendor/flot/jquery.flot.categories.js') }}"></script>
    <script src="{{ asset('reactorAssets/vendor/flot/jquery.flot.stack.js') }}"></script>
    <script src="{{ asset('reactorAssets/vendor/flot/jquery.flot.time.js') }}"></script>
    <script src="{{ asset('reactorAssets/vendor/flot/jquery.flot.pie.js') }}"></script>
    <script src="{{ asset('reactorAssets/vendor/flot-spline/js/jquery.flot.spline.js') }}"></script>
    <script src="{{ asset('reactorAssets/vendor/flot.orderbars/js/jquery.flot.orderBars.js') }}"></script>
    <!-- end page scripts -->
    <!-- initialize page scripts -->
    <script src="{{ asset('reactorAssets/scripts/helpers/sameheight.js') }}"></script>
    <script src="{{ asset('reactorAssets/scripts/ui/dashboard.js') }}"></script>
    <!-- end initialize page scripts -->
    <script type="text/javascript">
        $(document).ready(function(){
            $('#newActivity').on('click', function(){
               window.location = "{{ url('/activity/create') }}"; 
            });
        });
    </script>
@endsection