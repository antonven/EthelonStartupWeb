@extends('layouts.hybridMaster')

@section('title')
    Ethelon
@endsection
@section('additional_styles')
    <!-- DataTables -->
    <link href="{{ asset('adminitoAssets/assets/plugins/datatables/jquery.dataTables.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('adminitoAssets/assets/plugins/datatables/buttons.bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('adminitoAssets/assets/plugins/datatables/fixedHeader.bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('adminitoAssets/assets/plugins/datatables/responsive.bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('adminitoAssets/assets/plugins/datatables/scroller.bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
	<div class="row">
		<div class="col-sm-12">
		    <div class="card-box table-responsive">

				<h4 class="header-title m-t-0 m-b-30">Foundation List</h4>

		        <table id="datatable" class="table table-striped table-bordered">
		            <thead>
		                <tr>
		                    <th style="white-space: nowrap;">FOUNDATION ID</th>
		                    <th style="white-space: nowrap;">FOUNDATAION NAME</th>
		                    <th style="white-space: nowrap;">EMAIL</th>
		                    <th style="white-space: nowrap;">LOCATION</th>
		                    <th style="white-space: nowrap;">FACEBOOK</th>
		                    <th style="white-space: nowrap;">WEBSITE</th>
		                    <th style="white-space: nowrap;">CREATED AT</th>
		                    <th style="white-space: nowrap;">ACTIONS</th>
		                </tr>
		            </thead>
		            	@foreach($foundations as $foundation)
		            	@if($foundation->user->verified == 0)
		            	<tr>
		            		<td style="white-space: nowrap;">{{ $foundation->foundation_id }}</td>
		            		<td style="white-space: nowrap;">{{ $foundation->user->name }}</td>
		            		<td style="white-space: nowrap;">{{ $foundation->email }}</td>
		            		<td style="white-space: nowrap;">{{ $foundation->location }}</td>
		            		<td style="white-space: nowrap;">{{ $foundation->facebook_url }}</td>
		            		<td style="white-space: nowrap;">{{ $foundation->website_url }}</td>
		            		<td style="white-space: nowrap;">{{ $foundation->created_at }}</td>
		            		<td style="white-space: nowrap;">
		            		<button id="verify" style="background-color: green;" value="{{ $foundation->user->user_id }}" class="btn btn-icon waves-effect waves-light btn-success m-b-5"> <i class="fa fa-check"></i> </button>
		            		</td>
		            	</tr>
		            	@endif
		            	@endforeach
		            <tbody>
		            </tbody>
		        </table>
		    </div>
		</div><!-- end col -->
	</div>
@endsection

@section('additional_scripts')
	<!-- Datatables-->
    <script src="{{ asset('adminitoAssets/assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('adminitoAssets/assets/plugins/datatables/dataTables.bootstrap.js') }}"></script>
    <script src="{{ asset('adminitoAssets/assets/plugins/datatables/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('adminitoAssets/assets/plugins/datatables/buttons.bootstrap.min.js') }}"></script>
    <script src="{{ asset('adminitoAssets/assets/plugins/datatables/jszip.min.js') }}"></script>
    <script src="{{ asset('adminitoAssets/assets/plugins/datatables/pdfmake.min.js') }}"></script>
    <script src="{{ asset('adminitoAssets/assets/plugins/datatables/vfs_fonts.js') }}"></script>
    <script src="{{ asset('adminitoAssets/assets/plugins/datatables/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('adminitoAssets/assets/plugins/datatables/buttons.print.min.js') }}"></script>
    <script src="{{ asset('adminitoAssets/assets/plugins/datatables/dataTables.fixedHeader.min.js') }}"></script>
    <script src="{{ asset('adminitoAssets/assets/plugins/datatables/dataTables.keyTable.min.js') }}"></script>
    <script src="{{ asset('adminitoAssets/assets/plugins/datatables/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('adminitoAssets/assets/plugins/datatables/responsive.bootstrap.min.js') }}"></script>
    <script src="{{ asset('adminitoAssets/assets/plugins/datatables/dataTables.scroller.min.js') }}"></script>

    <!-- Datatable init js -->
    <script src="{{ asset('adminitoAssets/assets/pages/datatables.init.js') }}"></script>
	<script type="text/javascript">
	    $(document).ready(function() {
	        $('#datatable').dataTable();

	        $('#verify').on('click', function(){
	       		window.location = "{{ url('/admin/verify') }}"+"/"+$('#verify').val();
	        });
	    } );
	    TableManageButtons.init();

	</script>
@endsection