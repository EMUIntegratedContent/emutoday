@extends('admin.layouts.adminlte')

@section('title', $page->exists ? 'Edit Hub Page' : 'Create Hub Page')
@section('style-plugin')
  @parent
  <link rel="stylesheet" href="/themes/admin-lte/plugins/datatables/dataTables.bootstrap.css">
  <link rel="stylesheet" href="/themes/admin-lte/plugins/iCheck/all.css">
  <link rel="stylesheet" href="/themes/admin-lte/plugins/select2/select2.min.css">

@endsection
@section('scripthead')
@show
@include('include.js')
@section('content')
  @include('admin.components.modal')
  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h1 class="box-title">{{$page->exists ? 'Edit Hub Page' : 'Create Hub Page'}}</h1>
          @include('admin.components.boxtools', ['rte' => 'page', 'path' => 'admin/page', 'cuser'=>$currentUser, 'id'=>$page->id])
        </div>  <!-- /.box-header -->
        <div class="box-body" id="vue-page">
          <page-form
              framework="bootstrap"
              :cuser-roles="{{$currentUser->roles}}"
              recordexists="{{$page->exists ? true: false}}"
              recordid="{{ $page->exists ? $page->id : null }}"
              stypes="{{ $stypes }}"
          >
          </page-form>
        </div><!-- /.box-body -->
        <div class="box-footer">

        </div><!-- /.box-footer -->
      </div><!-- /.box -->
    </div><!-- /.col-md-6 -->
  </div><!-- /.row -->
@endsection

@section('footer-plugin')
  @parent
  <!-- SlimScroll -->
  <script src="/themes/admin-lte/plugins/slimScroll/jquery.slimscroll.min.js"></script>
  <!-- FastClick -->
  <script src="/themes/admin-lte/plugins/fastclick/fastclick.js"></script>
@endsection

@section('footer-script')
  @parent
  <script type="text/javascript" src="/js/vue-page-form.js"></script>

@endsection
