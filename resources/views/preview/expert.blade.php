<!-- Preview Story Page -->

@extends('public.layouts.global')
@section('styles')
    @parent
@endsection
@section('scriptshead')
    <!-- Scripts  for code libraries and plugins that need to be loaded in the header -->
    <script src="https://cdn.ckeditor.com/ckeditor5/38.0.1/classic/ckeditor.js"></script>
    @parent
@endsection
@section('bodytop')
    @include('preview.includes.previewexpert',['recordid' => $expert->id] )
@endsection
@section('offcanvaslist')
    @include('preview.includes.offcanvaslist')
@endsection
  @section('connectionbar')
    @include('preview.includes.connectionbar')
  @endsection
@section('content')
    <div class="row">
      <div class="large-12 medium-12 small-12 columns">
            <!-- Expert Content -->
            <div id="expert-content" class="row">
                {!! Form::model($expert,[
                    'method' => 'put',
                    'route' => ['admin_preview_expert_update', $expert->id],
                    'files' => true
                ]) !!}
                <div id="story-content-edit">
                {!! Form::textarea('biography', null, ['class' => 'form-control', 'id' => 'cktextarea']) !!}
                </div>
            </div>
      </div>
    </div>
    <div class="row">
        <div class="medium-6 columns">
            <div class="button-group">
                {!! Form::submit('Update Expert', ['class' => 'button']) !!}
            </div><!-- /.button-group -->
            {!! Form::close() !!}
        </div><!-- /.medium-6 columns -->
        <div class="medium-6 columns">
        </div><!-- /.medium-6 columns -->
    </div><!-- /.row -->
@endsection

@section('scriptsfooter')
  @parent
  <script src="/js/emu-ckeditor5-blade-config.js"></script>

  @endsection
