<template>
  <!-- <div class="box box-default box-solid"> -->
  <div :class="reviewedItem">
    <div :class="liveTimeStatusClass" class="box box-solid">
      <div class="box-header with-border">
        <div class="row">
          <div class="col-sm 12 col-md-4">
            <div class="box-date-top pull-left">{{ titleDateLong(item.start_date) }}</div>
          </div><!-- /.col-sm-6 -->
          <!-- REVIEWED switch -->
          <div class="col-sm 12 col-md-4">
            {{ item.hsc_reviewed }}
            <form class="form-inline pull-right">
              <div id="applabel" class="form-group">
                <label>reviewed:</label>
              </div><!-- /.form-group -->
              <div class="form-group">
                {{ patchRecord.hsc_reviewed }}
                <vui-flip-switch :id="'switch-'+item.id"
                                 @input="changeIsReviewed"
                                 v-model:checked="patchRecord.hsc_reviewed"
                >
                </vui-flip-switch>
              </div>
            </form>
          </div><!-- /.col-sm-6 -->

          <!-- POINTS -->
          <div class="col-sm 12 col-md-4">
            <form class="form-inline pull-right" v-on:submit.prevent="changePoints">
              <div class="form-group input-group">
                <span class="input-group-addon"><label>points:</label></span>
                <input :id="`event-points-${item.id}`" type="number" step="5" class="form-control short-input" min="0"
                       placeholder="0"
                       v-on:change.prevent="changePoints"
                       v-model="patchRecord.hsc_rewards"/>
                <span class="input-group-addon btn bg-orange" v-on:click.prevent="changePoints"><i
                    class="fa fa-save"></i></span>
              </div>
            </form>
          </div><!-- /.col-sm-6 -->
        </div><!-- /.row -->

        <div class="row">
          <a v-on:click.prevent="toggleBody" href="#">
            <div class="col-sm-12">
              <h6 class="box-title">{{ item.title }}</h6>
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
          <p v-if="item.short_title">Short-title: {{ item.shor_title }}</p>
          <p>Description: {{ item.description }}</p>
          <hr/>
          <p>Location: {{ item.location }}</p>
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
          <p v-else>Cost: {{ item.cost }}</p>
          <p>Participation: {{ eventParticipation }}</p>
          <template v-if="item.tickets">
            <p v-if="item.ticket_details_online">For Tickets Visit: <a
                :href="hasHttp(item.ticket_details_online)">{{ item.ticket_details_online }}</a></p>
            <p v-if="item.ticket_details_phone">For Tickets Call: {{ item.ticket_details_phone }}</p>
            <p v-if="item.ticket_details_office">For Tickets Office: {{ item.ticket_details_office }}</p>
            <p v-if="item.ticket_details_other">Or: {{ item.ticket_details_other }}</p>
          </template>
          <hr/>
          <p>Submitted by: {{ item.submitter }}</p>
          <p>LBC Approved: {{ yesNo(item.lbc_approved) }}</p>
          <p>LBC Reviewed: {{ yesNo(item.lbc_reviewed) }}</p>
          <p>Eagle Rewards: {{ item.hsc_rewards }}</p>
        </div>
      </div><!-- /.box-body -->
      <div class="box-footer list-footer">
        <div class="row">
          <div class="col-sm-12 col-md-9">
            <!-- <span>Start {{item.start_date_time}}</span> <span>End {{item.end_date_time}}</span> -->
            <span v-if="itemCurrent" :class="timeFromNowStatus">Live {{ timefromNow }}</span> <span
              :class="timeLeftStatus">{{ timeLeft }}</span>
          </div><!-- /.col-md-7 -->
          <div class="col-sm-12 col-md-3">
            {{ item.id }}
            <div class="btn-group pull-right">
              <!-- <button v-on:click.prevent="previewItem" class="btn bg-orange btn-xs footer-btn"><i class="fa fa-eye"></i></button> -->
            </div><!-- /.btn-toolbar -->
          </div><!-- /.col-md-7 -->
        </div><!-- /.row -->
      </div><!-- /.box-footer -->
    </div><!-- /.box- -->
  </div>
</template>
<style scoped>
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
  display: inline-flex;
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

