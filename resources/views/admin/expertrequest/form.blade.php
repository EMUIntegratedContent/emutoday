@extends('admin.layouts.adminlte')
@section('title', $request->exists ? 'Editing '.$request->name . '\'s Media Request': 'Create Expert Media Request')
@section('style-vendor')
    @parent
@endsection
@section('style-plugin')
    @parent


    @endsection
    @section('style-app')
        @parent
        @endsection
        @section('scripthead')
        @parent
    @endsection

    @section('scripts-vendor')
        <!-- Vendor Scripts that need to be loaded in the header before other plugin or app scripts -->
        @parent
    @endsection
    @section('scripts-plugin')
        <!-- Scripts  for code libraries and plugins that need to be loaded in the header -->
        <script src="/themes/plugins/ckeditor/ckeditor.js"></script>
        @parent
    @endsection
    @section('scripts-app')
        <!-- App related Scripts  that need to be loaded in the header -->
        @parent

    @endsection

@section('content')
    <div class="row">
      <div class="col-md-9">
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">{{$request->exists ? 'Editing '.$request->name . '\'s Media Request': 'Create Expert Media Request'}}</h3>
          </div>	<!-- /.box-header -->
          <div class="box-body">
             <div id="vue-expertmediarequest-form">
                <expert-media-request-form
                  errors="{{ json_encode($errors) }}"
                  :is-admin="true"
                  request-id="{{ $request->id }}"
                  framework="bootstrap">
                  <input slot="csrf" type="hidden" name="_token" value="{{ csrf_token() }}">
                </expert-media-request-form>
            </div><!-- /#vue-expertmediarequest-form -->
          </div><!-- /.box-body -->
        </div><!-- /.box-body -->
      </div><!-- /.box -->
      <div class="col-md-3">

      </div><!-- /.md5 -->
    </div><!-- /.row -->
@endsection
@section('footer-vendor')
    @parent
    {{-- <script src="/js/admintools.js"></script> --}}
@endsection

@section('footer-app')
    @parent
    <script type="text/javascript" src="/js/vue-expertmediarequest-form.js"></script>
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
    <script src="/themes/admin-lte/plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- iCheck 1.0.1 -->
    <script src="/themes/admin-lte/plugins/iCheck/icheck.min.js"></script>
    <!-- FastClick -->
    <script src="/themes/admin-lte/plugins/fastclick/fastclick.js"></script>

@endsection
@section('scriptsfooter')
    @parent

@endsection
@section('footer-script')
    @parent

@endsection
