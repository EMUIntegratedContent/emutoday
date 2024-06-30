<template>
  <v-row>
    <v-col cols="12">
      <v-form ref="postForm" @submit.prevent="savePost">
        <v-card>
          <v-toolbar density="compact" color="grey-darken-3" title="Post Form"></v-toolbar>
          <v-card-text>
            <!--            {{ post }}-->
            <!--            {{ postRequiredImageIDs }}-->
            <!--            {{ postHasRequiredImages }}-->
            <v-row>
              <v-col cols="12">
                <v-row>
                  <v-col cols="12" md="6">
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
                            <li v-if="!post.end_date">End date is missing.</li>
                            <li v-if="!postHasRequiredImages">At least one required image is missing.</li>
                            <li v-if="post.status !== 'Approved'">An administrator has not approved this post.</li>
                          </ul>
                        </v-expansion-panel-text>
                      </v-expansion-panel>
                    </v-expansion-panels>
                    <v-alert v-else type="success" density="compact">Post is eligible to be live.</v-alert>
                  </v-col>
                  <v-col cols="12" md="6">
                    <v-select
                        v-model="post.status"
                        :items="['Draft', 'Submitted', 'Approved', 'Denied']"
                        label="Admin Approval Status"
                        @update:modelValue="formModified = true"
                    >
                    </v-select>
                  </v-col>
                </v-row>
                <v-row>
                  <v-col cols="12">
                    <v-text-field
                        v-model="post.title"
                        label="Title"
                        maxlength="120"
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
                      <label>Start Date/Time<br>
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
                <IntcommPostImages @imageUpdated="formModified = true"></IntcommPostImages>
              </v-col>
            </v-row>
            <v-row>
              <v-col cols="12">
                <v-alert v-if="formModified && !showSuccess && !errSaving" type="info" color="warning" density="compact" class="my-2">You have unsaved changes.</v-alert>
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
  <v-row>
    <v-col cols="12">
      <v-card v-if="post.associated_idea">
        <v-toolbar density="compact" color="grey-darken-3" title="Associated Idea"></v-toolbar>
        <v-card-text>
          <v-alert class="mb-3" color="info" density="compact">Contributed by {{
              post.associated_idea.contributor_first + ' ' + post.associated_idea.contributor_last + ' (' + post.associated_idea.contributor_netid + ') '
            }} on
            {{ slashdatetime(post.associated_idea.created_at) }}
          </v-alert>
          <p>
            <strong>Suggested Title</strong>
            <br>{{ post.associated_idea.title }}
          </p>
          <p>
            <strong>Suggested Teaser</strong>
            <br>{{ post.associated_idea.teaser }}
          </p>
          <div class="mb-3">
            <strong>Suggested Content</strong>
            <br>
            <span v-html="post.associated_idea.content"></span>
          </div>
          <IntcommIdeaImages mode="post" :cols-per-img="6" @ideaImgCopied="formModified = true"></IntcommIdeaImages>
        </v-card-text>
        <v-card-actions>
          <v-btn color="primary" variant="elevated" :href="`/admin/intcomm/ideas/${post.associated_idea.id}`">Go to
            idea
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-col>
  </v-row>
</template>

<script>
import store from '../../../vuex/intcomm_store'
import moment from 'moment'
import flatpickr from 'vue-flatpickr-component'
import 'flatpickr/dist/flatpickr.css'
import { mapActions, mapGetters, mapMutations, mapState } from "vuex"
import { ckeditorIntcommMixin } from '../../ckeditor_intcomm_config'
import IntcommPostImages from './IntcommPostImages.vue'
import { slashdatetime } from '../../filters'
import IntcommIdeaImages from '../public/IntcommIdeaImages.vue'
import IntcommPostImage from './IntcommPostImage.vue'

export default {
  mixins: [ckeditorIntcommMixin],
  props: {
    mode: {
      type: String,
      default: 'public'
    }
  },
  components: {
    IntcommIdeaImages,
    IntcommPostImages,
    IntcommPostImage,
    flatpickr,
    intcomm_store: store
  },
  async created () {
    await this.fetchPost()
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
    ...mapGetters(['intcommSmallImgID', 'intcommStoryImgID', 'intcommEmailImgID', 'postRequiredImageIDs', 'postHasRequiredImages']),
    isPostLiveEligible () {
      return this.post.status === 'Approved'
    },
    // Extract the post ID from the URL (will be the second to last part)
    // e.g. https://today.emich.edu/admin/intcomm/posts/54/edit
    postId () {
      const urlParts = window.location.href.split('/')
      return urlParts[urlParts.length - 2]
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
      let routeurl = `/api/intcomm/admin/posts/${this.postId}`

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
      let routeurl = `/api/intcomm/admin/posts/imagetypes`
      await this.$http.get(routeurl)
      .then((r) => {
        this.setPostImageTypes(r.data)
      })
      .catch((e) => {
        console.log(e)
      })
    },
    resetPostForm () {
      this.setPost(JSON.parse(JSON.stringify(this.originalPost)))
      // Delay for ckeditor to reset
      setTimeout(() => {
        this.formModified = false
      }, 500)
    },
    async savePost () {
      const data = new FormData()
      data.append('post', JSON.stringify(this.post))

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
      const routeurl = httpVerb === 'put' ? `/api/intcomm/admin/posts/${this.post.postId}?_method=PUT` : '/api/intcomm/admin/posts'

      this.errSaving = false
      await this.$http.post(routeurl, data, {
        headers: {
          'Content-Type': 'multipart/form-data'
        }
      })
      .then((r) => {
        // Send new submissions to the edit form
        if(httpVerb === 'post') {
          window.location.href = '/admin/intcomm/posts/' + r.data.postId + '/edit'
        } else {
          this.setPost(r.data)
          this.originalPost = JSON.parse(JSON.stringify(this.post))
        }
        this.savingPost = false
        this.formModified = false
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
<style scoped>

</style>
