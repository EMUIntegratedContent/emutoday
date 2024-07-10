<template>
  <v-row>
    <v-col cols="12">
      <!-- Date filter -->
      <form class="form-inline">
        <label>Starting <span v-if="isEndDate">between</span><span v-else>on or after</span><br>
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
        <v-btn size="small" color="info" class="ml-4" @click="fetchPosts">Filter</v-btn>
      </form>
    </v-col>
    <v-col cols="12">
      <p><strong>Extra Filters</strong></p>
      <v-btn-toggle
          v-model="filters"
          color="warning"
          multiple
          divided
      >
        <v-btn>
          Live Posts
        </v-btn>

        <v-btn>
          Starting Next 24 Hours
        </v-btn>

        <v-btn>
          Ending Next 24 Hours
        </v-btn>

        <v-btn>
          Ended Last 24 Hours
        </v-btn>

        <v-btn>
          Pending Approval
        </v-btn>

        <v-btn>
          Ranked Posts
        </v-btn>
      </v-btn-toggle>
    </v-col>
    <v-col cols="12">
      <v-row>
        <v-col cols="12">
          <div class="buttons-flex">
            <v-btn color="success" href="/admin/intcomm/posts/create">New Post</v-btn>
            <ManageRankingsDialog @rankUpdated="fetchPosts"></ManageRankingsDialog>
          </div>
        </v-col>
        <v-col cols="12">
          <v-data-table
              :headers="headers"
              :items="filteredPosts"
              :items-per-page="25"
              class="elevation-1"
              :loading="loadingPosts"
          >
            <template #[`header.seq`]="{ column }">
              {{ column.title }}
              <v-tooltip
                  location="bottom"
              >
                <template v-slot:activator="{ props }">
                  <v-btn
                      icon="mdi-information"
                      color="info"
                      v-bind="props"
                      class="ml-3"
                      size="x-small"
                  >
                  </v-btn>
                </template>
                <span>
                  Posts with a ranking greater than 0 will be shown in order of their ranking (1 is the highest ranking).
                  <br>To make a post a ranked post, click on the "Add Ranking" button.
                  <br>To re-order ranked posts or to un-rank a post, click on the "Manage Rankings" button above.
                  <br>Posts with a ranking of '0' will be ranked in order of their start date.
                </span>
              </v-tooltip>
            </template>
            <template #[`item`]="{ item }">
              <tr :class="{ 'is-live': item.is_live, 'is-starting-soon': item.starts_soon}">
                <td>
                  <v-chip label v-if="item.is_live" class="mr-1">Live <span
                      v-if="item.ends_soon">&nbsp;(ends soon)</span></v-chip>
                  <v-chip label v-if="item.starts_soon" class="mr-1">Starts Soon</v-chip>
                </td>
                <td>
                  <a :href="`/admin/intcomm/posts/${item.postId}/edit`">{{ item.title }}</a>
                </td>
                <td>
                  <mark v-if="item.admin_status === 'Pending'">{{ item.admin_status }}</mark>
                  <span v-else>{{ item.admin_status }}</span>
                </td>
                <td>{{ slashdatetime(item.start_date) }}</td>
                <td>{{ slashdatetime(item.end_date) }}</td>
                <IntcommPostRankCol :post="item" @rankAdded="fetchPosts"></IntcommPostRankCol>
              </tr>
            </template>
            <template #no-data>
              No posts match the selected criteria.
            </template>
          </v-data-table>
        </v-col>
      </v-row>
    </v-col>
  </v-row>
</template>

<script>
import { VNumberInput } from 'vuetify/labs/VNumberInput'
import moment from 'moment'
import flatpickr from 'vue-flatpickr-component'
import 'flatpickr/dist/flatpickr.css'
import { slashdatetime } from '../../filters'
import { mapMutations, mapState } from "vuex"
import IntcommPostRankCol from './IntcommPostRankCol.vue'
import ManageRankingsDialog from './dialogs/ManageRankingsDialog.vue'

export default {
  mixins: [],
  components: {
    ManageRankingsDialog,
    IntcommPostRankCol,
    flatpickr,
    VNumberInput
  },
  created () {
    let threeMonthsEarlier = moment().subtract(3, 'M')
    this.startDate = threeMonthsEarlier.format("YYYY-MM-DD")
    this.endDate = moment().format("YYYY-MM-DD")
    this.fetchPosts()
  },
  data: function () {
    return {
      startDate: null,
      endDate: null,
      isEndDate: false,
      filters: [], // 'live', 'nextWeek', 'justEnded', 'ranked'
      flatpickrConfig: {
        altFormat: "m/d/Y", // format the user sees
        altInput: true,
        dateFormat: "Y-m-d", // format sumbitted to the API
        enableTime: false
      },
      headers: [
        { title: 'Stage Status', sortable: false },
        { title: 'Title', key: 'title' },
        { title: 'Admin Status', key: 'admin_status' },
        { title: 'Start Date', key: 'start_date' },
        { title: 'End Date', key: 'end_date' },
        { title: 'Ranking', key: 'seq' }
      ],
      loadingPosts: false
    }
  },
  computed: {
    ...mapState(['posts']),

    filteredPosts () {
      if (this.filters.length === 0) {
        return this.posts
      }

      let filtered = []

      this.filters.forEach(filter => {
        switch (filter) {
          case 0: // Live Posts
            filtered = filtered.concat(this.posts.filter(post => post.is_live));
            break
          case 1: // Starting Next 24 Hours
            filtered = filtered.concat(this.posts.filter(post => post.starts_soon))
            break
          case 2: // Ending Next 24 Hours
            filtered = filtered.concat(this.posts.filter(post => post.ends_soon))
            break
          case 3: // Ended Last 24 Hours
            filtered = filtered.concat(this.posts.filter(post => post.ended_recently))
            break
          case 4: // Pending Approval
            filtered = filtered.concat(this.posts.filter(post => post.admin_status === 'Pending'))
            break
          case 5: // Ranked Posts
            filtered = filtered.concat(this.posts.filter(post => post.seq > 0))
            break
        }
      })
      // Return array with duplicates removed by postId
      return Array.from(new Map(filtered.map(post => [post.postId, post])).values())
    },
    totalPages: function () {
      return Math.ceil(this.queueStories.length / this.itemsPerPage)
    }
  },
  methods: {
    slashdatetime,
    ...mapMutations(['setPosts']),
    toggleRange () {
      if (this.isEndDate) {
        this.isEndDate = false
      }
      else {
        this.isEndDate = true
      }
    },
    async fetchPosts () {
      this.loadingPosts = true
      let routeurl = '/api/intcomm/admin/posts'

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

      await this.$http.get(routeurl)
      .then((r) => {
        this.setPosts(r.data)
        this.loadingPosts = false
      })
      .catch((e) => {
        console.log(e)
      })
    }
  }
}
</script>
<style lang="scss" scoped>
.is-live {
  background-color: #E8F5E9;
}

.is-starting-soon {
  background-color: #FFF3E0;
}

#rangetoggle {
  color: #FF851B;
  margin-left: 5px;
  border-bottom: 2px #FF851B dotted;
}

.buttons-flex {
  display: flex;
  justify-content: space-between;
}
</style>
