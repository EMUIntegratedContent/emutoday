<template>
  <v-card class="my-2">
    <v-toolbar density="compact" :color="toolbarColor" :title="imgTypeName"></v-toolbar>
    <v-card-text>
      <!--      <pre>{{ JSON.stringify(img, null, 2) }}</pre>-->
      <v-row>
        <v-col cols="12" md="6">
          <p>
            <span v-if="imgType === 'small'">Recommended image size is <mark>412px x 248px</mark></span>
            <span v-if="imgType === 'story'">Recommended image size is <mark>960px x 500px</mark></span>
            <span v-if="imgType === 'email'">Recommended image size is <mark>600px x 282px</mark></span>
          </p>
          <v-file-input
              v-model="fileInputImg"
              accept="image/*"
              label="Attach an image"
              persistent-hint
              hint="Image size must be 2MB or less"
              show-size
              @update:modelValue="handleAddImage"
          ></v-file-input>
        </v-col>
        <v-col cols="12" md="6">
          <template v-if="img.image_path">
            <v-img :src="img.image_path" height="75" width="100" cover></v-img>
            <a :href="img.image_path" target="_blank">View Image</a>
          </template>
        </v-col>
        <v-col cols="12">
          <v-text-field
              v-if="fileInputImg || img.id"
              v-model="img.image_name"
              density="compact"
              :rules="[v => !!v || 'File name is required']"
              @update:modelValue="$emit('imageUpdated')"
          >
            <template #label>
              File Name <span class="text-error">*</span>
            </template>
          </v-text-field>
        </v-col>
        <v-col cols="12">
          <v-text-field
              v-model="img.alt_text"
              density="compact"
              :rules="[v => !!v || 'Alt text is required']"
              @update:modelValue="$emit('imageUpdated')"
          >
            <template #label>
              Alt Text <span class="text-error">*</span>
            </template>
          </v-text-field>
        </v-col>
        <v-col
            v-if="imgType !== 'small'"
            cols="12"
        >
          <v-text-field
              v-model="img.caption"
              density="compact"
              label="Caption"
              @update:modelValue="$emit('imageUpdated')"
          >
          </v-text-field>
        </v-col>
        <template v-if="imgType === 'small' || imgType === 'email'">
          <v-col cols="12">
            <v-text-field
                v-model="img.moretext"
                density="compact"
                label="More Text link"
                :persistent-hint="imgType === 'small'"
                :hint="imgType === 'small' ? 'Controls the link text that is displayed in the \'More Inside EMU\' area. Default text is \'Read More\'.' : ''"
                @update:modelValue="$emit('imageUpdated')"
            >
            </v-text-field>
          </v-col>
        </template>
        <template v-if="imgType === 'email'">
          <v-col cols="12">
            <v-text-field
                v-model="img.title"
                density="compact"
                :rules="[v => !!v || 'Title is required']"
                @update:modelValue="$emit('imageUpdated')"
            >
              <template #label>
                Title/Header <span class="text-error">*</span>
              </template>
            </v-text-field>
          </v-col>
          <v-col cols="12">
            <v-textarea
                v-model="img.teaser"
                density="compact"
                label="Teaser"
                rows="3"
                @update:modelValue="$emit('imageUpdated')"
            >
            </v-textarea>
          </v-col>
          <v-col cols="12">
            <v-text-field
                v-model="img.link"
                density="compact"
                label="Teaser"
                :rules="[v => !!v || 'External URL is required']"
                @update:modelValue="$emit('imageUpdated')"
            >
              <template #label>
                External URL <span class="text-error">*</span>
              </template>
            </v-text-field>
          </v-col>
          <v-col cols="12">
            <v-text-field
                v-model="img.link_text"
                density="compact"
                :rules="[v => !!v || 'External URL text is required']"
                @update:modelValue="$emit('imageUpdated')"
            >
              <template #label>
                External URL Text <span class="text-error">*</span>
              </template>
            </v-text-field>
          </v-col>
        </template>
      </v-row>
    </v-card-text>
    <v-card-actions>
      <v-btn color="error" size="small" variant="outlined" @click="removeImage">Remove Image</v-btn>
    </v-card-actions>
  </v-card>
