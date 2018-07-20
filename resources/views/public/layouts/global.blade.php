<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta id="token" name="token" value="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=9">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="@yield('description')"/>
    <meta name="keywords" content="@yield('keywords')"/>

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
    (function (i, s, o, g, r, a, m) {
        i['GoogleAnalyticsObject'] = r;
        i[r] = i[r] || function () {
            (i[r].q = i[r].q || []).push(arguments)
        }, i[r].l = 1 * new Date();
        a = s.createElement(o),
            m = s.getElementsByTagName(o)[0];
        a.async = 1;
        a.src = g;
        m.parentNode.insertBefore(a, m)
    })(window, document, 'script', 'https://www.google-analytics.com/analytics.js', 'ga');

    ga('create', 'UA-9704867-7', 'auto');
    ga('send', 'pageview');
</script>
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
                    <li><a href="/hub">Today</a></li>
                    <li><a href="/calendar">Calendar</a></li>
                    <li><a href="/announcement">Announcements</a></li>
                    <li><a href="/story/news">News</a></li>
                    <li><a href="http://www.wemu.org">WEMU</a></li>
                    <li><a href="http://www.emueagles.com/">Athletics</a></li>
                </ul>
                <ul class="tier3-menu vertical dropdown menu" data-dropdown-menu>
                    <li><a href="/forthemedia">For the Media</a></li>
                    <li><a href="/magazine">Eastern Magazine</a></li>
                    <li><a href="/calendar/event/form">Submit an Event</a></li>
                    <li><a href="/announcement/form">Submit an Announcement</a></li>
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
                                <div class="large-9 medium-9 small-8 columns">
                                    <a href="https://www.emich.edu"><img class="full-logo"
                                                                         alt="Eastern Michigan University"
                                                                         src="/assets/imgs/home/block-e-box-inline-green-black.png"></a>

                                </div>
                                <div class="large-3 medium-3 small-4 columns">
                                    <div class="float-right text-right">
                                        <div id="vue-search-form" class="hide-for-small-only">
                                            <search-form>
                                                <input slot="csrf" type="hidden" name="_token"
                                                       value="{{ csrf_token() }}">
                                            </search-form>
                                        </div><!-- /#vue-event-form -->
                                        <span class="menu-area show-for-small-only text-right"><a
                                                    data-toggle="offCanvasRight">Menu &amp; Search <i
                                                        class="fa fa-list"></i></a></span>
                                    </div> <!-- .icon-menu -->
                                </div>
                            </div> <!-- tier2-nav -->
                        </div><!-- transparent-bar -->
                        <div id="tier2-nav">
                            <div class="row">
                                <div class="large-8 medium-6 small-12 columns">
                                    <h1><a href="/hub"><span class="first-word">EMU</span> Today</a></h1>
                                </div><!-- large-9 -->
                                <div class="large-4 medium-6 columns hide-for-small-only text text-right">
                                    <a href="{{ url('/calendar/event/form') }}">Submit an Event</a> | <a href="#">Submit an Announcement</a>
                                </div><!-- large-3 -->
                            </div><!-- row -->
                        </div><!--tier1-nav -->
                        <div id="secondary-bar">
                            <nav id="tier3-nav" class="row">
                                <div class="large-12 medium-12 columns hide-for-small-only">
                                    <ul id="tier3-nav-main">
                                        <li><a class="{{ set_active('hub')}}" href="{{ url('/calendar') }}"><i class="fa fa-play"></i> Today</a></li>
                                        <li><a class="{{ set_active('calendar')}}" href="{{ url('/calendar') }}"><i class="fa fa-play"></i> Calendar</a></li>
                                        <li><a class="{{ set_active('announcement')}}" href="{{ url('/announcement') }}"><i class="fa fa-play"></i> Announcements</a></li>
                                        <li><a class="{{ set_active('story/news')}}" href="{{ url('/story/news') }}"><i class="fa fa-play"></i> News</a></li>
                                        <li><a href="{{ url('/magazine') }}">Eastern Magazine</a></li>
                                        <li><a class="{{ set_active('experts')}}" href="{{ url('/experts') }}"><i class="fa fa-play"></i> Eastern Experts</a></li>
                                        <li><a href="http://wemu.org">WEMU</a></li>
                                        <li><a href="http://emueagles.com">Athletics</a></li>
                                    </ul>
                                </div>
                            </nav>
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
