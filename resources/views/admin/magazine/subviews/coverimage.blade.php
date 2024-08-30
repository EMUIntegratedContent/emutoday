<div class="box box-primary">
  <div class="box-header with-border">
    <div class="box-head-info pull-left">
      @if($mediafile->filename)
        <img class="better-thumb" src="/imagecache/betterthumb/{{$mediafile->media_name}}" alt="{{$mediafile->name}}">
      @endif
      <h3 class="box-title">{{$mediafile->mediatype->name}}</h3>
    </div><!-- /.box-head-info -->
    <div class="box-tools pull-right">
      <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title=""
              data-original-title="Collapse">
        <i class="fa fa-minus"></i></button>
    </div>
  </div><!-- /.box-header -->
  <div class="box-body">
    {!! html()->modelForm($mediafile, 'put', route('update_magazine_cover', $mediafile->id))->acceptsFiles()->open() !!}
    <div class="form-group">
      {!! html()->file('photo')->required()->id('photo')->class('form-control input-sm') !!}
      <span class="help-block">{{ $mediafile->mediatype->helptxt }}</span>
    </div>

    @if($mediafile->type == 'cover')
      <div class="form-group">
        {!! html()->label('Title', 'headline') !!}
        {!! html()->text('headline')->class('form-control') !!}
        <span class="help-block">Large Bold text limited to a couple of words. When this issue is current it will be visible on main magazine page. When the issue is not current, it will be visible on "past issue" page.</span>
      </div>
    @else
      <div class="form-group">
        {!! html()->label('headline', 'headline') !!}
        {!! html()->text('headline')->class('form-control') !!}
        <span class="help-block">Large Bold text limited to a couple of words. When this issue is current it will be visible on main magazine page.</span>
      </div>
    @endif

    @if($mediafile->type == 'extra')
      <div class="form-group">
        {!! html()->label('caption', 'caption') !!}
        {!! html()->text('caption')->class('form-control') !!}
        <span class="help-block">Small to Medium size text limited to a couple of lines for photographer credits</span>
      </div>
    @endif

    <div class="form-group">
      {!! html()->label('teaser', 'teaser') !!}
      {!! html()->textarea('teaser')->class('form-control ckeditor') !!}
      @if($mediafile->type == 'cover')
        <span class="help-block">Small to Medium size text for a brief paragraph about magazine.</span>
      @else
        <span class="help-block">Small to Medium size text for a brief paragraph about extra topic.</span>
      @endif
    </div>

    @if($mediafile->type == 'cover')
      <div class="form-group">
        {!! html()->label('link', 'link') !!}
        {!! html()->text('link')->class('form-control') !!}
        <span class="help-block">Add the Digital Issue URL</span>
      </div>
      <div class="form-group">
        {!! html()->label('link_text', 'link_text') !!}
        {!! html()->text('link_text', 'Read The Digital Issue')->class('form-control') !!}
        <span class="help-block">Text used to link to Digital Issue</span>
      </div>
    @else
      <div class="form-group">
        {!! html()->label('link', 'link') !!}
        {!! html()->text('link')->class('form-control') !!}
        <span class="help-block">Will display as a button using the Link text.</span>
      </div>
      <div class="form-group">
        {!! html()->label('link_text', 'link_text') !!}
        {!! html()->text('link_text')->class('form-control') !!}
        <span class="help-block">What should the button say?</span>
      </div>
    @endif

    <div class="form-group">
      {!! html()->label('note', 'note') !!}
      {!! html()->text('note')->class('form-control') !!}
      <span class="help-block">Additional field for notes about media file</span>
    </div>

    <div class="box-footer">
      <div class="form-group">
        {!! html()->submit('Update Media Element')->class('btn btn-primary') !!}
      </div>
      {{ csrf_field() }}
      {!! html()->form()->close() !!}
    </div><!-- /.box-footer -->
  </div> <!-- /.box -->
</div>
