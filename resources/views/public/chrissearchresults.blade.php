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
            <div class="large-12 medium-12 small-12 columns" id="vue-search-filter">
                <ul id="search-filter-list">
                    <li class="{{ Request::get('filter') === null || Request::get('filter') == 'all' ? 'active' : '' }}"><a href="/search?searchterm={{ $searchTerm }}&filter=all">All</a></li>
                    <li class="{{ Request::get('filter') == 'stories' ? 'active' : '' }}"><a href="/search?searchterm={{ $searchTerm }}&filter=stories">Stories</a></li>
                    <li class="{{ Request::get('filter') == 'events' ? 'active' : '' }}"><a href="/search?searchterm={{ $searchTerm }}&filter=events">Events</a></li>
                    <li class="{{ Request::get('filter') == 'announcements' ? 'active' : '' }}"><a href="/search?searchterm={{ $searchTerm }}&filter=announcements">Announcements</a></li>
                </ul>
            </div>
          </div>
          <div class="row">
            <div class="large-12 medium-12 small-12 column">
                @if($numResults > 0)
                    <h4><span class="smaller-title">Found {!! $numResults !!} Results</span></h4>
                    
                    <ul class="search-result-list">
                    @foreach($storiesPaginated as $searchEventResult)
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
                    <h6 class="text-center">{!! $storiesPaginated->links() !!}</h6>
                @else 
                    <div class="callout alert">
                        <p>No matching results. Try again.</p>
                    </div>
                @endif
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>   <!--end content area-->
@endsection
