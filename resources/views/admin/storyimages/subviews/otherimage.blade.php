<div class="box box-primary">
    {!! Form::model($storyImage,[
        'method' => 'patch',
        'route' => ['admin_storyimage_update', $storyImage->id],
        'files' => true
    ]) !!}
    {{ Form::hidden('qtype', $qtype, array('id' => 'qtype')) }}
    {{ Form::hidden('gtype', $gtype, array('id' => 'gtype')) }}
    {{ Form::hidden('stype', $stype, array('id' => 'stype')) }}
        <div class="box-header with-border">
            <div class="box-head-info pull-left">
                @if($storyImage->is_active != 0)
                    <img class="better-thumb" src="/imagecache/betterthumb/{{$storyImage->filename}}" alt="{{$storyImage->image_name}}">
                @endif
              <h3 class="box-title">{{$storyImage->imgtype->name}}</h3>
            </div><!-- /.box-head-info -->

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse">
              <i class="fa fa-minus"></i></button>
          </div>
        </div><!-- /.box-header -->
        <div class="box-body">
                                {{-- {!! Form::label('image_type', 'Image Type:') !!} --}}
                                {!! Form::hidden('image_type', $storyImage->image_type) !!}
                                {{-- {!! Form::label('image_name', 'Name:') !!} --}}
                                {!! Form::hidden('image_name', null) !!}
                            <div class="form-group">
                                <label class="control-label" for="image">Select File</label>
                                {!! Form::file('image', null, array('required', 'class'=>'form-control input-sm')) !!}
                                <span class="help-block">{{$storyImage->imgtype->helptxt}}</span>
                            </div>


                            @if($storyImage->image_type !== 'social')
                            <div class="form-group">
                                {!! Form::label('title', 'Title/Header') !!}
                                {!! Form::text('title', null, ['class' => 'form-control input-sm']) !!}
                                <span class="help-block">Large Bold text limited to a couple of words </span>
                            </div>
                            <div class="form-group">
                                {!! Form::label('caption', 'Caption/Subtitle') !!}
                                {!! Form::text('caption', null, ['class' => 'form-control input-sm']) !!}
                                <span class="help-block">Small to Medium size text limited to a couple of lines</span>
                            </div>
                            <div class="form-group">
                                {!! Form::label('teaser', 'Teaser/Byline') !!}
                                {!! Form::textarea('teaser', null, ['class' => 'form-control input-sm', 'rows'=>'5']) !!}
                                <span class="help-block">Small to Medium size text from a coupel lines to a couple paragraphs</span>
                            </div>
                            <div class="form-group">
                                {!! Form::label('moretext', 'More Text Link') !!}
                                {!! Form::text('moretext', null, ['class' => 'form-control input-sm']) !!}
                                <span class="help-block">Text used to link to full story</span>
                            </div>
                            <div class="form-group">
                                {!! Form::label('link', 'External Link') !!}
                                {!! Form::text('link', null, ['class' => 'form-control input-sm']) !!}
                                <span class="help-block">Fully qualified URL for linking to an external webpage</span>
                            </div>
                            <div class="form-group">
                                {!! Form::label('link_text', 'Link Text') !!}
                                {!! Form::text('link_text', null, ['class' => 'form-control input-sm']) !!}
                                <span class="help-block">Text for the external link</span>
                            </div>
                            @else
                            <div class="form-group">
                                {!! Form::label('title', 'Title') !!}
                                {!! Form::text('title', null, ['class' => 'form-control input-sm']) !!}
                                <span class="help-block">Optional Title for Social Links (otherwise chooses story title)</span>
                            </div>
                            @endif



                        </div><!-- /.box-body -->
                <div class="box-footer">
                            <div class="form-inline">
                                <div class="form-group">
                                {!! Form::submit('Update Image', array('class'=>'btn btn-primary')) !!}
                                {!! Form::close() !!}
                            </div>
                        @if($storyImage->imgtype->is_required == 0)
                        {{-- @if($storyImage->image_type == 'imagehero') --}}
                             <div class="form-group">
                       {!! Form::model($storyImage, ['route' => ['admin_storyimage_destroy', $storyImage->id],
                       'method' => 'DELETE',
                       'class' => 'form',
                       'files' => true]
                       ) !!}
                             {!! Form::submit('Delete Image', array('class'=>'btn btn-warning', 'Onclick' => 'return ConfirmDelete();')) !!}
                       {!! Form::close() !!}
                              </div>
                    @endif
                        </div>
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
