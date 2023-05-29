@extends('admin.layouts.adminlte')
@section('title', 'Story Ideas')
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
  <div id="vue-storyideas-list">
    <storyideas-list role="{{$currentUser->roles->first()->name}}"></storyideas-list>
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
  <script type="text/javascript" src="/js/vue-storyideas-list.js"></script>
@endsection
@section('footer-script')
  @parent
@endsection
