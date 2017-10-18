<template>
  <form>
    <slot name="csrf"></slot>
    {{ $route }}
    <div class="row">
      <div v-bind:class="md12col">
        <div v-show="formMessage.isOk"  :class="calloutSuccess">
          <h5>{{formMessage.msg}}</h5>
        </div>
        <div v-show="formMessage.isErr"  :class="calloutFail">
          <h5>There are errors.</h5>
        </div>
        <div v-show="this.record.is_canceled == 1" :class="calloutFail">
          <h5>This event has been canceled.</h5>
        </div>
        <div class="form-group">
          <label>Title <span :class="iconStar" class="reqstar"></span></label>
          <p class="help-text" id="title-helptext">Please enter a title ({{titleChars}} characters left)</p>
          <input v-model="record.title" class="form-control" :class="[formErrors.title ? 'invalid-input' : '']"  name="title" type="text" maxlength="80" autofocus>
          <p v-if="formErrors.title" class="help-text invalid">	Please Include a Title!</p>
        </div>
        <div class="form-group">
          <label>Short Title - for departmental use only</label>
          <input v-model="record.short_title" class="form-control" type="text" placeholder="Short Title" name="short-title" maxlength="80">
        </div>
      </div><!-- /.md12col -->
    </div><!-- /.row -->
    <div class="row">
      <div :class="md12col">
        <div :class="formGroup">
          <label>Description <span :class="iconStar" class="reqstar"></span> <p class="help-text" id="description-helptext">({{descriptionChars}} characters left)</p></label>
          <textarea v-model="record.description" class="form-control" :class="[formErrors.description ? 'invalid-input' : '']" name="description" type="textarea" rows="6" maxlength="255"></textarea>
          <p v-if="formErrors.description" class="help-text invalid">Need a Description!</p>
        </div>
      </div><!-- /.md12col -->
    </div><!-- /.row -->
    <div class="row">
      <div :class="md6col">
        <div class="form-group">
          <label>Is Event on Campus?
            <input id="on-campus-yes" name="on_campus" type="checkbox" value="1" v-model="record.on_campus"/>
          </label>
        </div>
      </div><!-- /.md6col -->
      <div :class="md6col">

      </div><!-- /.md6col -->
    </div><!-- /.row -->
    <div class="row">
      <div :class="md12col">
        <template v-if="isOnCampus">
          <div class="row">
            <div :class="md8col">
              <label>Building</label>
              <v-select
              :class="dropDownSelect"
              is="bldg"
              :debounce="250"
              :value.sync="building"
              :on-search="fetchForSelectBuildingList"
              :options="buildings"
              placeholder="Select a Building ..."
              label="name">
            </v-select>
        </div><!-- /.md8col -->
        <div :class="md4col">
          <label>Room</label>
          <input v-model="record.room" :class="[formErrors.room ? 'invalid-input' : '']" name="room" type="text" class='mockh5' maxlength="80">
        </div><!-- /.md4col -->
      </div><!-- /.row -->
    </template>
    <div class="row">
      <div :class="md12col">
        <template v-if="isOnCampus">
          <label>Location <span :class="iconStar" class="reqstar"></span></label>
          <input v-model="computedLocation" class="form-control" :class="[formErrors.location ? 'invalid-input' : '']" name="location" type="text" readonly="readonly">
        </template>
        <template v-else>
          <label>Location <span :class="iconStar" class="reqstar"></span></label>
          <input v-model="record.locationoffcampus" class="form-control" :class="[formErrors.location ? 'invalid-input' : '']" name="location" type="text" maxlength="80">
        </template>
      </div><!-- /.md12col -->
    </div><!-- /.row -->
  </div><!-- /.md12col -->
</div><!-- /.row -->
<div class="row">
  <div :class="md6col">
    <div class="form-group">
      <label for="start-date">Event Start Date: <span :class="iconStar" class="reqstar"></span></label>
      <input id="start-date" :class="[formErrors.start_date ? 'invalid-input' : '']" type="text" v-model="record.start_date" aria-describedby="errorStartDate" />
      <p v-if="formErrors.start_date" class="help-text invalid">Need a Start Date</p>
    </div><!--form-group -->
  </div><!-- /.md6col -->
  <div :class="md6col">
    <div class="form-group">
      <label for="end-date">End Date: <span :class="iconStar" class="reqstar"></span></label>
      <input id="end-date" :class="[formErrors.end_date ? 'invalid-input' : '']" type="text" v-model="record.end_date"  aria-describedby="errorEndDate" />
      <!-- <datepicker id="end-date" :readonly="true" format="YYYY-MM-DD" name="end-date" :value.sync="edate"></datepicker> -->
      <p v-if="formErrors.end_date" class="help-text invalid">Need an End Date</p>
    </div><!--form-group -->
  </div><!-- /.md6col -->
