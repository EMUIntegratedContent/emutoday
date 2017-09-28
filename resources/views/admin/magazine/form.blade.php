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
                </div>	<!-- /.box-header -->
                <div class="box-body">
        {!! Form::model($magazine, [
            'method' =>  'POST',
            'route' => ['admin_magazine_store']
        ]) !!}
        <div class="form-group">
            {!! Form::label('year') !!}
                {{-- {!! Form::select('year', $yearList::all(), 0) !!} --}}
                {!! Form::select('year', $yearList::all(), 0, ['class' => 'form-control']) !!}
        </div>
  <div class="form-group">
            {!! Form::label('season') !!}
                {!! Form::select('season', $seasonList::all(), 0,['class' => 'form-control']) !!}
            </div>

    <div class="form-group">
        {!! Form::label('title') !!}
        {!! Form::text('title', null, ['class' => 'form-control']) !!}
    </div>
        <div class="form-group">
                {!! Form::label('subtitle') !!}
                {!! Form::text('subtitle', null, ['class' => 'form-control']) !!}
        </div>
    <div class="form-group">
        {!! Form::label('teaser') !!}
        {!! Form::text('teaser', null, ['class' => 'form-control']) !!}
    </div>
    </div><!-- /.box-body -->
    <div class="box-footer">
        {!! Form::submit('Create New Magazine', ['class' => 'btn btn-primary']) !!}

        {!! Form::close() !!}
    </div><!-- /.box-footer -->
    </div><!-- /.box -->
</div><!-- /.row -->
@endsection
@section('scriptsfooter')
    @parent
    <script>

    </script>
@endsection
