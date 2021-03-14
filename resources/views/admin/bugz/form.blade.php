@extends('admin.layouts.adminlte')
@section('title', 'Bugz')
	@section('style-vendor')
		@parent
	@endsection

	@section('style-plugin')
		@parent
		<!-- iCheck for checkboxes and radio inputs -->
		<link rel="stylesheet" href="/themes/admin-lte/plugins/iCheck/all.css">
	@endsection
	@section('style-app')
		@parent
	@endsection
@section('content')
	@include('admin.layouts.modal')
	<div class="row">
		<div class="col-md-6">
			@include('admin.bugz.subview.quicklist', $bugzs )
		</div><!-- /.col-md-6 -->
		<div class="col-md-6">
			<div class="box box-primary">
					<div class="box-header">
						<h3 class="box-title">{{$bugz->exists ? 'Editing Bugz': 'Create New Bugz'}}</h3>
						@include('admin.layouts.components.boxtools', ['rte' => 'bugz', 'path' => 'admin/bugz'])
					</div>
					<div class="box-body">
						<div class="row">
							<div class="col-md-12">
								{!! Form::model($bugz,[
									'method' => $bugz->exists ? 'put' : 'post',
									'route' => $bugz->exists ? ['admin.bugz.update', $bugz->id] : ['admin.bugz.store']
									]) !!}
									<div class="form-group">
										{!! Form::label('type') !!}
											{!! Form::select('type', array('bug' => 'bug', 'design' => 'design', 'comment'=> 'commment', 'other'=> 'other'), (isset($bugz->type)? $bugz->type: null),['class'=>'form-control'] ) !!}
									</div>
									<div class="form-group">
										{!! Form::label('screen') !!}
										{!! Form::text('screen', null, ['class' => 'form-control input-sm']) !!}
									</div>
									<div class="form-group">
										{!! Form::label('notes') !!}
										{!! Form::textArea('notes', null, ['class' => 'form-control input-sm', 'rows'=>'4']) !!}
									</div>
									<div class="form-group">
										{!! Form::label('priority') !!}
										{!! Form::select('priority', array('0' => 'low', '3' => 'medium', '6'=> 'high', '9'=> 'critical'),(isset($bugz->priority)? $bugz->priority: null), ['class'=>'form-control']) !!}
									</div>
							</div><!-- /.col-md-12 -->
						</div><!-- /.row -->
						<div class="row">
								<div class="col-md-6">
									{!! Form::label('complete') !!}
									<div class="row">
										<div class="col-md-4">
											{!! Form::radio('complete', 1, $bugz->complete,['class' => 'form-control', 'id'=>'is-complete-yes']) !!}  {!! Form::label('complete', 'yes') !!}
										</div><!-- /.col-md-6 -->
										<div class="col-md-4">
											{!! Form::radio('complete', 0, $bugz->complete,['class' => 'form-control', 'id'=>'is-complete-no'] ) !!}  {!! Form::label('complete', 'no') !!}
										</div><!-- /.col-md-6 -->
									</div><!-- /.row -->
								</div><!-- /.col-md-6 -->
							</div><!-- row -->
							<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											{!! Form::label('note_reply') !!}
											{!! Form::textArea('note_reply', null, ['class' => 'form-control input-sm', 'rows'=>'4']) !!}
										</div>
									</div><!-- /.col-md-12 -->
							</div><!-- /.row -->
							<div class="row">
									<div class="col-md-6">
										{!! Form::label('confirmed') !!}

											<div class="row">
												<div class="col-md-4">
													{!! Form::radio('confirmed', 1, $bugz->confirmed,['class' => 'form-control', 'id'=>'is-confirmed-yes']) !!}  {!! Form::label('confirmed', 'yes') !!}
												</div><!-- /.col-md-4 -->
												<div class="col-md-4">
													{!! Form::radio('confirmed', 0, $bugz->confirmed,['class' => 'form-control', 'id'=>'is-confirmed-no'] ) !!}  {!! Form::label('confirmed', 'no') !!}
												</div><!-- /.col-md-4 -->
											</div><!-- /.row -->
									</div><!-- /.col-md-6 -->
							</div><!-- /.row -->
						</div><!-- /.box-body -->
            <div class="box-footer">
								<div class="col-sm-12">
									{!! Form::submit($bugz->exists ? 'Save Bugz' : 'Create New Bugz', ['class' => 'btn btn-primary btn-block']) !!}
									{!! Form::close() !!}
								</div><!-- /.col-sm-12 -->
							</div><!-- /.box-footer -->
					</div><!-- /.box -->

				</div><!--	/.col-sm-6 -->
			</div><!--/.row -->



@endsection
@section('footer-plugin')
	@parent
	<!-- iCheck 1.0.1 -->
	<script src="/themes/admin-lte/plugins/iCheck/icheck.min.js"></script>
@endsection



@section('footer-script')
	@parent
	<script>
	$('input[type="radio"]').iCheck({
		checkboxClass: 'icheckbox_flat-blue',
		radioClass: 'iradio_flat-blue'
	})
	// $('#is-featured-no').iCheck('check');
	// $('#is-featured-yes').iCheck('disable');

	//iCheck for checkbox and radio inputs
	// $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
	// 	checkboxClass: 'icheckbox_minimal-blue',
	// 	radioClass: 'iradio_minimal-blue'
	// });
	</script>



	@endsection
