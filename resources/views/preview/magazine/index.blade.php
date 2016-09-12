{{-- Magazine Index Page --}}
@extends('public.layouts.global')
@section('styles')
    @parent
    @include('preview.includes.previewcoverstyle')
@endsection
@section('bodytop')
    @include('preview.includes.previewcover')
@endsection
@section('offcanvaslist')
    @include('public.magazine.partials.offcanvaslist')
@endsection
  @section('connectionbar')
    @include('public.magazine.partials.connectionbar')
  @endsection
@section('content')
  <div id="content-area">
    <div id="homepage-hero" class="row column">
      <img src="/imagecache/original/{{$heroImg->filename}}" alt="main image">
      <div id="magazine-text-over-image-box" class="row collapse">
        <div class="centered-main-title">
          <h2><a href="/emu-today/magazine/article/{{$heroImg->story->id}}">{{$heroImg->title}}</a></h2>
          <p>{{$heroImg->caption}}</p>
        </div>
      </div>
    </div>
    <div id="profiles-list" >
      <div class="row column">
        <div class="row small-up-2 medium-up-2 large-up-5">
            @for ($i = 1; $i <= count($barImgs); $i++)
                <div class="column">
                  <a class="article-link" href="/emu-today/magazine/article/{{$barImgs[$i]->story->id}}">
                    <img class="topic-image" src="/imagecache/original/{{$barImgs[$i]->filename}}"  alt="topic image"/>
                    <div class="profile-content">
                      <div class="profile-text-content magazine" data-equalizer-watch>
                        <h3>{{$barImgs[$i]->title}}</h3>
                        <p>{{$barImgs[$i]->caption}}</p>
                      </div>
                    </div>
                  </a>
                </div>
            @endfor
            {{-- @each('public.layouts.components.smallimg', $barImgs, 'barImg') --}}
            </div>
        </div>
      </div>
      <div id="magazine-feature">
        <div class="row">
          <div class="large-7 large-push-5 medium-12 small-12 columns">
            <div class="row photo-feature-section">
              <div class="large-6 medium-6 small-12 columns"><img class="topic-image contributor" src="/imagecache/original/{{$magazineExtra->media_name}}"  alt="back page image"/>
              </div>
              <div class="large-6 medium-6 small-12 columns photo-feature-text ">
                <h5>{{$magazineExtra->headline}}</h5>
                {!! $magazineExtra->teaser !!}
                <p class="author">{{$magazineExtra->caption}}</p>
              </div>

            </div>

          </div>


          <div class="large-5 large-pull-7 medium-12 small-12 columns">
            <div class="row">
              <div class="large-6 medium-4 show-for-medium columns cover-box">
                                <img class="topic-image magazine-cover" src="/imagecache/magazinecover/{{$magazineCover->media_name}}"  alt="magazine image"/>
              </div>
              <div class="large-6 medium-8 small-12 columns magazine-details">
                                <h4>{{$magazineCover->headline}}</h4>
                                {!! $magazineCover->teaser !!}
                                <p><a href="{{$magazineCover->link}}">{{$magazineCover->link_text}}</a></p>
                <p class="button-container"><a class="button expanded magazine-button">Subscribe</a></p>
                <p class="button-container"><a class="button expanded magazine-button">Submit a story idea</a></p>
              </div>

            </div>
          </div>

        </div>
      </div><!--end of profiles-list-->

    </div>
@endsection
