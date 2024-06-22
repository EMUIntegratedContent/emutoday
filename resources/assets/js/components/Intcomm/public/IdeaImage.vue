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
        hide-details
        :readonly="!editMode"
        :rules="[v => (!v || v.length < 256) || 'Must be 255 characters or less']"
        @update:modelValue="$emit('imageUpdated')"
      ></v-textarea>
    </v-card-text>

    <v-card-actions v-if="editMode && mode === 'idea'">
      <v-btn color="error" text="Remove" size="small" variant="outlined" @click="removeImage"></v-btn>
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
      default: 'idea' // 'post' or 'idea'
    },
    editMode: {
      type: Boolean,
      default: false
    },
    index: {
      type: Number,
      required: true
    }
  },
  emits: ['imageUpdated'],
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
    ...mapState(['idea', 'post']),
    // Based on mode, get the image from the appropriate object
    image () {
      if(this.mode === 'post') {
        return this.post.associated_idea.images[this.index]
      }

      return this.idea.images[this.index]
    },
    imageUrl () {
      return this.image.image_path
    }
  },
  methods: {
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
