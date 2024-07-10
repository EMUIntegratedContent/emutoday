<template>
  <td>
    <template v-if="post.seq === 0">
      <v-btn
          color="purple"
          size="x-small"
          :loading="savingRanking"
          @click="updateSeq"
      >
        Add Ranking
      </v-btn>
      <p v-if="showSuccess" class="text-success">Rankings updated</p>
      <p v-if="errSaving" class="text-error">Error updaing ranking</p>
    </template>
    <template v-else>
      {{ post.seq }}
    </template>
  </td>
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
  emits: ['rankAdded'],
  created () {
  },
  data: function () {
    return {
      errSaving: false,
      savingRanking: false,
      showSuccess: false
    }
  },
  computed: {
    ...mapState([]),
  },
  methods: {
    slashdatetime,
    ...mapMutations([]),
    async updateSeq() {
      this.savingRanking = true
      const routeurl = `/api/intcomm/admin/posts/addrank/${this.post.postId}`

      this.errSaving = false
      await this.$http.patch(routeurl)
      .then(() => {
        this.savingRanking = false
        this.showSuccess = true
        this.$emit('rankAdded')
      })
      .catch(() => {
        this.savingRanking = false
        this.errSaving = true
      })
    }
  }
}
</script>
<style lang="scss" scoped>

</style>
