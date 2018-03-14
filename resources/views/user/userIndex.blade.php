@extends('layouts.horizontalMaster')

@section('title')
@endsection

@section('additional_styles')
@endsection

@section('page_title')
Skills
@endsection

@section('content')
	<div class="row" style="margin-top: 15px;">                
	    <div class="col-sm-3">
	        <a href="{{ url('/Environment') }}">
	        <div class="panel-thumbnail" style="background: #222;">
	            <img src="{{ url('/skills/environmental.jpeg') }}" class="img-responsive">
	            <div class="carousel-caption text-center">
	                <p style="font-size: 18px; text-transform: uppercase; letter-spacing: 1px; font-family: 'Karla';">Environment</p>
	            </div>
	        </div>
	        </a>
	    </div>

	    <div class="col-sm-3">
	        <a href="{{ url('/Livelihood') }}">
	        <div class="panel-thumbnail" style="background: #222;">
	            <img src="{{ url('/skills/livelihood.jpeg') }}" class="img-responsive">
	            <div class="carousel-caption text-center">
	                <p style="font-size: 18px; text-transform: uppercase; letter-spacing: 1px; font-family: 'Karla';">Livelihood</p>
	            </div>
	        </div>
	        </a>
	    </div>

	    <div class="col-sm-3">
	        <a href="{{ url('/Education') }}">
	        <div class="panel-thumbnail" style="background: #222;">
	            <img src="{{ url('/skills/education.jpeg') }}" class="img-responsive">
	            <div class="carousel-caption text-center">
	                <p style="font-size: 18px; text-transform: uppercase; letter-spacing: 1px; font-family: 'Karla';">Education</p>
	            </div>
	        </div>
	        </a>
	    </div>

	    <div class="col-sm-3">
	        <a href="{{ url('/Charity') }}">
	        <div class="panel-thumbnail" style="background: #222;">
	            <img src="{{ url('/skills/charity.jpeg') }}" class="img-responsive">
	            <div class="carousel-caption text-center">
	                <p style="font-size: 18px; text-transform: uppercase; letter-spacing: 1px; font-family: 'Karla';">Charity</p>
	            </div>
	        </div>
	        </a>
	    </div>
	</div>
	    
	<div class="row" style="margin-top: 15px;">
	    <div class="col-sm-3">
	        <a href="{{ url('/Sports') }}">
	        <div class="panel-thumbnail" style="background: #222;">
	            <img src="{{ url('/skills/sports.jpeg') }}" class="img-responsive">
	            <div class="carousel-caption text-center">
	                <p style="font-size: 18px; text-transform: uppercase; letter-spacing: 1px; font-family: 'Karla';">Sports</p>
	            </div>
	        </div>
	        </a>
	    </div>
	    
	    <div class="col-sm-3">
	        <a href="{{ url('/Culinary') }}">
	        <div class="panel-thumbnail" style="background: #222;">
	            <img src="{{ url('/skills/culinary.jpeg') }}" class="img-responsive">
	            <div class="carousel-caption text-center">
	                <p style="font-size: 18px; text-transform: uppercase; letter-spacing: 1px; font-family: 'Karla';">Culinary</p>
	            </div>
	        </div>
	        </a>
	    </div>

	    <div class="col-sm-3">
	        <a href="{{ url('/Medical') }}">
	        <div class="panel-thumbnail" style="background: #222;">
	            <img src="{{ url('/skills/medical.jpeg') }}" class="img-responsive">
	            <div class="carousel-caption text-center">
	                <p style="font-size: 18px; text-transform: uppercase; letter-spacing: 1px; font-family: 'Karla';">Medical</p>
	            </div>
	        </div>
	        </a>
	    </div>

	    <div class="col-sm-3">
	        <a href="{{ url('/Arts') }}">
	        <div class="panel-thumbnail" style="background: #222;">
	            <img src="{{ url('/skills/arts.jpeg') }}" class="img-responsive">
	            <div class="carousel-caption text-center">
	                <p style="font-size: 18px; text-transform: uppercase; letter-spacing: 1px; font-family: 'Karla';">Arts</p>
	            </div>
	        </div>
	        </a>
	    </div>
	</div>
@endsection

@section('additional_scripts')
@endsection