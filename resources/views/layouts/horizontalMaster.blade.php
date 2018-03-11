<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
        <meta name="author" content="Coderthemes">

        <link rel="shortcut icon" href="{{ asset('horizontalAdmintoAssets/assets/images/favicon.ico') }}">

        <title>@yield('title')</title>

        <link href="{{ asset('horizontalAdmintoAssets/assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('horizontalAdmintoAssets/assets/css/core.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('horizontalAdmintoAssets/assets/css/components.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('horizontalAdmintoAssets/assets/css/icons.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('horizontalAdmintoAssets/assets/css/pages.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('horizontalAdmintoAssets/assets/css/menu.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('horizontalAdmintoAssets/assets/css/responsive.css') }}" rel="stylesheet" type="text/css" />

        <!-- HTML5 Shiv and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->

        <script src="{{ asset('horizontalAdmintoAssets/assets/js/modernizr.min.js') }}"></script>

        <style type="text/css">
            .panel-thumbnail img{
                display: block;
                margin: auto;
                object-fit: cover;
                overflow: hidden;
                width: 420px;
                height: 250px;
            }
        </style>

        @yield('additional_styles')

    </head>


    <body>

        <!-- Navigation Bar-->
        <header id="topnav">
            <div class="topbar-main" style="background-color: #c0392b;">
                <div class="container">

                    <!-- LOGO -->
                    <div class="topbar-left">
                        <a href="index.html" class="logo"><span style="color:white">Ethelon</span></a>
                    </div>
                    <!-- End Logo container-->


                    <div class="menu-extras">

                        <ul class="nav navbar-nav navbar-right pull-right">
                            <li>
                                <form role="search" class="navbar-left app-search pull-left hidden-xs">
                                     <input type="text" placeholder="Search..." class="form-control">
                                     <a href=""><i class="fa fa-search"></i></a>
                                </form>
                            </li>
                        </ul>
                        <div class="menu-item">
                            <!-- Mobile menu toggle-->
                            <a class="navbar-toggle">
                                <div class="lines">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </div>
                            </a>
                            <!-- End mobile menu toggle-->
                        </div>
                    </div>

                </div>
            </div>

            <div class="navbar-custom">
                <div class="container">
                    <div id="navigation">
                        <!-- Navigation Menu-->
                        <ul class="navigation-menu">
                            <li>
                                <a href="{{ url('/') }}"><i class="zmdi zmdi-view-dashboard"></i> <span> Home </span> </a>
                            </li>
                            <li>
                                <a href="{{ url('/foundations') }}"><i class="zmdi zmdi-view-dashboard"></i> <span> Foundations </span> </a>
                            </li>
                            <li>
                                <a href="{{ url('/admin') }}"><i class="zmdi zmdi-view-dashboard"></i> <span> Foundation Login </span> </a>
                            </li>
                        </ul>
                        <!-- End navigation menu  -->
                    </div>
                </div>
            </div>
        </header>
        <!-- End Navigation Bar-->


        <div class="wrapper">
            <div class="container">

                <!-- Page-Title -->
                
                <h4 class="page-title">@yield('page_title')</h4>
                @yield('content')


                <!-- end page title end breadcrumb -->
                <!-- Footer -->
                <footer class="footer text-right">
                    <div class="container">
                        <div class="row">
                            <div class="col-xs-6">
                                2016 © Adminto.
                            </div>
                            <div class="col-xs-6">
                                <ul class="pull-right list-inline m-b-0">
                                    <li>
                                        <a href="#">About</a>
                                    </li>
                                    <li>
                                        <a href="#">Help</a>
                                    </li>
                                    <li>
                                        <a href="#">Contact</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </footer>
                <!-- End Footer -->

            </div> <!-- end container -->


        </div>



        <!-- jQuery  -->
        <script src="{{ asset('horizontalAdmintoAssets/assets/js/jquery.min.js') }}"></script>
        <script src="{{ asset('horizontalAdmintoAssets/assets/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('horizontalAdmintoAssets/assets/js/detect.js') }}"></script>
        <script src="{{ asset('horizontalAdmintoAssets/assets/js/fastclick.js') }}"></script>
        <script src="{{ asset('horizontalAdmintoAssets/assets/js/jquery.slimscroll.js') }}"></script>
        <script src="{{ asset('horizontalAdmintoAssets/assets/js/jquery.blockUI.js') }}"></script>
        <script src="{{ asset('horizontalAdmintoAssets/assets/js/waves.js') }}"></script>
        <script src="{{ asset('horizontalAdmintoAssets/assets/js/wow.min.js') }}"></script>
        <script src="{{ asset('horizontalAdmintoAssets/assets/js/jquery.nicescroll.js') }}"></script>
        <script src="{{ asset('horizontalAdmintoAssets/assets/js/jquery.scrollTo.min.js') }}"></script>


        <!-- App js -->
        <script src="{{ asset('horizontalAdmintoAssets/assets/js/jquery.core.js') }}"></script>
        <script src="{{ asset('horizontalAdmintoAssets/assets/js/jquery.app.js') }}"></script>

        @yield('additional_scripts')

    </body>
</html>