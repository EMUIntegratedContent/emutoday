@extends('admin.layouts.adminlte')

@section('title', 'Users')

@section('content')
<div class="row">
  <div class="col-xs-12">
    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title">User Table</h3>
        @can('super', $currentUser)
        @include('admin.components.boxtools', ['rte' => 'user', 'path' => 'admin/user'])
        @endcan
      </div>
      <!-- /.box-header -->
      <div class="box-body table-responsive no-padding">
        <table class="table table-hover">
          <tr>
            <th>Id</th>
            <th>Email</th>
            <th>Last Name</th>
            <th>First Name</th>
            <th>Phone</th>
            <th>Roles</th>
            <th>Edit</th>
            <th>Delete</th>
          </tr>
          <tr>
            @foreach($users as $user)
            <tr>
              <td>
                <a href="#">{{ $user->id }}</a>
              </td>
              <td>
                <a href="/admin/user/{{ $user->id}}">{{ $user->email }}</a>
              </td>
              <td>{{ $user->last_name }}</td>
              <td>{{ $user->first_name }}</td>
              <td>{{ $user->phone }}</td>
              <td>{{ $user->roles->pluck('name') }}</td>
              <td>
                <a href="/admin/user/{{ $user->id}}/edit">
                  <i class="fa fa-pencil"></i>
                </a>
              </td>
              <td>
                <a href="{{ route('admin_user_confirm', $user->id) }}">
                  <i class="fa fa-trash"></i>
                </a>
              </td>
            </tr>
            @endforeach
          </tr>
        </table>
      </div>
      <!-- /.box-body -->
      <div class="box-footer text-right">
        {!! $users->render() !!}
      </div> <!-- /.box-footer -->
    </div>
    <!-- /.box -->
  </div>
</div>

<div class="row">
  <div class="col-md-6">
    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title">User Roles</h3>
      </div><!-- /.box-header -->
      <div class="box-body table-responsive no-padding">
        <table class="table table-hover">
          <tr>
            <th>Id</th>
            <th>Role</th>
            <th>Label</th>
          </tr>
          @foreach($roles as $role)
          <tr>
            <td>{{$role->id}}</td>
            <td>{{ $role->name }}</td>
            <td>{{ $role->label }}</td>
          </tr>
          @endforeach
        </table>
      </div><!-- /.box-body -->
    </div><!-- /.box -->
  </div><!-- /.col-md-6 -->
  <div class="col-md-6">
    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title">User Permissions</h3>
      </div><!-- /.box-header -->
      <div class="box-body table-responsive no-padding">
        <table class="table table-hover">
          <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Label</th>
          </tr>
          @foreach($permissions as $permission)
          <tr>
            <td>{{$permission->id}}</td>
            <td>{{ $permission->name }}</td>
            <td>{{ $permission->label }}</td>
          </tr>
          @endforeach
        </table>
      </div><!-- /.box-body -->
    </div><!-- /.box -->
  </div><!-- /.col-md-6 -->
</div><!-- /.row -->
@endsection
