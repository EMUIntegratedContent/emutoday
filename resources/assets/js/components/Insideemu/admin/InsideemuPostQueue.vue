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
          v-model="extraFilters"
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
          Progress < 100%
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
            <v-btn color="success" href="/admin/insideemu/posts/create">New Post</v-btn>
            <ManageRankingsDialog @rankUpdated="fetchPosts"></ManageRankingsDialog>
          </div>
        </v-col>
        <v-col cols="12">
          <p>
            <v-chip color="success"></v-chip> = Live Post
            <v-chip color="warning" class="ml-3"></v-chip> = Live in next 24 hours
            <v-icon color="yellow-darken-3" class="ml-3" size="large">mdi-star</v-icon> = EMU Today Hub Post
          </p>
          <v-data-table
              :headers="headers"
              :items="filteredPosts"
              :items-per-page="25"
              class="elevation-1"
              :search="search"
              :loading="loadingPosts"
              :custom-filter="filterOnlyTitle"
              v-model:sort-by="sortBy"
              clearable
          >
            <template #top>
              <v-text-field v-model="search" label="Search All Fields" single-line hide-details></v-text-field>
            </template>
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
                  Posts with a ranking will be shown in order of their ranking.
                  <br>To make a post a ranked post, click on the "Add Ranking" button.
                  <br>To re-order ranked posts or to un-rank a post, click on the "Manage Rankings" button above.
                  <br>Unranked posts will be shown in order of their start date after ranked posts.
                </span>
              </v-tooltip>
            </template>
            <template #[`header.progress`]="{ column }">
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
                  Only a post whose progress is 100% is eligible for publication. A post is considered eligible for publication if it:
                  <ul>
                    <li>Has a title</li>
                    <li>Has a start date</li>
                    <li>Has content</li>
                    <li>Has the required image(s)</li>
                    <li>Has been approved by an editor or administrator</li>
                  </ul>
                  Note that this does NOT necessarily mean that the post is live; it must fall within the start and end date to be live.
                </span>
              </v-tooltip>
            </template>
            <template #[`item`]="{ item }">
              <tr :class="{ 'is-live': item.is_live, 'is-starting-soon': item.starts_soon}">
                <td>
                  <HubPostStarBtn :post="item" @madeHubPost="fetchPosts"></HubPostStarBtn>
                </td>
                <td>
                  <a :href="`/admin/insideemu/posts/${item.postId}/edit`">{{ item.title }}</a>
                  <v-progress-linear :model-value="item.progress" :color="item.progress === 100 ? 'success' : 'warning'"></v-progress-linear>
                </td>
                <td>
                  <mark v-if="item.admin_status === 'Pending'">{{ item.admin_status }}</mark>
                  <span v-else>{{ item.admin_status }}</span>
                </td>
                <td>{{ slashdatetime(item.start_date) }}</td>
                <td>{{ slashdatetime(item.end_date) }}</td>
                <InsideemuPostRankCol :post="item" @rankAdded="fetchPosts"></InsideemuPostRankCol>
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
import InsideemuPostRankCol from './InsideemuPostRankCol.vue'
import ManageRankingsDialog from './dialogs/ManageRankingsDialog.vue'
import HubPostStarBtn from './HubPostStarBtn.vue'

export default {
  mixins: [],
  components: {
    HubPostStarBtn,
    ManageRankingsDialog,
    InsideemuPostRankCol,
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
      extraFilters: [],
      flatpickrConfig: {
        altFormat: "m/d/Y", // format the user sees
        altInput: true,
        dateFormat: "Y-m-d", // format sumbitted to the API
        enableTime: false
      },
      headers: [
        // { title: 'Stage Status', sortable: false },
        { title: 'Hub Post', key: 'is_hub_post' },
        { title: 'Title', key: 'title' },
        { title: 'Appr Status', key: 'admin_status' },
        { title: 'Start Dt', key: 'start_date' },
        { title: 'End Dt', key: 'end_date' },
        { title: 'Ranking', key: 'seq' }
      ],
      loadingPosts: false,
      search: '',
      sortBy: [{ key: 'start_date', order: 'desc' }],
    }
  },
  computed: {
    ...mapState(['posts']),

    filteredPosts () {
      if (this.extraFilters.length === 0) {
        return this.posts
      }

      let filtered = []

      this.extraFilters.forEach(filter => {
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
          // case 3: // Ended Last 24 Hours
          //   filtered = filtered.concat(this.posts.filter(post => post.ended_recently))
          //   break
          case 3: // Progress < 100%
            filtered = filtered.concat(this.posts.filter(post => post.progress < 100))
            break
          case 4: // Ranked Posts
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
    filterOnlyTitle (value, query, item) {
      return item.raw.title.toLowerCase().indexOf(query.toLowerCase()) > -1
    },
    async fetchPosts () {
      this.loadingPosts = true
      let routeurl = '/api/insideemu/admin/posts'

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
