<template>
  <form v-show="!recordexists || isAdmin">
    <slot name="csrf"></slot>
    <div class="row">
      <div v-bind:class="md12col">
        <div v-show="formMessage.isErr"  :class="calloutFail">
          <h5>There are errors.</h5>
        </div>
        <div v-show="formMessage.isOk" :class="calloutSuccess">
          <h5>{{formMessage.msg}}</h5>
        </div>
      </div>
      <!-- /.small-12 columns -->
    </div>
    <!-- /.row -->
    <div class="row" v-show="isAdmin">
        <div v-bind:class="md12col">
            <!-- Acknowledged? -->
            <div class="checkbox">
                <label><input type="checkbox" value="1" v-model="record.is_acknowledged">Acknowledged By Admin?</label>
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
        <!-- Name -->
        <div v-bind:class="formGroup">
          <label>Name <span v-bind:class="iconStar" class="reqstar">*</span></label>
          <input v-model="record.name" class="form-control" v-bind:class="[formErrors.name ? 'invalid-input' : '']" name="name" type="text">
          <p v-if="formErrors.name" class="help-text invalid">{{formErrors.name}}</p>
        </div>
      </div>
      <!-- /.small-12 columns -->
    </div>
    <!-- /.row -->
    <div class="row">
      <div v-bind:class="md12col">
        <!-- Title -->
        <div v-bind:class="formGroup">
          <label>Title <span v-bind:class="iconStar" class="reqstar">*</span></label>
          <input v-model="record.title" class="form-control" v-bind:class="[formErrors.title ? 'invalid-input' : '']" name="title" type="text">
          <p v-if="formErrors.title" class="help-text invalid">{{formErrors.title}}</p>
        </div>
      </div>
      <!-- /.small-12 columns -->
    </div>
    <!-- /.row -->
    <div class="row">
      <div v-bind:class="md12col">
        <!-- Media Outlet -->
        <div v-bind:class="formGroup">
          <label>Media Outlet <span v-bind:class="iconStar" class="reqstar">*</span></label>
          <input v-model="record.media_outlet" class="form-control" v-bind:class="[formErrors.media_outlet ? 'invalid-input' : '']" name="media_outlet" type="text">
          <p v-if="formErrors.media_outlet" class="help-text invalid">{{formErrors.media_outlet}}</p>
        </div>
      </div>
      <!-- /.small-12 columns -->
    </div>
    <!-- /.row -->
    <div class="row">
      <div v-bind:class="md6col">
        <!-- City -->
        <div v-bind:class="formGroup">
          <label>City</label>
          <input v-model="record.city" class="form-control" v-bind:class="[formErrors.city ? 'invalid-input' : '']" name="city" type="text">
          <p v-if="formErrors.city" class="help-text invalid">{{formErrors.city}}</p>
        </div>
      </div>
      <div v-bind:class="md6col">
        <!-- State -->
        <div v-bind:class="formGroup">
          <label>State</label>
          <select v-model="record.state">
              <option value="">--Select State--</option>
              <option value="AL">Alabama</option>
              <option value="AK">Alaska</option>
              <option value="AZ">Arizona</option>
              <option value="AR">Arkansas</option>
              <option value="CA">California</option>
              <option value="CO">Colorado</option>
              <option value="CT">Connecticut</option>
              <option value="DE">Delaware</option>
              <option value="DC">District Of Columbia</option>
              <option value="FL">Florida</option>
              <option value="GA">Georgia</option>
              <option value="HI">Hawaii</option>
              <option value="ID">Idaho</option>
              <option value="IL">Illinois</option>
              <option value="IN">Indiana</option>
              <option value="IA">Iowa</option>
              <option value="KS">Kansas</option>
              <option value="KY">Kentucky</option>
              <option value="LA">Louisiana</option>
              <option value="ME">Maine</option>
              <option value="MD">Maryland</option>
              <option value="MA">Massachusetts</option>
              <option value="MI">Michigan</option>
              <option value="MN">Minnesota</option>
              <option value="MS">Mississippi</option>
              <option value="MO">Missouri</option>
              <option value="MT">Montana</option>
              <option value="NE">Nebraska</option>
              <option value="NV">Nevada</option>
              <option value="NH">New Hampshire</option>
              <option value="NJ">New Jersey</option>
              <option value="NM">New Mexico</option>
              <option value="NY">New York</option>
              <option value="NC">North Carolina</option>
              <option value="ND">North Dakota</option>
              <option value="OH">Ohio</option>
              <option value="OK">Oklahoma</option>
              <option value="OR">Oregon</option>
              <option value="PA">Pennsylvania</option>
              <option value="RI">Rhode Island</option>
              <option value="SC">South Carolina</option>
              <option value="SD">South Dakota</option>
              <option value="TN">Tennessee</option>
              <option value="TX">Texas</option>
              <option value="UT">Utah</option>
              <option value="VT">Vermont</option>
              <option value="VA">Virginia</option>
              <option value="WA">Washington</option>
              <option value="WV">West Virginia</option>
              <option value="WI">Wisconsin</option>
              <option value="WY">Wyoming</option>
          </select>
          <p v-if="formErrors.city" class="help-text invalid">{{formErrors.city}}</p>
        </div>
      </div>
      <!-- /.small-12 columns -->
    </div>
    <!-- /.row -->
    <div class="row">
      <div v-bind:class="md6col">
        <!-- Phone -->
        <div v-bind:class="formGroup">
          <label>Phone <span v-bind:class="iconStar" class="reqstar">*</span></label>
          <input v-model="record.phone" class="form-control" v-bind:class="[formErrors.phone ? 'invalid-input' : '']" name="phone" type="text">
          <p v-if="formErrors.phone" class="help-text invalid">{{formErrors.phone}}</p>
        </div>
      </div>
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
    <div class="row">
      <div v-bind:class="md12col">
        <!-- Deadline -->
        <div v-bind:class="formGroup">
          <label>Deadline</label>
          <input v-model="record.deadline" class="form-control" v-bind:class="[formErrors.deadline ? 'invalid-input' : '']" name="deadline" type="text">
          <p v-if="formErrors.deadline" class="help-text invalid">{{formErrors.deadline}}</p>
        </div>
      </div>
      <!-- /.small-12 columns -->
    </div>
    <!-- /.row -->
    <div class="row">
      <div v-bind:class="md12col">
        <!-- Interview type -->
        <label>Interview Details <span v-bind:class="iconStar" class="reqstar">*</span></label>
        <div v-bind:class="formGroup">
          <label for="inperson_int"><input type="radio" id="inperson_int" value="In-person" v-model="record.interview_type">&nbsp;In-person</label>
        </div>
        <div v-bind:class="formGroup">
          <label for="phone_int"><input type="radio" id="phone_int" value="Phone" v-model="record.interview_type">&nbsp;Phone</label>
        </div>
        <div v-bind:class="formGroup">
          <label for="oncamera_int"><input type="radio" id="oncamera_int" value="On-camera" v-model="record.interview_type">&nbsp;On-camera</label>
        </div>
        <div v-bind:class="formGroup">
          <label for="instudio_int"><input type="radio" id="instudio_int" value="In-studio" v-model="record.interview_type">&nbsp;In-studio</label>
        </div>
        <p v-if="formErrors.interview_type" class="help-text invalid">{{formErrors.interview_type}}</p>
      </div>
      <!-- /.small-12 columns -->
    </div>
    <!-- /.row -->
    <div class="row">
      <div v-bind:class="md12col">
        <!-- Deadline -->
        <div v-bind:class="formGroup">
          <label>Describe your story <span v-bind:class="iconStar" class="reqstar">*</span></label>
          <textarea v-model="record.description" class="form-control" v-bind:class="[formErrors.description ? 'invalid-input' : '']" name="description"></textarea>
          <p v-if="formErrors.description" class="help-text invalid">{{formErrors.description}}</p>
        </div>
      </div>
      <!-- /.small-12 columns -->
    </div>
    <!-- /.row -->
    <div class="row">
      <div v-bind:class="md12col">
        <div v-bind:class="formGroup">
          <button v-on:click="submitForm" type="submit" v-bind:class="btnPrimary">{{ isAdmin ? 'Edit Request' : 'Send Request' }}</button>
          <input v-model="record.honeypot" class="form-control" v-bind:class="[formErrors.honeypot ? 'invalid-input' : '']" name="honeypot" type="text" id="honeypot">
        </div>
      </div>
    </div>
    <!-- /.row -->
