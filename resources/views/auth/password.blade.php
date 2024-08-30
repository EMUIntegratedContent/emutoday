@extends('auth.auth')

@section('title', 'Forgot Password')

@section('heading', 'Please provide your email address to reset password')

@section('content')
  {!! html()->form('POST')->open() !!}

  <div class="form-group">
    {!! html()->label('Email', 'email') !!}
    {!! html()->text('email')->class('form-control') !!}
  </div>

  {!! html()->submit('Send Password Reset Link')->class('btn btn-primary') !!}

  {!! html()->form()->close() !!}
@endsection
