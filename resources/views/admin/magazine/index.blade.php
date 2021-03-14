@extends('admin.layouts.adminlte')

@section('title', 'View Magazine')
@section('style-plugin')
@parent

<link rel="stylesheet" href="/themes/admin-lte/plugins/datatables/dataTables.bootstrap.css">

@endsection
@section('scripthead')
{{-- @include('admin.layouts.scriptshead') --}}
{{-- <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script> --}}
@show
@include('include.js')
@section('content')
@include('admin.components.modal')
<!-- Main content -->
<div class="row">
  <div class="col-md-12">
    <div class="box">
      <div class="row">
        <div class="col-md-12">
          <div class="box-header with-border">
            <h3 class="box-title">Magazine</h3>
            @include('admin.components.boxtools', ['rte' => 'magazine', 'path' => 'admin/magazine'])
          </div>
          {{-- <div class="box-body">

          </div><!-- /.box-body --> --}}

        </div><!-- /.col-md-12 -->
      </div><!-- /.row -->


      <div class="row">

        <div class="col-md-6">
          <div class="box-header with-border">
            <h3 class="box-title">Incomplete</h3>
          </div>
          <div class="box-body no-padding">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th class="text-center">id</th>

                  <th class="text-left">Title</th>
                  <th class="text-left">Start Date</th>
                  <th class="text-left">End Date</th>
                  <th class="text-left">Live In</th>

                  <th class="text-center"><span class="fa fa-pencil" aria-hidden="true"></span></th>
                  <th class="text-center"><span class="fa fa-trash" aria-hidden="true"></span></th>
                </tr>
              </thead>
              <tbody>
                @if(isset($magazines_incomplete))
                @foreach($magazines_incomplete as $magazine)
                <tr class="{{ $magazine->present()->magazineScheduleStatus }}">
                  <td class="text-center">{{ $magazine->id }}</td>
                  <td>{{ $magazine->title }} @if($magazine->is_archived == 1)<span class="archived-magazine">&#8211; Archived</span>@endif</td>
                  <td>{{ $magazine->present()->prettyStartDate }}</td>
                  <td>{{ $magazine->present()->prettyEndDate }}</td>
                  <td>{{ $magazine->present()->magazineLiveIn }}</td>

                  <td class="text-center">
                    <a href="/admin/magazine/{{$magazine->id}}/edit">
                      <span class="fa fa-pencil" aria-hidden="true"></span>
                    </a>
                  </td>
                  <td class="text-center">
                    <a href="/admin/magazine/delete/{{$magazine->id}}">
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
        </div><!-- /.col-md-6 -->
        <div class="col-md-6">
          <div class="box-header with-border">
            <h3 class="box-title">Complete</h3>
          </div>
          <div class="box-body no-padding">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th class="text-center">id</th>

                  <th class="text-left">Title</th>
                  <th class="text-left">Start Date</th>
                  <th class="text-left">End Date</th>
                  <th class="text-left">Live In</th>


                  <th class="text-center"><span class="fa fa-eye" aria-hidden="true"></span></th>
                  <th class="text-center"><span class="fa fa-pencil" aria-hidden="true"></span></th>
                  <th class="text-center"><span class="fa fa-trash" aria-hidden="true"></span></th>

                </tr>
              </thead>
              <tbody>
                @if(isset($magazines_complete))

                @foreach($magazines_complete as $magazine)
                <tr class="{{ $magazine->present()->magazineScheduleStatus }}">

                  <td class="text-center">{{ $magazine->id }}</td>
                  <td>{{ $magazine->title }} @if($magazine->is_archived == 1)<span class="archived-magazine">&#8211; Archived</span>@endif</td>
                  <td>{{ $magazine->present()->prettyStartDate }}</td>
                  <td>{{ $magazine->present()->prettyEndDate }}</td>
                  <td>{{ $magazine->present()->magazineLiveIn }}</td>

                  <td class="text-center">
                    <a href="{{ route('preview_magazine', $magazine->id) }}">
                      <span class="fa fa-eye" aria-hidden="true"></span>
                    </a>
                  </td>
                  <td class="text-center">
                    <a href="/admin/magazine/{{$magazine->id}}/edit">
                      <span class="fa fa-pencil" aria-hidden="true"></span>
                    </a>
                  </td>
                  <td class="text-center">
                    <a href="{{ route('admin_magazine_delete', $magazine->id) }}">
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
        </div><!-- /.col-md-6 -->
      </div><!-- /.row -->
      <div class="row">
        <div class="col-md-12">
          <div class="box-footer">

          </div><!-- /.box-footer -->

        </div><!-- /.col-md-12 -->
      </div><!-- /.row -->
    </div>
    <!-- /.box -->
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
$(function () {});
</script>

@endsection
