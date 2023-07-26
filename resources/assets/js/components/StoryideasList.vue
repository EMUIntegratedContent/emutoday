<template>
  <div>
    <h1>Story Ideas</h1>
    <div class="row">
      <div class="col-md-8">
        <ul class="ideacategory-checklist">
          <li v-for="storytype in ideasByCategory" :key="'ibc-'+storytype.categoryName">
            <input class="form-check-input" type="checkbox" :id="'display-' + slugify(storytype.categoryName)"
                   v-model="storytype.display">
            <label class="form-check-label"
                   :for="'display-' + slugify(storytype.categoryName)">{{ storytype.categoryName }}</label>
          </li>
        </ul>
      </div>
      <div class="col-md-4 text-right clearfix">
        <a class="btn btn-sm btn-info" href="/admin/storyideas/form"><i class="fa fa-lightbulb-o"></i> New Idea</a>
        <a v-if="role == 'admin' || role == 'admin_super'" class="btn btn-sm btn-default"
           href="/admin/archive/queue/storyideas"><i class="fa fa-archive"></i> Archived Ideas</a>
      </div>
    </div>
    <div class="row">
      <template v-for="storytype in ideasByCategory" :key="'st-'+storytype">
        <div
            v-if="storytype.display"
            class="col-sm-12 col-md-6 col-lg-4"
        >
          <storyideas-panel
              :story-idea-type="storytype.categoryName"
              :stories="storytype.stories"
              :role="role"
          >
          </storyideas-panel>
        </div>
      </template>
    </div>
  </div>
</template>
<style scoped>
ul.ideacategory-checklist {
  padding: 0 0 30px 0;
}

ul.ideacategory-checklist li {
  float: left;
  list-style-type: none;
  padding-right: 10px;
}

.clearfix {
  clear: right;
}
</style>
<script>
import StoryideasPanel from './StoryideasPanel.vue'

export default {
  components: {
    StoryideasPanel
  },
  props: ['role'],
  data: function () {
    return {
      currentSearch: '',
      ideasByCategory: {
        easternMagazine: {
          categoryName: 'Eastern Magazine',
          stories: [],
          display: true
        },
        emuToday: {
          categoryName: 'EMU Today',
          stories: [],
          display: true
        },
        fundraising: {
          categoryName: 'Fundraising',
          stories: [],
          display: true
        },
        homepage: {
          categoryName: 'Homepage',
          stories: [],
          display: true
        },
        mediaAdvisory: {
          categoryName: 'Media Advisory',
          stories: [],
          display: true
        },
        mediaPitch: {
          categoryName: 'Media Pitch',
          stories: [],
          display: true
        },
        newsletter: {
          categoryName: 'Newsletter',
          stories: [],
          display: true
        },
        newsRelease: {
          categoryName: 'News Release',
          stories: [],
          display: true
        },
      },
      ideas: [],
      formErrors: '',
      pagination: {
        current_page: 1,
        last_page: 1,
        next_page_url: '',
        prev_page_url: '',
        next_page: null,
        prev_page: null
      },
      last_page: 1, //need a second last page in case search results turn up 0 pages
    }
  },
  created () {
    this.fetchIdeas()
  },
  computed: {
    hasPrevious () {
      return this.pagination.prev_page_url
    },
    hasNext () {
      return this.pagination.next_page_url
    }
  },

  methods: {
    // separate out each story idea into categories
    categorizeIdeas () {
      const self = this
      this.ideas.forEach(idea => {
        switch (idea.medium.medium) {
          case 'Eastern Magazine':
            self.ideasByCategory.easternMagazine.stories.push(idea)
            break
          case 'EMU Today':
            self.ideasByCategory.emuToday.stories.push(idea)
            break
          case 'Fundraising':
            self.ideasByCategory.fundraising.stories.push(idea)
            break
          case 'Homepage':
            self.ideasByCategory.homepage.stories.push(idea)
            break
          case 'Media Advisory':
            self.ideasByCategory.mediaAdvisory.stories.push(idea)
            break
          case 'Media Pitch':
            self.ideasByCategory.mediaPitch.stories.push(idea)
            break
          case 'News Release':
            self.ideasByCategory.newsRelease.stories.push(idea)
            break
          case 'Newsletter':
            self.ideasByCategory.newsletter.stories.push(idea)
            break
        }
      })
    },
    fetchIdeas: function () {
      this.$http.get('/api/storyideas')
      .then((response) => {
        this.ideas = response.data.newdata.data
        this.categorizeIdeas()
      }).catch((e) => {
        this.formErrors = e.response.data.error.message
      })
    },
    makePagination: function (data) {
      const pagination = {
        current_page: data.current_page,
        last_page: data.last_page,
        next_page_url: data.next_page_url,
        prev_page_url: data.prev_page_url,
        next_page: data.current_page + 1,
        prev_page: data.current_page - 1
      }

      if (data.last_page == 0) {
        this.last_page = 1; //need this to avoid confusing the conditional statement in fetchExperts()
      }
      else {
        this.last_page = data.last_page
      }

      this.pagination = pagination
    },
    isActivePage (page) {
      return page == this.pagination.current_page
    },
    slugify (str) {
      return str.toLowerCase().replace(/[^a-z0-9-]+/g, '-').replace(/^-+|-+$/g, '')
    }
  }
}

</script>
