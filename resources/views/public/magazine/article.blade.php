{{-- Magazine Article Page --}}
@extends('public.layouts.global')
@section('offcanvaslist')
    @include('public.magazine.partials.offcanvaslist')
@endsection
  @section('connectionbar')
    @include('public.magazine.partials.connectionbar')
  @endsection
@section('content')
      <div id="news-story-bar" class="magazine-story">
          <div id="story-content" class="row">
            <div class="large-9 medium-8 small-12 columns">
              <div id="issue-grouping" class="row">
                <div class="large-8 medium-8 small-12 columns">
                    @if(isset($magazine))
                  <a href="/magazine/{{$magazine->year}}"><h2 class="issue-date news-caps">{{$magazine->season}} {{$magazine->year}}</h2></a>
                    @endif
                </div>
                <div class="large-4 medium-4 small-12 columns noleftpadding">
                  <div class="addthis_sharing_toolbox"><a class="addthis magazine-top" width="50px"></a></div>
                  <!-- <div class="addthis magazine-top"><a href=""><img src="/assets/imgs/icons/fake-addthis.png" alt="addthis "></a></div> -->
                                </div>
              </div>
                            <div class="row">
                                <div class="large-8 medium-8 small-12 columns">
                                    <h3>{{ $story->title }}</h3>
                        <h5>{{ $story->subtitle }}</h5>
                                </div>
                            </div><!-- /.row -->
              <div id="big-feature-image">
                  <img src="{{$mainImage->present()->mainImageURL}}" alt="feature-image">
              </div>
              <!-- <div class="magazine-titlebar"><img src="/assets/imgs/graphic-title.png" alt="Lost Voices"></div> -->
              {!! $story->content !!}
              @if($story->author_id === 0)
                  <div class="story-author">{{$story->user->first_name}} {{$story->user->last_name}}</div>
                  <p class="news-contacts">Contact {{ $story->user->full_name }}, {{ $story->user->email }}{{ empty($story->user->phone) ?'': ', ' . $story->user->phone  }}</p>
              @else
                  <div class="story-author">{{ $story->author->first_name }} {{ $story->author->last_name }}</div>
                  <p class="news-contacts">Contact {{ $story->author->full_name }}, {{ $story->author->email }}{{ empty($story->author->phone) ? '': ', ' . $story->author->phone }}</p>
              @endif

            </div>
            <div class="large-3 medium-4 small-12 columns featurepadding">
              <div class="featured-content-block magazine-block">
                <h6 class="headline-block">Popular stories</h6>
                <ul class="feature-list">
                    @foreach ($sideStoryBlurbs as $ssblurb)
                  <li><a href="/{{$ssblurb->story->story_folder}}/{{$ssblurb->story->id}}">{{$ssblurb->caption}}</a></li>
                @endforeach
              </ul>
              </div>
              <div class="featured-content-block magazine-block">
                <h6 class="headline-block">Headlines</h6>
                <ul class="feature-list">
                  @foreach ($sideNewsStorys as $newsstory)
                <li><a href="/{{$newsstory->story_folder}}/{{$newsstory->id}}">{{$newsstory->title}}</a></li>
                @endforeach
                </ul>

              </div>
              <a class="button magazine-button expanded">Subscribe</a>
              <a class="button magazine-button expanded">Submit a Story Idea</a>


            </div>


          </div>
        </div>
@endsection
