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

{{-- GOOGLE ANALYTICS PLUGIN THROWING EXCESS USER ERROR 5/2
 <div class="row">
   @can('admin', $currentUser)
     <div class="col-md-6">
        <div class="box box-default">
          <div class="box-header with-border">
            <h3 class="box-title">Top 20 page views (last 3 months)</h3>
            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
          </div><!-- /.box-header -->
          <div class="box-body">
            <ul class="list-group">
              @foreach($mostVisitedLast3Months as $item)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                  <a href="{{ $item['url'] }}">{{ $item['pageTitle'] }}</a>
                  <span class="badge badge-primary badge-pill">{{ number_format($item['pageViews']) }}</span>
                </li>
              @endforeach
            </ul>
          </div>
          <!-- /.box-body -->
          <div class="box-footer">
          </div>
        </div><!-- /.box -->
    </div><!-- /.col-md-6 -->
    <div class="col-md-6">
      <div class="box box-danger">
        <div class="box-header">
            <h3 class="box-title">Top 20 referrers (last 3 months)</h3>
            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
        </div>
        <div class="box-body">
            <div class="box-body">
              <ul class="list-group">
                @foreach($topReferrersLast3Months as $item)
                  <li class="list-group-item d-flex justify-content-between align-items-center">
                    <a href="{{ $item['url'] }}">{{ $item['url'] }}</a>
                    <span class="badge badge-primary badge-pill">{{ number_format($item['pageViews']) }}</span>
                  </li>
                @endforeach
              </ul>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div><!-- /.col-md-6 -->
   @else
     <div class="col-sm-12">
       <p class="text-center"><img src="{{ url('/assets/imgs/emu-today/thats-true-lg.png') }}" alt="That's TRUE logo" /></p>
     </div>
   @endcan
  </div><!-- /.row -->
--}}
<div class="row">
  <div class="col-xs-12">
    <p>Something is wrong with the Google Analytics plugin on this page. Here's a filler paragraph in the meantime. Have a nice day!</p>
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
