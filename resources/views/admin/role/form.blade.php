@extends('admin.layouts.adminlte')
@section('title', $role->exists ? 'Editing '.$role->name : 'Create New Role')
	@section('style-vendor')
		@parent
	@endsection

	@section('style-plugin')
		@parent
		<link rel="stylesheet" href="/themes/admin-lte/plugins/daterangepicker/daterangepicker-bs3.css">
		<!-- bootstrap datepicker -->
		<link rel="stylesheet" href="/themes/admin-lte/plugins/datepicker/datepicker3.css">
		<!-- iCheck for checkboxes and radio inputs -->
		<link rel="stylesheet" href="/themes/admin-lte/plugins/iCheck/all.css">
		<!-- Bootstrap Color Picker -->
		<link rel="stylesheet" href="/themes/admin-lte/plugins/colorpicker/bootstrap-colorpicker.min.css">
		<!-- Bootstrap time Picker -->
		<link rel="stylesheet" href="/themes/admin-lte/plugins/timepicker/bootstrap-timepicker.min.css">
		<!-- Select2 -->
		<link rel="stylesheet" href="/themes/admin-lte/plugins/select2/select2.min.css">
	@endsection

	@section('style-app')
		@parent
	@endsection
	@section('scripthead')
		@parent
	@endsection

	@section('content')

		<div class="row">
			<div class="col-sm-12">
				<div class="box box-primary">
						<div class="box-header">
							<h3 class="box-title">{{$role->exists ? 'Editing Role: '. $role->name: 'Create New Role'}}</h3>
						</div>
						<div class="box-body">
							{!! html()->modelForm($role, $role->exists ? 'put' : 'post', $role->exists ? route('admin.role.update', $role->id) : route('admin.role.store'))->open() !!}
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										{!! html()->label('Name', 'name') !!}
										{!! html()->text('name')->class('form-control') !!}
									</div>
								</div><!-- /.col-md-6 -->
								<div class="col-md-6">
									<div class="form-group">
										{!! html()->label('Label', 'label') !!}
										{!! html()->text('label')->class('form-control') !!}
									</div>
								</div><!-- /.col-md-6 -->
							</div><!-- /.row -->

							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										{!! html()->label('Permissions:', 'permission_list') !!}
										{!! html()->select('permission_list[]', $rolePermissions, $role->permissions->pluck('id')->toArray())->class('form-control select2')->multiple() !!}
									</div>
								</div><!-- /.col-md-6 -->
							</div><!-- /.row -->

							<div class="box-footer">
								{!! html()->submit($role->exists ? 'Save Role' : 'Create New Role')->class('btn btn-primary pull-right') !!}
								{!! html()->form()->close() !!}
							</div><!-- /.box-footer -->
					</div><!-- /.box -->
			</div><!--	/.col-sm-12 -->
		</div><!--/.row -->
@endsection

@section('footer-vendor')
	@parent
	{{-- <!-- jQuery 2.2.0 -->
	<script src="/themes/adminlte/plugins/jQuery/jQuery-2.2.0.min.js"></script>
	<!-- Bootstrap 3.3.6 -->
	<script src="/themes/adminlte/bootstrap/js/bootstrap.min.js"></script> --}}
@endsection
@section('footer-plugin')
	@parent
	<!-- Select2 -->
	<script src="/themes/admin-lte/plugins/select2/select2.full.min.js"></script>
	<!-- InputMask -->
	<script src="/themes/admin-lte/plugins/input-mask/jquery.inputmask.js"></script>
	<script src="/themes/admin-lte/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
	<script src="/themes/admin-lte/plugins/input-mask/jquery.inputmask.extensions.js"></script>
	<!-- date-range-picker -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
	<script src="/themes/admin-lte/plugins/daterangepicker/daterangepicker.js"></script>
	<!-- bootstrap datepicker -->
	<script src="/themes/admin-lte/plugins/datepicker/bootstrap-datepicker.js"></script>
	<!-- bootstrap color picker -->
	<script src="/themes/admin-lte/plugins/colorpicker/bootstrap-colorpicker.min.js"></script>
	<!-- bootstrap time picker -->
	<script src="/themes/admin-lte/plugins/timepicker/bootstrap-timepicker.min.js"></script>
	<!-- SlimScroll 1.3.0 -->
	<script src="/themes/admin-lte/plugins/slimScroll/jquery.slimscroll.min.js"></script>
	<!-- iCheck 1.0.1 -->
	<script src="/themes/admin-lte/plugins/iCheck/icheck.min.js"></script>
	<!-- FastClick -->
	<script src="/themes/admin-lte/plugins/fastclick/fastclick.js"></script>
	<!-- AdminLTE App -->
	{{-- <script src="/themes/admin-lte/js/app.min.js"></script> --}}
	<!-- AdminLTE for demo purposes -->
	{{-- <script src="/themes/admin-lte/js/demo.js"></script> --}}
@endsection
@section('footer-app')
	@parent
@endsection

@section('footer-script')
    @parent
<!-- Page script -->
			<script>
			  $(function () {
			    //Initialize Select2 Elements
			    $(".select2").select2();

			    //Datemask dd/mm/yyyy
			    $("#datemask").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});
			    //Datemask2 mm/dd/yyyy
			    $("#datemask2").inputmask("mm/dd/yyyy", {"placeholder": "mm/dd/yyyy"});
			    //Money Euro
			    $("[data-mask]").inputmask();

			    //Date range picker
			    $('#reservation').daterangepicker();
			    //Date range picker with time picker
			    $('#reservationtime').daterangepicker({timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A'});
			    //Date range as a button
			    $('#daterange-btn').daterangepicker(
			        {
			          ranges: {
			            'Today': [moment(), moment()],
			            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
			            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
			            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
			            'This Month': [moment().startOf('month'), moment().endOf('month')],
			            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
			          },
			          startDate: moment().subtract(29, 'days'),
			          endDate: moment()
			        },
			        function (start, end) {
			          $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
			        }
			    );

			    //Date picker
			    $('#datepicker').datepicker({
			      autoclose: true
			    });

			    //iCheck for checkbox and radio inputs
			    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
			      checkboxClass: 'icheckbox_minimal-blue',
			      radioClass: 'iradio_minimal-blue'
			    });
			    //Red color scheme for iCheck
			    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
			      checkboxClass: 'icheckbox_minimal-red',
			      radioClass: 'iradio_minimal-red'
			    });
			    //Flat red color scheme for iCheck
			    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
			      checkboxClass: 'icheckbox_flat-green',
			      radioClass: 'iradio_flat-green'
			    });

			    //Colorpicker
			    $(".my-colorpicker1").colorpicker();
			    //color picker with addon
			    $(".my-colorpicker2").colorpicker();

			    //Timepicker
			    $(".timepicker").timepicker({
			      showInputs: false
			    });
			  });
			</script>
	@endsection
