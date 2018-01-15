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
        <!-- Story Page Title group -->
        <div id="title-grouping" class="row">
          <div class="large-5 medium-4 small-6 columns">{{-- <h3 class="news-caps">@if($story->story_type == 'advisory') Media Advisory @else {{ $story->story_type }} @endif</h3> --}}</div>
          <div class="large-2 medium-4 small-6 columns">
            <p class="story-publish-date">{{ Carbon\Carbon::parse($story->present()->publishedDate)->format('F d, Y') }}</p>
          </div>
          <div class="large-5 medium-4 hide-for-small columns">
            <p class="small-return-news"><a href="/story/news">News Home</a></p>
          </div>
        </div>
        <!-- Story Page Content -->
        <div id="story-content" class="row">
          <!-- Story Content Column -->
          <div class="large-9 medium-8 small-12 columns">
            <h3>@if($story->story_type == 'featurephoto')Featured Photo: @endif{{ $story->title }}</h3>
            <h5>{{ $story->subtitle }}</h5>
            @include('public.vendor.addthis')
          @if(isset($mainStoryImage))
            <div id="big-feature-image">
              <img src="{{$mainStoryImage->present()->mainImageURL }}" alt="feature-image"></a>

              <div class="feature-image-caption">{{ $mainStoryImage->caption }}</div>
            </div>
          @endif
            <div id="story-content-edit">
              {!! $story->content !!}
            </div>
            @if($story->author_id === 0)
              @unless($story->author_info)
                <div class="story-author">{{$story->user->first_name}} {{$story->user->last_name}}</div>
              @else
                <div class="story-author">{{$story->author_info}}</div>
              @endif
            @else
                <div class="story-author">{{ $story->author->first_name }} {{ $story->author->last_name }}</div>
            @endif
            <p class="news-contacts">Contact {{ $story->contact->first_name }} {{ $story->contact->last_name }}, {{ $story->contact->email }}{{ empty($story->contact->phone) ? '': ', ' . $story->contact->phone }}</p>

          </div>
          <!-- Page Side Bar Column -->
          <div class="large-3 medium-4 small-12 columns featurepadding">
            @include('public.components.sideblock', ['sidetitle' => 'Featured Stories','storytype'=> 'story', 'sideitems' => $sideStoryBlurbs])
            @if(isset($sideStudentBlurbs))
                @include('public.components.sideblock', ['sidetitle' => "<span class='truemu'>EMU</span> student profiles",'storytype'=> 'student', 'sideitems' => $sideStudentBlurbs])
            @endif
        </div>


        </div>
      </div>

    </div>
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
