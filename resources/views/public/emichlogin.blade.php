<!-- EMich Login -->
@extends('public.layouts.global')
@section('styles')
    @parent
    <link rel="stylesheet" type="text/css" href="/css/flatpickr.min.css" />
@endsection

@section('content')
<div id="calendar-bar">
    <div class="row">
        <div class="medium-12 column">
            @include('public.components.errors')
            <div class="row">
                <div class="small-4 small-centered columns">

                    <h3 class="cal-caps toptitle">Emich Login</h3>

                    <form action="/calendar/manage/" method="post">
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
