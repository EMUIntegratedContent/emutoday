<div class="box box-primary">
  {!! html()->modelForm($storyImage, 'patch', route('admin_storyimage_update', $storyImage->id))->acceptsFiles()->open() !!}

  {!! html()->hidden('qtype', $qtype)->id('qtype') !!}
  {!! html()->hidden('gtype', $gtype)->id('gtype') !!}
  {!! html()->hidden('stype', $stype)->id('stype') !!}
  {!! html()->hidden('img_type', 'front')->id('img_type') !!}

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
    {!! html()->hidden('image_type', $storyImage->image_type)->class('form-control input-sm')->attribute('readonly', 'readonly') !!}
    {!! html()->hidden('image_name')->class('form-control')->attribute('readonly', 'readonly') !!}

    <div class="form-group">
      <label class="control-label" for="image">Select File (max size {{ ini_get('upload_max_filesize') }})</label>
      {!! html()->file('image')->class('form-control input-sm') !!}
      <span class="help-block">{{$storyImage->imgtype->helptxt}}</span>
    </div>

    <div class="form-group">
      {!! html()->label('Image alt text', 'alt_text') !!}
      {!! html()->text('alt_text')->class('form-control input-sm') !!}
      <span class="help-block">Describe this image so visually-impaired users can understand it. 33333</span>
    </div>

    @if($storyImage->group == 'emutoday')
      <div class="form-group">
        {!! html()->label('Title/Header', 'title') !!}
        {!! html()->text('title')->class('form-control input-sm') !!}
        <span class="help-block">Large Bold text limited to a couple of words visible when story is main feature on emu-today hub</span>
      </div>
      <div class="form-group">
        {!! html()->label('Teaser/Byline', 'teaser') !!}
        {!! html()->textarea('teaser')->class('form-control input-sm')->rows(5) !!}
        <span class="help-block">Small to Medium size text under title, visible when story is main feature on emu-today hub</span>
      </div>
      <div class="form-group">
        {!! html()->label('More Text Link', 'moretext') !!}
        {!! html()->text('moretext')->class('form-control input-sm') !!}
        <span class="help-block">Text used to link to full story page when the story is the main feature on emu-today page</span>
      </div>

    @elseif($storyImage->group == 'student')
      <div class="form-group">
        {!! html()->label('Title/Header', 'title') !!}
        {!! html()->text('title')->class('form-control input-sm') !!}
        <span class="help-block">Large Bold text limited to a couple of words visible when story is main feature on emu-today hub</span>
      </div>
      <div class="form-group">
        {!! html()->label('Teaser/Byline', 'teaser') !!}
        {!! html()->textarea('teaser')->class('form-control input-sm')->rows(5) !!}
        <span class="help-block">Small to Medium size text under title, visible when story is main feature on emu-today hub and/or featured on student profile hub</span>
      </div>
      <div class="form-group">
        {!! html()->label('More Text Link', 'moretext') !!}
        {!! html()->text('moretext')->class('form-control input-sm') !!}
        <span class="help-block">Text used to link to full story page when the story is the main feature on emu-today hub and/or featured on student profile hub</span>
      </div>

    @elseif($storyImage->group == 'article')
      <div class="form-group">
        {!! html()->label('Title/Header', 'title') !!}
        {!! html()->text('title')->class('form-control input-sm') !!}
        <span class="help-block">Title or header that will be displayed</span>
      </div>
      <div class="form-group">
        {!! html()->label('Caption/Subtitle', 'caption') !!}
        {!! html()->text('caption')->class('form-control input-sm') !!}
        <span class="help-block">Small to Medium size text under title visible when article is the featured article on main magazine page</span>
      </div>
      <div class="form-group">
        {!! html()->label('Teaser/Byline', 'teaser') !!}
        {!! html()->textarea('teaser')->class('form-control input-sm')->rows(5) !!}
        <span class="help-block">Small to Medium size text under title, visible when article is main feature on emu-today hub. NOT visible when article is the featured article on magazine page (use caption)</span>
      </div>
      <div class="form-group">
        {!! html()->label('More Text Link', 'moretext') !!}
        {!! html()->text('moretext')->class('form-control input-sm') !!}
        <span class="help-block">Text used to link to full story page when the article is the main feature on emu-today hub, NOT visible on main magazine page</span>
      </div>

    @else
      <div class="form-group">
        {!! html()->label('Title/Header', 'title') !!}
        {!! html()->text('title')->class('form-control input-sm') !!}
        <span class="help-block">Large Bold text limited to a couple of words visible on main magazine page or current issue page</span>
      </div>
      <div class="form-group">
        {!! html()->label('Caption/Subtitle', 'caption') !!}
        {!! html()->text('caption')->class('form-control input-sm') !!}
        <span class="help-block">Small to Medium size text limited to a couple of lines, visible when article is Featured on emu-today, main magazine page, or in sidebar</span>
      </div>
      <div class="form-group">
        {!! html()->label('Teaser/Byline', 'teaser') !!}
        {!! html()->textarea('teaser')->class('form-control input-sm')->rows(5) !!}
        <span class="help-block">Small to Medium size text explaining article on current issue page</span>
      </div>
      <div class="form-group">
        {!! html()->label('More Text Link', 'moretext') !!}
        {!! html()->text('moretext')->class('form-control input-sm') !!}
        <span class="help-block">Text used to link to full story when Featured on emu-today page</span>
      </div>
      <div class="form-group">
        {!! html()->label('External Link', 'link') !!}
        {!! html()->text('link')->class('form-control input-sm') !!}
        <span class="help-block">Fully qualified URL for linking to an external webpage</span>
      </div>
      <div class="form-group">
        {!! html()->label('Link Text', 'link_text') !!}
        {!! html()->text('link_text')->class('form-control input-sm') !!}
        <span class="help-block">Text for the external link</span>
      </div>

    @endif

  </div><!-- /.box-body -->

  <div class="box-footer">
    <div class="form-inline">
      <div class="form-group">
        {!! html()->submit('Update Image')->class('btn btn-primary') !!}
      </div>
      {!! html()->form()->close() !!}
      @if($storyImage->imgtype->is_required == 0)
        <div class="form-group">
          {!! html()->form('delete', route('admin_storyimage_destroy', $storyImage->id))->attributes(['class' => 'form', 'files' => true])->open() !!}
          {!! html()->hidden('image_type', $storyImage->image_type)->class('form-control input-sm')->attribute('readonly', 'readonly') !!}
          {!! html()->submit('Delete Image')->class('btn btn-warning')->attribute('onclick', 'return ConfirmDelete();') !!}
          {!! html()->form()->close() !!}
        </div>
      @endif
    </div> <!-- /.form-inline -->
  </div><!-- /.box-footer-->
</div> <!-- /.box -->

@section('footer')
    @parent
    <script>

        function ConfirmDelete()
        {
            var x = confirm("Are you sure you want to delete?");
            if (x)
                return true;
            else
                return false;
        }

    </script>

@endsection
