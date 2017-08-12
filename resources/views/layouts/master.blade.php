<!DOCTYPE html>
<html class="no-js" lang="">

<head>
    <meta charset="utf-8">
    <title>Ethelon</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1">
    <!-- Bootstrap Core CSS -->
    <link href="{{ asset('sbAssets/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="{{ asset('sbAssets/css/simple-sidebar.css').'?'.rand() }}" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="{{ asset('sbAssets/expan/css/default.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('sbAssets/expan/css/component.css') }}" />
      
    <script src="{{ asset('sbAssets/expan/js/modernizr.custom.js') }}"></script>
    @yield('additional_styles')
</head>

<body class="demo1">

        <div id="wrapper">

        <!-- Sidebar -->
        <div id="sidebar-wrapper">  
            <ul class="sidebar-nav">
                <li class="sidebar-brand">
                    <a href="#">
                        wow
                    </a>
                </li>
                <li>
                    <a href="{{ url('/') }}">Dashboard</a>
                </li>
                <li>
                    <a href="{{ url('/activity') }}">Activity</a>
                </li>
            </ul>
        </div>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        @yield('content')
        
        <!-- /#page-content-wrapper -->

    </div>
    <script src="{{ asset('sbAssets/js/jquery.js') }}"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="{{ asset('sbAssets/js/bootstrap.min.js') }}"></script>

    <!-- Menu Toggle Script -->
    <script src="{{ asset('sbAssets/expan/js/grid.js') }}"></script>
    @yield('additional_scripts')
    
</body>
</html>