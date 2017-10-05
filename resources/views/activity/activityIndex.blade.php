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
        <div class="col-lg-4">
            <div class="panel panel-border panel-danger">
                <div class="panel-heading">
                    <img src="{{ $activity->image_url }}" class="thumb-img" style="object-fit: cover; height: 200px; width: 500px;">
                </div>
                <div class="panel-body">
                    <h3 class="panel-title" style="color:#ff5b5b;"><a href="webtest/{{$activity->activity_id}}">{{ $activity->name }}</a></h3>
                    <p>
                        {{ $activity->description }}
                    </p>
                </div>
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