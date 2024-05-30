@extends('admin.layouts.adminlte')
@section('title', 'Intcomm (CHANGE) Idea Submissions Queue')
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
  <h1>Idea Submissions</h1>
  <div id="vue-intcomm-ideas-queue">
    <intcomm-ideas-queue></intcomm-ideas-queue>
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
  <script type="text/javascript" src="/js/vue-intcomm-ideas-queue.js"></script>
@endsection
@section('footer-script')
  @parent
@endsection
