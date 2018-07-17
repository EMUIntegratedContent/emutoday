@extends('admin.layouts.adminlte')
@section('title', $event->exists ? 'Editing '.$event->title : 'Create New Event')
    @section('style-vendor')
        @parent
    @endsection

    @section('style-plugin')
        @parent
        <!-- DataTables -->
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
        <h3 class="box-title">{{$event->exists ? 'Edit Event' : 'New Event'}}</h3>
        @include('admin.components.boxtools', ['rte' => 'event', 'path' => 'admin/event'])
      </div>	<!-- /.box-header -->
      <!-- /.box-header -->
      <div class="box-body">
        <div id="vue-event-form">
          <event-form framework="bootstrap"
          authorid="{{$currentUser->id}}"
          recordexists="{{$event->exists ? true: false}}"
          recordid="{{$event->exists ? $event->id : null }}"
          :isadmin="{{ Auth::user()->can('admin') }}"
          >
          <input slot="csrf" type="hidden" name="_token" value="{{ csrf_token() }}">
        </event-form>
      </div><!-- /#vue-event-form -->
    </div><!-- /.box-body -->
  </div><!-- /.box -->
</div><!-- /.col-md-6 -->
<div class="col-md-6">

</div><!-- /.col-md-6 -->
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
<script type="text/javascript" src="/js/vue-event-form.js"></script>
@endsection
