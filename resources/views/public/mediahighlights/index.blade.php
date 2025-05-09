{{-- media highlights --}}
@extends('public.layouts.global') @section('title', 'Media Highlights') @section('content')
<div id="experts-area">
    <div class="row">
        <div class="large-3 medium-3 small-12 columns">
          <h3>Search Highlights</h3>
          @include('public.mediahighlights.subviews.searchform')
        </div>
        <div class="large-9 medium-9 small-12 columns ">
            <div class="row">
              <div class="small-12 columns">
                <h1>Media Highlights</h1>
                <p>Samples of external media coverage focused on Eastern Michigan University. Click the link to read or view the story. (EMU is not responsible for broken links or archived content on these external websites).</p>
                @foreach ($highlightDatesPaginated as $date => $highlightDate)
                  <h2 class="mediahighlight-date">{{ date('M j, Y', strtotime($date)) }}</h2>
                  <ul class="news-headlines">
                  @foreach($highlightDate as $highlight)
                      <li>
                        <div class="publish-date">{{ $highlight->source }}</div>
                        <a href="{{ $highlight->url }}">{{ $highlight->title }} <i class="fa fa-external-link" aria-hidden="true"></i>
</a>
                      </li>
                  @endforeach
                  </ul>
                @endforeach
                <h6 class="text-center">{!! $highlightDatesPaginated->appends(['tag' => $searchTag, 'q' => $searchterm])->render() !!}</h6>
              </div>
            </div>
        </div>
    </div>
</div>
<!--end content area-->
@endsection
