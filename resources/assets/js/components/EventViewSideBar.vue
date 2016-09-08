<template>
  <div class="calendar-bar row">
    <div class="small-12 column">
        <h4>Calendar</h4>
    </div>
  </div>
<div class="calendar-box row">
    <div class="small-12 columns">
      <div class="calendar small-12 columns" data-equalizer>
        <div class="calendar-nav row small-collapse">
            <div class="small-2 columns">
              <a id="month-prev" v-on:click.prevent="newMonth('prev')" class="text-left" href=""><img src="/assets/imgs/calendar/green-calendar-arrow-before.png" alt="arrow"></a>
          </div>
          <div class="text-center calendar-title small-8 columns">
              <p>{{selectedDate.monthVarWord}} {{selectedDate.yearVar}}</p>
          </div>
          <div class="small-2 columns">
            <a id="month-next" v-on:click.prevent="newMonth('next')" class="text-right" href=""><img src="/assets/imgs/calendar/green-calendar-arrow-after.png" alt="arrow"></a>
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

          <a v-on:click.prevent="dispatchNewEvent( item.day )" v-bind:class="[{'istoday': item.day == currentDayInMonth },{'no-events': item.hasevents == noEventClass },{'yes-events': item.hasevents == yesEventClass },{'active': item.day == selectedDayInMonth}]"  href="#"> {{item.day | removex }}</a>
        </div>
      </div>
    </div>

  <div class="row calendar-categories">
    <div class="small-12 column">
      <h4>Categories</h4>
    </div>
  </div>
  <div class="row small-collapse calendar-categories">
    <template v-for="category in categories">
      <div class="event-category" v-if="category.events.length == 0 ?false:true">
        <div class="small-12 medium-12 large-10  columns">
          <a href="#" aria-describedby="{{category.slug}}-badge">{{category.category}}</a>
        </div>
        <div class="show-for-large large-2 columns">
          <span id="{{category.slug}}-badge" class="secondary badge">{{category.events.length}}<span>
          </div>
        </div>
      </template>
    </div>
    <div class="calendar-other-categories">
              <h4>Other Calendars</h4>
              <ul>

                <li><a href="">Art Galleries</a></li>
                <li><a href="">Athletics</a></li>
                <li><a href="">Holiday &amp; Payroll</a></li>
                <li><a href="">Theatre</a></li>
              </ul>
            </div>
            <div class="ypsi-graphic">
              <a href="http://visitypsinow.com/local-events/"><img src="/assets/imgs/calendar/visit-ypsi.png" alt="Visit Ypsi Calendar"></a>
            </div>
            <div class="submit-calendar">
              <a class="button emu-button">Submit an Event</a>
            </div>

  </div>
</div>


