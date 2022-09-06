<p>Your expert speaker request has been submitted through EMU Today.</p>
<ul>
    <li>
        Expert: {{ $invitation->expert->first_name }} {{ $invitation->expert->last_name }}
    </li>
    <li>
        Organization: {{ $invitation->organization }}
    </li>
    <li>
        Organization Description: {{ $invitation->org_description }}
    </li>
    <li>
        Organization Website: {{ $invitation->org_website }}
    </li>
    <li>
        Contact Name: {{ $invitation->contact_name }}
    </li>
    <li>
        Contact Phone: {{ $invitation->contact_phone }}
    </li>
    <li>
        Contact Email: {{ $invitation->contact_email }}
    </li>
    <li>
        Date of Event: {{ $invitation->time_needed }}
    </li>
    <li>
        Length of Presentation: {{ $invitation->length_of_presentation }}
    </li>
    <li>
        EventDescription: {{ $invitation->event_description }}
    </li>
    <li>
        Topic: {{ $invitation->topic }}
    </li>
</ul>
<hr/>
<p>This email was generated on EMU Today's Expert Search (today.emich.edu/experts). </p>
