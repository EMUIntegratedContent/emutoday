@extends('beautymail::templates.minty')

@section('content')
	@include('beautymail::templates.minty.contentStart')
		<table border="1" cellpadding="5" cellspacing="0" height="100%" width="600px" id="bodyTable">
				<tr>
						<td align="center" valign="top">
								<table border="0" width="600" id="emailContainer">
										<tr valign="top" id="header-row">
											<td colspan="2">
												<img src="{{ url('/') }}/assets/imgs/email/emailblast_logo_template_600x120.png" width="600" style="padding:5px 0px 5px 0px" alt="EMU Today email blast logo"/>
											</td>
										</tr>
										<tr valign="top" id="title-row">
											<td colspan="2" style="text-align:center">
												<header>
													<h1>{{ $email->title }}</h1>
													<p>{{ $email->subheading }}</p>
												</header>
											</td>
										</tr>
										<tr>
											<td valign="top" width="368">
												<article>
													<img src="{{ url('/') . $mainStoryImage->image_path . $mainStoryImage->filename }}" alt="{{ $mainStoryImage->title }}"  style="border-right:5px solid #ffffff; width:368px; height:245px; "/>
													<h2>{{ $mainStory->title }}</h2>
													{!! str_limit($mainStory->content, $limit = 90, $end = '...') !!}
													<p><a href="{{ url('/') . '/story/' . $mainStory->story_type . '/' . $mainStory->id }}">Read More</a></p>
												</article>
												<hr />
											</td>
											<td rowspan="3" valign="top" width="232" style="background:#e5e5e5">
												<h3 style="padding:0 5px">Upcoming Events</h3>
												@foreach($email->events as $event)
													<article style="padding:0 5px">
														<hr />
														<h4>{{ $event->title }}</h4>
														{{ $event->start_date }} | {{ $event->start_time }} | {{ $event->location }}
														<p><a href="{{ url('/') . '/calendar/' . $event->start_date->format('Y') . '/' . $event->start_date->format('m') . '/' . $event->start_date->format('d') . '/' . $event->id}}">View Event</a></p>
													</article>
												@endforeach
											</td>
										</tr>
										<tr>
											<td valign="top">
												<h3>Featured News Stories</h3>
												@foreach($email->stories as $story)
													<article>
														<h4>{{ $story->title}}<h4>
														{!! str_limit($story->content, $limit = 30, $end = '...') !!}
														<p><a href="{{ url('/') . '/story/' . $story->story_type . '/' . $story->id }}">Read More</a></p>
													</article>
												@endforeach
												<hr />
											</td>
										</tr>
										<tr>
											<td valign="top">
												<h3>Announcements</h3>
												@foreach($email->announcements as $announcement)
													<article>
														<h4>{{ $announcement->title }}</h4>
														<p>{!! str_limit($announcement->announcement, $limit = 30, $end = '...') !!}</p>
														<p><a href="{{ $announcement->link }}">{{ $announcement->link_txt }}</a></p>
													</article>
												@endforeach
											</td>
										</tr>
										<tr id="footer-row" style="background:#555555; margin-top:5px; color:#ffffff;">
												<td valign="top" width="368" style="padding:5px">
													<ul class="social-icons" style="padding-left: 5px;">
														<li style="float:left; list-style-type:none; padding-right:10px;"><a href="https://www.facebook.com/EasternMichU/"><img alt="Facebook" src="{{ url('/') }}/assets/imgs/icons/facebook-base-icons.png"></a></li>
														<li style="float:left; list-style-type:none; padding-right:10px;"><a href="http://www.emich.edu/twitter/"><img alt="Twitter" src="{{ url('/') }}/assets/imgs/icons/twitter-base-icons.png"></a></li>
														<li style="float:left; list-style-type:none; padding-right:10px;"><a href="https://www.youtube.com/user/emichigan08"><img alt="YouTube" src="{{ url('/') }}/assets/imgs/icons/you-tube-base-icons.png"></a></li>
														<li style="float:left; list-style-type:none; padding-right:10px;"><a href="https://instagram.com/easternmichigan/"><img alt="Instagram" src="{{ url('/') }}/assets/imgs/icons/instagram-base-icons-new.png"></a></li>
														<li style="float:left; list-style-type:none; padding-right:10px;"><a href="https://www.linkedin.com/edu/school?id=18604"><img alt="Linked-In" src="{{ url('/') }}/assets/imgs/icons/linked-in-base-icons.png"></a></li>
														<li style="float:left; list-style-type:none; padding-right:10px;"><a href="http://blogemu.com/"><img alt="Blog EMU" src="{{ url('/') }}/assets/imgs/icons/e-base-icons.png"></a></li>
													</ul>
												</td>
												<td valign="top" width="232" style="padding:5px; text-align:center">
													<a style="color:#ffffff" href="{{ url('/') }}">EMU Today</a> | <a style="color:#ffffff" href="{{ url('/') }}/magazine">Eastern Magazine</a>
												</td>
										</tr>
								</table>
						</td>
				</tr>
		</table>
	@include('beautymail::templates.minty.contentEnd')
@stop
