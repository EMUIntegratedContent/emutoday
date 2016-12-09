<template>
  <form>
    <slot name="csrf"></slot>
    <!-- <slot name="author_id" v-model="record.author_id"></slot> -->
    <div class="row">
      <div v-bind:class="md12col">
        <div v-show="formMessage.isOk"  :class="calloutSuccess">
          <h5>{{formMessage.msg}}</h5>
        </div>
        <div v-show="formMessage.isErr"  :class="calloutFail">
          <h5>There are errors.</h5>
        </div>
        <div class="form-group">
          <label>Title <span :class="iconStar" class="reqstar"></span></label>
          <p class="help-text" id="title-helptext">Please enter a title ({{titleChars}} characters left)</p>
          <input v-model="record.title" class="form-control" :class="[formErrors.title ? 'invalid-input' : '']"  name="title" type="text">
          <p v-if="formErrors.title" class="help-text invalid">	Please Include a Title!</p>
        </div>
        <div class="form-group">
          <label>Short Title	</label>
          <input v-model="record.short_title" class="form-control" type="text" placeholder="Short Title" name="short-title" >
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
            <!-- <select id="select-zbuilding" class="js-example-basic-multiple" style="width: 100%" v-myselect="zbuildings"  ajaxurl="/api/zbuildings" v-bind:resultvalue="buildings" data-tags="false" multiple="multiple" data-maximum-selection-length="1">
          </select> -->
        </div><!-- /.md8col -->
        <div :class="md4col">
          <label>Room</label>
          <input v-model="record.room" :class="[formErrors.room ? 'invalid-input' : '']" name="room" type="text">
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
          <input v-model="record.locationoffcampus" class="form-control" :class="[formErrors.location ? 'invalid-input' : '']" name="location" type="text">
        </template>
      </div><!-- /.md12col -->
    </div><!-- /.row -->
  </div><!-- /.md12col -->
</div><!-- /.row -->
<div class="row">
  <div :class="md6col">
    <div class="form-group">
      <label for="start-date">Start Date: <span :class="iconStar" class="reqstar"></span></label>
      <input id="start-date" :class="[formErrors_date ? 'invalid-input' : '']" type="text" v-model="record.start_date" aria-describedby="errorStartDate" />
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
      <label for="no-end-time">No End Time:
        <input id="no-end-time" name="no_end_time" type="checkbox" value="1" v-model="record.no_end_time"/>
        <!-- <label v-show="hasEndTime" for="no-end-time-no" class="radiobtns">no</label><input id="no-end-time-no"  name="no_end_time" type="radio" value="0" v-model="record.no_end_time"/> -->
      </div>
    </div><!-- /.small-6 column -->
  </div><!-- /.row -->
  <div class="row">
    <div :class="md6col">
      <div v-show="hasStartTime" class="form-group">
        <label for="start-time">Start Time: <span :class="iconStar" class="reqstar"></span></label>
        <input id="start-time" class="form-control" type="text" v-model="record.start_time" />
      </div><!-- /.form-group -->
    </div><!-- /.md6col -->
    <div :class="md6col">
      <div v-show="hasEndTime" class="form-group">
        <label for="end-time">End Time: <span :class="iconStar" class="reqstar"></span></label>
        <input id="end-time" class="form-control" type="text" v-model="record.end_time" />
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
      <input v-model="record.contact_person" class="form-control" :class="[formErrors.contact_person ? 'invalid-input' : '']" name="contact-person" type="text">
      <p v-if="formErrors.contact_person" class="help-text invalid">Need a Contact Person!</p>

    </div>
  </div><!-- /.md6col -->
  <div :class="md6col">
    <div class="form-group">
      <label>Contact Email: <span :class="iconStar" class="reqstar"></span><em>(ex.janedoe@emich.edu)</em></label>
      <input v-model="record.contact_email" class="form-control" :class="[formErrors.contact_email ? 'invalid-input' : '']" name="contact-email" type="text">
      <p v-if="formErrors.contact_email" class="help-text invalid">Need a Contact Email!</p>

    </div>
  </div><!-- /.md6col -->
