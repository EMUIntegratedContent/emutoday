<template>
  <div class="panel panel-default">
    <div class="panel-heading">
      <h3 class="panel-title">{{ storyIdeaType }}</h3>
    </div>
    <div class="panel-body">
      <!-- TABS: BUILD STEPS -->
      <ul class="nav nav-tabs" role="tablist">
        <li :class="{ 'active' : activeTab == 1 }"><a :href="'#future-' + slugify(storyIdeaType)" role="tab" data-toggle="tab"
                                                           @click="activeTab = 1">Future ({{ paginatedFutureStories ? paginatedFutureStories.length : '0' }})</a>
        </li>
        <li :class="{ 'active' : activeTab == 2 }"><a :href="'#completed-' + slugify(storyIdeaType)" role="tab" data-toggle="tab"
                                                           @click="activeTab = 2">Completed ({{ paginatedCompletedStories ? paginatedCompletedStories.length : '0' }})</a></li>
        <li :class="{ 'active' : activeTab == 3 }"><a :href="'#past-' + slugify(storyIdeaType)" role="tab" data-toggle="tab"
                                                           @click="activeTab = 3">Past Due ({{ paginatedPastStories ? paginatedPastStories.length : '0' }})</a>
        </li>
      </ul>
      <div class="tab-content">
        <!-- MAIN TAB 1 CONTENT -->
        <div class="tab-pane active" :id="'future-' + slugify(storyIdeaType)">
          <div v-if="paginatedFutureStories.length > 0" class="panel-group">
            <storyideas-pod
                v-for="(idea, index) in paginatedFutureStories"
                :key="'pfs-'+storyIdeaType+'-'+index"
                :role="role"
                :storyidea="idea"
                :index="index"
                panel-type="future"
                @update-story-idea="toggleIdeaStatus"
                @archive-story-idea="archiveIdea"
            >
            </storyideas-pod>
          </div>
          <div v-else>
            <p>No future story ideas in this category.</p>
          </div>
        </div>
        <div class="tab-pane" :id="'completed-' + slugify(storyIdeaType)">
          <div v-if="paginatedCompletedStories.length > 0" class="panel-group">
            <storyideas-pod
                v-for="(idea, index) in paginatedCompletedStories"
                :key="'pcs-'+storyIdeaType+'-'+index"
                :role="role"
                :storyidea="idea"
                :index="index"
                panel-type="completed"
                @update-story-idea="toggleIdeaStatus"
                @archive-story-idea="archiveIdea"
            >
            </storyideas-pod>
          </div>
          <div v-else>
            <p>No completed story ideas in this category.</p>
          </div>
        </div>
        <div class="tab-pane" :id="'past-' + slugify(storyIdeaType)">
          <div v-if="paginatedPastStories.length > 0" class="panel-group">
            <storyideas-pod
                v-for="(idea, index) in paginatedPastStories"
                :key="'pps-'+storyIdeaType+'-'+index"
                :role="role"
                :storyidea="idea"
                :index="index"
                panel-type="past"
                @update-story-idea="toggleIdeaStatus"
                @archive-story-idea="archiveIdea"
            >
            </storyideas-pod>
          </div>
          <div v-else>
            <p>No past-due story ideas in this category.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<style scoped>
.panel-body {
  height: 420px;
  overflow-y: scroll;
}

.nav-tabs > li.active > a, .nav-tabs > li.active > a:hover, .nav-tabs > li.active > a:focus {
  color: #72afd2 !important;
}
</style>
<script>
import moment from 'moment'
import StoryideasPod from './StoryideasPod.vue'

export default {
  components: { StoryideasPod },
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
  data: function () {
    return {
      activeTab: 1,
      currentSearch: '',
      formErrors: '',
      // Pagination
      currentPage: 1,
      itemsPerPage: 10, // currently not using pagination
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
  computed: {
    totalPages: function () {
      return Math.ceil(this.stories.length / this.itemsPerPage)
    },
    // Use the stories from the 'stories' prop and keep only story ideas marked as completed
    paginatedCompletedStories: function () {
      const startRecord = (this.currentPage - 1) * this.itemsPerPage

      let itemArray = []
      for (let i = this.stories.length - 1; i >= 0; i--) {
        if (typeof this.stories[startRecord + i] != 'undefined' && this.stories[startRecord + i].is_completed == 1 && this.stories[startRecord + i].is_archived == 0) {
          itemArray.push(this.stories[startRecord + i])
        }
      }
      return itemArray
    },
    // Use the stories from the 'stories' prop and keep only story ideas whose deadline is in the future and not completed
    paginatedFutureStories: function () {
      const startRecord = (this.currentPage - 1) * this.itemsPerPage

      let itemArray = []
      for (let i = 0; i <= this.stories.length; i++) {
        if (typeof this.stories[startRecord + i] != 'undefined') {
          const now = Date.parse(new Date())
          const deadline = Date.parse(this.stories[startRecord + i].deadline)

          if ((now < deadline) && this.stories[startRecord + i].is_completed == 0 && this.stories[startRecord + i].is_archived == 0) {
            itemArray.push(this.stories[startRecord + i])
          }
        }
      }
      return itemArray
    },
    // Use the stories from the 'stories' prop and keep only story ideas whose deadline is in the past and not completed
    paginatedPastStories: function () {
      const startRecord = (this.currentPage - 1) * this.itemsPerPage

      let itemArray = []
      for (let i = this.stories.length - 1; i >= 0; i--) {
        if (typeof this.stories[startRecord + i] != 'undefined') {
          const now = Date.parse(new Date())
          const deadline = Date.parse(this.stories[startRecord + i].deadline)

          if ((now > deadline) && this.stories[startRecord + i].is_completed == 0 && this.stories[startRecord + i].is_archived == 0) {
            itemArray.push(this.stories[startRecord + i])
          }
        }
      }
      return itemArray
    },
  },

  methods: {
    archiveIdea (idea) {
      if (confirm('Would you like to archive this story idea') === true) {
        idea.is_archived = 1
        this.updateIdeaStatus(idea)
      }
    },
    // emits the event to the parent with the list of paginated items
    changeItemsPerPage: function (itemsPerPage) {
      this.itemsPerPage = itemsPerPage
    },
    setPage: function (pageNumber) {
      if (pageNumber > 0 && pageNumber <= this.totalPages) {
        this.currentPage = pageNumber
      }
    },
    slugify: function (str) {
      return str.toLowerCase().replace(/[^a-z0-9-]+/g, '-').replace(/^-+|-+$/g, '')
    },
    timefromNow: function (item) {
      return moment(item.deadline).fromNow()
    },
    toggleIdeaStatus: function (idea) {
      idea.is_completed == 1 ? idea.is_completed = 0 : idea.is_completed = 1
      this.updateIdeaStatus(idea)
    },
    updateIdeaStatus: function (idea) {
      this.$http.patch('/api/storyideas/' + idea.id, idea, {
        method: 'PATCH'
      })
      .then(() => {

      }).catch((e) => {
        console.log(e)
      })
    }
  }
};

</script>
