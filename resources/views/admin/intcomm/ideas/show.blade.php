@extends('admin.layouts.adminlte')
@section('title', 'EMU 175 Frontpage Manager')
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
  <h1>Internal Communications</h1>
  <div id="vue-intcomm-admin-idea-view">
    <intcomm-admin-idea-view></intcomm-admin-idea-view>
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
  <script type="text/javascript" src="/js/vue-intcomm-admin-idea-view.js"></script>
@endsection
@section('footer-script')
  @parent
@endsection
