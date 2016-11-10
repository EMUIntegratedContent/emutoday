@extends('admin.layouts.adminlte')
@section('title', 'Edit Page')
    @section('style-vendor')
        @parent
        <!-- iCheck for checkboxes and radio inputs -->
        <link rel="stylesheet" href="/themes/admin-lte/plugins/iCheck/all.css">
        <!-- Select2 -->
        <link rel="stylesheet" href="/themes/admin-lte/plugins/select2/select2.min.css">

        {{-- <link rel="stylesheet" href="/themes/plugins/eonasdan-bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css"> --}}
    @endsection

    @section('style-plugin')
        @parent
        <link rel="stylesheet" href="/css/my-redips.css" type="text/css" media="screen" />
        <link rel="stylesheet" href="/themes/plugins/flatpickr/flatpickr.min.css" type="text/css" media="screen" />
    @endsection
    @section('style-app')
            @parent
            {{-- <link rel="stylesheet" href="{{'/css/my-redips.css' }}" type="text/css" media="screen" /> --}}

        @endsection

            @section('scripts-vendor')
                <!-- Vendor Scripts that need to be loaded in the header before other plugin or app scripts -->
                @parent
            @endsection
            @section('scripts-plugin')
                <!-- Scripts  for code libraries and plugins that need to be loaded in the header -->
                    <script src="/themes/plugins/ckeditor/ckeditor.js"></script>
                    <script src="/themes/plugins/flatpickr/flatpickr.js"></script>
                @parent
            @endsection
            @section('scripts-app')
                <!-- App related Scripts  that need to be loaded in the header -->
                <script src="/js/redips-drag-min.js"></script>

                @parent
            @endsection
@section('content')
    <div class="row">
        {!! Form::model($page, [
            'method' =>  'put',
            'route' => ['admin.page.update', $page->id]
        ]) !!}
      {{ csrf_field() }}
        <div class="col-sm-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Edit Page Info</h3>
                    <div class="box-tools">
                        <div class="btn-toolbar btn-group-sm">
                    @if($page->is_ready === 0)
                        <button class="btn bg-orange btn-sm" disabled="disabled"><i class="fa fa-eye"></i></button>
                    @else
                        <a href="/preview/page/{{$page->id}}" class="btn bg-orange btn-sm"><i class="fa fa-eye"></i></a>
                    @endif
                    <a href="/admin/page/create" class="btn bg-orange"><i class="fa fa-plus-square"></i></a>
                    <a href="/admin/page" class="btn bg-orange"><i class="fa fa-list-alt"></i></a>
                </div><!-- /.btn-toolbar -->

            </div><!-- /.box-tools -->
                    {{-- @include('admin.layouts.components.boxtools', ['rte' => 'page', 'path' => 'admin/page/', 'cuser'=>$currentUser, 'id'=>$page->id]) --}}
                </div><!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                                {!! Form::label('template') !!}
                                {!! Form::text('template', $page->template, ['class' => 'form-control', 'readonly' => 'readonly']) !!}
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                {!! Form::label('uri') !!}
                                {!! Form::text('uri', null, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                {!! Form::label('start_date') !!}
                                {!! Form::text('start_date', null, ['class' => 'form-control', 'id'=> 'start-date']) !!}
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                    {!! Form::label('end_date') !!}
                                    {!! Form::text('end_date', null, ['class' => 'form-control', 'id'=> 'end-date']) !!}
                            </div>
                        </div>
                        <div class="col-md-1">
                            <div class="form-group">
                                    {!! Form::label('is_ready', 'ready') !!}
                                    <div class="radio">{!! Form::radio('is_ready', true ,null,['class' => 'form-control', 'id'=> 'is-ready']) !!}</div>
                                </div>

                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                      {!! Form::label('story_ids') !!}
                                      {!! Form::text('story_ids', null, ['id'=> 'story_ids',  'class' => 'form-control', 'readonly' => 'readonly']) !!}
                                </div>
                            </div>
                                <div class="col-md-1">
                                    <div class="form-group">
                                    <label>&nbsp;</label><br/>
                                      {!! Form::submit('Update', ['class' => 'btn btn-primary']) !!}
                                      {!! Form::close() !!}
                                </div>
                            </div>
                        </div><!-- ./row -->
                    </div><!-- /.box-body -->
                    <div class="box-footer">
                        <div class="form-group">


                        </div>
                    </div><!-- /.box-footer -->
                </div><!-- /.box -->
            </div>
    </div>
    <div class="row">
        <div class="col-md-12">

    <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">Page Builder</h3>
                <div class="box-tools">
                    <div class="btn-toolbar btn-group-sm">
                        @if($page->is_ready === 0)
                        <button class="btn bg-orange btn-sm" disabled="disabled"><i class="fa fa-eye"></i></button>
                        @else
                        <a href="/preview/page/{{$page->id}}" class="btn bg-orange btn-sm"><i class="fa fa-eye"></i></a>

                        @endif

                    </div><!-- /.btn-toolbar -->
                </div><!-- /.box-tools -->
            </div>
            <div class="box-body">
                @include('admin.page.templates.layoutindex')
    </div><!-- /.box-body -->

    <div class="box-footer">

    </div><!-- /.box-footer -->
</div><!-- /.box -->

</div><!-- /.col-md-12 -->
</div><!-- /.row -->
@endsection
@section('footer-vendor')

    @parent
@endsection

@section('footer-plugin')
    @parent
    <script src="/themes/admin-lte/plugins/select2/select2.full.min.js"></script>
    <!-- InputMask -->
    <script src="/themes/admin-lte/plugins/input-mask/jquery.inputmask.js"></script>
    <script src="/themes/admin-lte/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
    <script src="/themes/admin-lte/plugins/input-mask/jquery.inputmask.extensions.js"></script>
    <!-- date-range-picker -->
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script> --}}
    <!-- iCheck 1.0.1 -->
    <script src="/themes/admin-lte/plugins/iCheck/icheck.min.js"></script>

    {{-- <script src="/themes/plugins/eonasdan-bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js"></script> --}}


