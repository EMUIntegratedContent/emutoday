<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta id="token" name="token" value="{{ csrf_token() }}">
  <meta http-equiv="X-UA-Compatible" content="IE=9">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="@yield('description')"/>
  <meta name="keywords" content="@yield('keywords')"/>

  @if (array_key_exists('magazine-title', View::getSections()))
    <!-- Check for Magazine title -->
    <title>@yield('magazine-title', 'Eastern Magazine') - Eastern Magazine</title>
  @else
    <title>@yield('title', 'News Hub') - EMU Today</title>
  @endif

  @include('public.layouts.styles')
  @include('public.layouts.scriptshead')
  @include('include.js')
  @yield('addthisMeta')
  <meta name="_token" content="{{ csrf_token() }}">

  <!-- Google Tag Manager -->
  <script>(function (w, d, s, l, i) {
			w[l] = w[l] || [];
			w[l].push({
				'gtm.start':
					new Date().getTime(), event: 'gtm.js'
			});
			var f = d.getElementsByTagName(s)[0],
				j = d.createElement(s), dl = l != 'dataLayer' ? '&l=' + l : '';
			j.async = true;
			j.src =
				'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
			f.parentNode.insertBefore(j, f);
		})(window, document, 'script', 'dataLayer', 'GTM-K44PSS7');</script>
  <!-- End Google Tag Manager -->

  <!-- ShareThis Buttons Script -->
  <script type="text/javascript"
          src="https://platform-api.sharethis.com/js/sharethis.js#property=64c3c1a3c73e910012491920&product=inline-share-buttons&source=platform"
          async="async"></script>
</head>
<body>
<!-- Google Tag Manager (noscript) -->
<noscript>
  <iframe src="https://www.googletagmanager.com/ns.html?id=GTM-K44PSS7"
          height="0" width="0" style="display:none;visibility:hidden"></iframe>
</noscript>
<!-- End Google Tag Manager (noscript) -->
@yield('bodytop')

{{-- EMU campus-wide emergency message area --}}
<div id="emergency-bar" class="no emergency">
  <div class="row">
    <div class="large-12 columns" id="emergency-bar-content">
    </div>
  </div>
