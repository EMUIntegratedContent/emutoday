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
        <!-- Title -->
        <div v-bind:class="formGroup">
          <label>Title <span v-bind:class="iconStar" class="reqstar"></span></label>
          <p class="help-text" id="title-helptext">Please enter a title ({{titleChars}} characters left)</p>
          <input v-model="record.title" class="form-control" v-bind:class="[formErrors.title ? 'invalid-input' : '']" name="title" type="text">
          <p v-if="formErrors.title" class="help-text invalid">{{formErrors.title}}</p>
        </div>
        <div v-if="generalForm" v-bind:class="formGroup">
          <label>Announcement <span v-bind:class="iconStar" class="reqstar"></span></i>
            <p class="help-text" id="announcement-helptext">({{descriptionChars}} characters left)</p>
            <textarea v-model="record.announcement" class="form-control" v-bind:class="[formErrors.announcement ? 'invalid-input' : '']" name="announcement" type="textarea" rows="8"></textarea>
          </label>
          <p v-if="formErrors.announcement" class="help-text invalid">{{formErrors.announcement}}</p>
        </div>
      </div>
      <!-- /.small-12 columns -->
    </div>
    <!-- /.row -->
    <div class="row">
      <div :class="md12col">
        <div v-bind:class="formGroup">
          <label>Related Link</label>
          <p class="help-text" id="title-helptext">Please enter the url for your related web page. (ex. www.yourlink.com)</p>
          <div class="input-group input-group-flat">
            <span :class="inputGroupLabel">http://</span>
            <input v-model="record.link" class="form-control" v-bind:class="[formErrors.link ? 'invalid-input' : '']" name="link" type="text">
          </div>
          <p v-if="formErrors.link" class="help-text invalid">Please make sure url is properly formed.</p>
        </div>
      </div><!-- /.col-md-4 -->
    </div><!-- /.row -->
    <div class="row">
      <div :class="md4col">
        <div v-bind:class="formGroup" class="input-group">
          <label>Meaning desciption for Link</label>
          <p class="help-text" id="link_txt-helptext">(ex. Announcement webpage)</p>
          <input v-model="record.link_txt" class="form-control" v-bind:class="[formErrors.link_txt ? 'invalid-input' : '']" name="link_txt" type="text">
          <p v-if="formErrors.link_txt" class="help-text invalid"> Please include a descriptive text for your related link.</p>
        </div>
      </div><!-- /.col-md-4 -->
      <div :class="md8col">
        <div v-bind:class="formGroup">
          <label>Example of Related Link</label>
          <p class="help-text">Below is how it may look. </p>
          <h5 class="form-control">For more information visit: <a href="#"> {{record.link_txt}}</a>.</h5>
        </div>
      </div><!-- /.md6col -->
    </div>
    <div v-if="generalForm"  class="row">
      <div :class="md12col">
        <div v-bind:class="formGroup">
          <label>Email Link</label>
          <p class="help-text" id="title-helptext">Please enter the contact person's email address. (contact@yourlink.com)</p>
          <div class="input-group input-group-flat">
            <span :class="inputGroupLabel">mailto:</span>
            <input v-model="record.email_link" class="form-control" v-bind:class="[formErrors.email_link ? 'invalid-input' : '']" name="email_link" type="text">
          </div>
          <p v-if="formErrors.email_link" class="help-text invalid">Please make sure email is properly formed.</p>
        </div>
      </div><!-- /.col-md-4 -->
    </div><!-- /.row -->
    <div v-if="generalForm" class="row">
      <div :class="md4col">
        <div v-bind:class="formGroup">
          <label>Email Link Text</label>
          <p class="help-text" id="email-link-helptext">Please enter email link text</p>
          <input v-model="record.email_link_txt" class="form-control" v-bind:class="[formErrors.email_link_txt ? 'invalid-input' : '']" name="email_link_txt" type="text">
        </div>
      </div><!-- /.col-md-4 -->
      <div :class="md8col">
        <div v-bind:class="formGroup">
          <label>Example of Email Link</label>
          <p class="help-text">Below is how it may look. </p>
          <h5 class="form-control">Contact: <a href="#"> {{record.email_link_txt}}</a>.</h5>
        </div>
      </div><!-- /.md6col -->
    </div>
    <br/>

    <div class="row">
      <div v-bind:class="md6col">
        <div v-bind:class="formGroup">
          <label for="start-date">Start Date: <span v-bind:class="iconStar" class="reqstar"></span></label>
          <input id="start-date"  v-bind:class="[formErrors.start_date ? 'invalid-input' : '']" type="text">

          <!-- <input v-if="startdate" :class="formControl" v-bind:class="[formErrors.start_date ? 'invalid-input' : '']" type="text" :value="startdate" :initval="startdate"  v-flatpickr="startdate"> -->

          <!-- <input id="start-date" :class="formControl" v-bind:class="[formErrors.start_date ? 'invalid-input' : '']" type="text" :value="record.start_date" /> -->
          <p v-if="formErrors.start_date" class="help-text invalid">Need a Start Date</p>
        </div>
        <!--form-group -->
      </div>
      <!-- /.small-6 columns -->
      <div v-bind:class="md6col">
        <div v-bind:class="formGroup">
          <!-- <input id="my-end-date" v-dtpicker ddate="currentDate" /> -->
          <label for="end-date">End Date: <span v-bind:class="iconStar" class="reqstar"></span></label>
          <input id="end-date" v-bind:class="[formErrors.end_date ? 'invalid-input' : '']" type="text" :value="record.end_date" />
          <!-- <template v-if="hasStartDate">
          <input id="end-date" v-bind:class="[formErrors.end_date ? 'invalid-input' : '']" type="text" v-model="record.end_date"   />

        </template>
        <template v-else>
        <input v-bind:class="[formErrors.end_date ? 'invalid-input' : '']" type="text" v-model="record.end_date"  disabled="disabled" />

      </template> -->
      <!-- <datepicker id="end-date" :readonly="true" format="YYYY-MM-DD" name="end-date" :value.sync="edate"></datepicker> -->
      <p v-if="formErrors.end_date" class="help-text invalid">Need an End Date</p>

    </div>
    <!--form-group -->
  </div>
  <!-- /.small-6 columns -->
