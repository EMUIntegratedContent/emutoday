<template>
  <v-card
      class="mx-auto"
      width="400"
  >
    <v-img
        class="align-end text-white"
        height="200"
        :src="imageUrl"
        cover
    >
    </v-img>

    <v-card-subtitle class="pt-4">
      <a :href="image.image_path" target="_blank">{{ image.image_name }}</a>
    </v-card-subtitle>

    <v-card-text>
      <v-textarea
        v-model="image.description"
        label="Description"
        density="compact"
        variant="outlined"
        row="3"
        :rules="[v => (!v || v.length < 256) || 'Must be 255 characters or less']"
        @update:modelValue="$emit('imageUpdated')"
      ></v-textarea>
    </v-card-text>

    <v-card-actions>
      <v-btn color="error" text="Remove" @click="removeImage"></v-btn>
    </v-card-actions>
  </v-card>
</template>

<script>
import store from '../../../vuex/intcomm_store'
import moment from 'moment'
import flatpickr from 'vue-flatpickr-component'
import 'flatpickr/dist/flatpickr.css'
import { mapMutations, mapState } from "vuex"

export default {
  mixins: [],
  props: {
    mode: {
      type: String,
      default: 'public'
    },
    index: {
      type: Number,
      required: true
    }
  },
  components: {
    intcomm_store: store
  },
  created () {

  },
  data: function () {
    return {
      imgsForUpload: [],
      isHovered: false
    }
  },
  computed: {
    ...mapState(['idea']),
    image () {
      return this.idea.images[this.index]
    },
    imageUrl () {
      if(this.image.id.includes('new-')) return this.image.image_path // If the image is new, use the generated, temporary URL
      return `${this.image.image_path}/${this.image.image_name}.${this.image.image_extension}`
    }
  },
  methods: {
    ...mapMutations(['setIdea']),
    removeImage () {
      this.idea.images.splice(this.index, 1)
      this.$emit('imageUpdated')
    }
  }
}
</script>
<style scoped>
.img-hover {
  filter: grayscale(100%);
  position: relative;
}
</style>
