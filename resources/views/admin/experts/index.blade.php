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
  <div id="vue-expert-list">
    <expert-list></expert-list>
  </div>
  {{--
    @if(Session::has('status'))
        <div class="row">
            <div class="col-sm-12">
                <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('status') }}</p>
            </div>
        </div>
    @endif
    <div class="row">
      <div class="col-md-12">
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Experts List</h3>
            @include('admin.components.boxtools', ['rte' => 'experts', 'path' => 'admin/experts'])
          </div>	<!-- /.box-header -->
          <div class="box-body">
            <table class="table">
              <tr>
                <th><span class="sr-only">Thumbnail Photo</span></th>
                <th>Last Name</th>
                <th>First Name</th>
                <th>Job Title</th>
                <th>Categories</th>
                <th>Approved?</th>
                <th>Actions</th>
              </tr>
            @foreach ($expertsPaginated as $expert)
              <tr>
                  <td>
                      @if($expert->expertImages()->first())
                      <img class="small-thumb" src="/imagecache/expertthumb/{{$expert->expertImages()->first()->filename}}" alt="{{$expert->expertImages()->first()->image_name}}">
                      @endif
                  </td>
                <td>{{ $expert->last_name }}</td>
                <td>{{ $expert->first_name }}</td>
                <td>{{ $expert->title }}</td>
                <td>
                    @foreach ($expert->expertCategories as $category)
                        <span class="badge">{{ $category->category }}</span>
                    @endforeach
                </td>
                <td>
                  @if($expert->is_approved)
                      <span class="label label-success">Yes</span>
                  @else
                      <span class="label label-danger">No</span>
                  @endif
                </td>
                <td>
                  <a href="/admin/experts/{{ $expert->id }}/edit" class="button success"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                </td>
              </tr>
            @endforeach
            </table>
            <h6 class="text-center">{!! $expertsPaginated->links() !!}</h6>
          </div><!-- /.box-body -->
        </div><!-- /.box-body -->
      </div><!-- /.box -->
    </div><!-- /.row -->
    --}}
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
    <script type="text/javascript" src="/js/vue-expert-list.js"></script>
    @endsection
@section('footer-script')
        @parent

        <script>
        </script>
@endsection
