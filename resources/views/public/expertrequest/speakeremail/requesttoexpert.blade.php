<p>You've been invited to speak
    at {{ $invitation->organization }}.</p>
<p>Event Description: {{ $invitation->event_description }}<br>
    Preferred Topic: {{ $invitation->topic }}<br>
    Date and Time:
    <strong>{{ Carbon\Carbon::parse($invitation->time_needed)->format('l, F jS, Y \\a\\t g:i a') }}</strong> for
    <strong>{{ $invitation->length_of_presentation }}</strong>.<br>
    Event Location: {{ $invitation->location }}.</p>
<p><strong>About {{ $invitation->organization}}</strong></p>
<p>{{$invitation->org_description}}<br>
    @if($invitation->org_website)
        Organization Website: {{ $invitation->org_website }}
    @endif
</p>
<p>Please contact this person directly if you would be willing to participate.<br>
    Name: {{ $invitation->contact_name }}<br>
    Phone: {{ $invitation->contact_phone }}<br>
    Email: {{ $invitation->contact_email }}
</p>
<hr/>
<p>This email was generated on EMU Today's Expert Search (today.emich.edu/experts). </p>
