@extends('public.layouts.global') @section('title', 'New Inside EMU Submission') @section('content')
    <div id="insideemu-area">
        <div class="row">
            <div class="large-12 medium-12 small-12 columns">
                <h1 class="news-caps">Inside EMU &mdash; New Submission</h1>
            </div>
        </div>
        <div class="row">
            <div class="large-3 medium-3 small-12 columns">
                @include('public.insideemu.subviews.insideemu_nav')
            </div>
            <div class="large-9 medium-9 small-12 columns">
                @if($user)
                    <div id="vue-insideemu-user-idea-form">
                        <insideemu-idea-user-form
                            netid="{{$user}}"
                        ></insideemu-idea-user-form>
                    </div>
                @else
                    <div data-alert class="callout alert">
                        Not logged in. You must be logged in to see this section.
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
@section('scriptsfooter')
    @parent
    <script type="text/javascript" src="/js/vue-insideemu-user-idea-form.js"></script>
@endsection
