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
							{!! html()->modelForm($bugz, $bugz->exists ? 'put' : 'post', $bugz->exists ? route('admin.bugz.update', $bugz->id) : route('admin.bugz.store'))->open() !!}
							<div class="form-group">
								{!! html()->label('Type', 'type') !!}
								{!! html()->select('type', ['bug' => 'bug', 'design' => 'design', 'comment' => 'comment', 'other' => 'other'], $bugz->type ?? null)->class('form-control') !!}
							</div>
							<div class="form-group">
								{!! html()->label('Screen', 'screen') !!}
								{!! html()->text('screen')->class('form-control input-sm') !!}
							</div>
							<div class="form-group">
								{!! html()->label('Notes', 'notes') !!}
								{!! html()->textarea('notes')->class('form-control input-sm')->attributes(['rows' => '4']) !!}
							</div>
							<div class="form-group">
								{!! html()->label('Priority', 'priority') !!}
								{!! html()->select('priority', ['0' => 'low', '3' => 'medium', '6' => 'high', '9' => 'critical'], $bugz->priority ?? null)->class('form-control') !!}
							</div>
						</div><!-- /.col-md-12 -->
					</div><!-- /.row -->
					<div class="row">
						<div class="col-md-6">
							{!! html()->label('Complete', 'complete') !!}
							<div class="row">
								<div class="col-md-4">
									{!! html()->radio('complete', 1, $bugz->complete)->class('form-control')->id('is-complete-yes') !!}
									{!! html()->label('yes', 'is-complete-yes') !!}
								</div><!-- /.col-md-6 -->
								<div class="col-md-4">
									{!! html()->radio('complete', 0, $bugz->complete)->class('form-control')->id('is-complete-no') !!}
									{!! html()->label('no', 'is-complete-no') !!}
								</div><!-- /.col-md-6 -->
							</div><!-- /.row -->
						</div><!-- /.col-md-6 -->
					</div><!-- row -->
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								{!! html()->label('Note Reply', 'note_reply') !!}
								{!! html()->textarea('note_reply')->class('form-control input-sm')->attributes(['rows' => '4']) !!}
							</div>
						</div><!-- /.col-md-12 -->
					</div><!-- /.row -->
					<div class="row">
						<div class="col-md-6">
							{!! html()->label('Confirmed', 'confirmed') !!}
							<div class="row">
								<div class="col-md-4">
									{!! html()->radio('confirmed', 1, $bugz->confirmed)->class('form-control')->id('is-confirmed-yes') !!}
									{!! html()->label('yes', 'is-confirmed-yes') !!}
								</div><!-- /.col-md-4 -->
								<div class="col-md-4">
									{!! html()->radio('confirmed', 0, $bugz->confirmed)->class('form-control')->id('is-confirmed-no') !!}
									{!! html()->label('no', 'is-confirmed-no') !!}
								</div><!-- /.col-md-4 -->
							</div><!-- /.row -->
						</div><!-- /.col-md-6 -->
					</div><!-- /.row -->
				</div><!-- /.box-body -->
				<div class="box-footer">
					<div class="col-sm-12">
						{!! html()->submit($bugz->exists ? 'Save Bugz' : 'Create New Bugz')->class('btn btn-primary btn-block') !!}
						{!! html()->form()->close() !!}
					</div><!-- /.col-sm-12 -->
				</div><!-- /.box-footer -->
			</div><!-- /.box -->
		</div><!-- /.col-md-6 -->
	</div><!-- /.row -->

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
