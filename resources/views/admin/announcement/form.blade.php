@extends('admin.layouts.adminlte')
@section('title', $announcement->exists ? 'Editing '.$announcement->title : 'Create New Announcement')
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
        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">{{$announcement->exists ? 'Edit Announcement' : 'New Announcement'}}</h3>
                    @include('admin.components.boxtools', ['rte' => 'announcement', 'path' => 'admin/announcement/{{$atype}}', 'atype'=> $atype])
                </div>	<!-- /.box-header -->
                <div class="box-body">
                    <div id="vue-announcements">
                            <announcement-form errors="{{ json_encode($errors) }}" framework="bootstrap" type="{{$atype}}" authorid="{{$currentUser->id}}" recordexists="{{$announcement->exists ? true: false}}" recordid="{{$announcement->exists ? $announcement->id : null }}" :isadmin="true">
                                <input slot="csrf" type="hidden" name="_token" value="{{ csrf_token() }}">
                            </announcement-form>
                    </div><!-- /#vue-event-form -->
            </div><!-- /.box-body -->
      </div><!-- /.box -->
        </div><!-- /.col-md-6 -->
        <div class="col-md-6">

        </div><!-- /.col-md-6 -->
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
      <script type="text/javascript" src="/js/vue-announcement-form.js"></script>
    @endsection
@section('footer-script')
        @parent

        <script>
        </script>
    @endsection
