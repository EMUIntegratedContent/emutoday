@extends('public.layouts.global') @section('title', 'Intcomm (CHANGE)') @section('content')
    <div id="intcomm-area">
        <div class="row">
            <div class="large-3 medium-3 small-12 columns">
                @include('public.intcomm.subviews.intcomm_nav')
            </div>
            <div class="large-9 medium-9 small-12 columns ">
                <div class="row"><div class="small-12 columns"><h1>INTCOMM (CHANGE)</h1>
                        <p>Suggest stories for EMU Today.</p>
                    </div></div>
                <div class="row">
                    <div class="large-12 medium-12 small-12 columns search-container">
                        Show user's posts here.
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
{{--@section('scriptsfooter')--}}
{{--    @parent--}}
{{--    <script type="text/javascript" src="/js/vue-intcomm-post-form-wrapper-public.js"></script>--}}
{{--@endsection--}}
