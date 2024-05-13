<template>
  <v-row>
    <v-col cols="12">
     {{ post ? post.postId : null }}
    </v-col>
  </v-row>
</template>

<script>
import moment from 'moment'
import flatpickr from 'vue-flatpickr-component'
import 'flatpickr/dist/flatpickr.css'
import { mapMutations, mapState } from "vuex"

export default {
  mixins: [],
  components: {
    flatpickr
  },
  created () {
    this.fetchPost()
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
      loadingPost: false,
      post: null
    }
  },
  computed: {
    ...mapState([]),
    // Extract the post ID from the URL (will be the second to last part)
    // e.g. https://today.emich.edu/admin/intcomm/posts/54/edit
    postId () {
      const urlParts = window.location.href.split('/')
      return urlParts[urlParts.length - 2]
    }
  },
  methods: {
    ...mapMutations([]),
    async fetchPost () {
      this.loadingPost = true
      let routeurl = `/api/intcomm/posts/${this.postId}`

      await this.$http.get(routeurl)
      .then((r) => {
        this.post = r.data
        this.loadingPost = false
      })
      .catch((e) => {
        console.log(e)
      })
    },
    async savePost () {
      this.loadingPost = true
      let routeurl = '/api/intcomm/posts'

      await this.$http.post(routeurl, this.post)
      .then((r) => {
        this.post = r.data
        this.loadingPost = false
      })
      .catch((e) => {
        console.log(e)
      })
    }
  }
}
</script>
<style scoped>

</style>
