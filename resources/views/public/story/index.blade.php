@extends('public.layouts.global')

@section('title','News')
@section('content')
  <div id="content-area">
    <div id="listing-bar">
      <div class="row">
        <div class="large-12 medium-12 small-12 columns">
          <div id="title-grouping" class="row">
            <div class="large-5 medium-7 small-12 columns"><h3 class="news-caps">News Headlines {{-- <!--<a class="smaller-title" href="">[ RSS feed ]</a>--> --}}</h3></div>
            <div class="large-7 medium-5 small-12 columns">
              <h6>{!! $storys->links() !!}</h6>
            </div>
          </div>
          <div class="row">
            <div class="large-12 medium-12 small-12 columns">

              <ul class="news-headlines">
                @foreach($storys as $story)
                  <li><div class="publish-date">{{ Carbon\Carbon::parse($story->present()->publishedDate)->format('M d, Y') }}</div><a href="/story/{{$story->story_type}}/{{$story->id}}">{{$story->title}}</a></li>
                @endforeach
              </ul>
              <div id="base-grouping" class="row">
                <div class="large-5 medium-7 hide-for-small columns">&nbsp;</div>
                <div class="large-7 medium-5 small-12 columns">
                  <h6>{!! $storys->links() !!}</h6>
                </div>
              </div>

            </div>
          </div>
        </div>
      </div>

    </div>

  </div>   <!--end content area-->
@endsection
