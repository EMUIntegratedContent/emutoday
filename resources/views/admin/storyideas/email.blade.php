<link href="https://fonts.googleapis.com/css?family=Poppins:400,400i,500,600,700" rel="stylesheet">

<style type="text/css" media="screen">

}
/*Media Queries*/
@media screen and (max-width: 400px) {

}
@media screen and (min-width: 401px) and (max-width: 620px) {

}
</style>

<p>Hi, {{ $recipient['first_name'] }}. The following story ideas are nearing their deadline.</p>
<dl>
@foreach($upcomingStories as $idea)
  <dt><strong>{{ $idea->title }}<strong></dt>
  <dd>
    <div style="padding:10px 0px;">{!! $idea->idea !!}</div>
    <ul>
      <li><strong>Deadline: </strong>{{ Carbon\Carbon::parse($idea->deadline)->format('m/d/y') }}</li>
      <li>
        @if($idea->assignee)
          Assigned to {{ $idea->assignee()->first()->getFullNameAttribute() }}
        @else
          Not assigned
        @endif
      </li>
    </ul>
  </dd>
  <hr />
@endforeach
</dl>

<p>That's it. Have a nice day!</p>
<p>This email was automatically generated from EMU Today.</p>
