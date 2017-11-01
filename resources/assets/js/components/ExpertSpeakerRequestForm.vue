<template>
  <form v-show="!recordexists">
    <slot name="csrf"></slot>
    <div class="row">
      <div v-bind:class="md12col">
        <div v-show="formMessage.isErr"  :class="calloutFail">
          <h5>There are errors.</h5>
        </div>
      </div>
      <!-- /.small-12 columns -->
    </div>
    <!-- /.row -->
    <div class="row">
      <div v-bind:class="md12col">
        <!-- Expert -->
        <div v-if="this.expertListError != ''">
            {{ this.expertListError }}
        </div>
        <div v-bind:class="formGroup">
          <label>Expert <span v-bind:class="iconStar" class="reqstar">*</span></label>
          <select v-model="record.expert_id" v-bind:class="[formErrors.expert_id ? 'invalid-input' : '']" name="expert_id">
              <option v-for="expert in experts" value="{{ expert.id }}">{{ expert.last_name }}, {{ expert.first_name}}</option>
          </select>
          <p v-if="formErrors.expert_id" class="help-text invalid">{{formErrors.expert_id}}</p>
        </div>
      </div>
      <!-- /.small-12 columns -->
    </div>
    <!-- /.row -->
    <div class="row">
      <div v-bind:class="md12col">
        <!-- Organization Name -->
        <div v-bind:class="formGroup">
          <label>Name of your organization <span v-bind:class="iconStar" class="reqstar">*</span></label>
          <input v-model="record.organization" class="form-control" v-bind:class="[formErrors.organization ? 'invalid-input' : '']" name="organization" type="text">
          <p v-if="formErrors.organization" class="help-text invalid">{{formErrors.organization}}</p>
        </div>
      </div>
      <!-- /.small-12 columns -->
    </div>
    <!-- /.row -->
    <div class="row">
      <div v-bind:class="md12col">
        <!-- Organization Description -->
        <div v-bind:class="formGroup">
          <label>Describe your organization</label>
          <textarea v-model="record.org_description" class="form-control" v-bind:class="[formErrors.org_description ? 'invalid-input' : '']" name="org_description"></textarea>
          <p v-if="formErrors.org_description" class="help-text invalid">{{formErrors.org_description}}</p>
        </div>
      </div>
      <!-- /.small-12 columns -->
    </div>
    <!-- /.row -->
    <div class="row">
      <div v-bind:class="md12col">
        <!-- Your organization's website -->
        <div v-bind:class="formGroup">
          <label>Your organization's website</label>
          <input v-model="record.org_website" class="form-control" v-bind:class="[formErrors.org_website ? 'invalid-input' : '']" name="org_website" type="text">
          <p v-if="formErrors.org_website" class="help-text invalid">{{formErrors.org_website}}</p>
        </div>
      </div>
      <!-- /.small-12 columns -->
    </div>
    <!-- /.row -->
    <div class="row">
      <div v-bind:class="md4col">
        <!-- Contact Name -->
        <div v-bind:class="formGroup">
          <label>Contact Name <span v-bind:class="iconStar" class="reqstar">*</span></label>
          <input v-model="record.contact_name" class="form-control" v-bind:class="[formErrors.contact_name ? 'invalid-input' : '']" name="contact_name" type="text">
          <p v-if="formErrors.contact_name" class="help-text invalid">{{formErrors.contact_name}}</p>
        </div>
      </div>
      <div v-bind:class="md4col">
        <!-- Contact Phone -->
        <div v-bind:class="formGroup">
          <label>Contact Phone <span v-bind:class="iconStar" class="reqstar">*</span></label>
          <input v-model="record.contact_phone" class="form-control" v-bind:class="[formErrors.contact_phone ? 'invalid-input' : '']" name="contact_phone" type="text">
          <p v-if="formErrors.contact_phone" class="help-text invalid">{{formErrors.contact_phone}}</p>
        </div>
      </div>
      <div v-bind:class="md4col">
        <!-- Contact Phone -->
        <div v-bind:class="formGroup">
          <label>Contact Email <span v-bind:class="iconStar" class="reqstar">*</span></label>
          <input v-model="record.contact_email" class="form-control" v-bind:class="[formErrors.contact_email ? 'invalid-input' : '']" name="contact_email" type="email">
          <p v-if="formErrors.contact_email" class="help-text invalid">{{formErrors.contact_email}}</p>
        </div>
      </div>
      <!-- /.small-12 columns -->
    </div>
    <!-- /.row -->
    <div class="row">
      <div v-bind:class="md12col">
        <!-- Speaking date -->
        <div v-bind:class="formGroup">
          <label>When do you need the speaker?  <span v-bind:class="iconStar" class="reqstar">*</span></label>
          <input v-model="record.time_needed" class="form-control" v-bind:class="[formErrors.time_needed ? 'invalid-input' : '']" name="time_needed" id="time_needed" type="text">
          <p v-if="formErrors.time_needed" class="help-text invalid">{{formErrors.time_needed}}</p>
        </div>
      </div>
      <!-- /.small-12 columns -->
    </div>
    <!-- /.row -->
    <div class="row">
      <div v-bind:class="md12col">
        <!-- Length -->
        <div v-bind:class="formGroup">
          <label>Length of presentation <span v-bind:class="iconStar" class="reqstar">*</span></label>
          <input v-model="record.length_of_presentation" class="form-control" v-bind:class="[formErrors.length_of_presentation ? 'invalid-input' : '']" name="length_of_presentation" type="text">
          <p v-if="formErrors.length_of_presentation" class="help-text invalid">{{formErrors.length_of_presentation}}</p>
        </div>
      </div>
      <!-- /.small-12 columns -->
    </div>
    <!-- /.row -->
    <div class="row">
      <div v-bind:class="md12col">
        <!-- Event location -->
        <div v-bind:class="formGroup">
          <label>Event location <span v-bind:class="iconStar" class="reqstar">*</span></label>
          <input v-model="record.location" class="form-control" v-bind:class="[formErrors.location ? 'invalid-input' : '']" name="location" type="text">
          <p v-if="formErrors.location" class="help-text invalid">{{formErrors.location}}</p>
        </div>
      </div>
      <!-- /.small-12 columns -->
    </div>
    <!-- /.row -->
    <div class="row">
      <div v-bind:class="md12col">
        <!-- Deadline -->
        <div v-bind:class="formGroup">
          <label>Describe event</label>
          <textarea v-model="record.event_description" class="form-control" v-bind:class="[formErrors.event_description ? 'invalid-input' : '']" name="event_description"></textarea>
          <p v-if="formErrors.event_description" class="help-text invalid">{{formErrors.event_description}}</p>
        </div>
      </div>
      <!-- /.small-12 columns -->
    </div>
    <!-- /.row -->
    <div class="row">
      <div v-bind:class="md12col">
        <!-- Topic -->
        <div v-bind:class="formGroup">
          <label>Preferred lecture topic <span v-bind:class="iconStar" class="reqstar">*</span></label>
          <input v-model="record.topic" class="form-control" v-bind:class="[formErrors.topic ? 'invalid-input' : '']" name="topic" type="text">
          <p v-if="formErrors.topic" class="help-text invalid">{{formErrors.topic}}</p>
        </div>
      </div>
      <!-- /.small-12 columns -->
    </div>
    <!-- /.row -->
    <div class="row">
      <div v-bind:class="md12col">
        <div v-bind:class="formGroup">
          <button v-on:click="submitForm" type="submit" v-bind:class="btnPrimary">Send Request</button>
          <input v-model="record.honeypot" class="form-control" v-bind:class="[formErrors.honeypot ? 'invalid-input' : '']" name="honeypot" type="text" id="honeypot">
        </div>
      </div>
    </div>
    <!-- /.row -->
