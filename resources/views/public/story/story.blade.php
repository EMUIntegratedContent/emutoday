@extends('public.layouts.global')
@section('title'){{ $story->title }} @stop

@section('addthisMeta')
<meta property="og:title" content="{{$story->title}}" />
<meta property="og:description" content="{{$story->subtitle}}" />
  @if(isset($mainStoryImage))
  <meta property="og:image" content="http://today.emich.edu{{$mainStoryImage->present()->mainImageURL}}"/>
  <meta property="og:image:secure_url" content="https://today.emich.edu{{$mainStoryImage->present()->mainImageURL}}"/>
  <meta property="og:image:type" content="image" />
  <meta property="og:image:width" content="800" />
  <meta property="og:image:height" content="300" />
  @endif
@endsection

@section('content')
  <div id="news-story-bar">
    <div class="row">
      <div class="large-12 medium-12 small-12 columns">
        <!-- Story Page Title group -->
        <div id="title-grouping" class="row">
          <div class="large-5 medium-4 small-6 columns"><h3 class="news-caps">News</h3></div>
          <div class="large-2 medium-4 small-6 columns">
            <p class="story-publish-date">{{ $story->present()->publishedDate }}</p>
          </div>
          <div class="large-5 medium-4 hide-for-small columns">
            <p class="small-return-news"><a href="/story/news">News Home</a></p>
          </div>
        </div>
        <!-- Story Page Content -->
        <div id="story-content" class="row">
          <!-- Story Content Column -->
          <div class="large-9 medium-8 small-12 columns">
              @include('public.vendor.addthis')
            <h3>{{ $story->title }}</h3>
            <h5>{{ $story->subtitle }}</h5>
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
                <div class="story-author">{{$story->user->first_name}} {{$story->user->last_name}}</div>
                <!--<p class="news-contacts">Contact {{ $story->user->full_name }}, {{ $story->user->email }}{{ empty($story->user->phone) ?'': ', ' . $story->user->phone  }}</p>-->
            @else
                <div class="story-author">{{ $story->author->first_name }} {{ $story->author->last_name }}</div>
                <p class="news-contacts">Contact {{ $story->contact->first_name }} {{ $story->contact->last_name }}, {{ $story->contact->email }}{{ empty($story->contact->phone) ? '': ', ' . $story->author->phone }}</p>
            @endif

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
