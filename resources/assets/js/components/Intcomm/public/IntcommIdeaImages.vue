<template>
  <v-row>
    <v-col cols="12">
      <p class="text-h5">Associated Images</p>
      <IdeaImgUploader v-if="editMode" @imageUploaded="$emit('imagesUpdated')"></IdeaImgUploader>
    </v-col>
  </v-row>
  <v-row>
    <v-col
        v-for="(image, i) in ideaImages"
        :key="`img-${image.id}`"
        class="d-flex child-flex bg-danger"
        cols="4"
    >
      <IdeaImage :key="`img-dialog-${i}`" :index="i" :editMode="editMode" :mode="mode" @imageUpdated="$emit('imagesUpdated')"></IdeaImage>
    </v-col>
  </v-row>
</template>

<script>
import store from '../../../vuex/intcomm_store'
import 'flatpickr/dist/flatpickr.css'
import IdeaImage from './IdeaImage.vue'
import { mapState } from "vuex"
import IdeaImgUploader from './IdeaImgUploader.vue'

export default {
  mixins: [],
  props: {
    mode: {
      type: String,
      default: 'idea' // 'post' or 'idea'
    },
    editMode: {
      type: Boolean,
      default: false
    }
  },
  emits: ['imagesUpdated'],
  components: {
    IdeaImgUploader,
    intcomm_store: store,
    IdeaImage
  },
  created () {

  },
  data: function () {
    return {

    }
  },
  computed: {
    ...mapState(['idea', 'post']),
    ideaImages () {
      if(this.mode === 'post') {
        return this.post.associated_idea ? this.post.associated_idea.images : []
      }
      return this.idea.images
    }
  },
  methods: {

  }
}
</script>
<style scoped>

</style>
