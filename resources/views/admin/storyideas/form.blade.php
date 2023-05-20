@extends('admin.layouts.adminlte')
@section('title', $idea->exists ? 'Editing '.$idea->title : 'Create Story Idea')
@section('style-vendor')
    @parent
@endsection
@section('style-plugin')
    @parent
    <link rel="stylesheet" type="text/css" href="/css/flatpickr.min.css">

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
    @if(Session::has('status'))
        <div class="row">
            <div class="col-sm-12">
                <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('status') }}</p>
            </div>
        </div>
    @endif

    <div class="row">
        <div class="col-md-8">
            <div id="vue-storyidea">
                <div class="box box-primary">
                  <div class="box-header with-border">
                    <h3 class="box-title">{{$idea->exists ? 'Edit story idea ' . $idea->title : 'New story idea'}}</h3>
                    <div id="vue-box-tools">
                        <storyideas-box-tools viewtype="form"
                        :current-user="{{$currentUser}}"
                        :record-id="{{$idea->exists ? $idea->id : null}}"
                        ></storyideas-box-tools>
                    </div>
                  </div>	<!-- /.box-header -->
                  <div class="box-body">
                      <storyideas-form
                        errors="{{ json_encode($errors) }}"
                        framework="bootstrap"
                        :cuser-roles="{{$currentUser->roles}}"
                        recordexists="{{$idea->exists ? true: false}}"
                        recordid="{{$idea->exists ? $idea->id : null }}">
                          <input slot="csrf" type="hidden" name="_token" value="{{ csrf_token() }}">
                      </storyideas-form>
                  </div><!-- /.box-body -->
                </div><!-- /.box-body -->
            </div><!-- /.box -->
      </div>
    </div><!-- /.row -->

@endsection
@section('footer-vendor')
    @parent
    {{-- <script src="/js/admintools.js"></script> --}}
@endsection

@section('footer-app')
    @parent
    <script type="text/javascript" src="/js/vue-storyideas-form.js"></script>
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
