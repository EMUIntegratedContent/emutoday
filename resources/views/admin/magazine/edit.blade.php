@inject('yearList', 'Emutoday\Http\Utilities\YearList')
@inject('seasonList', 'Emutoday\Http\Utilities\SeasonList')
@extends('admin.layouts.adminlte')
@section('title', 'Edit Magazine')
@section('style-vendor')
  @parent
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="/themes/admin-lte/plugins/iCheck/all.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="/themes/admin-lte/plugins/select2/select2.min.css">

@endsection

@section('style-plugin')
  @parent
  <link rel="stylesheet" href="/themes/plugins/flatpickr/flatpickr.min.css" type="text/css" media="screen"/>

@endsection

@section('style-app')
  @parent

@endsection

@section('scripts-vendor')
  <!-- Vendor Scripts that need to be loaded in the header before other plugin or app scripts -->
  @parent
@endsection
@section('scripts-plugin')
  <!-- Scripts  for code libraries and plugins that need to be loaded in the header -->
  <script src="/themes/plugins/flatpickr/flatpickr.js"></script>
  @parent
@endsection
@section('scripts-app')
  <!-- App related Scripts  that need to be loaded in the header -->
  @parent
@endsection

@section('content')

  <div class="row">
    {!! html()->modelForm($magazine, 'put', route('admin_magazine_update', $magazine->id))->attributes(['id' => 'edit_magazine_form'])->open() !!}
    <div class="col-sm-6">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Edit Magazine Content</h3>
          @include('admin.components.boxtools', ['rte' => 'magazine', 'path' => 'admin/magazine/', 'cuser'=>$currentUser, 'id'=>$magazine->id])
        </div><!-- /.box-header -->
        <div class="box-body">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                {!! html()->label('Year', 'year') !!}
                {!! html()->select('year', $yearList::all())->class('form-control select2')->id('select-year') !!}
              </div>
            </div><!-- /.col-md-4 -->
            <div class="col-md-6">
              <div class="form-group">
                {!! html()->label('Season', 'season') !!}
                {!! html()->select('season', $seasonList::all())->class('form-control select2')->id('select-season') !!}
              </div>
            </div><!-- /.col-md-4 -->
          </div><!-- /.row -->
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                {!! html()->label('Start Date', 'start_date') !!}
                {!! html()->text('start_date')->class('form-control')->id('start-date') !!}
              </div>
            </div><!-- /.col-md-6 -->
            <div class="col-md-6">
              <div class="form-group">
                {!! html()->label('End Date', 'end_date') !!}
                {!! html()->text('end_date')->class('form-control')->id('end-date') !!}
              </div>
            </div><!-- /.col-md-6 -->
          </div><!-- /.row -->
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                {!! html()->label('Title', 'title') !!}
                {!! html()->text('title')->class('form-control') !!}
              </div>
              <div class="form-group">
                {!! html()->label('Teaser', 'teaser') !!}
                {!! html()->text('teaser')->class('form-control') !!}
              </div>
              <div class="form-group">
                {!! html()->label('Digital Version URL:', 'ext_url') !!}
                {!! html()->text('ext_url')->class('form-control') !!}
              </div>
            </div><!-- /.col-md-12 -->
          </div><!-- /.row -->
          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                {!! html()->label('Published?', 'is_published')->class('text-center') !!}
                <div class="row">
                  <div class="col-md-4">
                    {!! html()->radio('is_published', 1, $magazine->is_published)->class('form-control')->id('is-published-yes') !!} {!! html()->label('yes', 'is_published') !!}
                  </div><!-- /.col-md-4 -->
                  <div class="col-md-4">
                    {!! html()->radio('is_published', 0, $magazine->is_published)->class('form-control')->id('is-published-no') !!} {!! html()->label('no', 'is_published') !!}
                  </div><!-- /.col-md-4 -->
                </div><!-- /.row -->
              </div><!-- /.form-group -->
            </div><!-- /.col-md-4 -->
            <div class="col-md-4">
              <div class="form-group">
                {!! html()->label('Is Archived?', 'is_archived') !!}
                <div class="row">
                  <div class="col-md-6">
                    {!! html()->radio('is_archived', 1, $magazine->is_archived)->class('form-control')->id('is-archived-yes') !!} {!! html()->label('yes', 'is_archived') !!}
                  </div><!-- /.col-md-6 -->
                  <div class="col-md-6">
                    {!! html()->radio('is_archived', 0, $magazine->is_archived)->class('form-control')->id('is-archived-no') !!} {!! html()->label('no', 'is_archived') !!}
                  </div><!-- /.col-md-6 -->
                </div><!-- /.row -->
              </div><!-- /.form-group -->
            </div><!-- /.col-md-4 -->
            <div class="col-md-4">
            </div><!-- /.col-md-4 -->
          </div><!-- /.row -->
        </div><!-- /.box-body -->
        <div class="box-footer">
          <div class="form-group">
            {!! html()->submit('Update Magazine Content')->class('btn btn-primary btn-block') !!}
            {!! html()->form()->close() !!}
          </div>
        </div><!-- /.box-footer -->
      </div><!-- /.box -->
    </div><!-- /.col-sm-6 -->

    <div class="col-sm-6">
      @if(count($mediafiles) > 0 )
        @foreach ($mediafiles as $mediafile)
          @include('admin.magazine.subviews.coverimage')
        @endforeach
      @endif
    </div><!-- /.col-sm-6 -->
  </div><!-- /.row -->
@endsection
@section('footer-vendor')

  @parent
@endsection

@section('footer-plugin')
  @parent
  <script src="/themes/admin-lte/plugins/select2/select2.full.min.js"></script>
  <!-- InputMask -->
  <script src="/themes/admin-lte/plugins/input-mask/jquery.inputmask.js"></script>
  <script src="/themes/admin-lte/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
  <script src="/themes/admin-lte/plugins/input-mask/jquery.inputmask.extensions.js"></script>
  <!-- iCheck 1.0.1 -->
  <script src="/themes/admin-lte/plugins/iCheck/icheck.min.js"></script>
  <script src="/themes/plugins/flatpickr/flatpickr.min.js"></script>

@endsection
@section('footer-app')
  @parent
  <script type="text/javascript" src="/js/vue-magazine-builder.js"></script>
@endsection
@section('footer-script')
  @parent
  <script>

		$(function () {
			$('[data-toggle="tooltip"]').tooltip();

			//Initialize Select2 Elements
			$(".select2").select2();


			$('input[type="radio"]').iCheck({
				checkboxClass: 'icheckbox_flat-blue',
				radioClass: 'iradio_flat-blue'
			})
			$('#is-featured-no').iCheck('check');
			$('#is-featured-yes').iCheck('disable');

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

			CKEDITOR.replaceAll('.ckeditor', {
				customConfig: '/themes/ckeditor_config_simple.js',
				removePlugins: 'Image'
			});

		});
		let fortnightago = new Date();
		fortnightago.setDate(fortnightago.getDate() - 14);

		let check_in = document.getElementById("start-date").flatpickr({
			altInput: true,
			altInputClass: "form-control",
			altFormat: "m-d-Y",
			minDate: fortnightago,
			onChange: function (dateObj, dateStr, instance) {
				check_out.set("minDate", dateObj.fp_incr(1));
			}
		});
		let check_out = document.getElementById("end-date").flatpickr({
			altInput: true,
			altInputClass: "form-control",
			altFormat: "m-d-Y",
			minDate: fortnightago,
			onChange: function (dateObj, dateStr, instance) {
				check_in.set("maxDate", dateObj.fp_incr(-1));
			}
		});

  </script>

@endsection
