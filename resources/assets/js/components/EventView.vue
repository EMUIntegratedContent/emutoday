<template>
    <div id="graybar">
        <div class="calendar-bar row">
      <div class="medium-3 show-for-medium columns">
          <h4>Calendar</h4>
      </div>
      <div class="medium-6 small-7 columns">
        <h4>Upcoming Events</h4>
      </div>
      <div class="medium-3 small-5 columns">
        <a class="button hollow secondary expanded academic-calednar-button" href="http://www.emich.edu/registrar/calendars/">ACADEMIC CALENDAR <i class="fa fa-external-link" aria-hidden="true"></i></a>
      </div>
    </div>
    </div>
    <div class="row">
      <div id="calendar-content-bar">
        <div class="medium-9 small-12 columns pull-right">
          <!-- <event-view-content :elist.sync="eventlist"></event-view-content> -->
          <event-view-content :eventid.once="eventid" :elist.sync="eventlist"></event-view-content>
          <br />
                <p>*All calendar items are subject to change.</p><br />
                <p>The EMU calendar is maintained by the <a href="http://emich.edu/communications">Division of Communications</a> and includes events sponsored by University departments and student organizations.</p><br />
                <p>Eastern Michigan University reserves the right to edit information as necessary for accuracy and completeness and to refuse submissions for any reason. Please allow one or two working days for approval.</p><br />
         </div>
        </div>
        <div class="small-12 medium-3 show-for-small columns pull-left">
          <event-view-side-bar v-on:change-eobject="handleEventFetch"></event-view-side-bar>
        </div>
      </div>
    </div>
</template>
<style scoped>
.pull-right {
    float:right;
}
#graybar{
    width: 100%;
    padding: .3rem 0;
    background-color: #bebdbd;
}
#calendar-content-bar {
    background-color: #bebdbd;
}
</style>
<script>
    import EventViewSideBar from './EventViewSideBar.vue'
    import EventViewContent from './EventViewContent.vue'
      export default  {
        components: { EventViewSideBar, EventViewContent},
        props: [ 'varYearUnit', 'varMonthUnit','varDayUnit','eventid' ],
        data: function() {
          return {
            startEventObject: {},
            eventlist: [],
            aobject : {
              year: '',
              monthUnit: '',
              month: '',
              day: '',
            }
          }
        },
        ready() {
            console.log('EventView Ready');
            this.freshPageLand();
        },
        methods : {
          handleEventFetch: function(eobject) {
            eobject.cateid ? route = '/api/calendar/events/' + eobject.yearVar + '/'+ eobject.monthVar + '/' + eobject.dayVar + '/' + eobject.cateid : route = '/api/calendar/events/' + eobject.yearVar + '/'+ eobject.monthVar + '/' + eobject.dayVar;

            this.$http.get(route).then(function(response) {
            this.$broadcast('responseCalEvent', response.data)

            });
          },
          freshPageLand: function() {

              this.startEventObject.yearVar = this.varYearUnit;
              this.startEventObject.monthVar = this.varMonthUnit;
              this.startEventObject.dayVar = this.varDayUnit;

             this.$broadcast('startFromThisDate', this.startEventObject);
          }
        },
        // the `events` option simply calls `$on` for you
        // when the instance is created
        events: {
        }
    }
</script>
