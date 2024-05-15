<template>
  <v-row>
    <v-col cols="12">
      <p>ASSOCIATED IMAGES</p>
      {{ post ? post.images : null}}
    </v-col>
    <v-col
        v-for="image in post.images"
        :key="`img-${image.id}`"
        class="d-flex child-flex bg-danger"
        cols="4"

    >
      <v-img
          :lazy-src="`https://picsum.photos/10/6?image=15`"
          :src="`${image.image_path}/${image.image_name}.${image.image_extension}`"
          aspect-ratio="1"
          class="bg-grey-lighten-2"
          cover
          max-height="200"
          max-width="200"
      >
        <template v-slot:placeholder>
          <v-row
              align="center"
              class="fill-height ma-0"
              justify="center"
          >
            <v-progress-circular
                color="grey-lighten-5"
                indeterminate
            ></v-progress-circular>
          </v-row>
        </template>
      </v-img>
    </v-col>
  </v-row>
</template>

<script>
import store from '../../vuex/intcomm_store'
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
    }
  },
  components: {
    intcomm_store: store
  },
  created () {

  },
  data: function () {
    return {

    }
  },
  computed: {
    ...mapState(['post']),
  },
  methods: {
    ...mapMutations(['setPost']),
  }
}
</script>
<style scoped>

</style>
