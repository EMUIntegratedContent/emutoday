@extends('admin.layouts.adminlte')
@section('title','EventQueue')
@section('style-vendor')
    @parent
@endsection
@section('style-plugin')
    @parent
<link rel="stylesheet" type="text/css" href="/css/flatpickr.min.css">
    @endsection
    @section('style-app')
        @parent
        @endsection
        @section('scripthead')
        @parent
    @endsection
@section('content')

    <div id="vue-event-queue">
            <event-queue>
            </event-queue>
    </div><!-- /.vue-announcement-app -->

@endsection
@section('footer-vendor')
    @parent
@endsection

@section('footer-plugin')
    @parent

    @endsection

    @section('footer-app')
    @parent
      <script type="text/javascript" src="/js/vue-event-queue.js"></script>
    @endsection
@section('footer-script')
        @parent

        <script>


        </script>
    @endsection
