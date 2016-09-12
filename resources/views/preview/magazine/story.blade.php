{{-- Magazine Article Page --}}
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
    @include('preview.includes.previewstory',['stype'=> $story->story_type, 'sroute'=> $sroute, 'recordid' => $story->id, 'form'=> $form] )

@endsection
@section('offcanvaslist')
    @include('preview.includes.offcanvaslist')
@endsection
  @section('connectionbar')
    @include('preview.magazine.partials.connectionbar')

  @endsection
@section('content')
      <div id="news-story-bar" class="magazine-story">
              <div id="story-content" class="row">
                  {!! Form::model($story,[
                      'method' => 'put',
                      'route' => ['admin_story_updatefrompreview', $story->id],
                      'files' => true
                  ]) !!}
            <div class="large-9 medium-8 small-12 columns">
              <div id="issue-grouping" class="row">
                <div class="large-8 medium-8 small-12 columns">
                    @if($magazine)
                        <a href="/emu-today/magazine/{{$magazine->year}}"><h2 class="issue-date news-caps">{{$magazine->season}} {{$magazine->year}}</h2></a>
                    @else
                        <a href="#"><h2 class="issue-date news-caps">Season Year</h2></a>
                    @endif
                </div>
                <div class="large-4 medium-4 small-12 columns noleftpadding">
                  <div class="addthis magazine-top"><a href=""><img src="/assets/imgs/icons/fake-addthis.png" alt="addthis "></a></div>
                </div>
              </div>
            <div class="row">
                <div class="large-8 medium-8 small-12 columns">
                    <h3>{{ $story->title }}</h3>
                    <h5>{{ $story->subtitle }}</h5>
                </div>
            </div><!-- /.row -->
             <div id="big-feature-image">
                 @if($mainImage)
                  <img src="{{$mainImage->present()->mainImageURL}}" alt="feature-image">
              @else
                  <img src="/assets/imgs/placeholder/article_front.jpg" alt="feature-image">

              @endif
              </div>
              <!-- Story Page Content -->

              <!-- <div class="magazine-titlebar"><img src="/assets/imgs/graphic-title.png" alt="Lost Voices"></div> -->
              {{-- {!! $story->content !!} --}}
              <div id="story-content-edit">
              {!! Form::textarea('content', null, ['class' => 'form-control', 'id' => 'cktextarea']) !!}
          </div>

              <div class="story-author">{{$authorInfo->full_name}}</div>
              <p class="news-contacts">{{$authorInfo->first_name}} {{$authorInfo->last_name}}, {{$authorInfo->email}}, {{$authorInfo->phone}}</p>
            </div>
            <div class="large-3 medium-4 small-12 columns featurepadding">
              <div class="featured-content-block magazine-block">
                <h6 class="headline-block">Popular stories</h6>
                <ul class="feature-list">
                    @foreach ($sideStoryBlurbs as $ssblurb)
                    {{-- <li><a href="/emu-today/{{$ssblurb->story->story_folder}}/{{$ssblurb->story->id}}">{{$ssblurb->caption}}</a></li> --}}
                        @if($ssblurb)
                            <li><a href="#">{{$ssblurb->caption}}</a></li>
                        @else
                            <li><a href="#">Missing article small caption</a></li>
                        @endif
                    @endforeach
                </ul>
              </div>
              <div class="featured-content-block magazine-block">
                <h6 class="headline-block">Headlines</h6>
                <ul class="feature-list">
                  @foreach ($sideNewsStorys as $newsstory)
                <li><a href="/emu-today/{{$newsstory->story_folder}}/{{$newsstory->id}}">{{$newsstory->title}}</a></li>
                @endforeach
                </ul>

              </div>
              <a class="button magazine-button expanded">Subscribe</a>
              <a class="button magazine-button expanded">Submit a Story Idea</a>


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