</div>
<!-- /.row -->
<div class="row">
  <div v-bind:class="md12col">
    <div v-bind:class="formGroup">
      <button v-on:click="submitForm" type="submit" v-bind:class="btnPrimary">{{submitBtnLabel}}</button>
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
module.exports = {
  directives: {},
  components: {},
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
    }
  },
  data: function() {
    return {
      startdatePicker: null,
      enddatePicker: null,

      currentDate: {},
      dateObject: {
        startDateMin: '',
        startDateDefault: '',
        endDateMin:'',
        endDateDefault: ''
      },
      record: {
        title: '',
        announcement: '',
        start_date: '',
        end_date: '',
        approved_date: '',
        submission_date: '',
        is_approved: 0,
        is_archived: 0,
        is_promoted: 0,
        link_txt: '',
        link: '',
        email_link_txt: '',
        email_link: '',
        type: ''
      },
      // dateOptions: {
      //     minDate: "today",
      //     enableTime: false,
      //     altFormat: "m-d-Y",
      //     altInput: true,
      //     altInputClass:"form-control",
      //     dateFormat: "Y-m-d",
      // },
      totalChars: {
        start: 0,
        title: 50,
        hr: 80,
        announcement: 255
      },
      response: {},
      formMessage: {
        isOk: false,
        isErr: false,
        msg: ''
      },
      formInputs: {},
      formErrors: {}
    }
  },
  created: function() {
    this.currentDate = moment();
    //console.log('this.currentDate=' + this.currentDate)
  },
  ready: function() {
    this.record.type = this.type;
    if(this.recordexists){
      //console.log('recordid'+ this.recordid)
      this.fetchCurrentRecord(this.recordid)
    } else {
      if(this.type == 'hr') {
        this.record.announcement = "HR";
      }
      //console.log('type'+ this.type)
      this.setupDatePickers();
    }
  },
  // ready: function() {
  //
  //         if(this.recordexists){
  //             //console.log('editeventid'+ this.editid)
  //             this.fetchCurrentRecord(this.editid)
  //
  //         }
  //
  // },


  computed: {
    // Check announcement type. general or hr
    generalForm: function() {
      if (this.type != 'general') {
        return false;
      } else {
        return true;
      }
    },

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
      return (this.recordexists)?'Update Announcement': 'Submit For Approval'
    },

    hasStartDate: function() {
      if (this.record.start_date === undefined || this.record.start_date == '') {
        return false
      } else {
        return true
      }
    },
    titleChars: function() {
      // Calulate title field character length and return remaining characters
      var str = this.record.title;
      var totalchars = (this.type === 'hr')?this.totalChars.hr:this.totalChars.title;
      var cclength = str.length;
      return totalchars- cclength;
    },
    descriptionChars: function() {
      // Calulate announcement field character length and return remaining characters
      var str = this.record.announcement;
      var cclength = str.length;
      var totalchars = this.totalChars.announcement;
      return totalchars - cclength;
    }
  },

  methods: {
    //     checkSetEndDate: function() {
    //         document.getElementById("end-date").flatpickr({
    //             disable: [
    //                 {
    //                     from: "2016-08-16",
    //                     to: "2016-08-19"
    //                 },
    //         "2016-08-24",
    //         new Date().fp_incr(30) // 30 days from now
    //     ]
    // });
    //     },
    readyAgain: function() {

    },
    refreshUserAnnouncementTable: function(){
      $.get('/announcement/user/announcements', function(data){
        data = $.parseJSON(data);
        // //console.log(data.content);
        $('#user-announcement-tables').html(data);
      });
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
    fetchCurrentRecord: function(recid) {
      this.$http.get('/api/announcement/' + recid + '/edit')

      .then((response) => {
        //response.status;
        //console.log('response.status=' + response.status);
        //console.log('response.ok=' + response.ok);
        //console.log('response.statusText=' + response.statusText);
        //console.log('response.data=' + response.data);
        // data = response.data;
        this.$set('record', response.data.data)
        //this.record = response.data.data;
        //console.log('this.record= ' + this.record);

        this.checkOverData();
        this.record.start_time = response.data.data.start_time;
      }, (response) => {
        //error callback
        //console.log("why?"+JSON.stringify(response));

        this.formErrors = response.data.error.message;

      }).bind(this);
    },
    checkOverData: function() {
      //console.log('this.record' + this.record.id)

      // if(this.startdatePicker === null){
        this.setupDatePickers();
      // }
      // this.setupDatePickers();
      //this.startdate = this.record.start_date;

    },
    setupDatePickers:function(){
      var self = this;
      //console.log("setupDatePickers");
      if (this.record.start_date === '') {
        this.dateObject.startDateMin = this.currentDate;
        this.dateObject.startDateDefault = null;

        this.dateObject.endDateMin = null;
        this.dateObject.endDateDefault = null;
      } else {
        this.dateObject.startDateMin = this.record.start_date;
        this.dateObject.startDateDefault = this.record.start_date;
        this.dateObject.endDateMin = this.record.start_date;
        this.dateObject.endDateDefault = this.record.end_date;
      }
      this.startdatePicker = flatpickr(document.getElementById("start-date"), {
        minDate: self.dateObject.startDateMin,
        defaultDate: self.dateObject.startDateDefault,
        enableTime: false,
        // altFormat: "m-d-Y",
        altInput: true,
        altInputClass: "form-control",
        dateFormat: "Y-m-d",
        // minDate: new Date(),
        onChange(dateObject, dateString) {
          self.enddatePicker.set("minDate", dateObject);
          self.record.start_date = dateString;
          self.startdatePicker.value = dateString;
        }
      });

      this.enddatePicker = flatpickr(document.getElementById("end-date"), {
        minDate: self.dateObject.endDateMin,
        defaultDate: self.dateObject.endDateDefault,
        enableTime: false,
        // altFormat: "m-d-Y",
        altInput: true,
        altInputClass: "form-control",
        dateFormat: "Y-m-d",
        // minDate: new Date(),
        onChange(dateObject, dateString) {
          self.startdatePicker.set("maxDate", dateObject);
          self.record.end_date = dateString;
          self.enddatePicker.value = dateString;
        }
      });
    },

    submitForm: function(e) {
      e.preventDefault(); // Stop form defualt action

      $('html, body').animate({ scrollTop: 0 }, 'fast');

      this.record.type = this.type;
      console.log('sd= '+this.record.start_date);
      console.log('ed= '+this.record.end_date);

      // Dicide route to submit form to
      let method = (this.recordexists) ? 'put' : 'post'
      let route =  (this.recordexists) ? '/api/announcement/' + this.record.id : '/api/announcement';

      // Submit form.
      this.$http[method](route, this.record) //

      // Do this when response gets back.
      .then((response) => { // If valid
        //console.log('response.status=' + response.status);
        //console.log('response.ok=' + response.ok);
        //console.log('response.statusText=' + response.statusText);
        //console.log('response.data=' + response.data.message);
        this.formMessage.msg = response.data.message;
        this.formMessage.isOk = response.ok; // Success message
        this.currentRecordId = response.data.newdata.record_id;
        this.recordid = response.data.newdata.record_id;
        this.record_id = response.data.newdata.record_id;
        this.record.id = response.data.newdata.record_id;
        this.formMessage.isErr = false;
        this.recordexists = true;
        this.formErrors = {}; // Clear errors?
        this.fetchCurrentRecord(this.record.id)
        this.refreshUserAnnouncementTable();
      }, (response) => { // If invalid. error callback
        this.formMessage.isOk = false;
        this.formMessage.isErr = true;
        // Set errors from validation to vue data
        //console.log(response.data.error.message);
        this.formErrors = response.data.error.message;

      }).bind(this);
      // setTimeout(function(){
      //   location.reload();
      // },4000);
    }
  },
  watch: {

  },

  filters: {
    momentstart: {
      read: function(val) {
        //console.log('read-val' + val)

        return val ? val : '';
      },
      write: function(val, oldVal) {
        //console.log('write-val' + val + '--' + oldVal)
        return moment(val).format('MM-DD-YYYY');
      }
    },
    momentfilter: {
      read: function(val) {
        //console.log('read-val' + val)

        return val ? moment(val).format('MM-DD-YYYY') : '';
      },
      write: function(val, oldVal) {
        //console.log('write-val' + val + '--' + oldVal)

        return moment(val).format('YYYY-MM-DD');
      }
    },
  },
  events: {
    // 'building-change':function(name) {
    // 	this.newbuilding = '';
    // 	this.newbuilding = name;
    // 	//console.log(this.newbuilding);
    // },
    // 'categories-change':function(list) {
    // 	this.categories = '';
    // 	this.categories = list;
    // 	//console.log(this.categories);
    // }
  }
};

</script>