</form>
    <div class="row" v-show="recordexists">
        <div v-bind:class="md12col">
            <div v-show="formMessage.isOk" :class="calloutSuccess">
              <h5>{{formMessage.msg}}</h5>
            </div>
            <p><strong>Here are the details of your submission.</strong></p>
            <ul>
                <li>
                    Expert: {{ selectedExpert.first_name }} {{ selectedExpert.last_name }}
                </li>
                <li>
                    Organization: {{ record.organization }}
                </li>
                <li>
                    Organization Description: {{ record.org_description }}
                </li>
                <li>
                    Organization Website: {{ record.org_website }}
                </li>
                <li>
                    Contact Name: {{ record.contact_name }}
                </li>
                <li>
                    Contact Phone: {{ record.contact_phone }}
                </li>
                <li>
                    Contact Email: {{ record.contact_email }}
                </li>
                <li>
                    Date of Event: {{ record.time_needed }}
                </li>
                <li>
                    Length of Presentation: {{ record.length_of_presentation }}
                </li>
                <li>
                    EventDescription: {{ record.event_description }}
                </li>
                <li>
                    Topic: {{ record.topic }}
                </li>
            </ul>
        </div>
    </div>
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
#honeypot{
    display: none;
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
import vSelect from "vue-select";
module.exports = {
  directives: {flatpickr},
  components: {vSelect},
  props: {
    errors: {
      default: ''
    },
    framework: {
      default: 'foundation'
    },
    expertId: {
        default: ''
    }
  },
  data: function() {
    return {
      expertListError: '',
      experts: {},
      formErrors: {},
      formInputs: {},
      formMessage: {
        isOk: false,
        isErr: false,
        msg: ''
      },
      record: {
        id: '',
        organization: '',
        org_description: '',
        org_website: '',
        contact_name: '',
        contact_phone: '',
        contact_email: '',
        time_needed: '',
        length_of_presentation: '',
        location: '',
        event_description: '',
        topic: '',
        expert_id: '',
        honeypot: '',
      },
      recordexists: false,
      response: {},
      selectedExpert: {},
    }
  },
  created: function () {

  },
  ready: function() {
      this.fetchExperts();
      this.setupDatePicker();
      this.getSelectedSpeaker();
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
  },

  methods: {
      fetchExperts: function(){
          this.$http.get('/api/experts/list', {params: {type: 'speaker'}})

          .then((response) => {
            this.$set('experts', response.data.newdata)
          }, (response) => {
            this.expertListError = "Unable to fetch experts list.";
          }).bind(this);
      },

      // Takes the Expert ID from the URL and sets that expert as the selected expert on page load
      getSelectedSpeaker: function(){
          if(this.expertId){
              this.record.expert_id = this.expertId;
          }
      },

      getSelectedExpert: function(){
          this.$http.get('/api/experts/list/' + this.record.expert_id) //

          .then((response) => {
            this.$set('selectedExpert', response.data.newdata[0])
          }, (response) => {
            console.log("Unable to fetch experts.");
          }).bind(this);
      },

      setupDatePicker:function(){
          var self = this;

        this.record.time_needed = this.currentDate;
        this.startdatePicker = flatpickr(document.getElementById("time_needed"), {
          minDate: "today",
          defaultDate: "today",
          enableTime: true,
          onChange(dateObject, dateString) {
              self.record.time_needed = dateString;
              console.log(dateString);
          }

        });
    },

    submitForm: function(e) {
      e.preventDefault(); // Stop form defualt action

      $('html, body').animate({ scrollTop: 0 }, 'fast');

      // Decide route to submit form to
      let method = 'post'
      let route =  '/api/expertspeakerrequest';

      // Submit form.
      this.$http[method](route, this.record) //

      // Do this when response gets back.
      .then((response) => {
        this.formMessage.msg = response.data.message;
        this.formMessage.isOk = response.ok; // Success message
        this.record_id = response.data.newdata.record_id;
        this.formMessage.isErr = false;
        this.recordexists = true;
        this.formErrors = {};

        this.getSelectedExpert()
      }, (response) => { // If invalid. error callback
        this.formMessage.isOk = false;
        this.formMessage.isErr = true;
        // Set errors from validation to vue data
        this.formErrors = response.data.error.message;
      }).bind(this);
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
