<!-- Event Views with Vues -->
@extends('public.layouts.global')
@section('styles')
@parent
<link rel="stylesheet" type="text/css" href="/css/flatpickr.min.css" />
@endsection

@section('content')
<div id="calendar-bar">
  <div class="row">
    <div class="medium-12 column">
      @include('public.components.errors')
      <div class="row">
        <div class="medium-6 columns">
          <h3 class="cal-caps toptitle">Announcements</h3>
          <div id="vue-announcements">
            <announcement-form v-ref:foo framework="foundation" authorid="{{$currentUser->id}}" recordexists="{{$announcement->exists ? true: false}}" editid="{{$announcement->exists ? $announcement->id : null }}">
              <input slot="csrf" type="hidden" name="_token" value="{{ csrf_token() }}">
            </announcement-form>
          </div><!-- /#vue-event-form -->
        </div><!-- /.medium-6 column -->
        <div class="medium-6 columns">

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
                  <tr>
                    <td>{{ $item->title }}</td>
                    <td>{{ $item->start_date }}</td>
                    <td>{{ $item->end_date }}</td>
                    <td>{{ $item->created_at }}</td>
                    <td class="editBtn" id="{{ $item->id }}"><a href="#">EDIT</a></td>
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
                  </tr>
                </thead>
                <tbody>
                  @foreach($approveditems as $item)
                  <tr>
                    <td>{{ $item->title }}</td>
                    <td>{{ $item->start_date }}</td>
                    <td>{{ $item->end_date }}</td>
                    <td>{{ $item->approved_date }}</td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div><!-- /.small-12 column -->
          </div><!-- /.row -->
          @endunless


        </div><!-- /.medium-6 columns -->
      </div><!-- /.row -->
    </div><!-- /.small-12 column -->
  </div><!-- /.row -->
</div><!-- /#calendar-bar -->
@endsection

@section('scriptsfooter')
@parent
<script type="text/javascript" src="/js/vue-announcement-form.js"></script>
@endsection
