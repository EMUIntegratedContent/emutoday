<template>
<!--  <v-dialog max-width="500">-->
<!--    <template v-slot:activator="{ props: activatorProps }">-->
<!--      <v-btn-->
<!--          v-bind="activatorProps"-->
<!--          icon="mdi-pencil"-->
<!--          variant="flat"-->
<!--          color="success"-->
<!--      ></v-btn>-->
<!--    </template>-->

<!--    <template #default="{ isActive }">-->
<!--      <v-card title="Dialog">-->
<!--        <v-card-text>-->
<!--          {{ image }}-->
<!--          <v-img-->
<!--              :lazy-src="`https://picsum.photos/10/6?image=15`"-->
<!--              :src="makeImageURL"-->
<!--              aspect-ratio="1"-->
<!--              class="bg-grey-lighten-2"-->
<!--              cover-->
<!--              max-height="200"-->
<!--              max-width="200"-->
<!--              :class="{ 'img-hover': isHovered }"-->
<!--              @mouseover="isHovered = true"-->
<!--              @mouseout="isHovered = false"-->
<!--          >-->
<!--            <template v-slot:placeholder>-->
<!--              <v-row-->
<!--                  align="center"-->
<!--                  class="fill-height ma-0"-->
<!--                  justify="center"-->
<!--              >-->
<!--                <v-progress-circular-->
<!--                    color="grey-lighten-5"-->
<!--                    indeterminate-->
<!--                ></v-progress-circular>-->
<!--              </v-row>-->
<!--            </template>-->
<!--          </v-img>-->
<!--        </v-card-text>-->

<!--        <v-card-actions>-->
<!--          <v-spacer></v-spacer>-->

<!--          <v-btn-->
<!--              text="Close Dialog"-->
<!--              @click="isActive.value = false"-->
<!--          ></v-btn>-->
<!--        </v-card-actions>-->
<!--      </v-card>-->
<!--    </template>-->
<!--  </v-dialog>-->
  <v-card
      class="mx-auto"
      max-width="400"
  >
    <v-img
        class="align-end text-white"
        height="200"
        :src="imageUrl"
        cover
    >
      <v-card-title>Top 10 Australian beaches</v-card-title>
    </v-img>

    <v-card-subtitle class="pt-4">
      Number 10
    </v-card-subtitle>

    <v-card-text>
      <v-text-field
        v-model="image.title"
      ></v-text-field>
    </v-card-text>

    <v-card-actions>
      <v-btn color="orange" text="Share"></v-btn>

      <v-btn color="orange" text="Explore"></v-btn>
    </v-card-actions>
  </v-card>
</template>

<script>
import store from '../../../../vuex/intcomm_store'
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
    ...mapState(['post']),
    image () {
      return this.post.images[this.index]
    },
    imageUrl () {
      if(this.image.id.includes('new-')) return this.image.image_path // If the image is new, use the generated, temporary URL
      return `${this.image.image_path}/${this.image.image_name}.${this.image.image_extension}`
    }
  },
  methods: {
    ...mapMutations(['setPost']),
  }
}
</script>
<style scoped>
.img-hover {
  filter: grayscale(100%);
  position: relative;
}
</style>
