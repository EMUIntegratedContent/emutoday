{{-- emu-today preview hub page --}}
@extends('public.layouts.global')
@section('styles')
  @parent
  @include('preview.includes.previewcoverstyle')
@endsection
@section('bodytop')
  @include('preview.includes.previewcover')
@endsection
@section('offcanvaslist')
  @include('preview.includes.offcanvaslist')
@endsection
@section('connectionbar')
  @include('preview.includes.connectionbar')
@endsection
@section('content')
  {{-- emu-today hub page --}}
  <div id="content-area">
    @if($page)
      <div id="news-bar">
        <div class="row">
          <div class="large-7 medium-12 small-12 columns">
            @if($heroImg)
              <img src="/imagecache/original/{{$heroImg->filename}}"
                   alt="{{ $heroImg->alt_text != '' ? $heroImg->alt_text : str_replace('"', "", $heroImg->title) }}">
            @endif
          </div>
          <div id="featured-text" class="large-5 medium-12 small-12 columns">
            @if($heroImg)
              <h3>{{$heroImg->title}}</h3>
              <p>{!! $heroImg->teaser !!}</p>
              @if($heroImg->story->tags()->first() && $heroImg->link)
                @if($heroImg->story->tags()->first()->name == 'video')
                  <p class="button-group"><a
                        href="{{ (substr($heroImg->link, 0, 4) == 'http') ? $heroImg->link : 'https://'.$heroImg->link }}"
                        aira-label="{{$heroImg->caption}} - {{$heroImg->moretext}}"
                        class="button readmore bold-green-link">{{$heroImg->moretext}}</a></p>
                @elseif($heroImg->story->tags()->first()->name == 'audio')
                  <p class="button-group"><a
                        href="{{ (substr($heroImg->link, 0, 4) == 'http') ? $heroImg->link : 'https://'.$heroImg->link }}"
                        aira-label="{{$heroImg->caption}} - {{$heroImg->moretext}}"
                        class="button readmore bold-green-link">{{$heroImg->moretext}}</a></p>
                @elseif($heroImg->story->tags()->first()->name == 'external')
                  <p class="button-group"><a
                        href="{{ (substr($heroImg->link, 0, 4) == 'http') ? $heroImg->link : 'https://'.$heroImg->link }}"
                        aira-label="{{$heroImg->caption}} - {{$heroImg->moretext}}"
                        class="button readmore bold-green-link">{{$heroImg->moretext}}</a></p>
                @else
                  <p class="button-group"><a
                        href="/story/{{$heroImg->story->story_folder}}/{{$heroImg->story->id}}"
                        aira-label="{{$heroImg->caption}} - {{$heroImg->moretext}}"
                        class="button readmore bold-green-link">{{$heroImg->moretext}}</a></p>
                @endif
              @else
                <p class="button-group"><a
                      href="/story/{{$heroImg->story->story_folder}}/{{$heroImg->story->id}}"
                      aira-label="{{$heroImg->caption}} - {{$heroImg->moretext}}"
                      class="button readmore bold-green-link">{{$heroImg->moretext}}</a></p>
              @endif
            @endif
          </div>
        </div>
      </div>
      <div id="four-stories-bar">
        <div class="row">
          <div class="large-12 medium-12 small-12 columns">
            <h5 class="subhead-title">Featured Stories</h5>
          </div>
        </div>
        <div id="four-stories-container" class="row small-up-2 medium-up-2 large-up-4" data-equalizer>
          @for ($i = 1; $i <= count($barImgs); $i++)
            <div class="column four-stories-block">
              <img class="topic-image" src="/imagecache/original/{{$barImgs[$i]->filename}}"
                   alt="{{ $barImgs[$i]->alt_text != '' ? $barImgs[$i]->alt_text : str_replace('"', "", $barImgs[$i]->caption) }}">
              <div class="stories-content">
                <div class="stories-text-content" data-equalizer-watch>
                  <p>{{$barImgs[$i]->caption}}</p>
                </div>
                <p class="link-group">
                  @if($barImgs[$i]->story->story_type == 'external')
                    @if($barImgs[$i]->story->tags()->first())
                      @if($barImgs[$i]->story->tags()->first()->name == 'video')
                        <a href="{{$barImgs[$i]->link}}"
                           aria-label="{{$barImgs[$i]->caption}} - Watch"
                           class="readmore bold-green-link">Watch&nbsp;</a>
                      @elseif($barImgs[$i]->story->tags()->first()->name == 'audio')
                        <a href="{{$barImgs[$i]->link}}"
                           aria-label="{{$barImgs[$i]->caption}} - Listen"
                           class="readmore bold-green-link">Listen&nbsp;</a>
                      @elseif($barImgs[$i]->story->tags()->first()->name == 'gallery')
                        <a href="{{$barImgs[$i]->link}}"
                           aria-label="{{$barImgs[$i]->caption}} - Gallery" class="readmore bold-green-link">View
                          Gallery&nbsp;</a>
                      @else
                        @if($barImgs[$i]->moretext != "")
                          <a href="{{$barImgs[$i]->link}}"
                             aria-label="{{$barImgs[$i]->caption}} - {{$barImgs[$i]->moretext}}"
                             class="readmore bold-green-link">{{$barImgs[$i]->moretext}}&nbsp;</a>
                        @else
                          <a href="{{$barImgs[$i]->link}}"
                             aria-label="{{$barImgs[$i]->caption}} - Read Story"
                             class="readmore bold-green-link">Read Story&nbsp;</a>
                        @endif
                      @endif
                    @else
                      @if($barImgs[$i]->moretext != "")
                        <a href="{{$barImgs[$i]->link}}"
                           aria-label="{{$barImgs[$i]->caption}} - {{$barImgs[$i]->moretext}}"
                           class="readmore bold-green-link">{{$barImgs[$i]->moretext}}&nbsp;</a>
                      @else
                        <a href="{{$barImgs[$i]->link}}"
                           aria-label="{{$barImgs[$i]->caption}} - Read Story" class="readmore bold-green-link">Read
                          Story&nbsp;</a>
                      @endif
                    @endif
                  @elseif($barImgs[$i]->story->story_type == 'article')
                    @if($barImgs[$i]->story->tags()->first())
                      @if($barImgs[$i]->story->tags()->first()->name == 'external')
                        <a href="{{$barImgs[$i]->link}}"
                           aria-label="{{$barImgs[$i]->caption}} - {{$barImgs[$i]->moretext}}"
                           class="readmore bold-green-link">{{$barImgs[$i]->moretext}}&nbsp;</a>
                      @else
                        <a href="/story/{{$barImgs[$i]->story->story_type}}/{{$barImgs[$i]->story->id}}"
                           aria-label="{{$barImgs[$i]->caption}} - {{$barImgs[$i]->moretext}}"
                           class="readmore bold-green-link">{{$barImgs[$i]->moretext}} </a>
                      @endif
                    @else
                      <a href="/story/{{$barImgs[$i]->story->story_type}}/{{$barImgs[$i]->story->id}}"
                         aria-label="{{$barImgs[$i]->caption}} - {{$barImgs[$i]->moretext}}"
                         class="readmore bold-green-link">{{$barImgs[$i]->moretext}} </a>
                    @endif
                  @elseif($barImgs[$i]->story->story_type == 'featurephoto')
                    <a href="/story/{{$barImgs[$i]->story->story_type}}/{{$barImgs[$i]->story->id}}"
                       aria-label="{{$barImgs[$i]->caption}} - View" class="readmore bold-green-link">More Information&nbsp;
                    </a>
                  @else
                    <a href="/story/{{$barImgs[$i]->story->story_type}}/{{$barImgs[$i]->story->id}}"
                       aria-label="{{$barImgs[$i]->caption}} - {{$barImgs[$i]->moretext}}"
                       class="readmore bold-green-link">{{$barImgs[$i]->moretext}} </a>
                  @endif
                </p>
              </div>
            </div>
          @endfor
        </div>
      </div>
    @endif
    <div id="news-headline-bar">
      <div class="row">
        <div class="large-12 medium-12 small-12 columns">
          <h3 class="subhead-title">What's Happening at EMU</h3>
        </div>
      </div>
      <div id="news-headline-bar-top" class="row" data-equalizer data-equalize-on="medium">
        <div class="card small-12 medium-6 large-3 columns" data-equalizer-watch>
          @if(isset($currentStoryImageWithVideoTag))
            <a class="popup-youtube" href="{{$currentStoryImageWithVideoTag->link}}">
              <img src="/imagecache/original/{{$currentStoryImageWithVideoTag->filename}}"
                   alt="{{ $currentStoryImageWithVideoTag->alt_text != '' ? $currentStoryImageWithVideoTag->alt_text : 'featured video' }}"
                   style="display: block;"/>
            </a>
          @else
            <a class="popup-youtube" href="https://www.youtube.com/user/emichigan08" target="blank"><img
                  src="/assets/imgs/placeholder/external_video.jpg" alt="featured video"></a>
          @endif
          <div class="card-section">
            @if(isset($currentStoryImageWithVideoTag))
              <p>{{$currentStoryImageWithVideoTag->caption}}</p>
              <a class="popup-youtube bold-green-link" title="External link to a YouTube video."
                 href="{{$currentStoryImageWithVideoTag->link}}" target="_blank">Watch Video</a>
            @else
              <p>Welcome to Education First, the official Eastern Michigan University YouTube Channel.</p>
              <a class="popup-youtube bold-green-link" title="External link to a YouTube video."
                 href="https://www.youtube.com/user/emichigan08" target="blank">Watch Video</a>
            @endif
          </div>
        </div>
        <div class="card small-12 medium-6 large-6 columns" data-equalizer-watch>
          <div class="card-section" data-equalizer-watch>
            <h4><a class="bold-green-link" title="EMU news, press releases, and official statements."
                   href="{{ url('/story/news') }}">News Headlines</a>
            </h4>
            <div class="row newshub-tab-front">
              <div class="large-12 medium-12 small-12 columns">
                <ul>
                  @foreach ($currentStorysBasic as $basicstory)
                    <li>
                      @if($basicstory->story_type == 'advisory')
                        <a href="/story/advisory/{{$basicstory->id}}"
                           class="advisory-link">{{$basicstory->title}}</a>
                      @elseif($basicstory->story_type == 'statement')
                        <a href="/story/statement/{{$basicstory->id}}"
                           class="statement-link">{{$basicstory->title}}</a>
                      @elseif($basicstory->story_type == 'external')
                        <a href="{{$basicstory->storyImages[0]->link}}"
                           class="external-link">{{$basicstory->title}}</a>
                      @else
                        <a href="/story/news/{{$basicstory->id}}">{{$basicstory->title}}</a>
                      @endif
                    </li>
                  @endforeach
                </ul>
              </div>
            </div>
          </div>
        </div><!-- end .card -->
        <div class="card small-12 medium-6 large-3 columns" data-equalizer-watch>
          <img src="/assets/imgs/placeholder/magazine-summer-2025.jpg"
               alt="The cover of the Summer 2025 issue of EMU Magazine">
          <div class="card-section">
            <p>Innovation with Intent: How EMU is solving problems, shaping futures, and delivering results that matter.</p>
            <a class="bold-green-link" title="External link to the issues of EMU Magazine."
               href="https://magazine.emich.edu/summer-2025/" target="blank">Read the latest issue</a>
          </div>
        </div>
      </div>
      <div id="news-headline-bar-middle" class="row" data-equalizer data-equalize-on="medium">
        @if($topAnnouncement)
          <div class="card small-12 medium-5 large-5 columns" data-equalizer-watch>
            @else
              <div class="card small-12 medium-7 large-7 columns" data-equalizer-watch>
                @endif
                <div class="card-section" id="insideemu-hub-container" data-equalizer-watch>
                  @if($topAnnouncement)
                    <div>
                      <h4><a class="bold-green-link" title="Inside EMU"
                             href="{{ url('/insideemu') }}">Inside EMU</a></h4>
                      @if($insideemu)
                        <p style="margin-top: 0.8rem">
                          <a href="{{ url('/insideemu/posts/' . $insideemu->id ) }}"
                             class="caption-link">{{ $insideemu->title }}</a>
                        </p>
                      @endif
                      <p style="font-weight: lighter; margin-bottom: 1.1rem">Go to our Inside EMU page to find other
                        user-submitted posts produced by staff and faculty across the University.</p>
                      <a class="round-white-btn" title="Link to Inside EMU posts."
                         href="{{ url('/insideemu') }}">Read More Posts</a>
                    </div>
                  @else
                    <div style="display: flex; align-items: flex-start;">
                      <div style="flex: 1; padding-right: .5rem">
                        <h4><a class="bold-green-link" title="Inside EMU"
                               href="{{ url('/insideemu') }}">Inside EMU</a></h4>
                        @if($insideemu)
                          <p><a href="{{ url('/insideemu/posts/' . $insideemu->id ) }}"
                                class="caption-link">{{ $insideemu->title }}</a></p>
                        @endif
                        <p style="font-weight: lighter">Go to our Inside EMU page to find other user-submitted posts
                          produced by staff and faculty across the University.</p>
                        <div style="display: flex; justify-content: center;">
                          <a class="round-white-btn" title="Link to Inside EMU posts."
                             href="{{ url('/insideemu') }}">Read More Stories</a>
                        </div>
                      </div>
                      @if($insideemu)
                        <img src="/imagecache/original/{{$insideemu->id}}/{{$insideemu->images[0]->image_name}}"
                             style="width: 290px; height: 175px"
                             alt="{{ $insideemu->images[0]->alt_text }}">
                      @endif
                    </div>
                  @endif
                </div>
              </div><!-- end .card -->
              @if($topAnnouncement)
                <div class="card small-12 medium-7 large-7 columns" data-equalizer-watch>
                  @else
                    <div class="card small-12 medium-5 large-5 columns" data-equalizer-watch>
                      @endif
                      <div class="card-section" data-equalizer-watch>
                        <h4><a class="bold-green-link" title="EMU Today campus announcements."
                               href="{{ url('/announcement') }}">Announcements</a></h4>
                        <div class="row newshub-tab-front">
                          @if($topAnnouncement)
                            <div class="large-6 medium-12 small-12 large-push-6 columns">
                              <article id="special-notice-container">
                                <h3>Special Notice</h3>
                                <p id="special-notice-title"><a
                                      href="/announcement/{{$topAnnouncement->id}}">{{ $topAnnouncement->title }}</a>
                                </p>
                                <p id="special-notice-teaser"><a
                                      href="/announcement/{{$topAnnouncement->id}}">{{ str_limit($topAnnouncement->announcement, $limit = 95, $end = '...') }}</a>
                                </p>
                              </article>
                            </div>
                            <div class="large-6 medium-12 small-12 large-pull-6 columns">
                              <ul>
                                @foreach ($currentAnnouncements as $announcement)
                                  <!-- priority of 1000000 is a special announcement and will appear in its own box -->
                                  @if($announcement->priority != 1000000)
                                    <li>
                                      <a href="/announcement/{{$announcement->id}}">{{$announcement->title}}</a>
                                    </li>
                                  @endif
                                @endforeach
                                <li><a href="/announcement" class="bottom-tab-link">More
                                    Announcements</a>
                                </li>
                              </ul>
                            </div>
                          @else
                            <div class="large-12 medium-12 small-12 columns">
                              <ul>
                                @foreach ($currentAnnouncements as $announcement)
                                  <li>
                                    <a href="/announcement/{{$announcement->id}}">{{$announcement->title}}</a>
                                  </li>
                                @endforeach
                              </ul>
                            </div>
                          @endif
                        </div>
                      </div>
                    </div><!-- end .card -->
                </div>
          </div>
      </div><!-- /end #content-area -->
      @endsection
      @section('scriptsfooter')
        @parent
        <script>
					$(function () {
					});


        </script>
@endsection
