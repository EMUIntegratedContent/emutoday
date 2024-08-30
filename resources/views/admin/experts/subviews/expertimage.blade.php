<div class="box box-primary">
  {!! html()->modelForm($expertImage, 'patch', route('admin_expertimage_update', $expertImage->id))->acceptsFiles()->open() !!}

  {!! html()->hidden('img_type', 'headshot')->id('img_type') !!}

  <div class="box-header with-border">
    <div class="box-head-info pull-left">
      @if($expertImage->is_active != 0)
        <img class="better-thumb" src="/imagecache/expertthumb/{{$expertImage->filename}}" alt="{{$expertImage->image_name}}">
      @endif
      <h3 class="box-title">Profile Image</h3>
    </div><!-- /.box-head-info -->
    <div class="box-tools pull-right">
      <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse" data-original-title="Collapse">
        <i class="fa fa-minus"></i>
      </button>
    </div>
  </div><!-- /.box-header -->

  <div class="box-body">
    {!! html()->hidden('image_name', null)->class('form-control')->attribute('readonly', 'readonly') !!}

    <div class="form-group">
      <label class="control-label" for="image">Select File (max size {{ ini_get('upload_max_filesize') }})</label>
      {!! html()->file('image')->class('form-control input-sm') !!}
      <span class="help-block">Upload a photo (Width: 800px | Height: 1000px | Resolution: 72ppi). MUST be a 4:5 width to height ratio!</span>
    </div>

    <div class="form-group">
      {!! html()->label('Title/Header', 'title') !!}
      {!! html()->text('title')->class('form-control input-sm') !!}
      <span class="help-block">Display name of the expert.</span>
    </div>
    <div class="form-group">
      {!! html()->label('Caption', 'caption') !!}
      {!! html()->textarea('caption')->class('form-control input-sm')->rows(5) !!}
      <span class="help-block">A brief description of this expert.</span>
    </div>
  </div><!-- /.box-body -->

  <div class="box-footer">
    <div class="form-inline">
      <div class="form-group">
        {!! html()->submit('Update Image')->class('btn btn-primary') !!}
        {!! html()->form()->close() !!}
      </div>

      @if($expertImage->imgtype->is_required == 0)
        <div class="form-group">
          {!! html()->form('delete', route('admin_expertimage_destroy', $expertImage->id))->class('form')->open() !!}
          {!! html()->submit('Delete Image')->class('btn btn-warning')->attribute('onclick', 'return confirm("Are you sure you want to delete the image?")') !!}
          {!! html()->form()->close() !!}
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
