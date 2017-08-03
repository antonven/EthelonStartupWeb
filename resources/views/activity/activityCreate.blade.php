@extends('layouts.master')

@section('additional_styles_top')
    <!-- page stylesheets -->
    <link rel="stylesheet" href="{{ asset('reactorAssets/vendor/bootstrap3-wysihtml5-bower/dist/bootstrap3-wysihtml5.min.css') }}">
    <link rel="stylesheet" href="{{ asset('reactorAssets/vendor/summernote/dist/summernote.css') }}">
    <!-- end page stylesheets -->
    <link rel="stylesheet" href="{{ asset('reactorAssets/vendor/blueimp-file-upload/css/jquery.fileupload.css') }}">
    <link rel="stylesheet" href="{{ asset('reactorAssets/vendor/blueimp-file-upload/css/jquery.fileupload-ui.css') }}">
    <!-- page stylesheets -->
    <link rel="stylesheet" href="{{ asset('reactorAssets/vendor/chosen_v1.4.0/chosen.min.css') }}">
    <link rel="stylesheet" href="{{ asset('reactorAssets/vendor/jquery.tagsinput/src/jquery.tagsinput.css') }}">
    <link rel="stylesheet" href="{{ asset('reactorAssets/vendor/checkbo/src/0.1.4/css/checkBo.min.css') }}">
    <link rel="stylesheet" href="{{ asset('reactorAssets/vendor/intl-tel-input/build/css/intlTelInput.css') }}">
    <link rel="stylesheet" href="{{ asset('reactorAssets/vendor/bootstrap-daterangepicker/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('reactorAssets/vendor/bootstrap-datepicker/dist/css/bootstrap-datepicker3.css') }}">
    <link rel="stylesheet" href="{{ asset('reactorAssets/vendor/clockpicker/dist/bootstrap-clockpicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('reactorAssets/vendor/mjolnic-bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('reactorAssets/vendor/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.css') }}">
    <link rel="stylesheet" href="{{ asset('reactorAssets/vendor/jquery-labelauty/source/jquery-labelauty.css') }}">
    <link rel="stylesheet" href="{{ asset('reactorAssets/vendor/multiselect/css/multi-select.css') }}">
    <link rel="stylesheet" href="{{ asset('reactorAssets/vendor/ui-select/dist/select.css') }}">
    <link rel="stylesheet" href="{{ asset('reactorAssets/vendor/select2/dist/css/select2.css') }}">
    <link rel="stylesheet" href="{{ asset('reactorAssets/vendor/selectize/dist/css/selectize.css') }}">
    <!-- end page stylesheets -->
    <!-- page stylesheets -->
    <link rel="stylesheet" href="{{ asset('reactorAssets/vendor/chosen_v1.4.0/chosen.min.css') }}">
    <link rel="stylesheet" href="{{ asset('reactorAssets/vendor/checkbo/src/0.1.4/css/checkBo.min.css') }}">
    <!-- end page stylesheets -->
@endsection

@section('sidebar')
    @include('reactor_includes.sidebar')
@endsection

@section('topheader')
    @include('reactor_includes.topheader')
@endsection

@section('content')
<div class="page-title">
    <div class="title">Create Activity</div>
</div>
<form class="form-horizontal" role="form" action="{{ url('/activity/store') }}" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}
<div class="card bg-white">
    <div class="card-header">
        Activity Details
    </div>
    <div class="card-block">
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Activity Name</label>
                                <div class="col-sm-10">
                                    <div class="row">
                                        <div class="col-xs-9">
                                            <input type="text" class="form-control" name="activityName" required="required">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        
                        
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Activity Skills</label>
                                <div class="col-sm-10">
                                    <div class="row">
                                        <div class="col-xs-9">
                                            <select data-placeholder=" " multiple class="chosen" style="width: 100%;" name="activitySkills[]" required="required">
                                                <option>Environmental</option>
                                                <option>Culinary</option>
                                                <option>Sports</option>
                                                <option>Education</option>
                                                <option>Charity</option>
                                                <option>Livelyhood</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        
                        
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Activity Banner</label>
                                <div class="col-sm-10">
                                    <span class="btn btn-danger fileinput-button">
                                        <i class="icon-plus"></i>
                                        <span>Add files...</span>
                                        <input type="file" name="file" multiple>
                                    </span>
                                </div>
                            </div>
                        
                        
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Activity Description</label>
                                <div class="col-sm-10">
                                    <div class="row">
                                        <div class="col-xs-9">
                                            <textarea class="bootstrap-wysiwyg" placeholder="" name="activityDescription" required="required"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                    <div class="form-group">
                    <label class="col-sm-2 control-label">Number of volunteers</label>
                    </div>
        </div>
        </div>

