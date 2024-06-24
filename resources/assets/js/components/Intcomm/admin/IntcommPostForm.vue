<template>
  <v-row>
    <v-col cols="12" md="6" lg="8">
      <v-card v-if="post.associated_idea">
        <v-toolbar density="compact" color="grey-darken-3" title="Post Form"></v-toolbar>
        <v-card-text>
          <v-form ref="postForm" @submit.prevent="savePost">
            <v-row>
              <v-col cols="12">
                {{ post }}
                <v-text-field
                    v-model="post.title"
                    label="Title"
                    maxlength="120"
                    counter
                    :rules="[v => !!v || 'Title is required']"
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
                ></v-text-field>
                <!--        <v-textarea-->
                <!--            v-model="post.content"-->
                <!--            label="Story Content"-->
                <!--            :rules="[v => !!v || 'Story content is required']"-->
                <!--        ></v-textarea>-->
                <label for="content">Content <span class="text-error">*</span></label>
                <ckeditor
                    id="content"
                    name="content"
                    v-model="post.content"
                    :editor="editor"
                    :config="editorConfigFull"
                ></ckeditor>
                <div class="ck ck-word-count">
<!--                  <p :class="wordCountColor">-->
                  <p>
                    <strong><span class="ck-word-count__words">Words: 0</span>/700</strong>
<!--                    <span v-if="contentWordCount > wordLimit"-->
<!--                          class="text-error ml-3">You have exceeded the word limit by {{ contentWordCount - wordLimit }} words. Any words beyond the limit will not be saved.</span>-->
                  </p>
                </div>
              </v-col>
            </v-row>
            <v-row>
              <v-col cols="12" md="6">
                <label>Start Date<br>
                  <flatpickr
                      v-model="post.start_date"
                      id="startDatePicker"
                      :config="flatpickrConfig"
                      class="form-control"
                      name="startingDate"
                  >
                  </flatpickr>
                </label>
              </v-col>
              <v-col cols="12" md="6">
                <label>End Date<br>
                  <flatpickr
                      v-model="post.end_date"
                      id="endDatePicker"
                      :config="flatpickrConfig"
                      class="form-control"
                      name="endingDate"
                  >
                  </flatpickr>
                </label>
              </v-col>
              <v-col cols="12">
                <v-select
                    v-model="post.status"
                    :items="['Draft', 'Submitted', 'Approved', 'Denied']"
                    label="Status"
                >
                </v-select>
              </v-col>
            </v-row>
            <v-row>
              <v-col cols="12" md="6">
                <v-card>
                  <v-toolbar title="Submission Info" density="compact" color="teal"></v-toolbar>
                  <v-card-text>
                    <v-list density="compact">
                      <v-list-item>Submitted By: {{ post.submitted_by }}</v-list-item>
                      <v-list-item>Submission Dt: {{ slashdatetime(post.created_at) }}</v-list-item>
                    </v-list>
                  </v-card-text>
                </v-card>
              </v-col>
              <v-col cols="12" md="6">
                <v-text-field
                    v-model="post.source"
                    label="Source"
                ></v-text-field>
              </v-col>
            </v-row>
            <v-row>
              <v-col cols="12">
                <v-btn type="submit" :loading="loadingPost" color="primary">Save Post</v-btn>
                <v-btn type="button" :loading="loadingPost" color="secondary" variant="outlined" class="ml-2">Cancel Changes</v-btn>
              </v-col>
            </v-row>
          </v-form>
        </v-card-text>
      </v-card>
    </v-col>
    <v-col cols="12" md="6" lg="4">
      <v-card v-if="post.associated_idea">
        <v-toolbar density="compact" color="grey-darken-3" title="Post Images"></v-toolbar>
        <v-card-text>
          POST IMAGES HERE
          {{ postImageTypes }}
        </v-card-text>
      </v-card>
    </v-col>
  </v-row>
  <v-row>
    <v-col cols="12">
      <v-card v-if="post.associated_idea">
        <v-toolbar density="compact" color="grey-darken-3" title="Associated Idea"></v-toolbar>
        <v-card-text>
          <!--          {{ post.associated_idea }}-->
          <v-alert class="mb-3" color="info" density="compact">Contributed by {{ post.associated_idea.contributor_first + ' ' + post.associated_idea.contributor_last + ' (' + post.associated_idea.contributor_netid  + ') ' }} on
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
          <v-btn color="primary" variant="elevated" :href="`/admin/intcomm/ideas/${post.associated_idea.id}`">Go to idea</v-btn>
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
import { mapMutations, mapState } from "vuex"
import { ckeditorIntcommMixin } from '../../ckeditor_intcomm_config'
import IntcommPostImages from './IntcommPostImages.vue'
import { slashdatetime } from '../../filters'
import IntcommIdeaImages from '../public/IntcommIdeaImages.vue'

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
      flatpickrConfig: {
        altFormat: "m/d/Y h:i K", // format the user sees
        altInput: true,
        dateFormat: "Y-m-d H:i:S", // format sumbitted to the API
        enableTime: true
      },
      formModified: false,
      imageTypes: [],
      loadingPost: false,
      wordLimit: 700
    }
  },
  computed: {
    ...mapState(['postImageTypes', 'post']),
    // Extract the post ID from the URL (will be the second to last part)
    // e.g. https://today.emich.edu/admin/intcomm/posts/54/edit
    postId () {
      const urlParts = window.location.href.split('/')
      return urlParts[urlParts.length - 2]
    },
    contentWordCount () {
      return this.post.content.split(' ').length
    },
    // wordCountColor () {
    //   if (this.contentWordCount <= this.wordLimit - 100) {
    //     return 'text-success'
    //   }
    //   else if (this.contentWordCount > this.wordLimit - 100 && this.contentWordCount <= this.wordLimit - 20) {
    //     return 'text-warning'
    //   }
    //   return 'text-error'
    // }
  },
  methods: {
    slashdatetime,
    ...mapMutations(['setPostImageTypes', 'setPost', 'setPostProp']),
    async fetchPost () {
      this.loadingPost = true
      let routeurl = `/api/intcomm/posts/${this.postId}`

      await this.$http.get(routeurl)
      .then((r) => {
        this.setPost(r.data)
        this.loadingPost = false
      })
      .catch((e) => {
        console.log(e)
      })
    },
    async getImageTypes () {
      let routeurl = `/api/intcomm/posts/imagetypes`
      await this.$http.get(routeurl)
      .then((r) => {
        this.setPostImageTypes(r.data)
      })
      .catch((e) => {
        console.log(e)
      })
    },
    async savePost () {
      alert("saving!")
      // this.loadingPost = true
      // let formData = new FormData();
      //
      // // Assuming `fileInput` is an input element with type="file"
      // let fileInput = document.querySelector('#file-input');
      // let files = fileInput.files;
      //
      // for (let i = 0; i < files.length; i++) {
      //   formData.append('images[]', files[i]);
      // }
      // let routeurl = '/api/intcomm/posts'
      //
      // await this.$http.post(routeurl, formData, {
      //   headers: {
      //     'Content-Type': 'multipart/form-data'
      //   }
      // })
      // .then((r) => {
      //   this.post = r.data
      //   this.loadingPost = false
      // })
      // .catch((e) => {
      //   console.log(e)
      // })
    }
  }
}
</script>
<style scoped>

</style>
