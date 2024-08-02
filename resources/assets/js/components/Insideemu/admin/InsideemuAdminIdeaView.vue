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
                <v-alert v-if="idea.archived && !itemDeleted" class="mb-3" type="warning" density="compact">This idea
                  has been archived.
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
                    hint="For internal use only. This will not be visible to the contributor. Updates automatically on change."
                    persistent-hint
                    :loading="changingStatus"
                    @update:modelValue="changeAdminStatus"
                ></v-select>
              </v-col>
            </v-row>
            <v-row>
              <v-col cols="12">
                <v-card>
                  <v-row elevation="2">
                    <v-col cols="12" sm="6" md="4" lg="3">
                      <v-card elevation="0">
                        <v-list lines="two" color="blue">
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
                            <v-list-item-title>Source to Credit</v-list-item-title>

                            <v-list-item-subtitle>
                              {{
                                idea.use_other_source && idea.other_source ? idea.other_source : idea.contributor_fullname
                              }}
                            </v-list-item-subtitle>
                          </v-list-item>
                          <v-list-item>
                            <v-list-item-title>Submission Dt</v-list-item-title>

                            <v-list-item-subtitle>
                              {{ slashdatetime(idea.submitted_at) }}
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
                      <v-card-text>
                        <span v-html="idea.content"></span>
                      </v-card-text>
                    </v-col>
                  </v-row>
                </v-card>
              </v-col>
            </v-row>
            <InsideemuIdeaImages></InsideemuIdeaImages>
            <v-alert v-if="postMade" type="success" density="compact" class="my-2">Idea has been successfully converted
              into a post. See 'Associated Posts' below.
            </v-alert>
          </v-card-text>
          <v-card-actions v-if="!itemDeleted">
            <v-btn v-if="!idea.archived" :loading="makingPost" color="success" variant="elevated" @click="makePost">
              Convert to Post
            </v-btn>
            <v-btn v-if="!idea.archived" :loading="archivingIdea" variant="outlined" color="warning"
                   @click="archiveIdea">Archive Idea
            </v-btn>
            <v-btn v-else :loading="unarchivingIdea" color="warning" variant="elevated" @click="unarchiveIdea">Reinstate
              Idea
            </v-btn>
            <v-btn :loading="deletingIdea" color="error" variant="outlined" @click="deleteIdea">Delete Idea</v-btn>
          </v-card-actions>
        </v-card>
      </v-col>
      <v-col cols="12" v-if="!itemDeleted">
        <v-card>
          <v-toolbar density="compact" color="grey-darken-3" title="Associated Posts"></v-toolbar>
          <v-card-text>
            <v-data-table
                :headers="assocPostHeaders"
                :items="idea.associated_posts"
                :items-per-page="-1"
            >
              <template #[`item.created_at`]="{ item }">
                {{ slashdatetime(item.created_at) }}
              </template>
              <template #[`item.title`]="{ item }">
                <a :href="`/admin/insideemu/posts/${item.postId}/edit`">{{ item.title }}</a>
              </template>
              <template #no-data>
                No associated posts for this idea.
              </template>
              <template #bottom></template>
            </v-data-table>
          </v-card-text>
        </v-card>
      </v-col>
    </v-row>
  </div>
</template>

<script>
import store from '../../../vuex/insideemu_store'
import moment from 'moment'
import flatpickr from 'vue-flatpickr-component'
import 'flatpickr/dist/flatpickr.css'
import { mapMutations, mapState } from "vuex"
import InsideemuIdeaImages from '../public/InsideemuIdeaImages.vue'
import { slashdatetime } from '../../filters'

export default {
  mixins: [],
  props: {},
  components: {
    InsideemuIdeaImages,
    flatpickr,
    insideemu_store: store
  },
  created () {
    this.fetchIdea()
  },
  data: function () {
    return {
      archivingIdea: false,
      assocPostHeaders: [
        { title: 'Created', value: 'created_at' },
        { title: 'Title', value: 'title' },
        { title: 'Status', value: 'admin_status' }
      ],
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
      postMade: false,
      unarchivingIdea: false
    }
  },
  computed: {
    ...mapState(['idea']),
    // Extract the idea ID from the URL (will be the second to last part)
    // e.g. https://today.emich.edu/admin/insideemu/posts/54/edit
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
      let routeurl = '/api/insideemu/admin/ideas/' + this.ideaId

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
      let routeurl = '/api/insideemu/admin/ideas/' + this.idea.ideaId + '/status'

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
      this.postMade = false
      this.makingPost = true
      // let formData = new FormData();
      let routeurl = '/api/insideemu/admin/ideas/' + this.idea.ideaId + '/makepost'

      await this.$http.post(routeurl)
      .then((r) => {
        this.setIdea(r.data)
        this.makingPost = false
        this.postMade = true
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
      let routeurl = '/api/insideemu/admin/ideas/' + this.idea.ideaId + '/archive'

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
      let routeurl = '/api/insideemu/admin/ideas/' + this.idea.ideaId + '/unarchive'

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
      if (!confirm('Deleting an idea will also delete it for the original contributor. If you want the contributor to still see their idea, set the Admin Status to "Not Considering" instead. Are you sure you want to delete this idea?')) {
        return
      }
      this.deletingIdea = true
      let routeurl = '/api/insideemu/admin/ideas/' + this.idea.ideaId

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
.v-list {
  background-color: #0a568c;
  color: white;
}
</style>
