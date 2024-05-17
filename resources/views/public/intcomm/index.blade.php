{{-- internal communications (public page) --}}
@extends('public.layouts.global') @section('title', 'Intcomm (CHANGE)') @section('content')
<div id="intcomm-area">
    <!--<div class="row">
        <div class="large-12 medium-12 small-12 columns">
            <h3 class="news-caps">Eastern Experts</h3>
        </div>
    </div>-->
    <div class="row">
        <div class="large-3 medium-3 small-12 columns">
{{--            @include('public.experts.subviews.expertnav')--}}
        </div>
        <div class="large-9 medium-9 small-12 columns ">
            <div class="row"><div class="small-12 columns"><h1>INTCOMM (CHANGE)</h1>
                <p>Suggest stories for EMU Today.</p>
                </div></div>
{{--            <div class="row">--}}
{{--                <div class="large-12 medium-12 small-12 columns search-container">--}}
{{--                    @include('public.experts.subviews.searchform')--}}
{{--                </div>--}}
{{--            </div>--}}
        </div>
    </div>
</div>
<div id="vue-intcomm-post-form-wrapper-public">
    <intcomm-post-form-wrapper-public></intcomm-post-form-wrapper-public>
</div>
<!--end content area-->
@endsection
@section('footer-app')
    @parent
    <script type="text/javascript" src="/js/vue-intcomm-post-form-wrapper-public.js"></script>
@endsection
