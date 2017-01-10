<template>
  <form>
    <slot name="csrf"></slot>
    <!-- <slot name="author_id" v-model="newevent.author_id"></slot> -->
    <div class="row">
      <div class="col-md-12">
        <div v-show="formMessage.isOk"  class="alert alert-success alert-dismissible">
          <button @click.prevent="toggleCallout" class="btn btn-sm close"><i class="fa fa-times"></i></button>
          <h5>{{formMessage.msg}}</h5>
        </div>
      </div><!-- /.small-12 columns -->
    </div><!-- /.row -->
    <div class="row">
      <div class="col-md-12">
        <div class="form-group">
          <label>Title <i class="fi-star reqstar"></i></label>
          <p class="help-text" id="title-helptext">Please enter a title</p>
          <input v-model="record.title" v-bind:class="[formErrors.title ? 'invalid-input' : '']"  name="title" type="text">
          <p v-if="formErrors.title" class="help-text invalid">	Please Include a Title!</p>
        </div>
      </div>
    </div><!-- /.row -->
    <div class="row">
      <div class="col-md-12">
        <div class="form-group">
          <label>Slug <i class="fi-star reqstar"></i></label>
          <p class="help-text" id="slug-helptext">Automatic Readable link for sharing and social media</p>
          <input v-model="recordSlug" v-bind:class="[formErrors.slug ? 'invalid-input' : '']"  name="slug" type="text">
          <p v-if="formErrors.slug" class="help-text invalid">needs slug!</p>
        </div>
      </div><!-- /.col-md-12 -->
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="form-group">
          <label>Subtitle</label>
          <p class="help-text" id="subtitle-helptext">Visible in some cases</p>
          <input v-model="record.subtitle" v-bind:class="[formErrors.subtitle ? 'invalid-input' : '']" @blur="onBlur" name="subtitle" type="text">
          <p v-if="formErrors.subtitle" class="help-text invalid"></p>
        </div>
        <div class="form-group">
          <label>Content <i class="fi-star reqstar"></i></label>
          <p class="help-text" id="content-helptext">Enter the story content</p>
          <textarea v-if="hasContent" id="content" name="content" v-ckrte="content" :type="editorType" :content="content" :fresh="isFresh" rows="200"></textarea>
          <p v-if="formErrors.content" class="help-text invalid">Need Content!</p>
        </div>
        <div class="form-group user-display">
          <div class="user-name">Author: {{author.first_name}} {{author.last_name}}</div>
          <div v-if="contact.id != 0"class="user-info">Contact: {{contact.first_name}} {{contact.last_name}}, {{contact.email}}, {{contact.phone}}</div>
          <div v-if="contact.id == 0" class="user-info">Contact: {{defaultcontact.first_name}} {{defaultcontact.last_name}}, {{defaultcontact.email}}, {{defaultcontact.phone}}</div>
        </div><!-- /.frm-group -->
      </div><!-- /.small-12 columns -->
    </div><!-- /.row -->
    <div class="row">
      <div class="col-md-12">
        <div v-show="saveAuthorMessage.isOk"  class="alert alert-success alert-dismissible">
          <button @click.prevent="toggleCallout" class="btn btn-sm close"><i class="fa fa-times"></i></button>
          <h5>{{saveAuthorMessage.msg}}</h5>
        </div>
        <a v-if="!needAuthor" @click.prevent="changeAuthor" href="#" class="btn btn-primary btn-sm">Change Author</a>
        <a v-if="hasAuthor" @click.prevent="resetAuthor" href="#" class="btn btn-primary btn-sm">Reset Author</a>
        <a @click.prevent="changeContact" href="#" class="btn btn-primary btn-sm">Change Contact</a>
        <div v-if="needAuthor && isAdmin" class="form-inline author">
            <label>Choose existing Author:</label>
            <v-select
            :value.sync="selectedAuthor"
            :options="optionsAuthorlist"
            :multiple="false"
            placeholder="Author (leaving this blank will set you as the author)"
            label="name"> </v-select>
        </div>
        <div v-if="needAuthor" class="form-inline author">
          <div class="form-group">
            <label for="author-first-name">First Name <span v-if="authorErrors.first_name" class="help-text invalid"> is Required</span></label>
            <input v-model="author.first_name" type="text" class="form-control input-sm" id="author-last-name" placeholder="First Name">
          </div>
          <div class="form-group">
            <label for="author-last-name">Last Name</label>
            <input v-model="author.last_name" type="text" class="form-control input-sm" id="author-last-name" placeholder="Last Name">
          </div>
          <div class="form-group">
            <label for="author-email">Email</label>
            <input v-model="author.email" type="email" class="form-control input-sm" id="author-email" placeholder="author@emich.edu">
          </div>
          <div class="form-group">
            <label for="author-phone">Phone</label>
            <input v-model="author.phone" type="phone" class="form-control input-sm" id="author-phone" placeholder="(313)-555-1212">
          </div>
          <div class="form-group save-author">
            <button @click.prevent="saveAuthor" href="#" class="btn btn-primary btn-sm">{{authorBtnLabel}}</button>
          </div><!-- /.form-group -->
        </div>
      </div><!-- /.col-md-12 -->
    </div><!-- /.row -->
    <div class="row">
      <div class="col-md-6">
        <div v-if="isAdmin && needContact" class="form-inline author">
            <label>Story contact:</label>
            <v-select
            :value.sync="selectedContact"
            :options="optionsContactlist"
            :multiple="false"
            placeholder="Contact (leaving this blank will set the system default as the contact)"
            label="name"> </v-select>
        </div>
      </div><!-- /.col-md-6 -->
    </div>
    <div class="row">
      <div class="col-md-6">
        <div class="form-group">
          <label for="start-date">Start Date: <i class="fi-star reqstar"></i></label>
          <input v-if="fdate" type="text" :value="fdate" :initval="fdate"  v-flatpickr="fdate">
          <p>NOTE: For external story with "video" tag, treat this field as the END Date.</p>
          <p v-if="formErrors.start_date" class="help-text invalid">Need a Start Date</p>
        </div><!--form-group -->
      </div><!-- /.small-6 columns -->
      <div class="col-md-6">
        <div v-if="isAdmin" class="form-group">
          <label for="tags">Tags:</label>
          <v-select
          :class="[formErrors.tags ? 'invalid-input' : '']"
          :value.sync="tags"
          :options="taglist"
          :multiple="true"
          placeholder="Select tags"
          label="name">
        </v-select>

      </div><!-- /.form-group -->
    </div><!-- /.small-6 columns -->
  </div><!-- /.row -->
  <div class="row">
    <div class="col-md-6">
      <!-- <div class="form-group">
      RecordID:{{thisRecordId}} thisRecordState:{{thisRecordState}} thisRecordIsDirty:{{thisRecordIsDirty}}
    </div> -->
  </div><!-- /.col-md-6-->
  <div class="col-md-6">
    <!-- <div class="form-group pull-right">
    {{record | json}}
  </div> -->
