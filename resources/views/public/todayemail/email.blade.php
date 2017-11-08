<div style="border:1px solid #000000; padding:5px; margin: 0 auto; width:610px">
	<table border="0" cellpadding="5" cellspacing="0" height="100%" width="100%">
			<tr>
					<td align="center" valign="top">
							<table border="0" width="600" id="emailContainer">
									<tr valign="top" id="header-row">
										{{--<td colspan="2">
											<img src="{{ url('/') }}/assets/imgs/email/emailblast_logo_template_600x120.png" width="600" style="padding:5px 0px 5px 0px" alt="EMU Today email blast logo"/>
										</td>
										--}}
										<h1>EMU Today Digest</h1>
									</tr>
									{{--
									<tr valign="top" id="title-row">
										<td colspan="2" style="text-align:center">
											<header>
												<h1>{{ $email->title }}</h1>
												<p>{{ $email->subheading }}</p>
											</header>
										</td>
									</tr>
									--}}
									<tr>
										<td valign="top">
											<article>
												<img alt="{{ $mainStoryImages[0]->caption }}"
														 src="{{ url('/') }}/imagecache/emailmain/{{$mainStoryImages[0]->filename}}"
														 style="border-right:5px solid #ffffff; width:600px; height:282px;"/>
												<h2><a href="{{ url('/') . '/story/' . $mainStories[0]->story_type . '/' . $mainStories[0]->id }}">{{ $mainStoryImages[0]->title }}</a></h2>
												{!! str_limit($mainStoryImages[0]->teaser, $limit = 90, $end = '...') !!}
											</article>
										</td>
									</tr>
									{{-- some emails might not have sub stories! --}}
									@if($email->mainstories->count() == 3)
									<tr>
										<table>
											<tr>
												<td colspan="2">
													<h2><a href="{{ url('/') }}/story/news">News Stories</a></h2>
												</td>
											</tr>
											<tr>
												<td valign="top" width="300px">
													<article>
														<img alt="{{ $mainStoryImages[1]->caption }}"
																 src="{{ url('/') }}/imagecache/emailsub/{{$mainStoryImages[1]->filename}}"
																 style="border-right:5px solid #ffffff; width:231px; height:210px;"/>
														<h3><a href="{{ url('/') . '/story/' . $mainStories[1]->story_type . '/' . $mainStories[1]->id }}">{{ $mainStoryImages[1]->title }}</a></h3>
														{!! str_limit($mainStoryImages[1]->teaser, $limit = 90, $end = '...') !!}
													</article>
												</td>
												<td valign="top" width="300px">
													<article>
														<img alt="{{ $mainStoryImages[2]->caption }}"
																 src="{{ url('/') }}/imagecache/emailsub/{{$mainStoryImages[2]->filename}}"
																 style="border-right:5px solid #ffffff; width:231px; height:210px;"/>
														<h3><a href="{{ url('/') . '/story/' .$mainStories[2]->story_type . '/' . $mainStories[2]->id }}">{{ $mainStoryImages[2]->title }}</a></h3>
														{!! str_limit($mainStoryImages[2]->teaser, $limit = 90, $end = '...') !!}
													</article>
												</td>
											</tr>
										</table>
									</tr>
									@endif
									<tr>
										<td colspan="2" valign="top">
											<ul>
											@foreach($email->stories as $story)
												<li>
													<a href="{{ url('/') . '/story/' . $story->story_type . '/' . $story->id }}">{{ $story->title }}</a>
												</li>
											@endforeach
											</ul>
										</td>
									</tr>
									<tr>
										<td colspan="2" valign="top">
											<h2><a href="{{ url('/') }}/announcement">Announcements</a></h2>
											@foreach($email->announcements as $announcement)
												<li>
													<a href="{{ $announcement->link }}">{{ $announcement->title }}</a>
												</li>
											@endforeach
										</td>
									</tr>
									<tr>
										<td colspan="2" valign="top">
											<h2><a href="{{ url('/') }}/calendar">What's Happening at EMU</a></h2>
											@foreach($email->events as $event)
												<li>
													{{ $event->start_date->format('M j') }} <a href="{{ url('/') . '/calendar/' . $event->start_date->format('Y') . '/' . $event->start_date->format('m') . '/' . $event->start_date->format('d') . '/' . $event->id }}">{{ $event->title }}</a>
												</li>
											@endforeach
										</td>
									</tr>
									<tr style="background:#999999; margin-top:5px; color:#ffffff;">
										<td>
											<table>
												<tr>
													<td>EMU Today</td>
													<td>Calendar</td>
													<td>Announcements</td>
													<td>News</td>
													<td>Eastern Magazine</td>
												</tr>
											</table>
										</td>
									</tr>
									<tr id="footer-row" style="background:#555555; margin-top:5px; color:#ffffff;">
										<td colspan="2">
											<table>
												<tr>
													<td valign="top" style="padding:5px; text-align:center">
														<ul class="social-icons" style="padding-left: 5px;">
															<li style="float:left; list-style-type:none; padding-right:10px;"><a href="https://www.facebook.com/EasternMichU/"><img alt="Facebook" src="{{ url('/') }}/assets/imgs/icons/facebook-base-icons.png"></a></li>
															<li style="float:left; list-style-type:none; padding-right:10px;"><a href="http://www.emich.edu/twitter/"><img alt="Twitter" src="{{ url('/') }}/assets/imgs/icons/twitter-base-icons.png"></a></li>
															<li style="float:left; list-style-type:none; padding-right:10px;"><a href="https://www.youtube.com/user/emichigan08"><img alt="YouTube" src="{{ url('/') }}/assets/imgs/icons/you-tube-base-icons.png"></a></li>
															<li style="float:left; list-style-type:none; padding-right:10px;"><a href="https://instagram.com/easternmichigan/"><img alt="Instagram" src="{{ url('/') }}/assets/imgs/icons/instagram-base-icons-new.png"></a></li>
															<li style="float:left; list-style-type:none; padding-right:10px;"><a href="https://www.linkedin.com/edu/school?id=18604"><img alt="Linked-In" src="{{ url('/') }}/assets/imgs/icons/linked-in-base-icons.png"></a></li>
															<li style="float:left; list-style-type:none; padding-right:10px;"><a href="http://blogemu.com/"><img alt="Blog EMU" src="{{ url('/') }}/assets/imgs/icons/e-base-icons.png"></a></li>
														</ul>
													</td>
												</tr>
												<tr>
													<td><a href="https://www.emich.edu/communications/">Division of Communications</a> | <a href="https://www.emich.edu">Eastern Michigan University</a></td>
												</tr>
											</table>
										</td>
									</tr>
							</table>
					</td>
			</tr>
	</table>
</div>
