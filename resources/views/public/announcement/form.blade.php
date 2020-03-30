@extends('public.layouts.global')
<!-- Event Views with Vues -->
@section('styles')
@parent
@endsection

@section('title', 'Submit an Announcement')
@section('content-top')
<div id="calendar-bar">
  <div class="row">
    <div class="medium-12 column">
      @include('public.components.errors')
      <div class="row">
        <div class="medium-6 columns">
          <h3 class="cal-caps toptitle">Announcements</h3>
          <div id="vue-announcements">
            <announcement-form ref="aform" framework="foundation" recordexists="{{$announcement->exists ? true: false}}" editid="{{$announcement->exists ? $announcement->id : null }}">
              <input slot="csrf" type="hidden" name="_token" value="{{ csrf_token() }}">
            </announcement-form>
          </div><!-- /#vue-event-form -->
        </div><!-- /.medium-6 column -->
        <div class="medium-6 columns">
            <div class="row">

            <div class="medium-12 columns" id="preview-container"></div>
            <div class="medium-12 columns" id="user-announcement-tables">
            @endsection

            @section('content-middle')
              @unless(empty($submitteditems[0]))
              <div class="row">
                <div class="small-12 column">
                  <h3 class="cal-caps toptitle">Submitted Announcements</h3>
                  <table id="user-events-submitted-table" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th class="text-left">Title</th>
                        <th class="text-left">Start Date</th>
                        <th class="text-left">End Date</th>
                        <th class="text-left">Submitted</th>
                        <th class="text-left">&nbsp;</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($submitteditems as $item)
                      <tr id="{{ $item->id }}">
                        <td>{{ $item->title }}</td>
                        <td>{{ Carbon\Carbon::parse($item->start_date)->format('M d, Y') }}</td>
                        <td>{{ Carbon\Carbon::parse($item->end_date)->format('M d, Y') }}</td>
                        <td>{{ Carbon\Carbon::parse($item->created_at)->format('M d, Y - g:ia') }}</td>
                        <td class="editBtn"><a href="#">EDIT</a></td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div><!-- /.small-12 column -->
              </div><!-- /.row -->
              @endunless

              @unless(empty($approveditems[0]))
              <div class="row">
                <div class="small-12 column">
                  <h3 class="cal-caps toptitle">Approved Announcements</h3>
                  <table id="user-events-approved-table" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th class="text-left">Title</th>
                        <th class="text-left">Start Date</th>
                        <th class="text-left">End Date</th>
                        <th class="text-left">Approved</th>
                        <th class="text-left">&nbsp;</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($approveditems as $item)
                      <tr id="{{ $item->id }}">
                        <td>{{ $item->title }}</td>
                        <td>{{ Carbon\Carbon::parse($item->start_date)->format('M d, Y') }}</td>
                        <td>{{ Carbon\Carbon::parse($item->end_date)->format('M d, Y') }}</td>
                        <td>{{ Carbon\Carbon::parse($item->approved_date)->format('M d, Y') }}</td>
                        <td class="editBtn"><a href="#">EDIT</a></td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div><!-- /.small-12 column -->
              </div><!-- /.row -->
              @endunless
              @endsection

              @section('content-bottom')
            </div>
        </div>
        </div><!-- /.medium-6 columns -->
      </div><!-- /.row -->
    </div><!-- /.small-12 column -->
  </div><!-- /.row -->
<br>
</div><!-- /#calendar-bar -->
@endsection

@section('scriptsfooter')
@parent
<script type="text/javascript" src="/js/vue-announcement-form.js"></script>
@endsection
