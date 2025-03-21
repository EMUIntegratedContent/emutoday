<template>
  <div>
    <p>
      Please include any images that should be considered along with this submission.<br>
      <span class="font-weight-bold">The minimum accepted resolution for images is 412px by 248 px.<br>Image size may not exceed 2 MB.</span>
    </p>
    <v-file-input
        v-model="fileInputImgs"
        accept="image/*"
        label="Attach an image"
        multiple
        counter
        show-size
        @update:modelValue="handleAddImages"
    ></v-file-input>
  </div>
</template>
<script>
import store from '../../../vuex/insideemu_store'
import 'flatpickr/dist/flatpickr.css'
import IdeaImage from './IdeaImage.vue'
import { mapMutations, mapState } from "vuex"

export default {
  mixins: [],
  props: {

  },
  emits: ['imageUploaded'],
  components: {
    insideemu_store: store,
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
    ...mapState(['idea']),
  },
  methods: {
    // When a new image is uploaded, add it to the idea's images array. This will be saved when the idea is saved.
    // A temporary ID is generated for the image, and the image path is set to a generated, temporary URL.
    handleAddImages (files) {
      if(!files) return
      for (let i = 0; i < files.length; i++) {
        let file = files[i];

        // Check that file size is > 2 MB and at least 412px by 248px
        if (file.size > 2000000) {
          alert(`The file ${file.name} is too large. Please upload a file that is less than 2 MB. Skipping this file.`)
          continue
        }

        // Create a Javascript Image object to check the image dimensions
        const imageUrl = URL.createObjectURL(file);
        const img = new Image();
        img.src = imageUrl;
        img.onload = () => { // Wait for the image to load before checking the dimensions
          if (img.width < 412 || img.height < 248) {
            alert(`The file ${file.name} is too small (${img.width}px by ${img.height}px). Please upload a file that is at least 412px by 248px. Skipping this file.`)
          } else {
            this.idea.images.push({
              id: `new-${Date.now()}`, // Generate a temporary ID
              image_path: imageUrl, // Use the generated URL as the image path
              image_name: file.name,
              image_extension: file.type.split('/')[1],
              insideemu_idea_id: this.idea.id ?? null,
              description: null,
              file: file // This will be used and removed when the idea is sent to the server
            });
          }
        }
      }
      this.fileInputImgs = []
      this.$emit('imageUploaded')
    }
  }
}
</script>
<style scoped>

</style>
