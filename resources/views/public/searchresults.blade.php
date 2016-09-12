{{-- searchResults --}}
@extends('public.layouts.global')
@section('content')
  <div id="content-area">
    <div id="listing-bar">
      <div class="row">
        <div class="large-12 medium-12 small-12 column">
          <div id="title-grouping" class="row">
            <div class="large-6 medium-12 columns"><h3 class="news-caps">Search Results <span class="smaller-title">{!! $searchResults->total() !!} Records</span></h3></div>
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
                <h6 class="text-center">{!! $searchResults->links() !!}</h6>
            </div>
          </div>
          <div class="row">
            <div class="large-12 medium-12 small-12 column">

              <ul class="search-result-list">
                @foreach($searchResults as $searchResult)
                  <li class="search-result-item">
                    <a href="/emu-today/story/{{$searchResult->id}}"><h5>{{$searchResult->title}}</h5></a>
                    <div class="search-result-content">
                        @if($searchResult->subtitle)
                        <p>{{ $searchResult->subtitle }}</p>
                    @endif
                        <p>{!! $searchResult->teaser !!}</p>
                    </div>
                  </li>
                @endforeach
            </ul>
              <div id="base-grouping" class="row">
                <div class="large-5 medium-7 hide-for-small columns">&nbsp;</div>
                <div class="large-7 medium-5 small-12 columns">
                    <h6>{!! $searchResults->links() !!}</h6>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>   <!--end content area-->
@endsection
