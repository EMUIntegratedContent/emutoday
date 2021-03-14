{{-- preview for student Profiles Index Page --}}

@extends('public.layouts.global')
@section('offcanvaslist')
	@include('preview.includes.offcanvaslist')
@endsection
  @section('connectionbar')
    @include('preview.includes.connectionbar')
  @endsection
@section('content')
  <div id="content-area">
      <div id="listing-bar" class="row">
          <div class="large-12 medium-12 small-12 columns">
              <div id="title">
                <h3 class="news-caps"><span class="truemu">EMU</span> Student Profiles</h3>
              </div>
      </div>
      </div>
      <div id="homepage-hero" class="row">
        <div class="small-12 column">
          <div id="profile-text-over-image-box"><p class="profile-caption show-for-medium">{{$heroImg->caption}}</p>
          <p><a href="student/{{$heroImg->story->id}}">{{$heroImg->moretext}}</a></p></div>
          <img src="{{$heroImg->present()->mainImageURL }}" alt="main image"/>
        </div>
      </div>
          <div id="profiles-list">
              <div class="row">
                  <div class="large-10 medium-10 small-10 columns">
                    <h4>Recent Profiles</h4>
                  </div>
                  <div class="large-2 medium-2 small-2 columns control-arrows">
                    {{-- <a href=""><i class="fi-arrow-left"></i></a><a href=""><i class="fi-arrow-right"></i></a> --}}
                  </div>
              </div>

                <div class="row small-up-2 medium-up-3 large-up-5">
                  @each('public.student.partials.box', $barImgs, 'barImg')
                </div>

              <div id="student-feature">
                   <div class="row">
                       <div class="large-7 medium-12 hide-for-small columns"><img src="/imagecache/original/{{$featureImg->filename}}"  alt="feature student image"/></div>
                       <div class="large-5 medium-12 small-12 columns">
                           <h4 class="green">{{$featureImg->caption}}</h4>
                           <p>{{$featureImg->teaser}}</p>
                           <p><a class="button large emu-button">{{$featureImg->moretext}}</a></p>
                       </div>

                  </div>
               </div>
          </div><!--end of profiles-list-->

   </div>   <!--end content area-->
@endsection
