<template>
    <div class="row">
        <div class="col-xs-12 col-sm-8 col-md-6 col-lg-9">
          <p>You will only be presented events that are:</p>
          <ol>
            <li>Approved</li>
            <li>In the future (unless otherwise specified)</li>
          </ol>
        </div>
    </div>
    <hr />
    <div class="row">
        <div class="col-md-12">
            <h3>Events</h3>
            <template v-if="!loadingUsed">
              <template v-if="usedEvents.length > 0">
                <ul class="list-group" v-sortable="{ onUpdate: updateOrder }">
                  <li v-for="usedEvent in usedEvents" class="list-group-item">
                    <email-event-pod
                        pid="event-list-events"
                        pod-type="event"
                        :item="usedEvent"
                        >
                    </email-event-pod>
                  </li>
                </ul>
              </template>
              <template v-else>
                <p>There are no events set for this email.</p>
              </template>
            </template>
            <template v-else>
              <p>Loading this email's events. Please wait...</p>
            </template>
            <hr />
            <!-- Date filter -->
            <form class="form-inline">
              <div class="form-group">
                  <label for="start-date">Starting <span v-if="isEndDate">between</span><span v-else>on or after</span></label>
                  <p><input v-if="startdate" v-model="startdate" type="text" :initval="startdate" v-flatpickr="startdate"></p>
              </div>
              <div v-if="isEndDate" class="form-group">
                  <label for="start-date"> and </label>
                  <p><input v-if="enddate" type="text" :initval="enddate" v-flatpickr="enddate"><p>
              </div>
              <p><button type="button" class="btn btn-sm btn-info" @click="fetchAllRecords">Filter</button></p>
              <p><a href="#" id="rangetoggle" @click="toggleRange"><span v-if="isEndDate"> - Remove </span><span v-else> + Add </span>Range</a></p>
            </form>
            <div id="email-events">
              <template v-if="!loadingQueue">
                <template v-if="queueEvents.length > 0">
                  <email-event-pod
                      pid="event-queue-events"
                      pod-type="eventqueue"
                      :item="event"
                      :events="usedEvents"
                      v-for="event in queueEvents | paginate"
                  >
                  </email-event-pod>
                  <ul class="pagination">
                    <li v-bind:class="{disabled: (currentPage <= 1)}" class="page-item">
                      <a href="#" @click.prevent="setPage(currentPage-1)" class="page-link" tabindex="-1">Previous</a>
                    </li>
                    <li v-for="pageNumber in totalPages" :class="{active: (pageNumber+1) == currentPage}" class="page-item">
                      <a class="page-link" href="#" @click.prevent="setPage(pageNumber+1)">{{ pageNumber+1 }} <span v-if="(pageNumber+1) == currentPage" class="sr-only">(current)</span></a>
                    </li>
                    <li v-bind:class="{disabled: (currentPage == totalPages)}" class="page-item">
                      <a class="page-link" @click.prevent="setPage(currentPage+1)" href="#">Next</a>
                    </li>
                  </ul>
                </template>
                <template v-else>
                  <p>There are no events for the date range you've specified.</p>
                </template>
              </template>
              <template v-else>
                <p>Loading queue. Please Wait...</p>
              </template>
            </div>
        </div><!-- /.col-md-12 -->
    </div><!-- ./row -->
</template>
<style scoped>
#automail-label {
  font-size: 110%;
  margin: 0;
  padding: 0;
  position: relative;
  top: 10px;
}
#rangetoggle{
    color: #FF851B;
    margin-left: 5px;
    border-bottom: 2px #FF851B dotted;
}
</style>
<script>
import moment from 'moment';
import EmailEventPod from './EmailEventPod.vue'
import flatpickr from "../../directives/flatpickr.js"

export default  {
  directives: {flatpickr},
  components: {EmailEventPod},
  props: ['events'],
  data: function() {
    return {
      currentDate: moment(),
      queueEvents: [],
      usedEvents: [],
      loadingQueue: true,
      loadingUsed: true,
      eventMsg: null,
      startdate: null,
      enddate: null,
      isEndDate: false,
      currentPage:0,
      itemsPerPage: 10,
      resultCount: 0,
    }
  },
  ready() {
    let today = moment()
    this.startdate = today.format("YYYY-MM-DD")
    this.enddate = today.clone().add(4, 'w').format("YYYY-MM-DD")
    this.fetchAllRecords()
  },
  computed: {
    totalPages: function() {
      return Math.ceil(this.queueEvents.length / this.itemsPerPage)
    },
  },
  methods : {
    fetchAllRecords: function() {
        this.loadingQueue = true

        var routeurl = '/api/email/events';

        // if a start date is set, get stories whose start_date is on or after this date
        if(this.startdate){
            routeurl = routeurl + '/' + this.startdate
        } else {
            routeurl = routeurl + '/' + moment().format("YYYY-MM-DD")
        }

        // if a date range is set, get stories between the start date and end date
        if(this.isEndDate){
            routeurl = routeurl + '/' + this.enddate
        }

        this.$http.get(routeurl)

        .then((response) =>{
            this.$set('queueEvents', response.data.newdata.data)
            this.resultCount = this.queueEvents.length
            this.setPage(1) // reset paginator
            this.loadingQueue = false;
        }, (response) => {
            //error callback
            console.log("ERRORS");
        }).bind(this);
    },
    setPage: function(pageNumber) {
      if(pageNumber > 0 && pageNumber <= this.totalPages){
        this.currentPage = pageNumber
      }
    },
    onCalendarChange: function(){
        // flatpickr directive method
    },
    toggleRange: function(){
        if(this.isEndDate){
            this.isEndDate = false
        } else {
            this.isEndDate = true
        }
    },
    /**
     * Uses vue-sortable
     */
    updateOrder: function(event){
      // https://stackoverflow.com/questions/34881844/resetting-a-vue-js-list-order-of-all-items-after-drag-and-drop
      let oldIndex = event.oldIndex
      let newIndex = event.newIndex

      // move the item in the underlying array
      this.usedEvents.splice(newIndex, 0, this.usedEvents.splice(oldIndex, 1)[0]);
    },
  },
  filters: {
    paginate: function(list) {
      // only run if there are items in the list
      if(list.length == 0){
        return
      }
      this.resultCount = list.length
      if (this.currentPage > this.totalPages) {
        this.currentPage = 1
      }
      var index = (this.currentPage-1) * this.itemsPerPage
      return list.slice(index, index + this.itemsPerPage)
    },
  },

  // the `events` option simply calls `$on` for you
  // when the instance is created
  events: {
  },

  watch: {
    events: function (value) {
      // set events from property to data
      this.usedEvents = value
      this.loadingUsed = false
    }
  },
}
</script>