</div><!-- /.row -->

<div class="row">
  <div :class="md6col">
    <div class="form-group">
      <label for="all-day">All Day Event:
        <input id="all-day" name="all_day" type="checkbox" value="1" v-model="record.all_day"/>
      </label>
    </div>
  </div><!-- /.small-6 column -->
  <div :class="md6col">
    <div v-show="hasStartTime" class="form-group">
      <label for="no-end-time">No End Time:</label>
        <input id="no-end-time" name="no_end_time" type="checkbox" value="1" v-model="record.no_end_time"/>
    </div>
  </div><!-- /.small-6 column -->
  </div><!-- /.row -->
  <div class="row">
    <div :class="md6col">
      <div v-show="hasStartTime" class="form-group">
        <label for="start-time">Start Time: <span :class="iconStar" class="reqstar"></span></label>
        <input id="start-time" class="form-control" type="text" v-model="record.start_time" readonly/>
        <p v-if="formErrors.start_time" class="help-text invalid">Need a Start Time</p>
      </div><!-- /.form-group -->
    </div><!-- /.md6col -->
    <div :class="md6col">
      <div v-show="hasEndTime" class="form-group">
        <label for="end-time">End Time: <span :class="iconStar" class="reqstar"></span></label>
        <input id="end-time" class="form-control" type="text" v-model="record.end_time" readonly/>
      </div><!-- /.form-group -->
    </div><!-- /.md6col -->
  </div><!-- /.row -->
  <div class="row">
    <div :class="md12col">
      <div class="form-group">
        <label>Categories: <span :class="iconStar" class="reqstar"></span></label>
        <v-select
        :class="[formErrors.categories ? 'invalid-input' : '']"
        :debounce="250"
        :value.sync="record.eventcategories"
        :on-search="fetchForSelectCategoriesList"
        :options="zcats"
        :multiple="true"
        placeholder="Select related categories ..."
        label="category">
      </v-select>

    </div><!-- /.form-group -->
  </div><!-- /.md12col -->
</div><!-- /.row -->
<div class="row">
  <div :class="md6col">
    <div class="form-group">
      <label>Contact Person: <span :class="iconStar" class="reqstar"></span><em>(Jane Doe)</em></label>
      <input v-model="record.contact_person" class="form-control" :class="[formErrors.contact_person ? 'invalid-input' : '']" name="contact-person" type="text" maxlength="80">
      <p v-if="formErrors.contact_person" class="help-text invalid">Need a Contact Person!</p>

    </div>
  </div><!-- /.md6col -->
  <div :class="md6col">
    <div class="form-group">
      <label>Contact Email: <span :class="iconStar" class="reqstar"></span><em>(ex.janedoe@emich.edu)</em></label>
      <input v-model="record.contact_email" class="form-control" :class="[formErrors.contact_email ? 'invalid-input' : '']" name="contact-email" type="text" maxlength="80">
      <p v-if="formErrors.contact_email" class="help-text invalid">Need a Contact Email!</p>

    </div>
  </div><!-- /.md6col -->
</div><!-- /.row -->
<div class="row">
  <div :class="md6col">
    <div class="form-group">
      <label>Contact Phone <span :class="iconStar" class="reqstar"></span> <em>(ex. 734.487.1849)</em>
        <input v-model="record.contact_phone" class="form-control" :class="[formErrors.contact_phone ? 'invalid-input' : '']" name="contact-phone" type="text" maxlength="80">
        <p v-if="formErrors.contact_phone" class="help-text invalid">Need a Contact Phone!</p>
      </label>
    </div>
  </div><!-- /.md6col -->
  <div :class="md6col">
    <div class="form-group">
      <label>Contact Fax: <em>(ex. 734.487.1849)</em>
        <input v-model="record.contact_fax" class="form-control" :class="[formErrors.contact_fax ? 'invalid-input' : '']" name="contact-fax" type="text" maxlength="80">
      </label>
    </div>
  </div><!-- /.md6col -->
