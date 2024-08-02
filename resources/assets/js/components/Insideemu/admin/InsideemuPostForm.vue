<template>
  <v-row>
    <v-col cols="12">
      <v-form ref="postForm" @submit.prevent="savePostPreflight">
        <v-card>
          <v-toolbar
              density="compact"
              color="grey-darken-3"
              :title="newForm ? 'New Inside EMU Post' : 'Edit Inside EMU Post'"
          >
            <v-spacer></v-spacer>
            <v-btn
                v-if="!newForm"
                color="warning"
                size="x-small"
                icon="mdi-eye"
                title="preview post"
                @click="previewItem"
            ></v-btn>
          </v-toolbar>
          <v-card-text>
            <v-row>
              <v-col cols="12">
                <v-row>
                  <v-col cols="12" md="6">
                    <v-alert v-if="post.is_live" type="success" density="compact" variant="elevated">Post is LIVE.</v-alert>
                    <v-alert
                        v-if="showHubPostAlert"
                        color="yellow-darken-3"
                        icon="mdi-star-outline"
                        density="compact"
                        variant="elevated"
                        class="mt-3"
                    >This post is featured on the hub page.</v-alert>
                    <template v-if="!post.is_live">
                      <v-expansion-panels
                          v-if="!isPostLiveEligible"
                          v-model="explanationPanel"
                      >
                        <v-expansion-panel>
                          <v-expansion-panel-title color="warning">
                            <span class="font-weight-bold"><v-icon>mdi-alert</v-icon> Post is NOT eligible to be live.</span>
                          </v-expansion-panel-title>
                          <v-expansion-panel-text>
                            This post is missing key components required for it to be shown live.<br><br>
                            <ul>
                              <li v-if="!post.title">Title is missing.</li>
                              <li v-if="!post.content">Post content is missing.</li>
                              <li v-if="!post.start_date">Start date is missing.</li>
                              <li v-if="!postHasRequiredImages">At least one required image is missing.</li>
                              <li v-if="post.admin_status !== 'Approved'">An administrator has not approved this post.</li>
                            </ul>
                          </v-expansion-panel-text>
                        </v-expansion-panel>
                      </v-expansion-panels>
                      <v-alert v-else type="success" density="compact" variant="outlined">Post is eligible to be live.</v-alert>
                      <v-alert v-if="!userIsApprover && isPostLiveEligible" type="info" density="compact" class="my-2">Any changes will need to be re-approved by an administrator or editor.</v-alert>
                    </template>
                  </v-col>
                  <v-col cols="12" md="6">
                    <v-select
                        v-model="post.admin_status"
                        :items="['Pending', 'Approved', 'Denied']"
                        label="Post Approval Status"
                        :readonly="!userIsApprover"
                        :hint="!userIsApprover ? 'You do not have permission to set approval status.' : ''"
                        :persistent-hint="!userIsApprover"
                        @update:modelValue="formModified = true"
                    >
                    </v-select>
                    <v-switch
                        v-if="canMakeHubPost"
                        v-model="post.is_hub_post"
                        label="Make this the featured post on the hub page"
                        color="yellow-darken-3"
                        hide-details
                        :true-value="1"
                        :false-value="0"
                        @update:modelValue="formModified = true"
                    >
                    </v-switch>
                  </v-col>
                </v-row>
                <v-row>
                  <v-col cols="12">
                    <v-text-field
                        v-model="post.title"
                        label="Title"
                        maxlength="120"
                        :rules="[v => !!v || 'Title is required']"
                        @update:modelValue="formModified = true"
                    >
                      <template #label>
                        Title <span class="text-error">*</span>
                      </template>
                    </v-text-field>
                    <v-text-field
                        v-model="post.teaser"
                        label="Teaser"
                        maxlength="120"
                        counter
                        @update:modelValue="formModified = true"
                    ></v-text-field>
                    <label for="content">Content <span class="text-error">*</span></label>
                    <ckeditor
                        id="content"
                        name="content"
                        v-model="post.content"
                        :editor="editor"
                        :config="editorConfigFull"
                        @input="formModified = true"
                    ></ckeditor>
                    <div class="ck ck-word-count">
                      <p>
                        <strong><span class="ck-word-count__words">Words: 0</span>/700</strong>
                      </p>
                    </div>
                  </v-col>
                </v-row>
                <v-row>
                  <v-col cols="12" md="6" lg="4">
                    <v-sheet color="grey-lighten-4" class="py-3 px-5">
                      <label>Start Date/Time <span class="text-error">*</span><br>
                        <flatpickr
                            v-model="post.start_date"
                            id="startDatePicker"
                            :config="flatpickrConfig"
                            class="form-control"
                            name="startingDate"
                            @change="formModified = true"
                        >
                        </flatpickr>
                      </label>
                      <br>
                      <label>End Date/Time<br>
                        <flatpickr
                            v-model="post.end_date"
                            id="endDatePicker"
                            :config="flatpickrConfig"
                            class="form-control"
                            name="endingDate"
                            @change="formModified = true"
                        >
                        </flatpickr>
                      </label>
                    </v-sheet>
                  </v-col>
                  <v-col cols="12" md="6" lg="8">
                    <v-text-field
                        v-model="post.source"
                        label="Credit/Source"
                        @update:modelValue="formModified = true"
                    ></v-text-field>
                  </v-col>
                </v-row>
              </v-col>
              <v-col cols="12">
                <InsideemuPostImages @imageUpdated="formModified = true"></InsideemuPostImages>
              </v-col>
            </v-row>
            <v-row>
              <v-col cols="12">
                <v-alert v-if="formModified && !showSuccess && !errSaving && !savingPost" type="info" color="warning" density="compact" class="my-2">You have unsaved changes.</v-alert>
                <v-alert v-if="errSaving" type="error" density="compact" class="my-2">The post could not be saved.</v-alert>
                <v-alert v-if="showSuccess" type="success" density="compact" class="my-2">The post has been saved.</v-alert>
              </v-col>
            </v-row>
          </v-card-text>
          <v-card-actions>
            <v-btn type="submit" :loading="savingPost" color="success" variant="elevated">Save Post</v-btn>
            <v-btn type="button" color="grey" variant="outlined" class="ml-2"
                   @click="resetPostForm">Cancel Changes
            </v-btn>
          </v-card-actions>
        </v-card>
      </v-form>
    </v-col>
  </v-row>
  <v-row v-if="post.associated_idea">
    <v-col cols="12">
      <v-card>
        <v-toolbar density="compact" color="grey-darken-3" title="Associated Idea"></v-toolbar>
        <v-card-text>
          <v-card class="mb-3">
            <v-row elevation="2">
              <v-col cols="12" sm="6" md="4" lg="3">
                <v-card elevation="0">
                  <v-list lines="two" color="blue">
                    <v-list-item>
                      <v-list-item-title>Suggested Title</v-list-item-title>

                      <v-list-item-subtitle>
                        {{ post.associated_idea.title }}
                      </v-list-item-subtitle>
                    </v-list-item>

                    <v-list-item>
                      <v-list-item-title>Suggested Teaser</v-list-item-title>

                      <v-list-item-subtitle>
                        {{ post.associated_idea.teaser ? post.associated_idea.teaser : 'No suggested teaser provided' }}
                      </v-list-item-subtitle>
                    </v-list-item>
                    <v-list-item>
                      <v-list-item-title>Contributor</v-list-item-title>

                      <v-list-item-subtitle>
                        {{ post.associated_idea.contributor_fullname + ' (' + post.associated_idea.contributor_netid + ')' }}
                      </v-list-item-subtitle>
                    </v-list-item>
                    <v-list-item>
                      <v-list-item-title>Source to Credit</v-list-item-title>

                      <v-list-item-subtitle>
                        {{
                          post.associated_idea.use_other_source && post.associated_idea.other_source ? post.associated_idea.other_source : post.associated_idea.contributor_fullname
                        }}
                      </v-list-item-subtitle>
                    </v-list-item>
                    <v-list-item>
                      <v-list-item-title>Submission Dt</v-list-item-title>

                      <v-list-item-subtitle>
                        {{ slashdatetime(post.associated_idea.submitted_at) }}
                      </v-list-item-subtitle>
                    </v-list-item>
                    <v-list-item>
                      <v-list-item-title>Last Updated</v-list-item-title>

                      <v-list-item-subtitle>
                        {{ slashdatetime(post.associated_idea.updated_at) }}
                      </v-list-item-subtitle>
                    </v-list-item>
                  </v-list>
                </v-card>
              </v-col>
              <v-col cols="12" sm="6" md="8" lg="9">
                <v-card-text>
                  <span v-html="post.associated_idea.content"></span>
                </v-card-text>
              </v-col>
            </v-row>
          </v-card>
          <InsideemuIdeaImages mode="post" :cols-per-img="6" @ideaImgCopied="formModified = true"></InsideemuIdeaImages>
        </v-card-text>
      </v-card>
    </v-col>
  </v-row>
