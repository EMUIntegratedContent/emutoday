<div class="box box-primary">
    <div class="box-header with-border">
        <div class="box-head-info pull-left">
            @if($mediafile->filename)
            <img class="better-thumb" src="/imagecache/betterthumb/{{$mediafile->media_name}}" alt="{{$mediafile->name}}">
        @endif
          <h3 class="box-title">{{$mediafile->mediatype->name}}</h3>
        </div><!-- /.box-head-info -->
        <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse">
          <i class="fa fa-minus"></i></button>
      </div>
    </div><!-- /.box-header -->
    <div class="box-body">

        {!! Form::model($mediafile, [
            'method' => 'put',
            'route' => ['update_magazine_cover', $mediafile->id],
            'files' => true
            ]) !!}
            <div class="form-group">
                    {!! Form::file('photo', null, array('required','id' => 'photo', 'class'=>'form-control input-sm')) !!}
                    <span class="help-block">{{$mediafile->mediatype->helptxt}}</span>
                </div>
                @if($mediafile->type == 'cover')
                        <div class="form-group">
                        {!! Form::label('headline', 'Title') !!}
                        {!! Form::text('headline', null, ['class' => 'form-control']) !!}
                        <span class="help-block">Large Bold text limited to a couple of words. When this issue is current it will be visible on main magazine page. When the issue is not current, it will be visible on "past issue" page. </span>
                        </div>
                @else
                        <div class="form-group">
                        {!! Form::label('headline', 'headline') !!}
                        {!! Form::text('headline', null, ['class' => 'form-control']) !!}
                        <span class="help-block">Large Bold text limited to a couple of words. When this issue is current it will be visible on main magazine page. </span>
                        </div>
                @endif
                @if($mediafile->type == 'extra')
                <div class="form-group">
                    {!! Form::label('caption') !!}
                    {!! Form::text('caption', null, ['class' => 'form-control']) !!}
                    <span class="help-block">Small to Medium size text limited to a couple of lines for photographer credits</span>
                </div>
                @endif

                <div class="form-group">
                    {!! Form::label('teaser') !!}
                    {!! Form::textarea('teaser', null, ['class' => 'form-control', 'class'=>'ckeditor']) !!}
                    @if($mediafile->type == 'cover')
                        <span class="help-block">Small to Medium size text for a brief paragraph about magazine.</span>
                    @else
                        <span class="help-block">Small to Medium size text for a brief paragraph about extra topic.</span>
                    @endif
                </div>
                @if($mediafile->type == 'cover')
                <div class="form-group">
                    {!! Form::label('link') !!}
                    {!! Form::text('link', null, ['class' => 'form-control']) !!}
                    <span class="help-block">Add the Digital Issue Url</span>
                </div>
                <div class="form-group">
                    {!! Form::label('link_text') !!}
                    {!! Form::text('link_text', 'Read The Digital Issue', ['class' => 'form-control']) !!}
                    <span class="help-block">Text used to link to Digital Issue</span>
                </div>
            @else
                <div class="form-group">
                    {!! Form::label('link') !!}
                    {!! Form::text('link', null, ['class' => 'form-control']) !!}
                    <span class="help-block">Currently Not Used for Extra Images</span>
                </div>
                <div class="form-group">
                    {!! Form::label('link_text') !!}
                    {!! Form::text('link_text', null, ['class' => 'form-control']) !!}
                    <span class="help-block">Currently Not Used for Extra Images</span>
                </div>
            @endif
                <div class="form-group">
                    {!! Form::label('note') !!}
                    {!! Form::text('note', null, ['class' => 'form-control']) !!}
                    <span class="help-block">Additional field for notes about media file</span>
                </div>
            </div> <!-- /.box-body -->
                    <div class="box-footer">
                        <div class="form-group">
                            {!! Form::submit('Update Media Element', array('class'=>'btn btn-primary')) !!}
                        </div>
                        {{ csrf_field() }}
                        {!! Form::close() !!}
                    </div><!-- /.box-footer -->
    </div> <!-- /.box -->
