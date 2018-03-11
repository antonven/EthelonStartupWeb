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
                <!-- <h5>Basic Templates</h5> -->
                <br>
                <!-- CARD -->
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-4">
                        <div class="card-box widget-user" style="box-shadow: none; border: 1px solid #9E9E9E;">
                            <div class="text-center">
                                <span class="fa fa-file" style="font-size: 32px; margin-top: 10px; margin-bottom: 20px;"></span>
                                <h4 class="text-custom" data-plugin="counterup">Basic Template</h4>
                                <p style="font-size: 13px; padding: 15px 35px;">Start with a basic template for your page made ready just for you. No need to worry about how your page would be made. See what it looks like on preview.</p>
                                <button type="button" class="btn waves-effect w-md waves-light m-b-5" style="background: #C62828; border: none; color: #fafafa;">Activate</button>
                                <button type="button" class="btn waves-effect w-md waves-light m-b-5" style="background: #424242; border: none; color: #fafafa;">Preview</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card-box widget-user" style="box-shadow: none; border: 1px solid #9E9E9E;">
                            <div class="text-center">
                                <span class="fa fa-cogs" style="font-size: 32px; margin-top: 10px; margin-bottom: 20px;"></span>
                                <h4 class="text-custom" data-plugin="counterup">Advanced Template</h4>
                                <p style="font-size: 13px; padding: 15px 35px;">Feel free to customize your page through this custom template. Just drag and drop objects you want to see on your page. See what it looks like on preview.</p>
                                <button type="button" class="btn waves-effect w-md waves-light m-b-5" style="background: #C62828; border: none; color: #fafafa;">Activate</button>
                                <button type="button" class="btn waves-effect w-md waves-light m-b-5" style="background: #424242; border: none; color: #fafafa;">Preview</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2"></div>
                </div>
                <!-- END CARD -->
                <br>
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