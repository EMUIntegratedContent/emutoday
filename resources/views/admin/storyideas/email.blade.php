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
@foreach($upcomingStories as $story)
  <dt><strong>{{ $story->title }}<strong></dt>
  <dd>
    <div style="padding:10px 0px;">{!! $story->idea !!}</div>
    <ul>
      <li><strong>Deadline: </strong>{{ Carbon\Carbon::parse($story->deadline)->format('m/d/y') }}</li>
      <li>
        @if($story->assignee)
          Assigned to {{ $story->assignee()->first_name }} {{ $story->assignee()->last_name }}
        @else
          Not assigned
        @endif
      </li>
    </ul>
  </dd>
  <hr />
@endforeach
</dl>

<p>Have a nice day!</p>
<p>This email was automatically generated from EMU Today.</p>
