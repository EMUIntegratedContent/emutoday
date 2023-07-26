<template>
  <div>
    <div class="row">
      <div class="col-xs-12 col-sm-8 col-md-6 col-lg-9">
        <p>You will only be presented announcements that are:</p>
        <ol>
          <li>Approved</li>
          <li>Not archived</li>
          <li>In the future (unless otherwise specified)</li>
        </ol>
      </div>
    </div>
    <hr/>
    <div class="row">
      <div class="col-md-12">
        <h3>Announcements</h3>
        <template v-if="emailBuilderEmail.announcements.length">
          <Sortable
              :list="emailBuilderEmail.announcements"
              item-key="id"
              tag="div"
              :options="{}"
              @update="updateOrder"
          >
            <template #item="{element, i}">
              <email-announcement-pod
                  pid="otherstory-list-stories"
                  pod-type="announcement"
                  :item="element"
              >
              </email-announcement-pod>
            </template>
          </Sortable>
        </template>
        <template v-else>
          <p>There are no announcements set for this email.</p>
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
        <div id="email-announcements">
          <template v-if="!loadingQueue">
            <template v-if="queueAnnouncements.length > 0">
              <email-announcement-pod
                  pid="announcement-queue-announcements"
                  pod-type="announcementqueue"
                  :item="announcement"
                  :announcements="emailBuilderEmail.announcements"
                  :key="'announcement-item-' + index"
                  v-for="(announcement, index) in announcementsPaginated"
              >
              </email-announcement-pod>
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
              <p>There are no announcements for the date range you've specified.</p>
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
#rangetoggle {
  color: #FF851B;
  margin-left: 5px;
  border-bottom: 2px #FF851B dotted;
}
</style>
<script>
import { emailMixin } from './email_mixin'
import moment from 'moment'
import EmailAnnouncementPod from './EmailAnnouncementPod.vue'
import Pagination from '../Pagination.vue'
import flatpickr from 'vue-flatpickr-component'
import 'flatpickr/dist/flatpickr.css'
import { Sortable } from "sortablejs-vue3"

export default {
  components: {
    EmailAnnouncementPod,
    Pagination,
    flatpickr,
    Sortable
  },
  mixins: [ emailMixin ],
  data: function () {
    return {
      currentDate: moment(),
      queueAnnouncements: [],
      loadingQueue: true,
      eventMsg: null,
      startdate: null,
      enddate: null,
      isEndDate: false,
      currentPage: 0,
      itemsPerPage: 10,
      resultCount: 0,
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
    announcementsPaginated () {
      if (!this.queueAnnouncements) {
        return false
      }

      this.resultCount = this.queueAnnouncements.length
      if (this.currentPage > this.totalPages) {
        this.currentPage = 1
      }
      let index = (this.currentPage - 1) * this.itemsPerPage
      return this.queueAnnouncements.slice(index, index + this.itemsPerPage)
    },
    totalPages: function () {
      return Math.ceil(this.queueAnnouncements.length / this.itemsPerPage)
    },
  },

  methods: {
    toggleRange: function () {
      if (this.isEndDate) {
        this.isEndDate = false
      }
      else {
        this.isEndDate = true
      }
    },
    fetchAllRecords: function () {
      this.loadingQueue = true

      let routeurl = '/api/email/announcements';

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
        this.queueAnnouncements = response.data.newdata.data
        this.resultCount = this.queueAnnouncements.length
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

    /**
     * Uses Vue Sortable
     */
    updateOrder: function (event) {
      this.updateAnnouncementsOrder({ newIndex: event.newIndex, oldIndex: event.oldIndex })
    }
  }
}

</script>
