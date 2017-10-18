@extends('layouts.hybridMaster')

@section('title')
    Ethelon
@endsection
@section('additional_styles')
    <!--Morris Chart CSS -->
    <link rel="stylesheet" href="{{ asset('adminitoAssets/assets/plugins/morris/morris.css') }}">
@endsection

@section('content')
    <div class="row">

        <div class="col-lg-3 col-md-6">
            <div class="card-box">

                <h4 class="header-title m-t-0 m-b-30">Portfolio Visits</h4>

                <div class="widget-chart-1">
                    <div class="widget-chart-box-1">
                        <input data-plugin="knob" data-width="80" data-height="80" data-fgColor="#f05050 "
                           data-bgColor="#F9B9B9" value="58"
                           data-skin="tron" data-angleOffset="180" data-readOnly=true
                           data-thickness=".15"/>
                    </div>

                    <div class="widget-detail-1">
                        <h2 class="p-t-10 m-b-0"> 256 </h2>
                        <p class="text-muted">Revenue today</p>
                    </div>
                </div>
            </div>
        </div><!-- end col -->

        <div class="col-lg-3 col-md-6">
            <div class="card-box">

                <h4 class="header-title m-t-0 m-b-30">Activity</h4>

                <div class="widget-box-2">
                    <div class="widget-detail-2">
                        <span class="badge badge-success pull-left m-t-20">32% <i class="zmdi zmdi-trending-up"></i> </span>
                        <h2 class="m-b-0"> 8451 </h2>
                        <p class="text-muted m-b-25">Revenue today</p>
                    </div>
                    <div class="progress progress-bar-success-alt progress-sm m-b-0">
                        <div class="progress-bar progress-bar-success" role="progressbar"
                             aria-valuenow="77" aria-valuemin="0" aria-valuemax="100"
                             style="width: 77%;">
                            <span class="sr-only">77% Complete</span>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- end col -->

        <div class="col-lg-3 col-md-6">
            <div class="card-box">

                <h4 class="header-title m-t-0 m-b-30">Volunteers</h4>

                <div class="widget-chart-1">
                    <div class="widget-chart-box-1">
                        <input data-plugin="knob" data-width="80" data-height="80" data-fgColor="#ffbd4a"
                           data-bgColor="#FFE6BA" value="80"
                           data-skin="tron" data-angleOffset="180" data-readOnly=true
                           data-thickness=".15"/>
                    </div>
                    <div class="widget-detail-1">
                        <h2 class="p-t-10 m-b-0"> 4569 </h2>
                        <p class="text-muted">Revenue today</p>
                    </div>
                </div>
            </div>
        </div><!-- end col -->

        <div class="col-lg-3 col-md-6">
            <div class="card-box">

                <h4 class="header-title m-t-0 m-b-30">Funds</h4>

                <div class="widget-box-2">
                    <div class="widget-detail-2">
                        <span class="badge badge-pink pull-left m-t-20">32% <i class="zmdi zmdi-trending-up"></i> </span>
                        <h2 class="m-b-0"> 158 </h2>
                        <p class="text-muted m-b-25">Revenue today</p>
                    </div>
                    <div class="progress progress-bar-pink-alt progress-sm m-b-0">
                        <div class="progress-bar progress-bar-pink" role="progressbar"
                             aria-valuenow="77" aria-valuemin="0" aria-valuemax="100"
                             style="width: 77%;">
                            <span class="sr-only">77% Complete</span>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- end col -->

    </div>
    @if($activities)
    <h3 class="page-title"> PAST ACTIVITIES </h3>
    <div class="row">
    @foreach($activities as $activity)
        @if($activity->status == 1)
            <div class="col-md-2">
            <div class="card-box" style="padding-bottom: 0px;border-radius: 0px !important">
                <div class="dropdown pull-right">
                    <a href="#" class="dropdown-toggle card-drop" data-toggle="dropdown"
                       aria-expanded="false">
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
                <img src="{{ $activity->image_url }}" class="thumb-img" style="object-fit: cover; margin-top: -45px;margin-left: -20px;border: none;height: 200px;width: calc(100% + 40px);">
            </div>
        </div>
        @endif
    @endforeach
    </div>
    @endif
    
@endsection

@section('additional_scripts')
    <!-- KNOB JS -->
    <!--[if IE]>
    <script type="text/javascript" src="assets/plugins/jquery-knob/excanvas.js"></script>
    <![endif]-->
    <script src="{{ asset('adminitoAssets/assets/plugins/jquery-knob/jquery.knob.js') }}"></script>

    <!--Morris Chart-->
    <script src="{{ asset('adminitoAssets/assets/plugins/morris/morris.min.js') }}"></script>
    <script src="{{ asset('adminitoAssets/assets/plugins/raphael/raphael-min.js') }}"></script>

    <!-- Dashboard init -->
    <script src="{{ asset('adminitoAssets/assets/pages/jquery.dashboard.js') }}"></script>
@endsection