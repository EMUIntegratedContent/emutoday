{{--

@unless($sideitems->first())
<!-- Default Content -->
@else
<div class="featured-content-block">
    <h6 class="headline-block lt-green">{!! $sidetitle !!}</h6>
    <img src="/imagecache/original/{{$sideitems->first()->filename}}" alt="{{$sideitems->first()->filename}}">
    <ul class="feature-list">
    @foreach($sideitems as $sideitem)
        @if(!empty($sideitem->caption) && !empty($sideitem->story->id))
          <li><a href="/story/{{$storytype}}/{{$sideitem->story->id}}">{{ $sideitem->caption }}</a></li>
        @else
           <li><a href="/story/{{$storytype}}/{{$sideitem->story->id}}">Read more.</a></li>
        @endif
    @endforeach
    </ul>
</div>
@endunless

--}}

<div class="row" >
    <div class="small-12 medium-12 large-12 columns" >
        <h6>More Stories</h6>
        @unless(empty($sideitems[0]))
            <div id="five-stories-bar">
                <div class="row large-up-5 medium-up-4 show-for-medium" data-equalizer>
                  @each('public.featuredstoryhub', $sideitems, 'fstory')
                </div><!-- row event block grid end -->
            </div> <!--end of five events bar-->
        @endunless
    </div><!-- /end .card -->
</div><!-- /end .row -->