</form>
    <div class="row" v-show="recordexists && !isAdmin">
        <div v-bind:class="md12col">
            <div v-show="formMessage.isOk" :class="calloutSuccess">
              <h5>{{formMessage.msg}}</h5>
            </div>
            <p><strong>An administrator will review your request soon. Here are the details of your submission.</strong></p>
            <ul>
                <li>
                    Expert: {{ selectedExpert.first_name }} {{ selectedExpert.last_name }}
                </li>
                <li>
                    Your Name: {{ record.name }}
                </li>
                <li>
                    Your Title: {{ record.title }}
                </li>
                <li>
                    Media Outlet: {{ record.media_outlet }}
                </li>
                <li>
                    City: {{ record.city }}
                </li>
                <li>
                    State: {{ record.state }}
                </li>
                <li>
                    Phone: {{ record.phone }}
                </li>
                <li>
                    Email: {{ record.email }}
                </li>
                <li>
                    Deadline: {{ record.deadline }}
                </li>
                <li>
                    Interview Type: {{ record.interview_type }}
                </li>
                <li>
                    Description of Story: {{ record.description }}
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
    isAdmin: {
        default: false
    },
    requestId: {
        default: ''
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
        name: '',
        title: '',
        media_outlet: '',
        city: '',
        state: '',
        phone: '',
        email: '',
        deadline: '',
        interview_type: '',
        is_acknowledged: 0,
        description: '',
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

      // If on the admin side, get the record to edit
      if(this.isAdmin){
          this.fetchRequest();
      } else {
          this.getSelectedSpeaker();
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
  },

  methods: {

      // For admin side only!
      fetchRequest: function(){
          this.$http.get('/api/expertmediarequest/' + this.requestId) //

          .then((response) => {
            this.$set('record', response.data.newdata)
          }, (response) => {
          }).bind(this);
      },

      // Takes the Expert ID from the URL and sets that expert as the selected expert on page load
      getSelectedSpeaker: function(){
          if(this.expertId){
              this.record.expert_id = this.expertId;
          }
      },

      fetchExperts: function(){
          this.$http.get('/api/experts/list', {params: {type: 'media'}})

          .then((response) => {
            this.$set('experts', response.data.newdata)
          }, (response) => {
            this.expertListError = "Unable to fetch experts list.";
          }).bind(this);
      },

      getSelectedExpert: function(){
          this.$http.get('/api/experts/list/' + this.record.expert_id) //

          .then((response) => {
            this.$set('selectedExpert', response.data.newdata[0])
          }, (response) => {
          }).bind(this);
      },

    submitForm: function(e) {
      e.preventDefault(); // Stop form defualt action

      $('html, body').animate({ scrollTop: 0 }, 'fast');

      // Decide route to submit form to
      let method = (this.isAdmin) ? 'put' : 'post'
      let route =  (this.isAdmin) ? '/api/expertmediarequest/' + this.record.id : '/api/expertmediarequest';

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
