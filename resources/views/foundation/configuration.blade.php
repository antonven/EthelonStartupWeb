@extends('layouts.hybridMaster')

@section('title')
    Ethelon
@endsection
@section('additional_styles')
		<!-- Editatable  Css-->
        <link rel="stylesheet" href="{{ asset('adminitoAssets/assets/plugins/magnific-popup/dist/magnific-popup.css') }}" />
        <link rel="stylesheet" href="{{ asset('adminitoAssets/assets/plugins/jquery-datatables-editable/datatables.css') }}" />
@endsection

@section('page_title')
Configurations
@endsection

@section('content')
	<div class="row">
        <div class="col-sm-12">
            <div class="card-box">

                <h4 class="header-title m-t-0 m-b-30">Configuration for Badge Points</h4>

                <div class="table-responsive">
                    <table id="mainTable" class="table table-striped m-b-0">
                        <thead>
                            <tr>
                                <th>Badge Name</th>
                                <th>Gauge Points</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td width="40%">Newbie Badge</td>
                                <td width="60%" class="setting" id="newbieGauge">{{ $settings->newbieGauge }}</td>
                              
                            </tr>
                            <tr>
                                <td width="40%">Explorer Badge</td>
                                <td width="60%" class="setting" id="explorerGauge">{{ $settings->explorerGauge }}</td>
                               
                            </tr>
                            <tr>
                                <td width="40%">Expert Badge</td>
                                <td width="60%" class="setting" id="expertGauge">{{ $settings->expertGauge }}</td>
                                
                            </tr>
                            <tr>
                                <td width="40%">Legend Badge</td>
                                <td width="60%" class="setting" id="legendGauge">{{ $settings->legendGauge }}</td>
                                
                            </tr>
                            
                        </tbody>
                        <tfoot>
                           
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-sm-12">
            <div class="card-box">

                <h4 class="header-title m-t-0 m-b-30">Configuration for Activity Points</h4>

                <div class="table-responsive">
                    <table id="mainTable2" class="table table-striped m-b-0">
                        <thead>
                            <tr>
                                <th>Variable Name</th>
                                <th>Points Assigned</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td width="40%">Activity Preset Points Constant</td>
                                <td width="60%" class="setting" id="activityPresetPoints">{{ $settings->activityPresetPoints }}</td>
                              
                            </tr>
                            <tr>
                                <td width="40%">Activity Hours Rendered Constant</td>
                                <td width="60%" class="setting" id="activityHoursRenderedMultiplier">{{ $settings->activityHoursRenderedMultiplier }}</td>
                               
                            </tr>
                                                                           
                        </tbody>
                        <tfoot>
                           
                        </tfoot>
                    </table>
                </div>




            </div>


        </div><!-- end col -->

    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="card-box">

                <h4 class="header-title m-t-0 m-b-30">Configuration for Rating Points</h4>

                <div class="table-responsive">
                    <table id="mainTable3" class="table table-striped m-b-0">
                        <thead>
                            <tr>
                                <th>Variable Name</th>
                                <th>Points Assigned</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td width="40%">Points per rate Constant</td>
                                <td width="60%" class="setting" id="activityPointsPerRating">{{ $settings->activityPointsPerRating }}</td>
                              
                            </tr>
                           
                                                                           
                        </tbody>
                        <tfoot>
                           
                        </tfoot>
                    </table>
                </div>




            </div>


        </div><!-- end col -->

    </div><!-- end row -->

    <div class="row">
        <div class="col-sm-12">
            <div class="card-box">

                <h4 class="header-title m-t-0 m-b-30">Configuration for Groupings</h4>

                <div class="table-responsive">
                    <table id="mainTable4" class="table table-striped m-b-0">
                        <thead>
                            <tr>
                                <th>Variable Name</th>
                                <th>Points Assigned</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td width="40%">Age Percentage</td>
                                <td width="60%" class="setting" id="agePercentage">{{ $settings->agePercentage }}</td>
                              
                            </tr>

                            <tr>
                                <td width="40%">Point Percentage</td>
                                <td width="60%" class="setting" id="pointPercentage">{{ $settings->pointPercentage }}</td>
                              
                            </tr>

                            <tr>
                                <td width="40%">Age Total</td>
                                <td width="60%" class="setting" id="ageTotal">{{ $settings->ageTotal }}</td>
                              
                            </tr>  
                            <tr>
                                <td width="40%">Point Total</td>
                                <td width="60%" class="setting" id="pointTotal">{{ $settings->pointTotal }}</td>
                              
                            </tr>                                            
                                                                           
                        </tbody>
                        <tfoot>
                           
                        </tfoot>
                    </table>
                </div>




            </div>


        </div><!-- end col -->

    </div>
@endsection

@section('additional_scripts')
        <!-- Editable js -->
	    <script src="{{ asset('adminitoAssets/assets/plugins/magnific-popup/dist/jquery.magnific-popup.min.js') }}"></script>
	    <script src="{{ asset('adminitoAssets/assets/plugins/jquery-datatables-editable/jquery.dataTables.js') }}"></script>
	    <script src="{{ asset('adminitoAssets/assets/plugins/datatables/dataTables.bootstrap.js') }}"></script>
	    <script src="{{ asset('adminitoAssets/assets/plugins/tiny-editable/mindmup-editabletable.js') }}"></script>
	    <script src="{{ asset('adminitoAssets/assets/plugins/tiny-editable/numeric-input-example.js') }}"></script>
		<!-- init -->
	    <script src="{{ asset('adminitoAssets/assets/pages/datatables.editable.init.js') }}"></script>


	<script type="text/javascript">
		$('#mainTable').editableTableWidget().numericInputExample().find('td:first').focus();
		$('#mainTable2').editableTableWidget().numericInputExample().find('td:first').focus();
		$('#mainTable3').editableTableWidget().numericInputExample().find('td:first').focus();
		$('#mainTable4').editableTableWidget().numericInputExample().find('td:first').focus();

		$(document).ready(function(){
			$(".setting").on('change', function(){
				var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
	            $.ajax({
	                method: "post",
	                url: "{{ url('/admin/setting/update') }}"+"/"+$(this).attr('id')+"/"+$(this).text(),
	                data: {'_token': CSRF_TOKEN,
	                'input': '1'
	                       },
	                success: function(valid) {
	                    alert("Successfully Updated");
	                },
	                error: function(error) {
	                    console.log(error);
	                }
	            });
			});
		});
	</script>
@endsection