<template>
  <v-row>
    <v-col cols="12">
      <!-- Date filter -->
      <form class="form-inline">
        <label>Submitted <span v-if="isEndDate">between</span><span v-else>on or after</span><br>
          <flatpickr
              v-model="startDate"
              id="startDatePicker"
              :config="flatpickrConfig"
              class="form-control mr-2"
              name="startingDate"
          >
          </flatpickr>
        </label>
        <template v-if="isEndDate">
          <label> and<br>
            <flatpickr
                v-model="endDate"
                id="endDatePicker"
                :config="flatpickrConfig"
                class="form-control"
                name="endingDate"
            >
            </flatpickr>
          </label>
        </template>
        <button href="#" id="rangetoggle" type="button" @click="toggleRange"><span
            v-if="isEndDate"> - Remove </span><span
            v-else> + Add </span>Range
        </button>
        <label for="includeArchives" class="mx-3">
          Include Archives
          <input type="checkbox"
                 v-model="includeArchives"
                 class="display-inline-block" />
        </label>
        <v-btn size="small" color="info" class="ml-4" @click="fetchIdeas">Filter</v-btn>
      </form>
      <v-row>
        <v-col cols="12">
          <p><strong>Extra Filters</strong></p>
          <v-btn-toggle
              v-model="extraFilters"
              color="warning"
              multiple
              divided
          >
            <v-btn>
              New
            </v-btn>

            <v-btn>
              Viewed
            </v-btn>

            <v-btn>
              Considering
            </v-btn>

            <v-btn>
              Not Considering
            </v-btn>

            <v-btn>
              Done
            </v-btn>

            <v-btn v-if="includeArchives">
              Archived
            </v-btn>
          </v-btn-toggle>
        </v-col>
        <v-col cols="12">
          <v-data-table
              :headers="headers"
              :items="filteredIdeas"
              :items-per-page="25"
              class="elevation-1"
              :search="search"
              :loading="loadingIdeas"
              :custom-filter="filterOnlyTitle"
              v-model:sort-by="sortBy"
              clearable
          >
            <template #top>
              <v-text-field v-model="search" label="Filter Titles" single-line hide-details></v-text-field>
            </template>
            <template #[`item.submitted_at`]="{ item }">
              {{ slashdatetime(item.submitted_at) }}
            </template>
            <template #[`item.title`]="{ item }">
              <a :href="`/admin/insideemu/ideas/${item.ideaId}`">{{ item.title }}</a>
            </template>
            <template #[`item.admin_status`]="{ item }">
              {{ item.archived ? 'Archived' : item.admin_status }}
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
import { slashdatetime } from '../../filters'

export default {
  mixins: [],
  components: {
    flatpickr
  },
  created () {
    let threeMonthsEarlier = moment().subtract(3, 'M')
    this.startDate = threeMonthsEarlier.format("YYYY-MM-DD")
    this.endDate = moment().format("YYYY-MM-DD")
    this.fetchIdeas()
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
        { title: 'Contributor', key: 'contributor_fullname' },
        { title: 'Submit Dt', key: 'submitted_at' },
        { title: 'Status', key: 'admin_status' }
      ],
      ideas: [],
      includeArchives: false,
      loadingIdeas: false,
      extraFilters: [],
      search: '',
      sortBy: [{ key: 'submitted_at', order: 'desc' }],
    }
  },
  computed: {
    ...mapState([]),
    filteredIdeas () {
      if (this.extraFilters.length === 0) {
        return this.ideas
      }

      let filtered = []

      this.extraFilters.forEach(filter => {
        switch (filter) {
          case 0: // New
            filtered = filtered.concat(this.ideas.filter(idea => idea.admin_status === 'New' && idea.admin_status !== 'Archived'));
            break
          case 1: // Viewed
            filtered = filtered.concat(this.ideas.filter(idea => idea.admin_status === 'Viewed' && idea.admin_status !== 'Archived'))
            break
          case 2: // Considering
            filtered = filtered.concat(this.ideas.filter(idea => idea.admin_status === 'Considering' && idea.admin_status !== 'Archived'))
            break
          case 3: // Not Considering
            filtered = filtered.concat(this.ideas.filter(idea => idea.admin_status === 'Not Considering' && idea.admin_status !== 'Archived'))
            break
          case 4: // Done
            filtered = filtered.concat(this.ideas.filter(idea => idea.admin_status === 'Done' && idea.admin_status !== 'Archived'))
            break
          case 5: // Archived
            filtered = filtered.concat(this.ideas.filter(idea => idea.admin_status === 'Archived'))
            break
        }
      })
      // Return array with duplicates removed by ideaId
      return Array.from(new Map(filtered.map(idea => [idea.ideaId, idea])).values())
    },
    totalPages: function () {
      return Math.ceil(this.queueStories.length / this.itemsPerPage)
    }
  },
  methods: {
    slashdatetime,
    ...mapMutations([]),
    filterOnlyTitle (value, query, item) {
      return item.raw.title.toLowerCase().indexOf(query.toLowerCase()) > -1
    },
    toggleRange () {
      if (this.isEndDate) {
        this.isEndDate = false
      }
      else {
        this.isEndDate = true
      }
    },
    async fetchIdeas () {
      this.loadingIdeas = true
      let routeurl = '/api/insideemu/admin/ideas/ideas'

      // if a start date is set, get stories whose start_date is on or after this date
      if (this.startDate) {
        routeurl = routeurl + '?fromDate=' + this.startDate
      }
      else {
        routeurl = routeurl + '?fromDate=' + moment().subtract(3, 'm').format("YYYY-MM-DD")
      }

      // if a date range is set, get stories between the start date and end date
      if (this.isEndDate) {
        routeurl = routeurl + '&toDate=' + this.endDate
      }

      if(this.includeArchives) {
        routeurl = routeurl + '&archives=true'
      }

      await this.$http.get(routeurl)
      .then((r) => {
        this.ideas = r.data
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
#rangetoggle {
  color: #FF851B;
  margin-left: 5px;
  border-bottom: 2px #FF851B dotted;
}
</style>
