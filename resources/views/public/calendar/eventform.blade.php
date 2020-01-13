<!-- Event Views with Vues -->
@extends('public.layouts.global')
@section('styles')
@parent
<link rel="stylesheet" type="text/css" href="/css/flatpickr.min.css" />
<style media="screen">
.flatpickr-calendar {
    visibility: hidden;
    width: auto !important;
}
</style>
@endsection

@section('title','Submit an Event')
@section('content-top')
<div id="calendar-bar">
  <div class="row">
    <div class="medium-12 column">
      @include('public.components.errors')
      <div class="row">
        <div class="medium-6 columns">
          <h3 class="cal-caps toptitle">Events Calendar</h3>
          <div id="vue-event-form">
            <event-form ref="eform" eventexists="{{$event->exists ? true: false}}" editeventid="{{$event->exists ? $event->id : null }}">
              <input slot="csrf" type="hidden" name="_token" value="{{ csrf_token() }}">
            </event-form>
          </div><!-- /#vue-event-form -->
        </div><!-- /.medium-6 column -->
        <div class="medium-6 columns" id="user-events-tables">
        @endsection

        @section('content-middle')
          @unless(empty($submitteditems[0]))
          <div class="row">
            <div class="small-12 column">
              <h3 class="cal-caps toptitle">Submitted Events</h3>
              <table id="user-events-submitted" class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th class="text-left">Title</th>
                    <th class="text-left">Start Date</th>
                    <th class="text-left">End Date</th>
                    <th class="text-left">Submitted</th>
                    <th class="text-left">&nbsp;</th>
                    <th class="text-left">&nbsp;</th>
                  </tr>
                </thead>
                <tbody>
                  @if(isset($submitteditems))
                  @foreach($submitteditems as $item)
                  <tr id="{{ $item->id }}">
                    <td>{{ $item->title }}</td>
                    <td>
                      {{ Carbon\Carbon::parse($item->start_date)->format('M d, Y') }}
                      @unless($item->start_time == null) -
                        {{ Carbon\Carbon::parse($item->start_time)->format('g:ia') }}
                      @endunless
                    </td>
                    <td>
                      {{ Carbon\Carbon::parse($item->end_date)->format('M d, Y') }}
                      @unless($item->end_time == null) -
                        {{ Carbon\Carbon::parse($item->end_time)->format('g:ia') }}
                      @endunless
                    </td>
                    <td>{{ Carbon\Carbon::parse($item->created_at)->format('M d, Y - g:ia') }}</td>
                    <td class="editBtn"><a href="#">EDIT</a></td>
                    @if($item->is_canceled == 1)
                    <!-- Do they need to ablity to cancel UNapproved events? Why bother approving a canceled event? -->
                    <td class="cancelBtn"><a href="#">UNCANCEL</a></td>
                    @else
                    <td class="cancelBtn"><a href="#">CANCEL</a></td>
                    @endif
                  </tr>
                  @endforeach
                  @endif
                </tbody>
              </table>
            </div><!-- /.small-12 column -->
          </div><!-- /.row -->
          @endunless

          @unless(empty($approveditems[0]))
          <div class="row">
            <div class="small-12 column">
              <h3 class="cal-caps toptitle">Approved Events</h3>
              <table style="max-width: 50%" id="user-events-approved" class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th class="text-left">Title</th>
                    <th class="text-left">Start Date</th>
                    <th class="text-left">End Date</th>
                    <th class="text-left">Approved</th>
                    <th class="text-left">&nbsp;</th>
                    <th class="text-left">&nbsp;</th>
                  </tr>
                </thead>
                <tbody>
                  @if(isset($approveditems))
                  @foreach($approveditems as $item)
                  <tr id="{{ $item->id }}">
                    <td>{{ $item->title }}</td>
                    <td>
                      {{ Carbon\Carbon::parse($item->start_date)->format('M d, Y') }}
                      @unless($item->start_time == null) -
                        {{ Carbon\Carbon::parse($item->start_time)->format('g:ia') }}
                      @endunless
                    </td>
                    <td>
                      {{ Carbon\Carbon::parse($item->end_date)->format('M d, Y') }}
                      @unless($item->end_time == null) -
                        {{ Carbon\Carbon::parse($item->end_time)->format('g:ia') }}
                      @endunless
                    </td>
                    <td>{{ Carbon\Carbon::parse($item->approved_date)->format('M d, Y') }}</td>
                    <td class="editBtn"><a href="#">EDIT</a></td>
                    @if($item->is_canceled == 1)
                    <td class="cancelBtn"><a href="#">UNCANCEL</a></td>
                    @else
                    <td class="cancelBtn"><a href="#">CANCEL</a></td>
                    @endif
                  </tr>
                  @endforeach
                  @endif
                </tbody>
              </table>
            </div><!-- /.small-12 column -->
          @endunless
          @endsection

          @section('content-bottom')
          </div><!-- /.row -->
        </div><!-- /.medium-6 columns -->
      </div><!-- /.row -->
    </div><!-- /.small-12 column -->
  </div><!-- /.row -->
</div><!-- /#calendar-bar -->
@endsection

@section('scriptsfooter')
@parent

<script type="text/javascript" src="/js/vue-event-form.js"></script>
@endsection
