{{-- emu-today preview hub page --}}
@extends('public.layouts.global')
@section('styles')
    @parent
    @include('preview.includes.previewcoverstyle')
@endsection
@section('bodytop')
    @include('preview.includes.previewstory',['stype'=> $stype, 'gtype'=> $gtype, 'recordid' => $story->id, 'qtype'=> $qtype] )

    {{-- @include('preview.includes.previewstory',['stype'=> $story->story_type, 'sroute'=> $sroute, 'recordid' => $story->id, 'form'=> $form] ) --}}
@endsection
@section('offcanvaslist')
    @include('preview.includes.offcanvaslist')
@endsection
  @section('connectionbar')
    @include('preview.includes.connectionbar')
  @endsection
@section('content')
  <div id="content-area">
    <div id="news-bar">
      <div class="row">
        <p style="padding-left:1rem;">External stories link off to a website other than EMU Today. There is no preview for this story.</p>
      </div>
    </div>
  </div>
@endsection
@section('scriptsfooter')
    @parent
    <script>
    $(function () {
    //  var options = {dataCloseOnClick: false, dataDeepLink: true}
    // 	var $modal = new Foundation.Reveal($('#previewCover'), options);
    // 	$modal.open();


        // elem.foundation('reveal', 'open');

        // $('#myModal').foundation('reveal','open');
        // $('#myModal').foundation('reveal', 'close');
    });


    </script>
@endsection
