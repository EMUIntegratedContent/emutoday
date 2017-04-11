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
    @if(Session::has('status'))
        <div class="row">
            <div class="col-sm-12">
                <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('status') }}</p>
            </div>
        </div>
    @endif
 <div class="row">
     <div class="col-md-6">
            <div class="box box-default">
                <div class="box-header with-border">
                    <h3 class="box-title">box-default</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                </div><!-- /.box-header -->
                <div class="box-body">

                    {{-- <table id="main-story-table" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                            <th class="text-center">ID</th>
                            <th class="text-left">Type</th>
                            <th class="text-left">Title</th>
                            <th class="text-center">Featured</th>
                            <th class="text-center">Approved</th>
                            <th class="text-left">Live</th>
                            <th class="text-left">Start Date</th>
                            <th class="text-left">End Date</th>
                            <th class="text-left">Edit</th>
                            <th class="text-left">Delete</th>
                        </tr>
                </thead>
            </table> --}}
            {{-- {!! $storys->render() !!} --}}
            {{-- {{ $storys->links() }} --}}
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
        </div>
    </div><!-- /.box -->

        </div><!-- /.col-md-6 -->
        <div class="col-md-6">
            <div class="box box-danger">
                        <div class="box-header">
                            <h3 class="box-title">box-danger</h3>
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="box-body">
                            <div class="box-body">
                                {{-- <table id="main-announcement-table" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                                <th class="text-center">ID</th>
                                                <th class="text-left">Title</th>
                                                <th class="text-center">Approved</th>
                                                    <th class="text-center">Promoted</th>
                                                    <th class="text-left">Start Date</th>
                                                    <th class="text-left">End Date</th>
                                                <th class="text-left">Edit</th>
                                                <th class="text-left">Delete</th>
                                        </tr>
                                    </thead>

                                </table> --}}
                                {{-- {!! $storys->render() !!} --}}
                                {{-- {{ $storys->links() }} --}}
                            </div>
                            <!-- /.box-body -->
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->

        </div><!-- /.col-md-6 -->
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
