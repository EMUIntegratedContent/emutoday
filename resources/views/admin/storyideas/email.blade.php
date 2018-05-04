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
    <div style="padding:20px 0px;">{!! $story->idea !!}</div>
    <p><strong>Deadline: </strong>{{ \Carbon\Carbon::createFromFormat('d/m/y', $story->deadline)  }}</p>
  </dd>
@endforeach
</dl>

<p>Have a nice day!</p>
<p>This email was automatically generated from EMU Today.</p>
