@inject('storyimagetypes', 'emutoday\Http\Utilities\StoryImageTypes')
@extends('admin.layouts.master')

@section('title', $storyImage->exists ? 'Editing Story Image' : 'Create New Story Image')

@section('content')
    {!! Form::model($storyImage,[
        'method' => $storyImage->exists ? 'put' : 'post',
        'route' => $storyImage->exists ? ['admin.storyimages.update', $storyImage->id] : ['admin.storyimages.store'],
        'files' => true
    ]) !!}

    <!-- image name Form Input -->
    <div class="form-group">
     {!! Form::label('image name', 'Image name:') !!}
     {!! Form::text('image_name', null, ['class' => 'form-control']) !!}
    </div>


    <!-- is_something Form Input -->
    <div class="form-group">
     {!! Form::label('is_active', 'Is Active:') !!}
     {!! Form::checkbox('is_active') !!}
    </div>

    <!-- is_featured Form Input -->
    <div class="form-group">
     {!! Form::label('is_featured', 'Is Featured:') !!}
     {!! Form::checkbox('is_featured') !!}
    </div>

    @if ($storyImage->exists)
      <div>{{ $storyImage->filename }} <br>
         {{ $storyImage->image_name }} - thumbnail :  <br>
         <img src="/imgs/story/thumbnails/{{ 'thumb-' . $storyImage->image_name . '.' .
       $storyImage->image_extension . '?'. 'time='. time() }}">
     </div>
      <div>
         {{ $storyImage->image_name }} :  <br>
         <img src="/imgs/story/{{ $storyImage->image_name . '.' .
             $storyImage->image_extension . '?'. 'time='. time() }}">
      </div>
      <!-- form field for file -->
      <div class="form-group">
      {!! Form::label('image', 'Primary Image') !!}
      {!! Form::file('image', null, array('required', 'class'=>'form-control')) !!}
      </div>
@else
   <!-- form field for file -->
 <div class="form-group">
 {!! Form::label('image', 'Primary Image') !!}
 {!! Form::file('image', null, array('required', 'class'=>'form-control')) !!}
 </div>
@endif

    <!-- form field for caption -->
    <div class="form-group caption">
     {!! Form::label('caption') !!}
     {!! Form::textarea('caption', null, ['class' => 'form-control']) !!}
    </div>

    <!-- form field for caption -->
    <div class="form-group teaser">
     {!! Form::label('teaser') !!}
     {!! Form::textarea('teaser', null, ['class' => 'form-control']) !!}
    </div>
    <!-- form field for moretext -->
    <div class="form-group moretext">
     {!! Form::label('moretext') !!}
     {!! Form::textarea('moretext', null, ['class' => 'form-control']) !!}
    </div>
    <!-- form field for moretext -->
    <div class="form-group">
      {!! Form::label('image_type', 'Image Type') !!}
      {!! Form::select('image_type', $storyimagetypes::all(), 0) !!}

    </div>

    <div class="form-group">
    {!! Form::submit('Upload Photo', array('class'=>'button')) !!}
    </div>

   {!! Form::close() !!}

@endsection