</template>

<script>
import store from '../../../vuex/insideemu_store'
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
    insideemu_store: store
  },
  emits: ['imageUpdated'],
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
    ...mapGetters(['insideemuSmallImgID', 'insideemuStoryImgID', 'insideemuEmailImgID']),
    imgType () {
      if (this.imgtype_id === this.insideemuStoryImgID) {
        return 'story'
      }
      else if (this.imgtype_id === this.insideemuSmallImgID) {
        return 'small'
      }
      else if (this.imgtype_id === this.insideemuEmailImgID) {
        return 'email'
      }
      return null
    },
    imgTypeName () {
      if (this.imgType === 'story') {
        return 'Story Image'
      }
      else if (this.imgType === 'small') {
        return 'Small Image (required)'
      }
      else if (this.imgType === 'email') {
        return 'Email Image'
      }
      return 'Image'
    },
    img () {
      return this.post.images.find(img => img.imagetype_id === this.imgtype_id)
    },
    toolbarColor () {
      if (this.imgType === 'story') {
        return 'primary'
      }
      else if (this.imgType === 'small') {
        return 'error'
      }
      else if (this.imgType === 'email') {
        return 'primary'
      }
      return 'grey darken-1'
    }
  },
  methods: {
    slashdatetime,
    ...mapMutations(['setPostImageTypes', 'setPost', 'setPostProp', 'removePostImgById']),
    ...mapActions(['createPostImageRecord', 'updatePostImageRecord']),
    handleAddImage (file) {
      const smallMinW = 412
      const smallMinH = 248
      const storyMinW = 50
      const storyMinH = 100
      const emailMinW = 225
      const emailMinH = 225

      let minW = 0
      let minH = 0
      if(this.imgType === 'small') {
        minW = smallMinW
        minH = smallMinH
      } else if (this.imgType === 'story') {
        minW = storyMinW
        minH = storyMinH
      } else if (this.imgType === 'email') {
        minW = emailMinW
        minH = emailMinH
      } else {
        alert("Invalid image type. Quitting.")
        return
      }

      // Check that file size is > 2 MB and at least 412px by 248px
      if (file.size > 2000000) {
        alert(`The file ${file.name} is too large. Please upload a file that is less than 2 MB. Skipping this file.`)
        this.fileInputImg = null
        return
      }

      // Create a Javascript Image object to check the image dimensions
      const imageUrl = URL.createObjectURL(file);
      const img = new Image();
      img.src = imageUrl;
      img.onload = () => { // Wait for the image to load before checking the dimensions
        if (img.width < minW || img.height < minH) {
          alert(`The file ${file.name} is too small (${img.width}px by ${img.height}px). Please upload a file that is at least ${minW}px by ${minH}px.`)
          this.fileInputImg = null
        }
        else {
          // Send only the props to the store that need to be changed in response to the image upload
          let image_extension = file.type.split('/')[1]
          if(image_extension === 'jpeg') {
            image_extension = 'jpg' // Change 'jpeg' to 'jpg' for consistency
          }
          const propsToUpdate = {
            image_path: imageUrl, // Use the generated URL as the image path
            image_name: file.name,
            image_extension: image_extension,
            file: file // This will be used and removed when the idea is sent to the server
          }
          this.updatePostImageRecord({ imagetype_id: this.img.imagetype_id, props: propsToUpdate })
        }
      }
      this.$emit('imageUpdated')
    },
    removeImage () {
      this.removePostImgById(this.img.imagetype_id)
      this.$emit('imageUpdated')
    }
  }
}
</script>
<style scoped>

</style>
