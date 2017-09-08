@extends('public.layouts.global')

@section('title','News')
@section('content')
  <div id="content-area">
    <div id="listing-bar">
      <div class="row">
        <div class="large-12 medium-12 small-12 columns">
          <div class="row">
            <div class="large-5 medium-7 small-12 columns"><h3 class="news-caps">News Headlines {{-- <!--<a class="smaller-title" href="">[ RSS feed ]</a>--> --}}</h3></div>
            <div class="large-7 medium-5 small-12 columns">
              <h6>{!! $storys->appends(['filter' => $newsAdvisoryStatementFilter])->render() !!}</h6>
            </div>
          </div>
          <div id="title-grouping" class="row">
            <div class="large-12 medium-12 small-12 columns">
                <a href="/story/news" class="button newsfilter @if($newsAdvisoryStatementFilter) secondary @endif">All</a>
                <a href="/story/news?filter=news" class="button newsfilter @if($newsAdvisoryStatementFilter != 'news') secondary @endif">News Only</a>
                <a href="/story/news?filter=advisory" class="button newsfilter @if($newsAdvisoryStatementFilter != 'advisory') secondary @endif">Advisories Only</a>
                <a href="/story/news?filter=statement" class="button newsfilter @if($newsAdvisoryStatementFilter != 'statement') secondary @endif">Statements Only</a>
            </div>
          </div>
          <div class="row">
            <div class="large-12 medium-12 small-12 columns">
              <ul class="news-headlines">
                @foreach($storys as $story)
                  <li>
                    <div class="publish-date">{{ Carbon\Carbon::parse($story->present()->publishedDate)->format('M d, Y') }}</div>
                    <a href="/story/{{$story->story_type}}/{{$story->id}}">
                        @if($story->story_type == 'advisory')
                          <i class="fa fa-warning" aria-hidden="true"></i>
                        @elseif($story->story_type == 'statement')
                          <i class="fa fa-commenting" aria-hidden="true"></i>
                        @endif
                      {{$story->title}}
                    </a>
                  </li>
                @endforeach
              </ul>
              <div id="base-grouping" class="row">
                <div class="large-5 medium-7 hide-for-small columns">&nbsp;</div>
                <div class="large-7 medium-5 small-12 columns">
                  <h6>{!! $storys->appends(['filter' => $newsAdvisoryStatementFilter])->render() !!}</h6>
                </div>
              </div>

            </div>
          </div>
        </div>
      </div>

    </div>

  </div>   <!--end content area-->
@endsection
