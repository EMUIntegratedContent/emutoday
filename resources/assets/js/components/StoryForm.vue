<template>
  <form>
    <slot name="csrf"></slot>
    <div class="row">
      <div class="col-md-12">
        <div v-if="formMessage.isOk" class="alert alert-success alert-dismissible">
          <button @click.prevent="toggleCallout" class="btn btn-sm close"><i class="fa fa-times"></i></button>
          <h5>{{ formMessage.msg }}</h5>
        </div>
      </div><!-- /.small-12 columns -->
    </div><!-- /.row -->
    <div class="row">
      <div class="col-md-12">
        <template v-if="singleStype">
          <label>Story Type: {{ record.story_type }}</label>
          <input v-model="record.story_type" type="hidden" disabled="disabled"/>
        </template>
        <template v-else>
          <label>Story Type</label>
          <select v-model="record.story_type">
            <option v-for="stype in s_types" v-bind:value="stype.shortname" :selected="stype.shortname == 'news'">
              {{ stype.name }}
            </option>
          </select>
        </template>
        <hr/>
      </div><!-- /.col-md-6 -->
    </div><!-- /.row -->
    <div class="row">
      <div class="col-md-12">
        <div class="form-group">
          <label>Title <i class="fi-star reqstar"></i></label>
          <p class="help-text" id="title-helptext">Please enter a title</p>
          <input v-model="record.title" v-bind:class="[formErrors.title ? 'invalid-input' : '']" name="title"
                 type="text">
          <p v-if="formErrors.title" class="help-text invalid"> Please Include a Title!</p>
        </div>
      </div>
    </div><!-- /.row -->
    <div class="row">
      <div class="col-md-12">
        <div class="form-group">
          <label>Slug <i class="fi-star reqstar"></i></label>
          <p class="help-text" id="slug-helptext">Automatic Readable link for sharing and social media</p>
          <input v-model="recordSlug" v-bind:class="[formErrors.slug ? 'invalid-input' : '']" name="slug" type="text">
          <p v-if="formErrors.slug" class="help-text invalid">needs slug!</p>
        </div>
      </div><!-- /.col-md-12 -->
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="form-group">
          <label>Subtitle</label>
          <p class="help-text" id="subtitle-helptext">Visible in some cases</p>
          <input v-model="record.subtitle" v-bind:class="[formErrors.subtitle ? 'invalid-input' : '']" @blur="onBlur"
                 name="subtitle" type="text">
          <p v-if="formErrors.subtitle" class="help-text invalid"></p>
        </div>
        <div class="form-group" v-if="storyType == 'featurephoto'">
          <label>Photo credit</label>
          <p class="help-text" id="photo_credit-helptext">e.g. 'submitted by John Smith'</p>
          <input v-model="record.photo_credit" v-bind:class="[formErrors.photo_credit ? 'invalid-input' : '']"
                 @blur="onBlur" name="photo_credit" type="text">
          <p v-if="formErrors.photo_credit" class="help-text invalid"></p>
        </div>
        <div class="form-group">
          <label>Content <i v-if="storyType != 'featurephoto'" class="fi-star reqstar"></i></label>
          <p class="help-text" id="content-helptext">Enter the story content <span
              v-if="storyType == 'featurephoto'">(optional)</span></p>
          <ckeditor
              id="content"
              name="content"
              v-model="content"
              :editor="editor"
              :config="editorConfigFull"
          ></ckeditor>
          <!--          <input type="text" id="editor" v-model="content" />-->
          <p v-if="formErrors.content" class="help-text invalid">Need Content!</p>
        </div>
        <div class="form-group user-display">
          <div class="user-name">Author: {{ author.first_name }} {{ author.last_name }}</div>
          <div v-if="contact.id != 0" class="user-info">Contact: {{ contact.first_name }} {{ contact.last_name }},
            {{ contact.email }}, {{ contact.phone }}
          </div>
          <div v-if="contact.id == 0" class="user-info">Contact: {{ defaultcontact.first_name }}
            {{ defaultcontact.last_name }}, {{ defaultcontact.email }}, {{ defaultcontact.phone }}
          </div>
        </div><!-- /.frm-group -->
      </div><!-- /.small-12 columns -->
    </div><!-- /.row -->
    <div class="row">
      <div class="col-md-6">
        <div v-if="saveAuthorMessage.isOk" class="alert alert-success alert-dismissible">
          <button @click.prevent="toggleCallout" class="btn btn-sm close"><i class="fa fa-times"></i></button>
          <h5>{{ saveAuthorMessage.msg }}</h5>
        </div>
        <a v-if="!needAuthor" @click.prevent="changeAuthor" href="#" class="btn btn-primary btn-sm">Change Author</a>
        <a v-if="hasAuthor" @click.prevent="resetAuthor" href="#" class="btn btn-primary btn-sm">Reset Author</a>
        <a @click.prevent="changeContact" href="#" class="btn btn-primary btn-sm">Change Contact</a>
        <div v-if="needAuthor && isAdmin" class="form-inline author">
          <label>Choose existing Author:</label>
          <v-select
              v-model="selectedAuthor"
              :options="optionsAuthorlist"
              :multiple="false"
              placeholder="Author (leaving this blank will set you as the author)"
              label="name"></v-select>
        </div>
      </div><!-- /.col-md-12 -->
    </div><!-- /.row -->
    <div class="row">
      <div class="col-md-6">
        <div v-if="isAdmin && needContact" class="form-inline author">
          <label>Story contact:</label>
          <v-select
              v-model="selectedContact"
              :options="optionsContactlist"
              :multiple="false"
              placeholder="Contact (leaving this blank will set the system default as the contact)"
              label="name"></v-select>
        </div>
      </div><!-- /.col-md-6 -->
    </div>
    <div class="row">
      <div class="col-md-6">
        <div class="form-group">
          <label>Start Date: <i class="fi-star reqstar"></i>
            <flatpickr
                v-model="record.start_date"
                id="start-date"
                :config="flatpickrConfig"
                class="form-control"
                name="startingDate"
            >
            </flatpickr>
          </label>
          <p>NOTE: For external story with "video" tag, treat this field as the END Date.</p>
          <p v-if="formErrors.start_date" class="help-text invalid">Need a Start Date</p>
        </div><!--form-group -->
      </div><!-- /.small-6 columns -->
      <div class="col-md-6">
        <div v-if="isAdmin" class="form-group">
          <label>Tags:
            <v-select
                :class="[formErrors.tags ? 'invalid-input' : '']"
                v-model="tags"
                :options="taglist"
                :multiple="true"
                placeholder="Select tags"
                label="name">
            </v-select>
          </label>
        </div><!-- /.form-group -->
      </div><!-- /.small-6 columns -->
    </div><!-- /.row -->
    <div class="row">
      <div class="col-md-6">
      </div><!-- /.col-md-6-->
      <div class="col-md-6">
      </div><!-- /.col-md-6 -->
    </div><!-- /.row -->

    <div class="row">
      <div class="col-md-12">
        <div class="form-group">
          <button v-on:click="submitForm" type="submit" class="btn btn-primary">{{ submitBtnLabel }}</button>
        </div>
      </div><!-- /.column -->
    </div>
  </form>
