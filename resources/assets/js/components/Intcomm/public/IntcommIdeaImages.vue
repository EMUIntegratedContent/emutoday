<template>
  <v-row>
    <v-col cols="12">
      <p>ASSOCIATED IMAGES (IDEA)</p>
      {{ idea ? idea : null}}
      <v-file-input
          v-model="imgsForUpload"
          accept="image/*"
          label="File input"
          multiple
          @update:modelValue="handleFileUpload"
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
      <IdeaImageDialog :key="`img-dialog-${i}`" :index="i"></IdeaImageDialog>
    </v-col>
  </v-row>
</template>

<script>
import store from '../../../vuex/intcomm_store'
import moment from 'moment'
import flatpickr from 'vue-flatpickr-component'
import 'flatpickr/dist/flatpickr.css'
import IdeaImageDialog from './dialogs/IdeaImageIdalog.vue'
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
    IdeaImageDialog
  },
  created () {

  },
  data: function () {
    return {
      imgsForUpload: []
    }
  },
  computed: {
    ...mapState(['post']),
  },
  methods: {
    ...mapMutations(['setPost']),
    // When a new image is uploaded, add it to the post's images array. This will be saved when the post is saved.
    // A temporary ID is generated for the image, and the image path is set to the generated URL, which is a temporary URL.
    handleFileUpload (files) {
      for (let i = 0; i < files.length; i++) {
        let file = files[i];
        let imageUrl = URL.createObjectURL(file);
        this.idea.images.push({
          id: `new-${Date.now()}`, // Generate a temporary ID
          image_path: imageUrl, // Use the generated URL as the image path
          image_name: file.name,
          image_extension: file.type.split('/')[1],
          intcomm_post_id: this.post.id ?? null,
          title: null,
          caption: null,
          teaser: null,
          alt_text: null,
          moretext: null,
          link: null,
          link_text: null,
          is_active: 0
        });
      }
      this.imgsForUpload = []
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
