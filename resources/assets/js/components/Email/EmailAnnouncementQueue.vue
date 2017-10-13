<template>
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
    <hr />
    <div class="row">
        <div class="col-md-12">
            <h3>Announcements</h3>
            <template v-if="!loadingUsed">
              <template v-if="usedAnnouncements.length > 0">
                <ul class="list-group" v-sortable>
                    <li v-for="announcement in usedAnnouncements" class="list-group-item">
                      <email-announcement-pod
                          pid="otherstory-list-stories"
                          pod-type="announcement"
                          :item="announcement"
                          >
                      </email-announcement-pod>
                    </li>
                </ul>
              </template>
              <template v-else>
                <p>There are no announcements set for this email.</p>
              </template>
            </template>
            <template v-else>
              <p>Loading this email's announcements. Please wait...</p>
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
            <div id="email-announcements">
              <template v-if="!loadingQueue">
                <template v-if="queueAnnouncements.length > 0">
                  <email-announcement-pod
                      pid="announcement-queue-announcements"
                      pod-type="announcementqueue"
                      :item="announcement"
                      :announcements="usedAnnouncements"
                      v-for="announcement in queueAnnouncements | paginate"
                  >
                  </email-announcement-pod>
                  <ul class="pagination">
                    <li v-bind:class="{disabled: (currentPage <= 0)}" class="page-item">
                      <a href="#" @click.prevent="setPage(currentPage-1)" class="page-link" tabindex="-1">Previous</a>
                    </li>
                    <li v-for="pageNumber in totalPages" :class="{active: pageNumber == currentPage}" class="page-item">
                      <a class="page-link" href="#" @click.prevent="setPage(pageNumber)">{{ pageNumber+1 }} <span v-if="pageNumber == currentPage" class="sr-only">(current)</span></a>
                    </li>
                    <li v-bind:class="{disabled: (currentPage == totalPages-1)}" class="page-item">
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
</template>
<style scoped>
#rangetoggle{
    color: #FF851B;
    margin-left: 5px;
    border-bottom: 2px #FF851B dotted;
}
</style>
<script>
import moment from 'moment';
import EmailAnnouncementPod from './EmailAnnouncementPod.vue'
import Pagination from '../Pagination.vue'
import flatpickr from "../../directives/flatpickr.js"

export default {
  directives: {flatpickr},
  components: {EmailAnnouncementPod},
  props: ['announcements'],
  data: function() {
    return {
      currentDate: moment(),
      usedAnnouncements: [],
      queueAnnouncements: [],
      loadingQueue: true,
      loadingUsed: true,
      eventMsg: null,
      startdate: null,
      enddate: null,
      isEndDate: false,
      currentPage: 0,
      itemsPerPage: 10,
      resultCount: 0,
    }
  },

  ready: function() {
    let today = moment()
    this.startdate = today.format("YYYY-MM-DD")
    this.enddate = today.clone().add(4, 'w').format("YYYY-MM-DD")
    this.fetchAllRecords()
  },

  computed: {
    totalPages: function() {
      return Math.ceil(this.queueAnnouncements.length / this.itemsPerPage)
    },
  },

  methods: {
    toggleRange: function(){
      if(this.isEndDate){
          this.isEndDate = false
      } else {
          this.isEndDate = true
      }
    },
    onCalendarChange: function(){
        // flatpickr directive method
    },
    fetchAllRecords: function() {
        this.loadingQueue = true

        var routeurl = '/api/email/announcements';

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
            this.$set('queueAnnouncements', response.data.newdata.data)
            this.resultCount = this.queueAnnouncements.length
            this.loadingQueue = false;
        }, (response) => {
            //error callback
            console.log("ERRORS");
        }).bind(this);
    },
    setPage: function(pageNumber) {
      if(pageNumber > -1 && pageNumber < this.totalPages){
        this.currentPage = pageNumber
      }
    },
    onCalendarChange: function(){
        // flatpickr directive method
    },
  },
  filters: {
    paginate: function(list) {
      // only run if there are items in the list
      if(list.length == 0){
        return
      }
      this.resultCount = list.length
      if (this.currentPage >= this.totalPages) {
        this.currentPage = this.totalPages - 1
      }
      var index = this.currentPage * this.itemsPerPage
      return list.slice(index, index + this.itemsPerPage)
    },
  },
  // the `events` option simply calls `$on` for you
  // when the instance is created
  events: {
  },

  watch: {
    announcements: function (value) {
      // set announcements from property to data ON FIRST PAGE LOAD ONLY!
      this.usedAnnouncements = value
      this.loadingUsed = false
    }
  },
}

</script>
