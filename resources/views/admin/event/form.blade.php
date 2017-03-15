@extends('admin.layouts.adminlte')
@section('title', $event->exists ? 'Editing '.$event->title : 'Create New Event')
    @section('style-vendor')
        @parent
    @endsection

    @section('style-plugin')
        @parent
        <!-- DataTables -->
        <link rel="stylesheet" type="text/css" href="/css/flatpickr.min.css">

        {{-- <link rel="stylesheet" href="/themes/adminlte/plugins/datatables/dataTables.bootstrap.css"> --}}
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
        <h3 class="box-title">{{$event->exists ? 'Edit Event' : 'New Event'}}</h3>
        @include('admin.components.boxtools', ['rte' => 'event', 'path' => 'admin/event'])
      </div>	<!-- /.box-header -->
      <!-- /.box-header -->
      <div class="box-body">
        <div id="vue-event-form">
          <event-form framework="bootstrap"
          authorid="{{$currentUser->id}}"
          recordexists="{{$event->exists ? true: false}}"
          recordid="{{$event->exists ? $event->id : null }}">
          <input slot="csrf" type="hidden" name="_token" value="{{ csrf_token() }}">
        </event-form>
      </div><!-- /#vue-event-form -->
    </div><!-- /.box-body -->
  </div><!-- /.box -->
</div><!-- /.col-md-6 -->
<div class="col-md-6">

</div><!-- /.col-md-6 -->
@endsection

@section('footer-vendor')
    {{-- <script src="{{ elixir('js/vendor-scripts.js') }}"></script> --}}
    @parent
@endsection

@section('footer-plugin')
    @parent
@endsection

@section('footer-app')
    {{-- <script>
var AdminLTEOptions = {
    //Enable sidebar expand on hover effect for sidebar mini
    //This option is forced to true if both the fixed layout and sidebar mini
    //are used together
    sidebarExpandOnHover: false,
    //BoxRefresh Plugin
    enableBoxRefresh: true,
    //Bootstrap.js tooltip
    enableBSToppltip: true
};
</script> --}}
{{-- <script src="/themes/admin-lte/dist/js/app.js" type="text/javascript"></script>
    <script src="/js/vue-ajax-form.js" ></script> --}}
@parent
@endsection


@section('footer-script')
@parent
<script type="text/javascript" src="/js/vue-event-form.js"></script>

  {{-- <script src="/js/mg-event-form-vue.js"></script> --}}
@endsection
