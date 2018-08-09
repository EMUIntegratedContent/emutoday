@extends('public.layouts.global')
@section('title'){{ $story->title }} @stop

@section('addthisMeta')
<meta property="og:type" content="website" />
<meta property="og:url" content="{{trim(Request::fullUrl())}}" />
@if($story->story_type == 'news' && $addThisImage)
  @if($addThisImage->title)
  <meta property="og:title" content="{{$addThisImage->title}}" />
  @else
  <meta property="og:title" content="{{trim($story->title)}}" />
  @endif
@else
  <meta property="og:title" content="{{trim($story->title)}}" />
@endif
<meta property="og:description" content="{{trim($story->subtitle)}}" />
  @if($story->story_type == 'news' && $addThisImage)
  <meta property="og:image" content="http://{{trim(Request::server('SERVER_NAME'))}}{{trim($addThisImage->present()->mainImageURL)}}"/>
  <meta property="og:image:secure_url" content="https://{{trim(Request::server('SERVER_NAME'))}}{{trim($addThisImage->present()->mainImageURL)}}"/>
  <meta property="og:image:width" content="400" />
  <meta property="og:image:height" content="300" />
  @elseif($mainStoryImage)
  <meta property="og:image" content="http://{{trim(Request::server('SERVER_NAME'))}}{{trim($mainStoryImage->present()->mainImageURL)}}"/>
  <meta property="og:image:secure_url" content="https://{{trim(Request::server('SERVER_NAME'))}}{{trim($mainStoryImage->present()->mainImageURL)}}"/>
  <meta property="og:image:width" content="400" />
  <meta property="og:image:height" content="300" />
  @else
  <meta property="og:image" content="http://www.emich.edu/communications/images/logos/blockegreenwithtm.jpg"/>
  <meta property="og:image:secure_url" content="https://www.emich.edu/communications/images/logos/blockegreenwithtm.jpg"/>
  <meta property="og:image:width" content="150" />
  <meta property="og:image:height" content="150" />
  @endif
@endsection

@section('content')
  <div id="news-story-bar">
    <div class="row">
      <div class="large-12 medium-12 small-12 columns">
        <!-- DO NOT SHOW ARTICLES WHOSE START DATE/TIME HAS NOT ARRIVED -->
        @if(Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $story->start_date) < Carbon\Carbon::now())
          <!-- Story Page Title group -->
          <div id="title-grouping" class="row">
            <div class="small-12 columns">
              <h3>{{ $story->title }}</h3>
              <h5>{{ $story->subtitle }}</h5>
            </div>
            <!-- Full banner image area (displays only if it exists for this story) -->
            @if($fullBannerImage)
                <div class="small-12 columns">
                    <div id="full-banner-image">
                      <img src="{{$fullBannerImage->present()->mainImageURL }}" alt="{{ $fullBannerImage->alt_text != '' ? $fullBannerImage->alt_text : str_replace('"', "", $story->title) }}"></a>
                      <div class="feature-image-caption">{{ $fullBannerImage->teaser }}</div>
                    </div>
                </div>
            @endif
          </div>
          <!-- Story Page Content -->
          <div id="story-content" class="row">
            <!-- Story Content Column -->
            <div class="large-9 large-push-3 medium-9 medium-push-3 small-12 columns">
              @if(isset($mainStoryImage) && !isset($fullBannerImage))
                <div id="big-feature-image">
                  <img src="{{$mainStoryImage->present()->mainImageURL }}" alt="{{ $mainStoryImage->alt_text != '' ? $mainStoryImage->alt_text : str_replace('"', "", $story->title) }}"></a>
                  <div class="feature-image-caption">{{ $mainStoryImage->caption }}</div>
                </div>
              @endif
              <div id="story-content-edit">
                {!! $story->content !!}
              </div>
            </div>
            <!-- Page Side Bar Column -->
            <div class="large-3 large-pull-9 medium-3 medium-pull-9 small-12 columns" id="story-sidebar">
              <div class="dots-bottom">
                @include('public.vendor.addthis')
                <p class="story-publish-date">{{ Carbon\Carbon::parse($story->present()->publishedDate)->format('F d, Y') }}</p>
              </div>
              <div class="dots-bottom">
                <p>
                  Written by:<br>
                  @if($story->author_id === 0)
                    @unless($story->author_info)
                      {{$story->user->first_name}} {{$story->user->last_name}}
                    @else
                      {{$story->author_info}}
                    @endif
                  @else
                      {{ $story->author->first_name }} {{ $story->author->last_name }}
                  @endif
                </p>
              </div>
              <div class="dots-bottom">
                <p>
                  Contact:<br>
                  {{ $story->contact->first_name }} {{ $story->contact->last_name }}<br>
                  <a href="mailto:{{ $story->contact->email }}">{{ $story->contact->email }}</a><br>
                  {{ empty($story->contact->phone) ? '': $story->contact->phone }}
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
      @include('public.components.sideblock', ['storytype'=> 'story', 'sideitems' => $sideStoryBlurbs])
      {{--
      @if(isset($sideStudentBlurbs))
          @include('public.components.sideblock', ['sidetitle' => "<span class='truemu'>EMU</span> student profiles",'storytype'=> 'student', 'sideitems' => $sideStudentBlurbs])
      @endif
      --}}
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