</div><!-- /.col-md-12 -->
</div><!-- /.row -->
<div class="row">
  <div class="col-md-6">
    <template v-if="singleStype">
      <input v-model="record.story_type" :value="s_types" type="text" disabled="disabled" />
    </template>
    <template v-else>
      <label>Story Type</label>
      <select v-model="record.story_type">
        <option v-for="stype in s_types" v-bind:value="stype.shortname" selected="{{ stype.shortname == 'news' }}">
          {{ stype.name }}
        </option>
      </select>
    </template>

    <!-- <div class="form-group pull-right">
    {{record | json}}
  </div> -->
</div><!-- /.col-md-6 -->

<div class="col-md-6">

</div><!-- /.col-md-6 -->
</div><!-- /.row -->
<div class="row">


  <div class="col-md-12">
    <div class="form-group">
      <button v-on:click="submitForm" type="submit" class="btn btn-primary">{{submitBtnLabel}}</button>
    </div>
  </div><!-- /.column -->
</div>
</form>
</template>
<style scoped>
p {
  margin:0;
}
label {
  display: block;
  /*margin-bottom: 1.5em;*/
}

label > span {
  display: inline-block;
  width: 8em;
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
.user-display {
  color: #666;
  font-size: 16px;
}
.user-display .user-name {

  font-style: italic;
}
.user-display .user-info {
  font-size: 14px;
}

fieldset label.radiobtns  {
  display: inline;
  margin: 4px;
  padding: 2px;
}

[type='text'], [type='password'], [type='date'], [type='datetime'], [type='datetime-local'], [type='month'], [type='week'], [type='email'], [type='number'], [type='search'], [type='tel'], [type='time'], [type='url'], [type='color'],
textarea {
  margin: 0;
  padding: 0;
  padding-left: 8px;
  width: 100%;
}
[type='file'], [type='checkbox'], [type='radio'] {
  margin: 0;
  margin-left: 8px;
  padding: 0;
  padding-left: 2px;
}
.reqstar {
  font-size: .5rem;
  color: #E33100;
  vertical-align:text-top;
}

button.button-primary{
  margin-top: 1rem;
}

.form-group{
  margin-bottom: 5px;
}

.callout {
  margin-bottom: 8px;
  padding: 8px 30px 8px 15px;
}
.save-author {
  vertical-align: bottom;
}
</style>

<script>
// var moment = require('moment')
import moment from 'moment'
import vSelect from "vue-select"
import ckrte from "../directives/ckrte.js"
import flatpickr from "../directives/flatpickr.js"
import { updateRecordId, updateRecordIsDirty, updateRecordState} from '../vuex/actions'
import { getRecordId, getRecordState, getRecordIsDirty } from '../vuex/getters'
// import flatpickr from 'flatpickr';
module.exports  = {
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
  props:{
    cuser: {default: {}},
    recordexists: {default: false},
    editid: {default: ''},
    stypes: {default: {}},
    gtype:{default: ''},
    qtype:{default: ''},
    stype:{default: ''},
  },
  data: function() {
    return {
      tags:[],
      taglist:[],
      selectedAuthor:null,
      selectedContact:null,
      newform: false,
      response_record_id:'',
      response_stype: '',
      singleStype:'',
      ckfullyloaded: false,
      currentRecordId: null,
      currentUser: {
        id: this.cuser.id,
        last_name: this.cuser.last_name,
        first_name: this.cuser.first_name,
        email: this.cuser.email,
        phone: this.cuser.phone
      },
      userRoles: [],
      needAuthor: false,
      hasAuthor:false,
      needContact: false,
      contactManuallyChanged: false,
      authorlist:[],
      author: {
        id: 0,
        last_name: '',
        first_name: '',
        email: '',
        phone: ''
      },
      authorNew: {
        id: 0,
        last_name: '',
        first_name: '',
        email: '',
        phone: ''
      },
      contactlist:[],
      contact: {
        id: 0,
        last_name: '',
        first_name: '',
        email: '',
        phone: ''
      },
      defaultcontact: {
        id: 0,
        last_name: '',
        first_name: '',
        email: '',
        phone: ''
      },
      hasContent: false,
      isFresh: true,
      content: '',
      startdatePicker: null,
      date: {},
      currentDate: {},
      recordState: '',
      recordOld: {
        id: '',
        user_id: '',
        title: '',
        story_type: '',
        content: '',
        start_date: '',
        contact: '',
      },
      record: {
        id: '',
        user_id: '',
        title: '',
        story_type: '',
        content: '',
        start_date: '',
        contact: '',
        tags: []
      },
      fdate: null,
      dateOptions: {
        minDate: "today",
        enableTime: false,
        altFormat: "m-d-Y",
        altInput: true,
        altInputClass:"form-control",
        dateFormat: "Y-m-d",
      },

      response: {

      },
      formMessage: {
        isOk: false,
        msg: ''
      },
      saveAuthorMessage: {
        isOk: false,
        msg: ''
      },
      formInputs : {},
      formErrors : {},
      authorErrors : {}
    }
  },
  created: function () {
    this.currentDate = moment();
    this.recordState = 'created';
  },
  ready() {
    if (this.recordexists){
      this.currentRecordId = this.editid;
      console.log('this.recordId >>>>'+     this.currentRecordId );
      this.singleStype = true;
      this.newform = false;
      // this.record.user_id = this.cuser.id;
      this.fetchCurrentRecord();
    } else {
      this.newform = true;
      this.hasContent = true;
      this.record.user_id = this.cuser.id;
      console.log('tthis.record.user_id'+     this.record.user_id);

      this.fdate = this.currentDate;

      this.author = this.currentUser;
      this.author.id = 0;
      this.record.author_id = 0;
      this.recordState = 'new';
    }
    this.fetchTagsList();
    this.fetchCurrentTags();
    this.getUserRoles();
    this.fetchDefaultContact()
  },
  computed: {
    authorBtnLabel:function(){
      return (this.hasAuthor) ? 'Update Author' : 'New Author';
    },
    optionsAuthorlist:function(){
      return this.authorlist;
    },
    optionsContactlist:function(){
      return this.contactlist;
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
    editorType:function(){
      if(this.isAdmin){
        return 'admin'
      } else {
        return 'simple'
      }
    },
    s_types:function(){
      // var data = localStorage[key];
      try {
        this.singleStype = false;
        return JSON.parse(this.stypes);
      } catch(e) {
        this.singleStype = true;
        // this.record.story_type = this.stypes;
        return this.stypes;
      }
    },
    submitBtnLabel: function() {
      return (this.recordexists)? 'Update Story' : 'Save Story';
    },
    hasLocalRecordChanged: function() {
      var ckval = false
      if (this.recordOld.title !== this.record.title){
        ckval = true
      }

      if (this.recordOld.content !== this.content ) {
        ckval = true
      }

      if (ckval) {
        this.updateRecordIsDirty(true)

      }
      return ckval
    },
    hasAuthor:function() {
      if (this.record.author_id === 0){
        return false;
      } else {
        return true;
      }
    },
    recordSlug: function(){
      if(this.record.title){
        return  this.record.title.toLowerCase().replace(/[^a-z0-9-]+/g, '-').replace(/^-+|-+$/g, '')

      }
    },
    hasStartDate: function () {
      if (this.record.start_date === undefined || this.record.start_date == '') {
        return false
      } else {
        return true
      }

    }
  },
  methods: {
    getUserRoles(){
      let roles = this.cuser.roles;
      let self = this;
      this.userRoles = [];
      if (roles.length > 0) {
        roles.forEach(function(item,index){
          self.userRoles.push(item.name);
        })
      } else {
        self.userRoles.push('guest');
      }

      console.log('userRoles===='+ this.userRoles)

    },

    nowOnReload:function() {

      //   {qtype}/{gtype}/{stype}/{story}/edit'
      let newurl = '/admin/' + this.qtype + '/'+this.gtype+'/'+ this.response_stype +'/'+ this.response_record_id+'/edit';

      //   let newurl = '/admin/story/' + this.response_stype +'/'+ this.response_record_id+'/edit';
      console.log(newurl);
      document.location = newurl;
    },

    onRefresh: function() {


      this.updateRecordId(this.currentRecordId);
      this.recordState = 'edit';
      this.recordIsDirty = false;
      //   this.updateRecordState('edit');
      this.recordId = this.currentRecordId;
      this.recordexists = true;
      this.fetchCurrentRecord();
    },
    oldRefresh:function() {
      this.$set('recordOld', this.record);
      this.$nextTick(function() {
        console.log('nextTick')
      });
    },
    changeAuthor:function(evt) {
      this.fetchAuthorList();
      this.saveAuthorMessage.isOk = '';
      if (this.record.author_id == 0 ){
        this.author = this.authorNew;
      }
      this.needAuthor = true;
      this.hasAuthor = true;
    },
    resetAuthor:function(evt){
      if (this.record.author_id !== 0 ){
        this.author = this.currentUser;
        this.author.id = 0;
        this.record.author_id = 0;
      }
      this.needAuthor = false;
      this.hasAuthor = true;
      this.saveAuthorMessage.isOk = '';
    },
    changeContact:function(evt) {
      this.fetchContactList();
      this.needContact = true;
      this.contactManuallyChanged = true;
    },
    toggleCallout:function(evt){
      this.formMessage.isOk = false
      this.saveAuthorMessage.isOk = false
    },

    onBlur: function(evt){
      if (!this.recordIsDirty) {
        this.recordIsDirty = true
        this.updateRecordIsDirty(true);
      }
      console.log('blur')
    },
    onCalendarChange: function(){
      this.checkContentChange();
      console.log('cal change')
    },
    onContentChange: function(){
      if (!this.ckfullyloaded) {
        this.ckfullyloaded = true
      } else {
        this.checkContentChange();
      }
      console.log('content change')
    },
    checkContentChange: function(){
      if (!this.recordIsDirty) {
        this.recordIsDirty = true
        this.updateRecordIsDirty(true);
      }
      console.log('checkContentChange')
    },
    jsonEquals: function(a,b) {
      return JSON.stringify(a) === JSON.stringify(b);
    },

    fetchAuthorList: function() {
      console.log('author list fetch');
      this.$http.get('/api/authorlist')
      .then((response) =>{
        this.$set('authorlist', response.data)
      }, (response) => {
        //error callback
        console.log("ERRORS");
      }).bind(this);
    },

    fetchContactList: function() {
      console.log('contact list fetch');
      this.$http.get('/api/contactlist')
      .then((response) =>{
        this.$set('contactlist', response.data)
      }, (response) => {
        //error callback
        console.log("ERRORS");
      }).bind(this);
    },

    fetchDefaultContact: function() {
      this.$http.get('/api/contactdefault')
      .then((response) =>{
        this.$set('defaultcontact', response.data)
        this.$set('contact', response.data)
      }, (response) => {
        //error callback
        console.log("COULDN'T GET DEFAULT CONTACT");
      }).bind(this);
    },

    fetchDefaultMagazineContact: function() {
      this.$http.get('/api/contactmagazinedefault')
      .then((response) =>{
        this.$set('defaultcontact', response.data)
        this.$set('contact', response.data)
      }, (response) => {
        //error callback
        console.log("COULDN'T GET DEFAULT MAGAZINE CONTACT");
      }).bind(this);
    },

    // Fetch the tags that match THIS record
    fetchTagsList: function() {
        this.$http.get('/api/taglist/')
          .then((response) =>{
            console.log(response.data);
            this.$set('taglist', response.data);
        });
    },

    fetchCurrentTags(){
        this.$http.get('/api/taglist/'+ this.currentRecordId)
            .then((response) => {
                console.log(response.data);
                this.$set('tags', response.data);
            }, (response) => {

            });
    },

    fetchCurrentRecord: function() {

      this.$http.get('/api/story/'+ this.currentRecordId +'/edit')


      .then((response) =>{
        this.$set('record', response.data.data)
        this.$set('recordOld', response.data.data)
        console.log("CURRENT CONTACT")
        console.log(response.data.data.contact)

        //set contact information
        this.contact.id = response.data.data.contact.id
        this.contact.first_name = response.data.data.contact.first_name
        this.contact.last_name = response.data.data.contact.last_name
        this.contact.email = response.data.data.contact.email
        this.contact.phone = response.data.data.contact.phone

        this.checkOverData();
      }, (response) => {
        //error callback
        console.log("ERRORS");

        this.formErrors =  response.data.error.message;

      }).bind(this);

    },
    checkOverData: function() {
      this.hasContent = true;

      this.currentRecordId = this.record.id;
      this.content = this.record.content;

      this.fdate = this.record.start_date;
      console.log('this.fdate'+ this.fdate)
      if (this.record.author_id != 0) {
        this.author = this.record.author;
      } else {
        this.author = this.currentUser;
        this.author.id = 0;
      }
      this.recordexists = true;

      this.recordState = "edit"
      this.recordIsDirty = false;
      this.updateRecordId(this.currentRecordId);
      this.updateRecordIsDirty(false);
    },

    saveAuthor: function(e) {
      e.preventDefault();
      this.saveAuthorMessage.isOk = '';
      console.log('rec.author_id:'+this.author.id);
      let method = (this.author.id == 0) ? 'post' : 'put'
      let route =  (this.author.id == 0) ? '/api/author':'/api/author/' + this.author.id ;

      this.$http[method](route, this.author)

      .then((response) =>{
        this.authorErrors = '';
        this.fetchAuthorList();
        console.log('response.author=' + JSON.stringify(response.data.newdata));

        this.author.id = response.data.newdata.author.id;
        this.record.author_id = response.data.newdata.author.id;
        console.log('rec.author_id:'+this.author.id);
        this.author.first_name = response.data.newdata.author.first_name;
        this.author.last_name = response.data.newdata.author.last_name;
        this.author.phone = response.data.newdata.author.phone;
        this.author.email = response.data.newdata.author.email;

        this.saveAuthorMessage.msg = response.data.message;
        this.saveAuthorMessage.isOk = response.ok;
        this.needAuthor = false;

      }, (response) => {
        //error callback
        this.authorErrors =  response.data.error.message;
      }).bind(this);
    },
    fetchAuthor: function(){
      if(this.selectedAuthor){
        this.$http.get('/api/author/'+this.selectedAuthor.value)

        .then(
          (response) => {
              this.author.id = response.body.id;
              this.record.author_id = response.body.id;
              this.author.first_name = response.body.first_name;
              this.author.last_name = response.body.last_name;
              this.author.phone = response.body.phone;
              this.author.email = response.body.email;
          },
          (response) => {
              //err
          }
        )

        .bind(this);
      } else {
            this.author.id = '';
            this.record.author_id = '';
            this.author.first_name = '';
            this.author.last_name = '';
            this.author.phone = '';
            this.author.email = '';
      }
    },
    fetchContact: function(){
      if(this.selectedContact){
        this.$http.get('/api/author/'+this.selectedContact.value)

        .then(
          (response) => {
              this.contact.id = response.body.id;
              this.record.contact_id = response.body.id;
              this.contact.first_name = response.body.first_name;
              this.contact.last_name = response.body.last_name;
              this.contact.phone = response.body.phone;
              this.contact.email = response.body.email;
          },
          (response) => {
              //err
          }
        )

        .bind(this);
      } else {
            this.contact.id = '';
            this.record.contact_id = '';
            this.contact.first_name = '';
            this.contact.last_name = '';
            this.contact.phone = '';
            this.contact.email = '';
      }
    },
    ahhh: function(){
      console.log('author',this.authors, this.authorlist)
      console.log('tag',this.tags, this.taglist)
    },

    submitForm: function(e) {
      e.preventDefault();
      this.formMessage.isOk = '';
      this.record.user_id = this.cuser.id;
      if(this.record.story_type === 'external'){
        this.record.content = 'not used';
      } else {
        this.record.content = this.content;
      }
      if (this.tags.length > 0) {
         this.record.tags = this.tags;
      } else {
         this.record.tags = [];
      }

      this.record.slug = this.recordSlug;
      if (moment(this.fdate).isValid()){
        this.record.start_date = this.fdate;
      }

      if (this.author.id !== 0) {
        this.record.author_id = this.author.id;
      }

      if (this.contact.id !== 0) {
        this.record.contact_id = this.contact.id;
      }

      let tempid;
      if (typeof this.currentRecordId != 'undefined'){
        tempid = this.currentRecordId;
      } else {
        tempid =this.record.id;
      }
      console.log('tempid'+tempid);
      console.log('this.recordexists'+this.recordexists);
      let method = (this.recordexists) ? 'put' : 'post'
      let route =  (this.recordexists) ? '/api/story/' + tempid : '/api/story';

      this.$http[method](route, this.record)

      .then((response) =>{

        this.formMessage.msg = response.data.message;
        this.currentRecordId = response.data.newdata.record_id;
        this.formMessage.isOk = response.ok;
        this.formErrors = '';

        console.log('newdta'+response.data.newdata.record_id);
        this.response_record_id = response.data.newdata.record_id;
        this.response_stype = response.data.newdata.stype;
        if (this.newform) {
          this.nowOnReload();
        } else {
          this.onRefresh();
        }
      }, (response) => {
        //error callback
        this.formErrors =  response.data.error.message;
      }).bind(this);
    }
  },
  filters: {
    momentstart: {
      read: function(val) {
        console.log('read-val'+ val )

        return 	val ?  val : '';
      },
      write: function(val, oldVal) {
        console.log('write-val'+ val + '--'+ oldVal)
        return moment(val).format('MM-DD-YYYY');
      }
    },
    momentfilter: {
      read: function(val) {
        console.log('read-val'+ val )

        return 	val ?  moment(val).format('MM-DD-YYYY') : '';
      },
      write: function(val, oldVal) {
        console.log('write-val'+ val + '--'+ oldVal)

        return moment(val).format('YYYY-MM-DD');
      }
    },
  },
  watch: {
    selectedAuthor: function(){
      // console.log(this.selectedAuthor);
      this.fetchAuthor();
      this.hasAuthor = false;
    },
    selectedContact: function(){
      // console.log(this.selectedAuthor);
      this.fetchContact();
      this.hasAuthor = false;
    },
    'record.story_type': function(val){
        // If this is a new story and it's going to be a magazine article, set the default magazine contact as the contact.
        if(!this.contactManuallyChanged){
            if(!this.record.contact){
                if(val == 'article'){
                    this.fetchDefaultMagazineContact()
                } else {
                    this.fetchDefaultContact()
                }
            }
        }
    }
  },
  events: {

  }
};


</script>