<div class="card bg-white">
    <div class="card-header">
        Activity Date & Time
    </div>
    <div class="card-block">
        <div class="form-group">
            <label class="col-sm-2 control-label">Start Date</label>
            <div class="col-sm-10">
            <div class="row">
                <div class="col-xs-9">
                    <div class="input-group">
                        <input type="text" class="form-control" data-provide="datepicker" placeholder="Datepicker" name="startDate" required="required">
                        <span class="input-group-addon add-on">
                        <i class="fa fa-clock-o"></i>
                        </span>
                    </div>
                </div>
            </div>
            </div>
        </div>
        
        <div class="form-group">
            <label class="col-sm-2 control-label">Start Time</label>
            <div class="col-sm-10">
            <div class="row">
                <div class="col-xs-9">
                    <div class="input-group">
                        <input type="text" class="form-control time-picker" value="none" name="startTime" required="required">
                        <span class="input-group-addon add-on">
                        <i class="fa fa-clock-o"></i>
                        </span>
                    </div>
                </div>
            </div>
            </div>
        </div>
        
        <div class="form-group">
            <label class="col-sm-2 control-label">End Date</label>
            <div class="col-sm-10">
            <div class="row">
                <div class="col-xs-9">
                    <div class="input-group">
                        <input type="text" class="form-control" data-provide="datepicker" placeholder="Datepicker" name="endDate" required="required">
                        <span class="input-group-addon add-on">
                        <i class="fa fa-clock-o"></i>
                        </span>
                    </div>
                </div>
            </div>
            </div>
        </div>
        
        <div class="form-group">
            <label class="col-sm-2 control-label">End Time</label>
            <div class="col-sm-10">
            <div class="row">
                <div class="col-xs-9">
                    <div class="input-group">
                        <input type="text" class="form-control time-picker" value="none" name="endTime" required="required">
                        <span class="input-group-addon add-on">
                        <i class="fa fa-clock-o"></i>
                        </span>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>
</div>
    
    <div class="card bg-white">
    <div class="card-header">
        Location
    </div>
    <div class="card-block">
        
    </div>
</div>
    <button type="submit" class="btn btn-danger btn-lg btn-icon mr5"><i class="icon-plus"></i><span>Create Event</span></button>
</form>
@endsection

@section('footer')

@endsection

