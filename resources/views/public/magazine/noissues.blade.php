{{-- Magazine Index Page --}}
@extends('public.layouts.global')
@section('offcanvaslist')
    @include('public.magazine.partials.offcanvaslist')
@endsection
  @section('connectionbar')
    @include('public.magazine.partials.connectionbar')
  @endsection

@section('magazine-title')No Magazine Issues Available @stop
@section('content')
  <div id="content-area">
    <div id="news-story-bar" class="magazine-story">

          <div id="story-content" class="row">
            <div class="large-9 medium-8 small-12 columns">
              <div id="issue-grouping" class="row">
                <div class="large-8 medium-8 small-12 columns">
                    <h2 class="issue-date news-caps">Looks like we forgot something!</h2></div>
                <div class="large-4 medium-4 small-12 columns">
                </div>
              </div> <!-- issue-grouping -->
              <div id="story-listing" class="row">
                 <div class="callout alert">
                   <p>There are no current or past magazine issues at this time.</p>
                 </div>                  
              </div> <!-- story-listing -->
            </div>
            <div class="large-3 medium-4 small-12 columns current-issue-padding">
              <a class="button magazine-button expanded" href="mailto:dgiffor2@emich.edu">Subscribe</a>
              <a class="button magazine-button expanded" href="mailto:dgiffor2@emich.edu">Submit a Story Idea</a>
                        </div>
                    </div>

    </div> <!-- news-story-bar -->

  </div>   <!--end content area-->
@endsection
