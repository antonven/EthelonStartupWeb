@extends('layouts.hybridMaster')

@section('title')
    Ethelon
@endsection
@section('additional_styles')

@endsection

@section('content')
    @if($activities)
    <h3> PAST ACTIVITIES </h3>
    <div class="row">
    @foreach($activities as $activity)
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
    @endforeach
    </div>
    @endif
    
@endsection

@section('additional_scripts')

@endsection