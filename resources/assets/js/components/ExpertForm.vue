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
      <div v-bind:class="md6col">
        <!-- First Name -->
        <div v-bind:class="formGroup">
          <label>First Name <span v-bind:class="iconStar" class="reqstar"></span></label>
          <input v-model="record.first_name" class="form-control" v-bind:class="[formErrors.first_name ? 'invalid-input' : '']" name="first_name" type="text">
          <p v-if="formErrors.first_name" class="help-text invalid">{{formErrors.first_name}}</p>
        </div>
      </div>
      <div v-bind:class="md6col">
        <!-- Last Name -->
        <div v-bind:class="formGroup">
          <label>Last Name <span v-bind:class="iconStar" class="reqstar"></span></label>
          <input v-model="record.last_name" class="form-control" v-bind:class="[formErrors.last_name ? 'invalid-input' : '']" name="last_name" type="text">
          <p v-if="formErrors.last_name" class="help-text invalid">{{formErrors.last_name}}</p>
        </div>
      </div>
      <!-- /.small-12 columns -->
    </div>
    <!-- /.row -->
    <div class="row">
      <div v-bind:class="md6col">
        <!-- First Name -->
        <div v-bind:class="formGroup">
          <label>Title <span v-bind:class="iconStar" class="reqstar"></span></label>
          <input v-model="record.title" class="form-control" v-bind:class="[formErrors.title ? 'invalid-input' : '']" name="title" type="text">
          <p v-if="formErrors.title" class="help-text invalid">{{formErrors.title}}</p>
        </div>
      </div>
      <div v-bind:class="md6col">
        <!-- Last Name -->
        <div v-bind:class="formGroup">
          <label>Expertise</label>
          <input v-model="record.expertise" class="form-control" v-bind:class="[formErrors.expertise ? 'invalid-input' : '']" name="expertise" type="text">
          <p v-if="formErrors.expertise" class="help-text invalid">{{formErrors.expertise}}</p>
        </div>
      </div>
      <!-- /.small-12 columns -->
    </div>
    <!-- /.row -->
    <div class="row">
      <div v-bind:class="md12col">
        <!-- First Name -->
        <div v-bind:class="formGroup">
          <label>About <span v-bind:class="iconStar" class="reqstar"></span></label>
          <!--<textarea v-model="record.about" id="about" name="about" rows="200"></textarea>-->
          <textarea v-if="hasContent" v-model="record.about" id="about" name="about" v-ckrte="about" :type="editorType" :about="about" :fresh="isFresh" rows="200"></textarea>
          <p v-if="formErrors.about" class="help-text invalid">Need Content!</p>
        </div>
      </div>
    </div>
   <!-- /.row -->
    <div class="row">
      <div v-bind:class="md12col">
        <!-- Last Name -->
        <div v-bind:class="formGroup">
          <label>Education <span v-bind:class="iconStar" class="reqstar"></span></label>
          <input v-model="record.education" class="form-control" v-bind:class="[formErrors.education ? 'invalid-input' : '']" name="education" type="text">
          <p v-if="formErrors.education" class="help-text invalid">{{formErrors.education}}</p>
        </div>
      </div>
      <!-- /.small-12 columns -->
    </div>
    <!-- /.row -->
    <div class="row">
      <div v-bind:class="md12col">
        <!-- Last Name -->
        <div v-bind:class="formGroup">
          <label>Expertise Categories <span v-bind:class="iconStar" class="reqstar"></span></label>
          <v-select
          :class="[formErrors.tags ? 'invalid-input' : '']"
          :value.sync="categories"
          :options="categorieslist"
          :multiple="true"
          placeholder="Select expertise category"
          label="category">
          </v-select>
          <p v-if="formErrors.category" class="help-text invalid">{{formErrors.category}}</p>
        </div>
      </div>
      <!-- /.small-12 columns -->
    </div>
    <!-- /.row -->
    <div class="row">
      <div v-bind:class="md12col">
        <div v-bind:class="formGroup">
          <button v-on:click="submitForm" type="submit" v-bind:class="btnPrimary">{{submitBtnLabel}}</button>
          <button v-if="recordexists" id="btn-delete" v-on:click="delEvent" type="submit" class="redBtn" v-bind:class="btnPrimary">Delete Expert</button>
        </div>
      </div>
    </div>

</form>
</template>

<style scoped>
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
  margin-top: 0.8rem;
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
      about: '',
      ckfullyloaded: false,
      contactManuallyChanged: false,
      currentDate: {},
      categories: [],
      categorieslist: [],
      newform: false,
      recordState: '',
      recordOld: {
        id: '',
        first_name: '',
        last_name: '',
        title: '',
        expertise: '',
        about: '',
        education: '',
      },
      record: {
        id: '',
        first_name: '',
        last_name: '',
        title: '',
        expertise: '',
        about: '',
        education: '',
        categories: [],
      },
      totalChars: {
        title: 50,
      },
      response: {},
      formMessage: {
        isOk: false,
        isErr: false,
        msg: ''
      },
      formInputs: {},
      formErrors: {},
      isFresh: true,
      hasContent: false,
      about: '',
      recordState: '',
      userRoles: [],
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
      return (this.recordexists)?'Update Expert': 'Create Expert'
    },

    editorType:function(){
      if(this.isAdmin){
        return 'simple'
      } else {
        return 'simple'
      }
    },

    changeContact:function(evt) {
      this.contactManuallyChanged = true;
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

      getUserRoles(){

        let roles = this.cuserRoles;
        let self = this;
        this.userRoles = [];
        if (roles.length > 0) {
          roles.forEach(function(item,index){
            self.userRoles.push(item.name);
          })
        } else {
          self.userRoles.push('guest');
        }



      },

    fetchCurrentRecord: function(recid) {
      this.$http.get('/api/experts/' + recid + '/edit')

      .then((response) => {
        this.$set('record', response.data.data)
        this.$set('recordOld', response.data.data)

        this.hasContent = true;
        this.currentRecordId = this.record.id;
        this.about = this.record.about;
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

    // Fetch the category that matches THIS record
    fetchCurrentCategory(){
        this.$http.get('/api/experts/category/'+ this.currentRecordId)
            .then((response) => {
                this.$set('categories', response.data);
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

    submitForm: function(e) {
      e.preventDefault(); // Stop form defualt action

      $('html, body').animate({ scrollTop: 0 }, 'fast');

      this.record.about = this.about;

      if (this.categories.length > 0) {
         this.record.categories = this.categories;
      } else {
         this.record.categories = [];
      }

      // Dicide route to submit form to
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

    delEvent: function(e) {
        e.preventDefault();
        this.formMessage.isOk = false;
        this.formMessage.isErr = false;

        if(confirm('Would you like to delete this expert')==true){
          $('html, body').animate({ scrollTop: 0 }, 'fast');

          this.$http.post('/api/experts/'+this.record.id+'/delete')

          .then((response) =>{
              window.location.href = "/admin/experts/list";
          }, (response) => {
            console.log('Error: '+JSON.stringify(response))
          }).bind(this);
        }
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
