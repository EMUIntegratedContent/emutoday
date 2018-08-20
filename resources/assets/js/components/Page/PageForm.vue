<template>
    <div>
        <!-- PROGRESS BAR -->
        <div class="progress">
          <div class="progress-bar" :class="progress == 100 ? 'progress-done' : ''" role="progressbar" :aria-valuenow="progress"
          aria-valuemin="0" aria-valuemax="100" :style="'width:' + progress + '%'">
            <span v-if="progress < 100">{{ progress }}% Complete</span>
            <span v-else>I'm Ready!</span>
          </div>
        </div>
        <section id="page-builder-container">
            <div class="row" id="main-story">
                <div class="col-sm-12 col-md-12 col-lg-6 columns">
                    <h4 class="subhead-title">Main Story</h4>
                    <page-substory
                        story-number="0"
                        :story="record.main_story"
                        :stypes="stypes"
                    ></page-substory>
                </div>
                <div class="col-sm-12 col-md-12 col-lg-6 columns">
                    <div class="row" id="date-time-container">
                        <div class="col-sm-12">
                            <h4 class="subhead-title">Hub Page Information</h4>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <label>Start Date/Time *</label>
                            <input id="start-date" type="text" v-model="record.start_date" class="form-control" v-bind:class="[formErrors.start_date ? 'invalid-input' : '']" />
                            <p v-if="formErrors.start_date" class="help-text invalid">A start date is required.</p>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <label>End Date/Time *</label>
                            <input id="end-date" type="text" v-model="record.end_date" class="form-control" v-bind:class="[formErrors.end_date ? 'invalid-input' : '']" />
                            <p v-if="formErrors.end_date" class="help-text invalid">An end date is required.</p>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <label>Active?</label>
                            <input type="checkbox" v-model="record.live" />
                        </div>
                    </div><!-- /end #date-time-container -->
                    <!-- SUCCESS/FAIL MESSAGES -->
                    <div class="row">
                      <div class="col-xs-12">
                        <div v-show="formMessage.isOk"  class="alert alert-success alert-dismissible">
                          <button @click.prevent="toggleCallout" class="btn btn-sm close"><i class="fa fa-times"></i></button>
                          <p>{{formMessage.msg}}</p>
                        </div>
                        <div v-show="formMessage.isErr"  class="alert alert-danger alert-dismissible">
                          <button @click.prevent="toggleCallout" class="btn btn-sm close"><i class="fa fa-times"></i></button>
                          <p>The hub page could not be {{ newpage ? 'created' : 'updated' }}. Please fix the following errors.</p>
                          <ul v-if="formErrors">
                            <li v-for="error in formErrors">{{error}}</li>
                          </ul>
                        </div>
                      </div>
                      <div class="col-xs-12 text-right">
                        <button class="btn btn-success" type="button" @click="submitForm">{{ newpage ? 'Create Hub Page' : 'Update Hub Page' }}</button>
                        <button v-show="!newpage" type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal">Delete Hub Page</button>
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
                            :story="record.sub_story_1"
                            :stypes="stypes"
                        ></page-substory>
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-3">
                        <page-substory
                            story-number="2"
                            :story="record.sub_story_2"
                            :stypes="stypes"
                        ></page-substory>
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-3">
                        <page-substory
                            story-number="3"
                            :story="record.sub_story_3"
                            :stypes="stypes"
                        ></page-substory>
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-3">
                        <page-substory
                            story-number="4"
                            :story="record.sub_story_4"
                            :stypes="stypes"
                        ></page-substory>
                    </div>
                </div>
            </div>
        </section><!-- end #page-builder-container -->
    </div><!-- /end root element -->
    <!--
    <page-story-swap-modal
        :story-number="currentSwapId"
        :currentSelectedStory="currentSelectedStory"
        :stypes="stypes"
    ></page-story-swap-modal>
    -->
</template>

