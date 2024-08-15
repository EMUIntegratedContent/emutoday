{{-- internal communications (public page) --}}
@extends('public.layouts.global') @section('title', 'Inside EMU') @section('content')
  <div id="insideemu-area">
    <div class="row">
      <div class="small-12 columns">
        <div class="row">
          <div class="small-12 columns"><h1>Inside EMU</h1>
            <p><a title="Submit to Inside EMU" href="/insideemu/ideas/create">Submit to Inside EMU</a></p>
          </div>
        </div>
        <div id="four-stories-bar">
          <div id="four-stories-container" class="row small-up-2 medium-up-2 large-up-4" data-equalizer>
            @foreach($posts as $post)
              <div class="column four-stories-block">
                <img class="topic-image" src="/imagecache/original/{{$post->id}}/{{$post->images[0]->image_name}}"
                     alt="{{ $post->images[0]->alt_text != '' ? $post->images[0]->alt_text : str_replace('"', "", $post->images[0]->caption) }}">
                <div class="stories-content">
                  <div class="stories-text-content" data-equalizer-watch>
                    <p>{{$post->images[0]->caption}}</p>
                  </div>
                  <p class="link-group">
                    <a href="/insideemu/posts/{{$post->id}}">{{ $post->images[0]->moretext ?: 'Read more' }}</a>
                  </p>
                </div>
              </div>
            @endforeach
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

