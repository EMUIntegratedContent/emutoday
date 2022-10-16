<template>
  <div>
    <div @mouseover="isMousedOver = true" @mouseout="isMousedOver = false">
      <img class="topic-image" :src="isMousedOver ? '/imgs/swapstory.png' : imageSrc" alt="story image"
           @click="openModal">
      <div class="stories-content">
        {{ story ? story.title : 'No story selected' }}
      </div>
    </div><!-- /end root element -->

    <page-story-swap-modal
        :story-number="storyNumber"
        :stypes="stypes"
        :current-story="story"
        @story-swapped="handleStorySwapped"
        @component-data-loaded="handleComponentLoaded"
    ></page-story-swap-modal>
  </div>
</template>

<style scoped>
.topic-image {
  width: 100%;
  max-height: 411px;
}
</style>


<script>
import PageStorySwapModal from './PageStorySwapModal.vue'

export default {
  directives: {},
  components: {PageStorySwapModal},
  props: {
    story: {
      type: Object,
      default: null,
    },
    storyNumber: {
      required: true,
      type: String,
    },
    stypes: {
      default: [],
    },
    currentStory: {
      default: null,
    }
  },
  data: function () {
    return {
      isMousedOver: false,
    }
  },
  computed: {
    imageSrc: function () {
      // story has been passed to this component
      if (this.story) {
        // this is a main story
        if (this.storyNumber == 0) {
          // Find the front image
          const frontImage = this.story.images.filter(function (image) {
            return image.image_type == 'front'
          })
          return frontImage[0].image_path + frontImage[0].filename
        }

        // this is a sub story
        const smallImage = this.story.images.filter(function (image) {
          return image.image_type == 'small'
        })
        return smallImage[0].image_path + smallImage[0].filename
      }
      // no story set for this component
      return '/imgs/notselected.png'
    }
  },

  methods: {
    handleComponentLoaded(evt) {
      this.$emit('modal-data-loaded', evt)
    },
    handleStorySwapped(evt) {
      this.$emit('sub-story-swapped', evt)
    },
    openModal: function () {
      $('#pageStorySwapModal-' + this.storyNumber).modal('show');
    }
  }
};

</script>
