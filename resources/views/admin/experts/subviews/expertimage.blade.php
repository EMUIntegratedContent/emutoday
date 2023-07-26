<div class="box box-primary">
    {!! Form::model($expertImage,[
        'method' => 'patch',
        'route' => ['admin_expertimage_update', $expertImage->id],
        'files' => true
    ]) !!}

    {{ Form::hidden('img_type', 'headshot', array('id' => 'img_type')) }}


        <div class="box-header with-border">
            <div class="box-head-info pull-left">
                @if($expertImage->is_active != 0)
                    <img class="better-thumb" src="/imagecache/expertthumb/{{$expertImage->filename}}" alt="{{$expertImage->image_name}}">
                @endif
                <h3 class="box-title">Profile Image</h3>
            </div><!-- /.box-head-info -->
            <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse">
              <i class="fa fa-minus"></i></button>
          </div>
        </div><!-- /.box-header -->
        <div class="box-body">
            {!! Form::hidden('image_name', null, ['class' => 'form-control', 'readonly' => 'readonly']) !!}

        <div class="form-group">
            <label class="control-label" for="image">Select File (max size {{ ini_get('upload_max_filesize') }})</label>
            {!! Form::file('image', null, array('required', 'class'=>'form-control input-sm')) !!}
            <span class="help-block">Upload a photo (Width: 800px | Height: 1000px | Resolution: 72ppi). MUST be a 4:5 width to height ratio!</span>
        </div>

        <div class="form-group">
          {!! Form::label('title', 'Title/Header') !!}
          {!! Form::text('title', null, ['class' => 'form-control input-sm']) !!}
          <span class="help-block">Display name of the expert.</span>
        </div>
        <div class="form-group">
          {!! Form::label('caption', 'Caption') !!}
          {!! Form::textarea('caption', null, ['class' => 'form-control input-sm', 'rows'=>'5']) !!}
          <span class="help-block">A brief description of this expert.</span>
        </div>
    </div><!-- /.box-body -->
                <div class="box-footer">
                            <div class="form-inline">
                                <div class="form-group">
                                {!! Form::submit('Update Image', array('class'=>'btn btn-primary')) !!}
                                {!! Form::close() !!}
                            </div>

                            @if($expertImage->imgtype->is_required == 0)
                                 <div class="form-group">
                                 {!! Form::model($expertImage, ['route' => ['admin_expertimage_destroy', $expertImage->id],
                                 'method' => 'DELETE',
                                 'class' => 'form',
                                 'files' => true]
                                 ) !!}
                                 {!! Form::submit('Delete Image', array('class'=>'btn btn-warning', 'onclick' => 'return confirm("Are you sure you want to delete the image?")')) !!}
                                 {!! Form::close() !!}
                                    </div>
                            @endif
                        </div> <!-- /.form-inline -->

                </div><!-- /.box-footer-->
</div> <!-- /.box -->

@section('footer')
    @parent
    <script>

    </script>

@endsection
