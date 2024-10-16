@extends('public.layouts.global')
@section('title', 'Subscribe')
@section('content')
  <div id="content-area">
    <div id="calendar-bar">
      <div class="row">
        <div class="large-12 medium-12 small-12 column">
          <div class="row">
            <div class="large-6 medium-12 small-12 column">
              @if(session('data'))
                @if(session('data')['type'] === 'success')
                  <div class="callout success">
                    <p>{{ session('data')['msg'] }}</p>
                  </div>
                @else
                  <div class="callout alert">
                    <p>{{ session('data')['msg'] }}</p>
                  </div>
                @endif
              @else
                <h3 class="toptitle">Subscribe to EMU Today</h3>
                {!! Form::open(array('url' => 'mailgun/subscribe')) !!}

                {!! Form::label('email', 'Email Address') !!}
                {!! Form::text('email', null, array('placeholder'=>'you@emich.edu')) !!}

                {!! Form::label('name', 'Your Name (optional)') !!}
                {!! Form::text('name', null, array()) !!}

                {!! Form::submit('SUBSCRIBE TO EMU TODAY', array('class'=>'button large expanded')) !!}
                {!! Form::close() !!}
              @endif
              @else
                <h3 class="toptitle">Subscribe to EMU Today</h3>
                {!! Form::open(array('url' => 'mailgun/subscribe')) !!}

                {!! Form::label('email', 'Email Address') !!}
                {!! Form::text('email', null, array('placeholder'=>'you@emich.edu')) !!}

                {!! Form::label('name', 'Your Name (optional)') !!}
                {!! Form::text('name', null, array()) !!}

                <button type="submit" id="subscribe-emu-btn" class="button expanded large">SUBSCRIBE TO EMU TODAY
                </button>
                {!! Form::close() !!}
              @endif
            </div>
          </div>
        </div>
      </div>
    </div>
@endsection
