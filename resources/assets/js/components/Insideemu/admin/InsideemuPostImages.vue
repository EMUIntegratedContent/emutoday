<template>
  <v-card>
    <v-toolbar density="compact" color="grey-darken-1" title="Images"></v-toolbar>
    <v-card-text>
      <v-btn v-if="!postHasSmallImage" block class="my-2" color="error darken-3" @click="handleCreateImage('small')">Add Small Image (required)</v-btn>
      <template v-else>
        <InsideemuPostImage :imgtype_id="insideemuSmallImgID" @imageUpdated="$emit('imageUpdated')"></InsideemuPostImage>
      </template>
      <v-btn v-if="!postHasHeadlineImage" block class="my-2" color="primary" variant="outlined" @click="handleCreateImage('story')">Add Headline Image</v-btn>
      <template v-else>
        <InsideemuPostImage :imgtype_id="insideemuStoryImgID" @imageUpdated="$emit('imageUpdated')"></InsideemuPostImage>
      </template>
      <v-btn v-if="!postHasEmailImage" block class="my-2" color="primary" variant="outlined" @click="handleCreateImage('email')">Add Email Image</v-btn>
      <template v-else>
        <InsideemuPostImage :imgtype_id="insideemuEmailImgID" @imageUpdated="$emit('imageUpdated')"></InsideemuPostImage>
      </template>
    </v-card-text>
  </v-card>
</template>

<script>
import store from '../../../vuex/insideemu_store'
import { mapActions, mapGetters, mapMutations, mapState } from "vuex"
import InisdeemuPostImage from './InisdeemuPostImage.vue'

export default {
  mixins: [],
  props: {

  },
  components: {
    InisdeemuPostImage,
    inisdeemu_store: store
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
    ...mapGetters(['insideemuSmallImgID', 'insideemuStoryImgID', 'insideemuEmailImgID']),
    postHasEmailImage () {
      return this.post.images.some(img => img.imagetype_id === this.insideemuEmailImgID)
    },
    postHasSmallImage () {
      return this.post.images.some(img => img.imagetype_id === this.insideemuSmallImgID)
    },
    postHasHeadlineImage () {
      return this.post.images.some(img => img.imagetype_id === this.insideemuStoryImgID)
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
