@extends('admin.layouts.adminlte')
@section('title', 'Intcomm Dashboard')
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
@section('content')
  <h1>Internal Communications Dashboard</h1>
  <div id="vue-intcomm-admin-dashboard">
    <intcomm-admin-dashboard></intcomm-admin-dashboard>
  </div>
@endsection
@section('footer-vendor')
  @parent
@endsection
@section('footer-plugin')
  @parent
@endsection
@section('footer-app')
  @parent
  <script type="text/javascript" src="/js/vue-intcomm-admin-dashboard.js"></script>
@endsection
@section('footer-script')
  @parent
@endsection
