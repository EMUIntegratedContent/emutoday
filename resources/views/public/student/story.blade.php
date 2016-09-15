<!-- Main Student Page -->
@extends('public.layouts.global')
@section('content')
  <div id="news-story-bar">
    <div class="row">
      <div class="large-12 medium-12 small-12 columns">
        <!-- Story Page Title group -->
        <div id="title-grouping" class="row">
          <div class="large-7 medium-7 small-6 columns">
            <h3 class="news-caps"><span class="truemu">EMU</span> Student Profiles</h3>

          </div>
          <div class="large-2 medium-3 small-6 columns">
            <p class="story-publish-date">{{ $story->present()->publishedDate }}</p>
          </div>
          <div class="large-3 medium-2 show-for-medium columns">&nbsp;</div>
        </div>
        <!-- Story Page Content -->
        <div id="story-content" class="row">
          <!-- Story Content Column -->
          <div class="large-9 medium-8 small-12 columns">
              @include('public.vendor.addthis')

            <h3>{{ $story->title }}</h3>
            <h5>{{ $story->subtitle }}</h5>
            <div id="big-feature-image">
              <img src="{{$mainStoryImage->present()->mainImageURL }}" alt="feature-image"></a>

              <div class="feature-image-caption">{{ $mainStoryImage->caption }}</div>
            </div>
            <div id="story-content-edit">
              {!! $story->content !!}
            </div>
            <div class="story-author">{{ $story->user->name }}</div>
            <p class="news-contacts">Contact {{ $story->user->email }}</p>
          </div>
          <!-- Page Side Bar Column -->
          <div class="large-3 medium-4 small-12 columns featurepadding">
            @if(isset($sideStudentBlurbs))
                @include('public.components.sideblock', ['sidetitle' => "<span class='truemu'>EMU</span> student profiles",'storytype'=> 'student', 'sideitems' => $sideStudentBlurbs])
            @endif
            @include('public.components.sideblock', ['sidetitle' => 'Featured Stories','storytype'=> 'story', 'sideitems' => $sideStoryBlurbs])

          </div>


        </div>
      </div>

    </div>
  </div>

@endsection

@section('footer')
  @parent

  @endsection
