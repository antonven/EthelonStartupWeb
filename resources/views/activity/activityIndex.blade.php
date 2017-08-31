@extends('layouts.neonMaster')

@section('page_title')
@endsection

@section('additional_styles')
@endsection

@section('sidebar')
    @include('neon_includes.sidebar')
@endsection

@section('header')
    @include('neon_includes.header')
@endsection

@section('directory')
ACTIVITY
@endsection

@section('content')
<div class="gallery-env">
    <div class="row">
        @foreach($activities as $activity)
        <div class="col-sm-3">
            <article class="album">
                <header>
                    <a href="extra-gallery-single.html">
                        <img src="{{ $activity->image_url }}" style="width:100%;max-height:100px;object-fit: cover;" />
                    </a>
                    <a href="#" class="album-options">
                            <i class="entypo-cog"></i>
                            Change Cover
                    </a>
                </header>

                <section class="album-info">
                    <h3><a href="{{url('webtest/'.$activity->activity_id)}}">{{ $activity->name }}</a></h3>
                </section>

                <footer>
                    <div class="album-images-count">
                            <i class="entypo-picture"></i>
                            55
                    </div>
                    <div class="album-options">
                            <a href="#">
                                    <i class="entypo-cog"></i>
                            </a>

                            <a href="#">
                                    <i class="entypo-trash"></i>
                            </a>
                    </div>
                </footer>
            </article>
        </div>
        @endforeach
    </div>
</div>
@endsection

@section('additional_scripts')
@endsection