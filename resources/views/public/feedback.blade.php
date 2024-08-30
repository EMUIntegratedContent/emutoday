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
                {!! html()->form('POST', url('feedback'))->open() !!}
                <div class="row">
                  <div class="large-6 columns">
                    <!-- FIRST NAME -->
                    {!! html()->label('First Name', 'fname') !!}
                    {!! html()->text('fname')->name('fname') !!}
                  </div>
                  <div class="large-6 columns">
                    <!-- LAST NAME -->
                    {!! html()->label('Last Name', 'lname') !!}
                    {!! html()->text('lname')->name('lname') !!}
                  </div>
                </div>

                <!-- EMAIL -->
                <div class="form-group">
                  {!! html()->label('Email Address', 'email') !!}
                  {!! html()->email('email')->placeholder('you@emich.edu')->name('email') !!}
                </div>

                <!-- COMMENTS -->
                <div class="form-group">
                  {!! html()->label('Would you like to share feedback? Please enter your comments below.', 'comments') !!}
                  {!! html()->textarea('comments')->name('comments') !!}
                </div>

                <div class="form-group">
                  {!! html()->submit('SHARE FEEDBACK')->class('button large expanded') !!}
                </div>

                {!! html()->form()->close() !!}
              @endif
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
