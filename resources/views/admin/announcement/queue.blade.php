@extends('admin.layouts.adminlte')
@section('title','Announcement Queue')
@section('style-vendor')
@parent
@endsection
@section('style-plugin')
@parent
<!-- iCheck for checkboxes and radio inputs -->
{{-- <link rel="stylesheet" href="/themes/admin-lte/plugins/iCheck/all.css"> --}}
{{-- <link rel="stylesheet" href="/themes/plugins/eonasdan-bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css"> --}}
<link rel="stylesheet" type="text/css" href="/css/flatpickr.min.css">
@endsection
@section('style-app')
@parent
@endsection
@section('scripthead')
{{-- @include('admin.layouts.scriptshead') --}}
@parent
@endsection
@section('content')
{{-- <div id="vueapp">
  <component  :var-year-unit="{!! $varYearUnit !!}"
  :var-month-unit="{!! $varMonthUnit !!}"
  :var-day-unit="{!! $varDayUnit !!}"
  is="event-view">
</component>
</div><!-- vue-app --> --}}

<div id="vue-announcement-queue">
  <announcement-queue atype="{{$atype}}" cuser="{{$currentUser}}" role="{{$currentUser->roles->first()->name}}">
  </announcement-queue>
</div><!-- /.vue-announcement-app -->

@endsection
@section('footer-vendor')
@parent
{{-- <script src="/js/admintools.js"></script> --}}
@endsection

@section('footer-plugin')
@parent

  @endsection

  @section('footer-app')
  @parent
  <script type="text/javascript" src="/js/vue-announcement-queue.js"></script>
  @endsection
  @section('footer-script')
  @parent

  <script>
  </script>
  @endsection
