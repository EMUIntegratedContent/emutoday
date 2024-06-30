@extends('admin.layouts.adminlte')
@section('title', 'Edit INTCOMM (CHANGE) Post')
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
  <div id="vue-intcomm-post-form">
    <intcomm-post-form :user-roles="{{ $currentUser->roles }}"></intcomm-post-form>
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
  <script type="text/javascript" src="/js/vue-intcomm-post-form.js"></script>
@endsection
@section('footer-script')
  @parent
@endsection
