<template>
  <v-card>
    <v-toolbar density="compact" color="grey-darken-3" title="Post Images"></v-toolbar>
    <v-card-text>
<!--      {{ postImageTypes }}-->
      <v-btn v-if="!postHasSmallImage" color="primary" @click="createPostImageRecord('small')">Add Small Image</v-btn>
      <template v-else>
        <IntcommPostImage :imgtype_id="intcommSmallImgID"></IntcommPostImage>
      </template>
      <v-btn v-if="!postHasStoryImage" color="primary" @click="createPostImageRecord('story')">Add Story Image</v-btn>
      <template v-else>
        <IntcommPostImage :imgtype_id="intcommStoryImgID"></IntcommPostImage>
      </template>
      <v-btn v-if="!postHasEmailImage" color="primary" @click="createPostImageRecord('email')">Add Email Image</v-btn>
      <template v-else>
        <IntcommPostImage :imgtype_id="intcommEmailImgID"></IntcommPostImage>
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
    postHasStoryImage () {
      return this.post.images.some(img => img.imagetype_id === this.intcommStoryImgID)
    }
  },
  methods: {
    ...mapMutations(['setPostImageTypes', 'setPost', 'setPostProp']),
    ...mapActions(['createPostImageRecord']),
  }
}
</script>
<style scoped>

</style>
