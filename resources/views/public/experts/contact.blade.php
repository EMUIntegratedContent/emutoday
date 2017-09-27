{{-- announcement --}}
@extends('public.layouts.global')

@section('title', 'Experts Directory Contact Us')
@section('content')
  <div id="experts-area">

      <div class="row">
          <div class="large-3 medium-3 small-12 columns">
              @include('public.experts.subviews.expertnav')
          </div>
          <div class="large-9 medium-3 small-12 columns">
              <div class="row">
                <div class="large-12 medium-12 small-12 columns">
                    <h1>Contact</h1>
                </div>
              </div>
              <div class="row">
                  <div class="large-12 medium-12 small-12 columns">
                    <h2>Eastern Experts and Community Speakers</h2>
                    <p>EMU Office of Media Relations<br />
                    Phone: 734.487.4400<br />
                    glarcom@emich.edu</p>
                  </div>
              </div>
          </div>
      </div>
  </div>
  <!--end content area-->
@endsection
