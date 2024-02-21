<template>
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
            <label v-if="podType == 'eventqueue'" class="pull-right"><input type="checkbox" @click="toggleEvent(item)"
                                                                              v-model="checked" :checked="isEvent"/>
              Email Event</label>
            <button v-if="podType == 'event'" type="button" class="btn btn-sm btn-danger pull-right"
                    @click="removeEvent(item.id)"><i class="fa fa-times" aria-hidden="true"></i></button>
          </div><!-- /.col-sm-6 -->
        </div><!-- /.row -->
        <div class="row">
          <a v-on:click.prevent="toggleBody" href="#">
            <div class="col-sm-12">
              <h6 class="box-title">{{ item.title }}</h6><span class="event-cancel"
                                                               v-if="item.is_canceled"> - canceled</span>
            </div><!-- /.col-md-12 -->
          </a>
        </div><!-- /.row -->
      </div>  <!-- /.box-header -->
      <div v-if="showBody" class="box-body">
        <p>From: {{ momentPretty(item.start_date) }}, {{ item.start_time }} To: {{ momentPretty(item.end_date) }},
          {{ item.end_time }}</p>
        <template v-if="item.all_day">
          <p>All Day Event</p>
        </template>
        <hr/>
        <div class="item-info">
          <p>Title: {{ item.title }}</p>
          <p v-if="item.short_title">Short-title: {{ item.short_title }}</p>
          <p>Description: {{ item.description }}</p>
          <template v-if="isOnCampus">
            <p>Location: <a :href="'http://emich.edu/maps/?building='+ item.building"
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
            <p v-if="item.ticket_details_online">For Tickets Visit: <a
                :href="hasHttp(item.ticket_details_online)">{{ item.ticket_details_online }}</a></p>
            <p v-if="item.ticket_details_phone">For Tickets Call: {{ item.ticket_details_phone }}</p>
            <p v-if="item.ticket_details_office">For Tickets Office: {{ item.ticket_details_office }}</p>
            <p v-if="item.ticket_details_other">Or: {{ item.ticket_details_other }}</p>
          </template>
          <hr/>
          <p>LBC Approved: {{ item.lbc_approved == 1 ? 'Yes' : 'No' }}</p>
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
            <div class="btn-group pull-right">
              <a :href="itemEditPath" target="_blank" class="btn bg-orange btn-xs footer-btn" data-toggle="tooltip"
                 title="edit"><i class="fa fa-pencil"></i></a>
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
</style>
<script>
import { emailMixin } from './email_mixin'
import moment from 'moment'

export default {
  components: { },
  mixins: [emailMixin],
  props: ['item', 'pid', 'podType'],
  data: function () {
    return {
      showBody: false,
      showPanel: false,
      itemCurrent: 1,
      checked: false,
    }
  },
  computed: {
    isEvent: function () {
      if (this.emailBuilderEmail.events) {
        for (let i = 0; i < this.emailBuilderEmail.events.length; i++) {
          if (this.emailBuilderEmail.events[i].id == this.item.id) {
            this.checked = true
            return true
          }
        }
      }
      this.checked = false
      return false
    },
    addSeperator: function () {
      let asclass = 'box-footer-normal';
      if (this.pid == 'items-live' && this.index == 3) {
        asclass = 'box-footer-last-special';
      }
      return asclass;
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
    promotedIcon: function () {
      let pIcon = ''
      if (this.item.is_promoted === 1) {
        pIcon = 'fa fa fa-star'
      }
      return pIcon
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
        case 'public':
          return 'Open to Public'
        case 'students':
          return 'Students Only'
        case 'employees':
          return 'Employees Only'
        case 'invite':
          return 'Invitation Only'
        case 'tickets':
          return 'Tickets Required'
        default:
          return ''
      }
    }
  },
  methods: {
    currency (amount) {
      if (isNaN(amount)) {
        return amount
      }
      return '$' + parseFloat(amount).toFixed(2)
    },
    momentPretty (datetime) {
      return moment(datetime).format('ddd, MM-DD-YYYY')
    },
    // Handle the form submission here
    timeDiffNow: function (val) {
      return moment(val).diff(moment(), 'minutes');
    },
    editItem: function (ev) {
      window.location.href = this.itemEditPath;
    },
    priorityChange (event) {
    },
    getFileName () {
      var files = this.$els.eventimg.files;
      this.eventimage = this.$els.eventimg.files[0].name;
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
    toggleEvent: function (eventObj) {
      // function will run before this.checked is switched
      if (!this.checked) {
        this.addEvent(eventObj)
      }
      else {
        this.removeEvent(eventObj.id)
      }
    },
    hasHttp: function (value) { // Checks if links given 'http'
      return (value.substr(0, 4)) == 'http' ? value : 'https://' + value;
    },
    titleDateLong: function (value) {
      return moment(value).format("ddd MM/DD")
    }
  }
};


</script>
