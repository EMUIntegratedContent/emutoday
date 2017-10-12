<template>
  <div>
    <form>
      <slot name="csrf"></slot>
      <div class="row">
        <!-- EMAIL LIVE BUILDER VIEW AREA -->
        <!-- BUILDER TOOLS AREA -->
        <div v-bind:class="[md12col, lg4col]">
          <!-- Nav tabs -->
          <ul class="nav nav-tabs" role="tablist">
            <li><a href="#main-story" role="tab" data-toggle="tab">Main Story</a></li>
            <li><a href="#stories" role="tab" data-toggle="tab">Side Stories</a></li>
            <li><a href="#events" role="tab" data-toggle="tab">Events</a></li>
            <li class="active"><a href="#announcements" role="tab" data-toggle="tab">Announcements</a></li>
          </ul>
          <!-- Tab panes -->
          <div class="tab-content">
            <div class="tab-pane" id="main-story">
              <email-main-story-queue
              :stypes="stypes"
              :main-story="record.mainStory"
              ></email-main-story-queue>
            </div>
            <div class="tab-pane" id="stories">
              <email-story-queue
              :stypes="stypes"
              :other-stories="record.otherStories"
              ></email-story-queue>
            </div>
            <div class="tab-pane" id="events">
              <email-event-queue
              :events="record.events"
              ></email-event-queue>
            </div>
            <div class="tab-pane active" id="announcements">
              <email-announcement-queue
              :announcements="record.announcements"
              ></email-announcement-queue>
            </div>
          </div>
        </div>
        <!-- /.medium-4 columns -->
        <div v-bind:class="[md12col, lg8col]">
          <!--<div class="progress">
            <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;">
              60%
            </div>
          </div>-->
          <section id="email-live-container" style="margin:0 auto; width:620px; padding:10px; border:1px solid #d1d1d1; overflow:scroll; overflow-y: hidden; margin-bottom:20px">
            <table border="0" cellpadding="5" cellspacing="0" height="100%" width="100%" id="bodyTable">
                <tr>
                    <td align="center" valign="top">
                        <table border="0" width="600" id="emailContainer">
                            <tr>
                                <td valign="top" width="368">
                                  <template v-if="record.mainStory">
                                    <article style="padding:0 5px">
                                      <img :src="record.mainStory.email_images[0].image_path + record.mainStory.email_images[0].filename" :alt="record.mainStory.email_images[0].title"  style="border-right:5px solid #ffffff; width:368px; height:245px; "/>
                                      <h2>{{record.mainStory.title}}</h2>
                                      {{{ record.mainStory.content | truncate '60' }}}
                                      <p><a :href="record.mainStory.full_url">Read More</a></p>
                                    </article>
                                  </template>
                                  <template v-else>
                                    <div style="background-color:#e5e5e5; position:relative; width:368px; height:245px; text-align:center; margin:0 auto; border-right:5px solid #ffffff;">
                                      <p style="position:absolute; left:38px; top:96px; font-size:3rem;">Main story image here.</p>
                                    </div>
                                    <h2 style="padding:0 5px">No main story set yet.</h2>
                                    <p style="padding:0 5px">Select a main story from the "Main Story" tab.</p>
                                  </template>
                                  <hr />
                                </td>
                                <td rowspan="3" valign="top" width="232" style="background:#e5e5e5">
                                  <template v-if="record.events.length > 0">
                                    <h3 style="padding:0 5px">Upcoming Events</h3>
                                    <article v-for="event in record.events" style="padding:0 5px">
                                      <hr />
                                      <h4>{{event.title}}<h4>
                                      {{ event.start_date }} | {{ event.start_time }} | {{ event.location }}
                                      <p><a :href="event.full_url">View Event</a></p>
                                    </article>
                                  </template>
                                  <template v-else>
                                    <p style="padding:0 5px">No events set yet. Select at least one from the "Events" tab.</p>
                                  </template>
                                </td>
                            </tr>
                            <tr>
                              <td valign="top">
                                <template v-if="record.otherStories.length > 0">
                                  <h3>Featured News Stories</h3>
                                  <article v-for="story in record.otherStories" style="padding:0 5px">
                                    <h4>{{story.title}}<h4>
                                    {{{ story.content | truncate '30' }}}
                                    <p><a :href="story.full_url">Read More</a></p>
                                  </article>
                                </template>
                                <template v-else>
                                  <p style="padding:0 5px">No side stories set yet. Select at least one from the "Side Stories" tab.</p>
                                </template>
                                <hr />
                              </td>
                            </tr>
                            <tr>
                              <td valign="top">
                                <template v-if="record.announcements.length > 0">
                                  <h3>Announcements</h3>
                                  <article v-for="announcement in record.announcements">
                                    <h4>{{ announcement.title }}</h4>
                                    <p>{{ announcement.announcement | truncate '30' }}</p>
                                    <p><a :href="announcement.link">{{ announcement.link_txt }}</a></p>
                                  </article>
                                </template>
                                <template v-else>
                                  <p style="padding:0 5px">No announcements set yet. Select at least one from the "Announcements" tab.</p>
                                </template>
                              </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
          </section>
        </div>
        <!-- /.medium-8 columns -->
      </div>
      <!-- /.row -->
      <!--
      <div class="row">
          <div v-bind:class="md12col">
              <h4>Send Times</h4>
          </div>
          <div v-if="sendtimes.length > 0" v-bind:class="md12col">
            <div v-for="time in sendtimes" class="input-group">
                <label class="sr-only">Time</label>
                <input class="form-control dynamic-list-item" type="text" v-model="time.send_at">
                <span class="input-group-btn">
                    <button @click="delSendtime(time)" class="btn btn-warning dynamic-list-btn" type="button">X</button>
                </span>
            </div>
          </div>
          <div v-else v-bind:class="md12col">
              <p>None</p>
          </div>
          <div v-bind:class="md12col">
              <button @click="addSendtime" :class="btnSecondary" type="button">Add Send Time</button>
          </div>
      </div>
      -->
      <!-- /.row -->
    </form>
  </div>
