@extends('public.layouts.global')
@section('content')
{{-- emu-today hub page --}}
<div id="content-area">
  @if($page)
  <div id="news-bar">
    <div class="row">
      <div class="large-7 medium-12 small-12 columns">
        <img src="/imagecache/original/{{$heroImg->filename}}" alt="featured image">
      </div>
      <div id="featured-text" class="large-5 medium-12 small-12 columns">
        <h3>{{$heroImg->title}}</h3>
        <p>{!! $heroImg->teaser !!}</p>
        @if($heroImg->story->tags()->first() && $heroImg->link)
          @if($heroImg->story->tags()->first()->name == 'video')
            <p class="button-group"><a href="{{ (substr($heroImg->link, 0, 4) == 'http') ? $heroImg->link : 'https://'.$heroImg->link }}" aira-label="{{$heroImg->caption}} - {{$heroImg->moretext}}" class="button readmore">{{$heroImg->moretext}}&nbsp;<i class="fa fa-video-camera"></i></a></p>
          @elseif($heroImg->story->tags()->first()->name == 'audio')
            <p class="button-group"><a href="{{ (substr($heroImg->link, 0, 4) == 'http') ? $heroImg->link : 'https://'.$heroImg->link }}" aira-label="{{$heroImg->caption}} - {{$heroImg->moretext}}" class="button readmore">{{$heroImg->moretext}}&nbsp;<i class="fa fa-headphones"></i></a></p>
          @elseif($heroImg->story->tags()->first()->name == 'external')
            <p class="button-group"><a href="{{ (substr($heroImg->link, 0, 4) == 'http') ? $heroImg->link : 'https://'.$heroImg->link }}" aira-label="{{$heroImg->caption}} - {{$heroImg->moretext}}" class="button readmore">{{$heroImg->moretext}}&nbsp;<i class="fa fa-external-link"></i></a></p>
          @else
            <p class="button-group"><a href="/story/{{$heroImg->story->story_folder}}/{{$heroImg->story->id}}" aira-label="{{$heroImg->caption}} - {{$heroImg->moretext}}" class="button readmore">{{$heroImg->moretext}}</a></p>
          @endif
        @else
          <p class="button-group"><a href="/story/{{$heroImg->story->story_folder}}/{{$heroImg->story->id}}" aira-label="{{$heroImg->caption}} - {{$heroImg->moretext}}" class="button readmore">{{$heroImg->moretext}}</a></p>
        @endif
      </div>
    </div>
  </div>
  <div id="four-stories-bar">
    <div id="news-title-bar" class="row">
      <div class="large-12 medium-12 small-12 columns">
        <h5 class="subhead-title">Featured Stories</h5>
      </div>
    </div>
    <div class="row small-up-2 medium-up-2 large-up-4" data-equalizer>
      @for ($i = 1; $i <= count($barImgs); $i++)
      <div class="column four-stories-block">
        <img class="topic-image" src="/imagecache/original/{{$barImgs[$i]->filename}}" alt="story image">
        <div class="stories-content">
          <div class="stories-text-content" data-equalizer-watch>
            <p>{{$barImgs[$i]->caption}}</p>
          </div>
          <p class="button-group">
            @if($barImgs[$i]->story->story_type == 'external')
              @if($barImgs[$i]->story->tags()->first())
                  @if($barImgs[$i]->story->tags()->first()->name == 'video')
                    <a href="{{$barImgs[$i]->link}}" aria-label="{{$barImgs[$i]->caption}} - Watch" class="button readmore">Watch&nbsp;<i class="fa fa-video-camera"></i></a>
                  @elseif($barImgs[$i]->story->tags()->first()->name == 'audio')
                    <a href="{{$barImgs[$i]->link}}" aria-label="{{$barImgs[$i]->caption}} - Listen" class="button readmore">Listen&nbsp;<i class="fa fa-headphones"></i></a>
                  @elseif($barImgs[$i]->story->tags()->first()->name == 'gallery')
                    <a href="{{$barImgs[$i]->link}}" aria-label="{{$barImgs[$i]->caption}} - Gallery" class="button readmore">View Gallery&nbsp;<i class="fa fa-camera-retro"></i></a>
                  @else
                    @if($barImgs[$i]->moretext != "")
                      <a href="{{$barImgs[$i]->link}}" aria-label="{{$barImgs[$i]->caption}} - {{$barImgs[$i]->moretext}}" class="button readmore">{{$barImgs[$i]->moretext}}&nbsp;<i class="fa fa-external-link"></i></a>
                    @else
                      <a href="{{$barImgs[$i]->link}}" aria-label="{{$barImgs[$i]->caption}} - Read Story" class="button readmore">Read Story&nbsp;<i class="fa fa-external-link"></i></a>
                    @endif
                  @endif
              @else
                  @if($barImgs[$i]->moretext != "")
                    <a href="{{$barImgs[$i]->link}}" aria-label="{{$barImgs[$i]->caption}} - {{$barImgs[$i]->moretext}}" class="button readmore">{{$barImgs[$i]->moretext}}&nbsp;<i class="fa fa-external-link"></i></a>
                  @else
                    <a href="{{$barImgs[$i]->link}}" aria-label="{{$barImgs[$i]->caption}} - Read Story" class="button readmore">Read Story&nbsp;<i class="fa fa-external-link"></i></a>
                  @endif
              @endif
            @else
                <a href="/story/{{$barImgs[$i]->story->story_type}}/{{$barImgs[$i]->story->id}}" aria-label="{{$barImgs[$i]->caption}} - {{$barImgs[$i]->moretext}}" class="button readmore">{{$barImgs[$i]->moretext}}</a>
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
      <div class="large-9 medium-8 small-12 columns">
        <ul class="tabs" data-tabs id="newshub-tabs">
          <li class="tabs-title is-active"><a href="#newshub-announcements-front" aria-selected="true"><p class="subhead-title">Announcements</p></a></li>
          <li class="tabs-title"><a href="#newshub-headlines-front"><p class="subhead-title">News Headlines</p></a></li>

        </ul>
        <div class="tabs-content" data-tabs-content="newshub-tabs">
          <div class="tabs-panel newshub-tab-front is-active" id="newshub-announcements-front">
              <div class="row">
                  @if($topAnnouncement)
                  <div class="large-6 medium-12 small-12 large-push-6 columns">
                      <article id="special-notice-container">
                          <h3>Special Notice</h3>
                          <p id="special-notice-title"><a href="/announcement/{{$topAnnouncement->id}}">{{ $topAnnouncement->title }}</a></p>
                          <p id="special-notice-teaser"><a href="/announcement/{{$topAnnouncement->id}}">{{ str_limit($topAnnouncement->announcement, $limit = 95, $end = '...') }}</a></p>
                      </article>
                  </div>
                  <div class="large-6 medium-12 small-12 large-pull-6 columns">
                    <ul>
                      @foreach ($currentAnnouncements as $announcement)
                      <li><a href="/announcement/{{$announcement->id}}">{{$announcement->title}}</a></li>
                      @endforeach
                      <li><a href="/announcement" class="bottom-tab-link">More Announcements</a></li>
                    </ul>
                  </div>
                  @else
                  <div class="large-12 medium-12 small-12 columns">
                    <ul>
                      @foreach ($currentAnnouncements as $announcement)
                      <li><a href="/announcement/{{$announcement->id}}">{{$announcement->title}}</a></li>
                      @endforeach
                      <li><a href="/announcement" class="bottom-tab-link">More Announcements</a></li>
                    </ul>
                  </div>
                  @endif
              </div>
          </div>
          <div class="tabs-panel newshub-tab-front" id="newshub-headlines-front">
            <ul>
              @foreach ($currentStorysBasic as $basicstory)
              <li>
                @if($basicstory->story_type == 'advisory')
                  <a href="/story/advisory/{{$basicstory->id}}" class="advisory-link">{{$basicstory->title}}</a>
                @elseif($basicstory->story_type == 'statement')
                  <a href="/story/statement/{{$basicstory->id}}" class="statement-link">{{$basicstory->title}}</a>
                @else
                  <a href="/story/news/{{$basicstory->id}}">{{$basicstory->title}}</a>
                @endif
              </li>
              @endforeach
              <li><a href="/story/news" class="bottom-tab-link">More Headlines</a></li>
            </ul>
          </div>

        </div>
      </div>
      <div class="large-3 medium-4 small-12 columns">
        <div class="featured-content-block">
          <h6 class="headline-block">Featured video</h6>
          @if(isset($currentStoryImageWithVideoTag))
          <a class="popup-youtube" href="{{$currentStoryImageWithVideoTag->link}}">
                <img src="/imagecache/original/{{$currentStoryImageWithVideoTag->filename}}" alt="featured video" style="display: block;" />
          </a>
          <p><a class="popup-youtube" href="{{$currentStoryImageWithVideoTag->link}}" target="blank">{{$currentStoryImageWithVideoTag->caption}}</a></p>
          @else
          <a href="https://www.youtube.com/user/emichigan08" target="blank"><img src="/assets/imgs/placeholder/external_video.jpg" alt="featured video"></a>
          <p><a href="https://www.youtube.com/user/emichigan08" target="blank">Welcome to Education First, the official Eastern Michigan University YouTube Channel.</a></p>
          @endif

        </div>
      </div>

    </div>
  </div>
