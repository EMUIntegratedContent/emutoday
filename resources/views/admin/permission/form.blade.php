@extends('admin.layouts.adminlte')
@section('title', $permission->exists ? 'Editing '.$permission->name : 'Create New Permission')
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
							<h3 class="box-title">{{$permission->exists ? 'Editing Permission: '. $permission->name: 'Create New Permission'}}</h3>
						</div>
						<div class="box-body">

						{!! Form::model($permission,[
							'method' => $permission->exists ? 'put' : 'post',
							'route' => $permission->exists ? ['admin.permission.update', $permission->id] : ['admin.permission.store']
							]) !!}

									<div class="form-group">
										{!! Form::label('name') !!}
										{!! Form::text('name', null, ['class' => 'form-control']) !!}
									</div>
									<div class="form-group">
										{!! Form::label('label') !!}
										{!! Form::text('label', null, ['class' => 'form-control']) !!}
									</div>

								</div><!-- /.box-body -->
								<div class="box-footer">
									{!! Form::submit($permission->exists ? 'Save Permission' : 'Create New Permission', ['class' => 'btn btn-primary pull-right']) !!}
									{!! Form::close() !!}
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
