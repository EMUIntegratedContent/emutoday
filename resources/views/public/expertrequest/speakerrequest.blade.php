{{-- announcement --}}
@extends('public.layouts.global')

@section('title', 'Request an Eastern Speaker')
@section('styles')
    @parent
    <link rel="stylesheet" type="text/css" href="/css/flatpickr.min.css" />
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
                    <h1>Request an Eastern Speaker</h1>
                    <p>To request a speaker, fill out the following form. It will be emailed to the speaker, who will follow up with you directly to make arrangements.</p>
                </div>
              </div>
              <div class="row">
                  <div class="small-12 columns">
                      <div id="vue-expertspeakerrequest-form">
                        <expert-speaker-request-form
                          errors="{{ json_encode($errors) }}"
                          expert-id="{{ $expertId }}"
                          framework="foundation">
                          <input slot="csrf" type="hidden" name="_token" value="{{ csrf_token() }}">
                        </expert-speaker-request-form>
                      </div><!-- /#vue-expertspeakerrequest-form -->
                  </div>
              </div>
          </div>
      </div>
  </div>
  <!--end content area-->
@endsection
@section('scriptsfooter')
@parent
<script type="text/javascript" src="/js/vue-expertspeakerrequest-form.js"></script>
@endsection
