@extends('admin.layouts.adminlte')
@section('title', 'Announcemnt Archives')
@section('style-vendor')
    @parent
@endsection
@section('style-plugin')
    @parent
    @endsection
    @section('style-app')
        @parent
        @endsection
        @section('scripthead')
        @parent
    @endsection
@section('content')
{{--
    <div class="row">
        <div class="col-xs-12">
          <div id="vue-announcement-archive-queue">
            <announcement-archive-queue atype="{{$atype}}" cuser="{{$currentUser}}">
            </announcement-archive-queue>
          </div><!-- /.vue-announcement-app -->
        </div>
    </div><!-- /.row -->
--}}
@if(Session::has('success_message'))
<p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('success_message') }}  <a href="/admin/announcement/{{ Session::get('success_message_unarchived_id')}}/edit">View</a>.</p>
@endif
@if(Session::has('failure_message'))
<p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('failure_message') }}</p>
@endif

    <div class="row">
        <div class="col-xs-12">
            <h3>Archived Announcements</h3>
            <table class="table">
              <thead>
                <tr>
                  <th>Start Date</th>
                  <th>Title</th>
                  <th>Date Submitted</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
              @foreach ($announcements as $announcement)
                  <tr>
                      <td>{{ Carbon\Carbon::parse($announcement->start_date)->format('M d \'y') }}</td>
                      <td>
                          <div class="row">
                              <div class="col-xs-12">
                                  <h4>{{ $announcement->title }}</h4>
                              </div>
                          </div>
                          <div class="row">
                              <div class="col-xs-12">
                                  {{ $announcement->announcement }}
                              </div>
                          </div>
                      </td>
                      <td>{{ Carbon\Carbon::parse($announcement->submission_date)->format('M d \'y') }}</td>
                      <td>
                          <div class="btn-group" role="group" aria-label="...">
                              <a href="/admin/announcement/{{ $announcement->id }}/unarchive" type="button" class="btn btn-default editBtn" aria-label="Unarchive Record"><i class="fa fa-caret-square-o-up"></i></a>
                              <a href="/admin/announcement/{{ $announcement->id }}/edit" type="button" class="btn btn-default editBtn" aria-label="Edit Record"><i class="fa fa-pencil"></i></a>
                              <a href="/admin/announcement/{{ $announcement->id }}/delete" type="button" class="btn btn-default editBtn" aria-label="Delete Record"><i class="fa fa-trash"></i></a>
                          </div>
                      </td>
                  </tr>
              @endforeach
             </tbody>
            </table>
              {{ $announcements->links() }}
        </div>
    </div><!-- /.row -->

@endsection
@section('footer-vendor')
    @parent
@endsection

@section('footer-plugin')
    @parent

    @endsection

    @section('footer-app')
    @parent
    @endsection
@section('footer-script')
        @parent
        <script type="text/javascript" src="/js/vue-announcement-archive-queue.js"></script>
        <script>
        </script>
    @endsection
