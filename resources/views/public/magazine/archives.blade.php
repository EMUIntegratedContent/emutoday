{{-- Magazine Article Page --}}
@extends('public.layouts.global')
@section('offcanvaslist')
@include('public.magazine.partials.offcanvaslist')
@endsection
@section('connectionbar')
@include('public.magazine.partials.connectionbar')
@endsection

@section('magazine-title', 'Eastern Magazine Archives')
@section('content')
<div id="content-area">
  <div class="row">
    <div class="small-2 large-4 columns">...</div>
    <div class="small-4 large-4 columns">...</div>
    <div class="small-6 large-4 columns">...</div>
  </div>
  <div class="row">
    <div class="large-3 columns">...</div>
    <div class="large-6 columns">...</div>
    <div class="large-3 columns">...</div>
  </div>
  <div class="row">
    <div class="small-6 large-2 columns">...</div>
    <div class="small-6 large-8 columns">...</div>
    <div class="small-12 large-2 columns">...</div>
  </div>
  <div class="row">
    <div class="small-3 columns">...</div>
    <div class="small-9 columns">...</div>
  </div>
  <div class="row">
    <div class="large-4 columns">...</div>
    <div class="large-8 columns">...</div>
  </div>
  <div class="row">
    <div class="small-6 large-5 columns">...</div>
    <div class="small-6 large-7 columns">...</div>
  </div>
  <div class="row">
    <div class="large-6 columns">...</div>
    <div class="large-6 columns">...</div>
  </div>
</div>
@endsection
