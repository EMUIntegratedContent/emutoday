@extends('public.layouts.global')

@section('title', 'Eastern Expert ' . $expert->display_name)
@section('content')
  <div id="experts-area">
    <div class="row">
      <div class="large-3 medium-12 small-12 columns">
        @include('public.experts.subviews.expertnav')
      </div>
      <div class="large-7 medium-12 small-12 columns">
        <h2>{{ $expert->display_name }}</h2>
        <p class="expert-title">{{ $expert->title }}</p>
        <p><strong>Expertise:</strong> {{ $expertiseString }}</p>
        <h3>About</h3>
        <div class="ck-content">{!! $expert->biography !!}</div>

        <!-- Previous titles -->
        @if(count($expert->previousTitles) > 0)
          <h3>Previous Titles</h3>
          <ul id="previous-titles-list">
            @foreach($expert->previousTitles as $title)
              <li>{{ $title->title }}</li>
            @endforeach
          </ul>
        @endif
      <!-- Education -->
        @if(count($expert->education) > 0)
          <h3>Education</h3>
          <ul id="education-list">
            @foreach($expert->education as $education)
              <li>{{ $education->education }}</li>
            @endforeach
          </ul>
        @endif
      <!-- Social Media Links -->
        @if(count($expert->socialMediaLinks) > 0)
          <h3>Social Media Links</h3>
          <ul id="socialmedia-list">
            @foreach($expert->socialMediaLinks as $socialMedia)
              <li><a href="{{ $socialMedia->url }}">{{ $socialMedia->title }}</a></li>
            @endforeach
          </ul>
        @endif
        <h3>Search for Other Experts On</h3>
        <ul>
          @foreach($expertCategories as $category)
            <li><a href="/experts/find?q=&amp;category={{ $category }}">{{ $category }}</a></li>
          @endforeach
        </ul>
      </div>
      <div class="large-2 medium-12 small-12 columns rightside-column">
        @if($expert->expertImages()->first())
          <img class="expert-sidepic" src="/imagecache/expertmedium/{{$expert->expertImages()->first()->filename}}"
               alt="A photo of {{$expert->display_name}}."/>
          <p><a class="button hi-res-expert" href="/imgs/expert/{{$expert->expertImages()->first()->filename}}">Download
              High Resolution Photo</a></p>
        @else
          <img class="expert-sidepic" src="/imagecache/expertmedium/no-image.png"
               alt="No photo available for {{$expert->display_name}}."/>
        @endif
        @if($expert->is_media_expert)
          <p><a href="/experts/mediarequest/{{ $expert->id }}" class="button">Request as Media Expert</a></p>
        @endif
        @if($expert->is_community_speaker)
          <p><a href="/experts/speakerrequest/{{ $expert->id }}" class="button">Request as Speaker</a></p>
        @endif

        @if($expert->do_print_interviews)
          <p><i class="fa fa-check-circle"></i> Available for print Interviews</p>
        @endif
        @if($expert->do_broadcast_interviews)
          <p><i class="fa fa-check-circle"></i> Available for broadcast Interviews</p>
        @endif

        {!! $languageString !!}
      </div>
    </div>
  </div>
  <!--end content area-->
@endsection
