<body style="background-color: #e1e1e1; width: 100%">
<div
    style="border:0px solid #ffffff; height:auto; padding:5px; margin: 0 auto; width:96%; font-family: 'Poppins', arial, sans-serif;">
  <p class="direct-today-link"
     style="padding: 0;margin: 0;text-align: center;font-size: 12px;margin-bottom: 8px;padding-top: 5px;"><a
        href="{{ url('/') }}" style="color: #046A38;text-decoration: underline;">Read EMU Today online</a></p>
  <table border="0" cellpadding="0" cellspacing="0" height="100%" align="center" class="outer"
         style="padding-top: .3rem;border-collapse: collapse;border-spacing: 0;font-family: 'Poppins', arial, sans-serif;color: #333333;background-color: #ffffff;margin: 0 auto;width: 98%;max-width: 600px;">
    <tr>
      <td align="center" valign="top">
        <table border="0"
               style="max-width: 100%;border-collapse: collapse;border-spacing: 0;font-family: 'Poppins', arial, sans-serif;color: #333333;background-color: #ffffff;"
               id="emailContainer">
          <tr height="54px">
            <td class="full-width-image">
              <a href="http://www.emich.edu/"
                 style="margin: 0;padding: 0;color: #046A38;text-decoration: underline;"><img
                    src="{{ url('/') }}/assets/imgs/email/topsection.png" alt="EMU Today email blast logo"
                    style="width: 100%;max-width: 600px;height: auto;"></a>
            </td>
          </tr>
          <tr valign="top" id="header-row" style="text-align:center">
            <td>
              <h2 style="padding: 0 0 7px 0;margin-top: 0;margin-left: auto;margin-right: auto;font-size: 38px;line-height: 38px;font-weight: 500;margin: 0;">
                The Week at EMU: Students</h2>
              <p class="sub-title" style="padding: 0;margin: 0;margin-bottom: 10px;">A Weekly Digest from <a
                    class="uppertitle" href="{{ url('/') }}" style="color: #333333;text-decoration: none;"><span
                      style="color: #046A38">EMU</span> Today </a></p>
            </td>
          </tr>
          {{-- FEATURED STORY (single; a Story or a Campus Life post) --}}
          @if($featured)
            <tr>
              <td valign="top" class="full-width-image">
                <article>
                  @if($featured instanceof \Emutoday\InsideemuPost)
                    <img alt="{{ $featuredImage->alt_text }}"
                         src="{{ url('/') }}{{$featuredImage->image_path}}"
                         style="border-right: 0px solid #ffffff;max-width: 600px;border-top: 3px solid #97D700;width: 100%;height: auto;">
                  @else
                    <img alt="{{ $featuredImage->caption }}"
                         src="{{ url('/') }}/imagecache/emailmain/{{$featuredImage->filename}}"
                         style="border-right: 0px solid #ffffff;max-width: 600px;border-top: 3px solid #97D700;width: 100%;height: auto;">
                  @endif

                  <div
                      style="padding-left: 1rem; padding-right: 1rem; padding-top: .6rem; padding-bottom: 16px; margin-bottom: 10px;">
                    <h2 class="indent"
                        style="margin-bottom: .8rem;font-weight: 500;padding: 12px 0 3px;margin: 0;font-size: 22px;margin-left: 1rem;margin-right: 1rem;">
                      @if($featured instanceof \Emutoday\InsideemuPost)
                        <a href="{{ url('/') }}/insideemu/posts/{{$featured->id}}"
                           style="color: #636363;text-decoration: none;">{{ $featuredImage->title }} &#10137;</a>
                      @elseif($featured->story_type == 'external' || ($featured->story_type == 'article' && $featured->tags()->where('name', 'external')->first()))
                        {{-- External stories should go directly to the external link --}}
                        <a href="{{$featured->getExternalLink()}}"
                           style="color: #636363;text-decoration: none;">{{ $featuredImage->title }} &#10137;</a>
                      @else
                        <a href="{{ url('/') . '/story/' . $featured->story_type . '/' . $featured->id }}"
                           style="color: #636363;text-decoration: none;">{{ $featuredImage->title }} &#10137;</a>
                      @endif
                    </h2>
                    <p class="indent"
                       style="font-size: 0.9rem;padding: 0;margin: 0;margin-left: 1rem;margin-right: 1rem;">{!! truncateLimitWords($featuredImage->teaser, 130) !!}</p>
                  </div>
                </article>
              </td>
            </tr>
          @endif
          {{-- MORE NEWS --}}
          <tr>
            <td valign="top">
              <div class="indent" style="margin-left: 1rem;margin-right: 1rem;">
                <h3 class="moveover"
                    style="font-weight: 500;padding: 10px 0 6px 8px;margin: 0;font-size: 18px;margin-top: 0rem;text-decoration: none;">
                  <a href="{{ url('/') }}/story/news" style="color: #636363;text-decoration: none;">More News
                    &#10137;</a></h3>
                <ul style="padding-bottom: 8px; padding-top: 0px;  margin-left: 0px; padding-left: 24px; margin-bottom: 5px; margin-top: 5px;">
                  @foreach($email->stories()->get() as $story)
                    <li style="padding-bottom: 9px; margin-left: 0; color:#046A38;">
                      @if($story->story_type == 'external'  || ($story->story_type == 'article' && $story->tags()->where('name', 'external')->first()))
                        <a style="text-decoration: none;color: #046A38;"
                           href="{{$story->getExternalLink()}}">{{ $story->title }}</a>
                      @else
                        <a style="text-decoration: none;color: #046A38;"
                           href="{{ url('/') . '/story/' . $story->story_type . '/' . $story->id }}">{{ $story->title }}</a>
                      @endif
                    </li>
                  @endforeach
                </ul>
              </div>
            </td>
          </tr>
          {{-- CAMPUS LIFE --}}
          @if(!$email->exclude_insideemu)
            <tr>
              <td valign="middle">
                <div class="indent" style="margin-left: 1rem;margin-right: 1rem;">
                  <h2 class="moveover"
                      style="border-top: 3px double #97D700;font-weight: 500;padding: 14px 0 6px 8px;margin: 0;font-size: 22px;margin-top: 0rem;text-decoration: none;">
                    <a href="{{ url('/') }}/insideemu" style="color: #636363;text-decoration: none;">Campus Life
                      &#10137;</a></h2>
                  <ul style="padding-bottom: 8px; padding-top: 0px;  margin-left: 0px; padding-left: 24px; margin-bottom: 5px; margin-top: 5px;">
                    @foreach($email->insideemuPosts()->get() as $post)
                      <li style="padding-bottom: 9px; margin-left: 0; color:#046A38;">
                        <a style="text-decoration: none;color: #046A38;"
                           href="{{ url('/') . '/insideemu/posts/' . $post->id }}">{{ $post->title }}</a>
                      </li>
                    @endforeach
                  </ul>
                </div>
              </td>
            </tr>
          @endif
          {{-- ANNOUNCEMENTS --}}
          <tr>
            <td valign="top">
              <div class="indent" style="margin-left: 1rem;margin-right: 1rem;">
                <h2 class="moveover"
                    style="border-top: 3px double #97D700;font-weight: 500;padding: 14px 0 6px 8px;margin: 0;font-size: 22px;margin-top: 0rem;text-decoration: none;">
                  <a href="{{ url('/') }}/announcement" style="color: #636363;text-decoration: none;">Announcements
                    &#10137;</a></h2>
                <ul style="padding-bottom: 8px; padding-top: 0px; margin-left: 0px; padding-left:24px; margin-bottom: 5px; margin-top: 5px;">
                  @foreach($email->announcements()->get() as $announcement)
                    <li style="padding-bottom: 9px; margin-left: 0; color:#046A38;">
                      @if($announcement->type != 'general')
                        <a style="text-decoration: none;color: #046A38;"
                           href="{{ $announcement->link }}">{{ $announcement->title }}</a>
                      @else
                        <a style="text-decoration: none;color: #046A38;"
                           href="{{ url('/') . '/announcement/' . $announcement->id }}">{{ $announcement->title }}</a>
                      @endif
                    </li>
                  @endforeach
                </ul>
              </div>
            </td>
          </tr>
          {{-- WHAT'S HAPPENING AT EMU --}}
          @if(!$email->exclude_events)
            <tr>
              <td valign="middle">
                <div class="indent" style="margin-left: 1rem;margin-right: 1rem;">
                  <h2 class="moveover"
                      style="border-top: 3px double #97D700;font-weight: 500;padding: 14px 0 6px 8px;margin: 0;font-size: 22px;margin-top: 0rem;text-decoration: none;">
                    <a href="{{ url('/') }}/calendar" style="color: #636363;text-decoration: none;">What's Happening at
                      EMU &#10137;</a></h2>
                  <ul style="margin-left: 0; margin-top:10px; padding-left: 7px; float: left; padding-bottom: 5px; width: 97%;">
                    @foreach($email->events()->get() as $event)
                      <li style="list-style: none; margin-left: 0; clear: both;">
                        <div
                            style="font-size: 18px; font-weight: 500; line-height: 110%; display: inline-block; width: 40px; height: 40px;  padding: 8px 10px 10px; float: left; text-align: center; margin-bottom: 14px; margin-right: 10px; color: #ffffff; background-color: #2b873b; text-decoration: none;">{{ $event->start_date->format('M j') }} </div>
                        <div
                            style="width: 75%; display: inline-block; padding-top: 5px; padding-bottom: 10px; float: left;">
                          <a style="text-decoration: none;color: #046A38;"
                             href="{{ url('/') . '/calendar/' . $event->start_date->format('Y') . '/' . $event->start_date->format('m') . '/' . $event->start_date->format('d') . '/' . $event->id }}">{{ $event->title }}</a>
                        </div>
                      </li>
                    @endforeach
                  </ul>
                  <div
                      style="width:75%;display:inline-block;padding-top:0px;padding-bottom:20px;float:left;padding-left:10px;">
                    <a href="{{ url('/') }}/calendar" style="color:#046a38;text-decoration:none" target="_blank">View
                      all calendar events &#10137;</a>
                  </div>
                </div>
              </td>
            </tr>
          @endif
          <tr style="background:#515151; color:#ffffff; border:0;">
            <td style="border:0; ">
              <table
                  style="margin-left: auto;margin-right: auto;margin-top: 3px;margin-bottom: 3px;border-collapse: collapse;border-spacing: 0;font-family: 'Poppins', arial, sans-serif;color: #333333;background-color: #ffffff;">
                <tr style="text-align:center; font-size: 12px; text-transform: uppercase; border:0; background-color:#515151; color:#ffffff;">
                  <td>
                    <ul style="list-style: none; padding-left: 0; background:#515151; color:#ffffff;">
                      <li style="display: inline-block; padding: 0; margin: 0;"><a
                            style="color: #ffffff; padding-left: 0px; padding-right: 5px;  text-decoration: none;"
                            href="{{ url('/') }}">EMU Today</a></li>
                      <li style="display: inline-block; padding: 0; margin: 0;"><a
                            style="color: #ffffff; padding-left: 5px; padding-right: 5px; text-decoration: none;"
                            href="{{ url('/') }}/calendar">Calendar</a></li>
                      <li style="display: inline-block; padding: 0; margin: 0;"><a
                            style="color: #ffffff; padding-left: 5px; padding-right: 5px; text-decoration: none;"
                            href="{{ url('/') }}/announcement">Announcements</a></li>
                      <li style="display: inline-block; padding: 0; margin: 0;"><a
                            style="color: #ffffff; padding-left: 5px; padding-right: 5px; text-decoration: none;"
                            href="{{ url('/') }}/story/news">News</a></li>
                      <li style="display: inline-block; padding: 0; margin: 0;"><a
                            style="color: #ffffff; padding-left: 5px; padding-right: 0; text-decoration: none;"
                            href="https://magazine.emich.edu">Eastern Magazine</a></li>
                    </ul>
                  </td>
                </tr>
              </table>
            </td>
          </tr>
          <tr id="footer-row" style="background-color: #333333; margin-top: 5px; color: #ffffff; border:0;">
            <td style="border:0; background-color: #333333; color: #ffffff;">
              <table
                  style="margin-left: auto;margin-right: auto;margin-bottom: 20px;background-color: #333333;color: #ffffff;border-collapse: collapse;border-spacing: 0;font-family: 'Poppins', arial, sans-serif;">
                <tr style="border:none; background-color: #333333; color: #ffffff;">
                  <td valign="top" style="padding:5px; border:0; background-color: #333333; color: #ffffff;">
                    <ul style="padding-left: 5px; text-align:center; padding-bottom: 0px; margin-bottom: 0;">
                      <li style="display: inline-block; list-style-type:none; padding-right:7px; margin: 0;">
                        <a href="https://www.facebook.com/EasternMichU/"
                           style="color: #046A38;text-decoration: underline;"><img class="img-circle" alt="Facebook"
                                                                                   src="https://www.emich.edu/today/icons/2018-social-icons/facebook.png"
                                                                                   style="border-radius: 50%;width: 95%;-moz-filter: grayscale(100%);filter: grayscale(100%);"></a>
                      </li>
                      <li style="display: inline-block; list-style-type:none; padding-right:7px; margin: 0;">
                        <a href="https://instagram.com/easternmichigan/"
                           style="color: #046A38;text-decoration: underline;"><img class="img-circle" alt="Instagram"
                                                                                   src="https://www.emich.edu/today/icons/2018-social-icons/instagram.png"
                                                                                   style="border-radius: 50%;width: 95%;-moz-filter: grayscale(100%);filter: grayscale(100%);"></a>
                      </li>
                      <li style="display: inline-block; list-style-type:none; padding-right:7px; margin: 0;">
                        <a href="https://www.linkedin.com/edu/school?id=18604"
                           style="color: #046A38;text-decoration: underline;"><img class="img-circle" alt="Linked-In"
                                                                                   src="https://www.emich.edu/today/icons/2018-social-icons/linkedin.png"
                                                                                   style="border-radius: 50%;width: 95%;-moz-filter: grayscale(100%);filter: grayscale(100%);"></a>
                      </li>
                      <li style="display: inline-block; list-style-type:none; padding-right:7px; margin: 0;">
                        <a href="https://www.tiktok.com/@easternmichiganu"
                           style="color: #046A38;text-decoration: underline;"><img
                              class="img-circle" alt="TikTok"
                              src="https://www.emich.edu/today/icons/tiktok.png"
                              style="border-radius: 50%;width: 95%;-moz-filter: grayscale(100%);filter: grayscale(100%);"></a>
                      </li>
                      <li style="display: inline-block; list-style-type:none; padding-right:7px; margin: 0;">
                        <a href="https://www.emich.edu/communications/expertise/social-media/"
                           style="color: #046A38;text-decoration: underline;"><img class="img-circle"
                                                                                   alt="X (formerly Twitter)"
                                                                                   src="https://www.emich.edu/today/icons/twitter-x.png"
                                                                                   style="border-radius: 50%;width: 95%;-moz-filter: grayscale(100%);filter: grayscale(100%);"></a>
                      </li>
                      <li style="display: inline-block; list-style-type:none; padding-right:7px; margin: 0;">
                        <a href="https://www.youtube.com/user/emichigan08"
                           style="color: #046A38;text-decoration: underline;"><img class="img-circle" alt="YouTube"
                                                                                   src="https://www.emich.edu/today/icons/2018-social-icons/youtube.png"
                                                                                   style="border-radius: 50%;width: 95%;-moz-filter: grayscale(100%);filter: grayscale(100%);"></a>
                      </li>
                    </ul>
                  </td>
                </tr>
                <tr style="text-align:center;">
                  <td>
                    <ul style="list-style: none; padding-left: 0;">
                      <li style="display: inline-block;"><a
                            style="font-size: 13px; color: #ffffff; padding-left: 0; padding-right: 3px; text-decoration: none;"
                            href="https://www.emich.edu/communications/">Division of Communications</a></li>
                      <li style="font-size: 13px; display: inline-block; color: #ffffff;"> |</li>
                      <li style="display: inline-block;"><a
                            style="font-size: 13px; color: #ffffff; padding-left: 0; padding-left: 3px; text-decoration: none;"
                            href="https://www.emich.edu">Eastern Michigan University</a></li>
                    </ul>
                  </td>
                </tr>
              </table>
            </td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
</div>
</body>
