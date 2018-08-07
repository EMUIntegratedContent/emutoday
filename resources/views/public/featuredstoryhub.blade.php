<div class="column">
  <div class="card" >
    <img class="story-image" src="/imagecache/original/{{$fstory->filename}}" alt="{{ $fstory->alt_text != '' ? $fstory->alt_text : str_replace('"',"",$fstory->story->title) }}" style="display: block;"/>
    <div class="card-section" data-equalizer-watch>
            <p class="more-story-caption">{{$fstory->caption}}</p>
            <p class="link-group">
                @if($fstory->story->story_type == 'external')
                    @if($fstory->story->tags()->first())
                        @if($fstory->story->tags()->first()->name == 'video')
                            <a href="{{$fstory->link}}"
                               aria-label="{{$fstory->caption}} - Watch" class="readmore bold-green-link">Watch&nbsp;<i
                                        class="fa fa-arrow-right"></i></a>
                        @elseif($fstory->story->tags()->first()->name == 'audio')
                            <a href="{{$fstory->link}}"
                               aria-label="{{$fstory->caption}} - Listen" class="readmore bold-green-link">Listen&nbsp;<i
                                        class="fa fa-arrow-right"></i></a>
                        @elseif($fstory->story->tags()->first()->name == 'gallery')
                            <a href="{{$fstory->link}}"
                               aria-label="{{$fstory->caption}} - Gallery" class="readmore bold-green-link">View
                                Gallery&nbsp;<i class="fa fa-arrow-right"></i></a>
                        @else
                            @if($fstory->moretext != "")
                                <a href="{{$fstory->link}}"
                                   aria-label="{{$fstory->caption}} - {{$fstory->moretext}}"
                                   class="readmore bold-green-link">{{$fstory->moretext}}&nbsp;<i
                                            class="fa fa-arrow-right"></i></a>
                            @else
                                <a href="{{$fstory->link}}"
                                   aria-label="{{$fstory->caption}} - Read Story"
                                   class="readmore bold-green-link">Read Story&nbsp;<i
                                            class="fa fa-arrow-right"></i></a>
                            @endif
                        @endif
                    @else
                        @if($fstory->moretext != "")
                            <a href="{{$fstory->link}}"
                               aria-label="{{$fstory->caption}} - {{$fstory->moretext}}"
                               class="readmore bold-green-link">{{$fstory->moretext}}&nbsp;<i
                                        class="fa fa-arrow-right"></i></a>
                        @else
                            <a href="{{$fstory->link}}"
                               aria-label="{{$fstory->caption}} - Read Story" class="readmore bold-green-link">Read
                                Story&nbsp;<i class="fa fa-arrow-right"></i></a>
                        @endif
                    @endif
                @elseif($fstory->story->story_type == 'article')
                    @if($fstory->story->tags()->first())
                        @if($fstory->story->tags()->first()->name == 'external')
                            <a href="{{$fstory->link}}"
                               aria-label="{{$fstory->caption}} - {{$fstory->moretext}}"
                               class="readmore bold-green-link">{{$fstory->moretext}}&nbsp;<i
                                        class="fa fa-arrow-right"></i></a>
                        @else
                            <a href="/story/{{$fstory->story->story_type}}/{{$fstory->story->id}}"
                               aria-label="{{$fstory->caption}} - {{$fstory->moretext}}"
                               class="readmore bold-green-link">{{$fstory->moretext}} <i
                                        class="fa fa-arrow-right"></i></a>
                        @endif
                    @else
                        <a href="/story/{{$fstory->story->story_type}}/{{$fstory->story->id}}"
                           aria-label="{{$fstory->caption}} - {{$fstory->moretext}}"
                           class="readmore bold-green-link">{{$fstory->moretext}} <i
                                    class="fa fa-arrow-right"></i></a>
                    @endif
                @elseif($fstory->story->story_type == 'featurephoto')
                    <a href="/story/{{$fstory->story->story_type}}/{{$fstory->story->id}}"
                       aria-label="{{$fstory->caption}} - View" class="readmore bold-green-link">View Image&nbsp;
                        <i class="fa fa-arrow-right"></i></a>
                @else
                    <a href="/story/{{$fstory->story->story_type}}/{{$fstory->story->id}}"
                       aria-label="{{$fstory->caption}} - {{$fstory->moretext}}"
                       class="readmore bold-green-link">{{$fstory->moretext}} <i class="fa fa-arrow-right"></i></a>
                @endif
            </p>
    </div>
  </div><!-- /end .card -->
</div>
