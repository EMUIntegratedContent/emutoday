@extends('admin.layouts.adminlte')
@section('title', 'Announcemnt Archives')
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

    <div class="row">
        <div class="col-xs-12">
          <div id="vue-announcement-archive-queue">
            <announcement-archive-queue atype="{{$atype}}" cuser="{{$currentUser}}">
            </announcement-archive-queue>
          </div><!-- /.vue-announcement-app -->
        </div>
    </div><!-- /.row -->

@endsection
@section('footer-vendor')
    @parent
@endsection

@section('footer-plugin')
    @parent

    @endsection

    @section('footer-app')
    @parent
    @endsection
@section('footer-script')
        @parent
        <script type="text/javascript" src="/js/vue-announcement-archive-queue.js"></script>
        <script>

        </script>
    @endsection
