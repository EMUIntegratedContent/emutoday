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

    <div class="row">
      <div v-bind:class="md12col">
        <div v-bind:class="formGroup">
          <div>
            <label>Title <span v-bind:class="iconStar" class="reqstar"></span></label>
            <p class="help-text" id="title-helptext">Please enter a title ({{ titleChars }} characters left)</p>
            <input v-model="record.title" class="form-control" v-bind:class="[formErrors.title ? 'invalid-input' : '']"
                   name="title" type="text" maxlength="80">
            <p v-if="formErrors.title" class="help-text invalid">{{ formErrors.title }}</p>
          </div>
        </div>
      </div>
    </div>

    <div v-if="generalForm" class="row">
      <div v-bind:class="md12col">
        <div v-bind:class="formGroup">
          <div v-bind:class="formGroup">
            <label>Announcement <span v-bind:class="iconStar" class="reqstar"></span>
              <p class="help-text" id="announcement-helptext">({{ descriptionChars }} characters left)</p>
            </label>
            <textarea v-model="record.announcement" class="form-control"
                      v-bind:class="[formErrors.announcement ? 'invalid-input' : '']" name="announcement"
                      type="textarea" rows="8" maxlength="255"></textarea>
            <p v-if="formErrors.announcement" class="help-text invalid">{{ formErrors.announcement }}</p>
          </div>
        </div>
      </div>
      <!-- /.small-12 columns -->
    </div>

    <!-- /.row  -->
    <div>
      <div class="row">
        <div :class="md12col">
          <div v-bind:class="formGroup">
            <label>Related Link</label>
            <p class="help-text" id="title-helptext">Please enter the url for your related web page. (ex.
              www.yourlink.com)</p>
            <div class="input-group input-group-flat">
              <span :class="inputGroupLabel">http://</span>
              <input v-model="record.link" class="form-control" v-bind:class="[formErrors.link ? 'invalid-input' : '']"
                     name="link" type="text" maxlength="200">
            </div>
            <p v-if="formErrors.related_link_1" class="help-text invalid">Please make sure url is properly formed.</p>
          </div>
        </div><!-- /.col-md-4 -->
      </div><!-- /.row -->

      <div class="row" v-if="generalForm">
        <div :class="md12col">
          <div v-bind:class="formGroup">
            <label class="hidden" aria-label="Descriptive text for web page">Descriptive text for web page</label>
            <p class="help-text" id="title-helptext">Please add descriptive text for link. <strong>Do not use web
              address.</strong> (ex. My Announcement Webpage)</p>
            <input v-model="record.link_txt" class="form-control"
                   v-bind:class="[formErrors.link_txt ? 'invalid-input' : '']" name="link_txt" type="text"
                   maxlength="80">
            <p v-if="formErrors.link_txt" class="help-text invalid"> Please include a descriptive text for your related
              link.</p>
          </div>
        </div>
        <div v-if="record.link != ''" :class="md12col">
          <p>For more information visit: <a :href="record.link">{{ record.link_txt }}</a></p>
        </div>
      </div>
    </div>

    <br v-if="framework == 'bootstrap' && generalForm"/>

    <div v-if="generalForm" class="row">
      <div :class="md12col">
        <div v-bind:class="formGroup">
          <label>Contact Person</label>
          <input v-model="record.email_link_txt" class="form-control"
                 v-bind:class="[formErrors.email_link_txt ? 'invalid-input' : '']" name="email_link_txt" type="text"
                 maxlength="80">
        </div>
      </div><!-- /.col-md-4 -->
    </div>
    <div v-if="generalForm" class="row">
      <div :class="md12col">
        <div v-bind:class="formGroup">
          <label>Contact Email</label>
          <p class="help-text" id="title-helptext">Please enter the contact person's email address.
            (contact@yourlink.com)</p>
          <div class="input-group">
            <span :class="inputGroupLabel">mailto:</span>
            <input v-model="record.email_link" class="form-control"
                   v-bind:class="[formErrors.email_link ? 'invalid-input' : '']" name="email_link" type="text"
                   maxlength="80">
          </div>
          <p v-if="formErrors.email_link" class="help-text invalid">Please make sure email is properly formed.</p>
        </div>
      </div><!-- /.col-md-4 -->
    </div><!-- /.row -->

    <br v-if="framework == 'foundation' && generalForm"/>

    <div v-if="generalForm" class="row">
      <div :class="md12col">
        <div class="form-group">
          <label>Contact Phone <em>(ex. 734.487.1849)</em></label>
          <input v-model="record.phone" class="form-control" :class="[formErrors.phone ? 'invalid-input' : '']"
                 name="phone" type="text" maxlength="15">
          <p v-if="formErrors.phone" class="help-text invalid">Need a Contact Phone!</p>
        </div>
      </div><!-- /.md6col -->
    </div><!-- /.row -->

    <br v-if="framework == 'foundation' && generalForm"/>

    <div class="row">
      <div v-bind:class="md6col">
        <div v-bind:class="formGroup">
          <label for="publishDatePicker">Publish Date: <span v-bind:class="iconStar" class="reqstar"></span>
            <flatpickr
                v-model="record.start_date"
                id="publishDatePicker"
                :config="pubFlatpickrConfig"
                class="form-control"
                name="publishDatePicker"
                @change="handleChangePubDate"
            >
            </flatpickr>
          </label>
          <p v-if="formErrors.start_date" class="help-text invalid">Need a Publish Date</p>


        </div> <!--form-group -->
      </div> <!-- /.small-6 columns -->

      <div v-bind:class="md6col">
        <div v-bind:class="formGroup">
          <label for="endDatePicker">End Date: <span v-bind:class="iconStar" class="reqstar"></span>
            <flatpickr
                v-model="record.end_date"
                id="endDatePicker"
                :config="endFlatpickrConfig"
                class="form-control"
                name="endDatePicker"
                @change="handleChangeEndDate"
            >
            </flatpickr>
          </label>
          <p v-if="formErrors.start_date" class="help-text invalid">Need an End Date</p>

        </div> <!--form-group -->
      </div> <!-- /.small-6 columns -->
    </div> <!-- /.row -->

    <div id="preview-contents" class="row" v-show="record.title" v-if="framework == 'foundation'">
      <div v-bind:class="md12col">
        <h3 class="cal-caps toptitle">Announcement Preview</h3>
        <ul class="accordion" data-accordion>
          <li class="accordion-item is-active" id="accitem-1" data-accordion-item>
            <a href="#" class="accordion-title">{{ record.title }}</a>
            <div class="accordion-content" data-tab-content>
              <p>{{ record.announcement }}</p>
              <p v-if='record.link'>For more information visit: <a class="accordion-link"
                                                                   target="_blank">{{ record.link_txt }}</a></p>
              <p v-if='record.email_link'>Contact Email: <a class="accordion-link"
                                                            target="_blank">{{ record.email_link_txt }}</a></p>
              <p v-if='record.phone'>Contact Phone: {{ record.phone }}</p>
              <!-- <p v-if='record.start_date'>Posted {{record.start_date}}</a></p> -->
            </div>
          </li>
        </ul>
      </div>
    </div>
    <div class="row" id="submit-area">
      <div v-if="isadmin" :class="md4col">
        <div class="checkbox">
          <label><input type="checkbox" v-model="record.admin_pre_approved">Auto Approve</label>
        </div>
      </div>
      <div :class="md8col">
        <div :class="formGroup">
          <button v-on:click="submitForm" type="submit" v-bind:class="btnPrimary">{{ submitBtnLabel }}</button>
          <button v-if="thisRecordExists" id="btn-delete" v-on:click="delAnnouncement" type="submit" class="redBtn"
                  v-bind:class="btnPrimary">Delete Announcement
          </button>
        </div><!-- /.md12col -->
      </div><!-- /.md12col -->
    </div>
  </form>
