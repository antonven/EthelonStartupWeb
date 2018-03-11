@extends('layouts.hybridMaster')

@section('page_title')
    Portfolio
@endsection
@section('additional_styles')
    <!--Morris Chart CSS -->
    <link rel="stylesheet" href="{{ asset('adminitoAssets/assets/plugins/morris/morris.css') }}">

    <style type="text/css">

        #div-add-template{
            padding: 138px 0px; text-align: center; display: table-cell; vertical-align: middle;
        }
        .div-custom-template{
            min-height: 353px; height: 100%; padding: 0px;
        }
        @media (max-width: 1280px) {
            #div-add-template{
                padding: 138px 0px;
            }
            .div-custom-template{
                min-height: 395px; height: 100%;
            }
        }
    </style>

@endsection

@section('content')
    <meta name ="csrf-token" content = "{{csrf_token() }}"/>

    <div class="container">
        <br>
        <div class="row">
        <div class="col-lg-3" id="createTemplate">
            <div class="card-box project-box addactbtn" id="createActivity" style="display: table; width: 100%;">
                <div id="div-add-template">
                    <span style="font-size: 26px; text-indent: 1px; padding: 3px 12px; border: 2px solid #797979; border-radius: 50%;">+</span>
                    <h4 style="margin-top: 20px;">Add a Template</h4>
                </div>
            </div>
        </div>
        
        <!--
        <div class="col-lg-3">
            <center>
                <div class="card-box project-box addactbtn" id="createActivity" style="border-top: 3px solid #ff5b5b;">
                <div class="div-custom-template">
                    <h3>My Custom Template</h3>
                    <p>Date Modified: Mar 24 2018</p>
                    <br>
                    <div style="margin-bottom: 55px;">
                        <span><button class="btn" style="background: #337ab7; color: #fafafa; letter-spacing: 1px;"><span class="fa fa-eye"></span> PREVIEW</button></span>
                        <span><button class="btn btn-danger" style="letter-spacing: 1px;"><span class="fa fa-pencil"></span> EDIT</button></span>
                    </div>
                    <button class="btn btn-danger" style="position: absolute; left: 0px; bottom: 0px; width: 100%; border-radius: 0px; padding: 10px; letter-spacing: 1px;">ACTIVATE</button>
                </div>
            </div>
            </center>
        </div>

        <div class="col-lg-3">
            <center>
                <div class="card-box project-box addactbtn" id="createActivity" style="border-top: 3px solid #10c469">
                <div class="div-custom-template">
                    <h3>My Second Favorite Custom</h3>
                    <p>Date Modified: Mar 24 2018</p>
                    <br>
                    <div style="margin-bottom: 55px;">
                        <span><button class="btn" style="background: #337ab7; color: #fafafa; letter-spacing: 1px;"><span class="fa fa-eye"></span> PREVIEW</button></span>
                        <span><button class="btn btn-danger" style="letter-spacing: 1px;"><span class="fa fa-pencil"></span> EDIT</button></span>
                    </div>
                    <button class="btn btn-success" style="position: absolute; left: 0px; bottom: 0px; width: 100%; border-radius: 0px; padding: 10px; letter-spacing: 1px;">ACTIVATED</button>
                </div>
            </div>
            </center>
        </div>

        <div class="col-lg-3">
            <center>
                <div class="card-box project-box addactbtn" id="createActivity" style="border-top: 3px solid #ff5b5b">
                <div class="div-custom-template">
                    <h3>My Favorite Custom Template</h3>
                    <p>Date Modified: Mar 24 2018</p>
                    <br>
                    <div style="margin-bottom: 55px;">
                        <span><button class="btn" style="background: #337ab7; color: #fafafa; letter-spacing: 1px;"><span class="fa fa-eye"></span> PREVIEW</button></span>
                        <span><button class="btn btn-danger" style="letter-spacing: 1px;"><span class="fa fa-pencil"></span> EDIT</button></span>
                    </div>
                    <button class="btn btn-danger" style="position: absolute; left: 0px; bottom: 0px; width: 100%; border-radius: 0px; padding: 10px; letter-spacing: 1px;">ACTIVATE</button>
                </div>
            </div>
            </center>
        </div>
    -->
    @foreach(\Auth::user()->foundation->portfolio->templates as $template)
    <div class="col-lg-3">
            <center>
                <div class="card-box project-box addactbtn editor" id="createActivity" style="border-top: 3px solid #ff5b5b">
                <div class="div-custom-template">
                    <h3>{{ $template->template_name }}</h3>
                    <p>Date Modified: Mar 24 2018</p>
                    <br>
                    <input type="text" class="template_name" value="{{ $template->template_name }}" hidden=""> 
                    @if($template->active == 0)
                    <button class="btn btn-danger activate" value="{{ $template->id }}" style="position: absolute; left: 0px; bottom: 0px; width: 100%; border-radius: 0px; padding: 10px; letter-spacing: 1px;">ACTIVATE</button>
                    @else
                    <button class="btn btn-success activate" value="{{ $template->id }}" style="position: absolute; left: 0px; bottom: 0px; width: 100%; border-radius: 0px; padding: 10px; letter-spacing: 1px;">ACTIVATED</button>
                    @endif
                </div>
            </div>
            </center>
        </div>
    @endforeach

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
                    <form method="post" action="{{ url('/portfolio/createTemplate') }}" id="templateForm">
                        {{ csrf_field() }}
                    <div class="form-group">
                        <label class="control-label " for="templateName">Template Name</label>
                        <input type="text" name="templateName" id="templateName" class="form-control">
                        <div id="error">
                            
                        </div>
                    </div>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary waves-effect waves-light" id="submitForm">Create</button>
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
        $('.activate').on('click',function(e){
            e.stopPropagation();
            window.location = "{{ url('/portfolio/activate') }}"+"/"+$(this).val();
        });

        $('.editor').on('click', function(e){
            window.location = "{{ url('/editor') }}"+"/"+$(this).find('.template_name').val();
        });

        $('#createTemplate').on('click', function(){
            $('#myModal').modal();
        });

        $('#submitForm').on('click', function(){
            var formTemplateName = $('#templateName').val();
            var valid = sendForm(formTemplateName);
        });

        function sendForm(input)
        {
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                method: "post",
                url: "{{ url('/portfolio/checkTemplate') }}",
                data: {'_token': CSRF_TOKEN,
                       'templateName': input
                       },
                success: function(valid) {
                    $('#templateForm').submit();
                },
                error: function(error) {
                    console.log("error on sendForm");
                    console.log(error);
                    $('#error').append('<center><span class="help-block" style="color:red;"><strong>'+error.responseJSON.templateName[0]+'</strong></span></center>');
                }
            });
        }
    </script>
    
@endsection