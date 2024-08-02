@extends('public.layouts.global') @section('title', 'Edit Inside EMU Submission') @section('content')
  <div id="insideemu-area">
    <div class="row">
      <div class="large-12 medium-12 small-12 columns">
        <h3 class="news-caps">Inside EMU</h3>
      </div>
    </div>
    <div class="row">
      <div class="large-3 medium-3 small-12 columns">
        @include('public.insideemu.subviews.insideemu_nav')
      </div>
      <div class="large-9 medium-9 small-12 columns">
        @if($user)
          <p>Hello, {{ $user }}</p>
          <div id="vue-insideemu-user-idea-form">
            <insideemu-idea-user-form
                netid="{{$user}}"
                ideaid="{{$ideaId}}"
            ></insideemu-idea-user-form>
          </div>
        @else
          <div data-alert class="callout alert">
            Not logged in. You must be logged in to see this section.
          </div>
        @endif
          <a href="/insideemu/ideas" class="button">Back to My Submissions</a>
      </div>
    </div>
  </div>
@endsection
@section('scriptsfooter')
  @parent
  <script type="text/javascript" src="/js/vue-insideemu-user-idea-form.js"></script>
@endsection
