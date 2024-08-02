@extends('public.layouts.global') @section('title', 'My Inside EMU') @section('content')
  <div id="insideemu-area">
    <div class="row">
      <div class="large-12 medium-12 small-12 columns">
        <h3 class="news-caps">My Inside EMU</h3>
      </div>
    </div>
    <div class="row">
      <div class="large-3 medium-3 small-12 columns">
        @include('public.insideemu.subviews.insideemu_nav')
      </div>
      <div class="large-9 medium-9 small-12 columns">
        <div id="vue-insideemu-user-ideas">
          <insideemu-user-ideas netid="{{$user}}"></insideemu-user-ideas>
        </div>
      </div>
    </div>
  </div>
@endsection
@section('scriptsfooter')
  @parent
  <script type="text/javascript" src="/js/vue-insideemu-user-ideas.js"></script>
@endsection
