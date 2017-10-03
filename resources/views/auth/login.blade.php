<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
        <meta name="author" content="Coderthemes">

        <!-- App Favicon -->
        <link rel="shortcut icon" href="{{ asset('adminitoAssets/assets/images/favicon.ico') }}">

        <!-- App title -->
        <title>Ethelon</title>

        <!-- App CSS -->
        <link href="{{ asset('adminitoAssets/assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('adminitoAssets/assets/css/core.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('adminitoAssets/assets/css/components.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('adminitoAssets/assets/css/icons.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('adminitoAssets/assets/css/pages.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('adminitoAssets/assets/css/menu.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('adminitoAssets/assets/css/responsive.css') }}" rel="stylesheet" type="text/css" />

        <!-- HTML5 Shiv and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->

        <script src="{{ asset('adminitoAssets/assets/js/modernizr.min.js') }}"></script>

    </head>
    <body>
    	<form class="form-horizontal" method="POST" action="{{ route('login') }}">
        {{ csrf_field() }}
        <div class="account-pages"></div>
        <div class="clearfix"></div>
        <div class="wrapper-page">
            <div class="text-center">
                <a href="index.html" class="logo"><span>Ethelon</span></a>
                <h5 class="text-muted m-t-0 font-600"></h5>
            </div>
        	<div class="m-t-40 card-box">
                <div class="text-center">
                    <h4 class="text-uppercase font-bold m-b-0">Login</h4>
                </div>
                <div class="panel-body">

					<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
						<div class="col-xs-12">
							<input class="form-control" type="email" required="" name="email" placeholder="Email">
						</div>
						@if ($errors->has('email'))
						<center>
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        </center>
                       	@endif
					</div>

					<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
						<div class="col-xs-12">
							<input class="form-control" type="password" required="" name="password" placeholder="Password">
						</div>
						@if ($errors->has('password'))
						<center>
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        </center>
                       	@endif
					</div>

					<div class="form-group text-center m-t-40">
						<div class="col-xs-12">
							<button class="btn btn-danger btn-bordred btn-block waves-effect waves-light" type="submit">
								Login
							</button>
						</div>
					</div>

                </div>
            </div>
            <!-- end card-box -->

			<div class="row">
				<div class="col-sm-12 text-center">
					<p class="text-muted" style="color:black !important;">Already have account?<a href="page-login.html" class="text-primary m-l-5"><b style="color:red !important;">Sign In</b></a></p>
				</div>
			</div>

        </div>
        <!-- end wrapper page -->
        </form>



    	<script>
            var resizefunc = [];
        </script>

        <!-- jQuery  -->
        <script src="{{ asset('adminitoAssets/assets/js/jquery.min.js') }}"></script>
        <script src="{{ asset('adminitoAssets/assets/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('adminitoAssets/assets/js/detect.js') }}"></script>
        <script src="{{ asset('adminitoAssets/assets/js/fastclick.js') }}"></script>
        <script src="{{ asset('adminitoAssets/assets/js/jquery.slimscroll.js') }}"></script>
        <script src="{{ asset('adminitoAssets/assets/js/jquery.blockUI.js') }}"></script>
        <script src="{{ asset('adminitoAssets/assets/js/waves.js') }}"></script>
        <script src="{{ asset('adminitoAssets/assets/js/wow.min.js') }}"></script>
        <script src="{{ asset('adminitoAssets/assets/js/jquery.nicescroll.js') }}"></script>
        <script src="{{ asset('adminitoAssets/assets/js/jquery.scrollTo.min.js') }}"></script>

        <!-- App js -->
        <script src="{{ asset('adminitoAssets/assets/js/jquery.core.js') }}"></script>
        <script src="{{ asset('adminitoAssets/assets/js/jquery.app.js') }}"></script>

	</body>
</html>