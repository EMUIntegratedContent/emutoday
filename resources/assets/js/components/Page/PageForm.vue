<template>
  <div>
    <div>
      <!-- PROGRESS BAR -->
      <div class="progress">
        <div v-if="numLoadedComponents >= 5" class="progress-bar" :class="progress == 100 ? 'progress-done' : ''"
             role="progressbar" :aria-valuenow="progress"
             aria-valuemin="0" aria-valuemax="100" :style="'width:' + progress + '%'">
          <span v-if="progress < 100">{{ progress }}% Complete</span>
          <span v-else>I'm Ready!</span>
        </div>
        <div v-else class="progress-bar progress-bar-striped progress-bar-danger active" role="progressbar"
             :aria-valuenow="100"
             aria-valuemin="0" aria-valuemax="100" style="width:100%">
          <span>Loading page...please wait.</span>
        </div>
      </div>
      <section id="page-builder-container">
        <div class="row" id="main-story">
          <div class="col-sm-12 col-md-12 col-lg-6 columns">
            <h4 class="subhead-title">Main Story</h4>
            <page-substory
                story-number="0"
                :story="slotStories.main_story"
                :stypes="stypes"
                @modal-data-loaded="handleSubstoryLoaded"
                @sub-story-swapped="handleSwap"
            ></page-substory>
          </div>
          <div class="col-sm-12 col-md-12 col-lg-6 columns">
            <div class="row" id="date-time-container">
              <div class="col-sm-12">
                <h4 class="subhead-title">Hub Page Information</h4>
              </div>
              <div class="col-sm-12 col-md-6">
                <label>Start Date/Time *
                  <flatpickr
                      v-model="record.start_date"
                      :config="flatpickrConfig"
                      class="form-control"
                      v-bind:class="[formErrors.start_date ? 'invalid-input' : '']"
                  >
                  </flatpickr>
                </label>
                <p v-if="formErrors.start_date" class="help-text invalid">A start date is required.</p>
              </div>
              <div class="col-sm-12 col-md-6">
                <label>End Date/Time *
                  <flatpickr
                      v-model="record.end_date"
                      :config="flatpickrConfig"
                      class="form-control"
                      v-bind:class="[formErrors.end_date ? 'invalid-input' : '']"
                  >
                  </flatpickr>
                </label>
                <p v-if="formErrors.end_date" class="help-text invalid">An end date is required.</p>
              </div>
            </div><!-- /end #date-time-container -->
            <!-- SUCCESS/FAIL MESSAGES -->
            <div class="row">
              <div class="col-xs-12">
                <div v-if="formMessage.isOk" class="alert alert-success alert-dismissible">
                  <button @click.prevent="toggleCallout" class="btn btn-sm close"><i class="fa fa-times"></i></button>
                  <p>{{ formMessage.msg }}</p>
                </div>
                <div v-if="formMessage.isErr" class="alert alert-danger alert-dismissible">
                  <button @click.prevent="toggleCallout" class="btn btn-sm close"><i class="fa fa-times"></i></button>
                  <p>The hub page could not be {{ newpage ? 'created' : 'updated' }}. Please fix the following
                    errors.</p>
                  <ul v-if="formErrors">
                    <li v-for="error in formErrors">{{ error }}</li>
                  </ul>
                </div>
              </div>
              <div class="col-xs-12 text-right">
                <button class="btn btn-success" type="button" @click="submitForm">
                  {{ newpage ? 'Create Hub Page' : 'Update Hub Page' }}
                </button>&nbsp;
                <button v-if="!newpage" type="button" class="btn btn-danger" data-toggle="modal"
                        data-target="#deleteModal">Delete Hub Page
                </button>
              </div>
            </div>
          </div>
        </div>
        <div id="four-stories-bar">
          <div class="row">
            <div class="col-xs-12">
              <h4 class="subhead-title">Sub Stories</h4>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-12 col-md-6 col-lg-3">
              <page-substory
                  story-number="1"
                  :story="slotStories.sub_story_1"
                  :stypes="stypes"
                  @sub-story-swapped="handleSwap"
                  @modal-data-loaded="handleSubstoryLoaded"
              ></page-substory>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-3">
              <page-substory
                  story-number="2"
                  :story="slotStories.sub_story_2"
                  :stypes="stypes"
                  @sub-story-swapped="handleSwap"
                  @modal-data-loaded="handleSubstoryLoaded"
              ></page-substory>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-3">
              <page-substory
                  story-number="3"
                  :story="slotStories.sub_story_3"
                  :stypes="stypes"
                  @sub-story-swapped="handleSwap"
                  @modal-data-loaded="handleSubstoryLoaded"
              ></page-substory>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-3">
              <page-substory
                  story-number="4"
                  :story="slotStories.sub_story_4"
                  :stypes="stypes"
                  @sub-story-swapped="handleSwap"
                  @modal-data-loaded="handleSubstoryLoaded"
              ></page-substory>
            </div>
          </div>
        </div>
      </section><!-- end #page-builder-container -->
    </div><!-- /end root element -->
    <page-delete-modal
        :page="record"
    ></page-delete-modal>
  </div>