</div><!-- /.row -->
<!-- RELATED LINKS -->
<div class="input-group" style="width: 100%">
  <div class="row">
    <div :class="md12col">
      <div v-bind:class="formGroup">
        <label>Related Link</label>
        <p class="help-text" id="title-helptext">Please enter the url for your related web page. (ex. www.yourlink.com)</p>
        <div class="input-group input-group-flat">
          <span :class="inputGroupLabel">http://</span>
          <input v-model="record.related_link_1" class="form-control" v-bind:class="[formErrors.related_link_1 ? 'invalid-input' : '']" name="related_link_1" type="text" maxlength="255">
        </div>
        <p v-if="formErrors.related_link_1" class="help-text invalid">Please make sure url is properly formed.</p>
      </div>
    </div><!-- /.col-md-4 -->
  </div><!-- /.row -->
  <div class="row" v-show="record.related_link_1">
    <div :class="md4col">
      <div v-bind:class="formGroup">
        <label>Please add descriptive text for link.<span :class="iconStar" class="reqstar"></span></label>
        <p class="help-text" id="link_txt-helptext">(ex. The event webpage)</p>
        <input v-model="record.related_link_1_txt" class="form-control" v-bind:class="[formErrors.related_link_1_txt ? 'invalid-input' : '']" name="related_link_1_txt" type="text" maxlength="80">
        <p v-if="formErrors.related_link_1_txt" class="help-text invalid"> Please include a descriptive text for your related link.</p>
      </div>
    </div><!-- /.col-md-4 -->
    <div :class="md8col">
      <div v-bind:class="formGroup">
        <label>Example of Related Link</label>
        <p class="help-text">Below is how it may look. </p>
        <h5 class="form-control">For more information, visit <a href="#"> {{record.related_link_1_txt}}</a>.</h5>
      </div>
    </div><!-- /.md6col -->
  </div>
  <!-- Two -->
  <template v-if="record.related_link_1 && record.related_link_1_txt">
    <br/>
    <div class="row">
      <div :class="md12col">
        <div v-bind:class="formGroup">
          <label>Related Link</label>
          <p class="help-text" id="title-helptext">Please enter the url for your related web page. (ex. www.yourlink.com)</p>
          <div class="input-group input-group-flat">
            <span :class="inputGroupLabel">http://</span>
            <input v-model="record.related_link_2" class="form-control" v-bind:class="[formErrors.related_link_2 ? 'invalid-input' : '']" name="related_link_2" type="text" maxlength="255">
          </div>
          <p v-if="formErrors.related_link_2" class="help-text invalid">Please make sure url is properly formed.</p>
        </div>
      </div><!-- /.col-md-4 -->
    </div><!-- /.row -->
    <div class="row" v-show="record.related_link_2">
      <div :class="md4col">
        <div v-bind:class="formGroup">
          <label>Please add descriptive text for link.<span :class="iconStar" class="reqstar"></span></label>
          <p class="help-text" id="link_txt-helptext">(ex. The event webpage)</p>
          <input v-model="record.related_link_2_txt" class="form-control" v-bind:class="[formErrors.related_link_2_txt ? 'invalid-input' : '']" name="related_link_2_txt" type="text" maxlength="80">
          <p v-if="formErrors.related_link_2_txt" class="help-text invalid"> Please include a descriptive text for your related link.</p>
        </div>
      </div><!-- /.col-md-4 -->
      <div :class="md8col">
        <div v-bind:class="formGroup">
          <label>Example of Related Link</label>
          <p class="help-text">Below is how it may look. </p>
          <h5 class="form-control">For more information, visit: <a href="#"> {{record.related_link_2_txt}}</a>.</h5>
        </div>
      </div><!-- /.md6col -->
    </div>
    <br/>
  </template>
  <!-- three -->
  <template v-if="record.related_link_2 && record.related_link_2_txt">
    <div class="row">
      <div :class="md12col">
        <div v-bind:class="formGroup">
          <label>Related Link</label>
          <p class="help-text" id="title-helptext">Please enter the url for your related web page. (ex. www.yourlink.com)</p>
          <div class="input-group input-group-flat">
            <span :class="inputGroupLabel">http://</span>
            <input v-model="record.related_link_3" class="form-control" v-bind:class="[formErrors.related_link_3 ? 'invalid-input' : '']" name="related_link_3" type="text" maxlength="255">
          </div>
          <p v-if="formErrors.related_link_3" class="help-text invalid">Please make sure url is properly formed.</p>
        </div>
      </div><!-- /.col-md-4 -->
    </div><!-- /.row -->
    <div class="row" v-show="record.related_link_3">
      <div :class="md4col">
        <div v-bind:class="formGroup">
          <label>Please add descriptive text for link.<span :class="iconStar" class="reqstar"></span></label>
          <p class="help-text" id="link_txt-helptext">(ex. The event webpage)</p>
          <input v-model="record.related_link_3_txt" class="form-control" v-bind:class="[formErrors.related_link_3_txt ? 'invalid-input' : '']" name="related_link_3_txt" type="text" maxlength="80">
          <p v-if="formErrors.related_link_3_txt" class="help-text invalid"> Please include a descriptive text for your related link.</p>
        </div>
      </div><!-- /.col-md-4 -->
      <div :class="md8col">
        <div v-bind:class="formGroup">
          <label>Example of Related Link</label>
          <p class="help-text">Below is how it may look. </p>
          <h5 class="form-control">For more information, visit: <a href="#"> {{record.related_link_3_txt}}</a>.</h5>
        </div>
      </div><!-- /.md6col -->
    </div>
  </template>
