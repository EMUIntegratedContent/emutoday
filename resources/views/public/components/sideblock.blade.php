@unless(count($sideitems) < 1)
<div class="row" >
    <div class="small-12 medium-12 large-12 columns" >
        <h6>More Stories</h6>
        <div id="five-stories-bar">
            <div class="row large-up-5 medium-up-4 show-for-medium" data-equalizer>
              @each('public.featuredstoryhub', $sideitems, 'fstory')
            </div><!-- row event block grid end -->
        </div> <!--end of five events bar-->
    </div><!-- /end .card -->
</div><!-- /end .row -->
@endunless
