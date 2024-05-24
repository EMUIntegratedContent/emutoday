<template>
  <v-row>
    <v-col cols="12">
      {{ netid }}
      Yea user ideas!
      <!-- Date filter -->
<!--      <form class="form-inline">-->
<!--        <label>Starting <span v-if="isEndDate">between</span><span v-else>on or after</span><br>-->
<!--          <flatpickr-->
<!--              v-model="startDate"-->
<!--              id="startDatePicker"-->
<!--              :config="flatpickrConfig"-->
<!--              class="form-control mr-2"-->
<!--              name="startingDate"-->
<!--          >-->
<!--          </flatpickr>-->
<!--        </label>-->
<!--        <template v-if="isEndDate">-->
<!--          <label> and<br>-->
<!--            <flatpickr-->
<!--                v-model="endDate"-->
<!--                id="endDatePicker"-->
<!--                :config="flatpickrConfig"-->
<!--                class="form-control"-->
<!--                name="endingDate"-->
<!--            >-->
<!--            </flatpickr>-->
<!--          </label>-->
<!--        </template>-->
<!--        <button href="#" id="rangetoggle" type="button" @click="toggleRange"><span-->
<!--            v-if="isEndDate"> - Remove </span><span-->
<!--            v-else> + Add </span>Range-->
<!--        </button>-->
<!--        <v-btn size="small" color="info" class="ml-4" @click="fetchPosts">Filter</v-btn>-->
<!--      </form>-->
      <v-row>
        <v-col cols="12">
          <v-data-table
              :headers="headers"
              :items="ideas"
              :items-per-page="25"
              class="elevation-1"
              :loading="loadingIdeas"
          >
            <template #[`item.title`]="{ item }">
              <a :href="`/intcomm/ideas/${item.ideaId}/edit`">{{ item.title }}</a>
            </template>
          </v-data-table>
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
  props: {
    netid: {
      type: String,
      required: true
    }
  },
  created () {
    // let threeMonthsEarlier = moment().subtract(3, 'M')
    // this.startDate = threeMonthsEarlier.format("YYYY-MM-DD")
    // this.endDate = moment().format("YYYY-MM-DD")
    this.fetchUserPosts()
  },
  data: function () {
    return {
      currentDate: moment(),
      startDate: null,
      endDate: null,
      isEndDate: false,
      flatpickrConfig: {
        altFormat: "m/d/Y", // format the user sees
        altInput: true,
        dateFormat: "Y-m-d", // format sumbitted to the API
        enableTime: false
      },
      headers: [
        { title: 'Title', key: 'title' },
        { title: 'Teaser', key: 'teaser' },
        { title: 'Submit Dt', key: 'created_at' }
      ],
      loadingIdeas: false,
      ideas: []
    }
  },
  computed: {
    ...mapState([]),
    // totalPages: function () {
    //   return Math.ceil(this.queueStories.length / this.itemsPerPage)
    // }
  },
  methods: {
    ...mapMutations([]),
    // toggleRange () {
    //   if (this.isEndDate) {
    //     this.isEndDate = false
    //   }
    //   else {
    //     this.isEndDate = true
    //   }
    // },
    async fetchUserPosts () {
      this.loadingIdeas = true
      let routeurl = '/api/intcomm/ideas/user?netid=' + this.netid

      // if a start date is set, get stories whose start_date is on or after this date
      // if (this.startDate) {
      //   routeurl = routeurl + '?fromDate=' + this.startDate
      // }
      // else {
      //   routeurl = routeurl + '?fromDate=' + moment().subtract(3, 'm').format("YYYY-MM-DD")
      // }
      //
      // // if a date range is set, get stories between the start date and end date
      // if (this.isEndDate) {
      //   routeurl = routeurl + '&toDate=' + this.endDate
      // }

      await this.$http.get(routeurl)
      .then((r) => {
        this.ideas = r.data

        // this.resultCount = this.queueStories.length
        // this.setPage(1) // reset paginator
        this.loadingIdeas = false
      })
      .catch((e) => {
        console.log(e)
      })
    }
  }
}
</script>
<style scoped>

</style>
