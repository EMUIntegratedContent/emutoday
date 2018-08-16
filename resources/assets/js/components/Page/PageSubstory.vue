<template>
    <div @mouseover="isMousedOver = true" @mouseout="isMousedOver = false">
        <img class="topic-image" :src="isMousedOver ? '/imgs/swapstory.png' : imageSrc" alt="story image" @click="emitSwapStory">
        <div class="stories-content">
            {{ title }}
        </div>
    </div><!-- /end root element -->
</template>

<style scoped>
.topic-image{
    width: 100%;
}
</style>


<script>

module.exports = {
  directives: {},
  components: {},
  props: {
      imageSrc:{
          required: false,
          type: String,
          default: '/imgs/notselected.png',
      },
      title:{
          required: false,
          type: String,
          default: 'No story selected',
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

  },

  methods: {
      emitSwapStory: function(){
        // Dispatch an event that propagates upward along the parent chain using $dispatch()
        this.$dispatch('story-swap-requested', this.storyNumber)
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
