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
                        <th>ACTIVITY ID</th>
                        <th>FOUNDATAION ID</th>
                        <th>ACTIVITY NAME</th>
                        <th>DESCRIPTION</th>
                        <th>START DATE</th>
                        <th>END DATE</th>
                        <th>CONTACT INFO</th>
                        <th>CREATED AT</th>
                        <th>ACTIONS</th>
                    </tr>
                </thead>
                	@foreach($activities as $activity)
                	<tr>
                		<td>{{ $activity->activity_id }}</td>
                		<td>{{ $activity->foundation_id }}</td>
                		<td>{{ $activity->name }}</td>
                		<td>{{ $activity->description }}</td>
                		<td>{{ $activity->startDate }}</td>
                		<td>{{ $activity->endDate }}</td>
                		<td>{{ $activity->contactperson.' '.$activity->contact }}</td>
                		<td>{{ $activity->created_at }}</td>
                		<td></td>
                	</tr>
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
	    } );
	    TableManageButtons.init();

	</script>
@endsection