<template>

  <!-- <div class="box box-default box-solid"> -->
  <div :class="specialItem">

    <div :class="liveTimeStatusClass" class="box box-solid">
      <div class="box-header with-border">
        <div class="row">
          <div class="col-sm 12 col-md-4">
            <div class="box-date-top pull-left">{{ titleDateLong(item.start_date) }}</div>
            <div class="pull-right">
              <label data-toggle="tooltip" data-placement="top" title="Promoted"><span class="item-promoted-icon"
                                                                                       :class="promotedIcon"></span></label>
            </div><!-- /.pull-right -->
          </div><!-- /.col-sm-6 -->
          <div class="col-sm 12 col-md-8">
            <form class="form-inline pull-right">
              <div id="applabel" class="form-group">
              </div>
              <div class="form-group">
                <input type="button" v-if="item.is_approved" value="Unapprove" class="btn btn-warning btn-xs" @click.prevent="changeIsApproved">
                <input type="button" v-else value="Approve" class="btn btn-success btn-xs" @click.prevent="changeIsApproved">
              </div>
              <button v-if="pid == 'item-elevated'" type="button"
                      class="btn btn-sm btn-danger pull-right remove-event-btn" @click="emitEventDemote(item)"><i
                  class="fa fa-times" aria-hidden="true"></i></button>
            </form>
          </div><!-- /.col-sm-6 -->
        </div><!-- /.row -->
        <div class="row">
          <a v-on:click.prevent="toggleBody" href="#">
            <div class="col-sm-12">
              <h6 class="box-title">{{ item.title }}</h6>
              <span class="event-cancel" v-if="item.is_canceled"> - canceled</span>
              <span class="event-cancel" v-if="item.is_archived"> - archived</span>
            </div><!-- /.col-md-12 -->
          </a>
        </div><!-- /.row -->
      </div>  <!-- /.box-header -->

      <div v-if="showBody" class="box-body">
        <!-- <div class="box-body"> -->
        <div v-if="formMessage.msg" class="callout bg-success">
          <h5>{{ formMessage.msg }}</h5>
        </div>
        <div v-if="formMessage.err" class="callout bg-danger">
          <h5>{{ formMessage.err }}</h5>
        </div>
        <template v-if="canHaveImage">
          <img v-if="hasEventImage" :src="imageUrl"/><br/>
          <a v-on:click.prevent="togglePanel" style="width: 100px" class="btn btn-info btn-sm"
             href="#">{{ hasEventImage ? 'Change Image' : 'Promote Event' }}</a>
          <div v-if="showPanel">
            <!-- <div class="panel"> -->
            <div>
              <form :id="'form-mediafile-upload'+item.id" @submit.prevent="addMediaFile" class="mediaform m-t"
                    role="form" :action="'/api/event/addMediaFile/'+item.id" enctype="multipart/form-data" files="true">
                <input name="eventid" class="hidden" type="input" v-model="formInputs.event_id"/>
                <input type="text" class="hidden" name="caption" id="caption" v-model="formInputs.caption"/>
                <input type="text" class="hidden" name="alt_text" id="alt_text" v-model="formInputs.alt_text"/>
                <div class="fa fa-photo btn btn-info btn-sm block m-b file-upload">
                  <input ref="eventimg" type="file" @change="getFileName" class="file-input" name="eventimg"
                         id="eventimg">
                </div>
                <button v-if="eventimage" id="btn-mediafile-upload" type="submit"
                        class="fa fa-floppy-o btn btn-sm bg-orange block m-b"></button>
                <span class="file-input-helpertext" id="file-name">{{ eventimage }}</span><br/>
              </form>
              <form v-if="hasEventImage" :id="'form-mediafile-remove'+item.id" @submit.prevent="removeMediaFile"
                    class="mediaform m-t" role="form" :action="'/api/event/removeMediaFile/'+item.id">
                <input name="eventid" class="hidden" type="input" v-model="formInputs.event_id">
                <button id="btn-mediafile-remove" type="submit"
                        class="fa fa-eraser btn btn-sm btn-danger block m-b"></button>
              </form>
            </div>
            <div class="input-group caption" v-if="hasEventImage">
              <span class="input-group-addon caption">Caption: </span>
              <input class="form-control" type="text" v-model="formInputs.caption"/>
            </div>
            <div class="input-group caption" v-if="hasEventImage">
              <span class="input-group-addon caption">Alt text: </span>
              <input class="form-control" type="text" v-model="formInputs.alt_text"/>
            </div>
          </div><!-- /.panel mediaform -->

          <hr/>
        </template>
        <p>From: {{ momentPretty(item.start_date) }}, {{ item.start_time }} To: {{ momentPretty(item.end_date) }},
          {{ item.end_time }}</p>
        <template v-if="item.all_day">
          <p>All Day Event</p>
        </template>
        <hr/>
        <div class="item-info">
          <p>Title: {{ item.title }}</p>
          <p v-if="item.short_title">Short-title: {{ item.shor_title }}</p>
          <p>Description: {{ item.description }}</p>
          <template v-if="isOnCampus">
            <p>Location: <a :href="'http://emich.edu/maps/?building='+item.building"
                            target="_blank">{{ item.location }}</a></p>
          </template>
          <hr/>
          <template v-if="!isOnCampus">
            <p>Location: {{ item.location }}</p>
          </template>
          <template v-if="item.contact_person || item.contact_person || item.contact_person">
            <p>Contact:</p>
            <ul>
              <li v-if="item.contact_person">Person: {{ item.contact_person }}</li>
              <li v-if="item.contact_email">Email: {{ item.contact_email }}</li>
              <li v-if="item.contact_phone">Phone: {{ item.contact_phone }}</li>
            </ul>
          </template>
          <template v-if="item.related_link_1">
            <p>For more information, visit:</p>
            <ul>
              <li><a :href="hasHttp(item.related_link_1)" target="_blank">
                <template v-if="item.related_link_1_txt">{{ item.related_link_1_txt }}</template>
                <template v-else>{{ item.related_link_1 }}</template>
              </a></li>
              <li v-if="item.related_link_2"><a :href="hasHttp(item.related_link_2)" target="_blank">
                <template v-if="item.related_link_2_txt">{{ item.related_link_2_txt }}</template>
                <template v-else>{{ item.related_link_2 }}</template>
              </a></li>
              <li v-if="item.related_link_3"><a :href="hasHttp(item.related_link_3)" target="_blank">
                <template v-if="item.related_link_3_txt">{{ item.related_link_3_txt }}</template>
                <template v-else>{{ item.related_link_3 }}</template>
              </a></li>
            </ul>
          </template>
          <hr/>
          <p v-if="item.free">Cost: Free</p>
          <p v-else>Cost: {{ currency(item.cost) }}</p>
          <p>Participation: {{ eventParticipation }}</p>
          <template v-if="item.tickets">
            <p v-if="item.ticket_details_online">For Tickets Visit: <a :href="hasHttp(item.ticket_details_online)">{{ item.ticket_details_online }}</a>
            </p>
            <p v-if="item.ticket_details_phone">For Tickets Call: {{ item.ticket_details_phone }}</p>
            <p v-if="item.ticket_details_office">For Tickets Office: {{ item.ticket_details_office }}</p>
            <p v-if="item.ticket_details_other">Or: {{ item.ticket_details_other }}</p>
          </template>
          <hr/>
          <p>LBC Approved: {{ yesNo(item.lbc_approved) }}</p>
          <hr/>
          <p>Submitted by: {{ item.submitter }}</p>
        </div>
      </div><!-- /.box-body -->


      <div :class="addSeperator" class="box-footer list-footer">
        <div class="row">
          <div class="col-sm-12 col-md-9">
            <span v-if="itemCurrent" :class="timeFromNowStatus">Live {{ timefromNow }}</span> <span
              :class="timeLeftStatus">{{ timeLeft }}</span>
          </div><!-- /.col-md-7 -->
          <div class="col-sm-12 col-md-3">
            {{ item.id }}
            <div class="btn-group pull-right">
              <button v-on:click.prevent="editItem" class="btn bg-orange btn-xs footer-btn"><i class="fa fa-pencil"></i>
              </button>
            </div><!-- /.btn-toolbar -->
          </div><!-- /.col-md-7 -->
        </div><!-- /.row -->
      </div><!-- /.box-footer -->
    </div><!-- /.box- -->
  </div>
