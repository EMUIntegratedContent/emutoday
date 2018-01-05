@extends('public.layouts.global')
@section('title', 'Submit Feedback')
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
            <h3 class="cal-caps toptitle">Feedback</h3>
            {!! Form::open(array('url' => 'feedback')) !!}
            <!-- EMAIL -->
            {!! Form::label('email', 'E-Mail Address') !!}
            {!! Form::text('email', null, array('placeholder'=>'you@emich.edu')) !!}

            <!-- COMMENTS -->
            {!! Form::label('comments', 'Comments') !!}
            {!! Form::textarea('comments', '') !!}

            <!-- SUBSCRIBE -->
            {!! Form::checkbox('subscribe', 'yes', true) !!}
            {!! Form::label('subscribe', 'Would you like to subscribe to This Week at EMU?') !!}
            </br>

            {!! Form::submit('Send', array('class'=>'button')) !!}
            {!! Form::close() !!}
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
