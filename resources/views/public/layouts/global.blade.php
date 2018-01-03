<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
        <meta id="token" name="token" value="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=9">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="description" content="@yield('description')" />
    <meta name="keywords" content="@yield('keywords')" />

    @if (array_key_exists('magazine-title', View::getSections())) <!-- Check for Magazine title -->
      <title>@yield('magazine-title', 'Eastern Magazine') - Eastern Magazine</title>
    @else
      <title>@yield('title', 'News Hub') - EMU Today</title>
    @endif

    @include('public.layouts.styles')
    @include('public.layouts.scriptshead')
    @include('include.js')
    @yield('addthisMeta')
    <meta name="_token" content="{{ csrf_token() }}">
  </head>
  <body>
    <script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-9704867-7', 'auto');
    ga('send', 'pageview');
    </script>
    @yield('bodytop')

        {{-- EMU campus-wide emergency message area --}}
        <div id="emergency-bar" class="no emergency">
            <div class="row">
                <div class="large-12 columns">
                    <h3 id="emergency-title"></h3>
                    <p id="emergency-message"></p>
                </div>
            </div>
        </div>
        <div class="browserupgrade" id="outdated-browser-container"> </div>
    <div class="off-canvas-wrapper">

      <div class="off-canvas-wrapper-inner" data-off-canvas-wrapper>
        <!-- ***** off-canvas off-canvas right menu 'small' screen -->

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
              <li><a href="/hub">Today</a></li>
              <li><a href="/calendar">Calendar</a></li>
              <li><a href="/announcement">Announcements</a></li>
              <li><a href="/story/news">News</a></li>
              <li><a href="http://www.wemu.org">WEMU</a></li>
              <li><a href="http://www.emueagles.com/">Athletics</a></li>
            </ul>
            <ul class="tier3-menu vertical dropdown menu" data-dropdown-menu>
              <!--<li><a href="/experts">Experts</a></li>-->
              <li><a href="/forthemedia">For the Media</a></li>
              <li><a href="/magazine">Eastern Magazine</a></li>
              <li><a href="/calendar/event/form">Submit an Event</a></li>
              <li><a href="/announcement/form">Submit an Announcement</a></li>
          </ul>
           @show
        </div> <!-- off-canvas position-right -->
             <div class="off-canvas-content" data-off-canvas-content>
                    @section('connectionbar')
                    <div id="connection-bar" data-equalizer>
                        <div id="all-connections" data-equalizer-watch>
                            <div id="white-bar">
                                <div id="tier1-nav">
                                    <div class="row">
                                        <div class="large-9 large-push-3 medium-10 medium-push-2 small-10 small-push-2 columns">
                                            <div class="row">
                                                <div class="large-5 medium-7 small-12 columns">
                                                    <h1><a href="/hub"><span class="first-word">EMU</span> Today</a></h1>
                                                </div>
                                                <div class="large-7 medium-5 small-12 columns">

                                                    <div class="float-right text-right">

                                                        <div id="vue-search-form" class="hide-for-small-only">
                                                            <search-form>
                                                                <input slot="csrf" type="hidden" name="_token" value="{{ csrf_token() }}">
                                                            </search-form>
                                                        </div><!-- /#vue-event-form -->
                                                        <span class="menu-area show-for-small-only text-right"><a data-toggle="offCanvasRight">Menu &amp; Search <i class="fa fa-list"></i></a></span>

                                                    </div> <!-- .icon-menu -->
                                                </div>
                                            </div>
                                        </div><!-- large-9 -->
                                        <div class="large-3 large-pull-9 medium-2 medium-pull-10 small-2 small-pull-10 columns">
                                            <div id="logo-box" data-equalizer-watch>
                                                <a href="http://www.emich.edu"><img class="full-logo show-for-large" alt="Eastern Michigan University" src="/assets/imgs/home/logo.png"></a>
                                                <a href="http://www.emich.edu"><img class="emu show-for-medium-only" alt="Eastern Michigan University" src="/assets/imgs/home/emu.png"></a>
                                                <a href="http://www.emich.edu"><img class="block-e show-for-small-only" alt="Eastern Michigan University" src="/assets/imgs/home/blockewhiteplain.png"></a>
                                            </div><!-- logo-box -->
                                        </div><!-- large-3 -->
                                    </div><!-- row -->
                                </div><!--tier1-nav -->
                            </div><!-- white-bar -->

                            <div id="transparent-bar">
                                <div id="tier2-nav" class="row">
                                    <div class="large-10 large-push-2 medium-10 medium-push-2 columns">
                                        <div class="row">
                                            <div class="large-12 medium-12 show-for-medium columns">
                                                <!-- '/admin/php/top_nav.php'); -->
                                                <ul id="tier2-nav-main">
                                                    <li><a class="{{ set_active('hub')}}" href="/hub"><i class="fa fa-play"></i>Today</a></li>
                                                    <li ><a class="{{ set_active('calendar')}}" href="/calendar"><i class="fa fa-play"></i>Calendar</a></li>
                                                    <li ><a class="{{ set_active('announcement')}}" href="/announcement"><i class="fa fa-play"></i>Announcements</a></li>
                                                    <li ><a class="{{ set_active('news')}}" href="/story/news"><i class="fa fa-play"></i>News</a></li>
                                                    <li ><a href="http://www.wemu.org"><i class="fa fa-play"></i>WEMU</a></li>
                                                    <li><a href="http://www.emueagles.com/">Athletics</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="large-2 large-pull-10 medium-2 medium-pull-10 small-2 small-pull-10 columns">&nbsp;</div>
                                </div> <!-- tier2-nav -->
                            </div><!-- transparent-bar -->

                            <div id="secondary-bar">
                                <div id="tier3-nav" class="row">
                                    <div class="large-10 large-push-2 medium-10 medium-push-2 show-for-medium columns">
                                        <div class="row">
                                            <div class="large-12 show-for-medium columns">
                                            <ul>
                                                <!--<li><a href="/experts">Experts</a></li>-->
                                                <li><a href="/forthemedia">For the Media</a></li>
                                                <li><a href="/magazine">Eastern Magazine</a></li>
                                                <li><a href="/calendar/event/form">Submit an Event</a></li>
                                                <li><a href="/announcement/form">Submit an Announcement</a></li>
                                            </ul>
                                        </div>
                                        </div>
                                    </div>
                                    <div class="large-2 large-pull-10 medium-2 medium-pull-10 show-for-medium columns">
                                    </div>
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
        <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-57b1dfed53cef787"></script>
    @show
    @section('footer-plugin')
    @show
    @include('public.layouts.scriptsfooter')
