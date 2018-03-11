@extends('layouts.hybridMaster')

@section('page_title')
    Volunteers
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
            <div class="col-lg-12 col-md-12">
                <div class="input-group">
                    <input type="text" class="form-control" style="border: 1px solid #AAAAAA;" placeholder="Search Volunteer">
                    <span class="input-group-addon btn-primary" style="border-top-right-radius: 4px; border-bottom-right-radius: 4px;"><span class="fa fa-search"></span></span>
                </div>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-lg-3 col-md-6">
                <div class="card-box widget-user">
                    <div>
                        <img src="{{ asset('users/avatar-1.jpg') }}" class="img-responsive img-circle" alt="user">
                        <div class="wid-u-info">
                            <h4 class="m-t-0 m-b-5">Tocino</h4>
                            <p class="text-muted m-b-5 font-13">tocino@gmail.com</p>
                            <small class="text-warning"><b>Admin</b></small>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="card-box widget-user">
                    <div>
                        <img src="{{ asset('users/avatar-2.jpg') }}" class="img-responsive img-circle" alt="user">
                        <div class="wid-u-info">
                            <h4 class="m-t-0 m-b-5">Grish</h4>
                            <p class="text-muted m-b-5 font-13">grish@gmail.com</p>
                            <small class="text-custom"><b>Admin</b></small>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="card-box widget-user">
                    <div>
                        <img src="{{ asset('users/avatar-3.jpg') }}" class="img-responsive img-circle" alt="user">
                        <div class="wid-u-info">
                            <h4 class="m-t-0 m-b-5">Stillnotdavid</h4>
                            <p class="text-muted m-b-5 font-13">stillndavid@gmail.com</p>
                            <small class="text-success"><b>Admin</b></small>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="card-box widget-user">
                    <div>
                        <img src="{{ asset('users/avatar-4.jpg') }}" class="img-responsive img-circle" alt="user">
                        <div class="wid-u-info">
                            <h4 class="m-t-0 m-b-5">Tomaslau</h4>
                            <p class="text-muted m-b-5 font-13">tomaslau@gmail.com</p>
                            <small class="text-info"><b>Admin</b></small>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="card-box widget-user">
                    <div>
                        <img src="{{ asset('users/avatar-5.jpg') }}" class="img-responsive img-circle" alt="user">
                        <div class="wid-u-info">
                            <h4 class="m-t-0 m-b-5">Kini Law</h4>
                            <p class="text-muted m-b-5 font-13">klaw@gmail.com</p>
                            <small class="text-warning"><b>Admin</b></small>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="card-box widget-user">
                    <div>
                        <img src="{{ asset('users/avatar-6.jpg') }}" class="img-responsive img-circle" alt="user">
                        <div class="wid-u-info">
                            <h4 class="m-t-0 m-b-5">Magicman11youtube</h4>
                            <p class="text-muted m-b-5 font-13">magicman11youtube@gmail.com</p>
                            <small class="text-custom"><b>Admin</b></small>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="card-box widget-user">
                    <div>
                        <img src="{{ asset('users/avatar-7.jpg') }}" class="img-responsive img-circle" alt="user">
                        <div class="wid-u-info">
                            <h4 class="m-t-0 m-b-5">Daddy Jlaw</h4>
                            <p class="text-muted m-b-5 font-13">djlaw@gmail.com</p>
                            <small class="text-success"><b>Admin</b></small>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="card-box widget-user">
                    <div>
                        <img src="{{ asset('users/avatar-8.jpg') }}" class="img-responsive img-circle" alt="user">
                        <div class="wid-u-info">
                            <h4 class="m-t-0 m-b-5">Boss Gilralph</h4>
                            <p class="text-muted m-b-5 font-13">bossgr@gmail.com</p>
                            <small class="text-info"><b>Admin</b></small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('additional_scripts')

    
@endsection