<template>
  <form>
    <slot name="csrf"></slot>
    <div class="row">
      <div v-bind:class="md8col">
        <div class="progress">
          <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;">
            60%
          </div>
        </div>
        <template v-if="mainStory">
          {{mainStory.title}}
        </template>

      </div>
      <!-- /.medium-8 columns -->
      <div v-bind:class="md4col">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
          <li class="active"><a href="#stories" role="tab" data-toggle="tab">Main Story</a></li>
          <li><a href="#events" role="tab" data-toggle="tab">Events</a></li>
          <li><a href="#announcements" role="tab" data-toggle="tab">Announcements</a></li>
        </ul>
        <!-- Tab panes -->
        <div class="tab-content">
          <div class="tab-pane active" id="stories">
            <email-story-queue
            :stypes="stypes"
            :main-story="mainStory"
            ></email-story-queue>
          </div>
          <div class="tab-pane" id="events">
            <!--<events-email-queue></events-email-queue>-->
          </div>
          <div class="tab-pane" id="announcements">
            <!--<announcements-email-queue></announcements-email-queue>-->
        </div>
      </div>
      <!-- /.medium-4 columns -->
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
</template>

<style scoped>
.redBtn {
  background: hsl(0, 90%, 70%);
}
.dynamic-list-item{
    margin: 5px 0px 10px 0px !important;
}
.dynamic-list-btn{
    margin-top: -4px !important;
}
.social-list-item{
    margin: 2px 0px 2px 0px !important;
}
.social-list-btn{
    margin-top: 26px !important;
}
p {
  margin: 0;
}

label {
  margin-top: 3px;
  margin-bottom: 3px;
  display: block;
  /*margin-bottom: 1.5em;*/
}

label > span {
  display: inline-block;
  /*width: 8em;*/
  vertical-align: top;
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

.invalid {
  color: #ff0000;
}

fieldset label.radiobtns {
  display: inline;
  margin: 4px;
  padding: 2px;
}

.reqstar {
  font-size: .6rem;
  color: #E33100;
  vertical-align: text-top;
}

button.button-primary {
  margin-top: 0.8rem;
}

select {
  margin: 0;
}

[type='submit'],
[type='button'] {
  margin-top: 0;
}

input[type="number"] {
  margin: 0;
}

input[type="text"] {
  margin: 0;
}

h5.form-control {
  margin: 0;
  display: block;
  width: 100%;
  height: 2.4375rem;
  padding: .5rem;
  font-size: 14px;
  line-height: 1.42857143;
  color: #222222;
  background-color: #fff;
  background-image: none;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
  transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
}
</style>


<script>
import moment from 'moment';
import flatpickr from 'flatpickr';
import vSelect from "vue-select";
import VuiFlipSwitch from '../VuiFlipSwitch.vue'
import EmailStoryQueue from './EmailStoryQueue.vue'
import VueDraggable from 'vuedraggable'

module.exports = {
  directives: {flatpickr},
  components: {EmailStoryQueue, vSelect},
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
      mainStory: {},
      newform: false,
      recordState: '',
      record: {
        id: '',
        sendtimes: [],
        mainStoryId: null,
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

    displayMainStory: function(storyId){
      this.$http.get('/api/story/' + storyId + '/edit')

      .then((response) => {
        this.$set('mainStory', response.data.data)
      }, (response) => {
        this.formErrors = response.data.error.message;
      }).bind(this);
    },
  },
  watch: {
  },

  filters: {
  },
  events: {
    // Generated from the EmailStoryPod using the $dispatch property of the vm
    //https://v1.vuejs.org/guide/components.html#Parent-Child-Communication
    'main-story-selected': function (mainStoryId) {
      if(mainStoryId){
        this.record.mainStoryId = mainStoryId // Set the main story ID for this email
        // Fetch the story for display in the builder
        this.displayMainStory(this.record.mainStoryId)
      } else {
        this.record.mainStoryId = null
        this.mainStory = {}
      }
    }
  }
};

</script>
