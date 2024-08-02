<template>
  <v-dialog max-width="500" persistent>
    <template v-slot:activator="{ props: activatorProps }">
      <v-btn
          v-bind="activatorProps"
          color="purple-darken-3"
      >Manage Rankings</v-btn>
    </template>

    <template #default="{ isActive }">
      <v-card>
        <v-toolbar color="primary" density="compact" title="Manage Post Rankings">
          <v-spacer></v-spacer>
          <v-btn
              icon="mdi-close"
              @click="isActive.value = false"
          ></v-btn>
        </v-toolbar>
        <v-card-text>
          <p>To rearrange the order of posts, drag the pod to the desired location. To un-rank a post, click the red
            'minus' icon on the pod. Click "save order" button when done.</p>
          <Sortable
              :list="rankedPosts"
              item-key="postId"
              tag="div"
              :options="options"
              @update="updateOrder"
          >
            <template #item="{element, i}">
              <PostPod
                  :post="element"
                  @removeRank="handleRankRemoved"
              >
              </PostPod>
            </template>
          </Sortable>
        </v-card-text>
        <v-card-actions v-if="rankedPostsChanged">
          <span v-if="rankSaved" class="text-success">Rankings updated</span>
          <span v-if="rankError" class="text-error">Error updating rankings</span>
          <v-spacer></v-spacer>
          <v-btn @click="updateRankOrder" color="success" variant="elevated" :loading="savingRankings">Save Rankings</v-btn>
          <v-btn @click="resetRankOrder" color="grey-darken-3" variant="outlined">Reset</v-btn>
        </v-card-actions>
      </v-card>
    </template>
  </v-dialog>
</template>

<script>
import store from '../../../../vuex/insideemu_store'
import { Sortable } from "sortablejs-vue3"
import { mapMutations, mapState } from "vuex"
import PostPod from '../PostPod.vue'

export default {
  mixins: [],
  props: {

  },
  components: {
    PostPod,
    Sortable,
    insideemu_store: store
  },
  created () {
    setTimeout(() => {
      this.setRankedPosts()
    }, 1000)
  },
  data () {
    return {
      imgsForUpload: [],
      isHovered: false,
      options: {},
      rankedPosts: [],
      rankedPostsChanged: false,
      rankSaved: false,
      rankError: false,
      savingRankings: false
    }
  },
  computed: {
    ...mapState(['posts'])
  },
  methods: {
    ...mapMutations([]),

    setRankedPosts () {
      const rankedPosts = JSON.parse(JSON.stringify(this.posts.filter(post => post.seq > 0)))
      // order ranked posts by seq
      this.rankedPosts = rankedPosts.sort((a, b) => a.seq - b.seq)
    },

    // Save the order of the ranked posts to the database
    updateRankOrder: function () {
      this.rankSaved = false
      this.rankError = false
      this.savingRankings = true

      // Loop through each of the rankedPosts and extract the postId.
      // This is the order that we want to save the posts in.
      const rankedPostIds = this.rankedPosts.map(post => post.postId)

      const formData = new FormData()
      formData.append('postIds', JSON.stringify(rankedPostIds))

      const routeurl = `/api/insideemu/admin/posts/updateranks`
      this.$http.post(routeurl, formData)
      .then(() => {
        this.savingRankings = false
        this.rankSaved = true
        setTimeout(() => {
          this.$emit('rankUpdated')
          this.rankSaved = false
          this.rankedPostsChanged = false
        }, 2000)
      }).catch((e) => {
        this.rankError = true
      })
    },

    resetRankOrder: function () {
      this.setRankedPosts()
      this.rankedPostsChanged = false
    },

    // Update the order of the ranked posts when a pod is dragged (uses sortablejs)
    updateOrder: function (eventItem) {
      // Save the original order the first time this method is called
      if (!this.rankedPostsChanged) {
        this.rankedPostsChanged = true
      }

      let oldIndex = eventItem.oldIndex
      let newIndex = eventItem.newIndex

      // move the item in the underlying array
      this.rankedPosts.splice(newIndex, 0, this.rankedPosts.splice(oldIndex, 1)[0])
    },

    handleRankRemoved (postObj) {
      for (let i = 0; i < this.rankedPosts.length; i++) {
        if (postObj.postId === this.rankedPosts[i].postId) {
          this.rankedPosts.splice(i, 1)
          this.rankedPostsChanged = true
        }
      }
    }
  },
  watch: {
    posts: function () {
      this.setRankedPosts()
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