</template>
<style scoped>
.file-upload {
  position: relative;
  overflow: hidden;
}

.file-upload input.file-input {
  position: absolute;
  top: 0;
  right: 0;
  margin: 0;
  padding: 0;
  cursor: pointer;
  opacity: 0;
  filter: alpha(opacity=0);
}

span.file-input-helpertext {
  display: inline-block;
  line-height: 18px;
  margin: 0 .5rem;
  padding: 0;
  vertical-align: middle;
  padding: .2rem 0;
  overflow: hidden;
  border-bottom: 1px solid #bbb;
}

/*//////////////////*/
.event-cancel {
  font-size: 90%;
  font-weight: normal;
  color: #333;
}

.input-group.caption {
  margin: .5rem 0;
}

.input-group-addon.caption {
  background-color: #ddd;
}

.box {
  color: #1B1B1B;
  margin-bottom: 10px;
}

.box-body {
  background-color: #fff;
  border-bottom-left-radius: 0;
  border-bottom-right-radius: 0;
  margin: 0;
}

.box-header {
  padding: 3px;
}

.box-footer {
  padding: 3px;
}

h5.box-footer {
  padding: 3px;
}

button.footer-btn {
  border-color: #999999;

}

h6.box-title {
  font-size: 16px;
  color: #1B1B1B;
}

