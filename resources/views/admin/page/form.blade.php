@inject('pageTemplates', 'Emutoday\Http\Utilities\PageTemplates')
<!-- inject('storytypes', 'emutoday\Http\Utilities\StoryTypes') -->
    @extends('admin.layouts.adminlte')
    @section('title', 'Create New Hub Page')
        @section('style-plugin')
            @parent
            <!-- daterange picker -->
    <link rel="stylesheet" href="/themes/admin-lte/plugins/daterangepicker/daterangepicker-bs3.css">
    <!-- bootstrap datepicker -->
    <link rel="stylesheet" href="/themes/admin-lte/plugins/datepicker/datepicker3.css">
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="/themes/admin-lte/plugins/iCheck/all.css">
    <!-- Bootstrap Color Picker -->
    <link rel="stylesheet" href="/themes/admin-lte/plugins/colorpicker/bootstrap-colorpicker.min.css">
    <!-- Bootstrap time Picker -->
    <link rel="stylesheet" href="/themes/admin-lte/plugins/timepicker/bootstrap-timepicker.min.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="/themes/admin-lte/plugins/select2/select2.min.css">

    <link rel="stylesheet" href="/themes/plugins/eonasdan-bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css">

    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="/themes/admin-lte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
        @endsection

    @section('content')
        <section class="content">
            <div class="row">
                <div class="box box-primary">
        {!! Form::model($page, [
            'method' =>  'post',
            'route' => ['admin.page.store']
        ]) !!}
        {{ csrf_field() }}
        <div class="box-header with-border">
                <h3 class="box-title">Create New Hub Page </h3>
                @include('admin.components.boxtools', ['rte' => 'page', 'path' => 'admin/page/' , 'cuser'=>$currentUser, 'id'=>$page->id ])

        </div> 	<!-- /.box-header -->
        <div class="box-body">
            <div class="form-group">
                {!! Form::label('template') !!}
                {!! Form::select('template', $pageTemplates::all(), 0) !!}
            </div>
                <div class="form-group">
                {!! Form::label('uri') !!}
                {!! Form::text('uri', null, ['class' => 'form-control']) !!}
            </div>
        <div class="form-group">
                {!! Form::label('start_date') !!}
                {!! Form::text('start_date', null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
                {!! Form::label('end_date') !!}
                {!! Form::text('end_date', null, ['class' => 'form-control']) !!}
        </div>
                <div class="form-group">
                {!! Form::label('Active?') !!}
                {!! Form::label('is_active', 'yes') !!}{!! Form::radio('is_active', 1, null) !!}
                {!! Form::label('is_active', 'no') !!}{!! Form::radio('is_active', 0, null) !!}
              </div>

            </div><!-- /box-body -->

        {!! Form::submit('Create New Story', ['class' => 'btn btn-primary']) !!}

        {!! Form::close() !!}
            </div>
    </div> <!-- END Row top page input -->
@endsection
@section('scriptsfooter')
    @parent
    <script>
    $(function(){
        $('#start_date').fdatepicker({
            format: 'yyyy-mm-dd hh:ii:ss',
            disableDblClickSelection: true,
            language: 'en',
            pickTime: true
        });
        $('#end_date').fdatepicker({
            format: 'yyyy-mm-dd hh:ii:ss',
            disableDblClickSelection: true,
            language: 'en',
            pickTime: true
        });


    });
    </script>
@endsection
