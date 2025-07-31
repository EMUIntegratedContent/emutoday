@extends('admin.layouts.adminlte')
@section('title', 'Inside EMU User Submission')
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
  <h1>Inside EMU</h1>
  <div id="vue-insideemu-admin-idea-view">
    <insideemu-admin-idea-view></insideemu-admin-idea-view>
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
  <script type="text/javascript" src="/js/vue-insideemu-admin-idea-view.js"></script>
@endsection
@section('footer-script')
  @parent
@endsection
