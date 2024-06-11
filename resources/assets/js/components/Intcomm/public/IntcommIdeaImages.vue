<template>
  <v-row>
    <v-col cols="12">
      <p>ASSOCIATED IMAGES (IDEA)</p>
      {{ idea ? idea : null}}
      <v-file-input
          v-model="ideaImgsForUpload"
          accept="image/*"
          label="Attach an image"
          multiple
          @update:modelValue="handleAddImages"
      ></v-file-input>
    </v-col>
  </v-row>
  <v-row>
    <v-col
        v-for="(image, i) in idea.images"
        :key="`img-${image.id}`"
        class="d-flex child-flex bg-danger"
        cols="4"
    >
<!--      <v-img-->
<!--          :lazy-src="`https://picsum.photos/10/6?image=15`"-->
<!--          :src="makeImageURL(image)"-->
<!--          aspect-ratio="1"-->
<!--          class="bg-grey-lighten-2"-->
<!--          cover-->
<!--          max-height="200"-->
<!--          max-width="200"-->
<!--      >-->
<!--        <template v-slot:placeholder>-->
<!--          <v-row-->
<!--              align="center"-->
<!--              class="fill-height ma-0"-->
<!--              justify="center"-->
<!--          >-->
<!--            <v-progress-circular-->
<!--                color="grey-lighten-5"-->
<!--                indeterminate-->
<!--            ></v-progress-circular>-->
<!--          </v-row>-->
<!--        </template>-->
<!--      </v-img>-->
      <IdeaImage :key="`img-dialog-${i}`" :index="i" @imageUpdated="$emit('imagesUpdated')"></IdeaImage>
    </v-col>
  </v-row>
</template>

<script>
import store from '../../../vuex/intcomm_store'
import moment from 'moment'
import flatpickr from 'vue-flatpickr-component'
import 'flatpickr/dist/flatpickr.css'
import IdeaImage from './IdeaImage.vue'
import { mapMutations, mapState } from "vuex"

export default {
  mixins: [],
  props: {
    mode: {
      type: String,
      default: 'public'
    }
  },
  components: {
    intcomm_store: store,
    IdeaImage
  },
  created () {

  },
  data: function () {
    return {
      fileInputImgs: [] // only for the input. The actual images are put into the store to be saved with the idea.
    }
  },
  computed: {
    ...mapState(['idea', 'ideaImgsForUpload']),
  },
  methods: {
    ...mapMutations(['setIdea', 'setIdeaImagsForUpload']),
    // When a new image is uploaded, add it to the idea's images array. This will be saved when the idea is saved.
    // A temporary ID is generated for the image, and the image path is set to the generated URL, which is a temporary URL.
    handleAddImages (files) {
      for (let i = 0; i < files.length; i++) {
        let file = files[i];
        let imageUrl = URL.createObjectURL(file);
        this.idea.images.push({
          id: `new-${Date.now()}`, // Generate a temporary ID
          image_path: imageUrl, // Use the generated URL as the image path
          image_name: file.name,
          image_extension: file.type.split('/')[1],
          intcomm_idea_id: this.idea.id ?? null,
          description: null,
          // file: file
        });
      }
      this.fileInputImgs = []
      this.$emit('imagesUpdated')
    },
    makeImageURL (image) {
      if(image.id.includes('new-')) return image.image_path // If the image is new, use the generated, temporary URL
      return `${image.image_path}/${image.image_name}.${image.image_extension}`
    }
  }
}
</script>
<style scoped>

</style>
