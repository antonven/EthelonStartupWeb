@extends('layouts.horizontalMaster')

@section('title')
@endsection

@section('additional_styles')
@endsection

@section('page_title')
{{ $skill }} Activities
@endsection

@section('content')
	<div class="row" style="margin-top: 15px;">
		@if($activities->count())
			@foreach($activities as $activity)                
		    <div class="col-sm-3">
		        <a href="{{ url('/activity'.'/'.$activity->activity_id) }}">
		        <div class="panel-thumbnail" style="background: #222;">
		            <img src="{{ $activity->image_url }}" class="img-responsive">
		        </div>
		        </a>
		        <div>
		        	<p style="font-size: 18px; text-transform: uppercase; letter-spacing: 1px; font-family: 'Karla';">{{ $activity->name }}</p>
		        </div>
		    </div>
		    @endforeach
	    @else
	    	<div class="col-sm-12">
	    		<h3>No {{ $skill }} activities available.</h3>
	    	</div>
	    @endif
	</div>
@endsection

@section('additional_scripts')
@endsection