</template>

<style scoped>
.redBtn {
  background: hsl(0, 90%, 70%);
}
</style>


<script>
import moment from 'moment';
import flatpickr from 'flatpickr';
import vSelect from "vue-select";
import VuiFlipSwitch from '../VuiFlipSwitch.vue'
import EmailMainStoryQueue from './EmailMainStoryQueue.vue'
import EmailStoryQueue from './EmailStoryQueue.vue'
import EmailEventQueue from './EmailEventQueue.vue'
import EmailAnnouncementQueue from './EmailAnnouncementQueue.vue'

module.exports = {
  directives: {flatpickr},
  components: {EmailMainStoryQueue, EmailStoryQueue, EmailEventQueue, EmailAnnouncementQueue, vSelect},
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
      sendtimes: [],
      formErrors: {},
      formInputs: {},
      formMessage: {
        isOk: false,
        isErr: false,
        msg: ''
      },
      newform: false,
      recordState: '',
      record: {
        id: '',
        sendtimes: [],
        mainStory: null,
        otherStories: [],
        events: [],
        announcements: [],
        title: null,
      },
      response: {},
      totalChars: {
        title: 50,
      },
      userRoles: [],
    }
  },
  created: function () {
  },
  ready: function() {
    if(this.recordexists){
      fetchCurrentEmail(this.recordid)
    }
  },
  computed: {

    // switch classes based on css framework. foundation or bootstrap
    md6col: function() {
      return (this.framework == 'foundation' ? 'medium-6 columns' : 'col-md-6')
    },
    md12col: function() {
      return (this.framework == 'foundation' ? 'medium-12 columns' : 'col-md-12')
    },
    md8col: function() {
      return (this.framework == 'foundation' ? 'medium-8 columns' : 'col-md-8')
    },
    md4col: function() {
      return (this.framework == 'foundation' ? 'medium-4 columns' : 'col-md-4')
    },
    lg6col: function() {
      return (this.framework == 'foundation' ? 'large-6 columns' : 'col-lg-6')
    },
    lg12col: function() {
      return (this.framework == 'foundation' ? 'large-12 columns' : 'col-lg-12')
    },
    lg8col: function() {
      return (this.framework == 'foundation' ? 'large-8 columns' : 'col-lg-8')
    },
    lg4col: function() {
      return (this.framework == 'foundation' ? 'large-4 columns' : 'col-lg-4')
    },
    btnPrimary: function() {
      return (this.framework == 'foundation' ? 'button button-primary' : 'btn btn-primary')
    },
    btnSecondary: function() {
      return (this.framework == 'foundation' ? 'button button-secondary' : 'btn btn-link')
    },
    formGroup: function() {
      return (this.framework == 'foundation' ? 'form-group' : 'form-group')
    },
    formControl: function() {
      return (this.framework == 'foundation' ? '' : 'form-control')
    },
    calloutSuccess:function(){
      return (this.framework == 'foundation')? 'callout success':'alert alert-success'
    },
    calloutFail:function(){
      return (this.framework == 'foundation')? 'callout alert':'alert alert-danger'
    },
    iconStar: function() {
      return (this.framework == 'foundation' ? 'fi-star ' : 'fa fa-star')
    },
    inputGroupLabel:function(){
      return (this.framework=='foundation')?'input-group-label':'input-group-addon'
    },
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
    // Switch verbage of submit button.
    submitBtnLabel:function(){
      return (this.recordexists)?'Update Email': 'Create Email'
    },
  },

  methods: {
    fetchCurrentEmail: function(recid) {
      this.$http.get('/api/email/' + recid + '/edit')

      .then((response) => {
        this.$set('record', response.data.data)
      }, (response) => {
        this.formErrors = response.data.error.message;
      }).bind(this);
    },

    nowOnReload:function() {
      let newurl = '/admin/emial/'+ this.currentRecordId+'/edit';

      document.location = newurl;
    },

    onRefresh: function() {
      this.recordId = this.currentRecordId;
      this.recordexists = true;
      this.fetchCurrentEmail(this.currentRecordId);
    },

    submitForm: function(e) {
      e.preventDefault(); // Stop form defualt action

      $('html, body').animate({ scrollTop: 0 }, 'fast');

      if (this.sendtimes.length > 0) {
         this.record.sendtimes = this.sendtimes;
      } else {
         this.record.sendtimes = [];
      }

      // Decide route to submit form to
      let method = (this.recordexists) ? 'put' : 'post'
      let route =  (this.recordexists) ? '/api/email/' + this.record.id : '/api/email';

      // Submit form.
      this.$http[method](route, this.record) //

      // Do this when response gets back.
      .then((response) => {
        this.formMessage.msg = response.data.message;
        this.formMessage.isOk = response.ok; // Success message
        this.currentRecordId = response.data.newdata.record_id;
        this.record.id = response.data.newdata.record_id;
        this.formMessage.isErr = false;
        this.recordexists = true;
        this.formErrors = {}; // Clear errors?
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

    delEmail: function(e) {
        e.preventDefault();
        this.formMessage.isOk = false;
        this.formMessage.isErr = false;

        if(confirm('Would you like to delete this email?')==true){
          $('html, body').animate({ scrollTop: 0 }, 'fast');

          this.$http.post('/api/email/'+this.record.id+'/delete')

          .then((response) =>{
              window.location.href = "/admin/email/list";
          }, (response) => {
            console.log('Error: '+JSON.stringify(response))
          }).bind(this);
        }
    },

    delSendtime: function(time) {
        if(confirm('Would you like to delete this send time?')==true){
            this.sendtimes.$remove(time);
        }
    },

    addSendtime: function(){
        this.sendtimes.push({value: '', expertise:''});
    },
/*
    setMainStory: function(storyId){
      this.$http.get('/api/story/' + storyId + '/edit')

      .then((response) => {
        this.$set('mainStory', response.data.data)
      }, (response) => {
        this.formErrors = response.data.error.message;
      }).bind(this);
    },
*/
  },
  watch: {
  },

  filters: {
    truncate: function(text, stop, clamp) {
    	return text.slice(0, stop) + (stop < text.length ? clamp || '...' : '')
    }
  },
  events: {
    // Generated from the EmailStoryPod using the $dispatch property of the vm
    //https://v1.vuejs.org/guide/components.html#Parent-Child-Communication
    'main-story-added': function (mainStoryObj) {
      if(mainStoryObj){
        this.record.mainStory = mainStoryObj // Set the main story for this email
      }
    },
    'main-story-removed': function (mainStoryObj) {
      if(mainStoryObj){
        this.record.mainStory = null
      }
    },
    'other-story-added': function (otherStoryObj) {
      if(otherStoryObj){
        this.record.otherStories.push(otherStoryObj)
      }
    },
    'other-story-removed': function (otherStoryObj) {
      if(otherStoryObj){
        this.record.otherStories.$remove(otherStoryObj)
      }
    },
    'event-added': function (eventObj) {
      if(eventObj){
        this.record.events.push(eventObj)
      }
    },
    'event-removed': function (eventObj) {
      if(eventObj){
        this.record.events.$remove(eventObj)
      }
    },
    'announcement-added': function (announcementObj) {
      if(announcementObj){
        this.record.announcements.push(announcementObj)
      }
    },
    'announcement-removed': function (announcementObj) {
      if(announcementObj){
        this.record.announcements.$remove(announcementObj)
      }
    },
  }
};

</script>