<style scoped>
.progress-done{
  background-color: #3D9970 !important;
}
.valid{
  color:#3c763d;
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
import flatpickr from 'flatpickr'
import vSelect from "vue-select"
import VuiFlipSwitch from '../VuiFlipSwitch.vue'
import PageSubstory from './PageSubstory.vue'
import PageStorySwapModal from './PageStorySwapModal.vue'

module.exports = {
  directives: {},
  components: {PageSubstory, PageStorySwapModal, vSelect},
  props: {
    cuserRoles: {default: {}},
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
  data: function() {
    return {
      currentRecordId: null,
      currentSelectedStory: null,
      currentSwapId: null,
      dateObject:{
        endDateDefault: '',
        endDateMax: '',
        endDateMin: '',
        startDateDefault: '',
        startDateMax: '',
        startDateMin: '',
      },
      formErrors: {},
      formSuccess: {},
      minTitleChars: 10, // minimum title characters allowed
      formInputs: {},
      formMessage: {
        isOk: false,
        isErr: false,
        msg: ''
      },
      newpage: false,
      recordState: '',
      record: {
        id: '',
        end_date: null,
        live: false,
        start_date: null,
        main_story: null,
        sub_story_1: null,
        sub_story_2: null,
        sub_story_3: null,
        sub_story_4: null,
      },
      response: {},
      startDatepicker: null,
      endDatepicker: null,
      userRoles: [],
    }
  },
  created: function () {
  },
  ready: function() {
    if(this.recordexists){
      //this.fetchCurrentPage(this.recordid)
    } else {
      this.newpage = true;
      this.setupDatePickers()
    }
  },
  computed: {
    isAdmin:function(){
      if(this.userRoles.indexOf('admin')!= -1) {
        return true;
      } else {
        if (this.userRoles.indexOf('admin_super') != -1) {
          return true;
        } else {
          return false;
        }
      }
    },

    // Progress of page bulider (adds up to 100%)
    progress: function(){
      let progress = 0

      this.record.start_date ? progress += 12.5 : ''
      this.record.end_date ? progress += 12.5 : ''
      this.record.live == true ? progress += 12.5 : ''
      this.record.main_story ? progress += 12.5 : ''
      this.record.sub_story_1 ? progress += 12.5 : ''
      this.record.sub_story_2 ? progress += 12.5 : ''
      this.record.sub_story_3 ? progress += 12.5 : ''
      this.record.sub_story_4 ? progress += 12.5 : ''

      return progress
    },
  },

  methods: {
    fetchCurrentPage: function(recid) {
      // this.$http.get('/api/page/' + recid + '/edit')
      //
      // .then((response) => {
      //   this.$set('record', response.data.newdata.data)
      //   //this.setupDatePickers();
      // }, (response) => {
      //   this.formErrors = response.data.error.message;
      // }).bind(this);
    },

    nowOnReload:function() {
      let newurl = '/admin/page/'+ this.currentRecordId+'/edit';
      document.location = newurl;
    },

    onRefresh: function() {
      this.recordId = this.currentRecordId;
      this.recordexists = true;
      this.fetchCurrentPage(this.currentRecordId);
    },

    submitForm: function() {
      $('html, body').animate({ scrollTop: 0 }, 'fast');

      // Decide route to submit form to
      let method = (this.recordexists) ? 'put' : 'post'
      let route =  (this.recordexists) ? '/api/page/' + this.record.id : '/api/page';

      // Submit form.
      this.$http[method](route, this.record) //

      // Do this when response gets back.
      .then((response) => {
          console.log(response.data)
        this.formMessage.msg = response.data.message;
        this.formMessage.isOk = response.ok; // Success message
        this.formMessage.isErr = false;
        this.currentRecordId = response.data.newdata.data.id;
        this.recordexists = true;
        this.formErrors = {}; // Clear errors

        if (this.newpage) {
          this.nowOnReload();
        } else {
          this.onRefresh();
        }
      }, (response) => { // If invalid. error callback
        this.formMessage.isOk = false;
        this.formMessage.isErr = true;
        // Set errors from validation to vue data
        this.formErrors = response.data.error.message;
      }).bind(this);
    },

    setupDatePickers:function(){
      let self = this
      let today = moment()

      //this.dateObject.sendAtMin = today.format('YYYY-MM-DD')
      if (this.record.start_date === '') {
        this.dateObject.startDateDefault = today.format('YYYY-MM-DD')
      } else {
        this.dateObject.startDateDefault = this.record.start_date;
      }

      if (this.record.end_date === '') {
        this.dateObject.endDateDefault = today.format('YYYY-MM-DD')
      } else {
        this.dateObject.endDateDefault = this.record.end_date;
      }

      this.startDatepicker = flatpickr(document.getElementById("start-date"), {
        //minDate: self.dateObject.startDateMin,
        defaultDate: self.dateObject.startDateDefault,
        enableTime: true,
        altInput: true,
        altInputClass: "form-control",
        dateFormat: "Y-m-d H:i:S",
        onChange: function(dateObj, dateStr, instance) {
          self.record.start_date = dateStr;
          self.endDatepicker.set("minDate", dateObj.fp_incr(1));
        }
      });

      this.endDatepicker = flatpickr(document.getElementById("end-date"), {
        //minDate: self.dateObject.endDateMin,
        defaultDate: self.dateObject.endDateDefault,
        enableTime: true,
        altInput: true,
        altInputClass: "form-control",
        dateFormat: "Y-m-d H:i:S",
        onChange: function(dateObj, dateStr, instance) {
            self.record.end_date = dateStr;
            self.startDatepicker.set("maxDate", dateObj.fp_incr(-1));
        }
      });
    },

    toggleCallout:function(evt){
      this.formMessage.isOk = false
      this.formMessage.isErr = false
    },
  },
  watch: {
  },
  filters: {
    formatDate: function(value) {
      if (value) {
        return moment(String(value)).format('LLLL')
      }
    },
  },
  events: {
      'story-swapped': function (storyData) {
          // storyData[0] contains the story object
          // storyData[1] contains the story's position in the page builder
          switch(storyData[1]){
              case "0":
                this.$set('record.main_story', storyData[0])
                break;
              case "1":
                this.$set('record.sub_story_1', storyData[0])
                break;
              case "2":
                this.$set('record.sub_story_2', storyData[0])
                break;
              case "3":
                this.$set('record.sub_story_3', storyData[0])
                break;
              case "4":
                this.$set('record.sub_story_4', storyData[0])
                break;
          }
      },
  },
};

</script>
