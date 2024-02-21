<template>
  <div>
    <div class="row">
      <div class="col-xs-12 col-sm-8 col-md-6 col-lg-9">
        <p>This story will be set as the feature story under the EMU 175 section on the hub page. You will only be presented stories that have the emutoday_175 image type and are live.</p>
      </div>
    </div>
    <hr/>
    <div class="row">
      <div class="col-md-12">
        <!-- Date filter -->
        <form class="form-inline">
          <div class="form-group">
            <label>Starting <span v-if="isEndDate">between</span><span v-else>on or after</span><br>
              <flatpickr
                  v-model="startdate"
                  id="startDatePicker"
                  :config="flatpickrConfig"
                  class="form-control"
                  name="startingDate"
              >
              </flatpickr>
            </label>
          </div>
          <div v-if="isEndDate" class="form-group">
            <label> and<br>
              <flatpickr
                  v-model="enddate"
                  id="endDatePicker"
                  :config="flatpickrConfig"
                  class="form-control"
                  name="endingDate"
              >
              </flatpickr>
            </label>
          </div>
          <p>
            <button type="button" class="btn btn-sm btn-info" @click="fetchAllRecords">Filter</button>
          </p>
          <p>
            <button href="#" id="rangetoggle" type="button" @click="toggleRange"><span
                v-if="isEndDate"> - Remove </span><span
                v-else> + Add </span>Range
            </button>
          </p>
        </form>
        <div class="row">
          <div class="col-md-12 col-lg-6">
            <div id="emu175-stories">
              <template v-if="!loadingQueue">
                <template v-if="queueStories.length > 0">
                  <emu-175-story-pod
                      :item="story"
                      :key="'emu175-story-' + index + '-' + podIterator"
                      v-for="(story, index) in queueStories"
                      @toggle-emu175-story="handleToggleStory($event, story)"
                  >
                  </emu-175-story-pod>
                  <ul class="pagination">
                    <li v-bind:class="{disabled: (currentPage <= 1)}" class="page-item">
                      <a href="#" @click.prevent="setPage(currentPage-1)" class="page-link" tabindex="-1">Previous</a>
                    </li>
                    <li v-for="pageNumber in totalPages" :class="{active: (pageNumber) == currentPage}" class="page-item">
                      <a class="page-link" href="#" @click.prevent="setPage(pageNumber)">{{ pageNumber }} <span
                          v-if="(pageNumber) == currentPage" class="sr-only">(current)</span></a>
                    </li>
                    <li v-bind:class="{disabled: (currentPage == totalPages)}" class="page-item">
                      <a class="page-link" @click.prevent="setPage(currentPage+1)" href="#">Next</a>
                    </li>
                  </ul>
                </template>
                <template v-else>
                  <p>There are no stories for the date range you've specified.</p>
                </template>
              </template>
              <template v-else>
                <p>Loading queue. Please Wait...</p>
              </template>
            </div>
          </div>
          <div class="col-md-12 col-lg-6">
            <div v-if="showSave" style="margin-bottom: .25rem">
              <input type="button" class="btn btn-success" value="Save" @click="saveEmu175Story">&nbsp;
              <input type="button" class="btn btn-secondary" value="Cancel" @click="resetChanges">
            </div>
            <template v-if="emu175Story">
              <img
                  class="col-img"
                  :alt="emu175Story.emu175_image[0].alt_text"
                  :src="'/imagecache/emailsub/' + emu175Story.emu175_image[0].filename"/>
              <div id="emu-175-main-info">
                <h3 id="emu-175-main-title">{{ emu175Story.emu175_image[0].title }}</h3>
                <p id="emu-175-main-teaser">{{ emu175Story.emu175_image[0].caption }}</p>
                <p class="button-group">
                  <a href="#" aira-label="stuff" class="bold-green-link">
                    {{ emu175Story.emu175_image[0].moretext }}
                  </a>
                </p>
              </div>
            </template>
            <p v-else>
              No story selected. Click the checkbox in a story pod to select it as the EMU 175 story.
            </p>
          </div>
        </div>
      </div><!-- /.col-md-12 -->
    </div><!-- ./row -->
  </div>
</template>
<style scoped>
h4 {
  margin-top: 3px;
  font-size: 18px;
}

