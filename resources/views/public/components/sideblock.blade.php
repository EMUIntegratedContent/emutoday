@unless($sideitems->first())
<!-- Default Content -->
@else
<div class="featured-content-block">
    <h6 class="headline-block lt-green">{!! $sidetitle !!}</h6>
    {{-- {{  dd($sideitems->first()->present()->mainImageURL)}} --}}
    {{-- <a href="#"><img src="{{$sideitems->first()->present()->mainImageURL }}" /></a> --}}

        <img src="/imagecache/original/{{$sideitems->first()->filename}}" alt="{{$sideitems->first()->filename}}">

        {{-- <a href="#"><img src="{{$sideitems->first()->filename}}" /></a>
        <h4>{{$sideitems->first()->filename}}</h4> --}}
        <ul class="feature-list">
    @foreach($sideitems as $sideitem)
        <li><a href="/story/{{$storytype}}/{{$sideitem->story->id}}">{{ $sideitem->caption }}</a></li>
    @endforeach
    </ul>
</div>
@endunless
