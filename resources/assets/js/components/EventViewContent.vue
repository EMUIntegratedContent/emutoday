<template>
  <div class="calendar-bar row">
    <div class="small-12 columns">
      <h4>Upcoming Events</h4>
    </div>
  </div>
  <div class="calendar-content">
    <div class="calendar-content-title row">
      <div class="small-12 column">
          <h6>From {{firstDate}} thru {{lastDate}}</h6>
      </div>
    </div>
    <div class="calendar-content-content row">
      <div class="small-12 columns">
        <div v-for="eitem in elist">
          <div class="event-day">
              <h4>{{$key | titleDateLongWithYear }}</h4>
              <event-view-single
                v-for="item in eitem"
                  :item="item"
                  :index="$index">
                </event-view-single>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<style>
    .calendar-bar {
        background: #bebdbd;
    }
    .calendar-bar h4 {
      text-transform: uppercase;
      color: #fff;
      font-size: 1.2rem;
      margin-top: 0.5rem;
      margin-bottom: 0.5rem;
    }

    .calendar-content-title {
      padding-top: 0.8rem;
    }

    .calendar-content-title h4{
      text-transform: uppercase;
      color: #fff;
        margin-top: 0.5rem;
    }
    .calendar-content-content{
      background: #fff;
    }
    .calendar-content-content h4 {
      line-height: 1.4rem;
      font-size: 1.3rem;
      font-weight: 600;
    }

    .event-day {
        margin: 0.8rem 0 0 0;
    }
</style>
<script>
import moment from 'moment'
import EventViewSingle from './EventViewSingle.vue'
module.exports  = {
    components: {EventViewSingle},
    props:  {
        elist: {},
        eventlist: []
    },
    data: function() {
        return {
            monthVar: '',
            yearVar: '',
            dayVar: '',
            firstDate: '',
            lastDate: '',
            monthVarUnit: '',
            eventRange: {},
            hasevents: 0,
        }
    },
    created: function() {
        console.log('EventViewContent Created');
    },
    ready: function() {
        console.log('EventViewContent Ready');
    },
    computed: {
        currentDate: function () {
            return this.monthVar+ ' ' + this.dayVar + ', ' + this.yearVar;
        },
        dateRange: function () {
            return 'From '+ this.firstDate + ' thru ' + this.lastDate;
        }
    },
    methods: {
        sortKeyInt: function ($key) {
            return parseInt($key);
        },
        updateCalEvent: function(edata){
            this.monthVar = edata.monthVar;
            this.yearVar = edata.yearVar;
            this.dayVar = edata.dayVar;
            this.elist = edata.groupedByDay;
            this.firstDate = edata.firstDate;
            this.lastDate = edata.lastDate;
            console.log('fd='+this.firstDate );
            this.hasevents = this.elist ? 1: 0;
        },
        fetchEventsByDay: function(value) {
            alert(value);
        },
    },
    events: {'responseCalEvent': 'updateCalEvent'},
    watch: {},
    filters: {
        titleDay: function (value) {
            return  moment(value).format("ddd")
        },
        titleDate: function (value) {
            return  moment(value).format("MM/DD")
        },
        titleDateLongWithYear: function (value) {
            console.log('titleDateLongWithYear=' + value)
            let m = moment(value, "YYYY-MM-DD");
            if (m.isValid()) {
                return  moment(m).format("ddd MMM Do, YYYY")
            } else {
                console.log(m.invalidAt())
            }
        },
        reformatDate: function (value) {
            var arr = value.split('-');
            return arr[1] + '/' + arr[2] + '/' + arr[0];
        },
        yesNo: function(value) {
            return (value == 1) ? 'Yes' : 'No';
        }
    }
};
</script>
