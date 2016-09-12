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
            <div class="col-md-12">
                <div id="search-result-box-story" class="box box-success box-solid">
            <div class="box-header with-border">
                      <h3 class="box-title">Story Search Results: <span class="smaller-title">{!! $searchStorys->total() !!} Records</span></h3>
                      <div class="box-tools">
                          <div class="btn-toolbar">


                        <form action="search" method="GET" class="input-group input-group-sm" style="width: 200px;">
                          <input type="text" class="form-control pull-right" name="searchterm" value="{{$searchTerm}}">

                          <div class="input-group-btn">
                            <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                          </div>
                      </form>
                      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                      </button>
                      </div>
                      </div>
                  </div>
                    <!-- /.box-header -->

                    <div class="box-body">
                        <div  class="list-group">
                            @foreach($searchStorys as $searchStory)
                                <div class="list-group-item">
                                <a href="/admin/story/{{$searchStory->id}}">
                                    <h4 class="list-group-item-heading">{{$searchStory->title}}</h4></a>
                                    <p class="list-group-item-text">
                                        {!! $searchStory->teaser !!}
                                    </p>
                                </div>

                                @endforeach
                            </div>
                            <!-- /.list-group -->
                        </div>
                        <!-- /.box-body -->
                    <div class="box-footer">
                        <h6 class="text-center">{!! $searchStorys->links() !!}</h6>
                    </div><!-- /.box-footer -->
                </div>
                <!-- /.box -->

            </div><!-- /.col-md-12 -->
            <div class="col-md-12">
                <div id="search-result-box-event" class="box box-success box-solid">

            <div class="box-header with-border">
                      <h3 class="box-title">Event Search Results: <span class="smaller-title">{!! $searchEvents->total() !!} Records</span></h3>
                      <div class="box-tools">
                        <form action="search" method="GET" class="input-group input-group-sm" style="width: 200px;">
                          <input type="text" class="form-control pull-right" name="searchterm" value="{{$searchTerm}}">

                          <div class="input-group-btn">
                            <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                          </div>
                      </form>
                      </div>
                    </div>
                    <!-- /.box-header -->

                    <div class="box-body">
                        <div  class="list-group">
                            @foreach($searchEvents as $searchEvent)
                                <div class="list-group-item">
                                <a href="/admin/event/{{$searchEvent->id}}">
                                    <h4 class="list-group-item-heading">{{$searchEvent->title}}</h4></a>
                                    <p class="list-group-item-text">
                                        {{ $searchEvent->location }}
                                    </p>
                                    <p class="list-group-item-text">
                                        {!!$searchEvent->description!!}
                                    </p>
                                </div>

                                @endforeach
                            </div>
                            <!-- /.list-group -->
                        </div>
                        <!-- /.box-body -->
                    <div class="box-footer">
                        <h6 class="text-center">{!! $searchEvents->links() !!}</h6>
                    </div><!-- /.box-footer -->
                </div>
                <!-- /.box -->

            </div><!-- /.col-md-12 -->
            <div class="col-md-12">
                <div id="search-result-box-announcement" class="box box-success box-solid">
            <div class="box-header with-border">
                      <h3 class="box-title">Announcement Search Results: <span class="smaller-title">{!! $searchAnnouncements->total() !!} Records</span></h3>
                      <div class="box-tools">
                        <form action="search" method="GET" class="input-group input-group-sm" style="width: 200px;">
                          <input type="text" class="form-control pull-right" name="searchterm" value="{{$searchTerm}}">

                          <div class="input-group-btn">
                            <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                          </div>
                      </form>
                      </div>
                    </div>
                    <!-- /.box-header -->

                    <div class="box-body">
                        <div  class="list-group">
                            @foreach($searchAnnouncements as $searchAnnouncement)
                                <div class="list-group-item">
                                    <a href="/admin/announcement/{{$searchAnnouncement->id}}">
                                    <h4 class="list-group-item-heading">{{$searchAnnouncement->title}}</h4></a>
                                    <p class="list-group-item-text">{!!$searchAnnouncement->announcement!!}</p>
                                </div>
                                @endforeach
                            </div>
                            <!-- /.list-group -->
                        </div>
                        <!-- /.box-body -->
                    <div class="box-footer">
                        <h6 class="text-center">{!! $searchAnnouncements->links() !!}</h6>
                    </div><!-- /.box-footer -->
                </div>
                <!-- /.box -->

            </div><!-- /.col-md-12 -->
</div><!-- /.row -->



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
