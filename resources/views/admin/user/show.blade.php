@extends('admin.layouts.adminlte')
@section('content')
    <div class="row">
        <div class="col-md-3">
            <!-- Profile Image -->
<div class="box box-primary">
    <div class="box-body box-profile">
        @if($user->mediaFiles)
        <img class="profile-user-img img-responsive img-circle" src="/imagecache/avatar160/{{$user->mediaFiles->first()->filename}}" alt="User profile picture">
    @else
        <img class="profile-user-img img-responsive img-circle" src="/imagecache/avatar160/avatar160.jpg" alt="default profile picture">
@endif
        <h3 class="profile-username text-center">{{$user->first_name}} {{$user->last_name}}</h3>

        <p class="text-muted text-center"></p>

        <ul class="list-group list-group-unbordered">
            <li class="list-group-item">
                <b>EMAIL</b> <a class="pull-right">{{$user->email}}</a>
            </li>
            <li class="list-group-item">
                <b>PHONE</b> <a class="pull-right">{{$user->phone}}</a>
            </li>
        </ul>
        <a href="/admin/user/{{$user->id}}/edit" class="btn btn-primary btn-block"><b>Edit User</b></a>

    </div>
    <!-- /.box-body -->
</div>
<!-- /.box -->
        </div><!-- /.col-md-3 -->
        <div class="col-md-9">
            <!-- About Me Box -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Roles</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <ul>
                            @foreach ($userRoles as $userRole)
                                <li>
                                    {{$userRole->name}}
                                </li>

                            @endforeach

                        </ul>
                </div><!-- /.box-body -->
                </div><!-- /.box -->

        </div><!-- /.col-md-9 -->
    </div><!-- /.row -->
@endsection
