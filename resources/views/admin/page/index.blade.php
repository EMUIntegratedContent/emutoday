@extends('admin.layouts.adminlte')

@section('title', 'View Pages')
@section('style-plugin')
    @parent
    <link rel="stylesheet" href="/themes/admin-lte/plugins/datatables/dataTables.bootstrap.css">
@endsection
@section('scripthead')
@show
@include('include.js')
@section('content')
    @include('admin.components.modal')
    <!-- Main content -->
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Hub</h3>
                    @include('admin.components.boxtools', ['rte' => 'page', 'path' => 'admin/page'])
                </div>
            </div><!-- /.box -->
        </div><!-- /.col-md-12 -->
    </div><!-- /.row -->
    <div class="row">
        <div class="col-md-6">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Not Ready: <small><em>These Pages are missing critical items and/or
                                assets</em></small></h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                                title="" data-original-title="Collapse">
                            <i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body no-padding">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th class="text-center">id</th>
                            <th class="text-left">Start Date</th>
                            <th class="text-left">End Date</th>
                            <th class="text-center"><span class="fa fa-calendar" aria-hidden="true"></span></th>
                            <th class="text-center"><span class="fa fa-pencil" aria-hidden="true"></span></th>
                            <th class="text-center"><span class="fa fa-trash" aria-hidden="true"></span></th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(isset($pages_notready_current))
                            @foreach($pages_notready_current as $page)
                                <tr class="{{ $page->present()->pageScheduleStatus }}">
                                    <td class="text-center">{{ $page->id }}</td>
                                    <td>{{ $page->present()->prettyStartDate }}</td>
                                    <td>{{ $page->present()->prettyEndDate }}</td>
                                    <td class="text-center"><small>{{ $page->present()->pageLiveIn }}</small></td>
                                    <td class="text-center">
                                        <a href="{{ route('admin_page_edit', $page->id) }}">
                                            <span class="fa fa-pencil" aria-hidden="true"></span>
                                        </a>
                                    </td>
                                    <td class="text-center">
                                        <a href="/admin/page/destroy/{{ $page->id }}">
                                            <span class="fa fa-trash" aria-hidden="true"></span>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        @endif

                        </tbody>
                    </table>
                </div>
                <div class="box-footer">

                </div><!-- /.box-footer -->
                <!-- /.box-body -->
            </div><!-- /.box -->
        </div><!-- /.col-md-6 -->
        <div class="col-md-6">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Ready: <small><em>These Pages have all necessary assets and will go live
                                depending on start and end dates</em></small></h3>


                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                                title="" data-original-title="Collapse">
                            <i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body no-padding">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th class="text-center">id</th>
                            <th class="text-left">Start Date</th>
                            <th class="text-left">End Date</th>
                            <th class="text-center"><span class="fa fa-calendar" aria-hidden="true"></span></th>
                            <th class="text-center"><span class="fa fa-eye" aria-hidden="true"></span></th>
                            <th class="text-center"><span class="fa fa-pencil" aria-hidden="true"></span></th>
                            <th class="text-center"><span class="fa fa-trash" aria-hidden="true"></span></th>

                        </tr>
                        </thead>
                        <tbody>
                        @if(isset($pages_ready_current))
                            @foreach($pages_ready_current as $page)
                                <tr class="{{ $page->present()->pageScheduleStatus }}">
                                    <td class="text-center">{{ $page->id }}</td>
                                    <td>{{ $page->present()->prettyStartDate }}</td>
                                    <td>{{ $page->present()->prettyEndDate }}</td>
                                    <td class="text-center"><small>{{ $page->present()->pageLiveIn }}</small></td>
                                    <td class="text-center">
                                        <a href="{{ route('preview_hub', $page->id) }}">
                                            <span class="fa fa-eye" aria-hidden="true"></span>
                                        </a>
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('admin_page_edit', $page->id) }}">
                                            <span class="fa fa-pencil" aria-hidden="true"></span>
                                        </a>
                                    </td>
                                    <td class="text-center">
                                        <a href="/admin/page/destroy/{{ $page->id }}">
                                            <span class="fa fa-trash" aria-hidden="true"></span>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        @endif

                        </tbody>
                    </table>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">

                </div><!-- /.box-footer -->
            </div><!-- /.box -->
        </div><!-- /.col-md-6 -->
    </div><!-- /.row -->
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Legend: </h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                                title="" data-original-title="Collapse">
                            <i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body">
                    <table class="table table-bordered">
                        <tr></tr>
                        <tr>
                            <td class="text-right">Row colors:</td>
                            <td class="warning text-center"><small>Page with upcoming start date </small></td>
                            <td class="success text-center"><small>Current Page Live on site</small></td>
                            <td class="active text-center"><small>Page is no longer active</small></td>
                            <td class="text-center"><span class="fa fa-calendar" aria-hidden="true"></span></td>

                        </tr>
                        <tr></tr>
                    </table>
                </div><!-- /.box-body -->

            </div><!-- /.box -->
        </div><!-- /.col-md-12 -->
    </div><!-- /.row -->

    <div class="row">
        <div class="col-md-6">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Not Ready &amp; Past: <small><em>The Pages are missing critical assets and
                                start and end dates have passed</em></small></h3>


                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                                title="" data-original-title="Collapse">
                            <i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body no-padding">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th class="text-center">id</th>
                            <th class="text-left">Start Date</th>
                            <th class="text-left">End Date</th>
                            <th class="text-center"><span class="fa fa-calendar-times-o" aria-hidden="true"></span></th>
                            <th class="text-center"><span class="fa fa-pencil" aria-hidden="true"></span></th>
                            <th class="text-center"><span class="fa fa-trash" aria-hidden="true"></span></th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(isset($pages_notready_past))
                            @foreach($pages_notready_past as $page)
                                <tr class="{{ $page->present()->pageScheduleStatus }}">
                                    <td class="text-center">{{ $page->id }}</td>
                                    <td>{{ $page->present()->prettyStartDate }}</td>
                                    <td>{{ $page->present()->prettyEndDate }}</td>
                                    <td class="text-center"><small>{{ $page->present()->pageLiveIn }}</small></td>

                                    <td class="text-center">
                                        <a href="{{ route('admin_page_edit', $page->id) }}">
                                            <span class="fa fa-pencil" aria-hidden="true"></span>
                                        </a>
                                    </td>
                                    <td class="text-center">
                                        <a href="/admin/page/destroy/{{ $page->id }}">
                                            <span class="fa fa-trash" aria-hidden="true"></span>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        @endif

                        </tbody>
                    </table>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    {{ $pages_notready_past->appends(
                        [
                          'notready_current' => $pages_notready_current->currentPage(),
                          'ready_current' => $pages_ready_current->currentPage(),
                          'ready_past' => $pages_ready_past->currentPage()
                        ]
                      )->links() }}
                </div><!-- /.box-footer -->
            </div><!-- /.box -->
        </div><!-- /.col-md-6 -->
        <div class="col-md-6">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Past: <small><em>These Pages have already gone live and are no logner
                                active</em></small></h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                                title="" data-original-title="Collapse">
                            <i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body no-padding">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th class="text-center">id</th>
                            <th class="text-left">Start Date</th>
                            <th class="text-left">End Date</th>
                            <th class="text-center"><span class="fa fa-calendar-times-o" aria-hidden="true"></span></th>
                            <th class="text-center"><span class="fa fa-eye" aria-hidden="true"></span></th>
                            <th class="text-center"><span class="fa fa-pencil" aria-hidden="true"></span></th>
                            <th class="text-center"><span class="fa fa-trash" aria-hidden="true"></span></th>

                        </tr>
                        </thead>
                        <tbody>
                        @if(isset($pages_ready_past))
                            @foreach($pages_ready_past as $page)
                                <tr class="{{ $page->present()->pageScheduleStatus }}">
                                    <td class="text-center">{{ $page->id }}</td>
                                    <td>{{ $page->present()->prettyStartDate }}</td>
                                    <td>{{ $page->present()->prettyEndDate }}</td>
                                    <td class="text-center"><small>{{ $page->present()->pageLiveIn }}</small></td>
                                    <td class="text-center">
                                        <a href="{{ route('preview_hub', $page->id) }}">
                                            <span class="fa fa-eye" aria-hidden="true"></span>
                                        </a>
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('admin_page_edit', $page->id) }}">
                                            <span class="fa fa-pencil" aria-hidden="true"></span>
                                        </a>
                                    </td>
                                    <td class="text-center">
                                        <a href="/admin/page/destroy/{{ $page->id }}">
                                            <span class="fa fa-trash" aria-hidden="true"></span>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        @endif

                        </tbody>
                    </table>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    {{ $pages_ready_past->appends(
                        [
                          'notready_current' => $pages_notready_current->currentPage(),
                          'ready_current' => $pages_ready_current->currentPage(),
                          'notready_past' => $pages_notready_past->currentPage()
                        ]
                      )->links() }}
                </div><!-- /.box-footer -->
            </div><!-- /.box -->
        </div><!-- /.col-md-6 -->
    </div><!-- /.row -->
@endsection
@section('footer-plugin')
    @parent
    <!-- SlimScroll -->
    <script src="/themes/admin-lte/plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src="/themes/admin-lte/plugins/fastclick/fastclick.js"></script>
@endsection

@section('footer-script')
    @parent
    <script>
			$(function () {

			});
    </script>
@endsection
