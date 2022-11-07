{{-- announcement --}}
@extends('public.layouts.global')

@section('title', 'Announcement')
@section('content')
  <div id="content-area">
    <div id="listing-bar">
      <div class="row">
        <div class="large-12 medium-12 small-12 column">
          <div id="title-grouping" class="row">
            <div class="large-5 medium-7 small-12 columns  noleftpadding"><h3 class="news-caps">Announcements {{-- <!-- <a class="smaller-title" href="">[ RSS feed ]</a> --> --}}</h3></div>
            <div class="large-7 medium-5 small-12 columns noleftpadding"><h6>{!! $announcements->links() !!}</h6></div>
          </div>
          <div class="row">
            <div class="large-12 medium-12 small-12 column">

              <ul class="accordion" id="announcement-list" data-accordion data-allow-all-closed="true">
                @foreach($announcements as $announcement)
                  <li class="{{$announcement->id == $id ? 'accordion-item is-active':'accordion-item' }}" id="accitem-{{$announcement->id}}" data-accordion-item>
                    <a href="#" class="accordion-title">{{$announcement->title}}</a>
                    <div class="accordion-content" data-tab-content>
                        <p>{!! $announcement->announcement !!}</p>
                        @if($announcement->link)
                            <p>For more information visit: <a href="{{ (substr($announcement->link, 0, 4) == 'http') ? $announcement->link : 'https://'.$announcement->link }}" class="accordion-link" target="_blank">{{$announcement->link_txt ?: 'More Info'}}</a></p>
                        @endif
                        @if($announcement->email_link)
                            <p>Contact Email: <a href="mailto:{{$announcement->email_link}}" class="accordion-link" target="_blank">{{$announcement->email_link_txt ?: $announcement->email_link}}</a></p>
                        @endif
                        @if($announcement->phone)
                            <p>Contact Phone: <a href="tel:{{$announcement->phone}}">{{$announcement->phone}}</a></p>
                        @endif
                        <p>Posted {{$announcement->present()->prettyDate}}</p>
                    </div>
                  </li>
                @endforeach
              </ul>
              <div id="base-grouping" class="row">
                <div class="large-5 medium-7 hide-for-small columns">&nbsp;</div>
                <div class="large-7 medium-5 small-12 columns"><h6>{!! $announcements->links() !!}</h6></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>   <!--end content area-->
@endsection
