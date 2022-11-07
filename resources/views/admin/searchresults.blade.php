@extends('admin.layouts.adminlte')

@section('title', 'Dashboard')
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
    <div class="row">
      <div id="vue-search-filter" class="col-md-12">
        <div class="box box-success box-solid">
          <ul id="search-filter-list" class="list-inline box-header with-border">
            <li class="btn btn-default { (Request::get('filter') === null || Request::get('filter') == 'all')? 'active' : '' }}"><a href="/admin/search?searchterm={{ $searchTerm }}&filter=all">All</a></li>
            <li class="btn btn-default {{ Request::get('filter') == 'stories' ? 'active' : '' }}"><a href="/admin/search?searchterm={{ $searchTerm }}&filter=stories">Stories</a></li>
            <li class="btn btn-default {{ Request::get('filter') == 'events' ? 'active' : '' }}"><a href="/admin/search?searchterm={{ $searchTerm }}&filter=events">Events</a></li>
            <li class="btn btn-default {{ Request::get('filter') == 'announcements' ? 'active' : '' }}"><a href="/admin/search?searchterm={{ $searchTerm }}&filter=announcements">Announcements</a></li>
            <li class="btn btn-default {{ Request::get('filter') == 'magazine' ? 'active' : '' }}"><a href="/admin/search?searchterm={{ $searchTerm }}&filter=magazine">Magazine</a></li>
            <li class="btn btn-default {{ Request::get('filter') == 'experts' ? 'active' : '' }}"><a href="/admin/search?searchterm={{ $searchTerm }}&filter=experts">Experts</a></li>
          </ul>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-12">
        <div class="box box-success box-solid">
          @if($numResults > 0)
          <div class="box-header with-border">
            <h3 class="box-title">Found {!! $numResults !!} Results</h3>
          </div>
          <div>
            <div class="list-group">
              @foreach($storiesPaginated as $searchResult)
              <div class="list-group-item">
                @if($searchResult->getTable() == 'storys')
                <a class="list-group-item-heading" href="/admin/{{$searchResult->id}}/story/{{$searchResult->story_type}}/{{$searchResult->id}}/edit">
                  <h5>{{$searchResult->title}}</h5></a>
                  <div class="list-group-item-text">
                    @if($searchResult->subtitle)
                    <p>{{ $searchResult->subtitle }}</p>
                    @endif
                    <p>{!! $searchResult->teaser !!}</p>
                  </div>
                  @elseif($searchResult->getTable() == 'cea_events')
                  <a class="list-group-item-heading" href="/admin/event/{{$searchResult->id}}/edit"><h5>{{$searchResult->title}}</h5></a>
                  <div class="list-group-item-text">
                    @if($searchResult->description)
                    <p>{{ $searchResult->description }}</p>
                    @endif
                  </div>
                  @elseif($searchResult->getTable() == 'announcements')
                  <a class="list-group-item-heading" href="/admin/announcement/{{$searchResult->id}}/edit"><h5>{{$searchResult->title}}</h5></a>
                  <div class="list-group-item-text">
                    @if($searchResult->announcement)
                    <p>{{ $searchResult->announcement }}</p>
                    @endif
                  </div>
                  @endif
                </div>
                @endforeach
                <div class="box-footer">
                  <h6 class="text-center">{!! $storiesPaginated->links() !!}</h6>
                </div><!-- /.box-footer -->
              </div>
              @else
              <div class="callout alert">
                <p>No matching results. Try again.</p>
              </div>
              @endif
          </div>
        </div>
      </div>
    </div>
    @endsection

@section('footer-vendor')
    @parent
    {{-- <!-- jQuery 2.2.0 -->
    <script src="/themes/admin-lte/plugins/jQuery/jQuery-2.2.0.min.js"></script>
    <!-- Bootstrap 3.3.6 -->
    <script src="/themes/admin-lte/bootstrap/js/bootstrap.min.js"></script> --}}
@endsection
@section('footer-plugin')
    @parent
    <!-- AdminLTE App -->
    {{-- <script src="/themes/admin-lte/js/app.min.js"></script> --}}
    <!-- AdminLTE for demo purposes -->
    {{-- <script src="/themes/admin-lte/js/demo.js"></script> --}}
@endsection
@section('footer-app')
    @parent
    {{-- <script src="/js/vue-drag.js"></script> --}}
@endsection
@section('footer-script')
    @parent
    <!-- Page script -->

@endsection
