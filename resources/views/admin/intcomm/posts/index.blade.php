@extends('admin.layouts.adminlte')
@section('title', 'INTCOMM (CHANGE) Posts')
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
  <h1>INTCOMM (CHANGE) POSTS</h1>
  <div class="row">
    <div class="col-xs-12">
      <div class="alert alert-info alert-dismissible" role="alert">
        Posts are typically used for internal communication. This is in contrast to the "EMU Today" story type and press
        releases, which are intended for the public.
      </div>
    </div>
  </div>
  <div id="vue-intcomm-queue">
    <intcomm-post-queue></intcomm-post-queue>
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
  <script type="text/javascript" src="/js/vue-intcomm-queue.js"></script>
@endsection

@section('footer-script')
  @parent
@endsection

