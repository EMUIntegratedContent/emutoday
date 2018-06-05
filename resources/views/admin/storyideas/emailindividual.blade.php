<link href="https://fonts.googleapis.com/css?family=Poppins:400,400i,500,600,700" rel="stylesheet">

<style type="text/css" media="screen">

}
/*Media Queries*/
@media screen and (max-width: 400px) {

}
@media screen and (min-width: 401px) and (max-width: 620px) {

}
</style>

<p>Hi, {{ $idea->assignee()->first()->first_name }}. The following story idea is due for submission.</p>
<dl>
  <dt><strong>{{ $idea->title }}<strong></dt>
  <dd>
    <div style="padding:10px 0px;">{!! $idea->idea !!}</div>
    <ul>
      <!--<li><strong>Medium: </strong>{{-- $idea->medium()->first()->medium --}}</li>-->
      <li><strong>Deadline: </strong>{{ Carbon\Carbon::parse($idea->deadline)->format('m/d/y') }}</li>
    </ul>
  </dd>
</dl>
<hr />
<p>That's it. Have a nice day!</p>
<p>This email was automatically generated from EMU Today.</p>
