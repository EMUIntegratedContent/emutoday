@extends('admin.layouts.adminlte')
@section('title', 'Experts')
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
      <div class="col-md-9">
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Experts Categories</h3>
            @include('admin.components.boxtools', ['rte' => 'expertcategory', 'path' => 'admin/expertcategory'])
          </div>	<!-- /.box-header -->
          <div class="box-body">
            <table class="table">
              <tr>
                <th>Category Name</th>
                <th>Actions</th>
              </tr>
            @foreach ($categoriesPaginated as $expertCategory)
              <tr>
                <td>{{ $expertCategory->category }}</td>
                <td>
                  <a href="/admin/expertcategory/{{ $expertCategory->id }}/edit" class="button success"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                </td>
              </tr>
            @endforeach
            </table>
            <h6 class="text-center">{!! $categoriesPaginated->links() !!}</h6>
          </div><!-- /.box-body -->
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
