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
    <div class="row">
        <div v-bind:class="md12col">
            <!-- Expert Type -->
            <h4>I'd like to be listed as a <span v-bind:class="iconStar" class="reqstar">*</span></h4>
              <div class="checkbox">
                <label><input type="checkbox" value="1" v-model="record.is_community_speaker">Community Speaker</label>
              </div>
              <div class="checkbox">
                <label><input type="checkbox" value="1" v-model="record.is_media_expert">Media Expert</label>
              </div>
        </div>
        <!-- /.small-12 columns -->
    </div>
    <!-- /.row -->
    <div class="row">
      <div v-bind:class="md12col">
        <!-- Display Name -->
        <div v-bind:class="formGroup">
          <label>Display Name <span v-bind:class="iconStar" class="reqstar">*</span></label>
          <input v-model="record.display_name" class="form-control" v-bind:class="[formErrors.display_name ? 'invalid-input' : '']" name="display_name" type="text">
          <p v-if="formErrors.display_name" class="help-text invalid">{{formErrors.display_name}}</p>
        </div>
      </div>
      <!-- /.small-12 columns -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div v-bind:class="md12col">
            <!-- Interview preferences -->
            <h4>I will</h4>
              <div class="checkbox">
                <label><input type="checkbox" value="1" v-model="record.do_print_interviews">Do interviews for print media</label>
              </div>
              <div class="checkbox">
                <label><input type="checkbox" value="1" v-model="record.do_broadcast_interviews">Do interviews for broadcast media</label>
              </div>
        </div>
        <!-- /.small-12 columns -->
    </div>
    <!-- /.row -->
    <div class="row">
      <div v-bind:class="md6col">
        <!-- First Name -->
        <div v-bind:class="formGroup">
          <label>First Name <span v-bind:class="iconStar" class="reqstar">*</span></label>
          <input v-model="record.first_name" class="form-control" v-bind:class="[formErrors.first_name ? 'invalid-input' : '']" name="first_name" type="text">
          <p v-if="formErrors.first_name" class="help-text invalid">{{formErrors.first_name}}</p>
        </div>
      </div>
      <div v-bind:class="md6col">
        <!-- Last Name -->
        <div v-bind:class="formGroup">
          <label>Last Name <span v-bind:class="iconStar" class="reqstar">*</span></label>
          <input v-model="record.last_name" class="form-control" v-bind:class="[formErrors.last_name ? 'invalid-input' : '']" name="last_name" type="text">
          <p v-if="formErrors.last_name" class="help-text invalid">{{formErrors.last_name}}</p>
        </div>
      </div>
      <!-- /.small-12 columns -->
    </div>
    <!-- /.row -->
    <div class="row">
      <div v-bind:class="md12col">
        <!-- EMU Title -->
        <div v-bind:class="formGroup">
          <label>EMU Title <span v-bind:class="iconStar" class="reqstar">*</span></label>
          <input v-model="record.title" class="form-control" v-bind:class="[formErrors.title ? 'invalid-input' : '']" name="title" type="text">
          <p v-if="formErrors.title" class="help-text invalid">{{formErrors.title}}</p>
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
          <input v-model="record.office_phone" class="form-control" v-bind:class="[formErrors.office_phone ? 'invalid-input' : '']" name="office_phone" type="text">
          <p v-if="formErrors.office_phone" class="help-text invalid">{{formErrors.office_phone}}</p>
        </div>
      </div>
      <div v-bind:class="md4col">
        <!-- Cell Phone -->
        <div v-bind:class="formGroup">
          <label>Cell Phone (internal use only)</label>
          <input v-model="record.cell_phone" class="form-control" v-bind:class="[formErrors.cell_phone ? 'invalid-input' : '']" name="cell_phone" type="text">
          <p v-if="formErrors.cell_phone" class="help-text invalid">{{formErrors.cell_phone}}</p>
        </div>
      </div>
      <div v-bind:class="md4col">
        <!-- Release cell -->
        <div v-bind:class="formGroup">
            <label>Release Cell Number?</label>
            <input type="checkbox" value="1" v-model="record.release_cell_phone">
        </div>
      </div>
      <!-- /.small-12 columns -->
    </div>
    <!-- /.row -->
    <div class="row">
      <div v-bind:class="md6col">
        <!-- Email -->
        <div v-bind:class="formGroup">
          <label>Email <span v-bind:class="iconStar" class="reqstar">*</span></label>
          <input v-model="record.email" class="form-control" v-bind:class="[formErrors.email ? 'invalid-input' : '']" name="email" type="text">
          <p v-if="formErrors.email" class="help-text invalid">{{formErrors.email}}</p>
        </div>
      </div>
      <!-- /.small-12 columns -->
    </div>
    <!-- /.row -->
    <div class="row list-row">
        <!-- Previous Titles -->
        <div v-bind:class="md12col">
            <h4>Additional Titles (Include official EMU Affiliations)</h4>
        </div>
        <div v-if="previousTitles.length > 0" v-bind:class="md12col">
          <div v-for="title in previousTitles" class="input-group">
                <div class="input-group">
                  <input class="input-group-field" type="text" v-model="title.title">
                  <div class="input-group-button">
                    <button type="button" class="button" @click="delTitle(title)">X</button>
                  </div>
                </div>
          </div>
        </div>
        <div v-else v-bind:class="md12col">
            <p class="nofields">None</p>
        </div>
        <div v-bind:class="md12col">
            <button @click="addTitle" class="button secondary" type="button">Add Title</button>
        </div>
    </div>
    <!-- /.row -->
    <div class="row list-row">
        <!-- Languages -->
        <div v-bind:class="md12col">
            <h4>Languages Spoken</h4>
        </div>
        <div v-if="languages.length > 0" v-bind:class="md12col">
          <div v-for="language in languages" class="input-group">
              <label class="sr-only">Language</label>
              <div class="input-group">
                <input class="input-group-field" type="text" v-model="language.language">
                <div class="input-group-button">
                  <button type="button" class="button" @click="delLanguage(language)">X</button>
                </div>
              </div>
          </div>
        </div>
        <div v-else v-bind:class="md12col">
            <p class="nofields">None</p>
        </div>
        <div v-bind:class="md12col">
            <button @click="addLanguage" class="button secondary" type="button">Add Language</button>
        </div>
        <div v-bind:class="md12col">
            <p class="callout primary">Besides English, in what languages are you comfortable being interviewed?</p>
        </div>
    </div>
    <!-- /.row -->
    <div class="row list-row">
        <!-- Education -->
        <div v-bind:class="md12col">
            <h4>Education</h4>
        </div>
        <div v-if="education.length > 0" v-bind:class="md12col">
          <div v-for="ed in education" class="input-group">
              <label class="sr-only">Education</label>
              <div class="input-group">
                <input class="input-group-field" type="text" v-model="ed.education">
                <div class="input-group-button">
                  <button type="button" class="button" @click="delEducation(ed)">X</button>
                </div>
              </div>
          </div>
        </div>
        <div v-else v-bind:class="md12col">
            <p class="nofields">None</p>
        </div>
        <div v-bind:class="md12col">
            <button @click="addEducation" class="button secondary" type="button">Add Education</button>
        </div>
    </div>
    <!-- /.row -->
    <div class="row list-row">
        <!-- Fields of expertise -->
        <div v-bind:class="md12col">
            <h4>Fields of Expertise</h4>
        </div>
        <div v-if="expertise.length > 0" v-bind:class="md12col">
          <div v-for="exp in expertise" class="input-group">
              <label class="sr-only">Field of Expertise</label>
              <div class="input-group">
                <input class="input-group-field" type="text" v-model="exp.expertise">
                <div class="input-group-button">
                  <button type="button" class="button" @click="delExpertise(exp)">X</button>
                </div>
              </div>
          </div>
        </div>
        <div v-else v-bind:class="md12col">
            <p class="nofields">None</p>
        </div>
        <div v-bind:class="md12col">
            <button @click="addExpertise" class="button secondary" type="button">Add Expertise</button>
        </div>
    </div>
    <!-- /.row -->
    <div class="row list-row">
        <!-- Social media links -->
        <div v-bind:class="md12col">
            <h4>Related Links and Social Media</h4>
        </div>
        <div v-if="social.length > 0" v-bind:class="md12col">
          <div v-for="soc in social" class="input-group">
              <div class="medium-6 columns">
                  <label>Title</label>
                  <input class="input-group-field" type="text" v-model="soc.title">
              </div>
              <div class="medium-6 columns">
                  <label>URL</label>
                  <div class="input-group">
                    <input class="input-group-field" type="text" v-model="soc.url">
                    <div class="input-group-button">
                      <button type="button" class="button" @click="delSocial(soc)">X</button>
                    </div>
                  </div>
              </div>
          </div>
        </div>
        <div v-else v-bind:class="md12col">
            <p class="nofields">None</p>
        </div>
        <div v-bind:class="md12col">
            <button @click="addSocial" class="button secondary" type="button">Add Social Link</button>
        </div>
        <div v-bind:class="md12col">
            <p class="callout primary">Enter related links like department/faculty websites and social media profiles. (e.g. Center for Research website, Twitter account)</p>
        </div>
    </div>
    <!-- /.row -->
    <div class="row">
      <div v-bind:class="md12col">
        <!-- Biography -->
        <div v-bind:class="formGroup">
          <label>Biography <span v-bind:class="iconStar" class="reqstar">*</span></label>
          <textarea v-if="hasContent" v-model="record.biography" id="biography" name="biography" v-ckrte="biography" type="simple" :biography="biography" :fresh="isFresh" rows="200"></textarea>
          <p v-if="formErrors.biography" class="help-text invalid">You must enter a biography for this expert.</p>
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
         <input v-model="record.submitter_name" class="form-control" v-bind:class="[formErrors.submitter_name ? 'invalid-input' : '']" name="submitter_name" type="text">
         <p v-if="formErrors.submitter_name" class="help-text invalid">{{formErrors.submitter_name}}</p>
       </div>
     </div>
     <div v-bind:class="md4col">
       <!-- Submitter Phone -->
       <div v-bind:class="formGroup">
         <label>Submitter Email</label>
         <input v-model="record.submitter_email" class="form-control" v-bind:class="[formErrors.submitter_email ? 'invalid-input' : '']" name="submitter_email" type="text">
         <p v-if="formErrors.submitter_email" class="help-text invalid">{{formErrors.submitter_email}}</p>
       </div>
     </div>
     <div v-bind:class="md4col">
       <!-- Submitter Phone -->
       <div v-bind:class="formGroup">
         <label>Submitter Phone</label>
         <input v-model="record.submitter_phone" class="form-control" v-bind:class="[formErrors.submitter_phone ? 'invalid-input' : '']" name="submitter_phone" type="text">
         <p v-if="formErrors.submitter_phone" class="help-text invalid">{{formErrors.submitter_phone}}</p>
       </div>
     </div>
     <!-- /.small-12 columns -->
   </div>
   <!-- /.row -->
   <div class="row" v-show="!recordexists">
       <div v-bind:class="md12col" id="policies-container">
           <!-- Terms and conditions -->
           <h5>Policies</h5>
           <p>The Speakers & Experts Directory is a community service of the University Communications Office.</p>
           <p>
               ...
           </p>
           <p>Business dress is appropriate for most speaking engagements. If you are in doubt about what to wear, ask the person who requested you as a speaker what would be appropriate.</p>
       </div>
       <!-- /.small-12 columns -->
     <div v-bind:class="md12col">
         <!-- Is approved? -->
           <div v-bind:class="formGroup">
             <label><input type="checkbox" value="1" v-model="record.accept_policies">I have read and accepted the policies <span v-bind:class="iconStar" class="reqstar">*</span></label>
           </div>
           <p v-if="formErrors.accept_policies" class="help-text invalid">{{formErrors.accept_policies}}</p>
     </div>
     <!-- /.small-12 columns -->
   </div>
   <div class="row" v-show="recordexists">
       <div v-bind:class="md12col" id="policies-container">
           <p>Please note that when you update this expert, he/she will be removed from the experts list until an administrator has approved the changes.</p>
       </div>
       <!-- /.small-12 columns -->
   </div>
   <!-- /.row -->
    <div class="row">
      <div v-bind:class="md12col">
        <div v-bind:class="formGroup">
          <button v-on:click="submitForm" type="submit" v-bind:class="btnPrimary">{{submitBtnLabel}}</button>
        </div>
      </div>
    </div>
    <!-- /.row -->
