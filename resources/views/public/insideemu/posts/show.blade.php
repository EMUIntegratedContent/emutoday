@extends('public.layouts.global')
@section('title'){{ isset($post) ? $post->title : 'Post not available' }} @stop

@section('addthisMeta')
<meta property="og:type" content="website" />
<meta property="og:url" content="{{trim(Request::fullUrl())}}" />
<meta property="og:title" content="{{trim($post->title)}}" />
<meta property="og:description" content="{{trim($post->teaser)}}" />
  @if($mainImg)
  <meta property="og:image" content="https://{{trim(Request::server('SERVER_NAME'))}}{{trim($mainImg->image_path)}}"/>
  <meta property="og:image:secure_url" content="https://{{trim(Request::server('SERVER_NAME'))}}{{trim($mainImg->image_path)}}"/>
  <meta property="og:image:width" content="400" />
  <meta property="og:image:height" content="300" />
  @else
  <meta property="og:image" content="{{ url('/assets/imgs/home/block-e-green.png') }}"/>
  <meta property="og:image:secure_url" content="{{ url('/assets/imgs/home/block-e-green.png') }}"/>  <meta property="og:image:width" content="150" />
  <meta property="og:image:height" content="150" />
  @endif
@endsection

@section('content')
  <div id="news-story-bar">
    <div class="row">
      <div class="large-12 medium-12 small-12 columns">
        <!-- DO NOT SHOW POSTS WHOSE START DATE/TIME HAS NOT ARRIVED AND WHOSE END TIME HAS NOT ARRIVED-->
        @if(isset($post))
          <!-- Post Page Title group -->
          <div id="title-grouping" class="row">
            <div class="small-12 columns">
              <h2>{{ $post->title }}</h2>
              <h3>{{ $post->teaser }}</h3>
            </div>
          </div>
          <!-- Post Page Content -->
          <div id="story-content" class="row ck-content">
            <!-- Story Content Column -->
            <div class="large-9 large-push-3 medium-9 medium-push-3 small-12 columns">
              @if(isset($mainImg))
                <div id="big-feature-image">
                  <img src="{{ $mainImg->image_path }}"
                       alt="{{ $mainImg->alt_text != '' ? $mainImg->alt_text : str_replace('"', "", $post->title) }}">
                  <div class="feature-image-caption">{{ $mainImg->caption }}</div>
                </div>
              @endif
              <div id="story-content-edit">
                {!! $post->content !!}
              </div>
            </div>
            <!-- Page Side Bar Column -->
            <div class="large-3 large-pull-9 medium-3 medium-pull-9 small-12 columns" id="story-sidebar">
              <div class="dots-bottom">
                @include('public.vendor.addthis')
              </div>
              <div class="no-dots-bottom">
                <p>
                  Contributed by:<br>
                  @if($post->source)
                    {{$post->source}}
                  @else
                    Division of Communications
                  @endif
                </p>
              </div>
            </div>
          </div>
        @else
          <p>The resource you are looking for is not available.</p>
        @endif
      </div>
    </div>
  </div>
  <div id="more-stories-bar">
      @include('public.components.insideemu_sideblock', ['sideitems' => $sidePosts])
  </div>
@endsection
    @section('footer-vendor')
        @parent
    @endsection
    @section('footer-plugin')
        @parent
    @endsection
@section('footer')
  @parent

  @endsection
