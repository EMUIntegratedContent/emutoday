@inject('storyimagetypes', 'emutoday\Http\Utilities\StoryImageTypes')
@extends('admin.layouts.master')

@section('title', $storyImage->exists ? 'Editing Story Image' : 'Create New Story Image')

@section('content')
  {!! html()->modelForm($storyImage, $storyImage->exists ? 'put' : 'post', $storyImage->exists ? route('admin.storyimages.update', $storyImage->id) : route('admin.storyimages.store'))->acceptsFiles()->open() !!}

  <!-- Image Name Form Input -->
  <div class="form-group">
    {!! html()->label('Image name:', 'image_name') !!}
    {!! html()->text('image_name')->class('form-control') !!}
  </div>

  <!-- Is Active Form Input -->
  <div class="form-group">
    {!! html()->label('Is Active:', 'is_active') !!}
    {!! html()->checkbox('is_active') !!}
  </div>

  <!-- Is Featured Form Input -->
  <div class="form-group">
    {!! html()->label('Is Featured:', 'is_featured') !!}
    {!! html()->checkbox('is_featured') !!}
  </div>

  @if ($storyImage->exists)
    <div>
      {{ $storyImage->filename }} <br>
      {{ $storyImage->image_name }} - thumbnail :  <br>
      <img src="/imgs/story/thumbnails/{{ 'thumb-' . $storyImage->image_name . '.' . $storyImage->image_extension . '?' . 'time=' . time() }}">
    </div>
    <div>
      {{ $storyImage->image_name }} :  <br>
      <img src="/imgs/story/{{ $storyImage->image_name . '.' . $storyImage->image_extension . '?' . 'time=' . time() }}">
    </div>
    <!-- Form field for file -->
    <div class="form-group">
      {!! html()->label('Primary Image', 'image') !!}
      {!! html()->file('image')->class('form-control')->required() !!}
    </div>
  @else
    <!-- Form field for file -->
    <div class="form-group">
      {!! html()->label('Primary Image', 'image') !!}
      {!! html()->file('image')->class('form-control')->required() !!}
    </div>
  @endif

  <!-- Form field for caption -->
  <div class="form-group caption">
    {!! html()->label('Caption', 'caption') !!}
    {!! html()->textarea('caption')->class('form-control') !!}
  </div>

  <!-- Form field for teaser -->
  <div class="form-group teaser">
    {!! html()->label('Teaser', 'teaser') !!}
    {!! html()->textarea('teaser')->class('form-control') !!}
  </div>

  <!-- Form field for moretext -->
  <div class="form-group moretext">
    {!! html()->label('More Text', 'moretext') !!}
    {!! html()->textarea('moretext')->class('form-control') !!}
  </div>

  <!-- Form field for image type -->
  <div class="form-group">
    {!! html()->label('Image Type', 'image_type') !!}
    {!! html()->select('image_type', $storyimagetypes::all(), 0)->class('form-control') !!}
  </div>

  <!-- Submit button -->
  <div class="form-group">
    {!! html()->submit('Upload Photo')->class('button') !!}
  </div>

  {!! html()->form()->close() !!}

@endsection
