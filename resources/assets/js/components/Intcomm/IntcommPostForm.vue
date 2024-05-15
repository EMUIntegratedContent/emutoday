<template>
  <v-form ref="postForm" @submit.prevent="savePost">
    <v-row>
      <v-col cols="12">
<!--        {{ post ? post.postId : null }}-->
        <v-text-field
            v-model="post.title"
            label="Title"
            :rules="[v => !!v || 'Title is required']"
        ></v-text-field>
        <v-text-field
            v-model="post.teaser"
            label="Teaser"
        ></v-text-field>
<!--        <v-textarea-->
<!--            v-model="post.content"-->
<!--            label="Story Content"-->
<!--            :rules="[v => !!v || 'Story content is required']"-->
<!--        ></v-textarea>-->
        <label for="content">Content</label>
<!--        <p class="help-text" id="content-helptext">Enter the story content <span-->
<!--            v-if="storyType == 'featurephoto'">(optional)</span></p>-->
        <ckeditor
            id="content"
            name="content"
            v-model="post.content"
            :editor="editor"
            :config="mode === 'admin' ? editorConfigFull : editorConfigSimple"
        ></ckeditor>
        <!--          <input type="text" id="editor" v-model="content" />-->
<!--        <p v-if="formErrors.content" class="help-text invalid">Need Content!</p>-->
      </v-col>
    </v-row>
    <IntcommPostImages :mode="mode"></IntcommPostImages>
    <v-btn type="submit" :loading="loadingPost" color="primary">Save Post</v-btn>
    <v-btn type="button" :loading="loadingPost" color="secondary" variant="outlined">Cancel Changes</v-btn>
  </v-form>
</template>

<script>
import store from '../../vuex/intcomm_store'
import moment from 'moment'
import flatpickr from 'vue-flatpickr-component'
import 'flatpickr/dist/flatpickr.css'
import { mapMutations, mapState } from "vuex"
import { ckeditorMixin } from '../ckeditor_config'
import IntcommPostImages from './IntcommPostImages.vue'

export default {
  mixins: [ckeditorMixin],
  props: {
    mode: {
      type: String,
      default: 'public'
    }
  },
  components: {
    IntcommPostImages,
    flatpickr,
    intcomm_store: store
  },
  created () {

  },
  data: function () {
    return {
      currentDate: moment(),
      flatpickrConfig: {
        altFormat: "m/d/Y", // format the user sees
        altInput: true,
        dateFormat: "Y-m-d", // format sumbitted to the API
        enableTime: false
      },
      loadingPost: false
    }
  },
  computed: {
    ...mapState(['post']),
    // Extract the post ID from the URL (will be the second to last part)
    // e.g. https://today.emich.edu/admin/intcomm/posts/54/edit
    postId () {
      const urlParts = window.location.href.split('/')
      return urlParts[urlParts.length - 2]
    }
  },
  methods: {
    ...mapMutations(['setPost']),
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
