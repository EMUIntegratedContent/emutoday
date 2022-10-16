<template>
  <form>
    <slot name="csrf"></slot>
    <div class="row">
      <div v-bind:class="md12col">
        <div v-show="formMessage.isOk" :class="calloutSuccess">
          <h5>{{formMessage.msg}}</h5>
        </div>
        <div v-show="formMessage.isErr"  :class="calloutFail">
          <h5>There are errors.</h5>
        </div>
      </div>
      <!-- /.small-12 columns -->
    </div>
    <!-- /.row -->
    <div class="row" style="margin-bottom:10px">
      <div v-bind:class="md6col">
        <p v-if="record.creator">Created by <strong>{{ record.creator.name }}</strong></p>
      </div>
    </div>
    <!-- /.row -->
    <div class="row">
      <div v-bind:class="md6col">
        <div class="form-group">
            <label for="tags">Medium: <span v-bind:class="iconStar" class="reqstar"></span></label>
            <v-select
            :class="[formErrors.medium ? 'invalid-input' : '']"
            :value.sync="record.medium"
            :options="ideaCategoryList"
            :multiple="false"
            placeholder="Choose Medium"
            label="medium">
          </v-select>
          <p v-if="formErrors.medium" class="help-text invalid">{{formErrors.medium}}</p>
        </div><!-- /.form-group -->
      </div>
    </div>
    <!-- /.row -->
    <div class="row">
      <div v-bind:class="md12col">
        <!-- Display Name -->
        <div v-bind:class="formGroup">
          <label>Title <span v-bind:class="iconStar" class="reqstar"></span></label>
          <input v-model="record.title" class="form-control" v-bind:class="[formErrors.title ? 'invalid-input' : '']" name="display_name" type="text">
          <p v-if="formErrors.title" class="help-text invalid">{{formErrors.title}}</p>
        </div>
      </div>
      <!-- /.small-12 columns -->
    </div>
    <!-- /.row -->
    <div class="row">
      <div v-bind:class="md12col">
        <!-- Idea -->
        <div v-bind:class="formGroup">
          <label>What's your idea? <span v-bind:class="iconStar" class="reqstar"></span></label>
          <textarea v-if="hasContent" v-model="record.idea" id="idea" name="idea" v-ckrte="idea" :type="editorType" :idea="idea" :fresh="isFresh" rows="200"></textarea>
          <p v-if="formErrors.idea" class="help-text invalid">Need idea text.</p>
        </div>
      </div>
    </div>
    <!-- /.row -->
    <div class="row">
      <div v-bind:class="md6col">
        <div class="form-group">
            <label for="tags">Assigned to:</label>
            <v-select
            :class="[formErrors.assignee ? 'invalid-input' : '']"
            :value.sync="record.assignee"
            :options="userList"
            :multiple="false"
            placeholder="Assign idea"
            label="name">
          </v-select>
        </div><!-- /.form-group -->
      </div>
      <div :class="md6col">
        <div class="form-group">
          <label for="deadline">Deadline:</label>
          <input id="deadline" :class="[formErrors.deadline ? 'invalid-input' : '']" type="text" v-model="record.deadline.date" aria-describedby="errorDeadline" />
          <p v-if="formErrors.deadline" class="help-text invalid">Need a deadline date</p>
        </div><!--form-group -->
      </div><!-- /.md6col -->
    </div>
   <!-- /.row -->
   <div v-if="recordexists" class="row">
     <div v-bind:class="md4col">
         <!-- Is completed? -->
        <label>Completed? <input type="checkbox" value="1" v-model="record.is_completed"></label>
     </div>
     <!-- /.small-12 columns -->
   </div>
   <!-- /.row -->
    <div class="row">
      <div v-bind:class="md12col">
        <div v-bind:class="formGroup">
          <button v-on:click="submitForm" type="submit" v-bind:class="btnPrimary">{{submitBtnLabel}}</button>
          <button v-if="recordexists" id="btn-delete" v-on:click="delIdea" type="submit" class="redBtn" v-bind:class="btnPrimary">Delete Idea</button>
        </div>
      </div>
    </div>
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
  /*width: 8em*/
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
import moment from 'moment'
import flatpickr from 'flatpickr'
import ckrte from "../directives/ckrte.js"
import vSelect from "vue-select"
import { updateRecordId, updateRecordIsDirty, updateRecordState} from '../vuex/actions'
import { getRecordId, getRecordState, getRecordIsDirty } from '../vuex/getters'
import VuiFlipSwitch from './VuiFlipSwitch.vue'

