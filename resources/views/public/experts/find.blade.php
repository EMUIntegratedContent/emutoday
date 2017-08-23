{{-- announcement --}}
@extends('public.layouts.global')

@section('title', 'Expert Search Results')
@section('content')
  <div id="content-area">
      <div class="row">
          <div class="large-3 medium-3 small-12 columns">
              @include('public.experts.subviews.expertnav')
          </div>
          <div class="large-9 medium-9 small-12 columns">
              @include('public.experts.subviews.searchform')
              <hr />
              <h3 class="news-caps">{{ count($experts) }} Matching Experts</h3>
              @forelse ($experts as $expert)
                  <article>
                      <h2><a href="{{ route('expertview', ['id' => $expert->id]) }}">{{ $expert->display_name }}</a></h2>
                      @if($expert->expertImages()->first())
                          <img src="/imagecache/expertthumb/{{$expert->expertImages()->first()->filename}}" alt="{{$expert->expertImages()->first()->image_name}}" />
                      @endif
                      <p>{{ $expert->title }}</p>
                      <p>{{ $expert->teaser }}</p>
                  </article>
              @empty
                  <p>No experts found</p>
              @endforelse
          </div>
      </div>
  </div>
  <!--end content area-->
@endsection
