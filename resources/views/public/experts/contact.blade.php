{{-- announcement --}}
@extends('public.layouts.global')

@section('title', 'Experts Directory Contact Us')
@section('content')
  <div id="content-area">
      <div class="row">
          <div class="large-3 medium-3 small-12 columns">
              @include('public.experts.subviews.expertnav')
          </div>
          <div class="large-9 medium-3 small-12 columns">
              <div class="row">
                <div class="large-12 medium-12 small-12 columns">
                    <h3 class="news-caps">Contact</h3>
                </div>
              </div>
              <div class="row">
                  <div class="large-12 medium-12 small-12 columns">
                      <h4>Help for Journalists</h4>
                      <p>
                          UNLV Office of Media Relations<br />
                          Phone: 702-895-3102<br />
                          Fax: 702-895-4057<br />
                          E-mail: mediarelations@unlv.edu<br />
                      </p>
                      <h4>Help for Community Speakers</h4>
                      <p>
                          Isabelle Johnson<br />
                          University Communications<br />
                          Phone: 702-895-3963<br />
                          E-mail: isabelle.johnson@unlv.edu<br />
                      </p>
                  </div>
              </div>
          </div>
      </div>
  </div>
  <!--end content area-->
@endsection
