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
          <div class="large-5 medium-4 small-6 columns">{{-- <h3 class="news-caps">{{$story->story_type}}</h3> --}}</div>
          <div class="large-2 medium-4 small-6 columns">
            <p class="story-publish-date">{{ Carbon\Carbon::parse($story->present()->publishedDate)->format('F d, Y') }}</p>
          </div>
          <div class="large-5 medium-4 hide-for-small columns">
            <p class="small-return-news"><a href="/news">News Home</a></p>
          </div>
        </div>
        <!-- Story Page Content -->
        <div id="story-content" class="row">
                    {!! Form::model($story,[
                        'method' => 'put',
                        'route' => ['admin_preview_story_update', $story->id],
                        'files' => true
                    ]) !!}
          <!-- Story Content Column -->
          <div class="large-9 medium-8 small-12 columns">
            <div class="addthis"><img src="/assets/imgs/icons/fake-addthis.png" /></div>
            <h3>{{ $story->title }}</h3>
            @if($story->story_type != 'featurephoto')
              @if(isset($story->subtitle))
                  <h5>{{ $story->subtitle }}</h5>
              @endif
            @endif
            @if(isset($mainStoryImage))
            <div id="big-feature-image">
              <img src="{{$mainStoryImage->present()->mainImageURL }}" alt="feature-image"></a>

              <div class="feature-image-caption">{{ $mainStoryImage->caption }}</div>
            </div>
          @endif
            @if($story->story_type != 'featurephoto' && $story->story_type != 'external')
              <div id="story-content-edit">
              {!! Form::textarea('content', null, ['class' => 'form-control', 'id' => 'cktextarea']) !!}
              </div>
            @endif

        @if($story->story_type != 'featurephoto')
          @if($story->author_id === 0)
          <div class="story-author">{{$story->user->first_name}} {{$story->user->last_name}}</div>
          <p class="news-contacts">Contact {{ $story->user->first_name }} {{ $story->user->last_name }}, {{ $story->user->email }}{{ empty($story->user->phone) ?'': ', ' . $story->user->phone  }}</p>
          @else
          <div class="story-author">{{ $story->author->first_name }} {{ $story->author->last_name }}</div>
          <p class="news-contacts">Contact {{ $story->contact->first_name }} {{ $story->contact->last_name }}, {{ $story->contact->email }}{{ empty($story->contact->phone) ? '': ', ' . $story->contact->phone }}</p>
          @endif
        @else
          <p class="news-contacts">Photo credit: {{$story->photo_credit}}</p>
        @endif
          </div>
          <!-- Page Side Bar Column -->
          <div class="large-3 medium-4 small-12 columns featurepadding">
              @if(isset($sideStoryBlurb))
                  @if(count($sideStoryBlurbs)>0)
                      @include('public.components.sideblock', ['sidetitle' => 'Featured Stories','storytype'=> 'story', 'sideitems' => $sideStoryBlurbs])
                    @endif
                    @if(count($sideStudentBlurbs)>0)
                        @include('public.components.sideblock', ['sidetitle' => "<span class='truemu'>EMU</span> student profiles",'storytype'=> 'student', 'sideitems' => $sideStudentBlurbs])

                    @endif
  @endif
                    </div>
                </div>

                <div class="row">
                    <div class="medium-8 columns">

                    </div><!-- /.medium-8 columns -->
                    <div class="medium-4 columns">
                        <h6 class="subheader text-right">Start Date: {{$story->start_date}}</h6>
                    </div><!-- /.medium-4 columns -->
                </div><!-- /.row -->
                <div class="row">
                    <div class="medium-6 columns">
                        <div class="button-group">
                                {!! Form::submit('Update Story', ['class' => 'button']) !!}
                                {{-- <a class="secondary button" href="{{route('admin_storytype_edit', ['stype' => $story->story_type, 'story'=> $story->id])}}">Cancel</a> --}}

                        </div><!-- /.button-group -->


                        {!! Form::close() !!}
                    </div><!-- /.medium-6 columns -->
                    <div class="medium-6 columns">


                    </div><!-- /.medium-6 columns -->
                </div><!-- /.row -->
      </div>

    </div>
  </div>

  @endsection

  @section('scriptsfooter')
  @parent
    <script>
    $(function () {
    // var storycontent = document.getElementById('story-content-edit');
    // storycontent.setAttribute('contenteditable', true);
    CKEDITOR.inline( 'cktextarea', {
            // Define changes to default configuration here. For example:
                filebrowserBrowseUrl : '/themes/plugins/kcfinder/browse.php?opener=ckeditor&type=files',
                filebrowserImageBrowseUrl: '/themes/plugins/kcfinder/browse.php?opener=ckeditor&type=images',
                filebrowserUploadUrl : '/themes/plugins/kcfinder/upload.php?opener=ckeditor&type=files',
                filebrowserImageUploadUrl : '/themes/plugins/kcfinder/upload.php?opener=ckeditor&type=images'
        });
    });
    </script>

  @endsection
