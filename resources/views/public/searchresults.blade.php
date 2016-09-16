{{-- searchResults --}}
@extends('public.layouts.global')
@section('content')
  <div id="content-area">
    <div id="listing-bar">
      <div class="row">
        <div class="large-12 medium-12 small-12 column">
          <div id="title-grouping" class="row">
            <div class="large-6 medium-12 columns"><h3 class="news-caps">Search Results </h3></div>
        </div>
        <div class="row">
            <div class="large-4 medium-6 small-12 columns">
                <form class="search-results-form form-inline" action="search" method="get">
                    <div class="input-group tiny">
                        <span class="input-group-label">Search:</span>
                        <input class="input-group-field" type="text" name="searchterm" value="{{$searchTerm}}">
                        <div class="input-group-button">
                            <input type="submit" class="button" value="Submit">
                        </div>
                    </div>
                </form>
            </div>
        </div>
            <div class="row">

            <div class="large-8 medium-8 small-12 columns">
            </div>
          </div>
          <div class="row">
            <div class="large-12 medium-12 small-12 column">

                @if($searchStoryResults->count() > 0)
                    <h4>Stories<span class="smaller-title">{!! $searchStoryResults->total() !!} Records</span></h4>

                    <ul class="search-result-list">

                @foreach($searchStoryResults as $searchStoryResult)
                  <li class="search-result-item">
                    <a href="/{{$searchStoryResult->story_type}}/{{$searchStoryResult->id}}"><h5>{{$searchStoryResult->title}}</h5></a>
                    <div class="search-result-content">
                        @if($searchStoryResult->subtitle)
                        <p>{{ $searchStoryResult->subtitle }}</p>
                    @endif
                        <p>{!! $searchStoryResult->teaser !!}</p>
                    </div>
                  </li>
                @endforeach
            </ul>
            <h6 class="text-center">{!! $searchStoryResults->links() !!}</h6>

        @endif

        @if($searchEventResults->count() > 0)
            <h4>Events<span class="smaller-title">{!! $searchEventResults->total() !!} Records</span></h4>

            <ul class="search-result-list">
        @foreach($searchEventResults as $searchEventResult)
          <li class="search-result-item">
            <a href="/calendar/event/{{$searchEventResult->id}}"><h5>{{$searchEventResult->title}}</h5></a>
            <div class="search-result-content">
                @if($searchEventResult->description)
                <p>{{ $searchEventResult->description }}</p>
            @endif
                <p>{!! $searchEventResult->submitter !!}</p>
            </div>
          </li>
        @endforeach
    </ul>
    <h6 class="text-center">{!! $searchEventResults->links() !!}</h6>

@endif

@if($searchAnnouncementResults->count() > 0)
    <h4>Announcements<span class="smaller-title">{!! $searchAnnouncementResults->total() !!} Records</span></h4>

    <ul class="search-result-list">

@foreach($searchAnnouncementResults as $searchAnnouncementResult)
  <li class="search-result-item">
    <a href="/search/announcement/{{$searchAnnouncementResult->id}}"><h5>{{$searchAnnouncementResult->title}}</h5></a>
    <div class="search-result-content">
        @if($searchAnnouncementResult->announcement)
        <p>{{ $searchAnnouncementResult->announcement }}</p>
    @endif
        <p>{!! $searchAnnouncementResult->submitter !!}</p>
    </div>
  </li>
@endforeach
</ul>
<h6 class="text-center">{!! $searchAnnouncementResults->links() !!}</h6>

@endif


            </div>
          </div>
        </div>
      </div>
    </div>
  </div>   <!--end content area-->
@endsection
