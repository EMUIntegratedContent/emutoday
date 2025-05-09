<div class="box box-primary">
  {!! html()->modelForm($storyImage, 'patch', route('admin_storyimage_update', $storyImage->id))->acceptsFiles()->open() !!}

  {!! html()->hidden('qtype', $qtype)->id('qtype') !!}
  {!! html()->hidden('gtype', $gtype)->id('gtype') !!}
  {!! html()->hidden('stype', $stype)->id('stype') !!}

  <div class="box-header with-border">
    <div class="box-head-info pull-left">
      @if($storyImage->is_active != 0)
        <img class="better-thumb" src="/imagecache/betterthumb/{{$storyImage->filename}}" alt="{{$storyImage->image_name}}">
      @endif
      <h3 class="box-title">{{$storyImage->imgtype->name}}</h3>
    </div><!-- /.box-head-info -->

    <div class="box-tools pull-right">
      <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse" data-original-title="Collapse">
        <i class="fa fa-minus"></i>
      </button>
    </div>
  </div><!-- /.box-header -->

  <div class="box-body">
    {!! html()->hidden('image_type', $storyImage->image_type) !!}
    {!! html()->hidden('image_name', null) !!}

    <div class="form-group">
      <label class="control-label" for="image">Select File (max size {{ ini_get('upload_max_filesize') }})</label>
      {!! html()->file('image')->class('form-control input-sm') !!}
      <span class="help-block">{{$storyImage->imgtype->helptxt}}</span>
    </div>

    <div class="form-group">
      {!! html()->label('Image alt text', 'alt_text') !!}
      {!! html()->text('alt_text')->class('form-control input-sm') !!}
      <span class="help-block">Describe this image so visually-impaired users can understand it.</span>
    </div>

    <div class="form-group">
      {!! html()->label('Title', 'title') !!}
      {!! html()->text('title')->class('form-control input-sm') !!}
      <span class="help-block">Large Bold text limited to a couple of words</span>
    </div>

    <div class="form-group">
      {!! html()->label('Caption', 'caption') !!}
      {!! html()->text('caption')->class('form-control input-sm') !!}
      <span class="help-block">Small to Medium size text limited to a couple of lines</span>
    </div>

    @if($storyImage->group == 'emutoday' or $storyImage->group == 'external')
      <div class="form-group">
        {!! html()->label('External Link', 'link') !!}
        {!! html()->text('link')->class('form-control input-sm') !!}
        <span class="help-block">Fully qualified URL external link</span>
      </div>
    @endif

    <div class="form-group">
      {!! html()->label('More Text Link', 'moretext') !!}
      {!! html()->text('moretext')->class('form-control input-sm') !!}
      <span class="help-block">Text used to link to full story</span>
    </div>
  </div><!-- /.box-body -->

  <div class="box-footer">
    <div class="form-inline">
      <div class="form-group">
        {!! html()->submit('Update Image')->class('btn btn-primary') !!}
        {!! html()->form()->close() !!}
      </div>
      <div class="form-group">
        {!! html()->form('delete', route('admin_storyimage_destroy', $storyImage->id))->class('form')->open() !!}
        {!! html()->submit('Delete Image')->class('btn btn-warning')->attribute('onclick', 'return ConfirmDelete();') !!}
        {!! html()->form()->close() !!}
      </div>
    </div>
  </div><!-- /.box-footer-->
</div> <!-- /.box -->

@section('footer')
  @parent
  <script>

    function ConfirmDelete() {
      var x = confirm("Are you sure you want to delete?");
      if (x)
        return true;
      else
        return false;
    }

  </script>

@endsection
