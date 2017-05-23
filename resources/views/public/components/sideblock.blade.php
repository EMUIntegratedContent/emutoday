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
        @endif
    @endforeach
    </ul>
</div>
@endunless
