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
                {!! html()->form('POST', url('mailgun/subscribe'))->open() !!}

                {!! html()->label('email', 'Email Address') !!}
                {!! html()->text('email', null, array('placeholder'=>'you@emich.edu')) !!}

                {!! html()->label('name', 'Your Name (optional)') !!}
                {!! html()->text('name', null, array()) !!}

                <button type="submit" id="subscribe-emu-btn" class="button expanded large">SUBSCRIBE TO EMU TODAY
                </button>
                {!! html()->form()->close() !!}
              @endif
            </div>
          </div>
        </div>
      </div>
    </div>
@endsection
