@extends('layouts.hybridMaster')

@section('title')
    Ethelon | Activity
@endsection
@section('additional_styles')

@endsection
@section('content')
    <div class="row">
        <div class="col-lg-2">
            <button type="button" id="createActivity" class="btn btn-danger btn-block btn-bordred waves-effect w-md waves-light">Add Activity</button>
        </div>
    </div>
    <br>
    
    <div class="row">
        @foreach($activities as $activity)
        <div class="col-md-4">
            <div class="card-box">
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
                <img src="{{ $activity->image_url }}" class="thumb-img" style="object-fit: cover; margin-top: -45px;margin-left: -20px;border: none;height: 200px;width: calc(100% + 40px)">
                <p></p>
                <h4 class="header-title m-t-0 m-b-30">{{ $activity->name }}</h4>

                <p>
                    {{ $activity->description }}
                </p>
        </div>
    </div>
        @endforeach
    </div>

@endsection

@section('additional_scripts')
    <script>
        $(document).ready(function(){
            $('#createActivity').on('click',function(){
               window.location = "{{url('/activity/create')}}"; 
            });
        });
    </script>
@endsection 