.reviewed-item {
  border-left: 6px solid #605CA8;
  padding-left: 2px;
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

.short-input {
  width: 8rem;
  max-width: 8rem;
}
</style>
<script>
import moment from 'moment'
import VuiFlipSwitch from './VuiFlipSwitch.vue'

export default {
  components: {VuiFlipSwitch},
  props: ['item', 'pid', 'index'],
  data: function () {
    return {
      hasPriorityChanged: 0,
      formInputs: {
        event_id: '',
        attachment: ''
      },
      showBody: false,
      showPanel: false,
      patchRecord: {
        hsc_rewards: 0,
        hsc_reviewed: 0,
      },
      itemCurrent: 1,
      currentDate: {},
      record: {}
    }
  },
  created () {
    this.patchRecord.hsc_rewards = this.item.hsc_rewards;
    this.patchRecord.hsc_reviewed = this.item.hsc_reviewed;
  },
  computed: {
    timeLeftStatus: function () {
      let diff = this.timeDiffNow(this.item.end_date_time)
      if (diff <= 0) {
        return 'time-is-over'
      } else if (diff > 0 && diff <= 720) {
        return 'time-is-short'
      } else {
        return 'time-is-long'
      }
    },
    timeFromNowStatus: function () {
      let diff = this.timeDiffNow(this.item.start_date_time)
      if (diff <= 0) {
        return 'time-is-over'
      } else if (diff > 0 && diff <= 720) {
        return 'time-is-short'
      } else {
        return 'time-is-long'
      }
    },
    timefromNow: function () {
      return moment(this.item.start_date_time).fromNow()
    },
    timeLeft: function () {

      if (moment(this.item.start_date_time).isSameOrBefore(moment())) {
        let tlft = this.timeDiffNow(this.item.end_date_time);
        // console.log('id='+ this.item.id + ' timeLeft'+tlft)
        if (tlft < 0) {
          this.itemCurrent = 0;
          return 'Event Ended ' + moment(this.item.end_date_time).fromNow()
        } else {
          this.itemCurrent = 1;
          return ' and Ends ' + moment(this.item.end_date_time).fromNow()
        }

      } else {
        return ''
      }


    },
    reviewedItem: function () { // css class
      return this.patchRecord.hsc_reviewed ? 'reviewed-item' : '';
    },
    liveTimeStatusClass: function () {
      let timepartstatus;

      if (moment().isBetween(this.item.start_date_time, this.item.end_date_time)) {
        timepartstatus = 'ongoing';
      } else {
        if (this.timeDiffNow(this.item.start_date_time) < 0) {
          timepartstatus = 'event-negative';
        } else {
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
    isApproved: function () {
      return this.item.hsc_rewards;
    },
    isReviewed: function () {
      return this.item.hsc_reviewed;
    },
    itemPreviewPath: function () {
      return '/preview/event/' + this.item.id
    },


  },
  methods: {
    // Handle the form submission here
    timeDiffNow: function (val) {
      return moment(val).diff(moment(), 'minutes');
    },
    changeIsReviewed: function () {
      this.updateItem();
    },
    changePoints: function () {
      this.item.hsc_reviewed = this.patchRecord.hsc_reviewed = 1;
      this.updateItem();
    },
    updateItem: function () {
      this.$http.patch('/api/event/updateitem/' + this.item.id, this.patchRecord, {
        method: 'PATCH'
      })
          .then((response) => {
            this.item.hsc_rewards = response.data.newdata.hsc_rewards;
            this.item.hsc_reviewed = response.data.newdata.hsc_reviewed;
            this.$emit("item-updated", this.item)
          }).catch((e) => {})
    },
    togglePanel: function (ev) {
      if (this.showPanel === false) {
        this.showPanel = true;
      } else {
        this.showPanel = false;
      }
    },
    toggleBody: function (ev) {
      if (this.showBody == false) {
        this.showBody = true;
      } else {
        this.showBody = false;
      }
    },
    doThis: function (ev) {
      this.item.hsc_rewards = (this.hsc_rewards === 0) ? 1 : 0;
      this.$emit('item-change', this.item);
    },
    yesNo: function(value) {
      return (value == true) ? 'Yes' : 'No';
    },
    titleDay: function (value) {
      return  moment(value).format("ddd")
    },
    titleDate: function (value) {
      return  moment(value).format("MM/DD")
    },
    titleDateLong: function (value) {
      return  moment(value).format("ddd MM/DD")
    },
    hasHttp: function(value) { // Checks if links given 'http'
      return (value.substr(0, 4)) == 'http' ? value : 'https://'+value;
    },
    momentPretty: function(value) {
      return moment(value).format('ddd, MM-DD-YYYY')
    }
  },
  watch: {}
};


</script>
