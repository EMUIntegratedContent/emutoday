@extends('admin.layouts.adminlte')
@section('title', $highlight->exists ? 'Editing '.$highlight->title : 'Create Meida Highlight')
@section('style-vendor')
    @parent
@endsection
@section('style-plugin')
    @parent
    <link rel="stylesheet" type="text/css" href="/css/flatpickr.min.css">
    <link rel="stylesheet" href="/themes/admin-lte/plugins/select2/select2.min.css">
    @endsection
    @section('style-app')
        @parent
        @endsection
        @section('scripthead')
        @parent
    @endsection
@section('content')

    <div class="row">
      <div class="col-md-9">
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">{{$highlight->exists ? 'Edit Meida Highlight' : 'New Media Highlight'}}</h3>
            @include('admin.components.boxtools', ['rte' => 'meidahighlights', 'path' => 'admin/mediahighlights'])
          </div>	<!-- /.box-header -->
          <div class="box-body">
            <div id="vue-mediahighlight">
              <mediahighlight-form
                errors="{{ json_encode($errors) }}"
                framework="bootstrap"
                user_id="{{$currentUser->id}}"
                recordexists="{{$highlight->exists ? true: false}}"
                recordid="{{$highlight->exists ? $highlight->id : null }}">
              </mediahighlight-form>
            </div><!-- /#vue-event-form -->
          </div><!-- /.box-body -->
        </div><!-- /.box-body -->
      </div><!-- /.box -->
    </div><!-- /.row -->

@endsection
@section('footer-vendor')
    @parent
    <!--<script src="/js/admintools.js"></script>-->
@endsection

@section('footer-plugin')
    @parent
    <!-- Select2 -->
    <script src="/themes/admin-lte/plugins/select2/select2.full.min.js"></script>
@endsection

@section('footer-app')
    @parent
    <script type="text/javascript" src="/js/vue-mediahighlight-form.js"></script>
@endsection
@section('footer-script')
        @parent

        <script>
        </script>
    @endsection
