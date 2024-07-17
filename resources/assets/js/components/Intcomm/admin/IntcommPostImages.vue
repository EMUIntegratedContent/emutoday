<template>
  <v-card>
    <v-toolbar density="compact" color="grey-darken-1" title="Images"></v-toolbar>
    <v-card-text>
      <v-btn v-if="!postHasSmallImage" block class="my-2" color="error darken-3" @click="handleCreateImage('small')">Add Small Image (required)</v-btn>
      <template v-else>
        <IntcommPostImage :imgtype_id="intcommSmallImgID" @imageUpdated="$emit('imageUpdated')"></IntcommPostImage>
      </template>
      <v-btn v-if="!postHasHeadlineImage" block class="my-2" color="primary" variant="outlined" @click="handleCreateImage('story')">Add Headline Image</v-btn>
      <template v-else>
        <IntcommPostImage :imgtype_id="intcommStoryImgID" @imageUpdated="$emit('imageUpdated')"></IntcommPostImage>
      </template>
      <v-btn v-if="!postHasEmailImage" block class="my-2" color="primary" variant="outlined" @click="handleCreateImage('email')">Add Email Image</v-btn>
      <template v-else>
        <IntcommPostImage :imgtype_id="intcommEmailImgID" @imageUpdated="$emit('imageUpdated')"></IntcommPostImage>
      </template>
    </v-card-text>
  </v-card>
</template>

<script>
import store from '../../../vuex/intcomm_store'
import { mapActions, mapGetters, mapMutations, mapState } from "vuex"
import IntcommPostImage from './IntcommPostImage.vue'

export default {
  mixins: [],
  props: {

  },
  components: {
    IntcommPostImage,
    intcomm_store: store
  },
  emits: ['imageUpdated'],
  created () {

  },
  data: function () {
    return {
    }
  },
  computed: {
    ...mapState(['postImageTypes', 'post']),
    ...mapGetters(['intcommSmallImgID', 'intcommStoryImgID', 'intcommEmailImgID']),
    postHasEmailImage () {
      return this.post.images.some(img => img.imagetype_id === this.intcommEmailImgID)
    },
    postHasSmallImage () {
      return this.post.images.some(img => img.imagetype_id === this.intcommSmallImgID)
    },
    postHasHeadlineImage () {
      return this.post.images.some(img => img.imagetype_id === this.intcommStoryImgID)
    }
  },
  methods: {
    ...mapMutations(['setPostImageTypes', 'setPost', 'setPostProp']),
    ...mapActions(['createPostImageRecord']),
    handleCreateImage (imgType) {
      this.createPostImageRecord(imgType)
      this.$emit('imageUpdated')
    }
  }
}
</script>
<style scoped>

</style>
