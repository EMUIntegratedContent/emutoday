@extends('admin.layouts.adminlte')
@section('title', 'Inside EMU User Submissions Queue')
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
  <h1>User Submissions</h1>
  <div id="vue-insideemu-ideas-queue">
    <insideemu-ideas-queue></insideemu-ideas-queue>
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
  <script type="text/javascript" src="/js/vue-insideemu-ideas-queue.js"></script>
@endsection
@section('footer-script')
  @parent
@endsection
