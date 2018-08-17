<template>
    <div @mouseover="isMousedOver = true" @mouseout="isMousedOver = false">
        <img class="topic-image" :src="isMousedOver ? '/imgs/swapstory.png' : imageSrc" alt="story image" @click="emitSwapStory">
        <div class="stories-content">
            {{ story ? story.title : 'No story selected' }}
        </div>
    </div><!-- /end root element -->
</template>

<style scoped>
.topic-image{
    width: 100%;
    max-height: 411px;
}
</style>


<script>

module.exports = {
  directives: {},
  components: {},
  props: {
      story:{
          type: Object,
          default: null,
      },
      storyNumber:{
          required: true,
          type: String,
      }
  },
  data: function() {
    return {
        isMousedOver:false,
    }
  },
  created: function () {

  },
  ready: function() {

  },
  computed: {
      imageSrc: function(){
          // story has been passed to this component
          if(this.story){
              // this is a main story
              if(this.storyNumber == 0){
                  return this.story.front_images[0].image_path + this.story.front_images[0].filename
              }

              // this is a sub story
              return this.story.small_images[0].image_path + this.story.small_images[0].filename
          }
          // no story set for this component
          return '/imgs/notselected.png'
      }
  },

  methods: {
      emitSwapStory: function(){
        // Dispatch an event that propagates upward along the parent chain using $dispatch()
        this.$dispatch('story-swap-modal-requested', this.storyNumber)
      },
  },
  watch: {

  },
  filters: {

  },
  events: {

  },
};

</script>
