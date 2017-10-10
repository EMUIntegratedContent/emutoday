@extends('admin.layouts.adminlte')
@section('title','Story Queue')
@section('style-vendor')
    @parent
@endsection
@section('style-plugin')
    @parent
<!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" type="text/css" href="/css/flatpickr.min.css">

    @endsection
    @section('style-app')
        @parent
        @endsection
        @section('scripthead')
        @parent
    @endsection
@section('content')
    <div id="vue-story-queue">
        <story-queue sroute="{{$sroute}}" gtype="{{$gtype}}" stype="{{$stype}}" qtype="{{$qtype}}" stypes="{{$stypes}}" cuser="{{$currentUser}}" role="{{$currentUser->roles->first()->name}}">
            <input slot="csrf" type="hidden" name="_token" value="{{ csrf_token() }}">
        </story-queue>
    </div><!-- /.vue-story-app -->

@endsection
@section('footer-vendor')
    @parent
    {{-- <script src="/js/admintools.js"></script> --}}
@endsection

@section('footer-plugin')
    @parent

    @endsection

    @section('footer-app')
    @parent
      <script type="text/javascript" src="/js/vue-story-queue.js"></script>
    @endsection
@section('footer-script')
        @parent

        <script>


        </script>
    @endsection
