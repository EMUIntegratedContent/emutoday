@extends('admin.layouts.adminlte')
@section('title','ArchiveQueue')
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
                    {{-- @include('admin.layouts.scriptshead') --}}
        @parent
    @endsection
@section('content')
    <div id="vue-archive-queue">
        <archive-queue entity-type="{{$entityType}}" story-types="{{$storyTypes}}">
        </archive-queue>
    </div><!-- /.vue-archive-queue -->

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
      <script type="text/javascript" src="/js/vue-archive-queue.js"></script>
    @endsection
@section('footer-script')
        @parent

        <script>


        </script>
    @endsection
