<template>
  <div class="panel panel-default">
    <div class="panel-heading">
      <h3 class="panel-title">{{ storyIdeaType }}</h3>
    </div>
    <div class="panel-body">
      <ul class="ideapanel-nav-tabs nav nav-tabs">
        <li role="presentation" class="active"><a data-toggle="tab" :href="'#future-' + slugify(storyIdeaType)">Future ({{ paginatedFutureStories ? paginatedFutureStories.length : '0' }})</a></li>
        <li role="presentation"><a data-toggle="tab" :href="'#completed-' + slugify(storyIdeaType)">Completed ({{ paginatedCompletedStories ? paginatedCompletedStories.length : '0' }})</a></li>
        <li role="presentation"><a data-toggle="tab" :href="'#past-' + slugify(storyIdeaType)">Past Due ({{ paginatedPastStories ? paginatedPastStories.length : '0' }})</a></li>
      </ul>
      <div class="tab-content">
        <div :id="'future-' + slugify(storyIdeaType)" class="tab-pane active in fade">
          <div class="panel-group">
            <storyideas-pod
              v-for="(index, idea) in paginatedFutureStories"
              :role="role"
              :storyidea="idea"
              :index="index"
              panel-type="future"
              @update-story-idea="updateIdeaStatus"
              @archive-story-idea="archiveIdea"
              >
            </storyidea-pod>
          </div>
        </div>
        <div :id="'completed-' + slugify(storyIdeaType)" class="tab-pane fade">
          <div class="panel-group">
            <storyideas-pod
              v-for="(index, idea) in paginatedCompletedStories"
              :role="role"
              :storyidea="idea"
              :index="index"
              panel-type="completed"
              @update-story-idea="updateIdeaStatus"
              @archive-story-idea="archiveIdea"
              >
            </storyidea-pod>
          </div>
        </div>
        <div :id="'past-' + slugify(storyIdeaType)" class="tab-pane fade">
          <div class="panel-group">
            <storyideas-pod
              v-for="(index, idea) in paginatedPastStories"
              :role="role"
              :storyidea="idea"
              :index="index"
              panel-type="past"
              @update-story-idea="updateIdeaStatus"
              @archive-story-idea="archiveIdea"
              >
            </storyidea-pod>
          </div>
        </div>
      </div>
    </div>
    <div class="panel-footer">
      <ul class="pagination">
        <li :class="{disabled: (currentPage <= 1)}" class="page-item">
          <a href="#" @click.prevent="setPage(currentPage-1)" class="page-link" tabindex="-1">Previous</a>
        </li>
        <li v-for="pageNumber in totalPages" :class="{active: (pageNumber + 1) == currentPage}" class="page-item">
          <a class="page-link" href="#" @click.prevent="setPage(pageNumber + 1)">{{ pageNumber + 1 }} <span v-if="(pageNumber + 1) == currentPage" class="sr-only">(current)</span></a>
        </li>
        <li :class="{disabled: (currentPage == totalPages)}" class="page-item">
          <a class="page-link" @click.prevent="setPage(currentPage+1)" href="#">Next</a>
        </li>
      </ul>
    </div>
  </div>
</template>
<style scoped>
.ideapanel-nav-tabs{
  margin-bottom: 10px !important;
}
.panel-body{
  height:420px;
  overflow-y:scroll;
}
</style>
<script>
import moment from 'moment'
import StoryideasPod from './StoryideasPod.vue'

module.exports = {
  components: {StoryideasPod},
  props: {
    role: {
      type: String,
      required: true,
    },
    storyIdeaType: {
      type: String,
      required: true,
    },
    stories: {
      type: Array,
      required: true,
    },
  },
  data: function() {
    return {
      currentSearch: '',
      formErrors: '',
      // Pagination
      currentPage: 1,
      itemsPerPage: 10,
      itemsPerPageOptions: [
        { text: 1, value: 1 },
        { text: 5, value: 5 },
        { text: 10, value: 10 },
        { text: 25, value: 25 },
        { text: 40, value: 40 },
        { text: 50, value: 50 },
        { text: 75, value: 75 },
        { text: 100, value: 100 },
        { text: 200, value: 200 },
      ],
    }
  },
  created: function () {

  },
  ready: function() {
  },
  computed: {
    totalPages: function() {
      return Math.ceil(this.stories.length / this.itemsPerPage)
    },
    // Use the stories from the 'stories' prop and keep only story ideas marked as completed
    paginatedCompletedStories: function(){
      var startRecord = (this.currentPage -1) * this.itemsPerPage

      let itemArray = []
      for(let i = 0; i < this.itemsPerPage; i++){
        if(typeof this.stories[startRecord + i] != 'undefined' && this.stories[startRecord + i].is_completed == 1 && this.stories[startRecord + i].is_archived == 0) {
          itemArray.push(this.stories[startRecord + i])
        }
      }
      return itemArray
    },
    // Use the stories from the 'stories' prop and keep only story ideas whose deadline is in the future and not completed
    paginatedFutureStories: function(){
      var startRecord = (this.currentPage -1) * this.itemsPerPage

      let itemArray = []
      for(let i = 0; i < this.itemsPerPage; i++){
        if(typeof this.stories[startRecord + i] != 'undefined'){
          var now = Date.parse(new Date())
          var deadline = Date.parse(this.stories[startRecord + i].deadline.date)

          if((now < deadline) && this.stories[startRecord + i].is_completed == 0 && this.stories[startRecord + i].is_archived == 0) {
            itemArray.push(this.stories[startRecord + i])
          }
        }
      }
      return itemArray
    },
    // Use the stories from the 'stories' prop and keep only story ideas whose deadline is in the past and not completed
    paginatedPastStories: function(){
      var startRecord = (this.currentPage -1) * this.itemsPerPage

      let itemArray = []
      for(let i = 0; i < this.itemsPerPage; i++){
        if(typeof this.stories[startRecord + i] != 'undefined'){
          var now = Date.parse(new Date())
          var deadline = Date.parse(this.stories[startRecord + i].deadline.date)

          if((now > deadline) && this.stories[startRecord + i].is_completed == 0 && this.stories[startRecord + i].is_archived == 0) {
            itemArray.push(this.stories[startRecord + i])
          }
        }
      }
      return itemArray
    },
  },

  methods: {
    archiveIdea(idea){
      if(confirm('Would you like to archive this story idea') === true){
        idea.is_archived = 1
        this.updateIdeaStatus(idea)
      }
    },
    // emits the event to the parent with the list of paginated items
    changeItemsPerPage: function(itemsPerPage){
      this.itemsPerPage = itemsPerPage
    },
    setPage: function(pageNumber) {
      if(pageNumber > 0 && pageNumber <= this.totalPages){
        this.currentPage = pageNumber
      }
    },
    slugify: function(str){
      return  str.toLowerCase().replace(/[^a-z0-9-]+/g, '-').replace(/^-+|-+$/g, '')
    },
    timefromNow:function(item) {
      return moment(item.deadline.date).fromNow()
    },
    updateIdeaStatus: function(idea){
        let self = this
        this.$http.patch('/api/storyideas/update/' + idea.id , idea , {
            method: 'PATCH'
        } )
        .then((response) => {
            console.log(response)
        }, (response) => {
          console.log("ERROR!")
          console.log(response)
        });
    },
  },
  watch: {
  },
  filters: {
  },
  events: {
  },
  directives: {

  }
};

</script>
