<template>
  <div class="calendar-box row">
    <div class="small-12 columns">
      <div class="calendar small-12 columns" data-equalizer>
        <div class="calendar-nav row small-collapse">
          <div class="small-2 columns">
            <a id="month-prev" v-on:click.prevent="newMonth('prev')" class="text-left" href=""><img
                src="/assets/imgs/calendar/green-calendar-arrow-before.png" alt="arrow"></a>
          </div>
          <div class="text-center calendar-title small-8 columns">
            <p>{{ selectedDate.monthVarWord }} {{ selectedDate.yearVar }}</p>
          </div>
          <div class="small-2 columns">
            <a id="month-next" v-on:click.prevent="newMonth('next')" class="text-right" href=""><img
                src="/assets/imgs/calendar/green-calendar-arrow-after.png" alt="arrow"></a>
          </div>
        </div>
        <div class="weekdays row small-up-7 small-collapse">
          <div class="column" data-equalizer-watch><span href="#">Sun</span></div>
          <div class="column" data-equalizer-watch><span href="#">Mon</span></div>
          <div class="column" data-equalizer-watch><span href="#">Tue</span></div>
          <div class="column" data-equalizer-watch><span href="#">Wed</span></div>
          <div class="column" data-equalizer-watch><span href="#">Thu</span></div>
          <div class="column" data-equalizer-watch><span href="#">Fri</span></div>
          <div class="column" data-equalizer-watch><span href="#">Sat</span></div>
        </div>
        <div class="days row small-up-7 small-collapse">
          <div class="column" v-for="item in calDaysArray" data-equalizer-watch>
            <a v-on:click.prevent="dispatchNewEvent( item.day )"
               v-bind:class="[{'istoday': item.day == currentDayInMonth },{'no-events': item.hasevents == noEventClass },{'yes-events': item.hasevents == yesEventClass },{'active': item.day == selectedDayInMonth}]"
               href="#"> {{ removex(item.day) }}</a>
          </div>
        </div>
      </div>

      <div class="row calendar-categories">
        <div class="small-12 column">
          <div class="calendar-other-categories">
            <a class="button hollow expanded academic-calednar-button prime"
               href="http://www.emich.edu/registrar/calendars/">ACADEMIC CALENDAR <i class="fa fa-external-link"
                                                                                     aria-hidden="true"></i></a>
            <h4>Event Categories</h4>
            <ul>
              <li class="event-category">
                <a v-on:click.prevent="dispatchNewEvent(selectedDayInMonth, false)" href="#">
                  <strong v-if="!selectedCalendarCategory">All Events</strong>
                  <span v-else>All Events</span>
                </a>
              </li>
              <template v-for="category in calendarCategories">
                <li class="event-category" v-if="category.events.length == 0 ?false:true">
                  <a v-on:click.prevent="dispatchNewEvent(selectedDayInMonth, category.id)"
                     href="#">
                    <strong v-if="selectedCalendarCategory == category.category">{{ category.category }}</strong>
                    <span v-else>{{ category.category }}</span>
                  </a>
                </li>
              </template>
            </ul>
          </div>
          <div class="calendar-other-categories">
            <h4>Other Calendars</h4>
            <ul class="other">
              <li><a href="http://art.emich.edu/events/upcoming">Art Galleries</a></li>
              <li><a href="https://www.emueagles.com/calendar.aspx">Athletics</a></li>
              <li><a href="http://www.emich.edu/campuslife/calendars/index.php">Campus Life</a></li>
              <li><a href="http://www.emich.edu/hr/working/employment/holidays.php">Holiday</a></li>
              <li><a href="http://www.emich.edu/emutheatre/">Theatre</a></li>
            </ul>
            <div class="submit-calendar">
              <a href="/calendar/event/form" class="button emu-button">Submit an Event</a>
            </div>
            <div class="ypsi-graphic">
              <a href="https://www.ypsireal.com/"><img src="/assets/imgs/calendar/visit-ypsi-real.png"
                                                       alt="Visit Ypsi Calendar"></a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<style>

.submit-calendar {
  padding: 0;
}

