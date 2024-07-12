<template>
  <v-card class="post-rank-card mb-3">
    <v-toolbar color="grey-darken-2" :title="postCopy.title">
      <v-spacer></v-spacer>
      <v-btn icon="mdi-minus" size="x-small" variant="elevated" color="error" @click="removeRank"></v-btn>
    </v-toolbar>
    <v-card-text>
      {{ postCopy.title }}
    </v-card-text>
    <v-card-actions>
      TODO - preview, edit, buttons here
      <v-btn @click="previewItem" color="warning" size="x-small" icon="mdi-eye"></v-btn>
    </v-card-actions>

<!--                <button v-on:click.prevent="editItem" class="btn bg-orange btn-xs footer-btn" data-toggle="tooltip"-->
<!--                        data-placement="top" title="edit"><i class="fa fa-pencil"></i></button>-->
<!--                <button v-on:click.prevent="previewItem" class="btn bg-orange btn-xs footer-btn"-->
<!--                        :disabled="disabledPreview" data-toggle="tooltip" title="preview"><i class="fa fa-eye"></i>-->
<!--                </button>-->
<!--                <button v-on:click.prevent="archiveItem" class="btn bg-orange btn-xs footer-btn" data-toggle="tooltip"-->
<!--                        data-placement="bottom" title="archive"><i class="fa fa-archive"></i></button>-->
  </v-card>
</template>
<style scoped>

</style>
<script>

import moment from 'moment'

export default {
  components: { },
  props: {
    post: {
      type: Object,
      required: true
    }
  },
  data: function () {
    return {
      postCopy: null
    }
  },
  created () {
    this.postCopy = JSON.parse(JSON.stringify(this.post))
  },
  computed: {
    postPreviewPath: function () {
      return `/admin/preview/intcomm/post/${this.post.postId}`
    },
  },
  methods: {
    previewItem: function () {
      window.location.href = this.postPreviewPath;
    },
    removeRank () {
      this.$emit('removeRank', this.post)
    }
    //
    // emitStoryElevate (storyObj) {
    //   this.$emit('story-elevated', storyObj)
    // },
    // emitStoryDemote (storyObj) {
    //   this.$emit('story-demoted', storyObj.id)
    // },
    // toggleEmitStoryElevate () {
    //   if (this.checked === false) {
    //     this.emitStoryElevate(this.item)
    //   }
    //   else {
    //     this.emitStoryDemote(this.item)
    //   }
    // },
    // momentFull (val) {
    //   return val ? moment(val).format('ddd MMM gg, YYYY @ h:mm a') : ''
    // }
  }
}
</script>

<style lang="scss" scoped>

</style>
