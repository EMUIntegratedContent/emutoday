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
      <div class="col-md-9">
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Media Highlights List</h3>
            @include('admin.components.boxtools', ['rte' => 'mediahighlights', 'path' => 'admin/mediahighlights'])
          </div>	<!-- /.box-header -->
          <div class="box-body">
            <table class="table">
              <tr>
                <th>Date</th>
                <th>Title</th>
                <th>External Link</th>
                <th>Added By</th>
                <th>Actions</th>
              </tr>
            @foreach ($highlightsPaginated as $highlight)
              <tr>
                <td>{{ $highlight->start_date }}</td>
                <td>{{ $highlight->title }}</td>
                <td><a href="{{ $highlight->url }}" target="_blank">{{ $highlight->source }}</a></td>
                <td>{{ $highlight->added_by->last_name }}</td>
                <td>
                  <a href="/admin/mediahighlight/{{ $highlight->id }}/edit" class="button success"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                </td>
              </tr>
            @endforeach
            </table>
            <h6 class="text-center">{!! $highlightsPaginated->links() !!}</h6>
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