</form>
</template>

<style scoped>
.row{
    padding: 5px 0px 5px 0px;
}
.list-row{
    padding: 10px;
    border: 1px solid #eeeeee;
}
.list-row h4{
    padding: 10px;
    background: #eeeeee;
}
.nofields{
    padding: 10px;
    font-style: italic;
}
#policies-container{
    height: 175px;
    overflow: scroll;
    padding: 16px;
    background: #eeeeee;
    border: 1px solid #999999;
    margin: 10px;
}
.redBtn {
  background: hsl(0, 90%, 70%);
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
import ckrte from "../directives/ckrte.js";
import vSelect from "vue-select";
import { updateRecordId, updateRecordIsDirty, updateRecordState} from '../vuex/actions';
import { getRecordId, getRecordState, getRecordIsDirty } from '../vuex/getters';
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
    errors: {
      default: ''
    },
    recordexists: {
      default: false
    },
    editid: {
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
      biography: '',
      categories: [],
      categorieslist: [],
      ckfullyloaded: false,
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
      newform: false,
      previousTitles: [],
      recordState: '',
      record: {
        id: '',
        accept_policies: 0, //public form only...not saved into database
        biography: '',
        cell_phone: '',
        display_name: '',
        email: '',
        expert_type: '',
        first_name: '',
        is_community_speaker: 0,
        is_media_expert: 0,
        do_print_interviews: 0,
        do_broadcast_interviews: 0,
        is_approved: 0,
        last_name: '',
        office_phone: '',
        release_cell_phone: 0,
        submitter_email: '',
        submitter_name: '',
        submitter_phone: '',
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
          accept_policies: 0, //public form only...not saved into database
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
          title: '',
          categories: [],
          education: [],
          expertise: [],
          languages: [],
          previousTitles: [],
          social: [],
      },
      recordState: '',
      response: {},
      social: [],
      totalChars: {
        title: 50,
      },
    }
  },
  created: function () {
    this.recordState = 'created';
  },
  ready: function() {
    if (this.recordexists){
      this.currentRecordId = this.recordid;
      this.newform = false;
      this.fetchCategoryList();
      this.fetchEducation();
      this.fetchExpertise();
      this.fetchLanguages();
      this.fetchPreviousTitles();
      this.fetchSocial();
      this.fetchCurrentCategory(this.currentRecordId);
      this.fetchCurrentRecord(this.currentRecordId);
    } else {
      this.newform = true;
      this.hasContent = true;
      this.recordState = 'new';
      this.fetchCategoryList();
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
    // Switch verbage of submit button.
    submitBtnLabel:function(){
      return (this.recordexists)?'Update Expert': 'Create Expert'
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
  },

  methods: {
      onContentChange: function(){
        if (!this.ckfullyloaded) {
          this.ckfullyloaded = true
        } else {
          this.checkContentChange();
        }
      },
      checkContentChange: function(){
        if (!this.recordIsDirty) {
          this.recordIsDirty = true
          this.updateRecordIsDirty(true);
        }
      },
      jsonEquals: function(a,b) {
        return JSON.stringify(a) === JSON.stringify(b);
      },

    fetchCurrentRecord: function(recid) {
      this.$http.get('/api/experts/' + recid + '/edit')

      .then((response) => {
        this.$set('record', response.data.data)
        this.$set('recordOld', response.data.data)

        this.hasContent = true;
        this.currentRecordId = this.record.id;
        this.biography = this.record.biography;
        this.fetchCurrentCategory();
        this.fetchEducation();
        this.fetchExpertise();
        this.fetchLanguages();
        this.fetchPreviousTitles();
        this.fetchSocial();
      }, (response) => {
        this.formErrors = response.data.error.message;
      }).bind(this);
    },

    // Fetch the tags that match THIS record
    fetchCategoryList: function() {
        this.$http.get('/api/experts/category')
          .then((response) =>{
            this.$set('categorieslist', response.data);
        });
    },

    // Fetch the categories that matches THIS expert
    fetchCurrentCategory(){
        this.$http.get('/api/experts/category/'+ this.currentRecordId)
            .then((response) => {
                this.$set('categories', response.data);
            }, (response) => {
        });
    },

    // Fetch the education that matches THIS expert
    fetchEducation(){
        this.$http.get('/api/experts/education/'+ this.currentRecordId)
            .then((response) => {
                this.$set('education', response.data);
            }, (response) => {
        });
    },

    // Fetch the expertise that matches THIS expert
    fetchExpertise(){
        this.$http.get('/api/experts/expertise/'+ this.currentRecordId)
            .then((response) => {
                this.$set('expertise', response.data);
            }, (response) => {
        });
    },

    // Fetch the languages that matches THIS expert
    fetchLanguages(){
        this.$http.get('/api/experts/languages/'+ this.currentRecordId)
            .then((response) => {
                this.$set('languages', response.data);
            }, (response) => {
        });
    },

    // Fetch the job titles that matches THIS expert
    fetchPreviousTitles(){
        this.$http.get('/api/experts/previoustitles/'+ this.currentRecordId)
            .then((response) => {
                this.$set('previousTitles', response.data);
            }, (response) => {
        });
    },

    // Fetch the social media links that matches THIS expert
    fetchSocial(){
        this.$http.get('/api/experts/social/'+ this.currentRecordId)
            .then((response) => {
                this.$set('social', response.data);
            }, (response) => {
        });
    },

    nowOnReload:function() {
      let newurl = '/admin/experts/'+ this.currentRecordId+'/edit';

      document.location = newurl;
    },

    onRefresh: function() {
      this.updateRecordId(this.currentRecordId);
      this.recordState = 'edit';
      this.recordIsDirty = false;

      this.recordId = this.currentRecordId;
      this.recordexists = true;
      this.fetchCurrentRecord(this.currentRecordId);
    },

    fetchSubmittedRecord: function(recid){
      // Sets params for update record, Passes an id to fetchCurrentRecord
      this.recordexists = true;
      this.formMessage.isOk = false;
      this.formMessage.isErr = false;
      this.recordid = recid;
      this.formErrors = {};
      this.fetchCurrentRecord(recid);
    },

    submitForm: function(e) {
      e.preventDefault(); // Stop form defualt action

      $('html, body').animate({ scrollTop: 0 }, 'fast');

      this.record.biography = this.biography;

      if (this.categories.length > 0) {
         this.record.categories = this.categories;
      } else {
         this.record.categories = [];
      }

      if (this.education.length > 0) {
         this.record.education = this.education;
      } else {
         this.record.education = [];
      }

      if (this.expertise.length > 0) {
         this.record.expertise = this.expertise;
      } else {
         this.record.expertise = [];
      }

      if (this.languages.length > 0) {
         this.record.languages = this.languages;
      } else {
         this.record.languages = [];
      }

      if (this.previousTitles.length > 0) {
         this.record.previousTitles = this.previousTitles;
      } else {
         this.record.previousTitles = [];
      }

      if (this.social.length > 0) {
         this.record.social = this.social;
      } else {
         this.record.social = [];
      }

      this.record.is_approved = 0; //any new or updated expert from the public end automatically requires approval from admin

      // Decide route to submit form to
      let method = (this.recordexists) ? 'put' : 'post'
      let route =  (this.recordexists) ? '/api/experts/' + this.record.id : '/api/experts';

      // Submit form.
      this.$http[method](route, this.record) //

      // Do this when response gets back.
      .then((response) => {
        this.formMessage.msg = response.data.message;
        this.formMessage.isOk = response.ok; // Success message
        this.currentRecordId = response.data.newdata.record_id;
        this.recordid = response.data.newdata.record_id;
        this.record_id = response.data.newdata.record_id;
        this.record.id = response.data.newdata.record_id;
        this.formMessage.isErr = false;
        this.recordexists = true;
        this.formErrors = {};
        this.refreshUserExpertsTable();
      }, (response) => { // If invalid. error callback
        this.formMessage.isOk = false;
        this.formMessage.isErr = true;
        // Set errors from validation to vue data
        this.formErrors = response.data.error.message;
      }).bind(this);
    },

    refreshUserExpertsTable: function(){
      $.get('/experts/user/experts', function(data){
        data = $.parseJSON(data);
        $('#user-expert-tables').html(data);
      });
    },

    delTitle: function(title) {
        if(confirm('Would you like to delete this title?')==true){
            this.previousTitles.$remove(title);
        }
    },

    addTitle: function(){
        this.previousTitles.push({value: '', title:''});
    },

    delLanguage: function(language) {
        if(confirm('Would you like to delete this language?')==true){
            this.languages.$remove(language);
        }
    },

    addLanguage: function(){
        this.languages.push({value: '', language:''});
    },

    delEducation: function(education) {
        if(confirm('Would you like to delete this education?')==true){
            this.education.$remove(education);
        }
    },

    addEducation: function(){
        this.education.push({value: '', education:''});
    },

    delExpertise: function(expertise) {
        if(confirm('Would you like to delete this field of expertise?')==true){
            this.expertise.$remove(expertise);
        }
    },

    addExpertise: function(){
        this.expertise.push({value: '', expertise:''});
    },

    delSocial: function(link) {
        if(confirm('Would you like to delete this social media link?')==true){
            this.social.$remove(link);
        }
    },

    addSocial: function(){
        this.social.push({value: '', title:'', url:''});
    },
  },
  watch: {

  },

  filters: {
  },
  events: {
  }
};

</script>
