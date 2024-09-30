@php($smallImg = $post->images()->where('imagetype_id', 28)->first())
@unless(!$smallImg)
  <div class="column">
    <div class="card">
      <img class="story-image" src="/imagecache/original/{{$post->id}}/{{$smallImg->image_name}}"
           alt="{{ $smallImg->alt_text != '' ? $smallImg->alt_text : str_replace('"', "", $smallImg->caption) }}">
      <div class="card-section" data-equalizer-watch>
        <p class="more-story-caption">{{$post->title}}</p>
        <p class="link-group">
          <a href="/insideemu/posts/{{$post->id}}"
             aria-label="{{$smallImg->alt_text}}"
             class="readmore bold-green-link">{{ $smallImg->moretext ?: 'Read More' }}</a>
        </p>
      </div>
    </div><!-- /end .card -->
  </div>
@endunless
