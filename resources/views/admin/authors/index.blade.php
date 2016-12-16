@extends('admin.layouts.adminlte')
@section('title', 'Authors/Contacts')
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
            <h3 class="box-title">Authors / Contacts List</h3>
            @include('admin.components.boxtools', ['rte' => 'authors', 'path' => 'admin/authors'])
          </div>	<!-- /.box-header -->
        </div><!-- /.box-body -->
      </div><!-- /.box -->
    </div><!-- /.row -->

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
    @endsection
@section('footer-script')
        @parent

        <script>
        </script>
    @endsection
