<!-- Preview Post Page -->
@extends('public.layouts.global')
@section('styles')
  @parent
  @include('preview.includes.previewcoverstyle')
@endsection
@section('scriptshead')
  <!-- Scripts  for code libraries and plugins that need to be loaded in the header -->
  <script src="https://cdn.ckeditor.com/ckeditor5/38.0.1/classic/ckeditor.js"></script>
  @parent
@endsection
@section('bodytop')
  @include('preview.includes.previewpost',[] )
@endsection
@section('offcanvaslist')
  @include('preview.includes.offcanvaslist')
@endsection
@section('connectionbar')
  @include('preview.includes.connectionbar')
@endsection
@section('content')
  <div id="news-story-bar">
    <div class="row">
      <div class="large-12 medium-12 small-12 columns">
        <!-- Story Page Title group -->
        <div id="title-grouping" class="row">
          <div class="small-12 columns">
            <h2>{{ $post->title }}</h2>
            @if(isset($post->subtitle))
              <h3>{{ $post->subtitle }}</h3>
            @endif
          </div>
        </div>
        <!-- Story Page Content -->
        {!! Form::model($post,[
            'method' => 'put',
            'route' => ['posts.update', $post],
            'files' => true
        ]) !!}
        <div id="story-content" class="row ck-content">
        <!-- Story Content Column -->
          <div class="large-9 large-push-3 medium-9 medium-push-3 small-12 columns">
            @if(isset($mainImg))
              <div id="big-feature-image">
                <img src="{{ $mainImg->image_path }}"
                     alt="{{ $mainImg->alt_text != '' ? $mainImg->alt_text : str_replace('"', "", $post->title) }}">
                <div class="feature-image-caption">{{ $mainImg->caption }}</div>
              </div>
            @endif
            <div id="story-content-edit">
              @if(session('success'))
                <div class="preview-alert preview-alert-success" role="alert">
                  {{ session('success') }}
                </div>
              @endif
              @if(session('errors') && session('errors')->any())
                <div class="preview-alert preview-alert-error" role="alert">
                  There were errors with your submission.
                  <ul>
                    @foreach(session('errors')->all() as $error)
                      <li>{{ $error }}</li>
                    @endforeach
                  </ul>
                </div>
              @endif
              @php
                if(isset($_GET['truepreview']) && $_GET['truepreview'] == "true"):
              @endphp
              <a href="?truepreview=false" class="button secondary"><i class="fa fa-exchange" aria-hidden="true"></i>
                Editable preview</a>

              {!! Form::hidden('content') !!}
              {!! $post->content !!}
              @php
                else:
              @endphp
              <a href="?truepreview=true" class="button secondary"><i class="fa fa-exchange" aria-hidden="true"></i>
                True preview</a>
              {!! Form::textarea('content', null, ['class' => 'form-control', 'id' => 'cktextarea']) !!}
              @php
                endif
              @endphp
            </div>
          </div>
          <!-- Page Side Bar Column -->
          <div class="large-3 large-pull-9 medium-3 medium-pull-9 small-12 columns" id="story-sidebar">
            <div class="dots-bottom">
              <div class="addthis"><img src="/assets/imgs/icons/fake-sharethis.png"/></div>
            </div>
            <div class="dots-bottom">
              <p>
                Submitted by:<br>
                @if($idea)
                  @if($idea->use_other_source && $idea->other_source)
                    {{$idea->other_source}}
                  @else
                    {{$idea->contributor_first}} {{$idea->contributor_last}}
                  @endif
                @else
                  Division of Communications
                @endif
              </p>
            </div>
          </div>
        </div><!-- /#story-content -->
        <div class="row">
          <div class="medium-8 columns">
            @if(!isset($_GET['truepreview']) || $_GET['truepreview'] != "true")
              <div class="button-group">
                {!! Form::hidden('id') !!}
                {!! Form::submit('Update Post', ['class' => 'button']) !!}
              </div><!-- /.button-group -->
            @endif
          </div><!-- /.medium-8 columns -->
          <div class="medium-4 columns">
            <h6 class="subheader text-right">Start Date: {{$post->start_date}}</h6>
          </div><!-- /.medium-4 columns -->
        </div><!-- /.row -->
        {!! Form::close() !!}
      </div>

    </div>
  </div>

@endsection

@section('scriptsfooter')
  @parent
  <script src="/js/emu-ckeditor5-blade-config.js"></script>
@endsection
