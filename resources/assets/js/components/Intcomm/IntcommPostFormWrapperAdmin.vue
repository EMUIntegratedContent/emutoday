<template>
  <IntcommPostForm mode="admin"></IntcommPostForm>
</template>

<script>
import store from '../../vuex/intcomm_store'
import 'flatpickr/dist/flatpickr.css'
import { mapMutations, mapState } from "vuex"
import IntcommPostForm from './IntcommPostForm.vue'

export default {
  mixins: [],
  props: {
    mode: {
      type: String,
      default: 'public'
    }
  },
  components: {
    IntcommPostForm,
    intcomm_store: store
  },
  created () {
    this.fetchPost()
  },
  data: function () {
    return {
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
    }
  }
}
</script>
<style scoped>

</style>
