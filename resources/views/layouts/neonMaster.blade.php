<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta name="description" content="Ethelon" />
        <meta name="author" content="ikkin nevol" />

        <title>@yield('page_title')</title>


        <link rel="stylesheet" href="{{ asset('neonAssets/js/jquery-ui/css/no-theme/jquery-ui-1.10.3.custom.min.css').'?'.rand() }}">
        <link rel="stylesheet" href="{{ asset('neonAssets/css/font-icons/entypo/css/entypo.css').'?'.rand() }}">
        <!-- <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Noto+Sans:400,700,400italic"> -->
        <link rel="stylesheet" href="{{ asset('neonAssets/css/bootstrap.css').'?'.rand() }}">
        <link rel="stylesheet" href="{{ asset('neonAssets/css/neon-core.css').'?'.rand() }}">
        <link rel="stylesheet" href="{{ asset('neonAssets/css/neon-theme.css').'?'.rand() }}">
        <link rel="stylesheet" href="{{ asset('neonAssets/css/neon-forms.css').'?'.rand() }}">
        <link rel="stylesheet" href="{{ asset('neonAssets/css/custom.css').'?'.rand() }}">

        <!-- layout skin -->
        <link rel="stylesheet" href="{{ asset('neonAssets/css/skins/red.css').'?'.rand() }}">
        <!-- end of layout skin -->

        <script src="{{ asset('neonAssets/js/jquery-1.11.0.min.js') }}"></script>

        <!--[if lt IE 9]><script src="assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
                <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
                <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
        @yield('additional_styles')
</head>
<body class="page-body" data-url="http://neon.dev">
    <div class="page-container"><!-- add class "sidebar-collapsed" to close sidebar by default, "chat-visible" to make chat appear always -->
        @yield('sidebar')
        <div class="main-content">
            @yield('header')
            
            <!-- directory -->
            <h2>@yield('directory')</h2>
            <!-- directory -->
            <br />
            <!-- CONTENT -->
            @yield('content')
    <!-- END OF CONTENT -->
        </div>
    </div>
    <link rel="stylesheet" href="{{ asset('neonAssets/js/select2/select2-bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('neonAssets/js/select2/select2.css') }}">
    <link rel="stylesheet" href="{{ asset('neonAssets/js/selectboxit/jquery.selectBoxIt.css') }}">
    <link rel="stylesheet" href="{{ asset('neonAssets/js/daterangepicker/daterangepicker-bs3.css') }}">
    <link rel="stylesheet" href="{{ asset('neonAssets/js/icheck/skins/minimal/_all.css') }}">
    <link rel="stylesheet" href="{{ asset('neonAssets/js/icheck/skins/square/_all.css') }}">
    <link rel="stylesheet" href="{{ asset('neonAssets/js/icheck/skins/flat/_all.css') }}">
    <link rel="stylesheet" href="{{ asset('neonAssets/js/icheck/skins/futurico/futurico.css') }}">
    <link rel="stylesheet" href="{{ asset('neonAssets/js/icheck/skins/polaris/polaris.css') }}">
    <link rel="stylesheet" href="{{ asset('neonAssets/js/wysihtml5/bootstrap-wysihtml5.css') }}">
    <!-- Bottom Scripts -->
    <script src="{{ asset('neonAssets/js/gsap/main-gsap.js') }}"></script>
    <script src="{{ asset('neonAssets/js/jquery-ui/js/jquery-ui-1.10.3.minimal.min.js') }}"></script>
    <script src="{{ asset('neonAssets/js/bootstrap.js') }}"></script>
    <script src="{{ asset('neonAssets/js/jquery.bootstrap.wizard.min.js') }}"></script>
    <script src="{{ asset('neonAssets/js/joinable.js') }}"></script>
    <script src="{{ asset('neonAssets/js/resizeable.js') }}"></script>
    <script src="{{ asset('neonAssets/js/neon-api.js') }}"></script>
    <script src="{{ asset('neonAssets/js/neon-custom.js') }}"></script>
    <script src="{{ asset('neonAssets/js/neon-demo.js') }}"></script>
    <script src="{{ asset('neonAssets/js/resizeable.js') }}"></script>
    <script src="{{ asset('neonAssets/js/neon-api.js') }}"></script>
    <script src="{{ asset('neonAssets/js/select2/select2.min.js') }}"></script>
    <script src="{{ asset('neonAssets/js/bootstrap-tagsinput.min.js') }}"></script>
    <script src="{{ asset('neonAssets/js/typeahead.min.js') }}"></script>
    <script src="{{ asset('neonAssets/js/selectboxit/jquery.selectBoxIt.min.js') }}"></script>
    <script src="{{ asset('neonAssets/js/wysihtml5/wysihtml5-0.4.0pre.min.js') }}"></script>
    <script src="{{ asset('neonAssets/js/wysihtml5/bootstrap-wysihtml5.js') }}"></script>
    <script src="{{ asset('neonAssets/js/bootstrap-datepicker.js') }}"></script>
    <script src="{{ asset('neonAssets/js/bootstrap-timepicker.min.js') }}"></script>
    <script src="{{ asset('neonAssets/js/bootstrap-colorpicker.min.js') }}"></script>
    <script src="{{ asset('neonAssets/js/daterangepicker/moment.min.js') }}"></script>
    <script src="{{ asset('neonAssets/js/daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ asset('neonAssets/js/jquery.multi-select.js') }}"></script>
    <script src="{{ asset('neonAssets/js/icheck/icheck.min.js') }}"></script>
    @yield('additional_scripts')
</body>
</html>