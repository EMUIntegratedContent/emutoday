<template>
  <form>
    <slot name="csrf"></slot>
    <div class="row">
      <div v-bind:class="md12col">
        <div v-if="formMessage.isOk" :class="calloutSuccess">
          <h5>{{ formMessage.msg }}</h5>
        </div>
        <div v-if="formMessage.isErr" :class="calloutFail">
          <h5>There are errors.</h5>
        </div>
      </div>
      <!-- /.small-12 columns -->
    </div>
    <!-- /.row -->
    <div class="row">
      <div v-bind:class="md12col">
        <!-- Is approved? -->
        <div v-bind:class="formGroup">
          <label>Approved for Public Display? <input type="checkbox" v-model="record.is_approved"
                                                     :true-value="1" :false-value="0"></label>
        </div>
      </div>
      <!-- /.small-12 columns -->
    </div>
    <!-- /.row -->
    <div class="row">
      <div v-bind:class="md12col">
        <!-- Expert Type -->
        <h4>I'd like to be listed as a <span v-bind:class="iconStar" class="reqstar">*</span></h4>
        <div class="checkbox">
          <label><input type="checkbox" v-model="record.is_community_speaker"
                        :true-value="1" :false-value="0">Community Speaker</label>
        </div>
        <div class="checkbox">
          <label><input type="checkbox" v-model="record.is_media_expert"
                        :true-value="1" :false-value="0">Media Expert</label>
        </div>
      </div>
      <!-- /.small-12 columns -->
    </div>
    <!-- /.row -->
    <div class="row">
      <div v-bind:class="md12col">
        <!-- Display Name -->
        <div v-bind:class="formGroup">
          <label>Display Name <span v-bind:class="iconStar" class="reqstar"></span></label>
          <input v-model="record.display_name" class="form-control"
                 v-bind:class="[formErrors.display_name ? 'invalid-input' : '']" name="display_name" type="text">
          <p v-if="formErrors.display_name" class="help-text invalid">{{ formErrors.display_name }}</p>
        </div>
      </div>
      <!-- /.small-12 columns -->
    </div>
    <!-- /.row -->
    <div class="row">
      <div v-bind:class="md12col">
        <!-- EMU Title -->
        <div v-bind:class="formGroup">
          <label>EMU Title <span v-bind:class="iconStar" class="reqstar"></span></label>
          <input v-model="record.title" class="form-control" v-bind:class="[formErrors.title ? 'invalid-input' : '']"
                 name="title" type="text">
          <p v-if="formErrors.title" class="help-text invalid">{{ formErrors.title }}</p>
        </div>
      </div>
      <!-- /.small-12 columns -->
    </div>
    <!-- /.row -->
    <div class="row">
      <div v-bind:class="md6col">
        <!-- First Name -->
        <div v-bind:class="formGroup">
          <label>First Name <span v-bind:class="iconStar" class="reqstar"></span></label>
          <input v-model="record.first_name" class="form-control"
                 v-bind:class="[formErrors.first_name ? 'invalid-input' : '']" name="first_name" type="text">
          <p v-if="formErrors.first_name" class="help-text invalid">{{ formErrors.first_name }}</p>
        </div>
      </div>
      <div v-bind:class="md6col">
        <!-- Last Name -->
        <div v-bind:class="formGroup">
          <label>Last Name <span v-bind:class="iconStar" class="reqstar"></span></label>
          <input v-model="record.last_name" class="form-control"
                 v-bind:class="[formErrors.last_name ? 'invalid-input' : '']" name="last_name" type="text">
          <p v-if="formErrors.last_name" class="help-text invalid">{{ formErrors.last_name }}</p>
        </div>
      </div>
      <!-- /.small-12 columns -->
    </div>
    <!-- /.row -->
    <div class="row">
      <div v-bind:class="md4col">
        <!-- Office Phone -->
        <div v-bind:class="formGroup">
          <label>Office Phone</label>
          <input v-model="record.office_phone" class="form-control"
                 v-bind:class="[formErrors.office_phone ? 'invalid-input' : '']" name="office_phone" type="text">
          <p v-if="formErrors.office_phone" class="help-text invalid">{{ formErrors.office_phone }}</p>
        </div>
      </div>
      <div v-bind:class="md4col">
        <!-- Cell Phone -->
        <div v-bind:class="formGroup">
          <label>Cell Phone (internal use only)</label>
          <input v-model="record.cell_phone" class="form-control"
                 v-bind:class="[formErrors.cell_phone ? 'invalid-input' : '']" name="cell_phone" type="text">
          <p v-if="formErrors.cell_phone" class="help-text invalid">{{ formErrors.cell_phone }}</p>
        </div>
      </div>
      <div v-bind:class="md4col">
        <!-- Release cell -->
        <div v-bind:class="formGroup">
          <label>Release Cell Number?</label>
          <input type="checkbox" v-model="record.release_cell_phone"
                 :true-value="1" :false-value="0">
        </div>
      </div>
      <!-- /.small-12 columns -->
    </div>
    <!-- /.row -->
    <div class="row">
      <div v-bind:class="md6col">
        <!-- Email -->
        <div v-bind:class="formGroup">
          <label>Email <span v-bind:class="iconStar" class="reqstar"></span></label>
          <input v-model="record.email" class="form-control" v-bind:class="[formErrors.email ? 'invalid-input' : '']"
                 name="email" type="text">
          <p v-if="formErrors.email" class="help-text invalid">{{ formErrors.email }}</p>
        </div>
      </div>
      <!-- /.small-12 columns -->
    </div>
    <!-- /.row -->
    <div class="row">
      <div v-bind:class="md12col">
        <!-- Interview preferences -->
        <h4>Interview Preferences</h4>
        <div class="checkbox">
          <label><input type="checkbox" v-model="record.do_print_interviews"
                        :true-value="1" :false-value="0">Print Interviews</label>
        </div>
        <div class="checkbox">
          <label><input type="checkbox" v-model="record.do_broadcast_interviews"
                        :true-value="1" :false-value="0">Broadcast Media Interviews</label>
        </div>
      </div>
      <!-- /.small-12 columns -->
    </div>
    <!-- /.row -->
    <div class="row">
      <!-- Previous Titles -->
      <div v-bind:class="md12col">
        <h4>Previous Titles</h4>
      </div>
      <div v-if="previousTitles.length > 0" v-bind:class="md12col">
        <div v-for="title in previousTitles" class="input-group">
          <label class="sr-only">Previous Title</label>
          <input class="form-control dynamic-list-item" type="text" v-model="title.title">
          <span class="input-group-btn">
                  <button @click="delTitle(title)" class="btn btn-warning dynamic-list-btn" type="button">X</button>
              </span>
        </div>
      </div>
      <div v-else v-bind:class="md12col">
        <p>None</p>
      </div>
      <div v-bind:class="md12col">
        <button @click="addTitle" :class="btnSecondary" type="button">Add Title</button>
      </div>
    </div>
    <!-- /.row -->
    <div class="row">
      <!-- Languages -->
      <div v-bind:class="md12col">
        <h4>Languages</h4>
      </div>
      <div v-if="languages.length > 0" v-bind:class="md12col">
        <div v-for="language in languages" class="input-group">
          <label class="sr-only">Language</label>
          <input class="form-control dynamic-list-item" type="text" v-model="language.language">
          <span class="input-group-btn">
                  <button @click="delLanguage(language)" class="btn btn-warning dynamic-list-btn"
                          type="button">X</button>
              </span>
        </div>
      </div>
      <div v-else v-bind:class="md12col">
        <p>None</p>
      </div>
      <div v-bind:class="md12col">
        <button @click="addLanguage" :class="btnSecondary" type="button">Add Language</button>
      </div>
    </div>
    <!-- /.row -->
    <div class="row">
      <!-- Education -->
      <div v-bind:class="md12col">
        <h4>Education</h4>
      </div>
      <div v-if="education.length > 0" v-bind:class="md12col">
        <div v-for="ed in education" class="input-group">
          <label class="sr-only">Education</label>
          <input class="form-control dynamic-list-item" type="text" v-model="ed.education">
          <span class="input-group-btn">
                  <button @click="delEducation(ed)" class="btn btn-warning dynamic-list-btn" type="button">X</button>
              </span>
        </div>
      </div>
      <div v-else v-bind:class="md12col">
        <p>None</p>
      </div>
      <div v-bind:class="md12col">
        <button @click="addEducation" :class="btnSecondary" type="button">Add Education</button>
      </div>
    </div>
    <!-- /.row -->
    <div class="row">
      <!-- Fiels of expertise -->
      <div v-bind:class="md12col">
        <h4>Fields of Expertise</h4>
      </div>
      <div v-if="expertise.length > 0" v-bind:class="md12col">
        <div v-for="exp in expertise" class="input-group">
          <label class="sr-only">Field of Expertise</label>
          <input class="form-control dynamic-list-item" type="text" v-model="exp.expertise">
          <span class="input-group-btn">
                  <button @click="delExpertise(exp)" class="btn btn-warning dynamic-list-btn" type="button">X</button>
              </span>
        </div>
      </div>
      <div v-else v-bind:class="md12col">
        <p>None</p>
      </div>
      <div v-bind:class="md12col">
        <button @click="addExpertise" :class="btnSecondary" type="button">Add Expertise</button>
      </div>
    </div>
    <!-- /.row -->
    <div class="row">
      <!-- Social media links -->
      <div v-bind:class="md12col">
        <h4>Social Media Links</h4>
      </div>
      <div v-if="social.length > 0" v-bind:class="md12col">
        <div v-for="soc in social">
          <label class="sr-only">Social Media</label>
          <div class="row">
            <div v-bind:class="md4col">
              <label>Title</label>
              <input class="form-control dynamic-list-item" type="text" v-model="soc.title">
            </div>
            <div v-bind:class="md6col" class="input-group">
              <label>Full URL (e.g. http://facebook.com)</label>
              <input class="form-control social-list-item" type="text" v-model="soc.url">
              <span class="input-group-btn">
                          <button @click="delSocial(soc)" class="btn btn-warning social-list-btn"
                                  type="button">X</button>
                      </span>
            </div>
          </div>
        </div>
      </div>
      <div v-else v-bind:class="md12col">
        <p>None</p>
      </div>
      <div v-bind:class="md12col">
        <button @click="addSocial" :class="btnSecondary" type="button">Add Social Link</button>
      </div>
    </div>
    <!-- /.row -->
    <div class="row">
      <div v-bind:class="md12col">
        <!-- Last Name -->
        <div v-bind:class="formGroup">
          <label>Expertise Categories</label>
          <v-select
              :class="[formErrors.tags ? 'invalid-input' : '']"
              v-model="categories"
              :options="categorieslist"
              :multiple="true"
              placeholder="Select expertise category"
              label="category">
          </v-select>
          <p v-if="formErrors.category" class="help-text invalid">{{ formErrors.category }}</p>
        </div>
      </div>
      <!-- /.small-12 columns -->
    </div>
    <!-- /.row -->
    <div class="row">
      <div v-bind:class="md12col">
        <!-- Biography -->
        <div v-bind:class="formGroup">
          <label>Biography <span v-bind:class="iconStar" class="reqstar"></span></label>
          <ckeditor
              id="content"
              name="content"
              v-model="biography"
              :editor="editor"
              :config="editorConfigFull"
          ></ckeditor>
          <p v-if="formErrors.biography" class="help-text invalid">Need biography.</p>
        </div>
      </div>
    </div>
    <!-- /.row -->
    <div class="row">
      <div v-bind:class="md12col">
        <!-- Teaser -->
        <div v-bind:class="formGroup">
          <label>Teaser (short description of expert for search results page)</label>
          <textarea v-model="record.teaser" class="form-control" id="teaser" name="teaser" rows="2"></textarea>
          <p v-if="formErrors.teaser" class="help-text invalid">Need teaser.</p>
        </div>
      </div>
    </div>
    <!-- /.row -->
    <div class="row">
      <div v-bind:class="md12col">
        <h4>Submitter Information</h4>
      </div>
    </div>
    <div class="row">
      <div v-bind:class="md4col">
        <!-- Submitter Name -->
        <div v-bind:class="formGroup">
          <label>Submitter Name</label>
          <input v-model="record.submitter_name" class="form-control"
                 v-bind:class="[formErrors.submitter_name ? 'invalid-input' : '']" name="submitter_name" type="text">
          <p v-if="formErrors.submitter_name" class="help-text invalid">{{ formErrors.submitter_name }}</p>
        </div>
      </div>
      <div v-bind:class="md4col">
        <!-- Submitter Phone -->
        <div v-bind:class="formGroup">
          <label>Submitter Email</label>
          <input v-model="record.submitter_email" class="form-control"
                 v-bind:class="[formErrors.submitter_email ? 'invalid-input' : '']" name="submitter_email" type="text">
          <p v-if="formErrors.submitter_email" class="help-text invalid">{{ formErrors.submitter_email }}</p>
        </div>
      </div>
      <div v-bind:class="md4col">
        <!-- Submitter Phone -->
        <div v-bind:class="formGroup">
          <label>Submitter Phone</label>
          <input v-model="record.submitter_phone" class="form-control"
                 v-bind:class="[formErrors.submitter_phone ? 'invalid-input' : '']" name="submitter_phone" type="text">
          <p v-if="formErrors.submitter_phone" class="help-text invalid">{{ formErrors.submitter_phone }}</p>
        </div>
      </div>
      <!-- /.small-12 columns -->
    </div>
    <!-- /.row -->
    <div class="row">
      <div v-bind:class="md12col">
        <div v-bind:class="formGroup">
          <button v-on:click="submitForm" type="submit" v-bind:class="btnPrimary">{{ submitBtnLabel }}</button>
          <button v-if="currentRecordId" id="btn-delete" v-on:click="delExpert" type="submit" class="redBtn"
                  v-bind:class="btnPrimary">Delete Expert
          </button>
        </div>
      </div>
    </div>
    <!-- /.row -->
  </form>
</template>

<style scoped>
button.btn-primary {
  margin-right: 0.2rem;
}

.redBtn {
  background: hsl(0, 90%, 70%);
}

.dynamic-list-item {
  margin: 5px 0px 10px 0px !important;
}

.dynamic-list-btn {
  margin-top: -4px !important;
}

.social-list-item {
  margin: 2px 0px 2px 0px !important;
}

.social-list-btn {
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
import { ckeditorMixin } from './ckeditor_config'
import vSelect from "vue-select"
import 'vue-select/dist/vue-select.css'

export default {
  mixins: [ckeditorMixin],
  components: { vSelect },
  props: {
    cuserRoles: { default: {} },
    errors: {
      default: ''
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
  data: function () {
    return {
      biography: '',
      categories: [],
      categorieslist: [],
      currentRecordId: null,
      currentDate: {},
      education: [],
      expertise: [],
      formErrors: {},
      formInputs: {},
      formMessage: {
        isOk: false,
        isErr: false,
        msg: ''
      },
      hasContent: false,
      isFresh: true,
      languages: [],
      previousTitles: [],
      record: {
        id: '',
        accept_policies: 1,
        biography: 'wffwefewfewfewfwefewf',
        cell_phone: '',
        display_name: '',
        email: '',
        is_community_speaker: 0,
        is_media_expert: 0,
        do_print_interviews: 0,
        do_broadcast_interviews: 0,
        first_name: '',
        do_phone_interviews: 0,
        is_approved: 0,
        last_name: '',
        office_phone: '',
        release_cell_phone: 0,
        submitter_email: '',
        submitter_name: '',
        submitter_phone: '',
        teaser: '',
        title: '',
        categories: [],
        education: [],
        expertise: [],
        languages: [],
        previousTitles: [],
        social: [],
      },
      recordOld: {
        id: '',
        accept_policies: 1,
        biography: '',
        cell_phone: '',
        display_name: '',
        email: '',
        is_community_speaker: 0,
        is_media_expert: 0,
        do_print_interviews: 0,
        do_broadcast_interviews: 0,
        first_name: '',
        interviews: '',
        is_approved: 0,
        last_name: '',
        office_phone: '',
        release_cell_phone: 0,
        submitter_email: '',
        submitter_name: '',
        submitter_phone: '',
        teaser: '',
        title: '',
        categories: [],
        education: [],
        expertise: [],
        languages: [],
        previousTitles: [],
        social: [],
      },
      response: {},
      social: [],
      totalChars: {
        title: 50,
      },
      userRoles: []
    }
  },
  created: function () {
    if (this.recordid) {
      this.currentRecordId = this.recordid;
      this.fetchCategoryList();
      this.fetchEducation();
      this.fetchExpertise();
      this.fetchLanguages();
      this.fetchPreviousTitles();
      this.fetchSocial();
      this.fetchCurrentCategory(this.currentRecordId);
      this.fetchCurrentRecord(this.currentRecordId);
    }
    else {
      this.hasContent = true;
      this.fetchCategoryList();
    }
    this.getUserRoles();
  },
  computed: {

    // switch classes based on css framework. foundation or bootstrap
    md6col: function () {
      return (this.framework == 'foundation' ? 'medium-6 columns' : 'col-md-6')
    },
    md12col: function () {
      return (this.framework == 'foundation' ? 'medium-12 columns' : 'col-md-12')
    },
    md8col: function () {
      return (this.framework == 'foundation' ? 'medium-8 columns' : 'col-md-8')
    },
    md4col: function () {
      return (this.framework == 'foundation' ? 'medium-4 columns' : 'col-md-4')
    },
    btnPrimary: function () {
      return (this.framework == 'foundation' ? 'button button-primary' : 'btn btn-primary')
    },
    btnSecondary: function () {
      return (this.framework == 'foundation' ? 'button button-secondary' : 'btn btn-link')
    },
    formGroup: function () {
      return (this.framework == 'foundation' ? 'form-group' : 'form-group')
    },
    formControl: function () {
      return (this.framework == 'foundation' ? '' : 'form-control')
    },
    calloutSuccess: function () {
      return (this.framework == 'foundation') ? 'callout success' : 'alert alert-success'
    },
    calloutFail: function () {
      return (this.framework == 'foundation') ? 'callout alert' : 'alert alert-danger'
    },
    iconStar: function () {
      return (this.framework == 'foundation' ? 'fi-star ' : 'fa fa-star')
    },
    inputGroupLabel: function () {
      return (this.framework == 'foundation') ? 'input-group-label' : 'input-group-addon'
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
    // Switch verbage of submit button.
    submitBtnLabel: function () {
      return (this.currentRecordId) ? 'Update Expert' : 'Create Expert'
    },

    editorType: function () {
      if (this.isAdmin) {
        return 'admin'
      }
      else {
        return 'simple'
      }
    }
  },

  methods: {
    getUserRoles () {
      let roles = this.cuserRoles;
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

    fetchCurrentRecord: function (recid) {
      this.$http.get('/api/experts/' + recid + '/edit')

      .then((response) => {
        this.record = response.data.data
        this.recordOld = response.data.data

        this.hasContent = true;
        this.currentRecordId = this.record.id;
        this.biography = this.record.biography;
      }).catch((e) => {
        this.formErrors = e.response.data.error.message
      })
    },

    // Fetch the tags that match THIS record
    fetchCategoryList: function () {
      this.$http.get('/api/experts/category')
      .then((response) => {
        this.categorieslist = response.data
      }).catch((e) => {

      })
    },

    // Fetch the categories that matches THIS expert
    fetchCurrentCategory () {
      this.$http.get('/api/experts/category/' + this.currentRecordId)
      .then((response) => {
        this.categories = response.data
      }).catch((e) => {

      })
    },

    // Fetch the education that matches THIS expert
    fetchEducation () {
      this.$http.get('/api/experts/education/' + this.currentRecordId)
      .then((response) => {
        this.education = response.data
      })
      .catch((e) => {
      })
    },

    // Fetch the expertise that matches THIS expert
    fetchExpertise () {
      this.$http.get('/api/experts/expertise/' + this.currentRecordId)
      .then((response) => {
        this.expertise = response.data
      })
      .catch((e) => {
      })
    },

    // Fetch the languages that matches THIS expert
    fetchLanguages () {
      this.$http.get('/api/experts/languages/' + this.currentRecordId)
      .then((response) => {
        this.languages = response.data
      })
      .catch((e) => {
      })
    },

    // Fetch the job titles that matches THIS expert
    fetchPreviousTitles () {
      this.$http.get('/api/experts/previoustitles/' + this.currentRecordId)
      .then((response) => {
        this.previousTitles = response.data
      })
      .catch((e) => {
      })
    },

    // Fetch the social media links that matches THIS expert
    fetchSocial () {
      this.$http.get('/api/experts/social/' + this.currentRecordId)
      .then((response) => {
        this.social = response.data
      })
      .catch((e) => {
      })
    },

    nowOnReload: function () {
      let newurl = '/admin/experts/' + this.currentRecordId + '/edit';

      document.location = newurl;
    },

    onRefresh: function () {
      this.fetchCurrentRecord(this.currentRecordId)
    },

    submitForm: function (e) {
      e.preventDefault(); // Stop form defualt action

      $('html, body').animate({ scrollTop: 0 }, 'fast');

      this.record.biography = this.biography;

      if (this.categories.length > 0) {
        this.record.categories = this.categories;
      }
      else {
        this.record.categories = [];
      }

      if (this.education.length > 0) {
        this.record.education = this.education;
      }
      else {
        this.record.education = [];
      }

      if (this.expertise.length > 0) {
        this.record.expertise = this.expertise;
      }
      else {
        this.record.expertise = [];
      }

      if (this.languages.length > 0) {
        this.record.languages = this.languages;
      }
      else {
        this.record.languages = [];
      }

      if (this.previousTitles.length > 0) {
        this.record.previousTitles = this.previousTitles;
      }
      else {
        this.record.previousTitles = [];
      }

      if (this.social.length > 0) {
        this.record.social = this.social;
      }
      else {
        this.record.social = [];
      }

      // Decide route to submit form to
      let method = (this.currentRecordId) ? 'put' : 'post'
      let route = (this.currentRecordId) ? '/api/experts/' + this.record.id : '/api/experts';

      // Submit form.
      this.$http[method](route, this.record) //

      // Do this when response gets back.
      .then((response) => {
        this.formMessage.msg = response.data.message;
        this.formMessage.isOk = true; // Success message
        this.currentRecordId = response.data.newdata.record_id;
        this.record.id = response.data.newdata.record_id;
        this.formMessage.isErr = false;
        this.formErrors = {}; // Clear errors?
        if (this.recordid == '') {
          this.nowOnReload();
        }
        else {
          this.onRefresh();
        }
      }).catch((e) => { // If invalid. error callback
        this.formMessage.isOk = false
        this.formMessage.isErr = true
        // Set errors from validation to vue data
        this.formErrors = e.response.data.error.message
      })
    },

    delExpert: function (e) {
      e.preventDefault();
      this.formMessage.isOk = false;
      this.formMessage.isErr = false;

      if (confirm('Would you like to delete this expert?')) {
        $('html, body').animate({ scrollTop: 0 }, 'fast');

        this.$http.post('/api/experts/' + this.record.id + '/delete')

        .then(() => {
          window.location.href = "/admin/experts"
        }).catch((e) => {
          console.log(e)
        })
      }
    },

    delTitle: function (title) {
      if (confirm('Would you like to delete this title?')) {
        this.previousTitles.splice(this.previousTitles.indexOf(title), 1)
      }
    },

    addTitle: function () {
      this.previousTitles.push({ value: '', title: '' });
    },

    delLanguage: function (language) {
      if (confirm('Would you like to delete this language?') == true) {
        this.languages.splice(this.languages.indexOf(language), 1)
      }
    },

    addLanguage: function () {
      this.languages.push({ value: '', language: '' });
    },

    delEducation: function (education) {
      if (confirm('Would you like to delete this education?') == true) {
        this.education.splice(this.education.indexOf(education), 1)
      }
    },

    addEducation: function () {
      this.education.push({ value: '', education: '' });
    },

    delExpertise: function (expertise) {
      if (confirm('Would you like to delete this field of expertise?') == true) {
        this.expertise.splice(this.expertise.indexOf(expertise), 1)
      }
    },

    addExpertise: function () {
      this.expertise.push({ value: '', expertise: '' });
    },

    delSocial: function (link) {
      if (confirm('Would you like to delete this social media link?') == true) {
        this.social.splice(this.social.indexOf(link), 1)
      }
    },

    addSocial: function () {
      this.social.push({ value: '', title: '', url: '' });
    },
  }
};

</script>