</div>
<div id="active-bar">
  <div id="containingbox" class="row">
    <!--Calendar-->
    <div id="calendar-info" class="large-4 medium-6 small-12 columns">
      <div class="row">
        <div class="large-12 medium-12 small-12 columns">
          <h5 class="subhead-title">Events Calendar</h5>
        </div>
      </div>
      <div id="newshub-calendar-front">
        <ul class="calendar-event-group">
          @foreach ($events as $event)
          <li class="row calendar-unit">
            <div class="large-2 medium-2 small-2 columns nopadding date-box">
              <p>{{$event->present()->eventStartDateMonth}}</p>
              <p>{{$event->present()->eventStartDateDay}}</p>
            </div>
            <div class="large-10 medium-10 small-10 columns">
              <p class="datecontent-box"><a href="/calendar/{{$event->present()->eventStartDateYear}}/{{$event->present()->eventStartDateMonthUnit}}/{{$event->present()->eventStartDateDay}}/{{$event->id}}">{{$event->title}}</a></p>
            </div>
          </li>
          @endforeach
        </ul>
        <p><a href="/calendar/">More Events</a></p>
      </div>
    </div>

    <!--Twitter-->
    <div id="twitter-info" class="large-5 medium-6 small-12 columns">
      <div class="row">
        <div class="large-12 medium-12 small-12 columns">
          <h5 class="subhead-title">Twitter</h5>
        </div>
      </div>
      <div class="twitter-feed">
        <ul class="twitter-content">
          @unless(empty($tweets))
            @foreach($tweets as $tweet)
            <li><a href="https://twitter.com/{{ $tweet['user']['screen_name'] }}/status/{{ $tweet['id'] }}">{{ '@' . $tweet['user']['screen_name'] }}</a> <?=$tweet['text'];?></li>
            @endforeach
          @endunless
        </ul>
        <div class="twitterlink">
          <p><a href="http://emich.edu/twitter">See all EMU Twitter Feeds</a></p>
        </div>
      </div>
    </div>
    <!--Working at EMU-->
    <div id="working-info" class="large-3 medium-12 small-12 columns">
      @unless(empty($currentHRAnnouncements[0]))
      <div class="featured-content-block">
        <h6 class="headline-block">Working @ EMU</h6>
        <ul class="feature-list">
          @foreach($currentHRAnnouncements as $currentHRAnnouncement)
          <li><a href="{{ (substr($currentHRAnnouncement->link, 0, 4) == 'http') ? $currentHRAnnouncement->link : 'https://'.$currentHRAnnouncement->link }}">{{$currentHRAnnouncement->title}}</a></li>
          @endforeach
        </ul>
      </div>
      <div class="working-link">
        <p><a href="http://www.emich.edu/hr">Visit Human Resources</a></p>
      </div>
      @endunless
    </div>
  </div>
</div>
</div>
@endsection
