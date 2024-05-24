@extends('public.layouts.global') @section('title', 'My Intcomm (CHANGE)') @section('content')
  <div id="intcomm-area">
    <div class="row">
      <div class="large-12 medium-12 small-12 columns">
        <h3 class="news-caps">My INTCOMM (Change)</h3>
      </div>
    </div>
    <div class="row">
      <div class="large-3 medium-3 small-12 columns">
        @include('public.intcomm.subviews.intcomm_nav')
      </div>
      <div class="large-9 medium-9 small-12 columns">
        <div id="vue-intcomm-user-ideas">
          <intcomm-user-ideas netid="{{$user}}"></intcomm-user-ideas>
        </div>
      </div>
    </div>
  </div>
@endsection
@section('scriptsfooter')
  @parent
  <script type="text/javascript" src="/js/vue-intcomm-user-ideas.js"></script>
@endsection
