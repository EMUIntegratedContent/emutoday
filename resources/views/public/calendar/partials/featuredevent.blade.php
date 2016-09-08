<div class="column">
  <div class="date-tag">{{$fevent->present()->eventFeaturedDateString }}</div>
  <img class="topic-image" src="/imagecache/featuredevent/{{$fevent->mediaFile->filename}}" alt="calendar-feature"/>
  <div class="calendar-content">
    <div class="calendar-text-content" data-equalizer-watch>
      <h6>{{$fevent->title}}</h6>
      <p>{{$fevent->present()->displayTimeRange }}</p>
      <p>{{$fevent->location}}</p>
    </div>
  </div>
</div>