</div><!-- /.row -->
<div class="row">
  <div :class="md6col">
    <div class="form-group">
      <label>Contact Phone <span :class="iconStar" class="reqstar"></span> <em>(ex. 734.487.1849)</em>
        <input v-model="record.contact_phone" class="form-control" :class="[formErrors.contact_phone ? 'invalid-input' : '']" name="contact-phone" type="text">
        <p v-if="formErrors.contact_phone" class="help-text invalid">Need a Contact Phone!</p>
      </label>
    </div>
  </div><!-- /.md6col -->
  <div :class="md6col">
    <div class="form-group">
      <label>Contact Fax: <em>(ex. 734.487.1849)</em>
        <input v-model="record.contact_fax" class="form-control" :class="[formErrors.contact_fax ? 'invalid-input' : '']" name="contact-fax" type="text">
      </label>
    </div>
  </div><!-- /.md6col -->
</div><!-- /.row -->
<!-- RELATED LINKS -->
<div class="row">
  <div :class="md12col">
    <div v-bind:class="formGroup">
      <label>Related Link</label>
      <p class="help-text" id="title-helptext">Please enter the url for your related web page. (ex. www.yourlink.com)</p>
      <div class="input-group input-group-flat">
        <span :class="inputGroupLabel">http://</span>
        <input v-model="record.related_link_1" class="form-control" v-bind:class="[formErrors.related_link_1 ? 'invalid-input' : '']" name="related_link_1" type="text">
      </div>
      <p v-if="formErrors.related_link_1" class="help-text invalid">Please make sure url is properly formed.</p>
    </div>
  </div><!-- /.col-md-4 -->
</div><!-- /.row -->
<div class="row">
  <div :class="md4col">
    <div v-bind:class="formGroup" class="input-group">
      <label>Meaning desciption for Link</label>
      <p class="help-text" id="link_txt-helptext">(ex. The event webpage)</p>
      <input v-model="record.related_link_1_txt" class="form-control" v-bind:class="[formErrors.related_link_1_txt ? 'invalid-input' : '']" name="related_link_1_txt" type="text">
      <p v-if="formErrors.related_link_1_txt" class="help-text invalid"> Please include a descriptive text for your related link.</p>
    </div>
  </div><!-- /.col-md-4 -->
  <div :class="md8col">
    <div v-bind:class="formGroup">
      <label>Example of Related Link</label>
      <p class="help-text">Below is how it may look. </p>
      <h5 class="form-control">For more information visit: <a href="#"> {{record.related_link_1_txt}}</a>.</h5>
    </div>
  </div><!-- /.md6col -->
