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
        <!-- Title -->
        <div v-bind:class="formGroup">
          <label>
            Title <span v-bind:class="iconStar" class="reqstar"></span>
            <p class="help-text" id="title-helptext">({{ titleChars }} characters left)</p>
          </label>
          <input v-model="record.title" class="form-control" v-bind:class="[formErrors.title ? 'invalid-input' : '']"
                 name="title" type="text">
          <p v-if="formErrors.title" class="help-text invalid">{{ formErrors.title }}</p>
        </div>
      </div>
    </div>
    <div class="row">
      <div v-bind:class="md12col">
        <!-- URL -->
        <div v-bind:class="formGroup">
          <label>URL <span v-bind:class="iconStar" class="reqstar"></span></label>
          <div class="input-group">
            <span class="input-group-addon">http://</span>
            <input v-model="record.url" class="form-control" v-bind:class="[formErrors.url ? 'invalid-input' : '']"
                   name="url" type="text">
          </div>
          <p v-if="formErrors.url" class="help-text invalid">{{ formErrors.url }}</p>
        </div>
      </div>
      <!-- /.small-12 columns -->
    </div>
    <!-- /.row -->
    <div class="row">
      <div v-bind:class="md6col">
        <div v-bind:class="formGroup">
          <label>Source Name: <span v-bind:class="iconStar" class="reqstar"></span></label>
          <input v-model="record.source" class="form-control" v-bind:class="[formErrors.source ? 'invalid-input' : '']"
                 type="text"/>
          <p v-if="formErrors.source" class="help-text invalid">Need a source</p>
        </div> <!--form-group -->
      </div> <!-- /.small-6 columns -->
      <div v-bind:class="md6col">
        <div v-bind:class="formGroup">
          <label for="start-date">Highlight Date: <span v-bind:class="iconStar" class="reqstar"></span><br>
            <flatpickr
                v-model="record.start_date"
                id="start-date"
                :config="flatpickrConfig"
                class="form-control"
                name="startingDate"
                v-bind:class="[formErrors.start_date ? 'invalid-input' : '']"
            >
            </flatpickr>
          </label>
          <p v-if="formErrors.start_date" class="help-text invalid">Need a highlight date</p>
        </div> <!--form-group -->
      </div> <!-- /.small-6 columns -->
    </div> <!-- /.row -->
    <div class="row">
      <div class="col-md-6">
        <div class="form-group">
          <label>Tags:</label>
          <v-select
              :class="[formErrors.tags ? 'invalid-input' : '']"
              v-model="record.tags"
              :options="taglist"
              :multiple="true"
              placeholder="Select tags"
              label="name">
          </v-select>
        </div><!-- /.form-group -->
      </div><!-- /.small-6 columns -->
      <div class="col-sm-6">
        <label style="visibility:hidden">Add unlisted tag</label>
        <div class="input-group" :class="successFailure">
            <span class="input-group-btn">
              <button class="btn btn-primary" type="button"
                      @click.prevent="toggleAddTag">{{ showAddTag ? 'Hide me' : 'Add unlisted tag' }}</button>
            </span>
          <input v-if="showAddTag" type="text" v-model="newTag" class="form-control"
                 placeholder="new tag name goes here">
          <span v-if="showAddTag" class="input-group-btn">
              <button class="btn btn-default" type="button" @click.prevent="saveNewTag"><i class="fa fa-plus-square"
                                                                                           aria-hidden="true"></i></button>
            </span>
        </div><!-- /input-group -->
        <p v-if="showAddTag && formErrors.name" class="help-text invalid">{{ formErrors.name }}</p>
        <p v-if="showAddTag && formSuccess.tags" class="help-text valid">{{ formSuccess.tags }}</p>
      </div><!-- /.small-6 columns -->
    </div> <!-- /.row -->
    <div class="row">
      <div v-bind:class="md12col">
        <div v-bind:class="formGroup">
          <button v-on:click="submitForm" type="submit" v-bind:class="btnPrimary">{{ submitBtnLabel }}</button>
        </div>
      </div>
    </div>
  </form>
</template>

<style scoped>
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

.valid {
  color: #3c763d;
}

.invalid {
  color: #ff0000;
}

.reqstar {
  font-size: .6rem;
  color: #E33100;
  vertical-align: text-top;
}

