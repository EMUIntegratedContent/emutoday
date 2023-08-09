{{-- Magazine Article Page --}}
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
  @include('preview.includes.previewstory',['stype'=> $stype, 'gtype'=> $gtype, 'recordid' => $story->id, 'qtype'=> $qtype] )

@endsection
@section('offcanvaslist')
  @include('preview.includes.offcanvaslist')
@endsection
@section('connectionbar')
  @include('preview.magazine.partials.connectionbar')

@endsection
@section('content')
  <div id="news-story-bar" class="magazine-story">
    {!! Form::model($story,[
          'method' => 'put',
          'route' => ['admin_preview_story_update', $story->id],
          'files' => true
      ]) !!}
    <div id="story-content" class="row">
      <div class="large-9 medium-8 small-12 columns">
        <div id="issue-grouping" class="row">
          <div class="large-8 medium-8 small-12 columns">
            @if($magazine)
              <a href="/magazine/{{$magazine->year}}"><h2
                    class="issue-date news-caps">{{$magazine->season}} {{$magazine->year}}</h2></a>
            @else
              <a href="#"><h2 class="issue-date news-caps">Season Year</h2></a>
            @endif
          </div>
          <div class="large-4 medium-4 small-12 columns noleftpadding">
            <div class="addthis magazine-top"><a href=""><img src="/assets/imgs/icons/fake-sharethis.png" alt="addthis "></a>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="large-12 medium-12 small-12 columns">
            <h3>{{ $story->title }}</h3>
            <h5>{{ $story->subtitle }}</h5>
          </div>
        </div><!-- /.row -->
        <div id="big-feature-image">
          @if($mainImage)
            <img src="{{$mainImage->present()->mainImageURL}}" alt="feature-image">
            <div class="feature-image-caption">{{ $mainImage->caption }}</div>
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

        @if($story->author_id === 0)
          <div class="story-author">{{$story->user->first_name}} {{$story->user->last_name}}</div>
          <p class="news-contacts">Contact {{ $story->user->first_name }} {{ $story->user->last_name }}
            , {{ $story->user->email }}{{ empty($story->user->phone) ?'': ', ' . $story->user->phone  }}</p>
        @else
          <div class="story-author">{{ $story->author->first_name }} {{ $story->author->last_name }}</div>
          <p class="news-contacts">Contact {{ $story->contact->first_name }} {{ $story->contact->last_name }}
            , {{ $story->contact->email }}{{ empty($story->contact->phone) ? '': ', ' . $story->contact->phone }}</p>
        @endif
        <div class="row">
          <div class="medium-12 columns">
            <div class="button-group">
              {!! Form::submit('Update Story', ['class' => 'button']) !!}
            </div><!-- /.button-group -->
          </div><!-- /.medium-8 columns -->
        </div><!-- /.row -->
      </div>
      <div class="large-3 medium-4 small-12 columns featurepadding">
        <div class="featured-content-block magazine-block">
          <h6 class="headline-block">Popular stories</h6>
          <ul class="feature-list">
            @foreach ($sideStoryBlurbs as $ssblurb)
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
              <li><a href="/{{$newsstory->story_folder}}/{{$newsstory->id}}">{{$newsstory->title}}</a></li>
            @endforeach
          </ul>
        </div>
        <a class="button magazine-button expanded" href="mailto:dgiffor2@emich.edu">Subscribe</a>
        <a class="button magazine-button expanded" href="mailto:dgiffor2@emich.edu">Submit a Story Idea</a>
      </div>
    </div>
    {!! Form::close() !!}
  </div>
@endsection
@section('scriptsfooter')
  @parent
  <script src="/js/emu-ckeditor5-blade-config.js"></script>
@endsection