</div>
<!-- Two -->
<template v-if="record.related_link_1 && record.related_link_1_txt">
  <div class="row">
    <div :class="md12col">
      <div v-bind:class="formGroup">
        <label>Related Link</label>
        <p class="help-text" id="title-helptext">Please enter the url for your related web page. (ex. www.yourlink.com)</p>
        <div class="input-group input-group-flat">
          <span :class="inputGroupLabel">http://</span>
          <input v-model="record.related_link_2" class="form-control" v-bind:class="[formErrors.related_link_2 ? 'invalid-input' : '']" name="related_link_2" type="text">
        </div>
        <p v-if="formErrors.related_link_2" class="help-text invalid">Please make sure url is properly formed.</p>
      </div>
    </div><!-- /.col-md-4 -->
  </div><!-- /.row -->
  <div class="row">
    <div :class="md4col">
      <div v-bind:class="formGroup" class="input-group">
        <label>Meaning desciption for Link</label>
        <p class="help-text" id="link_txt-helptext">(ex. The event webpage)</p>
        <input v-model="record.related_link_2_txt" class="form-control" v-bind:class="[formErrors.related_link_2_txt ? 'invalid-input' : '']" name="related_link_2_txt" type="text">
        <p v-if="formErrors.related_link_2_txt" class="help-text invalid"> Please include a descriptive text for your related link.</p>
      </div>
    </div><!-- /.col-md-4 -->
    <div :class="md8col">
      <div v-bind:class="formGroup">
        <label>Example of Related Link</label>
        <p class="help-text">Below is how it may look. </p>
        <h5 class="form-control">For more information visit: <a href="#"> {{record.related_link_2_txt}}</a>.</h5>
      </div>
    </div><!-- /.md6col -->
  </div>
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
          <input v-model="record.related_link_3" class="form-control" v-bind:class="[formErrors.related_link_3 ? 'invalid-input' : '']" name="related_link_3" type="text">
        </div>
        <p v-if="formErrors.related_link_3" class="help-text invalid">Please make sure url is properly formed.</p>
      </div>
    </div><!-- /.col-md-4 -->
  </div><!-- /.row -->
  <div class="row">
    <div :class="md4col">
      <div v-bind:class="formGroup" class="input-group">
        <label>Meaning desciption for Link</label>
        <p class="help-text" id="link_txt-helptext">(ex. The event webpage)</p>
        <input v-model="record.related_link_3_txt" class="form-control" v-bind:class="[formErrors.related_link_3_txt ? 'invalid-input' : '']" name="related_link_3_txt" type="text">
        <p v-if="formErrors.related_link_3_txt" class="help-text invalid"> Please include a descriptive text for your related link.</p>
      </div>
    </div><!-- /.col-md-4 -->
    <div :class="md8col">
      <div v-bind:class="formGroup">
        <label>Example of Related Link</label>
        <p class="help-text">Below is how it may look. </p>
        <h5 class="form-control">For more information visit: <a href="#"> {{record.related_link_3_txt}}</a>.</h5>
      </div>
    </div><!-- /.md6col -->
  </div>
</template>
<!-- RELATED LINKS -->

<div class="row">
  <div :class="md6col">
    <div class="form-group">
      <label for="reg-deadline">Registration Deadline</label>
      <input id="reg-deadline" type="text" v-model="record.reg_deadline" aria-describedby="errorRegDeadline"  />
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
      <label>Tickets Available
        <select v-model="record.tickets" class="form-control">
          <option v-for="ticketoption in ticketoptions" :value="ticketoption.value">
            {{ ticketoption.label }}
          </option>
        </select>
      </label>
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
      <!-- <v-select :value="record.participants"
      :options="participants"
      :searchable="false"
      >

    </v-select> -->

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
    <div :class="formGroup">
      <label>Description <span :class="iconStar" class="reqstar"></span> <p class="help-text" id="description-helptext">({{descriptionChars}} characters left)</p>

        <textarea v-model="record.description" class="form-control" :class="[formErrors.description ? 'invalid-input' : '']" name="description" type="textarea" rows="6"></textarea>
      </label>
      <p v-if="formErrors.description" class="help-text invalid">Need a Description!</p>

    </div>
  </div><!-- /.md12col -->
</div><!-- /.row -->
<div class="row">
  <div :class="md12col">

    <!-- <div :class="formGroup">
    <label>Group Website Calendar <p class="help-text" id="minicalendar-helptext">If your groups website has a calendar that is fed from this one, and you would like this event to show up on it, please select it from the list below:</p>
    <v-select
    :debounce="250"
    :value.sync="record.minicalendars"
    :on-search="fetchForSelectMiniCalendarList"
    :multiple="true"
    :options="minicals"
    placeholder="Select a minicalendar..."
    label="calendar">
  </v-select>
</label>
</div> -->
</div><!-- /.md12col -->

<div :class="md12col">
  <v-select
  :value.sync="record.minicalendars"
  :options="minicalslist"
  :multiple="true"
  placeholder="Select Mini Calendar"
  label="calendar">
</v-select>

