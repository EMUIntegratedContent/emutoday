<template>
  <v-card>
    <v-toolbar density="compact" color="grey-darken-1" :title="imgTypeName"></v-toolbar>
    <v-card-text>
      <pre>{{ JSON.stringify(img, null, 2) }}</pre>
      <template v-if="img.image_path">
        <v-img :src="img.image_path" height="75" width="100" cover></v-img>
        <a :href="img.image_path" target="_blank">View Image</a>
      </template>
      <v-file-input
          v-model="fileInputImg"
          accept="image/*"
          label="Attach an image"
          persistent-hint
          hint="Image size must be 2MB or less"
          show-size
          @update:modelValue="handleAddImage"
      ></v-file-input>
      <v-text-field
          v-model="img.image_name"
          density="compact"
          :rules="[v => !!v || 'File name is required']"
      >
        <template #label>
          File Name <span class="text-error">*</span>
        </template>
      </v-text-field>
      <v-text-field
        v-model="img.title"
        density="compact"
        :rules="[v => !!v || 'Title is required']"
      >
        <template #label>
          Title <span class="text-error">*</span>
        </template>
      </v-text-field>
      <v-text-field
          v-model="img.caption"
          density="compact"
          label="Caption"
      >
      </v-text-field>
      <v-textarea
          v-model="img.teaser"
          density="compact"
          label="Teaser"
          rows="3"
      >
      </v-textarea>
      <v-text-field
          v-model="img.moretext"
          density="compact"
          label="More Text Link"
          persistent-hint
          hint="Text used to link to full post"
      >
      </v-text-field>
    </v-card-text>
  </v-card>
</template>

<script>
import store from '../../../vuex/intcomm_store'
import { mapActions, mapGetters, mapMutations, mapState } from "vuex"
import { slashdatetime } from '../../filters'

export default {
  mixins: [],
  props: {
    imgtype_id: {
      type: Number,
      required: true
    }
  },
  components: {
    intcomm_store: store
  },
  async created () {

  },
  data: function () {
    return {
      fileInputImg: null,
      imgUrl: null
    }
  },
  computed: {
    ...mapState(['postImageTypes', 'post']),
    ...mapGetters(['intcommSmallImgID', 'intcommStoryImgID', 'intcommEmailImgID']),
    imgTypeName() {
      if(this.imgtype_id === this.intcommStoryImgID) {
        return 'Story Image'
      } else if(this.imgtype_id === this.intcommSmallImgID) {
        return 'Small Image'
      } else if(this.imgtype_id === this.intcommEmailImgID) {
        return 'Email Image'
      }
      return 'Image'
    },
    img() {
      return this.post.images.find(img => img.imagetype_id === this.imgtype_id)
    }
  },
  methods: {
    slashdatetime,
    ...mapMutations(['setPostImageTypes', 'setPost', 'setPostProp']),
    ...mapActions(['createPostImageRecord', 'updatePostImageRecord']),
    handleAddImage (file) {
      // Check that file size is > 2 MB and at least 412px by 248px
      if (file.size > 2000000) {
        alert(`The file ${file.name} is too large. Please upload a file that is less than 2 MB. Skipping this file.`)
        return
      }

      // Create a Javascript Image object to check the image dimensions
      const imageUrl = URL.createObjectURL(file);
      const img = new Image();
      img.src = imageUrl;
      img.onload = () => { // Wait for the image to load before checking the dimensions
        if (img.width < 412 || img.height < 248) {
          alert(`The file ${file.name} is too small (${img.width}px by ${img.height}px). Please upload a file that is at least 412px by 248px.`)
        } else {
          // Send only the props to the store that need to be changed in response to the image upload
          const propsToUpdate = {
            image_path: imageUrl, // Use the generated URL as the image path
            image_name: file.name,
            image_extension: file.type.split('/')[1],
            file: file // This will be used and removed when the idea is sent to the server
          }
          this.updatePostImageRecord({ imagetype_id: this.img.imagetype_id, props: propsToUpdate })
        }
      }

      this.fileInputImg = null
      this.$emit('imageUploaded')
    }
  }
}
</script>
<style scoped>

</style>
