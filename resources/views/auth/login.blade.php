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

        <!-- Notification css (Toastr) -->
        <link href="{{ asset('adminitoAssets/assets/plugins/toastr/toastr.min.css') }}" rel="stylesheet" type="text/css" />

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
                @if (session('message'))
                    {{ session('message') }}
                @endif
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
					<p class="text-muted" style="color:black !important;">Don't have an account yet?<a href="{{ route('register') }}" class="text-primary m-l-5"><b style="color:red !important;">Register here</b></a></p>
				</div>
			</div>

        </div>
        <!-- end wrapper page -->
        </form>
        <input id="title" type="text" class="input-large form-control" placeholder="Enter a title ..." value="Registration Successful!" hidden />
        <textarea class="input-large form-control" id="message" rows="3" placeholder="Enter a message ..." hidden>It will take some time to check your credentials. If there are no problems your account will be verified in no time!</textarea>
        <div class="control-group" id="toastTypeGroup">
            <input type="radio" name="radio" id="radio1" value="success" checked hidden>
        </div>
        <div class="control-group" id="positionGroup">
            <input type="radio" name="positions" id="radio9" value="toast-top-full-width" checked hidden />
        </div>
        <div class="control-group">
            <div class="controls">
                
                <input id="showEasing" type="text" placeholder="swing, linear" class="input-mini form-control" value="swing" hidden />

                <
                <input id="hideEasing" type="text" placeholder="swing, linear" class="input-mini form-control" value="linear" hidden />

                
                <input id="showMethod" type="text" placeholder="show, fadeIn, slideDown" class="input-mini form-control" value="fadeIn" hidden />

                
                <input id="hideMethod" type="text" placeholder="hide, fadeOut, slideUp" class="input-mini form-control" value="fadeOut" hidden />
            </div>
        </div>
        <div class="control-group">
            <div class="controls">
                
                <input id="showDuration" type="text" placeholder="ms" class="input-mini form-control" value="300" hidden />

                
                <input id="hideDuration" type="text" placeholder="ms" class="input-mini form-control" value="1000" hidden />

                
                <input id="timeOut" type="text" placeholder="ms" class="input-mini form-control" value="5000" hidden />

                
                <input id="extendedTimeOut" type="text" placeholder="ms" class="input-mini form-control" value="1000" hidden />
            </div>
        </div>



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

        <!-- Toastr js -->
        <script src="{{ asset('adminitoAssets/assets/plugins/toastr/toastr.min.js') }}"></script>

        <!-- App js -->
        <script src="{{ asset('adminitoAssets/assets/js/jquery.core.js') }}"></script>
        <script src="{{ asset('adminitoAssets/assets/js/jquery.app.js') }}"></script>

        @if(session('message'))
        <script type="text/javascript">
            $(function () {
                var i = -1;
                var toastCount = 0;
                var $toastlast;

                var getMessage = function () {
                    var msgs = ['My name is Inigo Montoya. You killed my father. Prepare to die!',
                        'Are you the six fingered man?',
                        'Inconceivable!',
                        'I do not think that means what you think it means.',
                        'Have fun storming the castle!'
                    ];
                    i++;
                    if (i === msgs.length) {
                        i = 0;
                    }

                    return msgs[i];
                };

                var getMessageWithClearButton = function (msg) {
                    msg = msg ? msg : 'Clear itself?';
                    msg += '<br /><br /><button type="button" class="btn btn-default clear">Yes</button>';
                    return msg;
                };

                
                    var shortCutFunction = $("#toastTypeGroup input:radio:checked").val();
                    var msg = $('#message').val();
                    var title = $('#title').val() || '';
                    var $showDuration = $('#showDuration');
                    var $hideDuration = $('#hideDuration');
                    var $timeOut = $('#timeOut');
                    var $extendedTimeOut = $('#extendedTimeOut');
                    var $showEasing = $('#showEasing');
                    var $hideEasing = $('#hideEasing');
                    var $showMethod = $('#showMethod');
                    var $hideMethod = $('#hideMethod');
                    var toastIndex = toastCount++;
                    var addClear = $('#addClear').prop('checked');

                    toastr.options = {
                        closeButton: false,
                        debug: false,
                        newestOnTop: false,
                        progressBar: false,
                        positionClass: "toast-top-full-width",
                        preventDuplicates: false,
                        onclick: null
                    };

                    if ($('#addBehaviorOnToastClick').prop('checked')) {
                        toastr.options.onclick = function () {
                            alert('You can perform some custom action after a toast goes away');
                        };
                    }

                    if ($showDuration.val().length) {
                        toastr.options.showDuration = $showDuration.val();
                    }

                    if ($hideDuration.val().length) {
                        toastr.options.hideDuration = $hideDuration.val();
                    }

                    if ($timeOut.val().length) {
                        toastr.options.timeOut = addClear ? 0 : $timeOut.val();
                    }

                    if ($extendedTimeOut.val().length) {
                        toastr.options.extendedTimeOut = addClear ? 0 : $extendedTimeOut.val();
                    }

                    if ($showEasing.val().length) {
                        toastr.options.showEasing = $showEasing.val();
                    }

                    if ($hideEasing.val().length) {
                        toastr.options.hideEasing = $hideEasing.val();
                    }

                    if ($showMethod.val().length) {
                        toastr.options.showMethod = $showMethod.val();
                    }

                    if ($hideMethod.val().length) {
                        toastr.options.hideMethod = $hideMethod.val();
                    }

                    if (addClear) {
                        msg = getMessageWithClearButton(msg);
                        toastr.options.tapToDismiss = false;
                    }
                    if (!msg) {
                        msg = getMessage();
                    }

                    $('#toastrOptions').text('Command: toastr["'
                            + shortCutFunction
                            + '"]("'
                            + msg
                            + (title ? '", "' + title : '')
                            + '")\n\ntoastr.options = '
                            + JSON.stringify(toastr.options, null, 2)
                    );

                    var $toast = toastr[shortCutFunction](msg, title); // Wire up an event handler to a button in the toast, if it exists
                    $toastlast = $toast;

                    if (typeof $toast === 'undefined') {
                        return;
                    }

                    if ($toast.find('#okBtn').length) {
                        $toast.delegate('#okBtn', 'click', function () {
                            alert('you clicked me. i was toast #' + toastIndex + '. goodbye!');
                            $toast.remove();
                        });
                    }
                    if ($toast.find('#surpriseBtn').length) {
                        $toast.delegate('#surpriseBtn', 'click', function () {
                            alert('Surprise! you clicked me. i was toast #' + toastIndex + '. You could perform an action here.');
                        });
                    }
                    if ($toast.find('.clear').length) {
                        $toast.delegate('.clear', 'click', function () {
                            toastr.clear($toast, {force: true});
                        });
                    }


                function getLastToast() {
                    return $toastlast;
                }

                $('#clearlasttoast').click(function () {
                    toastr.clear(getLastToast());
                });
                $('#cleartoasts').click(function () {
                    toastr.clear();
                });
            })
        </script>
        @endif

	</body>
</html>