.ypsi-graphic {
  padding-bottom: 3rem;
  max-width: 140px;
}

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

.calendar-box {
  background: #f2f2f3;
  padding-top: 0.8rem;
}

.calendar-other-categories {
  padding-top: 0.8rem;
}

.calendar-sidebar-title h4 {
  text-transform: uppercase;
  color: #fff;
  margin-top: 0.5rem;
}

.calendar-text-content p {
  text-align: left;
}

.events-by-category .event-category a {
  font-size: .9rem;
}

.events-by-category .event-category span.badge {
  margin-right: 0.3rem;
}

.calendar .weekdays,
.calendar .days {
  font-size: 12px;
  color: #888;
  text-align: center;
  padding-top: 4px;
  padding-bottom: 4px;
}

.calendar .event-category span {
  font-size: 10px;
  text-transform: uppercase;
  font-weight: bold;
}

.calendar a {
  color: #0f654a;
  display: block;
  padding: 4px 0;
  border: 1px solid #f2f2f3;
}

.calendar a:hover {
  border-radius: 5px;
  text-decoration: none;
  border: 1px solid #0f654a;
}

.calendar a.istoday {
  border-radius: 5px;
  border: 1px solid #0f654a;
}

.calendar a.active {
  border-radius: 5px;
  border: 1px solid #0f654a;
  background: #fff;
}

.calendar a.noevents {
  pointer-events: none;
  color: #888;
}

.calendar a.yes-events {
  /*pointer-events: none;*/
  color: #0f654a;
}

.calendar a.no-events {
  pointer-events: none;
  color: #888;
}

.calendar-box caption {
  font-weight: 400;
  margin-bottom: .3rem;
}

.calendar-caption p {
  font-weight: 400;
  margin-bottom: 0.3rem;
}

.calendar-caption a {
  font-weight: 400;
  margin-bottom: 0.3rem;
  border: 1px none #000;
}

.calendar-nav a {
  border: none;
}

.calendar-nav a:hover {
  border: none;
}

.calendar-title p {
  font-weight: 400;
  padding: 4px 0;
}
</style>

<script>
import { mapState, mapMutations } from "vuex"

