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
        <!-- Category -->
        <div v-bind:class="formGroup">
          <label>Category Name <span v-bind:class="iconStar" class="reqstar"></span></label>
          <input v-model="record.category" class="form-control" v-bind:class="[formErrors.category ? 'invalid-input' : '']" name="category" type="text">
          <p v-if="formErrors.category" class="help-text invalid">{{formErrors.category}}</p>
        </div>
      </div>
      <div v-bind:class="md6col">
          <label>Related Categories</label>
          <v-select
          :class="[formErrors.tags ? 'invalid-input' : '']"
          :value.sync="associatedCategories"
          :options="allCategories"
          :multiple="true"
          placeholder="Select related categories"
          label="category">
          </v-select>
      </div>
      <!-- /.small-12 columns -->
    </div>
    <!-- /.row -->

    <div class="row">
      <div v-bind:class="md12col">
        <div v-bind:class="formGroup">
          <button v-on:click="submitForm" type="submit" v-bind:class="btnPrimary">{{submitBtnLabel}}</button>
          <button v-if="recordexists" id="btn-delete" v-on:click="delEvent" type="submit" class="redBtn" v-bind:class="btnPrimary">Delete Category</button>
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
import vSelect from "vue-select";
import { updateRecordId, updateRecordIsDirty, updateRecordState} from '../vuex/actions';
import { getRecordId, getRecordState, getRecordIsDirty } from '../vuex/getters';
module.exports = {
  directives: {flatpickr},
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
    recordid: {
      default: ''
    },
    framework: {
      default: 'foundation'
    },
  },
  data: function() {
    return {
      ckfullyloaded: false,
      currentDate: {},
      record: {
        category: '',
        associatedCategories: [],
      },
      allCategories: [],
      associatedCategories: [],
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
      newform: false,
    }
  },
  created: function() {
  },
  ready: function() {
    if (this.recordexists){
      this.currentRecordId = this.editid;
      this.newform = false;
      this.fetchAllCategories(this.recordid);
      this.fetchAssociatedCategories(this.recordid);
      this.fetchCurrentRecord(this.recordid);
    } else {
      this.newform = true;
      this.hasContent = true;
      this.recordState = 'new';

      this.fetchAllCategories();
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
      return (this.recordexists)?'Update Category': 'Create Category'
    },
  },

  methods: {

    fetchCurrentRecord: function(recid) {
      this.$http.get('/api/expertcategory/' + recid + '/edit')

      .then((response) => {
        this.$set('record', response.data.data)
      }, (response) => {
        this.formErrors = response.data.error.message;
      }).bind(this);
    },

    fetchAllCategories: function(id){
        let route =  (this.recordexists) ? '/api/expertcategory/all/' + id : '/api/expertcategory/all/';

        // Submit form.
        this.$http.get(route) //

        .then((response) => {
          this.$set('allCategories', response.data)
        }, (response) => {
          console.log("Error fetching expert categories")
        }).bind(this);
    },

    fetchAssociatedCategories: function(id){
        this.$http.get('/api/expertcategory/associated/' + id)

        .then((response) => {
          this.$set('associatedCategories', response.data)
        }, (response) => {
          console.log("Error fetching associated categories")
        }).bind(this);
    },

    nowOnReload:function() {
      let newurl = '/admin/expertcategory/'+ this.currentRecordId+'/edit';

      document.location = newurl;
    },

    onRefresh: function() {
      this.updateRecordId(this.currentRecordId);
      this.recordState = 'edit';
      this.recordIsDirty = false;

      this.recordId = this.currentRecordId;
      this.recordexists = true;
      this.fetchCurrentRecord();
    },

    submitForm: function(e) {
      e.preventDefault(); // Stop form defualt action

      $('html, body').animate({ scrollTop: 0 }, 'fast');

      if (this.associatedCategories.length > 0) {
         this.record.associatedCategories = this.associatedCategories;
      } else {
         this.record.associatedCategories = [];
      }

      // Dicide route to submit form to
      let method = (this.recordexists) ? 'put' : 'post'
      let route =  (this.recordexists) ? '/api/expertcategory/' + this.record.id : '/api/expertcategory';

      // Submit form.
      this.$http[method](route, this.record) //

      // Do this when response gets back.
      .then((response) => {
        this.formMessage.msg = response.data.message;
        this.formMessage.isOk = response.ok; // Success message
        this.currentRecordId = response.data.newdata.record_id;
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

      if(confirm('Would you like to delete this category')==true){
        $('html, body').animate({ scrollTop: 0 }, 'fast');

        this.$http.post('/api/expertcategory/'+this.record.id+'/delete')

        .then((response) =>{
            window.location.href = "/admin/expertcategory";
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