</div>
<!-- RELATED LINKS -->
<br v-if="framework == 'bootstrap'"/>

<div class="row">
  <div :class="md6col">
    <div class="form-group">
      <label for="reg-deadline">Registration Deadline</label>
      <input id="reg-deadline" :class="[formErrors.reg_deadline ? 'invalid-input' : '']" type="text" v-model="record.reg_deadline" aria-describedby="errorRegDeadline" />
      <p v-if="formErrors.reg_deadline" class="help-text invalid">Error</p>
    </div>
  </div><!-- /.md6col-->
</div><!-- /.row -->
<div class="row">
  <div :class="md12col">

    <div class="row">
      <div :class="md2col">
        <label>Free</label>
        <div :class="formGroup">
          <input id="free" name="free" type="checkbox" value="1" v-model="record.free"/>
        </div><!-- /.form-group -->
      </div><!-- /.md4col -->
      <div :class="md10col">
        <label>Event Cost <span :class="iconStar" class="reqstar"></span></label>
        <div v-show="hasCost" class="form-group">
          <div class="input-group">
            <span :class="inputGroupLabel">$</span>
            <input v-model="record.cost" class="form-control" :class="[formErrors.cost ? 'invalid-input' : '']" name="event-cost"  type="number">
          </div><!-- /. input-group -->
        </div>
        <div v-else :class="formGroup">
          <div class="input-group">
            <span :class="inputGroupLabel">$</span>
            <input v-model="record.cost" class="form-control" :class="[formErrors.cost ? 'invalid-input' : '']" name="event-cost"  type="number" readonly="readonly">
          </div><!-- /. input-group -->
        </div>
      </div><!-- /.md8col -->
    </div><!-- /.row -->


  </div><!-- /.medium-6 -->