export default {
  components: {},
  props: {
    starthere: {},
  },
  data: function () {
    return {
      calevents: {},
      yearVar: '',
      monthVar: '',
      monthVarWord: '',
      dayVar: '',
      monthArray: [],
      currentDay: '',
      currentDate: {
        yearVar: '',
        monthVar: '',
        monthVarWord: '',
        dayVar: ''
      },
      selectedDate: {
        yearVar: '',
        monthVar: '',
        monthVarWord: '',
        dayVar: ''
      },
      newDate: {
        yearVar: '',
        monthVar: '',
        monthVarWord: '',
        dayVar: ''
      },
      yesEventClass: 'yes-events',
      noEventClass: 'no-events',
      haseventClass: 'no',
      selectedDay: '',
      calDaysArray: [],
      eventObject: {
        eoYear: '',
        eoMonth: '',
        eoDay: ''
      },
    }
  },
  computed: {
    ...mapState(['calendarCategories', 'selectedCalendarCategory']),
    currentDayInMonth () {
      if (this.yearVar == this.currentDate.yearVar) {
        if (this.monthVar == this.currentDate.monthVar) {
          return this.currentDate.dayVar;
        }
      }
      else {
        return '';
      }
    },
    selectedDayInMonth () {
      if (this.yearVar == this.selectedDate.yearVar) {
        if (this.monthVar == this.selectedDate.monthVar) {
          return this.selectedDate.dayVar;
        }
      }
      else {
        return '';
      }
    }
  },
  methods: {
    ...mapMutations(['setCalendarCategories', 'setSelectedCalendarCategory']),
    fetchEvents () {
      this.$http.get('/api/events')
      .then((response) => {
        this.monthArray = response.data.monthArray
        this.currentDay = response.data.dayInMonth
      }).catch((e) => {
        console.log(e)
      })
    },
    dispatchNewEvent (value, cateid) {
      // find the category name based on the id and set it as the selected one in the store
      if(cateid === false) {
        this.setSelectedCalendarCategory(null)
      } else if (cateid !== undefined) {
        this.setSelectedCalendarCategory(this.calendarCategories.find(c => c.id == cateid).category)
      }

      this.selectedDate.yearVar = this.yearVar;
      this.selectedDate.monthVar = this.monthVar;
      this.selectedDate.dayVar = value;
      this.selectedDay = value;

      // set category
      cateid ? this.selectedDate.cateid = cateid : null;
      // unset category
      (cateid === false) ? this.selectedDate.cateid = null : null;

      this.$emit('change-eobject', this.selectedDate);
    },
    fetchEventsByDay (value) {
      this.$http.get('/api/calendar/events/' + this.selectedDate.yearVar + '/' + this.selectedDate.monthVar + '/' + value)
      .then((response) => {
        this.selectedDate.yearVar = response.data.yearVar
        this.selectedDate.monthVar = response.data.monthVar
        this.selectedDate.monthVarWord = response.data.monthVa
        this.elist = response.data.groupedByDay
      }).catch((e) => {
        console.log(e)
      })
    },
    newMonth (monthkey) {
      let newMonthVarUnit
      let newYearVar
      if (monthkey == 'prev') {
        if (this.monthVar == 1) {
          newMonthVarUnit = 12
          newYearVar = this.yearVar - 1
        }
        else {
          newMonthVarUnit = this.monthVar - 1
          newYearVar = this.yearVar
        }
      }
      else {
        if (this.monthVar == 12) {
          newMonthVarUnit = 1
          newYearVar = this.yearVar + 1
        }
        else {
          newMonthVarUnit = this.monthVar + 1
          newYearVar = this.yearVar
        }
      }
      this.fetchEventsForCalendarMonth(newYearVar, newMonthVarUnit)
    },
    fetchEventsForCalendarMonth (pyear, pmonth) {
      this.yearVar = pyear
      this.monthVar = pmonth
      const apiurl = '/api/calendar/month/' + pyear + '/' + pmonth
      this.$http.get(apiurl)
      .then((response) => {
        this.calDaysArray = response.data.calDaysArray
        this.monthArray = response.data.monthArray

        this.selectedDate.yearVar = response.data.selectedYear
        this.selectedDate.monthVar = response.data.selectedMonth
        this.selectedDate.monthVarWord = response.data.selectedMonthWord
        this.selectedDate.dayVar = response.data.selectedDay

        this.fetchCategoryList()
      }).catch((e) => {
        console.log(e)
      })
    },
    fetchCurrentEventsForCalendar (startObject) {
      this.yearVar = startObject.yearVar
      this.monthVar = startObject.monthVar
      this.dayVar = startObject.dayVar
      const startapiurl = '/api/calendar/month/' + this.yearVar + '/' + this.monthVar + '/' + this.dayVar
      this.$http.get(startapiurl)
      .then((response) => {
        this.selectedDate.yearVar = response.data.selectedYear
        this.selectedDate.monthVar = response.data.selectedMonth
        this.selectedDate.monthVarWord = response.data.selectedMonthWord
        this.selectedDate.dayVar = response.data.selectedDay
        this.currentDate.yearVar = response.data.currentYear
        this.currentDate.monthVar = response.data.currentMonth
        this.currentDate.monthVarWord = response.data.currentMonthWord
        this.currentDate.dayVar = response.data.currentDay
        this.calDaysArray = response.data.calDaysArray
        this.pushFirstDateRange()
        this.fetchCategoryList()
      }).catch((e) => {
        console.log(e)
      })
    },
    pushFirstDateRange () {
      this.$emit('change-eobject', this.selectedDate)
    },
    fetchCategoryList () {
      this.$http.get('/api/active-categories/' + this.selectedDate.yearVar + '/' + this.selectedDate.monthVar)
      .then((response) => {
        this.setCalendarCategories(response.data)
      }).catch((e) => {
        console.log(e)
      })
    },
    removex (val) {
      return (val[0] == 'x') ? '_' : val
    }
  },
  watch: {
    starthere (newVal) { // watch it
      this.fetchCurrentEventsForCalendar(newVal);
    }
  },
}
</script>
