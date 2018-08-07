<div class="column">
  <div class="date-tag">{{$fevent->present()->eventFeaturedDateString }}</div>
  <img class="topic-image" src="/imagecache/featuredevent/{{$fevent->mediaFile->filename}}" alt="{{ $fevent->mediaFile->alt_text != '' ? $fevent->mediaFile->alt_text : str_replace('"', "", $fevent->title) }}"/>
  <div class="calendar-content">
    <div class="calendar-text-content" data-equalizer-watch>
      <h6><a href="/calendar/{{$fevent->present()->eventStartDateYear}}/{{$fevent->present()->eventStartDateMonthUnit}}/{{$fevent->present()->eventStartDateDay}}/{{$fevent->id}}">{{$fevent->title}}</a></h6>
    </div>
  </div>
</div>