</div><!-- /.row -->
<div class="row">
  <div :class="md12col">
    <div :class="formGroup">
      <label>Tickets Available</label>
      <select v-model="record.tickets" class="form-control">
        <option v-for="ticketoption in ticketoptions" :value="ticketoption.value">
          {{ ticketoption.label }}
        </option>
      </select>
      <template v-if="record.tickets == 'online' || record.tickets == 'all'">
        <label>Link: <em>(ex. http://www.emich.edu/calendar)</em>
          <input v-model="record.ticket_details_online" class="form-control" :class="[formErrors.ticket_details_online ? 'invalid-input' : '']" name="ticket-details-online" type="text">
        </label>
      </template>
      <template v-if="record.tickets == 'phone' || record.tickets == 'all'">
        <label>Tickets by Phone <em>(ex. 734.487.1849)</em>
          <input v-model="record.ticket_details_phone" class="form-control" :class="[formErrors.ticket_details_phone ? 'invalid-input' : '']" name="ticket-details-phone" type="text">
        </label>
      </template>
      <template v-if="record.tickets == 'office' || record.tickets == 'all'">
        <label>Address
          <input v-model="record.ticket_details_office" class="form-control" :class="[formErrors.ticket_details_office ? 'invalid-input' : '']" name="ticket-details-office" type="text">
        </label>
      </template>
      <template v-if="record.tickets == 'other'">
        <label>Other
          <input v-model="record.ticket_details_other" class="form-control" :class="[formErrors.ticket_details_other ? 'invalid-input' : '']" name="ticket-details-other" type="text">
        </label>
      </template>
    </div><!-- /.form-group -->
  </div><!-- /.md12col -->
</div><!-- /.row -->
<div class="row">
  <div :class="md12col">
    <div :class="formGroup">
      <label>Participants</label>
      <select v-model="record.participants" class="form-control">
        <option v-for="participant in participants" :value="participant.value">
          {{ participant.label }}
        </option>
      </select>
  </div>
</div><!--/.md12col -->
</div><!-- /.row -->
<div class="row">
  <div :class="md6col">
    <div :class="formGroup">
      <label for="lbc-approved">LBC Approved: <em>(pre-approval required)</em>
        <input id="lbc-approved" name="lbc-approved" type="checkbox" value="1" v-model="record.lbc_approved"/>
      </label>
    </div>
  </div><!-- /.md6col -->
  <div :class="md6col">

  </div><!-- /.md6col -->
</div><!-- /.row -->
<div class="row">
  <div :class="md12col">
</div><!-- /.md12col -->

<div :class="md12col">
  <label for="minical">Select your department's mini calendar(s)
    <v-select id="minical"
    :value.sync="record.minicalendars"
    :options="minicalslist"
    :multiple="true"
    placeholder="Select Mini Calendar"
    label="calendar">
    </v-select>
  </label>
</div><!-- /.md12col -->
</div><!-- /.row -->
<div class="row" id="submit-area">
  <div v-if="isadmin" :class="md4col">
    <div class="checkbox">
      <label><input type="checkbox" v-model="record.admin_pre_approved">Auto Approve</label>
    </div>
  </div>
  <div :class="md8col">
    <div :class="formGroup">
      <button id="btn-event" v-on:click="submitForm" type="submit" v-bind:class="btnPrimary">{{submitBtnLabel}}</button>
      <button v-if="recordexists" id="btn-clone" v-on:click="cloneEvent" type="submit" v-bind:class="btnPrimary">Clone Event</button>
      <button v-if="recordexists && isAdmin" id="btn-cancel" v-on:click="cancelEvent" type="submit" v-bind:class="btnPrimary">{{ cancelStatus }}</button>
      <button v-if="recordexists" id="btn-delete" v-on:click="delEvent" type="submit" class="redBtn" v-bind:class="btnPrimary">Delete Event</button>
    </div><!-- /.md12col -->
  </div><!-- /.md12col -->
  </form>
</div>

</template>
<style scoped>
#submit-area{
  background: #e1e1e1;
  margin:20px 0 0 0;
}
p {
  margin:0;
}
label {
  margin-top: 3px;
  margin-bottom: 3px;
  display: block;
}

label > span {
  display: inline-block;
  vertical-align: top;
}

.input-group input[type='text'] {
  marging-bottom: 0;
}
label input {
  font-weight: 400;
}