@endsection

@section('footer-app')
    @parent
      <script src="/js/pagebuild-redips.js"></script>
@endsection

@section('footer-script')
    @parent

    <script>

    $(function(){
        //Initialize Select2 Elements
        $(".select2").select2();


        $('input[type="radio"]').iCheck({
            checkboxClass: 'icheckbox_flat-blue',
            radioClass: 'iradio_flat-blue'
        })
        // $('#is-featured-no').iCheck('check');
        $('#is-ready').iCheck('disable');

        //iCheck for checkbox and radio inputs
        $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
            checkboxClass: 'icheckbox_minimal-blue',
            radioClass: 'iradio_minimal-blue'
        });
        //Red color scheme for iCheck
        $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
            checkboxClass: 'icheckbox_minimal-red',
            radioClass: 'iradio_minimal-red'
        });
        //Flat red color scheme for iCheck
        $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
            checkboxClass: 'icheckbox_flat-green',
            radioClass: 'iradio_flat-green'
        });

        // var check_in = $("#start-date").flatpickr({
        //             altInput: true,
        //             altFormat: "m-d-Y",
        //             minDate: new Date(),
        //             onChange: function(dateObj, dateStr, instance) {
        //                 check_out.set("minDate", dateObj.fp_incr(1));
        //             }
        //             });
        // var check_out = $("end-date").flatpickr({
        //            altInput: true,
        //               altFormat: "m-d-Y",
        //                  minDate: new Date(),
        //                  onChange: function(dateObj, dateStr, instance) {
        //                      check_in.set("maxDate", dateObj.fp_incr(-1));
        //                  }
        //              });
        // check_in.config.onChange = dateObj => check_out.set("minDate", dateObj.fp_incr(1));
        // check_out.config.onChange = dateObj => check_in.set("maxDate", dateObj.fp_incr(-1));
        //
        //

    });


    var check_in = document.getElementById("start-date").flatpickr({
                        altInput: true,
                        altInputClass: "form-control",
                        altFormat: "m-d-Y",
                        minDate: new Date(),
                        onChange: function(dateObj, dateStr, instance) {
                            check_out.set("minDate", dateObj.fp_incr(1));
                        }
                        });
    var check_out =document.getElementById("end-date").flatpickr({
                        altInput: true,
                          altFormat: "m-d-Y",
                          altInputClass: "form-control",
                             minDate: new Date(),
                             onChange: function(dateObj, dateStr, instance) {
                                 check_in.set("maxDate", dateObj.fp_incr(-1));
                             }
                         });

    </script>
@endsection
