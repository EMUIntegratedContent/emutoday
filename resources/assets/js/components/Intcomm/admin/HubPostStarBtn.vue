<template>
  <v-btn
      :color="post.is_hub_post ? 'yellow-darken-3' : 'grey-darken-3'"
      icon
      variant="text"
      :loading="saving"
      :disabled="!post.is_live"
      @click="makeHubPost"
  >
    <v-icon>{{ post.is_hub_post ? 'mdi-star' : 'mdi-star-outline' }}</v-icon>
  </v-btn>
  <p v-if="errSaving" class="text-error">Error!</p>
</template>

<script>
import { slashdatetime } from '../../filters'
import { mapMutations, mapState } from "vuex"

export default {
  props: {
    post: {
      type: Object,
      required: true
    }
  },
  mixins: [],
  components: {
  },
  emits: ['madeHubPost'],
  created () {
  },
  data: function () {
    return {
      errSaving: false,
      saving: false,
      showSuccess: false
    }
  },
  computed: {
    ...mapState([]),
  },
  methods: {
    slashdatetime,
    ...mapMutations([]),
    async makeHubPost() {
      this.saving = true
      const routeurl = `/api/intcomm/admin/posts/makehubpost/${this.post.postId}`

      this.errSaving = false
      await this.$http.patch(routeurl)
      .then(() => {
        this.saving = false
        this.showSuccess = true
        this.$emit('madeHubPost')
      })
      .catch(() => {
        this.saving = false
        this.errSaving = true
      })
    }
  }
}
</script>
<style lang="scss" scoped>

</style>
