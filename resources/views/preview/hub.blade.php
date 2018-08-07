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
                      <img src="/imagecache/original/{{$heroImg->filename}}" alt="{{ $heroImg->alt_text != '' ? $heroImg->alt_text : str_replace('"', "", $heroImg->title) }}">
                  </div>
                  <div id="featured-text" class="large-5 medium-12 small-12 columns">
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
                                                 aria-label="{{$barImgs[$i]->caption}} - Watch" class="readmore bold-green-link">Watch&nbsp;<i
                                                          class="fa fa-arrow-right"></i></a>
                                          @elseif($barImgs[$i]->story->tags()->first()->name == 'audio')
                                              <a href="{{$barImgs[$i]->link}}"
                                                 aria-label="{{$barImgs[$i]->caption}} - Listen" class="readmore bold-green-link">Listen&nbsp;<i
                                                          class="fa fa-arrow-right"></i></a>
                                          @elseif($barImgs[$i]->story->tags()->first()->name == 'gallery')
                                              <a href="{{$barImgs[$i]->link}}"
                                                 aria-label="{{$barImgs[$i]->caption}} - Gallery" class="readmore bold-green-link">View
                                                  Gallery&nbsp;<i class="fa fa-arrow-right"></i></a>
                                          @else
                                              @if($barImgs[$i]->moretext != "")
                                                  <a href="{{$barImgs[$i]->link}}"
                                                     aria-label="{{$barImgs[$i]->caption}} - {{$barImgs[$i]->moretext}}"
                                                     class="readmore bold-green-link">{{$barImgs[$i]->moretext}}&nbsp;<i
                                                              class="fa fa-arrow-right"></i></a>
                                              @else
                                                  <a href="{{$barImgs[$i]->link}}"
                                                     aria-label="{{$barImgs[$i]->caption}} - Read Story"
                                                     class="readmore bold-green-link">Read Story&nbsp;<i
                                                              class="fa fa-arrow-right"></i></a>
                                              @endif
                                          @endif
                                      @else
                                          @if($barImgs[$i]->moretext != "")
                                              <a href="{{$barImgs[$i]->link}}"
                                                 aria-label="{{$barImgs[$i]->caption}} - {{$barImgs[$i]->moretext}}"
                                                 class="readmore bold-green-link">{{$barImgs[$i]->moretext}}&nbsp;<i
                                                          class="fa fa-arrow-right"></i></a>
                                          @else
                                              <a href="{{$barImgs[$i]->link}}"
                                                 aria-label="{{$barImgs[$i]->caption}} - Read Story" class="readmore bold-green-link">Read
                                                  Story&nbsp;<i class="fa fa-arrow-right"></i></a>
                                          @endif
                                      @endif
                                  @elseif($barImgs[$i]->story->story_type == 'article')
                                      @if($barImgs[$i]->story->tags()->first())
                                          @if($barImgs[$i]->story->tags()->first()->name == 'external')
                                              <a href="{{$barImgs[$i]->link}}"
                                                 aria-label="{{$barImgs[$i]->caption}} - {{$barImgs[$i]->moretext}}"
                                                 class="readmore bold-green-link">{{$barImgs[$i]->moretext}}&nbsp;<i
                                                          class="fa fa-arrow-right"></i></a>
                                          @else
                                              <a href="/story/{{$barImgs[$i]->story->story_type}}/{{$barImgs[$i]->story->id}}"
                                                 aria-label="{{$barImgs[$i]->caption}} - {{$barImgs[$i]->moretext}}"
                                                 class="readmore bold-green-link">{{$barImgs[$i]->moretext}} <i
                                                          class="fa fa-arrow-right"></i></a>
                                          @endif
                                      @else
                                          <a href="/story/{{$barImgs[$i]->story->story_type}}/{{$barImgs[$i]->story->id}}"
                                             aria-label="{{$barImgs[$i]->caption}} - {{$barImgs[$i]->moretext}}"
                                             class="readmore bold-green-link">{{$barImgs[$i]->moretext}} <i
                                                      class="fa fa-arrow-right"></i></a>
                                      @endif
                                  @elseif($barImgs[$i]->story->story_type == 'featurephoto')
                                      <a href="/story/{{$barImgs[$i]->story->story_type}}/{{$barImgs[$i]->story->id}}"
                                         aria-label="{{$barImgs[$i]->caption}} - View" class="readmore bold-green-link">View Image&nbsp;
                                          <i class="fa fa-arrow-right"></i></a>
                                  @else
                                      <a href="/story/{{$barImgs[$i]->story->story_type}}/{{$barImgs[$i]->story->id}}"
                                         aria-label="{{$barImgs[$i]->caption}} - {{$barImgs[$i]->moretext}}"
                                         class="readmore bold-green-link">{{$barImgs[$i]->moretext}} <i class="fa fa-arrow-right"></i></a>
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
                  <h5 class="subhead-title">What's Happening at EMU</h5>
              </div>
          </div>
          <div id="news-headline-bar-top"class="row" data-equalizer>
              <div class="card small-12 medium-5 large-5 columns" data-equalizer-watch>
                  <div class="card-section" data-equalizer-watch>
                      <h6><a class="bold-green-link" title="EMU Today campus announcements." href="{{ url('/announcement') }}">Announcements
                              <i class="fa fa-arrow-right"></i></a></h6>
                      <div class="row newshub-tab-front">
                          <div class="large-12 medium-12 small-12 columns">
                              <ul>
                                  @foreach ($currentAnnouncements as $announcement)
                                      <li>
                                          <a href="/announcement/{{$announcement->id}}">{{$announcement->title}}</a>
                                      </li>
                                  @endforeach
                              </ul>
                          </div>
                      </div>
                  </div>
              </div><!-- end .card -->
              <div class="card small-12 medium-7 large-7 columns" data-equalizer-watch>
                  <div class="card-section" data-equalizer-watch>
                      <h6><a class="bold-green-link" title="EMU news, press releases, and official statements."
                             href="{{ url('/story/news') }}">News Headlines <i
                                      class="fa fa-arrow-right"></i></a>
                      </h6>
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
          </div><!-- end .row -->
          <div id="news-headline-bar-middle" class="row" data-equalizer>
              <div class="card small-12 medium-3 large-3 columns" data-equalizer-watch>
                  @if(isset($currentStoryImageWithVideoTag))
                      <a class="popup-youtube" href="{{$currentStoryImageWithVideoTag->link}}">
                          <img src="/imagecache/original/{{$currentStoryImageWithVideoTag->filename}}" alt="{{ $currentStoryImageWithVideoTag->alt_text != '' ? $currentStoryImageWithVideoTag->alt_text : 'featured video' }}" style="display: block;" />
                      </a>
                  @else
                      <a class="popup-youtube" href="https://www.youtube.com/user/emichigan08" target="blank"><img src="/assets/imgs/placeholder/external_video.jpg" alt="featured video" ></a>
                  @endif
                  <div class="card-section">
                      @if(isset($currentStoryImageWithVideoTag))
                          <p>{{$currentStoryImageWithVideoTag->caption}}</p>
                          <a class="popup-youtube bold-green-link" title="External link to a YouTube video." href="{{$currentStoryImageWithVideoTag->link}}" target="_blank">Watch Video <i class="fa fa-arrow-right"></i></a>
                      @else
                          <p>Welcome to Education First, the official Eastern Michigan University YouTube Channel.</p>
                          <a class="popup-youtube bold-green-link" title="External link to a YouTube video." href="https://www.youtube.com/user/emichigan08" target="blank">Watch Video <i class="fa fa-arrow-right"></i></a>
                      @endif
                  </div>
              </div>
              <div class="card small-12 medium-6 large-6 columns" data-equalizer-watch>
                  <div class="card-section" data-equalizer-watch>
                      <h6><a class="bold-green-link" title="External link to EMU's Twitter page." href="https://www.emich.edu/twitter/">Twitter
                                          <i class="fa fa-arrow-right"></i></a></h6>
                      <div class="row newshub-tab-front">
                          <div class="large-12 medium-12 small-12 columns">
                              <ul class="twitter-content">
                                <li><a href="#">@EMUSwoop</a> Alice, as the jury had a little door about fifteen inches high: she tried the effect of lying down with wonder at the stick, and held out its arms folded, frowning like a telescope. And so it was.</li>
                                <li><a href="#">@EMUSwoop</a> Knave was standing before them, in chains, with a sigh. ‘I only took the opportunity of showing off her head!’</li>
                                <li><a href="#">@EMUSwoop</a> The Queen put on his spectacles and looked along the passage into the sky.</li>
                              </ul>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="card small-12 medium-3 large-3 columns" data-equalizer-watch>
                  <div class="card-section" data-equalizer-watch>
                      <h6><a class="bold-green-link" href="#">Working @ EMU</a></h6>
                      <div class="row newshub-tab-front">
                          <div class="large-12 medium-12 small-12 columns">
                              <ul class="feature-list">
                                <li><i class="fa fa-users"></i>&nbsp;<a href="http://www.emich.edu/hr/benefits/documents/2016_service_award_honorees.pdf">Congratulations to the 2016 service award honorees</a></li>
                                <li><i class="fa fa-users"></i>&nbsp;<a href="http://etraining.emich.edu">Looking for professional development? Visit our eTraining website</a></li>
                                <li><i class="fa fa-users"></i>&nbsp;<a href="http://www.emich.edu/hr/documents/home_page/gctwf2015results_presentation_apmeeting_04-19-2016.pdf">Great Colleges to Work For survey results are now online</a></a></li>
                              </ul>
                          </div>
                      </div>
                  </div>
              </div><!-- /end .card -->
          </div><!-- /end .row -->
          <div id="news-headline-bar-bottom" class="row" data-equalizer>
              <div class="card small-12 medium-12 large-12 columns" data-equalizer-watch>
                  <div class="card-section" data-equalizer-watch>
                      <h6><a title="EMU campus events calendar." href="{{ url('/calendar') }}" class="bold-green-link">Events Calendar</a> <i class="fa fa-arrow-right"></i></h6>
                      @unless(empty($featuredevents[0]))
                          <div id="five-events-bar">
                              <div class="row large-up-4 medium-up-3 show-for-medium" data-equalizer>
                                  @each('public.featuredeventhub', $featuredevents, 'fevent')
                              </div><!-- row event block grid end -->
                          </div> <!--end of five events bar-->
                      @endunless
                  </div>
              </div><!-- /end .card -->
          </div><!-- /end .row -->
      </div><!-- /end #news-headline-bar -->
  </div><!-- /end #content-area -->
@endsection
@section('scriptsfooter')
    @parent
    <script>
    $(function () {
    });


    </script>
@endsection
