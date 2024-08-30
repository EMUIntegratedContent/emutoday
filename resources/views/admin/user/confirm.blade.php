@extends('admin.layouts.adminlte')

@section('title', 'Delete '.$user->name)

@section('content')
  {!! html()->form('delete', route('admin_user_destroy', $user->id))->open() !!}
  <div class="callout alert">
    <strong>Warning!</strong> You are about to delete a user. This action cannot be undone. Are you sure you want to
    continue?
  </div>

  {!! html()->submit('Yes, delete this user!')->class('button alert') !!}

  <a href="/admin/user" class="button success">
    <strong>No, get me out of here!</strong>
  </a>
  {!! html()->form()->close() !!}
@endsection
