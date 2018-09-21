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
            <h3 class="toptitle">Feedback</h3>
            {!! Form::open(array('url' => 'feedback')) !!}
            <div class="row">
              <div class="large-6 columns">
                <!-- FIRST NAME -->
                {!! form::label('fname', 'First Name') !!}
                {!! form::text('fname') !!}
              </div>
              <div class="large-6 columns">
                <!-- LAST NAME -->
                {!! form::label('lname', 'Last Name') !!}
                {!! form::text('lname') !!}
              </div>
            </div>

            <!-- EMAIL -->
            {!! Form::label('email', 'Email Address') !!}
            {!! Form::text('email', null, array('placeholder'=>'you@emich.edu')) !!}

            <!-- COMMENTS -->
            {!! Form::label('comments', 'Would you like to share feedback? Please enter your comments below.') !!}
            {!! Form::textarea('comments') !!}

            {!! Form::submit('SHARE FEEDBACK', array('class'=>'button large expanded')) !!}
            {!! Form::close() !!}
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
