@extends('public.layouts.global')
@section('title', 'Expert Search Results')
@section('content')

<div id="experts-area">
    <div class="row">
        <div class="large-3 medium-3 small-12 columns">
            @include('public.experts.subviews.expertnav')
        </div>
        <div class="large-9 medium-9 small-12 columns"  data-equalizer="text-expert">
            <div class="row"><div class="small-12 columns"><h1>Find an Expert</h1></div></div>
            <div class="row ">
                <div class="large-12 medium-12 small-12 columns search-container">
                    <!--<h2>Directory Search</h2>-->
                    @include('public.experts.subviews.searchform')
                </div>
            </div>
            <div class="row">
                <div class="large-12 medium-12 small-12 columns">
                    <h3 class="news-caps">{{ $experts->total() }} Matching Experts</h3>
                    @forelse ($experts as $expert)
                    <article class="expert-listing">
                        <div class="row">
                            <div class="small-4 columns photobox">
                                @if($expert->expertImages()->first())
                                <img src="/imagecache/expertthumb/{{$expert->expertImages()->first()->filename}}" alt="A photo of {{ $expert->display_name }}." />
                                @else
                                <img src="/imagecache/expertthumb/no-image.png" alt="No photo for {{ $expert->display_name }}." />
                                @endif
                            </div>
                            <div class="small-8 columns text-expertbox" data-equalizer-watch="text-expert">
                                <h2><a href="{{ route('expertview', ['id' => $expert->id]) }}">{{ $expert->display_name }}</a></h2>
                                <p>{{ $expert->title }}</p>
                                @php $numexpertise = count($expert->expertise) @endphp
                                @if($numexpertise > 0)
                                <p><strong>Areas of expertise:</strong>
                                    @foreach($expert->expertise as $expertise)
                                    @php $numexpertise--  @endphp
                                    {{ $expertise->expertise }}{{-- DO NOT ADD A COMMA AFTER THE LAST ONE --}}@if($numexpertise > 0),@endif
                                    @endforeach
                                    @endif
                                </p>
                            </div>
                        </div>
                    </article>

                    @empty
                    <p>No experts found</p>
                    @endforelse
                </div>
                
                <div class="row">
                    <div class="large-12 medium-12 small-12 columns">
{{--                        {{ // TODO: See if pagination works for collections (throws an error currently) }} --}}
                        <p>{!! $experts->render() !!}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--end content area-->
@endsection
