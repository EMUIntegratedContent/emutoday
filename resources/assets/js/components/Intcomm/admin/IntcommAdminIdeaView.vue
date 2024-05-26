<template>
  <v-form ref="postForm" @submit.prevent="savePost">
    <v-card>
      <v-card-text>
        <v-row>
          <v-col cols="12">
            {{ idea }}
          </v-col>
        </v-row>
<!--        <IntcommPostImages :mode="mode"></IntcommPostImages>-->
<!--        <v-row>-->
<!--          <v-col cols="12">-->
<!--            <v-btn type="submit" :loading="loadingPost" color="primary">Save Post</v-btn>-->
<!--            <v-btn type="button" :loading="loadingPost" color="secondary" variant="outlined">Cancel Changes</v-btn>-->
<!--          </v-col>-->
<!--        </v-row>-->
      </v-card-text>
    </v-card>
  </v-form>
</template>

<script>
import store from '../../../vuex/intcomm_store'
import moment from 'moment'
import flatpickr from 'vue-flatpickr-component'
import 'flatpickr/dist/flatpickr.css'
import { mapMutations, mapState } from "vuex"
// import IntcommPostImages from './IntcommPostImages.vue'

export default {
  mixins: [],
  props: {

  },
  components: {
    // IntcommPostImages,
    flatpickr,
    intcomm_store: store
  },
  created () {
    this.fetchIdea()
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
      loadingIdea: false,
      wordLimit: 700
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
