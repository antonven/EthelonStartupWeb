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
<div id="body-con">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel-group m-b-0" id="accordion" role="tablist" aria-multiselectable="true">
                <div class="panel panel-default bx-shadow-none">
                    <div class="panel-heading" role="tab" id="headingOne">
                        <h4 class="panel-title">
                            <a role="button" data-toggle="collapse"
                               data-parent="#accordion" href="#collapseOne"
                               aria-expanded="true" aria-controls="collapseOne">
                                Settings
                            </a>
                        </h4>
                    </div>
                    <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                        <div class="panel-body">
                            <div class="form-group col-lg-8 ">
                                <label class="control-label " for="portfolioSettings">Portfolio Type</label>
                                <select class="form-control" name="portfolioSettings" id="portfolioSettings">
                                    @if(\Auth::user()->foundation->portfolio->portfolioType == null)
                                        <option value="0">Basic Template</option>
                                        <option value="1">Template Editor</option>
                                    @else
                                        @if(\Auth::user()->foundation->portfolio->portfolioType == 0)
                                        <option value="0" selected>Basic Template</option>
                                        @else
                                        <option value="0">Basic Template</option>
                                        @endif
                                        @if(\Auth::user()->foundation->portfolio->portfolioType == 1)
                                        <option value="1" selected>Template Editor</option>
                                        @else
                                        <option value="1">Template Editor</option>
                                        @endif
                                    @endif
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myModalLabel">Create new template</h4>
            </div>
            <div class="modal-body">
                <form method="post" action="{{ url('/portfolio/createTemplate') }}">
                    {{ csrf_field() }}
                <div class="form-group">
                    <label class="control-label " for="templateName">Template Name</label>
                    <input type="text" name="templateName" id="templateName" class="form-control">
                    @if ($errors->has('templateName'))
                    <center>
                        <span class="help-block" style="color:red;">
                            <strong>{{ $errors->first('templateName') }}</strong>
                        </span>
                    </center>
                    @endif
                </div>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary waves-effect waves-light" id="createTemplate">Create</button>
            </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
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

    <script>
        $(window).load(function(){
            //on load get value of select
            if($("#portfolioSettings").val() == "0")
            {
                var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    method: "post",
                    url: "{{ url('/portfolio/setPortfolioSetting') }}"+'/{{ \Auth::user()->foundation->foundation_id }}',
                    data: {'_token': CSRF_TOKEN,
                           'setting': 0
                           },
                    success: function(members) {
                      $("#body-con").append('<h4 class="page-title" id="template-title">Basic Template</h4><div class="row" id="template"><div class="col-lg-12"><div class="card-box"><h3>asda</h3></div></div></div>');
                    },
                    error: function() {

                        
                    }
                });
            }
            else
            {
                var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    method: "post",
                    url: "{{ url('/portfolio/setPortfolioSetting') }}"+'/{{ \Auth::user()->foundation->foundation_id }}',
                    data: {'_token': CSRF_TOKEN,
                           'setting': 1
                           },
                    success: function(members) {
                      $("#body-con").append('<h4 class="page-title" id="template-title">Template Editor</h4><div class="row" id="template"><div class="col-lg-12"><div class="card-box"><h3>Template Editor</h3></div></div></div>');
                    },
                    error: function() {

                        alert('An error occured.');
                    }
                });
            }
            //get value on change
            $("#portfolioSettings").on('change', function(){
                if($("#portfolioSettings").val() == "0")
                {
                    $('#template-title').remove();
                    $('#template').remove();
                    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                    $.ajax({
                        method: "post",
                        url: "{{ url('/portfolio/setPortfolioSetting') }}"+'/{{ \Auth::user()->foundation->foundation_id }}',
                        data: {'_token': CSRF_TOKEN,
                               'setting': 0
                               },
                        success: function(members) {
                          $("#body-con").append('<h4 class="page-title" id="template-title">Basic Template</h4><div class="row" id="template"><div class="col-lg-12"><div class="card-box"><h3>asda</h3></div></div></div>');
                        },
                        error: function() {

                           
                        }
                    });
                }
                else
                {
                    $('#template-title').remove();
                    $('#template').remove();
                    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                    $.ajax({
                        method: "post",
                        url: "{{ url('/portfolio/setPortfolioSetting') }}"+'/{{ \Auth::user()->foundation->foundation_id }}',
                        data: {'_token': CSRF_TOKEN,
                               'setting': 1
                               },
                        success: function(members) {
                          $("#body-con").append('<h4 class="page-title" id="template-title">Template Editor</h4><div class="row" id="template"><div class="col-lg-12"><div class="card-box"><div class="row"><div class="col-lg-2"><button type="button" id="createActivity" class="btn btn-danger btn-block btn-bordred waves-effect w-md waves-light" data-toggle="modal" data-target="#myModal">Create Template</button></div></div></div></div></div>');
                          
                        },
                        error: function() {

                            alert('An error occured.');
                        }
                    });
                }
            });

        
        });
    </script>
    @if ($errors->has('templateName'))
        <script>
            $('#myModal').modal();
        </script>
    @endif
@endsection