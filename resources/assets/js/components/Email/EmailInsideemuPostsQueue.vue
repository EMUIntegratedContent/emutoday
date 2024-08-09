<template>
  <div>
    <div class="row">
      <div class="col-xs-12 col-sm-8 col-md-6 col-lg-9">
        <p>You will only be presented Inside EMU posts that are <strong>LIVE</strong> in the selected date range.</p>
      </div>
    </div>
    <hr/>
    <div class="row">
      <div class="col-md-12">
        <h3>Inside EMU Posts</h3>
        <div class="form-group">
          <label for="include-inside-chk">
            Exclude the Inside EMU posts in this email?
            <input
                id="include-inside-chk"
                type="checkbox"
                :true-value="1"
                :false-value="0"
                v-model="emailBuilderEmail.exclude_insideemu"
            >
          </label>
        </div><!-- /input-group -->
        <template v-if="emailBuilderEmail.insideemuPosts.length">
          <Sortable
              :list="emailBuilderEmail.insideemuPosts"
              itemKey="postId"
              tag="div"
              :options="{}"
              @update="updateOrder"
          >
            <template #item="{element}">
              <email-inside-post-pod
                  pid="posts-list-post"
                  pod-type="post"
                  :item="element"
              >
              </email-inside-post-pod>
            </template>
          </Sortable>
        </template>
        <template v-else>
          <p>There are no Inside EMU posts set for this email.</p>
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
        <div id="email-inside-posts">
          <template v-if="!loadingQueue">
            <template v-if="filteredPosts.length > 0">
              <email-inside-post-pod
                  pid="posts-queue-post"
                  pod-type="postqueue"
                  :item="post"
                  :posts="emailBuilderEmail.insideemuPosts"
                  :key="'post-' + index"
                  v-for="(post, index) in filteredPosts"
              >
              </email-inside-post-pod>
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
              <p>There are no live Inside EMU posts for the date range you've specified.</p>
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
import moment from 'moment';
import EmailInsidePostPod from './EmailInsidePostPod.vue'
import flatpickr from 'vue-flatpickr-component'
import 'flatpickr/dist/flatpickr.css'
import { Sortable } from 'sortablejs-vue3'

export default {
  components: {
    EmailInsidePostPod,
    flatpickr,
    Sortable
  },
  mixins: [emailMixin],
  data: function () {
    return {
      currentDate: moment(),
      queuePosts: [],
      usedPosts: [],
      loadingQueue: true,
      loadingUsed: true,
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
    let twoWeeksEarlier = moment().subtract(2, 'w')
    this.startdate = twoWeeksEarlier.format("YYYY-MM-DD")
    this.enddate = twoWeeksEarlier.clone().add(4, 'w').format("YYYY-MM-DD")
    this.fetchAllRecords()
  },
  computed: {
    // Live posts only
    filteredPosts () {
      if(!this.queuePosts) return []
      return this.queuePosts.filter(post => post.is_live)
    },
    postsPaginated () {
      if (!this.filteredPosts.length) {
        return false
      }

      this.resultCount = this.filteredPosts.length
      if (this.currentPage > this.totalPages) {
        this.currentPage = 1
      }
      let index = (this.currentPage - 1) * this.itemsPerPage
      return this.filteredPosts.slice(index, index + this.itemsPerPage)
    },
    totalPages: function () {
      return Math.ceil(this.queuePosts.length / this.itemsPerPage)
    },
  },
  methods: {
    fetchAllRecords: function () {
      this.loadingQueue = true

      let routeurl = '/api/email/insideemuposts';

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
        this.queuePosts = response.data.newdata
        this.resultCount = this.queuePosts.length
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
    updateOrder: function (post) {
      this.updateInsideemuPostsOrder({ newIndex: post.newIndex, oldIndex: post.oldIndex })
    }
  }
}
</script>
