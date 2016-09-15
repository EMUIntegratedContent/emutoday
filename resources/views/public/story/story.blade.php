<!-- Main Story Page -->
@extends('public.layouts.global')
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
            <p class="small-return-news"><a href="/emu-today/news">News Home</a></p>
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
                <p class="news-contacts">Contact {{ $story->user->full_name }}, {{ $story->user->email }}{{ empty($story->user->phone) ?'': ', ' . $story->user->phone  }}</p>
            @else
                <div class="story-author">{{ $story->author->first_name }} {{ $story->author->last_name }}</div>
                <p class="news-contacts">Contact {{ $story->author->full_name }}, {{ $story->author->email }}{{ empty($story->author->phone) ? '': ', ' . $story->author->phone }}</p>
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