form {
  display: inline-block;
}

form.mediaform {
  margin-top: 1rem;
}

.form-group {
  margin-bottom: 2px;
}

#applabel {
  margin-left: 2px;
  margin-right: 2px;
  padding-left: 2px;
  padding-right: 2px;
}

.btn-group,
.btn-group-vertical {
  display: inline-flex;
}

select.form-control {
  height: 22px;
  border: 1px solid #999999;
}

h6 {
  margin-top: 0;
  margin-bottom: 0;
}

h5 {
  margin-top: 0;
  margin-bottom: 0;
}

.form-group {
  /*border: 1px solid red;*/
}

.form-group label {
  margin-bottom: 0;
}

.topitems {
  /*background-color: #9B59B6;*/
  background-color: #76D7EA;
  border: 2px solid #9B59B6;
}

.ongoing {
  background-color: #ffcc33;
  border: 1px solid #999999
}

.event-positive {

  background-color: #D8D8D8;
  border: 1px solid #999999;
}

.event-negative {

  background-color: #999999;
  border: 1px solid #999999;
}

.is-promoted {

  background-color: #76D7EA;
  /*border: 1px solid #999999*/
}

.time-is-short {
  color: #F39C12;
}

.time-is-long {
  color: #999999;
}

.time-is-over {
  color: #9B59B6;
}

.special-item {
  border-left: 6px solid #ff00bf;

  padding-left: 3px;
  border-top-left-radius: 3px;
  border-bottom-left-radius: 3px;
  margin-left: -10px;

}

.special-item-both {
  border-left: 6px solid #bfff00;
}

.special-item-home {
  border-left: 6px solid #00bfff;
}

.special-item-last {
  margin-bottom: 30px;
}

.remove-event-btn {
  margin-left: 10px;
}

.form-check {
  display: inline;
}
</style>
<script>
import moment from 'moment'

