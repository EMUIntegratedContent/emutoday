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
        @if(Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $story->start_date) < Carbon\Carbon::now())
          <!-- Story Page Title group -->
          <div id="title-grouping" class="row">
            <div class="small-12 columns">
              <h3>Featured Photo: {{ $story->title }}</h3>
              <h5>{{ $story->subtitle }}</h5>
            </div>
          </div>
          <!-- Story Page Content -->
          <div id="story-content" class="row">
            <!-- Story Content Column -->
            <div class="large-10 large-push-2 medium-9 medium-push-3 small-12 columns">
            @if(isset($mainStoryImage))
              <div id="big-feature-image">
                <img src="{{$mainStoryImage->present()->mainImageURL }}" alt="feature-image"></a>

                <div class="feature-image-caption">{{ $mainStoryImage->caption }}</div>
              </div>
            @endif
              <div id="story-content-edit">
                {!! $story->content !!}
              </div>
            </div>
            <!-- Page Side Bar Column -->
            <div class="large-2 large-pull-10 medium-3 medium-pull-9 small-12 columns" id="story-sidebar">
              <div class="dots-bottom">
                @include('public.vendor.addthis')
                <p class="story-publish-date">{{ Carbon\Carbon::parse($story->present()->publishedDate)->format('F d, Y') }}</p>
              </div>
              <div class="dots-bottom">
                <p>
                  Photo {{ $story->photo_credit }}
                </p>
              </div>
              {{--
              @include('public.components.sideblock', ['sidetitle' => 'Featured Stories','storytype'=> 'story', 'sideitems' => $sideStoryBlurbs])
              @if(isset($sideStudentBlurbs))
                  @include('public.components.sideblock', ['sidetitle' => "<span class='truemu'>EMU</span> student profiles",'storytype'=> 'student', 'sideitems' => $sideStudentBlurbs])
              @endif
              --}}
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
  </div>s
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
