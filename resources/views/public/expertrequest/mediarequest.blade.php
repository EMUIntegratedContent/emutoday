{{-- announcement --}}
@extends('public.layouts.global')

@section('title', 'Request an Eastern Media Expert')
@section('style-plugin')
    @parent
    <link rel="stylesheet" type="text/css" href="/css/flatpickr.min.css">
@endsection
@section('style-app')
    @parent
@endsection
@section('scripthead')
    @parent
@endsection

@section('scripts-vendor')
    <!-- Vendor Scripts that need to be loaded in the header before other plugin or app scripts -->
    @parent
@endsection
@section('scripts-plugin')
    <!-- Scripts  for code libraries and plugins that need to be loaded in the header -->
    @parent
@endsection
@section('scripts-app')
    <!-- App related Scripts  that need to be loaded in the header -->
    @parent
@endsection
@section('content')
  <div id="experts-area">




      <div class="row">
          <div class="large-3 medium-3 small-12 columns">
              @include('public.experts.subviews.expertnav')
          </div>
          <div class="large-9 medium-3 small-12 columns">
              <div class="row">
                <div class="large-12 medium-12 small-12 columns">
                    <h1>Request an Eastern Expert</h1>
                    <p>The Office of Media Relations works directly with journalists to develop stories and track down expert sources for print, electronic, and broadcast media.</p>
                    <h4>Need a source quickly?</h4>
                    <p>You don't have to go through the directory. We'll track down a media expert for you and arrange the interview. Contact Geoff Larcom at 734.487.4400 or email at glarcom@emich.edu.</p>
                    <h4>Browse the Directory</h4>
                    <p>Find an expert, then complete the Request an Eastern Expert form from the individual’s bio page. We'll get back to you to arrange the interview.<br />
                        Journalists: Please fill out this form. The Media Relations Office will quickly track down the expert you need. Or just give us a call at 734.487.4400.</p>
                </div>
              </div>
              <div class="row">
                  <div class="small-12 columns">
                      <div id="vue-expertmediarequest-form">
                        <expert-media-request-form
                          errors="{{ json_encode($errors) }}"
                          expert-id="{{ $expertId }}"
                          :is-admin="false"
                          framework="foundation">
                          <input slot="csrf" type="hidden" name="_token" value="{{ csrf_token() }}">
                      </expert-media-request-form>
                      </div><!-- /#vue-expertmediarequest-form -->
                  </div>
              </div>
          </div>
      </div>
  </div>
  <!--end content area-->
@endsection
@section('scriptsfooter')
@parent
<script type="text/javascript" src="/js/vue-expertmediarequest-form.js"></script>
@endsection
