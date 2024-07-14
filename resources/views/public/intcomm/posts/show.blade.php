@extends('public.layouts.global')
@section('title'){{ isset($post) ? $post->title : 'Post not available' }} @stop

@section('addthisMeta')
{{--<meta property="og:type" content="website" />--}}
{{--<meta property="og:url" content="{{trim(Request::fullUrl())}}" />--}}
{{--@if($story->story_type == 'news' && $addThisImage)--}}
{{--  @if($addThisImage->title)--}}
{{--  <meta property="og:title" content="{{$addThisImage->title}}" />--}}
{{--  @else--}}
{{--  <meta property="og:title" content="{{trim($story->title)}}" />--}}
{{--  @endif--}}
{{--@else--}}
{{--  <meta property="og:title" content="{{trim($story->title)}}" />--}}
{{--@endif--}}
{{--<meta property="og:description" content="{{trim($story->subtitle)}}" />--}}
{{--  @if($story->story_type == 'news' && $addThisImage)--}}
{{--  <meta property="og:image" content="https://{{trim(Request::server('SERVER_NAME'))}}{{trim($addThisImage->present()->mainImageURL)}}"/>--}}
{{--  <meta property="og:image:secure_url" content="https://{{trim(Request::server('SERVER_NAME'))}}{{trim($addThisImage->present()->mainImageURL)}}"/>--}}
{{--  <meta property="og:image:width" content="400" />--}}
{{--  <meta property="og:image:height" content="300" />--}}
{{--  @elseif($mainStoryImage)--}}
{{--  <meta property="og:image" content="https://{{trim(Request::server('SERVER_NAME'))}}{{trim($mainStoryImage->present()->mainImageURL)}}"/>--}}
{{--  <meta property="og:image:secure_url" content="https://{{trim(Request::server('SERVER_NAME'))}}{{trim($mainStoryImage->present()->mainImageURL)}}"/>--}}
{{--  <meta property="og:image:width" content="400" />--}}
{{--  <meta property="og:image:height" content="300" />--}}
{{--  @else--}}
{{--  <meta property="og:image" content="{{ url('/assets/imgs/home/block-e-green.png') }}"/>--}}
{{--  <meta property="og:image:secure_url" content="{{ url('/assets/imgs/home/block-e-green.png') }}"/>  <meta property="og:image:width" content="150" />--}}
{{--  <meta property="og:image:height" content="150" />--}}
{{--  @endif--}}
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
              <h3>{{ $post->subtitle }}</h3>
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
{{--              <div class="dots-bottom">--}}
{{--                @include('public.vendor.addthis')--}}
{{--              </div>--}}
              <div class="dots-bottom">
                <p>
                  Submitted by:<br>
                  @if($idea)
                    @if($idea->use_other_source && $idea->other_source)
                      {{$idea->other_source}}
                    @else
                      {{$idea->contributor_first}} {{$idea->contributor_last}}
                    @endif
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
{{--  <div id="more-stories-bar">--}}
{{--      @include('public.components.sideblock', ['storytype'=> 'story', 'sideitems' => $sideStoryBlurbs])--}}
{{--  </div>--}}
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
