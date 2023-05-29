@unless(count($sideitems) < 1)
  <div class="row">
    <div class="small-12 medium-12 large-12 columns">
      <h3 class="subhead-title"><a class="bold-green-link" href="{{ url('/story/news') }}">More Stories</a></h3>
      <div id="five-stories-bar">
      {{--            <div class="row grid-x grid-margin-x" data-equalizer data-equalize-on="medium" id="test-eq">--}}
{{--      <div class="grid-container">--}}
{{--        <div class="grid-x grid-padding-x" data-equalizer data-equalize-by-row="true">--}}
{{--          <div class="row grid-x grid-padding-x" data-equalizer data-equalize-by-row="true">--}}
          <div id="five-stories-container" class="row" data-equalizer>
{{--            <div class="cell">--}}
            @each('public.featuredstoryhub', $sideitems, 'fstory')
{{--            </div>--}}
          </div><!-- row event block grid end -->
{{--        </div> <!--end of five events bar-->--}}
      </div>
    </div><!-- /end .card -->
  </div><!-- /end .row -->
@endunless