</div>
<div class="browserupgrade" id="outdated-browser-container"></div>
<div class="off-canvas-wrapper">

  <div class="off-canvas-wrapper-inner" data-off-canvas-wrapper>
    <!-- ***** off-canvas off-canvas right menu 'small' screen -->

    <!-- OFF CANVAS NAV -->
    <div class="off-canvas position-right" id="offCanvasRight" data-off-canvas data-position="right">

      @section('offcanvaslist')

        <ul class="tier2-menu vertical dropdown menu" data-dropdown-menu>
          <li>
            <div id="vue-search-form-offcanvas">
              <search-form-offcanvas>
                <input slot="csrf" type="hidden" name="_token" value="{{ csrf_token() }}">
              </search-form-offcanvas>
            </div><!-- /#vue-event-form-offcanvas -->
          </li>
          <li><a title="EMU Today homepage." href="/hub">Today</a></li>
          <li><a title="EMU Today events calendar." href="/calendar">Calendar</a></li>
          <li><a title="EMU Today campus announcements." href="/announcement">Announcements</a></li>
          <li><a title="EMU Today campus news, press releases, and official statements." href="/story/news">News</a>
          </li>
          <li><a title="Submit to Inside EMU."
                 href="{{ url('/insideemu') }}">Inside EMU</a></li>
          <li><a title="Eastern Magazine's homepage" href="https://magazine.emich.edu">Eastern Magazine</a>
          </li>
          <li><a title="Eastern Experts are availble for interviews and speaking engagements."
                 href="{{ url('/experts') }}">Eastern Experts</a></li>
          <li><a title="Samples of external media coverage focused on Eastern Michigan University."
                 href="/mediahighlights">Media Highlights</a></li>
          <li><a title="External link to WEMU." href="https://www.wemu.org" target="_blank">WEMU</a></li>
        </ul>
        <ul class="tier3-menu vertical dropdown menu" data-dropdown-menu>
          <li><a title="Subscribe to EMU Today" href="/subscribe">Subscribe to EMU Today</a></li>
          <li><a title="Submit a campus event." href="/calendar/event/form">Submit an Event</a></li>
          <li><a title="Submit an announcement." href="/announcement/form">Submit an Announcement</a></li>
          <li><a title="Submit a suggestion." href="/insideemu/ideas/create">Submit to Inside EMU</a></li>
        </ul>
      @show
    </div> <!-- off-canvas position-right -->

    <!-- NORMAL CONTENT -->
    <div class="off-canvas-content" data-off-canvas-content>
      @section('connectionbar')
        <div id="connection-bar" data-equalizer>
          <div id="all-connections" data-equalizer-watch>
            <div id="transparent-bar">
              <div id="tier1-nav" class="row">
                <div class="large-9 medium-9 small-12 columns">
                  <a title="Eastern Michigan University homepage." href="https://www.emich.edu"><img
                        class="full-logo"
                        alt="Eastern Michigan University"
                        src="/assets/imgs/home/block-e-box-inline-green-black.png"></a>

                </div>
                <div class="large-3 medium-3 small-12 columns">
                  <div class="float-right text-right">
                    <div id="vue-search-form" class="hide-for-small-only">
                      <search-form>
                        <input slot="csrf" type="hidden" name="_token"
                               value="{{ csrf_token() }}">
                      </search-form>
                    </div><!-- /#vue-event-form -->
                  </div> <!-- .icon-menu -->
                </div>
              </div> <!-- tier2-nav -->
            </div><!-- transparent-bar -->
            <div id="tier2-nav">

              <div class="row">

                <div class="large-5 medium-6 small-12 columns">
                  <h1><a href="/hub">EMU <span style="color:#000000;">Today</span></a></h1>
                  <div class="hide-for-large">
                    <img src="/assets/imgs/emu175/emu-175-green-logo-no-date.png" alt="EMU 175th Anniversary logo"
                         id="emu-175-menu-logo" width="100px"/>
                  </div>
                </div><!-- large-9 -->

                <div
                    class="large-5 medium-5 columns hide-for-large hide-for-medium show-for-small text search-small-left">
                                    <span class="menu-area show-for-small-only"><a
                                          data-toggle="offCanvasRight">Search &amp; Navigation <i
                                            class="fa fa-list"></i></a></span>
                </div>


                <div class="large-5 medium-5 columns hide-for-large show-for-medium hide-for-small text text-right">
                                   <span class="menu-area hide-for-large text-right"><a
                                         data-toggle="offCanvasRight">Navigation <i
                                           class="fa fa-list"></i></a></span>
                </div>


                <div class="large-7 medium-6 columns show-for-large text text-right">
                                    <span class="smaller"><a title="Subscribe to EMU Today" href="/subscribe">Subscribe to EMU Today</a> | <a
                                          href="{{ url('/calendar/event/form') }}">Submit an Event</a> | <a
                                          href="{{ url('/announcement/form') }}">Submit an Announcement</a> | <a
                                          href="{{ url('/insideemu/ideas/create') }}">Submit to Inside EMU</a>
                                    </span>
                </div><!-- large-3 -->

              </div><!-- row -->
            </div><!--tier1-nav -->


            <div id="secondary-bar" class="show-for-large">
              <div id="nav-175-wrapper">
                <nav id="tier3-nav" class="row">
                  <div class="large-12 medium-12 columns hide-for-small-only">
                    <ul id="tier3-nav-main">
                      <li><a title="EMU Today homepage." class="{{ set_active('hub')}}"
                             href="{{ url('/') }}">Today</a></li>
                      <li><a title="EMU Today events calendar." class="{{ set_active('calendar')}}"
                             href="{{ url('/calendar') }}">Calendar</a></li>
                      <li><a title="EMU Today campus announcements."
                             class="{{ set_active('announcement')}}"
                             href="{{ url('/announcement') }}">Announcements</a></li>
                      <li><a title="EMU Today campus news, press releases, and official statements."
                             class="{{ set_active('story/news')}}" href="{{ url('/story/news') }}">News</a>
                      </li>
                      <li><a title="Submit to Inside EMU."
                             href="{{ url('/insideemu') }}">Inside EMU</a></li>
                      <li><a title="Eastern Magazine's homepage" href="{{ url('/magazine') }}">Eastern
                          Magazine</a></li>
                      <li>
                        <a title="Eastern Experts are availble for interviews and speaking engagements."
                           class="{{ set_active('experts')}}" href="{{ url('/experts') }}">Eastern
                          Experts</a></li>
                      <li>
                        <a title="Samples of external media coverage focused on Eastern Michigan University."
                           href="/mediahighlights">Media Highlights</a></li>
                      <li><a title="External link to WEMU." href="https://www.wemu.org"
                             target="_blank">WEMU</a></li>
                    </ul>
                    <div>
                      <img src="/assets/imgs/emu175/emu-175-green-logo-no-date.png" alt="EMU 175th Anniversary logo"
                           id="emu-175-menu-logo" width="100px"/>
                    </div>
                  </div>
                </nav>
              </div>
            </div><!-- secondary-bar -->
          </div><!-- #all-connections -->
        </div> <!-- #connection-bar -->
      @show
      <!-- ************* CONTENT-AREA ********** -->
      <div id="content-area">
        @if (array_key_exists('content', View::getSections()))
          @yield('content')
        @else
          @yield('content-top')
          @yield('content-middle')
          @yield('content-bottom')
        @endif
        @include('public.layouts.basebar')
      </div><!-- #content-area -->

    </div> <!-- .off-canvas-content -->
  </div> <!-- .off-canvas-wrapper-inner -->
</div> <!-- .off-canvas-wrapper -->
@section('footer-vendor')
  <!-- Go to www.addthis.com/dashboard to customize your tools -->
{{--    <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-57b1dfed53cef787"></script>--}}
@show
@section('footer-plugin')
@show
@include('public.layouts.scriptsfooter')
