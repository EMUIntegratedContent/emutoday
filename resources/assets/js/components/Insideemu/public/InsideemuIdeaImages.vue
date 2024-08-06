<template>
  <v-row>
    <v-col cols="12">
      <v-card>
        <v-toolbar title="Associated Images" density="compact"></v-toolbar>
        <v-card-text>
          <v-row>
            <v-col cols="12">
              <IdeaImgUploader v-if="editMode" @imageUploaded="$emit('imagesUpdated')"></IdeaImgUploader>
            </v-col>
            <v-col cols="12" v-if="ideaImages.length === 0" class="mt-0 pt-0">
              <p v-if="ideaImages.length === 0">No associated images with this idea.</p>
            </v-col>
            <v-col
                v-else
                v-for="(image, i) in ideaImages"
                :key="`img-${image.id}`"
                class="d-flex child-flex"
                :cols="colsPerImg"
            >
              <IdeaImage :key="`img-dialog-${i}`" :index="i" :editMode="editMode" :mode="mode" @imageUpdated="$emit('imagesUpdated')" @ideaImgCopied="$emit('ideaImgCopied')"></IdeaImage>
            </v-col>
          </v-row>
        </v-card-text>
      </v-card>
    </v-col>
  </v-row>
</template>

<script>
import store from '../../../vuex/insideemu_store'
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
    },
    colsPerImg: {
      type: Number,
      default: 4
    }
  },
  emits: ['imagesUpdated', 'ideaImgCopied'],
  components: {
    IdeaImgUploader,
    insideemu_store: store,
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
