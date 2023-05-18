<template>
  <div class="calendar-content">
    <div class="calendar-content-title row">
      <div class="small-12 column">
        <h6>From {{ firstDate }} thru {{ lastDate }}</h6>
      </div>
    </div>
    <div class="calendar-content-content row">
      <div class="small-12 columns">
        <div v-for="(eitem, key, index) in elist">
          <div class="event-day">
            <h4>{{ titleDateLongWithYear(key) }}</h4>
            <event-view-single
                v-for="item in eitem"
                :key="item.id"
                :item="item"
                :index="index"
                :targeteventid="eventid">
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
  background: #fff;
}

.calendar-content-title h4 {
  text-transform: uppercase;
  color: #fff;
  margin-top: 0.5rem;
}

.calendar-content-content {
  background: #fff;
}

.calendar-content-content h4 {
  margin-top: 1.5rem;
  line-height: 1.4rem;
  font-size: 1.3rem;
  font-weight: 600;
}

.calendar-content {
  background: #fff;
}

.event-day {
  margin: 0.8rem 0 0 0;
}
</style>
<script>
import moment from 'moment'
import EventViewSingle from './EventViewSingle.vue'

export default {
  components: { EventViewSingle },
  props: {
    edata: {},
    eventid: null,
  },
  data: function () {
    return {
      elist: {},
      monthVar: '',
      yearVar: '',
      dayVar: '', firstDate: '',
      lastDate: '',
      monthVarUnit: '',
      eventRange: {},
      hasevents: 0,
    }
  },
  computed: {
    currentDate () {
      return this.monthVar + ' ' + this.dayVar + ', ' + this.yearVar;
    },
    dateRange () {
      return 'From ' + this.firstDate + ' thru ' + this.lastDate;
    }
  },
  methods: {
    titleDateLongWithYear (value) {
      let m = moment(value, "YYYY-MM-DD")
      if (m.isValid()) {
        return  moment(m).format("ddd MMM D, YYYY")
      }
      return 'N/A'
    },
    updateCalEvent (edata) {
      this.monthVar = edata.monthVar;
      this.yearVar = edata.yearVar;
      this.dayVar = edata.dayVar;
      this.elist = edata.groupedByDay;
      this.firstDate = edata.firstDate;
      this.lastDate = edata.lastDate;
      this.hasevents = this.elist ? 1 : 0;
    }
  },
  watch: {
    edata (newVal) {
      this.updateCalEvent(newVal)
    }
  }
};
</script>