.btn-default:active, .btn-default.active, .open > .dropdown-toggle.btn-default {
  background-color: #605ca8;
  color: #ffffff;

}

.btn-default:active, .btn-default.active, .open > .dropdown-toggle.btn-default {
  color: #ffffff;
}

span.item-type-icon:active, span.item-type-icon.active {
  background-color: #605ca8;
  color: #ffffff;
}

#rangetoggle {
  color: #FF851B;
  border-bottom: 2px #FF851B dotted;
}

/*Media Queries*/
@media only screen and (min-width: 610px) {
  .two-column .column {
    max-width: 49.9% !important;
    width: 49.9%;

  }

  img.col-img {
    max-width: 616px !important;
    width: 100%;
  }

}
</style>
<script>
import moment from 'moment'
import Emu175StoryPod from './Emu175StoryPod.vue'
import Pagination from '../Pagination.vue'
import flatpickr from 'vue-flatpickr-component'
import 'flatpickr/dist/flatpickr.css'
import {mapMutations, mapState} from "vuex"

export default {
  mixins: [],
  components: {
    Emu175StoryPod,
    Pagination,
    flatpickr
  },
  created() {
    let twoWeeksEarlier = moment().subtract(2, 'w')
    this.startdate = twoWeeksEarlier.format("YYYY-MM-DD")
    this.enddate = twoWeeksEarlier.clone().add(4, 'w').format("YYYY-MM-DD")
    this.fetchAllRecords()
  },
  data: function () {
    return {
      currentDate: moment(),
      queueStories: [],
      loadingQueue: true,
      eventMsg: null,
      startdate: null,
      enddate: null,
      isEndDate: false,
      currentPage: 1,
      itemsPerPage: 10,
      resultCount: 0,
      flatpickrConfig: {
        altFormat: "m/d/Y", // format the user sees
        altInput: true,
        dateFormat: "Y-m-d", // format sumbitted to the API
        enableTime: false
      },
      podIterator: 0,
      showSave: false,
      originalStory: null
    }
  },
  computed: {
    ...mapState(['emu175Story']),
    totalPages: function () {
      return Math.ceil(this.queueStories.length / this.itemsPerPage)
    }
  },
  methods: {
    ...mapMutations(['setEmu175Story']),
    toggleRange: function () {
      if (this.isEndDate) {
        this.isEndDate = false
      } else {
        this.isEndDate = true
      }
    },
    fetchAllRecords: function () {
      this.loadingQueue = true
      let routeurl = '/api/story/emu175stories'

      // if a start date is set, get stories whose start_date is on or after this date
      if (this.startdate) {
        routeurl = routeurl + '/' + this.startdate
      } else {
        routeurl = routeurl + '/' + moment().subtract(1, 'y').format("YYYY-MM-DD")
      }

      // if a date range is set, get stories between the start date and end date
      if (this.isEndDate) {
        routeurl = routeurl + '/' + this.enddate
      }

      this.$http.get(routeurl)
          .then((response) => {
            this.queueStories = response.data.newdata.data

            // Find the current story (if any) and set it in the store
            const current175Story = this.queueStories.find((story) => {
              return story.is_emu175_hub_story == 1
            })
            if(current175Story) {
              this.setEmu175Story(current175Story)
              this.originalStory = JSON.parse(JSON.stringify(current175Story))
            }

            this.resultCount = this.queueStories.length
            this.setPage(1) // reset paginator
            this.loadingQueue = false
          })
          .catch((e) => {
            console.log(e)
          })
    },
    setPage: function (pageNumber) {
      if (pageNumber > 0 && pageNumber <= this.totalPages) {
        this.currentPage = pageNumber
      }
    },
    saveEmu175Story () {
      this.showSave = false
      this.$http.post('/api/story/updateemu175', this.emu175Story ? this.emu175Story : null)
          .then(() => {
            this.showSave = false
            this.fetchAllRecords()
          })
          .catch((e) => {
            console.log(e)
          })
    },
    resetChanges () {
      this.setEmu175Story(JSON.parse(JSON.stringify(this.originalStory)))
      this.showSave = false
      this.podIterator++
    },
    handleToggleStory(evt, story) {
      this.showSave = true
      if(evt) {
        this.setEmu175Story(story)
      } else {
        this.setEmu175Story(null)
      }
      this.podIterator++
    }
  }
}
</script>
