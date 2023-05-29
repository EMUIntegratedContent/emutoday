@extends('admin.layouts.adminlte')
@section('title', 'Expert Media Requests')
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
  <div id="vue-expert-request-list">
    <expert-media-request-list></expert-media-request-list>
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
  <script type="text/javascript" src="/js/vue-expert-request-list.js"></script>
@endsection
@section('footer-script')
  @parent
@endsection
