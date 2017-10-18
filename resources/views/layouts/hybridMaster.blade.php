<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
        <meta name="author" content="Coderthemes">

        <!-- App Favicon -->
        <link rel="shortcut icon" href="assets/images/favicon.ico">

        <!-- App title -->
        <title>@yield('title')</title>

        @yield('additional_styles')

        <!--venobox lightbox-->
        <link rel="stylesheet" href="{{ asset('adminitoAssets/assets/plugins/magnific-popup/dist/magnific-popup.css') }}"/>    
        
        <!-- Plugins css-->
        <link href="{{ asset('adminitoAssets/assets/plugins/bootstrap-tagsinput/dist/bootstrap-tagsinput.css') }}" rel="stylesheet" />
        <link href="{{ asset('adminitoAssets/assets/plugins/multiselect/css/multi-select.css') }}"  rel="stylesheet" type="text/css" />
        <link href="{{ asset('adminitoAssets/assets/plugins/select2/dist/css/select2.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('adminitoAssets/assets/plugins/select2/dist/css/select2-bootstrap.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('adminitoAssets/assets/plugins/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.css') }}" rel="stylesheet" />
        <link href="{{ asset('adminitoAssets/assets/plugins/switchery/switchery.min.css') }}" rel="stylesheet" />
        <link href="{{ asset('adminitoAssets/assets/plugins/timepicker/bootstrap-timepicker.min.css') }}" rel="stylesheet">
        <link href="{{ asset('adminitoAssets/assets/plugins/mjolnic-bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css') }}" rel="stylesheet">
        <link href="{{ asset('adminitoAssets/assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}" rel="stylesheet">
        <link href="{{ asset('adminitoAssets/assets/plugins/bootstrap-daterangepicker/daterangepicker.css') }}" rel="stylesheet">
        
        <!-- form Uploads -->
        <link href="{{ asset('adminitoAssets/assets/plugins/fileuploads/css/dropify.min.css') }}" rel="stylesheet" type="text/css" />
                
        <!-- App CSS -->
        <link href="{{ asset('adminitoAssets/assets/css/bootstrap.min.css')."?".rand() }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('adminitoAssets/assets/css/core.css')."?".rand() }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('adminitoAssets/assets/css/components.css')."?".rand() }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('adminitoAssets/assets/css/icons.css')."?".rand() }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('adminitoAssets/assets/css/pages.css')."?".rand() }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('adminitoAssets/assets/css/menu.css')."?".rand() }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('adminitoAssets/assets/css/responsive.css')."?".rand() }}" rel="stylesheet" type="text/css" />

        <!-- HTML5 Shiv and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
        <script src="{{ asset('adminitoAssets/assets/js/modernizr.min.js') }}"></script>

    </head>


    <body class="fixed-left">

        <!-- Begin page -->
        <div id="wrapper">

            <!-- Top Bar Start -->
            <div class="topbar">

                <!-- LOGO -->
                <div class="topbar-left">
                    <a href="index.html" class="logo"><span>Ethelon</span></span><i class="zmdi zmdi-layers"></i></a>
                </div>

                <!-- Button mobile view to collapse sidebar menu -->
                <div class="navbar navbar-default" role="navigation">
                    <div class="container">

                        <!-- Page title -->
                        <ul class="nav navbar-nav navbar-left">
                            <li>
                                <button class="button-menu-mobile open-left">
                                    <i class="zmdi zmdi-menu"></i>
                                </button>
                            </li>
                            <li>
                                <!-- <h4 class="page-title">Activity</h4> -->
                            </li>
                        </ul>

                    </div><!-- end container -->
                </div><!-- end navbar -->
            </div>
            <!-- Top Bar End -->


            <!-- ========== Left Sidebar Start ========== -->
            <div class="left side-menu">
                <div class="sidebar-inner slimscrollleft">

                    <!-- User -->
                    <div class="user-box">
                        <div class="user-img">
                            @if(\Auth::user()->role == "admin")
                            <img src="{{ asset('assets/images/ethelon.png') }}" style="object-fit: cover;min-height: 90px;height: 90px;" alt="user-img" title="{{ \Auth::user()->name }}" class="img-circle img-thumbnail img-responsive">
                            @elseif(\Auth::user()->role == "foundation")
                            <img src="{{ \Auth::user()->foundation->image_url }}" style="object-fit: cover;min-height: 90px;height: 90px;" alt="user-img" title="{{ \Auth::user()->name }}" class="img-circle img-thumbnail img-responsive">
                            @endif
                            <div class="user-status offline"><i class="zmdi zmdi-dot-circle"></i></div>
                        </div>
                        <h5><a href="#">{{ \Auth::user()->name }}</a> </h5>
                        <ul class="list-inline">
                            <li>
                                <a href="#" >
                                    <i class="zmdi zmdi-settings"></i>
                                </a>
                            </li>

                            <li>
                                <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();" class="text-custom">
                                    <i class="zmdi zmdi-power"></i>
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>

                        </ul>
                    </div>
                    <!-- End User -->

                    <!--- Sidebar -->
                    <div id="sidebar-menu">
                        <ul>
                            @if(\Auth::user()->role == "foundation")
                            <li class="text-muted menu-title">Navigation</li>

                            <li>
                                <a href="{{url('/')}}" class="waves-effect"><i class="zmdi zmdi-view-dashboard"></i> <span> HOME </span> </a>
                            </li>

                            <li>
                                <a href="{{url('/activity')}}" class="waves-effect"><i class="zmdi zmdi-format-underlined"></i> <span> ACTIVITY </span> </a>
                            </li>

                            <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect"><i class="zmdi zmdi-invert-colors"></i> <span> VOLUNTEERS </span> <span class="menu-arrow"></span></a>
                                <ul class="list-unstyled">
                                    <li><a href="ui-buttons.html">Buttons</a></li>
                                    <li><a href="ui-cards.html">Cards</a></li>
                                    <li><a href="ui-checkbox-radio.html">Checkboxs-Radios</a></li>
                                    <li><a href="ui-material-icons.html">Material Design Icons</a></li>
                                    <li><a href="ui-font-awesome-icons.html">Font Awesome</a></li>
                                    <li><a href="ui-themify-icons.html">Themify Icons</a></li>
                                    <li><a href="ui-modals.html">Modals</a></li>
                                    <li><a href="ui-notification.html">Notification</a></li>
                                    <li><a href="ui-range-slider.html">Range Slider</a></li>
                                    <li><a href="ui-components.html">Components</a>
                                    <li><a href="ui-sweetalert.html">Sweet Alert</a>
                                    <li><a href="ui-treeview.html">Tree view</a>
                                    <li><a href="ui-widgets.html">Widgets</a></li>
                                </ul>
                            </li>
                            
                            <li>
                                <a href="{{url('/')}}" class="waves-effect"><i class="zmdi zmdi-view-dashboard"></i> <span> PROFILE </span> </a>
                            </li>

                            <li>
                                <a href="{{url('/')}}" class="waves-effect"><i class="zmdi zmdi-format-underlined"></i> <span> SETTINGS </span> </a>
                            </li>

                            @elseif(\Auth::user()->role == "admin")
                            <li class="text-muted menu-title">Navigation</li>

                            <li>
                                <a href="{{url('/')}}" class="waves-effect"><i class="zmdi zmdi-view-dashboard"></i> <span> HOME </span> </a>
                            </li>

                            <li>
                                <a href="{{url('/admin/foundationlist')}}" class="waves-effect"><i class="zmdi zmdi-format-underlined"></i> <span> FOUNDATIONS </span> </a>
                            </li>

                            <li>
                                <a href="{{url('/admin/activitylist')}}" class="waves-effect"><i class="zmdi zmdi-format-underlined"></i> <span> ACTIVITIES </span> </a>
                            </li>
                            @else
                            @endif
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <!-- Sidebar -->
                    <div class="clearfix"></div>

                </div>

            </div>
            <!-- Left Sidebar End -->



            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            
            <div class="content-page">
                <!-- Start content -->
                <div class="content">
                    <div class="container">

                        @yield('content')
                        <!-- container -->
                    </div>
                </div> <!-- content -->

                <footer class="footer">
                    2017 © Ethelon.
                </footer>

            </div>
            <!-- End content-page -->


            <!-- ============================================================== -->
            <!-- End Right content here -->
            <!-- ============================================================== -->



        </div>
        <!-- END wrapper -->
        <!-- jQuery  -->
        
        <script src="{{ asset('adminitoAssets/assets/js/jquery.min.js') }}"></script>
        <script src="{{ asset('adminitoAssets/assets/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('adminitoAssets/assets/js/detect.js') }}"></script>
        <script src="{{ asset('adminitoAssets/assets/js/fastclick.js') }}"></script>
        <script src="{{ asset('adminitoAssets/assets/js/jquery.slimscroll.js') }}"></script>
        <script src="{{ asset('adminitoAssets/assets/js/jquery.blockUI.js') }}"></script>
        <script src="{{ asset('adminitoAssets/assets/js/waves.js') }}"></script>
        <script src="{{ asset('adminitoAssets/assets/js/jquery.nicescroll.js') }}"></script>
        <script src="{{ asset('adminitoAssets/assets/js/jquery.scrollTo.min.js') }}"></script>
        
        <!-- isotope filter plugin -->
        <script type="text/javascript" src="{{ asset('adminitoAssets/assets/plugins/isotope/dist/isotope.pkgd.min.js') }}"></script>

        <!-- Magnific popup -->
        <script type="text/javascript" src="{{ asset('adminitoAssets/assets/plugins/magnific-popup/dist/jquery.magnific-popup.min.js') }}"></script>
        <!--form wysiwig js-->
        <script src="{{ asset('adminitoAssets/assets/plugins/tinymce/tinymce.min.js') }}"></script>
        <!-- file uploads js -->
        <script src="{{ asset('adminitoAssets/assets/plugins/fileuploads/js/dropify.min.js') }}"></script>
        <!-- Validation js (Parsleyjs) -->
        <script type="text/javascript" src="{{ asset('adminitoAssets/assets/plugins/parsleyjs/dist/parsley.min.js') }}"></script>
        <!-- Plugins Js -->
        <script src="{{ asset('adminitoAssets/assets/plugins/switchery/switchery.min.js') }}"></script>
        <script src="{{ asset('adminitoAssets/assets/plugins/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('adminitoAssets/assets/plugins/multiselect/js/jquery.multi-select.js') }}"></script>
        <script type="text/javascript" src="{{ asset('adminitoAssets/assets/plugins/jquery-quicksearch/jquery.quicksearch.js') }}"></script>
        <script src="{{ asset('adminitoAssets/assets/plugins/select2/dist/js/select2.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('adminitoAssets/assets/plugins/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('adminitoAssets/assets/plugins/bootstrap-inputmask/bootstrap-inputmask.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('adminitoAssets/assets/plugins/moment/moment.js') }}"></script>
     	<script src="{{ asset('adminitoAssets/assets/plugins/timepicker/bootstrap-timepicker.min.js') }}"></script>
     	<script src="{{ asset('adminitoAssets/assets/plugins/mjolnic-bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js') }}"></script>
     	<script src="{{ asset('adminitoAssets/assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
     	<script src="{{ asset('adminitoAssets/assets/plugins/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
        <script src="{{ asset('adminitoAssets/assets/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js') }}" type="text/javascript"></script>

        <script>
                    var resizefunc = [];
            </script>
            
        @yield('additional_scripts')

                <!-- App js -->
        <script src="{{ asset('adminitoAssets/assets/js/jquery.core.js') }}"></script>
        <script src="{{ asset('adminitoAssets/assets/js/jquery.app.js') }}"></script>
    </body>
</html>