elect {
  margin: 0;
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
import vSelect from "vue-select"
import 'vue-select/dist/vue-select.css'
import flatpickr from 'vue-flatpickr-component'
import 'flatpickr/dist/flatpickr.css'
import 'vue-select/dist/vue-select.css'

export default {
  components: { vSelect, flatpickr },
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
    type: {
      default: 'general'
    },
    user: {
      default: ''
    },
    user_id: '',
  },
  data: function () {
    return {
      newform: false,
      tags: [],
      taglist: [],
      startdatePicker: null,
      currentDate: {},
      dateObject: {
        startDateMin: '',
        startDateDefault: '',
      },
      record: {
        id: 0,
        title: '',
        url: '',
        source: '',
        is_archived: false,
        priority: 0,
        start_date: null,
        tags: [],
      },
      totalChars: {
        title: 250,
      },
      newTag: null,
      showAddTag: false,
      response: {},
      formMessage: {
        isOk: false,
        isErr: false,
        msg: ''
      },
      formInputs: {},
      formErrors: {},
      formSuccess: {
        tags: [],
      },
      flatpickrConfig: {
        altFormat: "m/d/Y", // format the user sees
        altInput: true,
        dateFormat: "Y-m-d", // format sumbitted to the API
      }
    }
  },
  created: function () {
    if (this.recordexists) {
      this.fetchCurrentRecord(this.recordid)
    }
    else {
      this.newform = true
    }
    this.fetchTagsList()
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
    // Switch verbage of submit button.
    submitBtnLabel: function () {
      return (this.recordexists) ? 'Update' : 'Create'
    },
    titleChars: function () {
      // Calulate title field character length and return remaining characters
      const str = this.record.title
      const totalchars = this.totalChars.title
      const cclength = str.length
      return totalchars - cclength
    },
    successFailure: function () {
      return {
        'has-success': this.formSuccess.tags != '',
        'has-error': this.formErrors.name
      }
    }
  },
  methods: {
    fetchSubmittedRecord: function (recid) {
      // Sets params for update record, Passes an id to fetchCurrentRecord
      this.recordexists = true;
      this.formMessage.isOk = false;
      this.formMessage.isErr = false;
      this.recordid = recid;
      this.formErrors = {};
      this.fetchCurrentRecord(recid);
    },

    fetchCurrentRecord: function (recid) {
      this.$http.get('/api/mediahighlights/' + recid + '/edit')

      .then((response) => {
        this.record = response.data.data
        this.fetchCurrentTags()
      }).catch((e) => {
        this.formErrors = e.response.data.error.message
      })
    },

    nowOnReload: function () {
      let newurl = '/admin/mediahighlights/' + this.record.id + '/edit'
      document.location = newurl
    },

    onRefresh: function () {
      this.fetchCurrentRecord(this.record.id)
    },

    submitForm: function (e) {
      e.preventDefault(); // Stop form defualt action

      $('html, body').animate({ scrollTop: 0 }, 'fast')

      this.record.type = this.type;

      // Dicide route to submit form to
      let method = (this.recordexists) ? 'put' : 'post'
      let route = (this.recordexists) ? '/api/mediahighlights/' + this.record.id : '/api/mediahighlights'

      // Submit form.
      this.$http[method](route, this.record) //

      // Do this when response gets back.
      .then((response) => {
        this.formMessage.msg = response.data.message
        this.formMessage.isOk = true // Success message
        this.record.id = response.data.newdata.record_id
        this.formMessage.isErr = false
        this.formErrors = {}

        if (this.newform) {
          this.nowOnReload()
        }
        else {
          this.onRefresh()
        }
      }).catch((e) => {
        this.formMessage.isOk = false
        this.formMessage.isErr = true
        // Set errors from validation to vue data
        this.formErrors = e.response.data.error.message
      })
    },
    // Fetch the tags that match THIS record
    fetchTagsList: function () {
      this.$http.get('/api/mediahighlights/taglist')
      .then((response) => {
        this.taglist = response.data.newdata
      }).catch((e) => {
        this.formErrors = e.response.data.error.message
      })
    },
    fetchCurrentTags: function () {
      this.$http.get('/api/mediahighlights/taglist/' + this.record.id)
      .then((response) => {
        this.tags = response.data.newdata
      }).catch((e) => {
        this.formErrors = e.response.data.error.message
      })
    },
    /**
     * Save a previously unlisted tag mediahighlight_tags database table
     */
    saveNewTag: function () {
      let method = 'post'
      let route = '/api/mediahighlights/tag/store'

      let tagObj = { name: this.newTag }

      // Submit form.
      this.$http[method](route, tagObj)

      // Do this when response gets back.
      .then((response) => {
        this.formSuccess.tags = [] //clear form success
        this.formErrors = {}
        this.formSuccess.tags.push(response.data.message) //create success message

        this.fetchTagsList() //get updated list of recipients
      }).catch((e) => { // If invalid. error callback
        this.formSuccess.tags = []
        this.formErrors = e.response.data.error.message // Set errors from validation to vue data
      })
    },

    toggleCallout: function (evt) {
      this.formMessage.isOk = false
      this.formMessage.isErr = false
    },

    /**
     * Controls if add tag fields are shown
     */
    toggleAddTag: function () {
      this.showAddTag ? this.showAddTag = false : this.showAddTag = true
      this.formSuccess.tags = []
      this.formErrors = {}
      this.newTag = null
    },
  }
}

</script>
