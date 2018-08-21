<template>
    <div @mouseover="isMousedOver = true" @mouseout="isMousedOver = false">
        <img class="topic-image" :src="isMousedOver ? '/imgs/swapstory.png' : imageSrc" alt="story image" @click="openModal">
        <div class="stories-content">
            {{ story ? story.title : 'No story selected' }}
        </div>
    </div><!-- /end root element -->

    <page-story-swap-modal
        :story-number="storyNumber"
        :stypes="stypes"
        :current-story="story"
    ></page-story-swap-modal>
</template>

<style scoped>
.topic-image{
    width: 100%;
    max-height: 411px;
}
</style>


<script>
import PageStorySwapModal from './PageStorySwapModal.vue'
module.exports = {
  directives: {},
  components: {PageStorySwapModal},
  props: {
      story:{
          type: Object,
          default: null,
      },
      storyNumber:{
          required: true,
          type: String,
      },
      stypes: {
          default: [],
      },
      currentStory:{
          default: null,
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
                  // Find the front image
                  var frontImage = this.story.images.filter(function(image){
                      return image.image_type == 'front'
                  })
                  return frontImage[0].image_path + frontImage[0].filename
              }

              // this is a sub story
              var smallImage = this.story.images.filter(function(image){
                  return image.image_type == 'small'
              })
              return smallImage[0].image_path + smallImage[0].filename
          }
          // no story set for this component
          return '/imgs/notselected.png'
      }
  },

  methods: {
      openModal: function(){
          console.log(this.storyNumber)
          $('#pageStorySwapModal-' + this.storyNumber).modal('show');
      }
  },
  watch: {

  },
  filters: {

  },
  events: {
      'component-data-loaded': function(){
          this.$dispatch('modal-data-loaded')
      },
  },
};

</script>