</template>

<style scoped>
#submit-area {
  background: #e1e1e1;
  margin: 20px 0 0 0;
}

p {
  margin: 0;
}

.accordion-content p {
  margin-bottom: .5rem;
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

textarea {
  resize: vertical !important;
}

.redBtn {
  background: hsl(0, 90%, 70%);
}
</style>


<script>
import moment from 'moment'
import flatpickr from 'vue-flatpickr-component'
import 'flatpickr/dist/flatpickr.css'

export default {
  components: {
    flatpickr
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
    type: {
      default: 'general'
    },
    isadmin: {
      default: false
    },
  },
  data: function () {
    return {
      currentDate: {},
      dateObject: {
        startDateMin: '',
        startDateDefault: '',
        endDateMin: '',
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
        phone: '',
        type: '',
        admin_pre_approved: false,
      },
      totalChars: {
        start: 0,
        title: 80,
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
      formErrors: {},
      record_exists: false,
      currentRecordId: 0,
      pubFlatpickrConfig: {
        altFormat: "F j, Y", // format the user sees
        altInput: true,
        dateFormat: "Y-m-d", // format sumbitted to the API
      },
      endFlatpickrConfig: {
        altFormat: "F j, Y", // format the user sees
        altInput: true,
        dateFormat: "Y-m-d", // format sumbitted to the API
      }
    }
  },
  created: function () {
    this.currentDate = moment();
  },
  mounted: function () {
    this.refreshUserAnnouncementTable();
    if (this.framework == 'foundation') {
      $(document).foundation();
    }
    this.record.type = this.type;
    if (this.recordexists) {
      this.fetchCurrentRecord(this.recordid)
    } else {
      if (this.type == 'hr') {
        this.record.announcement = "HR";
      }
      this.setupDatePickers();
    }

    this.updatePreview();
  },
  computed: {
    // Check announcement type. general or hr
    generalForm: function () {
      if (this.type != 'general') {
        return false;
      } else {
        return true;
      }
    },

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
      return (this.recordexists) ? 'Update Announcement' : 'Submit For Approval'
    },

    hasStartDate: function () {
      if (this.record.start_date === undefined || this.record.start_date == '') {
        return false
      } else {
        return true
      }
    },
    titleChars: function () {
      // Calulate title field character length and return remaining characters
      const str = this.record.title;
      const totalchars = (this.type === 'hr') ? this.totalChars.hr : this.totalChars.title;
      const cclength = str.length;
      return totalchars - cclength;
    },
    descriptionChars: function () {
      // Calulate announcement field character length and return remaining characters
      const str = this.record.announcement;
      const cclength = str.length;
      const totalchars = this.totalChars.announcement;
      return totalchars - cclength;
    },
    thisRecordExists: function () {
      if (this.recordexists || this.record_exists) {
        return true;
      }
      return false;
    }
  },

  methods: {
    handleChangePubDate(evt) {
      this.endFlatpickrConfig.minDate = moment(evt.target.value).format('YYYY-MM-DD')
    },
    handleChangeEndDate(evt) {
      this.pubFlatpickrConfig.maxDate = moment(evt.target.value).format('YYYY-MM-DD')
    },
    updatePreview: function () {
      if (this.framework == 'foundation') {
        // Move this preview
        document.getElementById('preview-container').appendChild(
            document.getElementById('preview-contents')
        );
      }
    },
    refreshUserAnnouncementTable: function () {
      if (this.framework == 'foundation') {
        $.get('/announcement/user/announcements', function (data) {
          data = $.parseJSON(data);
          $('#user-announcement-tables').html(data);
        });
      }
    },
    fetchCurrentRecord: function () {
      let fetchme = this.recordid ? this.recordid : this.record.id;
      this.$http.get('/api/announcement/' + fetchme + '/edit')

          .then((response) => {
            this.record = response.data.data;

            this.checkOverData();
            this.updatePreview();
            this.record.start_time = response.data.data.start_time;
          })
          .catch((e) => {
            this.formErrors = response.data.error.message;
          })
    },
    checkOverData: function () {
      this.setupDatePickers();
    },
    delAnnouncement: function (e) {
      e.preventDefault();
      this.formMessage.isOk = false;
      this.formMessage.isErr = false;

      if (confirm('Would you like to delete this Announcement') == true) {
        $('html, body').animate({scrollTop: 0}, 'fast');

        let tempid = 0;

        this.currentRecordId ? tempid = this.currentRecordId : tempid = this.record.id;
        this.$http.post('/api/announcement/' + tempid + '/delete')

            .then((response) => {
              // If user admin
              if (window.location.href.indexOf("admin") > -1) {
                window.location.href = "/admin/announcement/queue";
              } else { // Not user admin
                // Clear out values;
                this.formMessage.isOk = response.ok;
                this.formMessage.msg = response.body;
                this.record_exists = false;
                this.record = {
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
                  phone: '',
                  type: ''
                };
                let d = new Date();
                let tempdate = d.getFullYear() + "-" + d.getMonth() + "-" + d.getDate();
                this.record.start_date = tempdate;
                this.record.end_date = tempdate;
                this.setupDatePickers();
              }
            })
            .catch((response) => {
              console.log('Error: ' + JSON.stringify(response))
            })
        this.refreshUserAnnouncementTable();
      }
    },

    setupDatePickers: function () {
      let self = this;
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
    },

    submitForm: function (e) {
      e.preventDefault(); // Stop form defualt action

      this.formMessage.isOk = false;
      this.formMessage.isErr = false;

      $('html, body').animate({scrollTop: 0}, 'fast');

      this.record.type = this.type;

      // Dicide route to submit form to
      let method = (this.thisRecordExists) ? 'put' : 'post'
      let route = (this.thisRecordExists) ? '/api/announcement/' + this.record.id : '/api/announcement';

      // Submit form.
      this.$http[method](route, this.record) //
          // Do this when response gets back.
          .then((response) => { // If valid
            this.formMessage.msg = response.data.message
            this.formMessage.isOk = true
            this.currentRecordId = this.record.id = response.data.newdata.record_id;
            this.formMessage.isErr = false;
            this.record_exists = this.record.exists = true;
            this.formErrors = {}; // Clear errors?
            this.fetchCurrentRecord(this.record.id)
            this.refreshUserAnnouncementTable();
          })
          .catch((response) => { // If invalid. error callback
            this.formMessage.isOk = false;
            this.formMessage.isErr = true;
            // Set errors from validation to vue data
            this.formErrors = response.data.error.message;
          })
    }
  }
};
</script>
