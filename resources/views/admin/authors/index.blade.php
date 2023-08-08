@extends('admin.layouts.adminlte')
@section('title', 'Authors/Contacts')
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
  @parent
@endsection
@section('content')

  <div class="row">
    <div class="col-md-9">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Authors / Contacts List</h3>
          @include('admin.components.boxtools', ['rte' => 'authors', 'path' => 'admin/authors'])
        </div>  <!-- /.box-header -->
        <div class="box-body">
{{--          Filter archived users showing on table. JQuery onclick in admin-emucustom.js--}}
          <p style="margin-left: 10px">Show archived authors
            <input type="checkbox" name="showarchived" id="showarchived"
                @if(request()->has('showarchived'))
                  checked
                @endif
            /></p>
          <table class="table">
            <tr>
              <th>Last Name</th>
              <th>First Name</th>
              <th>Email</th>
              <th>Phone</th>
              <th>Story Contact</th>
              <th>Actions</th>
            </tr>
            @foreach ($authorsPaginated as $author)
              <tr>
                <td>{{ $author->last_name }}
                  @if($author->hidden)
                    <span class="label label-warning">Archived</span>
                  @endif
                </td>
                <td>{{ $author->first_name }}</td>
                <td>{{ $author->email }}</td>
                <td>{{ $author->phone }}</td>
                <td>
                  @if($author->is_contact && !$author->is_principal_contact)
                    <i class="fa fa-check-square" aria-hidden="true"></i>
                  @elseif ($author->is_contact && $author->is_principal_contact)
                    <i class="fa fa-check-square" aria-hidden="true"></i> (Default)
                  @endif
                </td>
                <td>
                  <a href="/admin/authors/{{ $author->id }}/edit" class="button success"><i
                        class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                </td>
              </tr>
            @endforeach
          </table>
          <h6 class="text-center">{!! $authorsPaginated->links() !!}</h6>
        </div><!-- /.box-body -->
      </div><!-- /.box-body -->
    </div><!-- /.box -->
  </div><!-- /.row -->
@endsection
@section('footer-vendor')
  @parent
  <script src="/js/admintools.js"></script>

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
