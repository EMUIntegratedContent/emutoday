<template>
    <div class="row">
      <div id="calendar-content-bar">
        <div class="medium-3 show-for-medium columns">
          <event-view-side-bar v-on:change-eobject="handleEventFetch"></event-view-side-bar>
      </div>
      <div class="medium-9 small-12 columns">
        <!-- <event-view-content :elist.sync="eventlist"></event-view-content> -->
        <event-view-content :elist.sync="eventlist"></event-view-content>
      </div>
    </div>
  </div>
</template>
<style scoped>
#calendar-content-bar {
    background-color: #bebdbd;
}
</style>
<script>
    import EventViewSideBar from './EventViewSideBar.vue'
    import EventViewContent from './EventViewContent.vue'
      export default  {
        components: { EventViewSideBar, EventViewContent},
        props: [ 'varYearUnit', 'varMonthUnit','varDayUnit', ],
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
            this.$http.get('/api/calendar/events/' + eobject.yearVar + '/'+ eobject.monthVar + '/' + eobject.dayVar).then(function(response) {
             this.$broadcast('responseCalEvent', response.data)
            console.log('handleEventFetch========' + response.data );

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
          // 'child-msg': function (msg) {
          //   // `this` in event callbacks are automatically bound
          //   // to the instance that registered it
          //   this.messages.push(msg)
          // }
        }
    }
</script>
