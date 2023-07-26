<!-- EMich Login -->
@extends('public.layouts.global')
@section('styles')
@parent
@endsection

@section('content')
<div id="calendar-bar">
  <div class="row">
    <div class="medium-12 column">
      @include('public.components.errors')
      <div class="row">
        <div class="small-5 small-centered columns">
          <h3 class="cal-caps toptitle">Emich Login</h3>
          @if(isset($valid))
          <div data-alert class="callout alert">
            Invalid Credentials
            <a href="#" class="close">&times;</a>
          </div>
          @endif

          <form action="/auth/emichlogin" method="POST">
            {{ csrf_field() }}
            <label for="user">My.Emich Username:</label>
            <input type="text" name="user" id="user">
            <label for="password">Password:</label>
            <input type="password" name="password" id="password">
            <input class="button" type="submit" name="submit" value="Log in">
          </form>
        </div><!-- /.medium-6 columns -->
      </div><!-- /.row -->
    </div><!-- /.small-12 column -->
  </div><!-- /.row -->
</div><!-- /#calendar-bar -->
@endsection

@section('scriptsfooter')
@parent

@endsection