</template>
<style scoped>
.btn-primary {
  margin-right: 0.2rem;
}

p {
  margin: 0;
}

label {
  display: block;
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

fieldset label.radiobtns {
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
  vertical-align: text-top;
}

button.button-primary {
  margin-top: 1rem;
}

.form-group {
  margin-bottom: 5px;
}

.callout {
  margin-bottom: 8px;
  padding: 8px 30px 8px 15px;
}

.save-author {
  vertical-align: bottom;
}

.ck.ck-content:not(.ck-comment__input *) {
  height: 300px;
  overflow-y: auto;
}

</style>

<script>
import moment from 'moment'
import vSelect from "vue-select"
import { storyMixin } from "./story_mixin"
import { ckeditorMixin } from './ckeditor_config'
import flatpickr from 'vue-flatpickr-component'
import 'flatpickr/dist/flatpickr.css'
import 'vue-select/dist/vue-select.css'


export default {
  components: { vSelect, flatpickr },
  mixins: [storyMixin, ckeditorMixin],
  props: {
    cuser: { default: {} },
    editid: { default: '' },
    stypes: { default: {} },
    gtype: { default: '' },
    qtype: { default: '' },
    stype: { default: '' },
  },
  data () {
    return {
      tags: [],
      taglist: [],
      selectedAuthor: null,
      selectedContact: null,
      newform: false,
      response_record_id: '',
      response_stype: '',
      singleStype: '',
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
      needContact: false,
      contactManuallyChanged: false,
      authorlist: [],
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
      contactlist: [],
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
      recordOld: {
        id: '',
        user_id: '',
        title: '',
        story_type: '',
        content: '',
        start_date: '',
        contact: '',
        photo_credit: ''
      },
      record: {
        id: '',
        user_id: '',
        title: '',
        story_type: '',
        content: '',
        start_date: '',
        contact: '',
        photo_credit: '',
        tags: []
      },
      response: {},
      formMessage: {
        isOk: false,
        msg: ''
      },
      saveAuthorMessage: {
        isOk: false,
        msg: ''
      },
      formInputs: {},
      formErrors: {},
      authorErrors: {},
      flatpickrConfig: {
        altFormat: "m/d/Y h:i K", // format the user sees
        altInput: true,
        dateFormat: "Y-m-d H:i:S", // format sumbitted to the API
        enableTime: true
      },
      storyType: null
    }
  },
  created: function () {
    this.storyType = JSON.parse(JSON.stringify(this.stype))
    this.updateRecordState('created')
    if (this.editid != '') {
      this.currentRecordId = this.editid;
      this.singleStype = true;
      this.newform = false;
      this.fetchCurrentRecord();
    }
    else {
      this.newform = true;
      this.hasContent = true;
      this.record.user_id = this.cuser.id;
      this.record.story_type = this.storyType;
      this.record.start_date = moment().format('YYYY-MM-DD 12:00:00');
      this.setAuthorToCurrentUser(this.currentUser.id)
      this.record.author_id = this.record.user_id;
      this.updateRecordState('new');
    }
    this.fetchTagsList();
    this.fetchCurrentTags();
    this.getUserRoles();
    this.fetchDefaultContact(false)
  },
  computed: {
    authorBtnLabel: function () {
      return (this.hasAuthor) ? 'Update Author' : 'New Author';
    },
    optionsAuthorlist: function () {
      return this.authorlist;
    },
    optionsContactlist: function () {
      return this.contactlist;
    },
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
    editorType: function () {
      /*
      if(this.isAdmin){
        return 'admin'
      } else {
        return 'simple'
      }
      */
      return 'admin'
    },
    s_types: function () {
      // var data = localStorage[key];
      try {
        this.singleStype = false;
        return JSON.parse(this.stypes);
      } catch (e) {
        this.singleStype = true;
        return this.stypes;
      }
    },
    submitBtnLabel: function () {
      // return (this.recordexists) ? 'Update Story' : 'Save Story';
      return (this.record.id) ? 'Update Story' : 'Save Story';
    },
    hasLocalRecordChanged: function () {
      var ckval = false
      if (this.recordOld.title !== this.record.title) {
        ckval = true
      }

      if (this.recordOld.content !== this.content) {
        ckval = true
      }

      if (ckval) {
        this.updateRecordIsDirty(true)

      }
      return ckval
    },
    hasAuthor: function () {
      if (this.record.author_id === 0) {
        return false;
      }
      else {
        return true;
      }
    },
    recordSlug: function () {
      if (this.record.title) {
        return this.record.title.toLowerCase().replace(/[^a-z0-9-]+/g, '-').replace(/^-+|-+$/g, '')

      }
    },
    hasStartDate: function () {
      if (this.record.start_date === undefined || this.record.start_date == '') {
        return false
      }
      else {
        return true
      }

    }
  },
  methods: {
    getUserRoles () {
      let roles = this.cuser.roles;
      let self = this;
      this.userRoles = [];
      if (roles.length > 0) {
        roles.forEach(function (item, index) {
          self.userRoles.push(item.name);
        })
      }
      else {
        self.userRoles.push('guest');
      }

    },
    nowOnReload: function () {
      let newurl = '/admin/' + this.qtype + '/' + this.gtype + '/' + this.response_stype + '/' + this.response_record_id + '/edit';
      this.response_record_id + '/edit';
      document.location = newurl;
    },

    onRefresh: function () {
      this.updateRecordId(this.currentRecordId);
      this.updateRecordState('edit');
      this.updateRecordIsDirty(false);
      // this.recordexists = true;
      this.fetchCurrentRecord();
    },
    oldRefresh: function () {
      this.recordOld = JSON.parse(JSON.stringify(this.record));
      this.$nextTick(function () {
      });
    },
    changeAuthor: function () {
      this.fetchAuthorList();
      this.saveAuthorMessage.isOk = '';
      if (this.record.author_id == 0) {
        this.author = this.authorNew;
      }
      this.needAuthor = true;

    },
    resetAuthor: function () {
      this.setAuthorToCurrentUser(this.currentUser.id)
      this.needAuthor = false;

      this.saveAuthorMessage.isOk = '';
    },
    changeContact: function (evt) {
      this.fetchContactList();
      this.needContact = true;
      this.contactManuallyChanged = true;
    },
    toggleCallout: function (evt) {
      this.formMessage.isOk = false
      this.saveAuthorMessage.isOk = false
    },

    onBlur: function (evt) {
      if (!this.recordIsDirty) {
        this.updateRecordIsDirty(true);
      }
    },
    onCalendarChange: function () {
      this.checkContentChange();
    },
    onContentChange: function () {
      if (!this.ckfullyloaded) {
        this.ckfullyloaded = true
      }
      else {
        this.checkContentChange();
      }
    },
    checkContentChange: function () {
      if (!this.recordIsDirty) {
        this.updateRecordIsDirty(true);
      }
    },
    jsonEquals: function (a, b) {
      return JSON.stringify(a) === JSON.stringify(b);
    },

    fetchAuthorList: function () {
      this.$http.get('/api/authorlist')
      .then((response) => {
        this.authorlist = response.data
      }).catch(e => {
        console.log(e)
      })
    },

    fetchContactList: function () {
      this.$http.get('/api/contactlist')
      .then((response) => {
        this.contactlist = response.data
      }).catch(e => {
        console.log(e)
      })
    },

    /**
     * Set the default contact field. If setContact is true, also change the record's contact to the default.
     */
    fetchDefaultContact: function (setContact) {
      this.$http.get('/api/contactdefault')
      .then((response) => {
        this.defaultcontact = response.data
        if (setContact === true) {
          this.contact = response.data
        }
      }, (response) => {
      });
    },

    fetchDefaultMagazineContact: function () {
      this.$http.get('/api/contactmagazinedefault')
      .then((response) => {
        this.defaultcontact = response.data
        this.contact = response.data
      }).catch((e) => {
      })
    },

    // Fetch the tags that match THIS record
    fetchTagsList: function () {
      this.$http.get('/api/taglist/')
      .then((response) => {
        this.taglist = response.data;
      }).catch((e) => {
      })
    },

    fetchCurrentTags () {
      this.$http.get('/api/taglist/' + this.currentRecordId)
      .then((response) => {
        this.tags = response.data;
      }).catch((e) => {
      })
    },

    fetchCurrentRecord: function () {

      this.$http.get('/api/story/' + this.currentRecordId + '/edit')

      .then((response) => {
        this.record = response.data.data
        this.recordOld = response.data.data

        //set contact information
        this.contact.id = response.data.data.contact.id
        this.contact.first_name = response.data.data.contact.first_name
        this.contact.last_name = response.data.data.contact.last_name
        this.contact.email = response.data.data.contact.email
        this.contact.phone = response.data.data.contact.phone

        this.checkOverData();
      }).catch(e => {
        console.log(e)
        this.formErrors = e.response.data.error.message;
      })
    },
    setAuthorToCurrentUser: function (userId) {
      //set the author to the AUTHOR table record, NOT THE USER table...search for the author by user_id fk
      let url = '/api/authorbyuser/'
      if (this.storyType == 'statement') {
        url += 1 // Jane Doe in the users table
      }
      else {
        url += userId
      }
      this.$http.get(url)

      .then((response) => {
        if (response.data.newdata) {
          this.author = response.data.newdata
        }
        else {
          this.author = {}
          this.record.author_id = 0
        }
      }).catch(e => {
        console.log(e)
        this.formErrors = e.response.data.error.message;
      })
    },
    checkOverData: function () {
      this.hasContent = true;

      this.currentRecordId = this.record.id;
      this.content = this.record.content;

      if (this.record.author_id != 0) {
        this.author = this.record.author;
      }
      else {
        // Set the default author based on the author table's id, not the user table's id!
        this.setAuthorToCurrentUser(this.currentUser.id)
      }
      // this.recordexists = true;

      this.updateRecordState("edit")
      this.updateRecordId(this.currentRecordId);
      this.updateRecordIsDirty(false);
    },

    saveAuthor: function (e){
      e.preventDefault();
      this.saveAuthorMessage.isOk = '';
      let method = (this.author.id == 0) ? 'post' : 'put'
      let route = (this.author.id == 0) ? '/api/author' : '/api/author/' + this.author.id;

      this.$http[method](route, this.author)

      .then((response) => {
        this.authorErrors = '';
        this.fetchAuthorList();

        this.author.id = response.data.newdata.author.id;
        this.record.author_id = response.data.newdata.author.id;

        this.author.first_name = response.data.newdata.author.first_name;
        this.author.last_name = response.data.newdata.author.last_name;
        this.author.phone = response.data.newdata.author.phone;
        this.author.email = response.data.newdata.author.email;

        this.saveAuthorMessage.msg = response.data.message;
        this.saveAuthorMessage.isOk = response.ok;
        this.needAuthor = false;

      })
      .catch(e => {
        console.log(e)
        this.authorErrors = e.response.data.error.message;
      })
    },
    fetchAuthor: function () {
      if (this.selectedAuthor) {
        this.$http.get('/api/author/' + this.selectedAuthor.value)
        .then((response) => {
          this.author.id = response.data.id;
          this.record.author_id = response.data.id;
          this.author.first_name = response.data.first_name;
          this.author.last_name = response.data.last_name;
          this.author.phone = response.data.phone;
          this.author.email = response.data.email;
        })
      }
      else {
        this.author.id = '';
        this.record.author_id = '';
        this.author.first_name = '';
        this.author.last_name = '';
        this.author.phone = '';
        this.author.email = '';
      }
    },
    fetchContact: function () {
      if (this.selectedContact) {
        this.$http.get('/api/author/' + this.selectedContact.value)

        .then(
            (response) => {
              this.contact.id = response.data.id;
              this.record.contact_id = response.data.id;
              this.contact.first_name = response.data.first_name;
              this.contact.last_name = response.data.last_name;
              this.contact.phone = response.data.phone;
              this.contact.email = response.data.email;
            }
        ).catch(e => {
          console.log(e)
        })
      }
      else {
        this.contact.id = '';
        this.record.contact_id = '';
        this.contact.first_name = '';
        this.contact.last_name = '';
        this.contact.phone = '';
        this.contact.email = '';
      }
    },
    // Check to see if the story type is 'article' and tag is 'external'
    isArticleExternal: function () {
      if (this.record.story_type == 'article') {
        // forEach can't be exited out of, so set a match flag before entering
        let match = false
        this.tags.forEach(function (tag) {
          if (tag.name == 'external' && match === false) {
            match = true
          }
        })
        return match
      }
      return false
    },
    submitForm: function (e) {
      e.preventDefault();
      this.formMessage.isOk = false;
      this.record.user_id = this.cuser.id;
      if (this.record.story_type === 'external' || this.isArticleExternal()) {
        this.record.content = 'not used';
      }
      else {
        this.record.content = this.content;
      }
      if (this.tags.length > 0) {
        this.record.tags = this.tags;
      }
      else {
        this.record.tags = [];
      }

      this.record.slug = this.recordSlug;

      if (this.author.id !== 0) {
        this.record.author_id = this.author.id;
      }

      if (this.contact.id !== 0) {
        this.record.contact_id = this.contact.id;
      }

      let tempid;
      if (typeof this.currentRecordId != 'undefined') {
        tempid = this.currentRecordId;
      }
      else {
        tempid = this.record.id;
      }
      let method = (this.record.id) ? 'put' : 'post'
      let route = (this.record.id) ? '/api/story/' + tempid : '/api/story'

      this.$http[method](route, this.record)

      .then((response) => {

        this.formMessage.msg = response.data.message
        this.currentRecordId = response.data.newdata.record_id
        this.formMessage.isOk = true
        this.formErrors = {}

        this.response_record_id = response.data.newdata.record_id
        this.response_stype = response.data.newdata.stype

        if (this.newform) {
          this.nowOnReload()
        }
        else {
          this.onRefresh()
        }
      })
      .catch(e => {
        console.log(e)
        this.formMessage.isOk = false
        this.formMessage.isErr = true
        this.formErrors = e.response.data.error.message
      })
    }
  },
  watch: {
    selectedAuthor: function () {
      this.fetchAuthor();
    },
    selectedContact: function () {
      this.fetchContact();
    },
    'record.story_type': function (val) {
      // Change author to "Official Statements" if this is an advisory or statement story type
      let previousStype = JSON.parse(JSON.stringify(this.storyType));
      let newStype = val;
      this.storyType = newStype; // change the stype
      if (this.editid == '') {
        if (this.storyType == 'statement' || this.storyType == 'advisory') {
          this.resetAuthor() // changes author to "Official Statement"
        }
        if ((previousStype == 'statement' || previousStype == 'advisory') && (newStype != 'statement' || newStype != 'advisory')) {
          this.resetAuthor() // changes author back to current user
        }
      }
      // If this is a new story and it's going to be a magazine article, set the default magazine contact as the contact.
      // if (!this.contactManuallyChanged && !this.recordexists) {
      if (!this.contactManuallyChanged && !this.record.id) {
        if (!this.record.contact) {
          if (val == 'article') {
            this.fetchDefaultMagazineContact()
          }
          else {
            this.fetchDefaultContact(true)
          }
        }
      }
    }
  }
}


</script>

<style>
/*.cke_editable {*/
/*  overflow-y: scroll !important;*/
/*}*/
/*.cke_contents {*/
/*  max-height: 100px !important;*/
/*}*/
.cke_show_borders {
  overflow-y: scroll !important;
  overflow-x: scroll !important;
}
</style>