</template>

<script>
import store from '../../../vuex/insideemu_store'
import moment from 'moment'
import flatpickr from 'vue-flatpickr-component'
import 'flatpickr/dist/flatpickr.css'
import { mapActions, mapGetters, mapMutations, mapState } from "vuex"
import { ckeditorInisdeemuMixin } from '../../ckeditor_insideemu_config'
import InisdeemuPostImages from './InsideemuPostImages.vue'
import { slashdatetime } from '../../filters'
import InisdeemuIdeaImages from '../public/InisdeemuIdeaImages.vue'
import InisdeemuPostImage from './InisdeemuPostImage.vue'

export default {
  mixins: [ckeditorInisdeemuMixin],
  props: {
    newForm: {
      type: Boolean,
      default: false
    },
    userRoles: {
      type: Object,
      default: () => ({})
    }
  },
  components: {
    InisdeemuIdeaImages,
    InisdeemuPostImages,
    InisdeemuPostImage,
    flatpickr,
    insideemu_store: store
  },
  async created () {
    if(!this.newForm) {
      await this.fetchPost()
    } else {
      this.originalPost = JSON.parse(JSON.stringify(this.post))
      setTimeout(() => {
        this.formModified = false
      }, 500)
    }
    await this.getImageTypes()
  },
  data: function () {
    return {
      currentDate: moment(),
      explanationPanel: [0],
      flatpickrConfig: {
        altFormat: "m/d/Y h:i K", // format the user sees
        altInput: true,
        dateFormat: "Y-m-d H:i:S", // format sumbitted to the API
        enableTime: true
      },
      formModified: false,
      imageTypes: [],
      loadingPost: false,
      originalPost: {},
      wordLimit: 700,
      savingPost: false,
      errSaving: false,
      showSuccess: false
    }
  },
  computed: {
    ...mapState(['postImageTypes', 'post']),
    ...mapGetters(['insideemuSmallImgID', 'insideemuStoryImgID', 'insideemuEmailImgID', 'postRequiredImageIDs', 'postHasRequiredImages']),
    canMakeHubPost () {
      return !this.newForm && this.userIsApprover && this.post.admin_status === 'Approved'
    },
    // Determine if the post is eligible to be live. This does NOT check if the post is currently live. That is determined by post.is_live.
    isPostLiveEligible () {
      return this.post.admin_status === 'Approved' && this.postHasRequiredImages && this.post.title && this.post.content && this.post.start_date
    },
    // Extract the post ID from the URL (will be the second to last part)
    // e.g. https://today.emich.edu/admin/insideemu/posts/54/edit
    postId () {
      const urlParts = window.location.href.split('/')
      return urlParts[urlParts.length - 2]
    },
    postPreviewPath: function () {
      return `/admin/preview/insideemu/post/${this.post.postId}`
    },
    // Avoid showing the hub post alert when the post isn't updated yet.
    showHubPostAlert () {
      return this.post.is_live && this.originalPost.is_hub_post
    },
    userIsApprover () {
      if(!this.userRoles) return false
      return this.userRoles.find(role => role.name.includes('admin') || role.name.includes('editor') || role.name.includes('contributor_2'))
    }
  },
  methods: {
    slashdatetime,
    ...mapMutations(['setPostImageTypes', 'setPost', 'setPostProp']),
    ...mapActions(['createPostImageRecord']),
    // Alert the user if leaving the page with unsaved changes.
    beforeUnload (e) {
      if (this.formModified) {
        e.preventDefault();
        e.returnValue = ''; // text is set by the browser
      }
    },
    async fetchPost () {
      this.loadingPost = true
      let routeurl = `/api/insideemu/admin/posts/${this.postId}`

      await this.$http.get(routeurl)
      .then((r) => {
        this.setPost(r.data)
        this.originalPost = JSON.parse(JSON.stringify(r.data)) // save a copy of the original post in case a reset is needed.
        this.loadingPost = false
        setTimeout(() => {
          this.formModified = false
        }, 500)
      })
      .catch((e) => {
        console.log(e)
      })
    },
    async getImageTypes () {
      let routeurl = `/api/insideemu/admin/posts/imagetypes`
      await this.$http.get(routeurl)
      .then((r) => {
        this.setPostImageTypes(r.data)
      })
      .catch((e) => {
        console.log(e)
      })
    },
    previewItem: function () {
      window.location.href = this.postPreviewPath;
    },
    resetPostForm () {
      this.setPost(JSON.parse(JSON.stringify(this.originalPost)))
      // Delay for ckeditor to reset
      setTimeout(() => {
        this.formModified = false
      }, 500)
    },
    async savePostPreflight () {
      const { valid } = await this.$refs.postForm.validate()
      if(!valid || !this.post.content) {
        alert('Please fill in all required fields before saving.')
        return
      }

      // If a non-admin user is saving a post, always set the admin_status to 'Submitted'
      if(!this.userIsApprover) {
        this.post.admin_status = 'Submitted'
      }

      await this.savePost()
    },
    async savePost () {
      const data = new FormData()
      data.append('post', JSON.stringify(this.post))

      this.savingPost = true

      // Attach any new images to the form data
      let imgIndex = 0 // Don't use the image index because it's not always sequential
      this.post.images.forEach((image) => {
        // Only image records with a "file" property have new images to upload
        if (Object.hasOwn(image, 'file')) {
          data.append(`images[${imgIndex}]`, image.file);
          data.append(`imageNames[${imgIndex}]`, image.image_name);
          imgIndex++
        }
      });

      // Laravel doesn't like handing FormData in PUT methods.
      // To get around this, always submit as POST, but add _method=PUT to the end of the route
      const httpVerb = this.post.postId && this.post.postId != 0 ? 'put' : 'post'
      const routeurl = httpVerb === 'put' ? `/api/insideemu/admin/posts/${this.post.postId}?_method=PUT` : '/api/insideemu/admin/posts'

      this.errSaving = false
      await this.$http.post(routeurl, data, {
        headers: {
          'Content-Type': 'multipart/form-data'
        }
      })
      .then((r) => {
        this.formModified = false // Reset the form modified flag before leaving the page (new forms)
        // Send new submissions to the edit form
        if(httpVerb === 'post') {
          window.location.href = '/admin/insideemu/posts/' + r.data.postId + '/edit'
        } else {
          this.setPost(r.data)
          this.originalPost = JSON.parse(JSON.stringify(this.post))
        }
        this.savingPost = false
        this.showSuccess = true
        setTimeout(() => {
          this.showSuccess = false
        }, 2000)
      })
      .catch(() => {
        this.savingPost = false
        this.errSaving = true
      })
    }
  },
  mounted () {
    window.addEventListener('beforeunload', this.beforeUnload)
  },
  beforeUnmount () {
    window.removeEventListener('beforeunload', this.beforeUnload)
  },
}
</script>
<style scoped lang="scss">
.v-list {
  background-color: #0a568c;
  color: white;
}
</style>
