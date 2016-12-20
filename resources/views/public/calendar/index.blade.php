@extends('public.layouts.global')
@section('title','Calendar')
@section('content')
<div id="content-area">
    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
        @if(Session::has('alert-' . $msg))
        <div class="row">
            <div class="callout success">
                {{ Session::get('alert-' . $msg) }}
            </div>
        </div>
        @endif
    @endforeach
  <div id="calendar-bar">
    <div class="row">
      <div class="large-12 medium-12 small-12 columns">
        <div class="row">
          <div class="large-12 medium-12 small-12 columns"><h3 class="cal-caps toptitle">Events Calendar</h3></div>
        </div>
        <div id="five-events-container" class="row">

          <div class="large-12 medium-12 small-12 columns">

            @unless(empty($featuredevents[0]))
            <div id="five-events-bar">
              <div id="news-title-bar" class="row">
                <div class="large-12 medium-12 show-for-medium columns">
                  <h5 class="subhead-title">Featured Events</h5>
                </div>
              </div>

              <div class="row large-up-5 medium-up-3 show-for-medium" data-equalizer>
                @each('public.calendar.partials.featuredevent', $featuredevents, 'fevent')
              </div><!-- row event block grid end -->
            </div> <!--end of five events bar-->
            @endunless

          </div>
        </div><!--row 2 in calendar bar-->
      </div><!--end calendar row column-->

    </div><!--end calendar bar row 1-->
    <div id="vue-caleventview">
      <component  :var-year-unit="{!! $varYearUnit !!}"
        :var-month-unit="{!! $varMonthUnit !!}"
        :var-day-unit="{!! $varDayUnit !!}"
        :eventid="{!!$eventid!!}"
        is="event-view">
      </component>
    </div><!-- end calendar-bar -->
</div> <!-- end content-area -->
@endsection

@section('scriptsfooter')
@parent
<script type="text/javascript" src="/js/vue-caleventview.js"></script>
@endsection
