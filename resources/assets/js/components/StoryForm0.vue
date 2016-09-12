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
                    <p class="help-text" id="subtitle-helptext">Visibible in some cases</p>
                    <input v-model="record.subtitle" v-bind:class="[formErrors.subtitle ? 'invalid-input' : '']" @blur="onBlur" name="subtitle" type="text">
                    <p v-if="formErrors.subtitle" class="help-text invalid"></p>
                </div>
                <div class="form-group">
                    <label>Content <i class="fi-star reqstar"></i></label>
                    <p class="help-text" id="content-helptext">Enter the story content</p>
                    <textarea v-if="hasContent" id="content" name="content" v-ckrte="content" :content="content" :fresh="isFresh" rows="200"></textarea>
                    <p v-if="formErrors.content" class="help-text invalid">Need Content!</p>
                </div>
                <div class="form-group user-display">
                    <div class="user-name">{{author.first_name}} {{author.last_name}}</div>
                    <div class="user-info">Contact {{author.first_name}} {{author.last_name}}, {{author.email}}, {{author.phone}}</div>
                </div><!-- /.frm-group -->
            </div><!-- /.small-12 columns -->
        </div><!-- /.row -->
        <div class="row">
            <div class="col-md-12">
                <a v-if="!needAuthor" @click.prevent="changeAuthor" href="#" class="btn btn-primary btn-sm">Change Author</a>
                <a v-if="hasAuthor" @click.prevent="resetAuthor" href="#" class="btn btn-primary btn-sm">Reset Author</a>
                <div v-if="needAuthor" class="form-inline author">
                    <div class="form-group">
                        <label for="author-last-name">Last Name</label>
                        <input v-model="author.last_name" type="text" class="form-control input-sm" id="author-last-name" placeholder="Last Name">
                    </div>
                    <div class="form-group">
                        <label for="author-first-name">First Name</label>
                        <input v-model="author.first_name" type="text" class="form-control input-sm" id="author-last-name" placeholder="First Name">
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
                        <button @click.prevent="saveAuthor" href="#" class="btn btn-warning btn-sm">Save Author</button>
                    </div>
                </div>
            </div><!-- /.col-md-12 -->
        </div><!-- /.row -->
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="start-date">Start Date: <i class="fi-star reqstar"></i></label>
                    <input v-if="fdate" type="text" :value="fdate" :initval="fdate"  v-flatpickr="fdate">
                    <p v-if="formErrors.start_date" class="help-text invalid">Need a Start Date</p>
                </div><!--form-group -->
            </div><!-- /.small-6 columns -->
            <div class="col-md-6">
                <div v-if="isAdmin" class="form-group">
                    <label>Tags:</label>
                    <v-select
                    :class="[formErrors.tags ? 'invalid-input' : '']"
                        :value.sync="tags"
                        :options="optionsTaglist"
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
                            <option v-for="stype in s_types" v-bind:value="stype.shortname">
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
                        // updateRecordId: ({ dispatch }, value) => {
                        //     dispatch('RECORD_ID', value)
                        // },
                        // updateRecordState: ({dispatch}, value) => {
                        //     dispatch('RECORD_STATE', value)
                        // },
                        // updateRecordIsDirty: ({dispatch}, value) => {
                        //     dispatch('RECORD_IS_DIRTY', value)
                        // }
                    }
                },
                props:{
                    cuser: {default: {}},
                    recordexists: {default: false},
                    editid: {default: ''},
                    stypes: {default: {}}
                    // stypelist: {},
                    // stypelist1: {},
                    // stypelist2: {}
                    // storytype1: {default: {}},
                    // storytype: {default: {}}
                },
                data: function() {
                return {
                    tags:[],
                    taglist:[],
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
                    hasAuthor: false,
                    author: {
                        id: 0,
                        last_name: '',
                        first_name: '',
                        email: '',
                        phone: ''
                    },
                    authorNew: {
                        id: 0,
                        last_name: 'LastName',
                        first_name: 'FirstName',
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
                        start_date: ''
                    },
                    record: {
                        id: '',
                        user_id: '',
                        title: '',
                        story_type: '',
                        content: '',
                        start_date: ''
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
                  formInputs : {},
                  formErrors : {}
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

                      //this.stype_list = this.storytype;
                      //this.record.story_type = this.storytype;
                      this.fdate = this.currentDate;

                      this.author = this.currentUser;
                      this.author.id = 0;
                      this.record.author_id = 0;
                      this.recordState = 'new';
                  }
                  this.fetchTagsList();
                  this.getUserRoles();
              },
              computed: {
                  optionsTaglist:function(){
                      return this.taglist;
                  },
                  isAdmin:function(){
                      return (this.userRoles.indexOf('admin') != -1)?true:false;
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
                  formatTagsForRecord(val){
                      console.log(JSON.stringify(val))
                      this.record.tags = val.map(function(item,index){
                          return item.id;
                      })
                      console.log('this.record.tags= '+ this.record.tags)
                  },
                  nowOnReload:function() {
                      let newurl = '/admin/story/' + this.response_stype +'/'+ this.response_record_id+'/edit';
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
                      if (this.record.author_id == 0 ){
                           this.author = this.authorNew;
                      }
                      this.needAuthor = true;
                  },
                  resetAuthor:function(evt){
                      if (this.record.author_id !== 0 ){
                           this.author = this.currentUser;
                           this.author.id = 0;
                           this.record.author_id = 0;
                      }
                     // this.needAuthor = true;
                  },
                  toggleCallout:function(evt){
                     this.formMessage.isOk = false
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
                //   fetchForSelectTagsList(){
                //       loading(true)
                //       this.$http.get('/api/taglist',{
                //           q: search
                //       }).then(resp => {
                //           this.tags = resp.data;
                //           loading(false)
                //       })
                //   },

                  fetchTagsList: function() {

                      this.$http.get('/api/taglist')
                          .then((response) =>{
                            //   let taglistraw = response.data;
                            //   let taglistformat = this.foreachTagListRaw(response.data);


                                  this.$set('taglist', response.data)
                              }, (response) => {
                                  //error callback
                                  console.log("ERRORS");
                                  this.formErrors =  response.data.error.message;

                              }).bind(this);
                  },
                //   foreachTagListRaw: function(myarray) {
                //       let newarray = [];
                //       myarray.forEach(function(item,index){
                //           let tobject = {};
                //           tobject.name = item.name;
                //           tobject.value = item.id;
                  //
                //           newarray.push(tobject);
                //       });
                  //
                //       return newarray;
                  //
                //   },
                    fetchCurrentRecord: function() {

                        this.$http.get('/api/story/'+ this.currentRecordId +'/edit')

                            .then((response) =>{
                                    //response.status;
                                    // console.log('response.status=' + response.status);
                                    // console.log('response.ok=' + response.ok);
                                    // console.log('response.statusText=' + response.statusText);
                                    // console.log('response.data=' + response.data);
                                    // data = response.data;
                                    this.$set('record', response.data.data)
                                    this.$set('recordOld', response.data.data)
                                    // this.record = response.data.data;
                                    // console.log('this.record= ' + this.record);

                                    this.checkOverData();
                                }, (response) => {
                                    //error callback
                                    console.log("ERRORS");

                                     this.formErrors =  response.data.error.message;

                                }).bind(this);
                    },
                    checkOverData: function() {
                            this.hasContent = true;
                            // console.log('this.record'+ this.record.id)
                            this.currentRecordId = this.record.id;
                            this.content = this.record.content;
                            // console.log('this.record.start_date='+ this.record.start_date)
                            if (this.record.tags){
                                
                                this.tags = this.record.tags;
                                this.record.tags = null;
                            }

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
                            // this.updateRecordState("edit");
                            this.recordIsDirty = false;
                            this.updateRecordId(this.currentRecordId);
                            this.updateRecordIsDirty(false);
                    },

                    saveAuthor: function(e) {
                        e.preventDefault();
                        let method = (this.record.author_id == 0) ? 'post' : 'put'
                  let route =  (this.record.author_id == 0) ? '/api/author/':'/api/author/' + this.record.author_id ;

                //   this.$http.post('/api/story', this.record)
                  this.$http[method](route, this.author)

                            .then((response) =>{
                                    //response.status;
                                    console.log('response.status=' + response.status);
                                    console.log('response.ok=' + response.ok);
                                    console.log('response.statusText=' + response.statusText);
                                 console.log('response.data=' + response.data.message);

                                // this.formMessage.msg = response.data.message;
                                 this.author = response.data.author;
                                // this.formMessage.isOk = response.ok;
                                 this.needAuthor = false;
                                //this.onRefresh();

                                }, (response) => {
                                    //error callback
                                    //this.formErrors =  response.data.error.message;
                                }).bind(this);
                    },
                    submitForm: function(e) {
                    //  console.log('this.eventform=' + this.eventform.$valid);
                        e.preventDefault();
                  // this.newevent.start_date = this.sdate;
                  // this.newevent.end_date = this.edate;
                  // this.newevent.reg_deadline = this.rdate;
                  this.record.user_id = this.cuser.id;
                 // this.record.user_id = this.currentUser.id;
                 if(this.record.story_type === 'external'){
                     this.record.content = 'not used';
                 } else {
                     this.record.content = this.content;
                 }
                 if (this.tags.length > 0) {
                     this.record.tags = this.tags;
                 }


                  //   this.record.story_type = this.storytype;
                  this.record.slug = this.recordSlug;
                  if (moment(this.fdate).isValid()){
                      this.record.start_date = this.fdate;
                  }
                //this.record.start_date = this.fdate;
                //   this.record.start_date =  moment(this.fdate,"MM-DD-YYYY").format("YYYY-MM-DD HH:mm:ss");
                if (this.author.id !== 0) {
                    this.record.author_id = this.author.id;
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
                  let route =  (this.recordexists) ? '/api/story/' + tempid : '/api/story/';

                //   this.$http.post('/api/story', this.record)
                  this.$http[method](route, this.record)

                            .then((response) =>{
                                    //response.status;
                                    // console.log('response.status=' + response.status);
                                    // console.log('response.ok=' + response.ok);
                                    // console.log('response.statusText=' + response.statusText);
                                    // console.log('response.data=' + response.data.message);

                                 this.formMessage.msg = response.data.message;
                                this.currentRecordId = response.data.newdata.record_id;
                                 this.formMessage.isOk = response.ok;
                                //  console.log('goooooo'+response.newdata.record_id);
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
                      //   'recordState': function(val,oldVal) {
                      //       console.log('new: %s, old: %s', val, oldVal)
                      //       this.updateRecordState(val)

                        //
                      //   },
                      //   deep: true

                    },
                    events: {

                    // 'building-change':function(name) {
                    // 	this.newbuilding = '';
                    // 	this.newbuilding = name;
                    // 	console.log(this.newbuilding);
                    // },
                    // 'categories-change':function(list) {
                    // 	this.categories = '';
                    // 	this.categories = list;
                    // 	console.log(this.categories);
                    // }
                }
};


</script>
