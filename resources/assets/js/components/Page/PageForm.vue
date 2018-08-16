<template>
    <div>
        <section id="page-builder-container">
            <div class="row" id="main-story">
                <div class="col-sm-12 col-md-12 col-lg-6 columns">
                    <h4 class="subhead-title">Main Story</h4>
                    <page-substory
                        story-number="0"
                    ></page-substory>
                </div>
                <div class="col-sm-12 col-md-12 col-lg-6 columns">
                    <div class="row" id="date-time-container">
                        <div class="col-sm-12">
                            <h4 class="subhead-title">Hub Page Information</h4>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <label>Start Date/Time *</label>
                            <input id="start-date" type="text" v-model="record.start_date" class="form-control" />
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <label>End Date/Time *</label>
                            <input id="end-date" type="text" v-model="record.end_date" class="form-control" />
                        </div>
                    </div><!-- /end #date-time-container -->
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
                        ></page-substory>
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-3">
                        <page-substory
                            story-number="2"
                        ></page-substory>
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-3">
                        <page-substory
                            story-number="3"
                        ></page-substory>
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-3">
                        <page-substory
                            story-number="4"
                        ></page-substory>
                    </div>
                </div>
            </div>
        </section><!-- end #page-builder-container -->
    </div><!-- /end root element -->
    <page-story-swap-modal
        :story-number="currentSwapId"
        :stypes="stypes"
    ></page-story-swap-modal>
</template>

<style scoped>

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
        start_date: null,
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
      this.newform = true;
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

    mouseOver: function(boxId){
        var box = document.getElementById(boxId)
        box.className += " swap_overlay "
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
        this.formMessage.msg = response.data.message;
        this.formMessage.isOk = response.ok; // Success message
        this.formMessage.isErr = false;
        this.currentRecordId = response.data.newdata.data.id;
        this.recordexists = true;
        this.formErrors = {}; // Clear errors

        if (this.newform) {
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
      'story-swap-requested': function (storyNumber) {
          // pass the story number (relative to the order of the stories in this page builder)...
          this.currentSwapId = storyNumber;
          // ... to the modal
          $('#pageStorySwapModal').modal('show');
      },
  },
};

</script>
