@unless(count($sideitems) < 1)
  <div class="row">
    <div class="small-12 medium-12 large-12 columns" >
      <h3 class="subhead-title"><a class="bold-green-link" href="{{ url('/insideemu') }}">More Inside EMU</a></h3>
      <div id="five-stories-bar">
        <div class="row large-up-5 medium-up-3 show-for-medium" data-equalizer data-equalize-on-stack="true">
          @each('public.featuredinsideemupost', $sideitems, 'post')
        </div><!-- row event block grid end -->
      </div> <!--end of five events bar-->
    </div><!-- /end .card -->
  </div><!-- /end .row -->
@endunless