input[type='number'] {
  marging-bottom: 0;
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
.reqstar {
  font-size: .7rem;
  color: #E33100;
  vertical-align:text-top;
}

select {
  margin: 0;
}

[type='submit'], [type='button'] {
  margin-top: 0.8rem;
}
input[type="number"]{
  margin: 0;
}
input[type="text"]{
  margin: 0;
}
form {
  padding-bottom: 20px;
}
.yellowBtn {
  background: hsl(60, 70%, 50%);
}
.redBtn {
  background: hsl(0, 90%, 70%);
}
h5.form-control, .mockh5 {
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
</style>

<script>
import flatpickr from "flatpickr"
import vSelect from "vue-select"
module.exports  = {
  directives: {},
  components: {vSelect},
  props:{
    recordexists: {default: false},
    recordid: {default: ''},
    framework: {default: 'foundation'},
    isadmin: {default: false},
  },
  data: function() {
    return {
      minicalslist:[],
      dateObject:{
        startDateMin: '',
        startDateDefault: '',
        endDateMin: '',
        endDateDefault: '',
        startTimeDefault: '',
        endTimeDefault: '',
        regDateMin: '',
        regDateDefault: ''
      },
      startdatePicker:null,
      enddatePicker:null,
      starttimePicker:null,
      endtimePicker:null,
      regdeadlinePicker:null,
      sdate: '',
      edate: '',
      stime: '',
      rdate: '',
      ticketoptions: [
        { label: 'Online', value: 'online'},
        { label: 'Phone', value: 'phone'},
        { label: 'Ticket Office', value: 'office'},
        { label: 'Online, Phone and Ticket Office', value: 'all'},
        { label: 'Other', value: 'other'},
      ],
      participants: [
        { label: 'Campus Only', value: 'campus'},
        { label: 'Open to Public', value: 'public'},
        { label: 'Students Only', value: 'students'},
        { label: 'Invitation Only', value: 'invite'},
        { label: 'Tickets Required', value: 'tickets'},
      ],
      totalChars: {
        start: 0,
        title: 80,
        description: 255
      },
      building_in: [],
      building: null,
      buildings: [],
      zcategories: [],
      zcats: [],
      categories: {},
      minicals: null,
      minicalendars: {},
      record: {
        on_campus: 1,
        all_day: 0,
        no_end_time: 0,
        free: 0,
        title: '',
        description: '',
        mini_calendar: '',
        building: '',
        categories:[],
        is_canceled: 0,
        start_time: '12:00 PM',
        end_time: '12:00 PM',
        admin_pre_approved: false,
      },
      response: {

      },
      formStatus: {},
      vModelLike: "",
      formMessage: {
        isOk: false,
        isErr: false,
        msg: ''
      },
      formInputs : {},
      formErrors : {}
    }
  },
  ready() {
    if(this.recordexists){
      this.fetchCurrentRecord(this.recordid)
    }
    this.setupDatePickers();
    this.fetchMiniCalsList();
    this.fetchForSelectBuildingList("");
    this.fetchForSelectCategoriesList("");

    // Don't submit form on 'enter'
    $(document).on('keyup keypress', 'form input[type="text"]', function(e) {
      if(e.which == 13) {
        e.preventDefault();
        return false;
      }
    });
  },

  computed: {
    dropDownSelect: function(){
      return (this.framework == 'foundation')? 'fdropdown':''
    },
    md6col: function () {
      return (this.framework == 'foundation')? 'medium-6 columns':'col-md-6'
    },
    md12col: function () {
      return (this.framework == 'foundation')? 'medium-12 columns':'col-md-12'
    },
    md8col: function () {
      return (this.framework == 'foundation')? 'medium-8 columns':'col-md-8'
    },
    md4col: function () {
      return (this.framework == 'foundation')? 'medium-4 columns':'col-md-4'
    },
    md2col: function () {
      return (this.framework == 'foundation')? 'medium-2 columns':'col-md-2'
    },
    md10col: function () {
      return (this.framework == 'foundation')? 'medium-10 columns':'col-md-10'
    },
    btnPrimary: function() {
      return (this.framework == 'foundation')? 'button button-primary':'btn btn-primary'
    },
    formGroup: function() {
      return (this.framework == 'foundation')? 'form-group':'form-group'
    },
    inputGroupLabel:function(){
      return (this.framework=='foundation')?'input-group-label':'input-group-addon'
    },
    iconStar: function() {
      return (this.framework == 'foundation')? 'fi-star':'fa fa-star'
    },
    calloutSuccess:function(){
      return (this.framework == 'foundation')? 'callout success':'alert alert-success'
    },
    calloutFail:function(){
      return (this.framework == 'foundation')? 'callout alert':'alert alert-danger'
    },
    submitBtnLabel:function(){
      return (this.recordexists)?'Update Event': 'Submit For Approval'
    },
    computedLocation: function() {
      let bldg,room;

      if (this.building) {
        this.record.building = this.building.name;
        bldg = this.record.building
        room = (this.record.room)?' - ' + this.record.room:'';

      } else {
        bldg = ''
        room = ''
      }
      return bldg + room;
    },
    cancelStatus: function(){
      return (this.record.is_canceled == 1)? 'Uncancel Event':'Cancel Event'
    },
    isOnCampus: function() {
      return this.record.on_campus == 1 ? true:false;
    },
    realCost: function() {
      if(this.record.free == 1 ) {
        return '0.00';
      } else {
        return '';
      }
    },
    hasCost: function() {
      if(this.record.free == 1 ) {
        this.record.cost = '0.00';
        return false;
      } else {
        return true;
      }
    },
    titleChars: function() {
      var str = this.record.title;
      var cclength = str.length;
      return this.totalChars.title - cclength;
    },
    descriptionChars: function() {
      var str = this.record.description;
      var cclength = str.length;
      return this.totalChars.description - cclength;
    },
    hasStartTime: function() {
      return this.record.all_day == 1? false : true;
    },
    hasEndTime: function() {
      return (this.record.all_day == 1 || this.record.no_end_time == 1)?false : true;
    },
    isAdmin: function(){
        return window.location.href.indexOf("admin") > -1;
    }
  },
  methods: {
    refreshUserEventTable: function(){
      $.get('/calendar/user/events', function(data){
        data = $.parseJSON(data);
        $('#user-events-tables').html(data);
      });
    },

    fetchMiniCalsList: function() {
      this.$http.get('/api/minicalslist')
      .then((response) =>{
        this.$set('minicalslist', response.data)
      }, (response) => {
        //error callback
        console.log("ERRORS");
        this.formErrors =  response.data.error.message;

      }).bind(this);
    },
    setupDatePickers:function(){
      var self = this;
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
        this.dateObject.startTimeDefault = this.record.start_time;
        this.dateObject.endTimeDefault = this.record.end_time;
        this.dateObject.regDateMin = this.record.start_date;
        this.dateObject.regDateDefault = this.record.reg_deadline;
      }
      this.startdatePicker = flatpickr(document.getElementById("start-date"), {
        // minDate: self.dateObject.startDateMin,
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

      this.starttimePicker = flatpickr(document.getElementById("start-time"),{
        noCalendar: true,
        enableTime: true,
        defaultDate: self.dateObject.startTimeDefault,
        log: console.log(self.dateObject.startTimeDefault),
        onChange(timeObject, timeString) {
          self.record.start_time = timeString;
          self.starttimePicker.value = timeString;
        }
      });
      this.endtimePicker = flatpickr(document.getElementById("end-time"),{
        noCalendar: true,
        enableTime: true,
        defaultDate: self.dateObject.endTimeDefault,
        onChange(timeObject, timeString) {
          self.record.end_time = timeString;
          self.endtimePicker.value = timeString;
        }
      });

      this.regdeadlinePicker = flatpickr(document.getElementById("reg-deadline"),{
        minDate: self.dateObject.regDateMin,
        defaultDate: self.dateObject.regDateDefault,
        enableTime: false,
        // altFormat: "m-d-Y",
        altInput: true,
        altInputClass:"form-control",
        dateFormat: "Y-m-d",
        onChange(dateObject, dateString) {
          self.record.reg_deadline = dateString;
          self.regdeadlinePicker.value = dateString;
        }
      });
    },

    fetchSubmittedRecord: function(recid){
      // Sets params for update record, Passes an id to fetchCurrentRecord
      this.recordexists = true;
      this.formMessage.isOk = false;
      this.formMessage.isErr = false;
      this.recordid = recid;
      this.formErrors = {};
      this.fetchCurrentRecord();
    },

    cancelRecord: function(recid){
      // toggles cancel
      this.formMessage.isOk = false;
      this.formMessage.msg = false;

      this.$http.patch('/api/event/'+ recid + '/cancel')
      .then((response) => {
        this.formMessage.isOk = response.ok;
        this.formMessage.msg = response.body.message;
      }, (response) => {
        console.log(JSON.stringify(response))
      }).bind(this);
      this.refreshUserEventTable();
    },

    fetchCurrentRecord: function() {
      this.$http.get('/api/event/'+ this.recordid + '/edit')

      .then((response) =>{
        this.$set('record', response.data.data)
        this.checkOverData();
        this.record.start_time = response.data.data.start_time;
      }, (response) => {
        //error callback
        console.log("FETCH ERRORS");
      }).bind(this);
    },
    checkOverData: function() { // Used after fetching an event
      // Check event location
      // not null and has more than white space
      if(this.record.building != null && /\S/.test(this.record.building)){
        // Is on campus
        this.record.on_campus = 1; // bool
        this.building = {id:0, name:this.convertFromSlug(this.record.building)};
      } else {
        // Not on campus
        this.record.on_campus = 0; // bool
        this.record.locationoffcampus = this.record.location;
      }

      this.setupDatePickers();
    },
    fetchForSelectCategoriesList(search,loading){
      loading ? loading(true): undefined;
      this.$http.get('/api/categorylist',{
        q: search
      }).then(resp => {
        this.zcats = resp.data;
        loading ? loading(true): undefined;
      })
    },
    fetchForSelectBuildingList(search,loading) {
      loading ? loading(true): undefined;
      this.$http.get('/api/buildinglist',{
        q: search
      }).then(resp => {
        this.buildings = resp.data;
        loading ? loading(true): undefined;
      })
    },
    delEvent: function(e) {
      e.preventDefault();
      this.formMessage.isOk = false;
      this.formMessage.isErr = false;

      if(confirm('Would you like to delete this Event')==true){
        $('html, body').animate({ scrollTop: 0 }, 'fast');

        this.currentRecordId ? tempid = this.currentRecordId : tempid = this.record.id;
        this.$http.post('/api/event/'+tempid+'/delete')

        .then((response) =>{
          // If user admin
          if(window.location.href.indexOf("admin") > -1) {
            window.location.href = "/admin/event/queue";
          } else { // Not user admin
            // Clear out values;
            this.record= {
              on_campus: 1,
              all_day: 0,
              no_end_time: 0,
              free: 0,
              title: '',
              description: '',
              mini_calendar: '',
              building: '',
              categories:[]
            };
            this.record.location = '';
            this.building = null;
            this.buildings = null;
            this.record.room = null;
            this.record.building = null;
            this.record.building_id = null;
            this.record.lbc_approved= false;
            this.record.sdate= '';
            this.record.edate= '';
            this.record.stime= '';
            this.record.rdate= '';
            this.formMessage.isOk = response.ok;
            this.formMessage.msg = response.body;
            this.recordexists = false;
            var d = new Date();
            var tempdate = d.getFullYear() + "-" + d.getMonth() + "-" + d.getDate();
            this.record.start_date = tempdate;
            this.record.end_date = tempdate;
            this.record.reg_deadline = tempdate;
            this.setupDatePickers();
          }
        }, (response) => {
          console.log('Error: '+JSON.stringify(response))
        }).bind(this);
        this.refreshUserEventTable();
      }
    },

    cloneEvent: function(e) {
      e.preventDefault();
      this.recordexists = false;
      this.submitForm(e);
    },

    cancelEvent: function(e){
        e.preventDefault();
        this.formMessage.isOk = false;
        this.formMessage.isErr = false;

        if(confirm('Would you like to cancel this Event')==true){
          $('html, body').animate({ scrollTop: 0 }, 'fast');

          this.currentRecordId ? tempid = this.currentRecordId : tempid = this.record.id;
          this.$http.patch('/api/event/'+tempid+'/cancel')

          .then((response) =>{
              if(this.record.is_canceled == 0){
                  this.record.is_canceled = 1
              } else {
                  this.record.is_canceled = 0
              }

              this.formMessage.msg = "Event's status has been changed.";
              this.formMessage.isOk = response.ok;
          }, (response) => {
            console.log('Error: '+JSON.stringify(response))
          }).bind(this);
          this.refreshUserEventTable();
        }
    },

    submitForm: function(e) {
      e.preventDefault();
      this.formMessage.isOk = false;
      this.formMessage.isErr = false;

      $('html, body').animate({ scrollTop: 0 }, 'fast');

      if(this.record.on_campus == true) {
        this.record.location = this.computedLocation;
      } else {
        this.record.location = this.record.locationoffcampus;
        // clearout these values
        this.record.building = null;
        this.record.building_id = null;
        this.record.room = null;
      }
      this.record.minicals = (this.record.minicalendars)?this.record.minicalendars:null;
      this.record.categories = this.record.eventcategories;

      let method = (this.recordexists) ? 'put' : 'post'
      let route =  (this.recordexists) ? '/api/event/' + this.recordid : '/api/event';

      this.$http[method](route, this.record)

      .then((response) =>{
        response.status;
        this.formMessage.msg = response.data.message;
        this.formMessage.isOk = response.ok;
        this.formMessage.isErr = false;
        this.currentRecordId = response.data.newdata.record_id;
        this.record_id = response.data.newdata.record_id;
        this.recordid = response.data.newdata.record_id;
        this.recordexists = true;
        this.formErrors = {};
        this.refreshUserEventTable();
        this.fetchCurrentRecord(this.currentRecordId)

      }, (response) => {
        this.formMessage.isOk = false;
        this.formMessage.isErr = true;
        //error callback
        console.log("FORM ERRORS" + JSON.stringify(response));
        this.formErrors = response.data.error.message;
      }).bind(this);
    },
    convertToSlug:function(value){
      return value.toLowerCase()
      .replace(/[^a-z0-9-]+/g, '-')
      .replace(/^-+|-+$/g, '');
    },
    convertFromSlug:function(value){
      return value.replace(/-/g, " ").replace(/\b[a-z]/g, function () {
        return arguments[0].toUpperCase();
      });
    }
  }
};
</script>
