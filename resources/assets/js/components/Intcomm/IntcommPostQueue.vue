<template>
  <v-row>
    <v-col cols="12">
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
<!--          <button type="button" class="btn btn-sm btn-info" @click="fetchAllRecords">Filter</button>-->
        </p>
        <p>
          <button href="#" id="rangetoggle" type="button" @click="toggleRange"><span
              v-if="isEndDate"> - Remove </span><span
              v-else> + Add </span>Range
          </button>
        </p>
      </form>
      <v-row>
        <v-col cols="12" md="6">
          <v-alert type="error">Wakka wakka wakka</v-alert>
        </v-col>
      </v-row>
    </v-col>
  </v-row>
</template>

<script>
import moment from 'moment'
import flatpickr from 'vue-flatpickr-component'
import 'flatpickr/dist/flatpickr.css'
import { mapMutations, mapState } from "vuex"

export default {
  mixins: [],
  components: {
    flatpickr
  },
  created () {
    let threeMonthsEarlier = moment().subtract(3, 'M')
    this.startdate = threeMonthsEarlier.format("YYYY-MM-DD")
    this.enddate = moment().format("YYYY-MM-DD")
    this.fetchPosts()
  },
  data: function () {
    return {
      currentDate: moment(),
      startdate: null,
      enddate: null,
      isEndDate: false,
      flatpickrConfig: {
        altFormat: "m/d/Y", // format the user sees
        altInput: true,
        dateFormat: "Y-m-d", // format sumbitted to the API
        enableTime: false
      }
    }
  },
  computed: {
    ...mapState([]),
    totalPages: function () {
      return Math.ceil(this.queueStories.length / this.itemsPerPage)
    }
  },
  methods: {
    ...mapMutations([]),
    toggleRange: function () {
      if (this.isEndDate) {
        this.isEndDate = false
      }
      else {
        this.isEndDate = true
      }
    },
    fetchPosts: function () {
      this.loadingQueue = true
      let routeurl = '/api/intcomm/posts'

      // // if a start date is set, get stories whose start_date is on or after this date
      // if (this.startdate) {
      //   routeurl = routeurl + '/' + this.startdate
      // }
      // else {
      //   routeurl = routeurl + '/' + moment().subtract(3, 'm').format("YYYY-MM-DD")
      // }
      //
      // // if a date range is set, get stories between the start date and end date
      // if (this.isEndDate) {
      //   routeurl = routeurl + '/' + this.enddate
      // }

      this.$http.get(routeurl)
      .then((r) => {
        console.log(r)
        // this.queueStories = response.data.newdata.data
        //
        // // Find the current story (if any) and set it in the store
        // const current175Story = this.queueStories.find((story) => {
        //   return story.is_emu175_hub_story == 1
        // })
        // if (current175Story) {
        //   this.setEmu175Story(current175Story)
        //   this.originalStory = JSON.parse(JSON.stringify(current175Story))
        // }
        //
        // this.resultCount = this.queueStories.length
        // this.setPage(1) // reset paginator
        // this.loadingQueue = false
      })
      .catch((e) => {
        console.log(e)
      })
    },
  }
}
</script>
