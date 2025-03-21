@extends('admin.layouts.adminlte')
@section('title', 'Edit Inside EMU Post')
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
  <div id="vue-insideemu-post-form">
    <insideemu-post-form :user-roles="{{ $currentUser->roles }}"></insideemu-post-form>
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
  <script type="text/javascript" src="/js/vue-insideemu-post-form.js"></script>
@endsection
@section('footer-script')
  @parent
@endsection
