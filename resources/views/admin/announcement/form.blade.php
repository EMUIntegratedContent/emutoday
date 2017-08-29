@extends('admin.layouts.adminlte')
@section('title', $announcement->exists ? 'Editing '.$announcement->title : 'Create New Announcement')
@section('style-vendor')
    @parent
@endsection
@section('style-plugin')
    @parent
    <link rel="stylesheet" type="text/css" href="/css/flatpickr.min.css">
<!-- iCheck for checkboxes and radio inputs -->
{{-- <link rel="stylesheet" type="text/css" href="/themes/plugins/flatpickr.min.css">


<link rel="stylesheet" href="/themes/admin-lte/plugins/iCheck/all.css"> --}}
{{-- <link rel="stylesheet" href="/themes/plugins/eonasdan-bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css"> --}}

    @endsection
    @section('style-app')
        @parent
        @endsection
        @section('scripthead')
        @parent
    @endsection
@section('content')

    <div class="row">
        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">{{$announcement->exists ? 'Edit Announcement' : 'New Announcement'}}</h3>
                    @include('admin.components.boxtools', ['rte' => 'announcement', 'path' => 'admin/announcement/{{$atype}}', 'atype'=> $atype])
                </div>	<!-- /.box-header -->
                <div class="box-body">
                    <div id="vue-announcements">
                            <announcement-form errors="{{ json_encode($errors) }}" framework="bootstrap" type="{{$atype}}" authorid="{{$currentUser->id}}" recordexists="{{$announcement->exists ? true: false}}" recordid="{{$announcement->exists ? $announcement->id : null }}">
                                <input slot="csrf" type="hidden" name="_token" value="{{ csrf_token() }}">
                            </announcement-form>
                    </div><!-- /#vue-event-form -->
            </div><!-- /.box-body -->
      </div><!-- /.box -->
        </div><!-- /.col-md-6 -->
        <div class="col-md-6">

        </div><!-- /.col-md-6 -->
    </div><!-- /.row -->

@endsection
@section('footer-vendor')
    @parent
    {{-- <script src="/js/admintools.js"></script> --}}
@endsection

@section('footer-plugin')
    @parent

{{-- <!-- Select2 -->
<script src="/themes/admin-lte/plugins/select2/select2.full.min.js"></script>
<!-- InputMask -->
<script src="/themes/admin-lte/plugins/input-mask/jquery.inputmask.js"></script>
<script src="/themes/admin-lte/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="/themes/admin-lte/plugins/input-mask/jquery.inputmask.extensions.js"></script>
<!-- date-range-picker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>

<!-- bootstrap datetimepicker -->
<script src="/themes/plugins/eonasdan-bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js"></script>


<script src="/themes/admin-lte/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- iCheck 1.0.1 -->
<script src="/themes/admin-lte/plugins/iCheck/icheck.min.js"></script>
<!-- FastClick -->
<script src="/themes/admin-lte/plugins/fastclick/fastclick.js"></script> --}}

    @endsection

    @section('footer-app')
    @parent
      <script type="text/javascript" src="/js/vue-announcement-form.js"></script>
    @endsection
@section('footer-script')
        @parent

        <script>
        </script>
    @endsection