<!-- <div :class="formGroup">
<label>Group Website Calendar <p class="help-text" id="minicalendar-helptext">If your groups website has a calendar that is fed from this one, and you would like this event to show up on it, please select it from the list below:</p>
<select v-model="record.mini_calendar" id="mini_calendar" v-myselect="mini_calendar">
<option v-for="minicalendar in minicalendars" :value="minicalendar.id">
{{minicalendar.calendar}}
</option>
</select>
</label>
</div> -->
</div><!-- /.md12col -->
</div><!-- /.row -->
<div class="row">
  <div :class="md12col">
    <div :class="formGroup">
      <div v-bind:class="formGroup">
        <button id="btn-event" v-on:click="submitForm" type="submit" v-bind:class="btnPrimary">{{submitBtnLabel}}</button>
        <button v-if="recordexists" id="btn-clone" v-on:click="cloneEvent" type="submit" v-bind:class="btnPrimary">Create new Event based of this information</button>
        <button v-if="recordexists" id="btn-delete" v-on:click="delEvent" type="submit" class="redBtn" v-bind:class="btnPrimary">Delete this Event</button>
      </div>
    </form>
  </div><!-- /.md12col -->


</template>
<style scoped>
p {
  margin:0;
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
/*input[type='text'], [type='password'],
[type='date'], [type='datetime'],
[type='datetime-local'], [type='month'],
[type='week'], [type='email'],
[type='number'], [type='search'],
[type='tel'], [type='time'],
[type='url'], [type='color'],
textarea {
marging-bottom: 0;
}*/

.input-group input[type='text'] {
  marging-bottom: 0;
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
  padding-bottom: 320px;
}
.yellowBtn {
  background: hsl(60, 70%, 50%);
}
.redBtn {
  background: hsl(0, 90%, 70%);
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
import flatpickr from "flatpickr"
import vSelect from "vue-select"
module.exports  = {
  directives: {},
  components: {vSelect},
  props:{
    authorid: {default : '0'},
    recordexists: {default: false},
    recordid: {default: ''},
    framework: {default: 'foundation'}
  },
  data: function() {
    return {
      minicalslist:[],
      dateObject:{
        startDateMin: '',
        startDateDefault: '',
        endDateMin: '',
        endDateDefault: '',
        regDateMin: '',
        regDateDefault: ''
      },
      // linkText1: '',
      // linkUrl1: '',
      // linkText2: '',
      // linkUrl2: '',
      // linkText3: '',
      // linkUrl3:'',
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
        title: 100,
        description: 255
      },
      building_in: [],
      building: null,
      buildings: [],
      // newbuilding: '',
      //
      // zbuildings: [],
      zcategories: [],
      zcats: [],
      categories: {},
      minicals: null,
      minicalendars: {},
      record: {
        user_id: 0,
        on_campus: 1,
        all_day: 0,
        no_end_time: 0,
        free: 0,
        title: '',
        description: '',
        mini_calendar: '',
        building: '',
        categories:[]
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
    this.record.user_id = this.authorid;
    if(this.recordexists){
      console.log('recordid'+ this.recordid)
      this.fetchCurrentRecord(this.recordid)
    } else {
      //this.record.start_date = this.currentDate;
      this.setupDatePickers();
    }
    this.fetchMiniCalsList();
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
        room = (this.record.room)?' - Room:' + this.record.room:'';

      } else {
        bldg = ''
        room = ''
      }
      return bldg + room;
      // let  buildingChoice = 	this.record.building
      // let room = (this.record.room)?' - Room:' + this.record.room:'';
      // return this.record.building+ room;
      // return this.zbuilding[0] + room
    },
    isOnCampus: function() {
      return this.record.on_campus == 1 ? true:false;
    },
    realCost: function() {
      if(this.record.free == 1 ) {
        return '0.00';
      } else {
        // this.record.cost = '';
        return '';
      }
      // return this.record.free == 1 ? false:true;
    },
    hasCost: function() {
      if(this.record.free == 1 ) {
        this.record.cost = '0.00';
        return false;
      } else {
        // this.record.cost = '';
        return true;
      }
      // return this.record.free == 1 ? false:true;
    },
    titleChars: function() {
      var str = this.record.title;
      // console.log(str.length);
      var cclength = str.length;
      return this.totalChars.title - cclength;
      // this.totalChars.title - (this.record.title).length
    },
    descriptionChars: function() {
      var str = this.record.description;
      // console.log(str.length);
      var cclength = str.length;
      return this.totalChars.description - cclength;
      // this.totalChars.title - (this.record.title).length
    },
    hasStartTime: function() {
      return this.record.all_day == 1? false : true;

    },
    hasEndTime: function() {
      return (this.record.all_day == 1 || this.record.no_end_time == 1)?false : true;
    },
    // relatedLink1: function() {
    //   if (this.record.related_link_1 || this.record.related_link_1_txt) {
    //     return this.record.related_link_1_txt
    //   }
    // },
    // relatedLink2: function() {
    //   if (this.record.related_link_2 || this.record.related_link_2) {
    //     return this.record.related_link_2_txt
    //   }
    // },
    // relatedLink3: function() {
    //   if (this.record.related_link_3 || this.record.related_link_3) {
    //     return this.record.related_link_3_txt
    //   }
    // },

  },
  methods: {
    refreshUserEventTable: function(){
      $.get('/calendar/user/events', function(data){
        data = $.parseJSON(data);
        // console.log(data.content);
        $('#user-events-tables').html(data);
      });
    },

    fetchMiniCalsList: function() {
      this.$http.get('/api/minicalslist')
      .then((response) =>{
        //   let taglistraw = response.data;
        //   let taglistformat = this.foreachTagListRaw(response.data);


        this.$set('minicalslist', response.data)
      }, (response) => {
        //error callback
        console.log("ERRORS");
        this.formErrors =  response.data.error.message;

      }).bind(this);
    },
    setupDatePickers:function(){
      var self = this;
      console.log("setupDatePickers");
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
        this.dateObject.startTimeDefault = this.record.end_time;
        this.dateObject.regDateMin = this.record.start_date;
        this.dateObject.regDateDefault = this.record.reg_deadline;
      }
      this.startdatePicker = flatpickr(document.getElementById("start-date"), {
        minDate: self.dateObject.startDateMin,
        defaultDate: self.dateObject.startDateDefault,
        enableTime: false,
        altFormat: "m-d-Y",
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
        altFormat: "m-d-Y",
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
        defaultDate: self.dateObject.endDateDefault,
        onChange(timeObject, timeString) {
          self.record.start_time = timeString;
          self.starttimePicker.value = timeString;
        }

      });
      this.endtimePicker = flatpickr(document.getElementById("end-time"),{
        noCalendar: true,
        enableTime: true,
        onChange(timeObject, timeString) {
          self.record.end_time = timeString;
          self.endtimePicker.value = timeString;
        }

      });

      this.regdeadlinePicker = flatpickr(document.getElementById("reg-deadline"),{
        minDate: self.dateObject.regDateMin,
        defaultDate: self.dateObject.regDateDefault,
        enableTime: false,
        altFormat: "m-d-Y",
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
      console.log('FROM CANCEL: '+recid);
      this.formMessage.isOk = false;
      this.formMessage.msg = false;

      this.$http.patch('/api/event/'+ recid + '/cancel')
      .then((response) => {
        console.log('GOOD:'+JSON.stringify(response))
        this.formMessage.isOk = response.ok;
        this.formMessage.msg = response.body.message;
      }, (response) => {
        console.log('BAD:'+JSON.stringify(response))
      }).bind(this);
      this.refreshUserEventTable();
    },

    fetchCurrentRecord: function() {
      console.log('FROM FETCH: '+this.recordid);
      this.$http.get('/api/event/'+ this.recordid + '/edit')

      .then((response) =>{
        //response.status;
        console.log('response.status=' + response.status);
        console.log('response.ok=' + response.ok);
        console.log('response.statusText=' + response.statusText);
        // console.log('response==== ' + JSON.stringify(response));
        // console.log('response.data=' + response.data.json());
        // this.record = response.data.data;
        this.$set('record', response.data.data)

        this.checkOverData();
        this.refreshUserEventTable();
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
      loading(true)
      this.$http.get('/api/categorylist',{
        q: search
      }).then(resp => {
        this.zcats = resp.data;
        loading(false)
      })
    },
    fetchForSelectBuildingList(search,loading) {
      loading(true)
      this.$http.get('/api/buildinglist',{
        q: search
      }).then(resp => {
        this.buildings = resp.data;
        loading(false)
      })
    },
    // fetchForSelectMiniCalendarList(search,loading) {
    //     loading(true)
    //     this.$http.get('/api/minicals',{
    //         q: search
    //     }).then(resp => {
    //         this.minicals = resp.data;
    //         loading(false)
    //     })
    // },
    fetchMiniCalendarList: function() {
      this.$http.get('/api/minicalendars').then(function(response){
        // console.log('response->minicalendars=' + JSON.stringify(response.data));
        this.minicalendars = response.data.data;

      }, function(response) {
        //  this.$set(this.formErrors, response.data);
        console.log(response);
      });
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
            window.location.href = "/admin/event/queue";
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

    submitForm: function(e) {
      //  console.log('this.eventform=' + this.eventform.$valid);
      e.preventDefault();
      this.formMessage.isOk = false;
      this.formMessage.isErr = false;

      $('html, body').animate({ scrollTop: 0 }, 'fast');

      this.record.author_id = this.authorid;
      // this.record.related_link_1 = this.relatedLink1;
      // this.record.related_link_1 = this.relatedLink1;
      if(this.record.on_campus == true) {
        this.record.location = this.convertToSlug(this.computedLocation);
      } else {
        this.record.location = this.record.locationoffcampus;
        // clearout these values
        this.record.building = null;
        this.record.building_id = null;
        this.record.room = null;
      }
      // this.record.location = (this.on_campus)?this.computedLocation: this.record.location;
      // this.record.categories = this.zcategories;
      // console.log("cats="+ this.record.categories);
      //
      //
      this.record.minicals = (this.record.minicalendars)?this.record.minicalendars:null;
      this.record.categories = this.record.eventcategories;

      let method = (this.recordexists) ? 'put' : 'post'
      let route =  (this.recordexists) ? '/api/event/' + this.recordid : '/api/event';

      this.$http[method](route, this.record)

      // this.$http.post('/api/story', this.record)
      // this.$http.post('/api/event', this.record)

      .then((response) =>{
        response.status;
        console.log('response.status=' + response.status);
        console.log('response.ok=' + response.ok);
        console.log('response.statusText=' + response.statusText);
        console.log('response.data=' + response.data.message);
        this.formMessage.msg = response.data.message;
        this.formMessage.isOk = response.ok;
        this.formMessage.isErr = false;
        this.currentRecordId = response.data.newdata.record_id;
        this.recordexists = true;
        this.formErrors = {};
        this.fetchCurrentRecord(this.currentRecordId)

      }, (response) => {
        this.formMessage.isOk = false;
        this.formMessage.isErr = true;
        //error callback
        // console.log("FORM ERRORS     " + response.json());

        this.formErrors = response.data.error.message;
        console.log(response.data.error.message);
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
    },

    resetInital: function(){
      // oh gosh.. is there a better way?
      return {
        minicalslist:[],
        dateObject:{
          startDateMin: '',
          startDateDefault: '',
          endDateMin: '',
          endDateDefault: '',
          regDateMin: '',
          regDateDefault: ''
        },
        linkText1: '',
        linkUrl1: '',
        linkText2: '',
        linkUrl2: '',
        linkText3: '',
        linkUrl3:'',
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
          title: 100,
          description: 255
        },
        building_in: [],
        building: null,
        buildings: [],
        // newbuilding: '',
        //
        // zbuildings: [],
        zcategories: [],
        zcats: [],
        categories: {},
        minicals: null,
        minicalendars: {},
        record: {
          user_id: 0,
          on_campus: 1,
          all_day: 0,
          no_end_time: 0,
          free: 0,
          title: '',
          description: '',
          mini_calendar: '',
          building: '',
          categories:[]
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
    }
  },

  watch: {

  },


  events: {
    // 'building-change':function(name) {
    // 	this.newbuilding = '';
    // 	this.newbuilding = name;
    // 	console.log(this.newbuilding);
    // },
    // 'categories-change':function(list) {
    // 	this.categories = '';
    // 	this.categories = list;
    // 	console.log(this.categories);
    // }
  }
};

</script>
