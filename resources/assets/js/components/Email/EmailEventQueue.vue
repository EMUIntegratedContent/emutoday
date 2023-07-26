<template>
  <div>
    <div class="row">
      <div class="col-xs-12 col-sm-8 col-md-6 col-lg-9">
        <p>You will only be presented events that are:</p>
        <ol>
          <li>Approved</li>
          <li>In the future (unless otherwise specified)</li>
        </ol>
      </div>
    </div>
    <hr/>
    <div class="row">
      <div class="col-md-12">
        <h3>Events</h3>
        <div class="form-group">
          <label for="include-events-chk">
            Exclude the events in this email?
            <input
                id="include-events-chk"
                type="checkbox"
                :true-value="1"
                :false-value="0"
                v-model="emailBuilderEmail.exclude_events"
            >
          </label>
        </div><!-- /input-group -->
        <template v-if="emailBuilderEmail.events.length">
          <Sortable
              :list="emailBuilderEmail.events"
              item-key="id"
              tag="div"
              :options="{}"
              @update="updateOrder"
          >
            <template #item="{element, i}">
              <email-event-pod
                  pid="event-list-events"
                  pod-type="event"
                  :item="element"
              >
              </email-event-pod>
            </template>
          </Sortable>
        </template>
        <template v-else>
          <p>There are no events set for this email.</p>
        </template>
        <hr/>
        <!-- Date filter -->
        <form class="form-inline">
          <div class="form-group">
            <label>Starting <span v-if="isEndDate">between</span><span v-else>on or after</span><br>
              <flatpickr
                  v-model="startdate"
                  id="startDatePicker"
                  :config="flatpickrConfig"
                  class="form-control"
                  name="startingDate"
              >
              </flatpickr>
            </label>
          </div>
          <div v-if="isEndDate" class="form-group">
            <label> and<br>
              <flatpickr
                  v-model="enddate"
                  id="endDatePicker"
                  :config="flatpickrConfig"
                  class="form-control"
                  name="endingDate"
              >
              </flatpickr>
            </label>
          </div>
          <p>
            <button type="button" class="btn btn-sm btn-info" @click="fetchAllRecords">Filter</button>
          </p>
          <p>
            <button href="#" id="rangetoggle" type="button" @click="toggleRange"><span
                v-if="isEndDate"> - Remove </span><span
                v-else> + Add </span>Range
            </button>
          </p>
        </form>
        <div id="email-events">
          <template v-if="!loadingQueue">
            <template v-if="queueEvents.length > 0">
              <email-event-pod
                  pid="event-queue-events"
                  pod-type="eventqueue"
                  :item="event"
                  :events="emailBuilderEmail.events"
                  :key="'event-item-' + index"
                  v-for="(event, index) in eventsPaginated"
              >
              </email-event-pod>
              <ul class="pagination">
                <li v-bind:class="{disabled: (currentPage <= 1)}" class="page-item">
                  <a href="#" @click.prevent="setPage(currentPage-1)" class="page-link" tabindex="-1">Previous</a>
                </li>
                <li v-for="pageNumber in totalPages" :class="{active: (pageNumber) == currentPage}" class="page-item">
                  <a class="page-link" href="#" @click.prevent="setPage(pageNumber)">{{ pageNumber }} <span
                      v-if="(pageNumber) == currentPage" class="sr-only">(current)</span></a>
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
  </div>
</template>
<style scoped>
#automail-label {
  font-size: 110%;
  margin: 0;
  padding: 0;
  position: relative;
  top: 10px;
}

#rangetoggle {
  color: #FF851B;
  margin-left: 5px;
  border-bottom: 2px #FF851B dotted;
}
</style>
<script>
import { emailMixin } from './email_mixin'
import moment from 'moment';
import EmailEventPod from './EmailEventPod.vue'
import flatpickr from 'vue-flatpickr-component'
import 'flatpickr/dist/flatpickr.css'
import { Sortable } from 'sortablejs-vue3'

export default {
  components: {
    EmailEventPod,
    flatpickr,
    Sortable
  },
  mixins: [emailMixin],
  data: function () {
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
      currentPage: 0,
      itemsPerPage: 10,
      resultCount: 0,
      drag: false,
      flatpickrConfig: {
        altFormat: "m/d/Y", // format the user sees
        altInput: true,
        dateFormat: "Y-m-d", // format sumbitted to the API
        enableTime: false
      }
    }
  },
  created () {
    let today = moment()
    this.startdate = today.format("YYYY-MM-DD")
    this.enddate = today.clone().add(4, 'w').format("YYYY-MM-DD")
    this.fetchAllRecords()
  },
  computed: {
    eventsPaginated () {
      if (!this.queueEvents) {
        return false
      }

      this.resultCount = this.queueEvents.length
      if (this.currentPage > this.totalPages) {
        this.currentPage = 1
      }
      let index = (this.currentPage - 1) * this.itemsPerPage
      return this.queueEvents.slice(index, index + this.itemsPerPage)
    },
    totalPages: function () {
      return Math.ceil(this.queueEvents.length / this.itemsPerPage)
    },
  },
  methods: {
    fetchAllRecords: function () {
      this.loadingQueue = true

      let routeurl = '/api/email/events';

      // if a start date is set, get stories whose start_date is on or after this date
      if (this.startdate) {
        routeurl = routeurl + '/' + this.startdate
      }
      else {
        routeurl = routeurl + '/' + moment().format("YYYY-MM-DD")
      }

      // if a date range is set, get stories between the start date and end date
      if (this.isEndDate) {
        routeurl = routeurl + '/' + this.enddate
      }

      this.$http.get(routeurl)

      .then((response) => {
        this.queueEvents = response.data.newdata.data
        this.resultCount = this.queueEvents.length
        this.setPage(1) // reset paginator
        this.loadingQueue = false;
      }).catch((e) => {
        console.log(e)
      })
    },
    setPage: function (pageNumber) {
      if (pageNumber > 0 && pageNumber <= this.totalPages) {
        this.currentPage = pageNumber
      }
    },
    toggleRange: function () {
      if (this.isEndDate) {
        this.isEndDate = false
      }
      else {
        this.isEndDate = true
      }
    },
    /**
     * Uses Vue Sortable
     */
    updateOrder: function (event) {
      this.updateEventsOrder({ newIndex: event.newIndex, oldIndex: event.oldIndex })
    }
  }
}
</script>