export default {
  components: { },
  props: ['item', 'pid', 'index', 'elevatedEvents'],
  data: function () {
    return {
      checked: false,
      eventimage: '',
      formInputs: {
        event_id: '',
        attachment: '',
        caption: '',
        alt_text: '',
      },
      showBody: false,
      showPanel: false,
      initRecord: {
        is_approved: 0,
        priority: 0,
        home_priority: 0,
        is_canceled: 0,
        eventimage: ''
      },
      patchRecord: {
        is_approved: 0,
        priority: 0,
        home_priority: 0,
        is_canceled: 0,
        eventimage: ''
      },
      formMessage: {
        msg: false,
        err: false,
      },
      itemCurrent: 1,
      currentDate: {},
      record: {}
    }
  },
  created () {
    this.initRecord.is_approved = this.patchRecord.is_approved = this.item.is_approved;
    this.initRecord.priority = this.patchRecord.priority = this.item.priority;
    this.initRecord.home_priority = this.patchRecord.home_priority = this.item.home_priority;
    this.initRecord.is_canceled = this.patchRecord.is_canceled = this.item.is_canceled;
    this.initRecord.eventimage = this.eventimage = this.patchRecord.eventimage = this.item.eventimage;
    this.formInputs.caption = this.caption = this.patchRecord.caption = this.item.caption;
    this.formInputs.alt_text = this.alt_text = this.patchRecord.alt_text = this.item.alt_text;
  },
  computed: {
    addSeperator: function () {
      let asclass = 'box-footer-normal';
      if (this.pid == 'items-live' && this.index == 3) {
        asclass = 'box-footer-last-special';
      }
      return asclass;
    },
    hasIsApprovedChanged: function () {
      if (this.initRecord.is_approved != this.patchRecord.is_approved) {
        return true
      }
      else {
        return false
      }
    },
    timeLeftStatus: function () {
      let diff = this.timeDiffNow(this.item.end_date_time)
      if (diff <= 0) {
        return 'time-is-over'
      }
      else if (diff > 0 && diff <= 720) {
        return 'time-is-short'
      }
      else {
        return 'time-is-long'
      }
    },

    timeFromNowStatus: function () {
      let diff = this.timeDiffNow(this.item.start_date_time)
      if (diff <= 0) {
        return 'time-is-over'
      }
      else if (diff > 0 && diff <= 720) {
        return 'time-is-short'
      }
      else {
        return 'time-is-long'
      }
    },
    timefromNow: function () {
      return moment(this.item.start_date_time).fromNow()
    },
    timeLeft: function () {
      if (moment(this.item.start_date_time).isSameOrBefore(moment())) {
        let tlft = this.timeDiffNow(this.item.end_date_time);
        if (tlft < 0) {
          this.itemCurrent = 0;
          return 'Event Ended ' + moment(this.item.end_date_time).fromNow()
        }
        else {
          this.itemCurrent = 1;
          return ' and Ends ' + moment(this.item.end_date_time).fromNow()
        }
      }
      else {
        return ''
      }
    },
    specialItem: function () {
      let extrasep;

      if (this.pid == 'items-live' && this.index < 9) {
        if (this.item.home_priority > 0 && this.item.priority > 0) {
          extrasep = 'special-item special-item-both';
        }
        else if ((this.item.home_priority > 0 && this.item.priority == 0)) {
          extrasep = 'special-item special-item-home';
        }
        else if ((this.item.home_priority == 0 && this.item.priority > 0)) {
          extrasep = 'special-item special-item-today';
        }

      }
      else {
        extrasep = ''
      }
      return extrasep;
    },
    liveTimeStatusClass: function () {
      let timepartstatus;

      if (moment().isBetween(this.item.start_date_time, this.item.end_date_time)) {
        timepartstatus = 'ongoing';
      }
      else {
        if (this.timeDiffNow(this.item.start_date_time) < 0) {
          timepartstatus = 'event-negative';
        }
        else {
          timepartstatus = 'event-positive';
        }
      }
      return timepartstatus;
    },
    itemStatus: function () {
      let sclass = 'box-default';
      if (this.pid == 'items-live') {
        if (this.index < 4) {
          sclass = 'topitems';
        }
      }
      return sclass;
    },
    promotedIcon: function () {
      let pIcon = ''
      if (this.item.is_promoted === 1) {
        pIcon = 'fa fa fa-star'
      }
      return pIcon
    },
    hasEventImage: function () {
      if (this.item.eventimage) {
        return true;
      }
      else {
        return false;
      }
    },
    canHaveImage: function () {
      if (this.item.is_approved) {
        return true;
      }
      else {
        return false;
      }
    },
    imageUrl: function () {
      var pth = "/imagecache/smallthumb/";
      var fname = this.item.eventimage;
      return pth + fname;
    },
    isApproved: function () {
      return this.item.is_approved;
    },
    itemEditPath: function () {
      return '/admin/event/' + this.item.id + '/edit'
    },
    itemPreviewPath: function () {
      return '/admin/preview/event/' + this.item.id
    },
    isOnCampus: function () {
      if (this.item.building === null || this.item.building === "undefined") {
        return false
      }
      else {
        return true
      }
    },
    eventParticipation: function () {
      switch (this.item.participants) {
        case 'campus':
          return 'Campus Only'
          break;
        case 'public':
          return 'Open to Public'
          break;
        case 'students':
          return 'Students Only'
          break;
        case 'invite':
          return 'Invitation Only'
          break;
        case 'tickets':
          return 'Tickets Required'
          break;
        default:
          return ''
      }
    },
    isElevatedEvent: function () {
      if (this.elevatedEvents) {
        for (var i = 0; i < this.elevatedEvents.length; i++) {
          if (this.elevatedEvents[i].id == this.item.id) {
            this.checked = true
            return true
          }
        }
      }
      this.checked = false
      return false
    },
  },
  methods: {
    currency (amount) {
      if (isNaN(amount)) {
        return amount
      }
      return '$' + parseFloat(amount).toFixed(2)
    },
    // Handle the form submission here
    timeDiffNow: function (val) {
      return moment(val).diff(moment(), 'minutes');
    },
    changeIsApproved: function () {
      this.patchRecord.is_approved = (this.item.is_approved === 0) ? 1 : 0;
      this.updateItem();

    },
    editItem: function (ev) {
      window.location.href = this.itemEditPath;
    },
    priorityChange (event) {

    },
    getFileName () {
      let files = this.$refs.eventimg.files;
      this.eventimage = this.$refs.eventimg.files[0].name;
    },
    addMediaFile (event) {
      event.preventDefault();
      event.stopPropagation();
      this.formMessage.msg = false;
      this.formMessage.err = false;

      const files = this.$refs.eventimg.files;
      const data = new FormData();
      data.append('event_id', this.item.id);
      data.append('caption', this.formInputs.caption);
      data.append('alt_text', this.formInputs.alt_text);

      if (files[0]) {
        data.append('eventimg', files[0]);
      }
      const action = '/api/event/addMediaFile/' + this.item.id;
      this.$http.post(action, data, {
        headers: {
          'Content-Type': 'multipart/form-data'
        }
      })
      .then((response) => {
        this.checkAfterUpdate(response.data.newdata)
        this.formMessage.msg = response.message;
      })
      .catch(() => {
        this.formMessage.err = "Something when wrong.";
      });
    },
    removeMediaFile (event) {
      event.preventDefault()
      event.stopPropagation()
      this.formMessage.msg = false
      this.formMessage.err = false

      const data = new FormData()
      data.append('event_id', this.item.id)
      const action = '/api/event/removeMediaFile/' + this.item.id
      this.$http.post(action, data)
      .then((response) => {
        this.formMessage.msg = response.data.message
        this.checkAfterUpdate(response.data.newdata)
      }).catch((e) => {
        console.log(e)
        this.formMessage.err = "Something when wrong."
      });
    },
    updateItem: function () {
      this.patchRecord.is_canceled = this.item.is_canceled;

      this.formMessage.msg = false;
      this.formMessage.err = false;

      $("#automail").prop('checked') == true ? this.patchRecord.automail = true : this.patchRecord.automail = false;

      this.$http.patch('/api/event/updateitem/' + this.item.id, this.patchRecord, {
        method: 'PATCH'
      })
      .then((response) => {
        this.checkAfterUpdate(response.data.newdata)
      }, (response) => {
      });
    },
    checkAfterUpdate: function (ndata) {
      this.item.is_approved = this.initRecord.is_approved = ndata.is_approved;
      this.item.is_promoted = this.initRecord.is_promoted = ndata.is_promoted;
      this.item.priority = this.initRecord.priority = ndata.priority;
      this.item.home_priority = this.initRecord.home_priority = ndata.home_priority;
      this.item.is_canceled = this.initRecord.is_canceled = ndata.is_canceled;
      this.item.eventimage = this.eventimage = this.initRecord.eventimage = ndata.eventimage;

      // Unapproved events lose priority status
      if (!this.item.is_approved) {
        this.emitEventDemote(this.item)
      }

      var self = this; // huiasd  k
      setTimeout(function () {
        self.formMessage.msg = false;
        self.formMessage.err = false;
      }, 5000);
    },
    togglePanel: function (ev) {
      if (this.showPanel === false) {
        this.showPanel = true;
      }
      else {
        this.showPanel = false;
      }
    },
    toggleBody: function (ev) {
      if (this.showBody == false) {
        this.showBody = true;
      }
      else {
        this.showBody = false;
      }
    },
    doThis: function (ev) {
      this.item.is_approved = (this.is_approved === 0) ? 1 : 0;
      this.$emit('item-change', this.item);
    },
    emitEventElevate: function (eventObj) {
      // Dispatch an event that propagates upward along the parent chain using $dispatch()
      this.$emit('event-elevated', eventObj)
    },
    emitEventDemote: function (eventObj) {
      // Dispatch an event that propagates upward along the parent chain using $dispatch()
      // IMPORTANT: You must emit the object id as opposed to the entire object because objects loaded from Laravel will be DIFFERENT objects
      this.$emit('event-demoted', eventObj.id)
    },
    toggleEmitEventElevate: function (eventObj) {
      // function will run before this.checked is switched

      // Check if browser is Safari. Safari treats the true/false nature of checkboxes differently than chrome and firefox
      // https://www.learningjquery.com/2017/05/how-to-use-javascript-to-detect-browser
      if (navigator.userAgent.search("Safari") >= 0 && navigator.userAgent.search("Chrome") < 0) {
        if (this.checked === true) {
          this.emitEventElevate(eventObj)
        }
        else {
          this.emitEventDemote(eventObj)
        }
      }
      else {
        if (this.checked === false) {
          this.emitEventElevate(eventObj)
        }
        else {
          this.emitEventDemote(eventObj)
        }
      }
    },
    momentPretty(val) {
      return val ? moment(val).format('ddd MM-DD-YYYY') : '';
    },
    yesNo: function (value) {
      return (value == true) ? 'Yes' : 'No';
    },
    titleDay: function (value) {
      return moment(value).format("ddd")
    },
    titleDate: function (value) {
      return moment(value).format("MM/DD")
    },
    titleDateLong: function (value) {
      return moment(value).format("ddd MM/DD")
    },
    hasHttp: function (value) { // Checks if links given 'http'
      return (value.substr(0, 4)) == 'http' ? value : 'https://' + value;
    }
  },
  watch: {
    priorityChanged: function (val, oldVal) {
      if (val != oldVal) {
        return true
      }
      else {
        return false
      }
    }
  }
};


</script>
