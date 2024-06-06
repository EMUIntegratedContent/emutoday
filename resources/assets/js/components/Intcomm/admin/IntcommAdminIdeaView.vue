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
                <v-alert v-if="itemDeleted" class="mb-3" color="error" icon="mdi-delete" density="compact">This idea has
                  been deleted.
                </v-alert>
                <v-alert v-if="idea.archived" class="mb-3" type="warning" density="compact">This idea has been archived.
                  It will not show in the ideas list.
                </v-alert>
                <v-alert v-if="isErr" class="mb-3" type="error" density="compact">{{ errorMsg }}</v-alert>
              </v-col>
              <v-col cols="12" sm="6" md="4" lg="3">
                <v-select
                    v-if="!idea.is_archived"
                    v-model="idea.admin_status"
                    :items="['New', 'Viewed', 'Not Considering', 'Considering', 'Done']"
                    label="Admin Status"
                    density="compact"
                    variant="outlined"
                    hint="For internal use only. This will not be visible to the contributor."
                    persistent-hint
                    :loading="changingStatus"
                    @update:modelValue="changeAdminStatus"
                ></v-select>
              </v-col>
            </v-row>
            <v-row>
              <v-col cols="12" sm="6" md="4" lg="3">
                <v-card>
                  <v-list lines="two">
                    <v-list-item>
                      <v-list-item-title>Suggested Title</v-list-item-title>

                      <v-list-item-subtitle>
                        {{ idea.title }}
                      </v-list-item-subtitle>
                    </v-list-item>

                    <v-list-item>
                      <v-list-item-title>Suggested Teaser</v-list-item-title>

                      <v-list-item-subtitle>
                        {{ idea.teaser ? idea.teaser : 'No suggested teaser provided' }}
                      </v-list-item-subtitle>
                    </v-list-item>
                    <v-list-item>
                      <v-list-item-title>Contributor</v-list-item-title>

                      <v-list-item-subtitle>
                        {{ idea.contributor_fullname + ' (' + idea.contributor_netid + ')' }}
                      </v-list-item-subtitle>
                    </v-list-item>
                    <v-list-item>
                      <v-list-item-title>Submission Dt</v-list-item-title>

                      <v-list-item-subtitle>
                        {{ slashdatetime(idea.created_at) }}
                      </v-list-item-subtitle>
                    </v-list-item>
                    <v-list-item>
                      <v-list-item-title>Last Updated</v-list-item-title>

                      <v-list-item-subtitle>
                        {{ slashdatetime(idea.updated_at) }}
                      </v-list-item-subtitle>
                    </v-list-item>
                  </v-list>
                </v-card>
              </v-col>
              <v-col cols="12" sm="6" md="8" lg="9">
                <v-card>
                  <v-card-text>
                    <span v-html="idea.content"></span>
                  </v-card-text>
                </v-card>
              </v-col>
            </v-row>
            <!--        <IntcommIdeaImages :mode="mode"></IntcommIdeaImages>-->
          </v-card-text>
          <v-card-actions v-if="!itemDeleted">
            <v-btn :loading="makingPost" color="primary" @click="makePost">Convert to Post</v-btn>
            <v-btn v-if="!idea.archived" :loading="archivingIdea" color="warning" @click="archiveIdea">Archive Idea
            </v-btn>
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
      changingStatus: false,
      currentDate: moment(),
      deletingIdea: false,
      errorMsg: null,
      flatpickrConfig: {
        altFormat: "m/d/Y h:i K", // format the user sees
        altInput: true,
        dateFormat: "Y-m-d H:i:S", // format sumbitted to the API
        enableTime: true
      },
      isErr: false,
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
      .catch(() => {
        this.isErr = true
        this.errorMsg = 'Error fetching idea.'
      })
    },
    async changeAdminStatus () {
      this.isErr = false
      this.changingStatus = true

      // Don't use FormData with a PUT request
      let data = {
        admin_status: this.idea.admin_status
      }
      let routeurl = '/api/intcomm/ideas/admin/' + this.idea.ideaId + '/status'

      await this.$http.put(routeurl, data)
      .then((r) => {
        this.setIdea(r.data)
        this.changingStatus = false
      })
      .catch(() => {
        this.isErr = true
        this.errorMsg = 'Error changing admin status.'
      })
    },
    async makePost () {
      this.isErr = false
      this.makingPost = true
      // let formData = new FormData();
      let routeurl = '/api/intcomm/ideas/admin/' + this.idea.ideaId + '/makepost'

      await this.$http.post(routeurl)
      .then((r) => {
        this.setIdea(r.data)
        this.makingPost = false
      })
      .catch(() => {
        this.isErr = true
        this.errorMsg = 'Error creating post.'
      })
    },
    async archiveIdea () {
      if (!confirm('Archived ideas will no longer show in the ideas list. Are you sure you want to archive this idea?')) {
        return
      }
      this.isErr = false
      this.archivingIdea = true
      // let formData = new FormData();
      let routeurl = '/api/intcomm/ideas/admin/' + this.idea.ideaId + '/archive'

      await this.$http.put(routeurl)
      .then((r) => {
        this.setIdea(r.data)
        this.archivingIdea = false
      })
      .catch(() => {
        this.isErr = true
        this.errorMsg = 'Error archiving idea.'
      })
    },
    async unarchiveIdea () {
      this.isErr = false
      this.unarchivingIdea = true
      let routeurl = '/api/intcomm/ideas/admin/' + this.idea.ideaId + '/unarchive'

      await this.$http.put(routeurl)
      .then((r) => {
        this.setIdea(r.data)
        this.unarchivingIdea = false
      })
      .catch(() => {
        this.isErr = true
        this.errorMsg = 'Error unarchiving idea.'
      })
    },
    async deleteIdea () {
      if (!confirm('Deleting an idea will also delete it for the original contributor. If you want the contributor to still see their idea, use the "Reject Idea" feature instead. Are you sure you want to delete this idea?')) {
        return
      }
      this.deletingIdea = true
      let routeurl = '/api/intcomm/ideas/admin/' + this.idea.ideaId

      await this.$http.delete(routeurl)
      .then(() => {
        this.deletingIdea = false
        this.itemDeleted = true
      })
      .catch(() => {
        this.isErr = true
        this.errorMsg = 'Error deleting idea.'
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
