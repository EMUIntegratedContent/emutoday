{{-- media highlights --}}
@extends('public.layouts.global') @section('title', 'Media Highlights') @section('content')
<div id="experts-area">
    <div class="row">
        <div class="large-3 medium-3 small-12 columns">
          @include('public.mediahighlights.subviews.searchform')
        </div>
        <div class="large-9 medium-9 small-12 columns ">
            <div class="row">
              <div class="small-12 columns">
                <h1>Media Highlights</h1>
                <p>Samples of external media coverage focused on Eastern Michigan University. Click the link to read or view the story. (EMU is not responsible for broken links or archived content on these external websites).</p>
                <ul>
                  {{-- dd($highlightDatesPaginated) --}}
                @foreach ($highlightDatesPaginated as $date => $highlightDate)
                  <h2>{{ $date }}</h2>
                  <ul>
                  @foreach($highlightDate as $highlight)
                      <li><a href="{{ $highlight->url }}">{{ $highlight->title }}</a> – {{ $highlight->source }}</li>
                  @endforeach
                  </ul>
                @endforeach
                <h6 class="text-center">{!! $highlightDatesPaginated->appends(['tag' => $currentTag, 'q' => $searchterm])->render() !!}</h6>
                </ul>
              </div>
            </div>
        </div>
    </div>
</div>
<!--end content area-->
@endsection
