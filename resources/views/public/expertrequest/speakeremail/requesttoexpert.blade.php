@extends('beautymail::templates.widgets')

@section('content')

	@include('beautymail::templates.widgets.articleStart', ['color' => '#a2e600'])
		<h1><strong>Hello, {{ $invitation->expert->first_name }}! You've been invited to speak at {{ $invitation->organization }}</strong></h1>
		<p>{{ $invitation->event_description }}</p>
    <p>Preferred Topic: {{ $invitation->topic }}</p>
    <p>We would like you to speak on <strong>{{ Carbon\Carbon::parse($invitation->time_needed)->format('l, F jS, Y \\a\\t g:i a') }}</strong> for <strong>{{ $invitation->length_of_presentation }}</strong>.</p>
    <p>The event is located at {{ $invitation->location }}.</p>
	@include('beautymail::templates.widgets.articleEnd')

	@include('beautymail::templates.widgets.articleStart', ['color' => '#a2e600'])
		<h2 class="secondary"><strong>More details about this speaking engagement...</strong></h2>
		<h3>About {{ $invitation->organization}}</h3>
    <p>{{$invitation->org_description}}</p>
    @if($invitation->org_website)
        <p>You can find out more about us online at {{ $invitation->org_website }}</p>
    @endif
    <h3>Please contact this person directly if you would be willing to participate.</h3>
    <p>{{ $invitation->contact_name }}</p>
    <p>{{ $invitation->contact_phone }}</p>
    <p>{{ $invitation->contact_email }}</p>
    <hr />
    <p>This email was generated on EMU Today's Expert Search (today.emich.edu/experts). </p>

	@include('beautymail::templates.widgets.articleEnd')

@stop
