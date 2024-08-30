@inject('yearList', 'Emutoday\Http\Utilities\YearList')
@inject('seasonList', 'Emutoday\Http\Utilities\SeasonList')
@extends('admin.layouts.adminlte')
@section('title', 'Create New Magazine')
@section('style-plugin')
  @parent
  <link rel="stylesheet" href="/themes/admin-lte/plugins/iCheck/all.css">
  <link rel="stylesheet" href="/themes/admin-lte/plugins/select2/select2.min.css">
@endsection
@section('scripthead')
  @parent
@endsection
@section('content')
  <div class="row">
    <div class="col-md-6">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">{{$magazine->exists ? 'Edit Magazine' : 'New Magazine'}}</h3>
          @include('admin.components.boxtools', ['rte' => 'magazine', 'path' => 'admin/magazine'])
        </div>  <!-- /.box-header -->
        <div class="box-body">
          {!! html()->modelForm($magazine, 'POST', route('admin_magazine_store'))->open() !!}

          <div class="form-group">
            {!! html()->label('Year', 'year') !!}
            {!! html()->select('year', $yearList::all(), 0)->class('form-control') !!}
          </div>
          <div class="form-group">
            {!! html()->label('Season', 'season') !!}
            {!! html()->select('season', $seasonList::all(), 0)->class('form-control') !!}
          </div>

          <div class="form-group">
            {!! html()->label('Title', 'title') !!}
            {!! html()->text('title')->class('form-control') !!}
          </div>
          <div class="form-group">
            {!! html()->label('Subtitle', 'subtitle') !!}
            {!! html()->text('subtitle')->class('form-control') !!}
          </div>
          <div class="form-group">
            {!! html()->label('Teaser', 'teaser') !!}
            {!! html()->text('teaser')->class('form-control') !!}
          </div>
        </div><!-- /.box-body -->
        <div class="box-footer">
          {!! html()->submit('Create New Magazine')->class('btn btn-primary') !!}
          {!! html()->form()->close() !!}
        </div><!-- /.box-footer -->
      </div><!-- /.box -->
    </div><!-- /.col-md-6 -->
  </div><!-- /.row -->
    @endsection
    @section('scriptsfooter')
      @parent
      <script>

      </script>
@endsection
