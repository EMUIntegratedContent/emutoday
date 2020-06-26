{{-- Magazine Index Page --}}
@extends('public.layouts.global')
@section('offcanvaslist')
    @include('public.magazine.partials.offcanvaslist')
@endsection
  @section('connectionbar')
    @include('public.magazine.partials.connectionbar')
  @endsection

@section('magazine-title'){{$magazine->season}} {{$magazine->year}} @stop
@section('content')
  <div id="content-area">
    <div id="news-story-bar" class="magazine-story">

          <div id="story-content" class="row">
            <div class="large-9 medium-8 small-12 columns">
              <div id="issue-grouping" class="row">
                <div class="large-8 medium-8 small-12 columns">
                    <h2 class="issue-date news-caps">{{$magazine->season}} {{$magazine->year}}</h2></div>
                <div class="large-4 medium-4 small-12 columns">
                  <div class="addthis magazine-top"><a href="#"><img src="/assets/imgs/icons/fake-addthis.png" alt="addthis "></a></div>
                </div>
              </div> <!-- issue-grouping -->
              <div id="story-listing">
                  @foreach ($barImgs as $barImg)
                        <a class="magazine-article-button"
                                @if($barImg->story->tags()->first())
                                    @if($barImg->story->tags()->first()->name == 'external')
                                      href="{{$barImg->link}}"
                                    @else
                                      href="/magazine/article/{{$barImg->story->id}}"
                                    @endif
                                @else
                                  href="/magazine/article/{{$barImg->story->id}}"
                                @endif
                                >
                        <div class="article-listing row">
                            <div class="article-img small-12 medium-5 large-3 columns">
                                <img src="/imagecache/original/{{$barImg->filename}}">
                            </div>
                            <div class="article-text-teaser small-12 medium-7 large-9 columns">
                                <h3>{{$barImg->title}}</h3>
                                <p>{{$barImg->teaser}}</p>
                            </div>
                        </div>
                    </a>
                @endforeach
              </div> <!-- story-listing -->
            </div>
            <div class="large-3 medium-4 small-12 columns current-issue-padding">
              <div class="current-issue-info">
                <p><img src="/imagecache/magazinecover/{{$magazineCover->filename}}"></p>
                <p><a href="{{$magazineCover->link}}">{{$magazineCover->link_text}}</a></p>
              </div>
              <a class="button magazine-button expanded" href="mailto:dgiffor2@emich.edu">Subscribe</a>
              <a class="button magazine-button expanded" href="mailto:dgiffor2@emich.edu">Submit a Story Idea</a>
                        </div>
                    </div>

    </div> <!-- news-story-bar -->

  </div>   <!--end content area-->
@endsection
