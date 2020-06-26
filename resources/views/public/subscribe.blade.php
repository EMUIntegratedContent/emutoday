@extends('public.layouts.global')
@section('title', 'Subscribe')
@section('content')
<div id="content-area">
  <div id="calendar-bar">
    <div class="row">
      <div class="large-12 medium-12 small-12 column">
        <div class="row">
          <div class="large-6 medium-12 small-12 column">
            @if(isset($data))
            <!-- SUCCESS -->
            <div class="callout success">
              <p>{{$data}}</p>
            </div>
            @endif

            @if(count($errors))
            <!-- ERRORS -->
            <div class="callout alert">
              <strong>Whoops!</strong> There were some problems with your input.
              <br/>
              <ul>
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
            @endif

            @if(empty($data))
            <h3 class="toptitle">Subscribe to EMU Today</h3>
            {!! Form::open(array('url' => 'subscribe')) !!}
            <!-- EMAIL -->
            {!! Form::label('email', 'Email Address') !!}
            {!! Form::text('email', null, array('placeholder'=>'you@emich.edu')) !!}
            
            {!! Form::submit('SUBSCRIBE TO EMU TODAY', array('class'=>'button large expanded')) !!}
            {!! Form::close() !!}
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
