{{-- internal communications (public page) --}}
@extends('public.layouts.global') @section('title', 'Intcomm (CHANGE)') @section('content')
  <div id="intcomm-area">
    <div class="row">
      <div class="small-12 columns">
        <div class="row">
          <div class="small-12 columns"><h1>INTCOMM (CHANGE)</h1>
            <p><a title="Submit a suggestion" href="/intcomm/ideas/create">Submit an INTCOMM IDEA (CHANGE)</a></p>
          </div>
        </div>
        <div class="row">
          <div class="small-12 columns search-container">
            {{ $posts }}
            ALL LIVE POSTS SHOULD SHOW HERE.
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

