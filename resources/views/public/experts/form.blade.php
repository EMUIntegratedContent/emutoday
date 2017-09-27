@extends('public.layouts.global')
<!-- Event Views with Vues -->
@section('styles')
@parent
<link rel="stylesheet" type="text/css" href="/css/flatpickr.min.css" />
@endsection

@section('title', 'Eastern Expert Form')
@section('content-top')
<div id="experts-area">
    
  <div class="row">
    <div class="large-12 medium-12 small-12 columns">
      @include('public.components.errors')
      <div class="row">
        <div class="large-3 medium-12 small-12 columns">
              @include('public.experts.subviews.expertnav')
        </div><!-- /.large-3 column -->
        <div class="large-5 medium-12 small-12 columns">
          <h1>Expert Form</h1>
          <div id="vue-experts-public">
              <expert-form-public
                v-ref:foo
                errors="{{ json_encode($errors) }}"
                framework="foundation"
                recordexists="{{$expert->exists ? true: false}}"
                editid="{{$expert->exists ? $expert->id : null }}">
                  <input slot="csrf" type="hidden" name="_token" value="{{ csrf_token() }}">
              </expert-form-public>
          </div><!-- /#vue-event-form -->
        </div><!-- /.large-6 column -->
        <div class="large-4 medium-12 small-12 columns" id="user-expert-tables">
@endsection
@section('content-middle')
          @unless(empty($expertSubmissions[0]))
              <h3 class="cal-caps toptitle">Submitted Experts</h3>
              <table id="user-experts-submitted-table" class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th class="text-left">Expert</th>
                    <th class="text-left">Title</th>
                    <th class="text-left">Submitted</th>
                    <th class="text-left">Status</th>
                    <th class="text-left">&nbsp;</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($expertSubmissions as $expert)
                    <tr id="{{ $expert->id }}">
                        <td>{{ $expert->first_name . ' ' . $expert->last_name }}</td>
                        <td>{{ $expert->title }}</td>
                        <td>{{ Carbon\Carbon::parse($expert->created_at)->format('M d, Y') }}</td>
                        <td>@if($expert->is_approved) Approved @else Pending @endif</td>
                        <td class="editBtn"><a href="#">EDIT</a></td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
          @endunless

@endsection
@section('content-bottom')

        </div><!-- /.large-3 columns -->
      </div><!-- /.row -->
    </div><!-- /.small-12 column -->
  </div><!-- /.row -->
</div><!-- /#calendar-bar -->
@endsection

@section('scriptsfooter')
@parent
<script src="/themes/plugins/ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="/js/vue-expert-form.js"></script>
@endsection
