{{-- experts --}}
@extends('public.layouts.global') @section('title', 'Experts') @section('content')
<div id="experts-area">
    <!--<div class="row">
        <div class="large-12 medium-12 small-12 columns">
            <h3 class="news-caps">Eastern Experts</h3>
        </div>
    </div>-->
    <div class="row">
        <div class="large-3 medium-3 small-12 columns">
            @include('public.experts.subviews.expertnav')
        </div>
        <div class="large-9 medium-9 small-12 columns ">
            <div class="row"><div class="small-12 columns"><h1>Eastern Experts Directory</h1>
                <p>The Experts Directory connects community organizations and journalists with the engaging speakers and subject experts among our faculty and staff.</p>
                </div></div>
            <div class="row">
                <div class="large-12 medium-12 small-12 columns search-container">
                    @include('public.experts.subviews.searchform')
                </div>
            </div>
        </div>
    </div>
</div>
<!--end content area-->
@endsection
