@extends('layouts.hybridMaster')

@section('page_title')
    Portfolio
@endsection
@section('additional_styles')
    <!--Morris Chart CSS -->
    <link rel="stylesheet" href="{{ asset('adminitoAssets/assets/plugins/morris/morris.css') }}">
@endsection

@section('content')
    <meta name ="csrf-token" content = "{{csrf_token() }}"/>
    <div class="row">
        <div class="col-md-12">
            <div class="card-box">
                <h4 class="header-title m-t-0 m-b-20">Templates</h4>
                <h5>Basic Templates</h5>
                <!-- CARD -->
                <div class="row">
                    <div class="col-md-4">
                        <div class="card-box widget-user">
                            <div class="text-center">
                                <h2 class="text-custom" data-plugin="counterup">Basic Template 1</h2>
                                <button type="button" class="btn btn-success waves-effect w-md waves-light m-b-5">Activate</button>
                                <button type="button" class="btn btn-info waves-effect w-md waves-light m-b-5">Preview</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card-box widget-user">
                            <div class="text-center">
                                <h2 class="text-custom" data-plugin="counterup">Basic Template 2</h2>
                                <button type="button" class="btn btn-success waves-effect w-md waves-light m-b-5">Activate</button>
                                <button type="button" class="btn btn-info waves-effect w-md waves-light m-b-5">Preview</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card-box widget-user">
                            <div class="text-center">
                                <h2 class="text-custom" data-plugin="counterup">Basic Template 3</h2>
                                <button type="button" class="btn btn-success waves-effect w-md waves-light m-b-5">Activate</button>
                                <button type="button" class="btn btn-info waves-effect w-md waves-light m-b-5">Preview</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END CARD -->
                <h5>Make your own templates</h5>
                <form action="{{ url('/portfolio/createTemplate') }}" method="post">
                {{ csrf_field() }}
                <input type="text" name="templateName" required="required">
                <input type="submit" name="submit">
                </form>

                @foreach($templates as $template)
                <p>{{ $template->template_name }}</p>
                @endforeach
            </div>
        </div>
    </div>
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