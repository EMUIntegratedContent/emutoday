@php($smallImg = $post->images()->where('imagetype_id', 28)->first())
@unless(!$smallImg)
  <div class="column">
    <div class="card">
      <img class="story-image" src="/imagecache/original/{{$smallImg->image_name}}"
           alt="{{ $smallImg->alt_text != '' ? $smallImg->alt_text : str_replace('"', "", $smallImg->caption) }}">
      <div class="card-section" data-equalizer-watch>
        <p class="more-story-caption">{{$smallImg->caption}}</p>
        <p class="link-group">
          <a href="/insideemu/posts/{{$post->id}}"
             aria-label="{{$smallImg->caption}} - {{$smallImg->moretext}}"
             class="readmore bold-green-link">{{$smallImg->moretext}}</a>
        </p>
      </div>
    </div><!-- /end .card -->
  </div>
@endunless