@section('additional_scripts')
    <!-- page scripts -->
    <script src="{{ asset('reactorAssets/vendor/chosen_v1.4.0/chosen.jquery.min.js') }}"></script>
    <script src="{{ asset('reactorAssets/vendor/jquery.tagsinput/src/jquery.tagsinput.js') }}"></script>
    <script src="{{ asset('reactorAssets/vendor/checkbo/src/0.1.4/js/checkBo.min.js') }}"></script>
    <script src="{{ asset('reactorAssets/vendor/intl-tel-input//build/js/intlTelInput.min.js') }}"></script>
    <script src="{{ asset('reactorAssets/vendor/moment/min/moment.min.js') }}"></script>
    <script src="{{ asset('reactorAssets/vendor/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ asset('reactorAssets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js') }}"></script>
    <script src="{{ asset('reactorAssets/vendor/bootstrap-timepicker/js/bootstrap-timepicker.js') }}"></script>
    <script src="{{ asset('reactorAssets/vendor/clockpicker/dist/jquery-clockpicker.min.js') }}"></script>
    <script src="{{ asset('reactorAssets/vendor/mjolnic-bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js') }}"></script>
    <script src="{{ asset('reactorAssets/vendor/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.js') }}"></script>
    <script src="{{ asset('reactorAssets/vendor/select2/dist/js/select2.js') }}"></script>
    <script src="{{ asset('reactorAssets/vendor/selectize/dist/js/standalone/selectize.min.js') }}"></script>
    <script src="{{ asset('reactorAssets/vendor/jquery-labelauty/source/jquery-labelauty.js') }}"></script>
    <script src="{{ asset('reactorAssets/vendor/bootstrap-maxlength/src/bootstrap-maxlength.js') }}"></script>
    <script src="{{ asset('reactorAssets/vendor/typeahead.js/dist/typeahead.bundle.js') }}"></script>
    <script src="{{ asset('reactorAssets/vendor/multiselect/js/jquery.multi-select.js') }}"></script>
    <!-- end page scripts -->
    <!-- initialize page scripts -->
    <script src="{{ asset('reactorAssets/scripts/forms/plugins.js') }}"></script>
    <!-- end initialize page scripts -->
    <!-- page scripts -->
    <script src="{{ asset('reactorAssets/vendor/chosen_v1.4.0/chosen.jquery.min.js') }}"></script>
    <script src="{{ asset('reactorAssets/vendor/card/lib/js/jquery.card.js') }}"></script>
    <script src="{{ asset('reactorAssets/vendor/jquery-validation/dist/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('reactorAssets/vendor/checkbo/src/0.1.4/js/checkBo.min.js') }}"></script>
    <script src="{{ asset('reactorAssets/vendor/twitter-bootstrap-wizard/jquery.bootstrap.wizard.min.js') }}"></script>
    <!-- end page scripts -->
    <!-- initialize page scripts -->
    <script src="{{ asset('reactorAssets/scripts/forms/wizard.js') }}"></script>
    <!-- end initialize page scripts -->
    <!-- The jQuery UI widget factory, can be omitted if jQuery UI is already included -->
    <script src="{{ asset('reactorAssets/vendor/jquery.ui/ui/core.js') }}"></script>
    <script src="{{ asset('reactorAssets/vendor/jquery.ui/ui/widget.js') }}"></script>
    <script src="{{ asset('reactorAssets/vendor/jquery.ui/ui/mouse.js') }}"></script>
    <script src="{{ asset('reactorAssets/vendor/jquery.ui/ui/draggable.js') }}"></script>
    <!-- The Templates plugin is included to render the upload/download listings -->
    <script src="//blueimp.github.io/JavaScript-Templates/js/tmpl.min.js"></script>
    <!-- The Load Image plugin is included for the preview images and image resizing functionality -->
    <script src="//blueimp.github.io/JavaScript-Load-Image/js/load-image.all.min.js"></script>
    <!-- The Canvas to Blob plugin is included for image resizing functionality -->
    <script src="//blueimp.github.io/JavaScript-Canvas-to-Blob/js/canvas-to-blob.min.js"></script>
    <!-- blueimp Gallery script -->
    <script src="//blueimp.github.io/Gallery/js/jquery.blueimp-gallery.min.js"></script>
    <!-- The Iframe Transport is required for browsers without support for XHR file uploads -->
    <script src="{{ asset('reactorAssets/vendor/blueimp-file-upload/js/jquery.iframe-transport.js') }}"></script>
    <!-- The basic File Upload plugin -->
    <script src="{{ asset('reactorAssets/vendor/blueimp-file-upload/js/jquery.fileupload.js') }}"></script>
    <!-- The File Upload processing plugin -->
    <script src="{{ asset('reactorAssets/vendor/blueimp-file-upload/js/jquery.fileupload-process.js') }}"></script>
    <!-- The File Upload image preview & resize plugin -->
    <script src="{{ asset('reactorAssets/vendor/blueimp-file-upload/js/jquery.fileupload-image.js') }}"></script>
    <!-- The File Upload audio preview plugin -->
    <script src="{{ asset('reactorAssets/vendor/blueimp-file-upload/js/jquery.fileupload-audio.js') }}"></script>
    <!-- The File Upload video preview plugin -->
    <script src="{{ asset('reactorAssets/vendor/blueimp-file-upload/js/jquery.fileupload-video.js') }}"></script>
    <!-- The File Upload validation plugin -->
    <script src="{{ asset('reactorAssets/vendor/blueimp-file-upload/js/jquery.fileupload-validate.js') }}"></script>
    <!-- The File Upload user interface plugin -->
    <script src="{{ asset('reactorAssets/vendor/blueimp-file-upload/js/jquery.fileupload-ui.js') }}"></script>
    <!-- end page scripts -->
    <!-- initialize page scripts -->
    <script src="{{ asset('reactorAssets/scripts/forms/upload.js') }}"></script>
    <!-- end initialize page scripts -->
    <!-- page scripts -->
    <script src="{{ asset('reactorAssets/vendor/bootstrap3-wysihtml5-bower/dist/bootstrap3-wysihtml5.all.min.js') }}"></script>
    <script src="{{ asset('reactorAssets/vendor/summernote/dist/summernote.min.js') }}"></script>
    <!-- end page scripts -->
    <!-- initialize page scripts -->
    <script src="{{ asset('reactorAssets/scripts/forms/wysiwyg.js') }}"></script>
    <!-- end initialize page scripts -->
    <script>

    </script>
@endsection