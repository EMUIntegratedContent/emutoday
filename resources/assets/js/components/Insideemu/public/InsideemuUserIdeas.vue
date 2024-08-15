<template>
  <v-row>
    <v-col cols="12">
      <v-row>
        <v-col cols="12">
          <v-data-table
              :headers="headers"
              :items="ideas"
              :items-per-page="25"
              class="elevation-1"
              :loading="loadingIdeas"
          >
            <template #[`item.created_at`]="{ item }">
              {{ slashdate(item.created_at) }}
            </template>
            <template #[`item.title`]="{ item }">
              <a :href="`/insideemu/ideas/${item.ideaId}/edit`">{{ item.title }}</a>
              <v-chip label v-if="!item.submitted_at" color="warning" class="ml-2 mb-1" size="small">Draft</v-chip>
            </template>
            <template #[`item.associated_posts`]="{ item }">
              <ul v-if="item.associated_posts.length">
                <li
                    v-for="(ap, i) in livePosts(item.associated_posts)"
                    :key="`ap-${i}`"
                >
                  <a :href="`/insideemu/posts/${ap.postId}`">{{ ap.title }}</a>
                </li>
              </ul>
            </template>
            <template #no-data>
              Create your <a href="/insideemu/ideas/create">first submission</a>.
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
import { slashdate } from '../../filters'

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
        { title: 'Created', key: 'created_at' },
        { title: 'Title', key: 'title' },
        { title: 'EMU Today Post(s)', key: 'associated_posts', sortable: false }
      ],
      loadingIdeas: false,
      ideas: []
    }
  },
  computed: {
    ...mapState([])
  },
  methods: {
    slashdate,
    ...mapMutations([]),
    async fetchUserPosts () {
      this.loadingIdeas = true
      let routeurl = '/api/insideemu/ideas/user?netid=' + this.netid

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
    },
    // Filter all of the posts that were sent from the server and pick out only those that are live.
    livePosts (posts) {
      return posts.filter(p => p.is_live)
    }
  }
}
</script>
<style scoped>

</style>
