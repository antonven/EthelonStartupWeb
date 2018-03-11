@extends('layouts.hybridMaster')

@section('title')
    Ethelon
@endsection
@section('additional_styles')
    <!--calendar css-->
    <link href="{{ asset('adminitoAssets/assets/plugins/fullcalendar/dist/fullcalendar.css') }}" rel="stylesheet" />
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-3 col-md-6">
            <div class="card-box widget-user">
                <div class="text-center">
                    <h2 class="text-custom" data-plugin="counterup">{{ $volunteersCount }}</h2>
                    <h5>Total Volunteers</h5>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="card-box widget-user">
                <div class="text-center">
                    <h2 class="text-pink" data-plugin="counterup">{{ \Auth::user()->foundation->activities->where('status', 1)->count()}}</h2>
                    <h5>Total Activities</h5>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="card-box widget-user">
                <div class="text-center">
                    <h2 class="text-info" data-plugin="counterup">{{ \Auth::user()->foundation->activities->where('status', 0)->count() }}</h2>
                    <h5>Ongoing Activities</h5>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="card-box widget-user">
                <div class="text-center">
                    <h2 class="text-warning" data-plugin="counterup">{{ \Auth::user()->foundation->portfolio->views }}</h2>
                    <h5>Portfolio Views</h5>
                </div>
            </div>
        </div>
    </div> 

    @if($finished_activities == true)
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

@endsection