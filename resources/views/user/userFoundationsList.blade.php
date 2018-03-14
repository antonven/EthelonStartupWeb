<?php
  use Carbon\Carbon;
?>
@extends('layouts.horizontalMaster')

@section('title')
@endsection

@section('additional_styles')
@endsection

@section('page_title')
Foundation List
@endsection

@section('content')
  <div class="row" style="margin-top: 15px;">
      @if($foundations->count())
      @foreach($foundations as $foundation)
      <?php
        $template_id = $foundation->portfolio->templates->where("active", 1)->first();
      ?>                
      <div class="col-sm-3">
          <a href="{{ url('/foundation'.'/'.$foundation->user->name) }}">
          <div class="panel-thumbnail" style="background: #222;">
              <img src="{{ $foundation->image_url }}" class="img-responsive">
          </div>
          </a>
          <p style="font-size: 18px; text-transform: uppercase; letter-spacing: 1px; font-family: 'Karla';">{{ $foundation->user->name }}</p>
      </div>
      @endforeach
      @endif
  </div>
@endsection

@section('additional_scripts')
@endsection