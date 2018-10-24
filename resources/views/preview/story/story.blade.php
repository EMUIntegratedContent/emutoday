  <!-- Preview Story Page -->

  @extends('public.layouts.global')
  @section('styles')
    @parent
    @include('preview.includes.previewcoverstyle')
  @endsection
  @section('scriptshead')
    <!-- Scripts  for code libraries and plugins that need to be loaded in the header -->
    <script src="/themes/plugins/ckeditor/ckeditor.js"></script>
    @parent
  @endsection
  @section('bodytop')
    @include('preview.includes.previewstory',['stype'=> $stype, 'gtype'=> $gtype, 'recordid' => $story->id, 'qtype'=> $qtype] )
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
          <h3>@if($story->story_type == 'featurephoto')Featured Photo: @endif {{ $story->title }}</h3>
          @if($story->story_type != 'featurephoto')
            @if(isset($story->subtitle))
                <h5>{{ $story->subtitle }}</h5>
            @endif
          @endif
          <!-- Full banner image area (displays only if it exists for this story) -->
          @if($fullBannerImage)
          <div class="small-12 columns">
              <div id="full-banner-image">
                <img src="{{$fullBannerImage->present()->mainImageURL }}" alt="{{ $fullBannerImage->alt_text != '' ? $fullBannerImage->alt_text : str_replace('"', "", $story->title) }}"></a>
                <div class="feature-image-caption">{{ $fullBannerImage->teaser }}</div>
              </div>
          </div>
          @endif
        </div>
        <!-- Story Page Content -->
        <div id="story-content" class="row">
                    {!! Form::model($story,[
                        'method' => 'put',
                        'route' => ['admin_preview_story_update', $story->id],
                        'files' => true
                    ]) !!}
          <!-- Story Content Column -->
          <div class="large-9 large-push-3 medium-9 medium-push-3 small-12 columns">
            @if(isset($mainStoryImage) && !isset($fullBannerImage))
            <div id="big-feature-image">
              <img src="{{$mainStoryImage->present()->mainImageURL }}" alt="{{ $mainStoryImage->alt_text != '' ? $mainStoryImage->alt_text : str_replace('"', "", $story->title) }}"></a>

              <div class="feature-image-caption">{{ $mainStoryImage->caption }}</div>
            </div>
          @endif
            @if($story->story_type != 'external')
              <div id="story-content-edit">
                  @php
                    if(isset($_GET['truepreview']) && $_GET['truepreview'] == "true"):
                  @endphp
                        <a href="?truepreview=false" class="button secondary"><i class="fa fa-exchange" aria-hidden="true"></i> Editable preview</a>
                        {!! Form::hidden('content') !!}
                        {!! $story->content !!}
                  @php
                    else:
                  @endphp
                    <a href="?truepreview=true" class="button secondary"><i class="fa fa-exchange" aria-hidden="true"></i> True preview</a>
                    {!! Form::textarea('content', null, ['class' => 'form-control', 'id' => 'cktextarea']) !!}
                  @php
                    endif
                  @endphp
              </div>
            @endif
          </div>
          <!-- Page Side Bar Column -->
          <div class="large-3 large-pull-9 medium-3 medium-pull-9 small-12 columns" id="story-sidebar">
            <div class="dots-bottom">
              <div class="addthis"><img src="/assets/imgs/icons/fake-addthis.png" /></div>
              <p class="story-publish-date">{{ Carbon\Carbon::parse($story->present()->publishedDate)->format('F d, Y') }}</p>
            </div>
            <div class="dots-bottom">
              <p>
                @if($story->story_type != 'featurephoto')
                  Written by:<br>
                  @if($story->author_id === 0)
                    @unless($story->author_info)
                      {{$story->user->first_name}} {{$story->user->last_name}}
                    @else
                      {{$story->author_info}}
                    @endif
                  @else
                      {{ $story->author->first_name }} {{ $story->author->last_name }}
                  @endif
                @else
                  Photo:<br>
                  {{$story->photo_credit}}
                @endif
              </p>
            </div>
            @if($story->story_type != 'featurephoto')
            <div class="dots-bottom">
              <p>
                Contact:<br>
                {{ $story->contact->first_name }} {{ $story->contact->last_name }}<br>
                <a href="mailto:{{ $story->contact->email }}">{{ $story->contact->email }}</a><br>
                {{ empty($story->contact->phone) ? '': $story->contact->phone }}
              </p>
            </div>
            @endif
          </div>
        </div><!-- /#story-content -->
                <div class="row">
                    <div class="medium-8 columns">
                      <div class="button-group">
                              {!! Form::submit('Update Story', ['class' => 'button']) !!}
                              {{-- <a class="secondary button" href="{{route('admin_storytype_edit', ['stype' => $story->story_type, 'story'=> $story->id])}}">Cancel</a> --}}
                      </div><!-- /.button-group -->
                      {!! Form::close() !!}
                    </div><!-- /.medium-8 columns -->
                    <div class="medium-4 columns">
                        <h6 class="subheader text-right">Start Date: {{$story->start_date}}</h6>
                    </div><!-- /.medium-4 columns -->
                </div><!-- /.row -->
      </div>

    </div>
  </div>

  @endsection

  @section('scriptsfooter')
  @parent
    <script>
    $(function () {
    CKEDITOR.inline( 'cktextarea', {
            // Define changes to default configuration here. For example:
            filebrowserBrowseUrl : '/themes/plugins/kcfinder/browse.php?opener=ckeditor&type=files',
            filebrowserImageBrowseUrl: '/themes/plugins/kcfinder/browse.php?opener=ckeditor&type=images',
            filebrowserUploadUrl : '/themes/plugins/kcfinder/upload.php?opener=ckeditor&type=files',
            filebrowserImageUploadUrl : '/themes/plugins/kcfinder/upload.php?opener=ckeditor&type=images'
        });
    });

    // $(document).ready(function(){
    //     $('.cke_widget_wrapper').css({'float':'none', 'background-color':'black'});
    // });
    </script>

  @endsection
