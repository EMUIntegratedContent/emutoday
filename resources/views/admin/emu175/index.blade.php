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
  <h1>EMU 175 Hub Story</h1>
  <div id="vue-emu-175">
    <emu-175-story-queue></emu-175-story-queue>
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
  <script type="text/javascript" src="/js/vue-emu-175.js"></script>
@endsection
@section('footer-script')
  @parent
@endsection
