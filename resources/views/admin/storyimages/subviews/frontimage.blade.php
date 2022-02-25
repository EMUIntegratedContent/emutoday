<div class="box box-primary">
    {!! Form::model($storyImage,[
        'method' => 'patch',
        'route' => ['admin_storyimage_update', $storyImage->id],
        'files' => true
    ]) !!}
    {{ Form::hidden('qtype', $qtype, array('id' => 'qtype')) }}
    {{ Form::hidden('gtype', $gtype, array('id' => 'gtype')) }}
    {{ Form::hidden('stype', $stype, array('id' => 'stype')) }}
    {{ Form::hidden('img_type', 'front', array('id' => 'img_type')) }}
        <div class="box-header with-border">
            <div class="box-head-info pull-left">
                @if($storyImage->is_active != 0)
                {{-- dd($storyImage->filename) --}}
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
            {!! Form::hidden('image_type', $storyImage->image_type, ['class' => 'form-control input-sm', 'readonly' => 'readonly']) !!}
            {!! Form::hidden('image_name', null, ['class' => 'form-control', 'readonly' => 'readonly']) !!}

        <div class="form-group">
            <label class="control-label" for="image">Select File</label>
            {!! Form::file('image', null, array('required', 'class'=>'form-control input-sm')) !!}
            <span class="help-block">{{$storyImage->imgtype->helptxt}}</span>

        </div>
        <div class="form-group">
          {!! Form::label('alt_text', 'Image alt text') !!}
          {!! Form::text('alt_text', null, ['class' => 'form-control input-sm']) !!}
          <span class="help-block">Describe this image so visually-impaired users can understand it. </span>
        </div>
        @if($storyImage->group == 'emutoday')
            <div class="form-group">
              {!! Form::label('title', 'Title/Header') !!}
              {!! Form::text('title', null, ['class' => 'form-control input-sm']) !!}
              <span class="help-block">Large Bold text limited to a couple of words visible when story is main feature on emu-today hub </span>
            </div>
            <div class="form-group">
              {!! Form::label('teaser', 'Teaser/Byline') !!}
              {!! Form::textarea('teaser', null, ['class' => 'form-control input-sm', 'rows'=>'5']) !!}
              <span class="help-block">Small to Medium size text under title, visible when story is main feature on emu-today hub</span>
            </div>
            <div class="form-group">
              {!! Form::label('moretext', 'More Text Link') !!}
              {!! Form::text('moretext', null, ['class' => 'form-control input-sm']) !!}
              <span class="help-block">Text used to link to full story page when the story is the main feature on emu-today page</span>
            </div>

            @elseif($storyImage->group == 'student')
                <div class="form-group">
                    {!! Form::label('title', 'Title/Header') !!}
                    {!! Form::text('title', null, ['class' => 'form-control input-sm']) !!}
                    <span class="help-block">Large Bold text limited to a couple of words visible when story is main feature on emu-today hub </span>
                </div>
                <div class="form-group">
                    {!! Form::label('teaser', 'Teaser/Byline') !!}
                    {!! Form::textarea('teaser', null, ['class' => 'form-control input-sm', 'rows'=>'5']) !!}
                    <span class="help-block">Small to Medium size text under title, visible when story is main feature on emu-today hub and/or featured on student profile hub</span>
                </div>
                <div class="form-group">
                    {!! Form::label('moretext', 'More Text Link') !!}
                    {!! Form::text('moretext', null, ['class' => 'form-control input-sm']) !!}
                    <span class="help-block">Text used to link to full story page when the story is the main feature on emu-today hub and/or featured on student profile hub</span>
                </div>

            @elseif($storyImage->group == 'article')

                <div class="form-group">
                    {!! Form::label('title', 'Title/Header') !!}
                    {!! Form::text('title', null, ['class' => 'form-control input-sm']) !!}
                    <span class="help-block">Title or header that will be displayed </span>
                </div>
                <div class="form-group">
                    {!! Form::label('caption', 'Caption/Subtitle') !!}
                    {!! Form::text('caption', null, ['class' => 'form-control input-sm']) !!}
                    <span class="help-block">Small to Medium size text under title visible when article is the  featured article on  main magazine page</span>
                </div>
                <div class="form-group">
                    {!! Form::label('teaser', 'Teaser/Byline') !!}
                    {!! Form::textarea('teaser', null, ['class' => 'form-control input-sm', 'rows'=>'5']) !!}
                    <span class="help-block">Small to Medium size text under title, visible when article is main feature on emu-today hub. NOT visible when article is the featured article on  magazine page (use caption)</span>
                </div>
                <div class="form-group">
                    {!! Form::label('moretext', 'More Text Link') !!}
                    {!! Form::text('moretext', null, ['class' => 'form-control input-sm']) !!}
                    <span class="help-block">Text used to link to full story page when the article is the main feature on emu-today hub, NOT visible on main magazine page</span>
                </div>

            @else
                <div class="form-group">
                    {!! Form::label('title', 'Title/Header') !!}
                    {!! Form::text('title', null, ['class' => 'form-control input-sm']) !!}
                    <span class="help-block">Large Bold text limited to a couple of words visable on main magazine page or current issue page </span>
                </div>
                <div class="form-group">
                    {!! Form::label('caption', 'Caption/Subtitle') !!}
                    {!! Form::text('caption', null, ['class' => 'form-control input-sm']) !!}
                    <span class="help-block">Small to Medium size text limited to a couple of lines, visable when article is Featured on emu-today, main magaazine page, or in sidebar</span>
                </div>
                <div class="form-group">
                    {!! Form::label('teaser', 'Teaser/Byline') !!}
                    {!! Form::textarea('teaser', null, ['class' => 'form-control input-sm', 'rows'=>'5']) !!}
                    <span class="help-block">Small to Medium size text explaining article on current issue page</span>
                </div>
                <div class="form-group">
                    {!! Form::label('moretext', 'More Text Link') !!}
                    {!! Form::text('moretext', null, ['class' => 'form-control input-sm']) !!}
                    <span class="help-block">Text used to link to full story when Featured on emu-today page</span>
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


            @endif
    </div><!-- /.box-body -->
                <div class="box-footer">
                            <div class="form-inline">
                                <div class="form-group">
                                {!! Form::submit('Update Image', array('class'=>'btn btn-primary')) !!}
                                {!! Form::close() !!}
                                </div>
                               @if($storyImage->imgtype->is_required == 0)
                                 <div class="form-group">
                                   {!! Form::model($storyImage, ['route' => ['admin_storyimage_destroy', $storyImage->id],
                                   'method' => 'DELETE',
                                   'class' => 'form',
                                   'files' => true]
                                   ) !!}
                                   {!! Form::hidden('image_type', $storyImage->image_type, ['class' => 'form-control input-sm', 'readonly' => 'readonly']) !!}
                                   {!! Form::submit('Delete Image', array('class'=>'btn btn-warning', 'Onclick' => 'return ConfirmDelete();')) !!}
                                   {!! Form::close() !!}
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