</template>
<style>

    .submit-calendar {
      padding-left: 0;
      padding-bottom: 1rem;
    }
    .calendar-bar {
        background: ##bebdbd;
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
    /*.calendar-sidebar-content{
      background: #ffffff;
    }*/
    .calendar-sidebar-title h4{
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

      /*.calendar ul {
        padding: 15px;
        background: #f3f3f3;
        margin: 0;
      }*/
      .calendar .weekdays,
      .calendar .days {
        font-size: 12px;
        color: #888;
        text-align: center;
        padding-top: 4px;
        padding-bottom: 4px;
      }
      /*.calendar ul.days
       {
         border: 1px solid  #000;
        padding: 10px 15px 3px;
        background: #f9f9f9;
      }
      .calendar ul li {
        list-style-type: none;
        display: inline-block;
        width: 12.8%;
        height: 25px;
        font-size: 12px;
        color: #888;
        text-align: center;
        margin-bottom: 4px;

      }*/
      .calendar .event-category span {
        font-size: 10px;
        text-transform: uppercase;
        font-weight: bold;
      }

      .calendar  a {
        color: #0f654a;
        display: block;
        padding: 4px 0;
        border: 1px solid  #f2f2f3;
      }
      .calendar a:hover {
        border-radius: 5px;
        /*background: #0f654a;*/
        /*color: #fff;*/
        text-decoration: none;
        border: 1px solid  #0f654a;
      }
      .calendar  a.istoday {
        border-radius: 5px;
        border: 1px solid  #0f654a;
        /*padding: 2px 0;*/
      }
      .calendar  a.active {
        border-radius: 5px;
        border: 1px solid  #0f654a;

          background: #fff;
        /*padding: 2px 0;*/
      }
    .calendar  a.noevents {
           pointer-events: none;
             color: #888;
      }
      .calendar  a.yes-events {
             /*pointer-events: none;*/
               color: #0f654a;
        }
      .calendar  a.no-events {
             pointer-events: none;
               color: #888;
        }

      .calendar-box caption{
        font-weight:400;
        margin-bottom: .3rem;
    }
    .calendar-caption p{
      font-weight: 400;
      margin-bottom: 0.3rem;
    }

    .calendar-caption a {
      font-weight: 400;
      margin-bottom: 0.3rem;
      border: 1px none  #000;
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
    /*a#month-prev, a#month-next {
      border: none;
    }
    a#month-prev :hover, a#month-next :hover{
      border: none;
    }*/
</style>

<script>
module.exports  = {
    components: {},
    props: {
        elist:{}
    },
    data: function() {
        return {
            categories: {},
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
            selectedDay : '',
            calDaysArray: [],
            eventObject: {
                eoYear: '',
                eoMonth: '',
                eoDay: ''
            },
        }
    },
    created: function() {
        //  this.fetchCurrentEventsForCalendar();
        // this.fetchCategoryList();
    },
    ready: function() {
        console.log('EventSideBar Ready')
    },
    computed: {
        currentDayInMonth: function () {
            if (this.yearVar == this.currentDate.yearVar) {
                if (this.monthVar == this.currentDate.monthVar)
                return this.currentDate.dayVar;
            } else {
                return '';
            }

        },
        selectedDayInMonth: function () {
            if (this.yearVar == this.selectedDate.yearVar) {
                if (this.monthVar == this.selectedDate.monthVar)
                return this.selectedDate.dayVar;
            } else {
                return '';
            }

        },
    },
    methods: {
        fetchEvents: function() {
            this.$http.get('/api/events', function(data) {
                this.monthArray = response.data.monthArray;
                this.currentDay = response.data.dayInMonth;
            });
        },
        dispatchNewEvent: function(value){
            this.selectedDate.yearVar = this.yearVar;
            // this.eventObject.eoYear = this.yearVar;
            this.selectedDate.monthVar = this.monthVar;
            // this.eventObject.eoMonth = this.monthVarUnit;
            this.selectedDate.dayVar = value;
            //this.eventObject.eoDay = value;
            this.selectedDay = value;
            this.$dispatch('change-eobject',  this.selectedDate);

        },
        // fetchEventsByDay: function(value) {
        //
        //   this.$http.get('/api/calendar/events/' + this.selectedDate.yearVar + '/'+ this.selectedDate.monthVar + '/' + value).then(function(response) {
        //     this.selectedDate.yearVar = response.data.yearVar;
        //     this.selectedDate.monthVar = response.data.monthVar;
        //     this.selectedDate.monthVarWord = response.data.monthVa;
        //   this.elist = response.data.groupedByDay;
        //
        //     console.log(response.data);
        //   });
        // },
        newMonth: function (monthkey) {
            console.log('this.yearVar=' + this.yearVar + ' this.monthVar= '+ this.monthVar)
            var newMonthVarUnit;
            var newYear;
            if (monthkey == 'prev') {
                if (this.monthVar == 1) {
                    newMonthVarUnit = 12;
                    newYearVar = this.yearVar - 1;
                } else {
                    newMonthVarUnit = this.monthVar -1;
                    newYearVar = this.yearVar;
                }
            } else {
                if (this.monthVar == 12) {
                    newMonthVarUnit = 1;
                    newYearVar = this.yearVar + 1;
                } else {
                    newMonthVarUnit = this.monthVar +1;
                    newYearVar = this.yearVar;
                }
            }
            this.fetchEventsForCalendarMonth(newYearVar,newMonthVarUnit);

        },
        fetchEventsForCalendarMonth: function(pyear, pmonth) {
            this.yearVar = pyear;
            this.monthVar = pmonth;
            // this.monthVarWord = response.data.monthVarWord;
            //this.dayVar = response.data.dayInMonth;
            console.log('pyear='+ pyear + 'pmonth='+pmonth)
            apiurl = '/api/calendar/month/' +pyear +'/'+pmonth;
            this.$http.get(apiurl).then(function(response) {


                this.$set('calDaysArray', response.data.calDaysArray)
                this.$set('monthArray', response.data.monthArray)

            //    this.monthArray = response.data.monthArray;


                //this.calDaysArray = response.data.calDaysArray;
                this.selectedDate.yearVar = response.data.selectedYear;
                this.selectedDate.monthVar = response.data.selectedMonth;
                this.selectedDate.monthVarWord = response.data.selectedMonthWord;
                this.selectedDate.dayVar = response.data.selectedDay;

                // this.yearVar = response.data.yearVar;
                // this.monthVar = response.data.monthVar;
                // this.monthVarWord = response.data.monthVarWord;
                //this.dayVar = response.data.dayInMonth;
                console.log(response.data);
                //  this.pushFirstDateRange();
                this.$emit('responseCategoriesEvent');
            });
        },
        fetchCurrentEventsForCalendar: function(startObject) {
            this.yearVar = startObject.yearVar;
            this.monthVar = startObject.monthVar;
            this.dayVar = startObject.dayVar;
            startapiurl = '/api/calendar/month/' +this.yearVar +'/'+this.monthVar +'/'+this.dayVar;
            // this.$http.get('/api/calendar/month').then(function(response) {
            this.$http.get(startapiurl).then(function(response) {
                this.selectedDate.yearVar = response.data.selectedYear;
                this.selectedDate.monthVar = response.data.selectedMonth;
                this.selectedDate.monthVarWord = response.data.selectedMonthWord;
                this.selectedDate.dayVar = response.data.selectedDay;
                this.currentDate.yearVar = response.data.currentYear;
                this.currentDate.monthVar = response.data.currentMonth;
                this.currentDate.monthVarWord = response.data.currentMonthWord;
                this.currentDate.dayVar = response.data.currentDay;
                this.calDaysArray = response.data.calDaysArray;
                console.log(response.data);
                this.pushFirstDateRange();
                this.$emit('responseCategoriesEvent');
            });
        },
        pushFirstDateRange: function(){
            this.$dispatch('change-eobject', this.selectedDate);
            console.log('change-eobject');
        },
        fetchCategoryList: function() {

            this.$http.get('/api/active-categories/'+ this.selectedDate.yearVar + '/'+ this.selectedDate.monthVar ).then(function(response){
                // console.log('response->categories=' + JSON.stringify(response.data));
                this.categories = response.data;

            }, function(response) {
                //  this.$set(this.formErrors, response.data);
                console.log(response);
            });
        }
    },
    watch: {

    },

    events: {
        'responseCategoriesEvent': 'fetchCategoryList',
        'startFromThisDate': 'fetchCurrentEventsForCalendar'
    },
    filters: {
        removex: function(value) {
            return (value[0] == 'x') ? '_' : value;
        }
    },
};
</script>