module.exports = {
  directives: {ckrte,flatpickr},
  components: {vSelect},
  vuex: {
    getters: {
      thisRecordId: getRecordId,
      thisRecordState: getRecordState,
      thisRecordIsDirty: getRecordIsDirty
    },
    actions: {
      updateRecordId,
      updateRecordState,
      updateRecordIsDirty
    }
  },
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
      default: 'foundation'
    },
    type: {
      default: 'general'
    },
    user: {
      default: ''
    },
  },
  data: function() {
    return {
      idea: '',
      ckfullyloaded: false,
      currentDate: {},
      dateObject:{
        deadlineDateMin: '',
        deadlineDateDefault: '',
      },
      deadlineDatePicker:null,
      formErrors: {},
      formInputs: {},
      formMessage: {
        isOk: false,
        isErr: false,
        msg: ''
      },
      hasContent: false,
      ideaCategoryList: [],
      isFresh: true,
      languages: [],
      newform: false,
      previousTitles: [],
      recordState: '',
      record: {
        id: '',
        is_completed: 0,
        idea: '',
        deadline: {
          date: null
        },
        medium: null,
        is_archived: 0,
        title: '',
        assignee: null,
        creator: null,
      },
      recordState: '',
      response: {},
      totalChars: {
        title: 255,
      },
      userList: [],
      userRoles: [],
    }
  },
  created: function () {
    this.currentDate = moment()
    this.recordState = 'created'
  },
  ready: function() {
    if (this.recordexists){
      this.newform = false
      this.fetchCurrentRecord(this.recordid)
    } else {
      this.newform = true
      this.hasContent = true
      this.recordState = 'new'
    }
    this.setupDatePickers()
    this.getUserList()
    this.getUserRoles()
    this.getIdeaCategories()
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
        return true
      } else {
        if (this.userRoles.indexOf('admin_super') != -1) {
          return true
        } else {
          return false
        }
      }
    },
    // Switch verbage of submit button.
    submitBtnLabel:function(){
      return (this.recordexists)?'Update Idea': 'Create Idea'
    },

    editorType:function(){
      if(this.isAdmin){
        return 'admin'
      } else {
        return 'simple'
      }
    },
  },

  methods: {
    checkContentChange: function(){
      if (!this.recordIsDirty) {
        this.recordIsDirty = true
        this.updateRecordIsDirty(true)
      }
    },
    checkOverData: function() {
      this.hasContent = true;
      this.idea = this.record.idea
      this.recordexists = true;
      this.recordState = "edit"
      this.recordIsDirty = false
      this.updateRecordId(this.record.id)
      this.updateRecordIsDirty(false)
      this.setupDatePickers()
    },
    delIdea: function(e) {
        e.preventDefault()
        this.formMessage.isOk = false
        this.formMessage.isErr = false

        if(confirm('Would you like to delete this story idea?')==true){
          $('html, body').animate({ scrollTop: 0 }, 'fast')

          this.$http.delete('/api/storyideas/'+ this.record.id)

          .then((response) =>{
              window.location.href = "/admin/storyideas"
              this.setupDatePickers();
          }, (response) => {
          }).bind(this)
        }
    },
    fetchCurrentRecord: function(recid) {
      this.$http.get('/api/storyideas/' + recid + '/edit')

      .then((response) => {
        this.$set('record', response.data.data)

        this.hasContent = true
        this.idea = this.record.idea
        this.checkOverData()
      }, (response) => {
        this.formErrors = response.data.error.message
      }).bind(this)
    },
    getIdeaCategories(){
      this.$http.get('/api/storyideamedia')

      .then((response) => {
        this.$set('ideaCategoryList', response.data)
      }, (response) => {
        this.formErrors = response.data.error.message
      }).bind(this)
    },
    getUserList(){
      this.$http.get('/api/storyideaassignees')

      .then((response) => {
        this.$set('userList', response.data)
      }, (response) => {
        this.formErrors = response.data.error.message
      }).bind(this)
    },
    getUserRoles(){
      let roles = this.cuserRoles
      let self = this
      this.userRoles = []
      if (roles.length > 0) {
        roles.forEach(function(item,index){
          self.userRoles.push(item.name)
        })
      } else {
        self.userRoles.push('guest')
      }
    },
    nowOnReload:function() {
      let newurl = '/admin/storyideas/'+ this.recordid +'/edit'

      document.location = newurl
    },
    onContentChange: function(){
      if (!this.ckfullyloaded) {
        this.ckfullyloaded = true
      } else {
        this.checkContentChange()
      }
    },
    onRefresh: function() {
      this.updateRecordId(this.record.id)
      this.recordState = 'edit'
      this.recordIsDirty = false

      this.recordId = this.record.id
      this.recordexists = true
      this.fetchCurrentRecord(this.record.id)
    },
    setupDatePickers:function(){
      var self = this;
      if (this.record.deadline == null) {
        this.dateObject.startDateDefault = null;
      } else {
        this.dateObject.deadlineDateDefault = this.record.deadline.date;
      }
      this.deadlineDatePicker = flatpickr(document.getElementById("deadline"), {
        defaultDate: self.dateObject.deadlineDateDefault,
        enableTime: false,
        altInput: true,
        altInputClass: "form-control",
        dateFormat: "Y-m-d",
        onChange(dateObject, dateString) {
          self.record.deadline.date = dateString;
          self.deadlineDatePicker.value = dateString;
        }
      });
    },
    submitForm: function(e) {
      e.preventDefault() // Stop form defualt action

      $('html, body').animate({ scrollTop: 0 }, 'fast')

      this.record.idea = this.idea

      // Decide route to submit form to
      let method = (this.recordexists) ? 'put' : 'post'
      let route =  (this.recordexists) ? '/api/storyideas/' + this.record.id : '/api/storyideas'

      // Submit form.
      this.$http[method](route, this.record) //

      // Do this when response gets back.
      .then((response) => {
        this.formMessage.msg = response.data.message
        this.formMessage.isOk = response.ok // Success message
        this.recordid = response.data.newdata.record_id
        this.record_id = response.data.newdata.record_id
        this.formMessage.isErr = false
        this.recordexists = true
        this.formErrors = {} // Clear errors?
        if (this.newform) {
          this.nowOnReload()
        } else {
          this.onRefresh()
        }
      }, (response) => { // If invalid. error callback
        this.formMessage.isOk = false
        this.formMessage.isErr = true
        // Set errors from validation to vue data
        this.formErrors = response.data.error.message
      }).bind(this)
    },
  },
  watch: {

  },

  filters: {
  },
  events: {
  }
}

</script>
