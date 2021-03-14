<template>
    <div>
        <div id="graybar">
            <div class="calendar-bar row">
                <div class="medium-3 show-for-medium columns">
                    <h4>Calendar</h4>
                </div>
                <div class="medium-6 small-7 columns">
                    <h4>Upcoming Events</h4>
                </div>
                <div class="medium-3 small-5 columns">
                    <a class="button hollow secondary expanded academic-calednar-button" href="https://www.emich.edu/registrar/calendars/">ACADEMIC CALENDAR <i class="fa fa-external-link" aria-hidden="true"></i></a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="large-9 large-push-3 medium-9 medium-push-3 small-12 columns">
                <event-view-content :eventid.once="eventid" :edata.sync="eventlist"></event-view-content>

                <div id="annotations">
                    <p>*All calendar items are subject to change.</p>
                    <p>The EMU calendar is maintained by the <a href="https://www.emich.edu/communications">Division of Communications</a> and includes events sponsored by University departments and student organizations.</p>
                    <p>Eastern Michigan University reserves the right to edit information as necessary for accuracy and completeness and to refuse submissions for any reason. Please allow one or two working days for approval.</p>
                </div>
            </div>

            <div class="large-3 large-pull-9 medium-3 medium-pull-9 small-12 columns">
                <event-view-side-bar :starthere.sync="starthere" v-on:change-eobject="handleEventFetch"></event-view-side-bar>
            </div>
        </div>
    </div>
</template>
<style scoped>
#graybar {
    width: 100%;
    padding: .3rem 0;
    background-color: #bebdbd;
}
#graybar h4 {
    font-size: 1.2rem;
    margin-top: 0.4rem;
    margin-bottom: 0.4rem;
}
#annotations p {
    margin: 1rem auto;
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
            starthere: {},
            eventlist: {},
            eobject : {
                year: '',
                monthUnit: '',
                month: '',
                day: '',
            },
        }
    },
    methods : {
        handleEventFetch: function(eobject) {
            var route = '';

            eobject.cateid ? route = '/api/calendar/events/' + eobject.yearVar + '/'+ eobject.monthVar + '/' + eobject.dayVar + '/' + eobject.cateid : route = '/api/calendar/events/' + eobject.yearVar + '/'+ eobject.monthVar + '/' + eobject.dayVar;

            this.$http.get(route).then(function(response) {
                this.eventlist = response.data;
            });
        },
        freshPageLand: function() {
            var starthere = {};

            starthere.yearVar = this.varYearUnit;
            starthere.monthVar = this.varMonthUnit;
            starthere.dayVar = this.varDayUnit;

            this.starthere = starthere;
        }
    },
    mounted() {
        this.freshPageLand();
    },
}
</script>
