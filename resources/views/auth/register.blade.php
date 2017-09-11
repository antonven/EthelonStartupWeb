<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta name="description" content="Neon Admin Panel" />
	<meta name="author" content="" />
	
	<title>Ethelon | Register</title>
	

	<link rel="stylesheet" href="{{ asset('neonAssets/js/jquery-ui/css/no-theme/jquery-ui-1.10.3.custom.min.css') }}">
	<link rel="stylesheet" href="{{ asset('neonAssets/css/font-icons/entypo/css/entypo.css') }}">
	<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Noto+Sans:400,700,400italic') }}">
	<link rel="stylesheet" href="{{ asset('neonAssets/css/bootstrap.css') }}">
	<link rel="stylesheet" href="{{ asset('neonAssets/css/neon-core.css') }}">
	<link rel="stylesheet" href="{{ asset('neonAssets/css/neon-theme.css') }}">
	<link rel="stylesheet" href="{{ asset('neonAssets/css/neon-forms.css') }}">
	<link rel="stylesheet" href="{{ asset('neonAssets/css/custom.css') }}">

	<script src="{{ asset('neonAssets/js/jquery-1.11.0.min.js') }}"></script>

	<!--[if lt IE 9]><script src="{{ asset('neonAsset/assets/js/ie8-responsive-file-warning.js') }}"></script><![endif]-->

	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
	<![endif]-->
	
	
</head>
<body class="page-body login-page login-form-fall" data-url="http://neon.dev">




<div class="login-container" style="padding-top:20em;">

	
	<div class="login-form">
		
		<div class="login-content">
			
			<div class="form-login-error">
				<h3>Invalid login</h3>
				<p>Enter <strong>demo</strong>/<strong>demo</strong> as login and password.</p>
			</div>
			
                   <form class="form-horizontal" method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <div class="input-group">
                                <div class="input-group-addon">
                                        <i class="entypo-user"></i>
                                </div>
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required placeholder="Username">

                            </div>
                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <div class="input-group">
                                <div class="input-group-addon">
                                        <i class="entypo-key"></i>
                                </div>
                                <input id="email" type="email" class="form-control" name="email" required placeholder="Email">
                            </div>

                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                        
                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <div class="input-group">
                                <div class="input-group-addon">
                                        <i class="entypo-key"></i>
                                </div>
                                <input id="email" type="password" class="form-control" name="password" required placeholder="Password">
                            </div>

                            @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                        
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-addon">
                                        <i class="entypo-key"></i>
                                </div>
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required placeholder="Confirm Password">
                            </div>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block btn-login">
                                    <i class="entypo-login"></i>
                                    Register
                            </button>
                        </div>
                        
                        <div class="form-group">
					<em>- or -</em>
				</div>
				
				<div class="form-group">
				
					<button type="button" class="btn btn-default btn-lg btn-block btn-icon icon-left facebook-button">
						Login with Facebook
						<i class="entypo-facebook"></i>
					</button>
					
				</div>
                    </form>
		
			
			<div class="login-bottom-links">
				
				<a href="extra-forgot-password.html" class="link">Forgot your password?</a>
				
				<br />
				
				<a href="#">ToS</a>  - <a href="#">Privacy Policy</a>
				
			</div>
			
		</div>
		
	</div>
                    
		
	</div>
        </div>
	


	<!-- Bottom Scripts -->
	<script src="{{ asset('neonAssets/js/gsap/main-gsap.js') }}"></script>
	<script src="{{ asset('neonAssets/js/jquery-ui/js/jquery-ui-1.10.3.minimal.min.js') }}"></script>
	<script src="{{ asset('neonAssets/js/bootstrap.js') }}"></script>
	<script src="{{ asset('neonAssets/js/joinable.js') }}"></script>
	<script src="{{ asset('neonAssets/js/resizeable.js') }}"></script>
	<script src="{{ asset('neonAssets/js/neon-api.js') }}"></script>
	<script src="{{ asset('neonAssets/js/jquery.validate.min.js') }}"></script>
	<script src="{{ asset('neonAssets/js/neon-login.js') }}"></script>
	<script src="{{ asset('neonAssets/js/neon-custom.js') }}"></script>
	<script src="{{ asset('neonAssets/js/neon-demo.js') }}"></script>
        <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>