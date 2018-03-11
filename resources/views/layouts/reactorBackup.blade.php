<!doctype html>
<html class="no-js" lang="">

<head>
  <meta charset="utf-8">
  <title>Ethelon</title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1">
  <!-- build:css({.tmp,app}) styles/app.min.css -->
  @yield('additional_styles_top')
  <link rel="stylesheet" href="{{ asset('reactorAssets/styles/webfont.css').'?'.rand() }}">
  <link rel="stylesheet" href="{{ asset('reactorAssets/styles/climacons-font.css').'?'.rand() }}">
  <link rel="stylesheet" href="{{ asset('reactorAssets/vendor/bootstrap/dist/css/bootstrap.css').'?'.rand() }}">
  <link rel="stylesheet" href="{{ asset('reactorAssets/styles/font-awesome.css').'?'.rand() }}">
  <link rel="stylesheet" href="{{ asset('reactorAssets/styles/card.css').'?'.rand() }}">
  <link rel="stylesheet" href="{{ asset('reactorAssets/styles/sli.css').'?'.rand() }}">
  <link rel="stylesheet" href="{{ asset('reactorAssets/styles/animate.css').'?'.rand() }}">
  <link rel="stylesheet" href="{{ asset('reactorAssets/styles/app.css').'?'.rand() }}">
  <link rel="stylesheet" href="{{ asset('reactorAssets/styles/app.skins.css').'?'.rand() }}">
  <!-- endbuild -->
  @yield('additional_styles_down')
</head>

<body class="page-loading">
    <!-- page loading spinner -->
    <div class="pageload">
        <div class="pageload-inner">
            <div class="sk-rotating-planes red"></div>
        </div>
    </div>
    <!-- /page loading spinner -->
    <div class="app layout-fixed-header">
        <!-- side bar diri dapita -->
        @yield('sidebar')
        <div class="main-panel">
            <!-- top header diri dapita -->
            @yield('topheader')
            <div class="main-content">
                @yield('content')
            </div>
        </div>
    </div>
    <!-- footer diri dapita -->
    @yield('footer')
    
    <!-- scripts diri -->
    <script src="{{ asset('reactorAssets/scripts/helpers/modernizr.js') }}"></script>
    <script src="{{ asset('reactorAssets/vendor/jquery/dist/jquery.js') }}"></script>
    <script src="{{ asset('reactorAssets/vendor/bootstrap/dist/js/bootstrap.js') }}"></script>
    <script src="{{ asset('reactorAssets/vendor/fastclick/lib/fastclick.js') }}"></script>
    <script src="{{ asset('reactorAssets/vendor/perfect-scrollbar/js/perfect-scrollbar.jquery.js') }}"></script>
    <script src="{{ asset('reactorAssets/scripts/helpers/smartresize.js') }}"></script>
    <script src="{{ asset('reactorAssets/scripts/constants.js') }}"></script>
    <script src="{{ asset('reactorAssets/scripts/main.js') }}"></script>
    
    @yield('additional_scripts')
    
</body>
</html>