</template>

<style scoped>
.progress-done {
  background-color: #3D9970 !important;
}

.valid {
  color: #3c763d;
}

.invalid {
  color: #ff0000;
}

.valid-titleField {
  background-color: #fefefe;
  border-color: #cacaca;
}

.no-input {
  background-color: #fefefe;
  border-color: #cacaca;
}

.invalid-input {
  background-color: rgba(236, 88, 64, 0.1);
  border: 1px dotted red;
}
</style>

<script>
import moment from 'moment'
import PageSubstory from './PageSubstory.vue'
import PageDeleteModal from './PageDeleteModal.vue'
import flatpickr from 'vue-flatpickr-component'
import 'flatpickr/dist/flatpickr.css'

export default {
  components: {
    PageSubstory,
    PageDeleteModal,
    flatpickr
  },
  props: {
    errors: {
      default: ''
    },
    recordexists: {
      default: false
    },
    recordid: {
      default: ''
    },
    framework: {
      default: 'bootstrap'
    },
    user: {
      default: ''
    },
    stypes: {
      default: []
    }
  },
  data: function () {
    return {
      currentRecordId: null,
      currentSelectedStory: null,
      currentSwapId: null,
      endDatepicker: null,
      formErrors: {},
      formMessage: {
        isOk: false,
        isErr: false,
        msg: ''
      },
      numLoadedComponents: 0,
      newpage: false,
      recordState: '',
      record: {
        id: '',
        end_date: null,
        live: 0,
        ready: 0,
        start_date: null,
        template: 'home-emutoday',
        stories: [],
      },
      response: {},
      slotStories: {
        main_story: null,
        sub_story_1: null,
        sub_story_2: null,
        sub_story_3: null,
        sub_story_4: null,
      },
      startDatepicker: null,
      userRoles: [],
      flatpickrConfig: {
        altFormat: "m/d/Y h:i K", // format the user sees
        altInput: true,
        dateFormat: "Y-m-d H:i:S", // format sumbitted to the API
        enableTime: true
      }
    }
  },
  created: function () {
    if (this.recordexists) {
      this.fetchCurrentPage(this.recordid)
    }
    else {
      this.newpage = true;
      this.setupDatePickers()
    }
  },
  computed: {
    isAdmin: function () {
      if (this.userRoles.indexOf('admin') != -1) {
        return true;
      }
      else {
        if (this.userRoles.indexOf('admin_super') != -1) {
          return true;
        }
        else {
          return false;
        }
      }
    },

    // Progress of page bulider (adds up to 100%)
    progress: function () {
      let progress = 0

      this.record.start_date ? progress += 14 : ''
      this.record.end_date ? progress += 14 : ''
      this.slotStories.main_story ? progress += 16 : ''
      this.slotStories.sub_story_1 ? progress += 14 : ''
      this.slotStories.sub_story_2 ? progress += 14 : ''
      this.slotStories.sub_story_3 ? progress += 14 : ''
      this.slotStories.sub_story_4 ? progress += 14 : ''

      return progress
    },
  },

  methods: {
    handleSubstoryLoaded () {
      this.numLoadedComponents++
    },
    handleSwap (storyData) {
      switch (storyData.storyNumber) {
        case "0":
          this.slotStories.main_story = storyData.story
          break;
        case "1":
          this.slotStories.sub_story_1 = storyData.story
          break;
        case "2":
          this.slotStories.sub_story_2 = storyData.story
          break;
        case "3":
          this.slotStories.sub_story_3 = storyData.story
          break;
        case "4":
          this.slotStories.sub_story_4 = storyData.story
          break;
      }
    },
    fetchCurrentPage: function (recid) {
      this.$http.get('/api/page/' + recid + '/edit')

      .then((response) => {
        this.record = response.data.newdata.data
        this.setPageStorySlots(this.record.stories)
        this.setupDatePickers();
      }).catch((e) => {
        this.formErrors = e.response.data.error.message
      })
    },

    nowOnReload: function () {
      let newurl = '/admin/page/' + this.currentRecordId + '/edit'
      document.location = newurl
    },

    onRefresh: function () {
      this.recordId = this.currentRecordId
      this.fetchCurrentPage(this.currentRecordId)
    },

    // Loop through the stories that belong to this page and add them to the correct slots
    setPageStorySlots: function (storiesArr) {
      const self = this
      storiesArr.forEach(function (story) {
        // make sure the pivot table exists on the story object
        if (story.pivot) {
          switch (story.pivot.page_position) {
            case 0:
              self.slotStories.main_story = story
              break
            case 1:
              self.slotStories.sub_story_1 = story
              break
            case 2:
              self.slotStories.sub_story_2 = story
              break
            case 3:
              self.slotStories.sub_story_3 = story
              break
            case 4:
              self.slotStories.sub_story_4 = story
              break
          }
        }
      })
    },

    // Make sure all story IDs in the builder are unique. Otherwise, it causes conflicts with the logic when building the page.
    checkUniqueIds() {
      const ids = Object.values(this.slotStories).map(story => story.id)
      return new Set(ids).size === Object.keys(this.slotStories).length
    },

    submitForm: function () {
      if (this.formErrors.endDateBeforeStart) {
        alert('The end date occurs before the start date. Please fix this before submitting.')
        return false
      }

      if(this.progress === 100 && !this.checkUniqueIds()) {
        alert('You are using the same story multiple times. Please ensure each story is unique.')
        return false
      }

      $('html, body').animate({ scrollTop: 0 }, 'fast');

      // Decide route to submit form to
      let method = (this.recordexists) ? 'put' : 'post'
      let route = (this.recordexists) ? '/api/page/' + this.record.id : '/api/page';

      // Submit form.
      this.$http[method](route,
          {
            page: this.record,
            stories: this.slotStories
          }
      )
      .then((response) => {
        this.formMessage.msg = response.data.message
        this.formMessage.isOk = true // Success message
        this.formMessage.isErr = false
        this.currentRecordId = response.data.newdata.data.id
        this.formErrors = {}; // Clear errors
        if (this.newpage) {
          this.nowOnReload();
        }
        else {
          this.onRefresh();
        }
      }).catch((e) => {
        console.log(e)
        this.formMessage.isOk = false;
        this.formMessage.isErr = true;
      })
    },

    setupDatePickers: function () {
      let today = moment()
      if (!this.record.start_date) {
        this.record.start_date = today.format('YYYY-MM-DD 00:00:00')
      }
      if (!this.record.end_date) {
        this.record.end_date = today.format('YYYY-MM-DD 00:00:00')
      }
    },

    toggleCallout: function (evt) {
      this.formMessage.isOk = false
      this.formMessage.isErr = false
    },
    checkStartEndDates () {
      const sd = moment(this.record.start_date, 'YYYY-MM-DD HH:mm:ss')
      const ed = moment(this.record.end_date, 'YYYY-MM-DD HH:mm:ss')
      if (ed.isBefore(sd)) {
        this.formMessage.isErr = true
        this.formMessage.isOk = false
        this.formErrors.endDateBeforeStart = 'The end date occurs before the start date.'
      }
      else {
        delete this.formErrors.endDateBeforeStart
        // There could be other errors at this point
        if (!this.formErrors.length) {
          this.formMessage.isErr = false
          this.formMessage.isOk = false
        }
      }
    }
  },
  watch: {
    'record.start_date' () {
      this.checkStartEndDates()
    },
    'record.end_date' () {
      this.checkStartEndDates()
    }
  }
};

</script>
