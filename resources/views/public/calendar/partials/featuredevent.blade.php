<div class="column">
  <div class="date-tag">{{$fevent->present()->eventFeaturedDateString }}</div>
  <img class="topic-image" src="/imagecache/featuredevent/{{$fevent->mediaFile->filename}}" alt="calendar-feature"/>
  <div class="calendar-content">
    <div class="calendar-text-content" data-equalizer-watch>
      <h6><a href="/calendar/{{$fevent->present()->eventStartDateYear}}/{{$fevent->present()->eventStartDateMonthUnit}}/{{$fevent->present()->eventStartDateDay}}/{{$fevent->id}}">{{$fevent->title}}</a></h6>
      @if ($fevent->all_day)
        <p>All Day</p>
      @else
        <p>{{$fevent->present()->displayTimeRange }}</p>
      @endif
    </div>
  </div>
</div>
