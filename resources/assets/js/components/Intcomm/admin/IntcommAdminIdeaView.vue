<template>
  <v-progress-circular v-if="loadingIdea" indeterminate></v-progress-circular>
  <div v-else>
    <v-row>
      <v-col cols="12">
        <v-card>
          <v-toolbar density="compact" color="grey-darken-3" title="Idea Submission Details"></v-toolbar>
          <v-card-text>
            <v-row>
              <v-col cols="12">
                <v-alert v-if="itemDeleted" class="mb-3" color="error" icon="mdi-delete" density="compact">This idea has been deleted.</v-alert>
                <v-alert v-if="idea.archived" class="mb-3" type="warning" density="compact">This idea has been archived. It will not show in the ideas list.</v-alert>
                <v-alert class="mb-3" color="info" density="compact">Contributed by {{ idea.submitted_by }} on
                  {{ slashdatetime(idea.created_at) }}
                </v-alert>
                <p>
                  <strong>Suggested Title</strong>
                  <br>{{ idea.title }}
                </p>
                <p>
                  <strong>Suggested Teaser</strong>
                  <br>{{ idea.teaser }}
                </p>
                <div>
                  <strong>Suggested Content</strong>
                  <br>
                  <span v-html="idea.content"></span>
                </div>
              </v-col>
            </v-row>
            <!--        <IntcommIdeaImages :mode="mode"></IntcommIdeaImages>-->
          </v-card-text>
          <v-card-actions v-if="!itemDeleted">
            <v-btn :loading="makingPost" color="primary" @click="makePost">Convert to Post</v-btn>
            <v-btn v-if="!idea.archived" :loading="archivingIdea" color="warning" @click="archiveIdea">Archive Idea</v-btn>
            <v-btn v-else :loading="unarchivingIdea" color="warning" @click="unarchiveIdea">Reinstate Idea</v-btn>
            <v-btn :loading="deletingIdea" color="error" @click="deleteIdea">Delete Idea</v-btn>
          </v-card-actions>
        </v-card>
      </v-col>
      <v-col cols="12" v-if="!itemDeleted">
        <v-card>
          <v-toolbar density="compact" color="grey-darken-3" title="Associated Posts"></v-toolbar>
          <v-card-text>
            <v-row v-if="idea.associated_posts.length">
              <v-col
                  v-for="(post) in idea.associated_posts"
                  :key="`post-${post.postId}`"
                  class="d-flex child-flex bg-danger"
                  cols="12"
                  md="6"
                  lg="4"
              >
                <v-card>
                  <v-card-title>{{ post.title }}</v-card-title>
                  <v-card-text>
                    <p>{{ post.teaser }}</p>
                  </v-card-text>
                  <v-card-actions>
                    <v-btn color="primary" :href="`/admin/intcomm/posts/${post.postId}/edit`">Go to post</v-btn>
                  </v-card-actions>
                </v-card>
              </v-col>
            </v-row>
            <p v-else>There are no posts associated with this idea yet.</p>
          </v-card-text>
        </v-card>
      </v-col>
    </v-row>
  </div>
</template>

<script>
import store from '../../../vuex/intcomm_store'
import moment from 'moment'
import flatpickr from 'vue-flatpickr-component'
import 'flatpickr/dist/flatpickr.css'
import { mapMutations, mapState } from "vuex"
// import IntcommIdeaImages from './IntcommIdeaImages.vue'
import { slashdatetime } from '../../filters'

export default {
  mixins: [],
  props: {},
  components: {
    // IntcommIdeaImages,
    flatpickr,
    intcomm_store: store
  },
  created () {
    this.fetchIdea()
  },
  data: function () {
    return {
      archivingIdea: false,
      currentDate: moment(),
      deletingIdea: false,
      flatpickrConfig: {
        altFormat: "m/d/Y h:i K", // format the user sees
        altInput: true,
        dateFormat: "Y-m-d H:i:S", // format sumbitted to the API
        enableTime: true
      },
      itemDeleted: false,
      loadingIdea: false,
      makingPost: false,
      unarchivingIdea: false
    }
  },
  computed: {
    ...mapState(['idea']),
    // Extract the idea ID from the URL (will be the second to last part)
    // e.g. https://today.emich.edu/admin/intcomm/posts/54/edit
    ideaId () {
      const urlParts = window.location.href.split('/')
      return urlParts[urlParts.length - 1]
    }
  },
  methods: {
    slashdatetime,
    ...mapMutations(['setIdea']),
    async fetchIdea () {
      this.loadingIdea = true
      let routeurl = '/api/intcomm/ideas/admin/' + this.ideaId

      await this.$http.get(routeurl)
      .then((r) => {
        this.setIdea(r.data)
        this.loadingIdea = false
      })
      .catch((e) => {
        console.log(e)
      })
    },
    async makePost () {
      this.makingPost = true
      // let formData = new FormData();
      let routeurl = '/api/intcomm/ideas/admin/' + this.idea.ideaId + '/makepost'

      await this.$http.post(routeurl)
      .then((r) => {
        this.setIdea(r.data)
        this.makingPost = false
      })
      .catch((e) => {
        console.log(e)
      })
    },
    async archiveIdea () {
      if(!confirm('Archived ideas will no longer show in the ideas list. Are you sure you want to archive this idea?')) {
        return
      }
      this.archivingIdea = true
      // let formData = new FormData();
      let routeurl = '/api/intcomm/ideas/admin/' + this.idea.ideaId + '/archive'

      await this.$http.put(routeurl)
      .then((r) => {
        this.setIdea(r.data)
        this.archivingIdea = false
      })
      .catch((e) => {
        console.log(e)
      })
    },
    async unarchiveIdea () {
      this.unarchivingIdea = true
      // let formData = new FormData();
      let routeurl = '/api/intcomm/ideas/admin/' + this.idea.ideaId + '/unarchive'

      await this.$http.put(routeurl)
      .then((r) => {
        this.setIdea(r.data)
        this.unarchivingIdea = false
      })
      .catch((e) => {
        console.log(e)
      })
    },
    async deleteIdea () {
      if(!confirm('Deleting an idea will also delete it for the original contributor. If you want the contributor to still see their idea, use the "Reject Idea" feature instead. Are you sure you want to delete this idea?')) {
        return
      }
      this.deletingIdea = true
      // let formData = new FormData();
      let routeurl = '/api/intcomm/ideas/admin/' + this.idea.ideaId

      await this.$http.delete(routeurl)
      .then((r) => {
        this.deletingIdea = false
        this.itemDeleted = true
      })
      .catch((e) => {
        console.log(e)
      })
    }
  }
}
</script>
<style scoped lang="scss">
.v-card-text {
  font-size: 1.2rem;
}
</style>
