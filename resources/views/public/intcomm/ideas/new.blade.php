@extends('public.layouts.global') @section('title', 'New Idea Intcomm (CHANGE)') @section('content')
    <div id="intcomm-area">
        <div class="row">
            <div class="large-12 medium-12 small-12 columns">
                <h1 class="news-caps">INTCOMM (CHANGE) &mdash; New Idea</h1>
            </div>
        </div>
        <div class="row">
            <div class="large-3 medium-3 small-12 columns">
                @include('public.intcomm.subviews.intcomm_nav')
            </div>
            <div class="large-9 medium-9 small-12 columns">
                @if($user)
                    <p>Hello, {{ $user }}</p>
                    <div id="vue-intcomm-user-idea-form">
                        <intcomm-idea-user-form
                            netid="{{$user}}"
                        ></intcomm-idea-user-form>
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
    <script type="text/javascript" src="/js/vue-intcomm-user-idea-form.js"></script>
@endsection
