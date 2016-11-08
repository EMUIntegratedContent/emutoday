@extends('admin.layouts.adminlte')

@section('title', 'Delete '.$user->name)

@section('content')
    {!! Form::open(['method' => 'delete', 'route' => ['admin_user_destroy', $user->id]]) !!}
        <div class="callout alert">
            <strong>Warning!</strong> You are about to delete a user. This action cannot be undone. Are you sure you want to continue?
        </div>

        {!! Form::submit('Yes, delete this user!', ['class' => 'button alert']) !!}

        <a href="/admin/user" class="button success">
            <strong>No, get me out of here!</strong>
        </a>
    {!! Form::close() !!}
@endsection
