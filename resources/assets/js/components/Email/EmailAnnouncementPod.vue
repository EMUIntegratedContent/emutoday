<template>
  <div :class="specialItem">
    <div :class="liveTimeStatusClass" class="box box-solid">
      <div class="box-header with-border" >
        <div class="row">
          <div class="col-sm 12 col-md-4">
            <div class="box-date-top pull-left">{{item.start_date | titleDateLong}}</div>
          </div><!-- /.col-sm-6 -->
          <div class="col-sm 12 col-md-8">
            <label v-show="podType == 'announcementqueue'" class="pull-right"><input type="checkbox" @click="toggleEmitAnnouncement(item)" v-model="checked" :checked="isAnnouncement" /> Email Announcement</label>
            <button v-show="podType == 'announcement'" type="button" class="btn btn-sm btn-danger pull-right" @click="emitAnnouncementRemove(item)"><i class="fa fa-times" aria-hidden="true"></i></button>
          </div><!-- /.col-md-12 -->
        </div><!-- /.row -->
        <div class="row">
          <a v-on:click.prevent="toggleBody" href="#">
            <div class="col-sm-12">
              <h6 class="box-title">{{item.title}}</h6>
            </div><!-- /.col-md-12 -->
          </a>
        </div><!-- /.row -->
      </div>  <!-- /.box-header -->

    <div v-if="showBody" class="box-body">
      <p>{{item.announcement}}</p>
      <div class="announcement-info">
        Submitted On: {{item.submission_date}}<br>
        By: {{item.submitter}}<br>
        Dates: {{item.start_date}} - {{item.end_date}}
      </div>
    </div><!-- /.box-body -->
    <div class="box-footer list-footer">
      <div class="row">
        <div class="col-sm-12 col-md-9 ">
          <span :class="timeFromNowStatus">Live {{timefromNow}}</span> <span :class="timeLeftStatus">{{timeLeft}}</span>
        </div><!-- /.col-md-7 -->
        <div class="col-sm-12 col-md-3">
          <div class="btn-group pull-right">
            <a :href="itemEditPath" target="_blank" class="btn bg-orange btn-xs footer-btn" data-toggle="tooltip" title="edit"><i class="fa fa-pencil"></i></a>
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
  margin:0;
}
.box-header {
  padding: 3px;
}
button.footer-btn {
  border-color: #1B1B1B;
}
h6.box-title {
  color: #1B1B1B;
}
.zcallout {
  border-radius: 5px;
  border-left: 50px solid #ff0000;
}
form {
  display:inline-flex;
}
.form-group {
  margin-bottom: 2px;
}
#applabel{
  margin-left: 2px;
  margin-right: 2px;
  padding-left: 2px;
  padding-right: 2px;
}
.btn-group,
.btn-group-vertical {
  display:inline-flex;
}
select.form-control {
  height:22px;
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
}
.form-group label{
  margin-bottom: 0;
}
.box-footer {
  padding: 3px;
}
.box.box-solid.box-default {
  border: 1px solid #999999;
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
  border-left: 6px solid #bfff00;
  padding-left: 3px;
  border-top-left-radius:3px;
  border-bottom-left-radius: 3px;
  margin-left: -10px;
}
.special-item-last {
  margin-bottom: 30px;
}
</style>
<script>

import moment from 'moment'
import VuiFlipSwitch from '../VuiFlipSwitch.vue'

export default {
  directives: {},
  components: {VuiFlipSwitch},
  props: ['item','pid','podType','announcements'],
  data: function() {
    return {
      showBody: false,
      checked: false,
    }
  },
  created: function () {},
  ready: function() {
  },
  computed: {
    isAnnouncement: function(){
      if(this.announcements){
        for(var i = 0; i < this.announcements.length; i++) {
          if(this.announcements[i].id == this.item.id){
            this.checked = true
            return true
          }
        }
      }
      this.checked = false
      return false
    },
    specialItem: function(){
      let extrasep;
      // if (this.pid == 'items-live' && this.index === 3) {
      if (this.pid == 'items-live' && this.index < 5) {
        if(this.index === 4) {
          extrasep = 'special-item special-item-last'
        } else {
          extrasep = 'special-item'
        }

      } else {
        extrasep = ''
      }
      return extrasep;
    },
    timefromNow:function() {
      return moment(this.item.start_date).fromNow()
    },
    itemEditPath: function(){
      return '/admin/announcement/'+ this.item.id + '/edit'
    },
    liveTimeStatusClass: function(){
      let timepartstatus;
      let extrasep;
      if (moment().isBetween(this.item.start_date, this.item.end_date)){
        timepartstatus=  'ongoing';
      } else {
        if(this.timeDiffNow(this.item.start_date) < 0 ) {
          timepartstatus = 'event-negative';
        } else {
          timepartstatus = 'event-positive';
        }
      }
      if (this.pid == 'items-live' && this.index === 3) {
        extrasep = 'last-special-event'
      } else {
        extrasep = ''
      }
      return timepartstatus + ' ' + extrasep;
    },
    timeLeftStatus: function(){
      let diff = this.timeDiffNow(this.item.end_date)
      if(diff <= 0){
        return 'time-is-over'
      } else if(diff > 0 && diff <=720) {
        return 'time-is-short'
      } else {
        return 'time-is-long'
      }
    },
    timeFromNowStatus: function(){
      let diff = this.timeDiffNow(this.item.start_date)
      if(diff <= 0){
        return 'time-is-over'
      } else if(diff > 0 && diff <=720) {
        return 'time-is-short'
      } else {
        return 'time-is-long'
      }
    },
    timefromNow:function() {
      return moment(this.item.start_date).fromNow()
    },
    timeLeft: function() {
      if(moment(this.item.start_date).isSameOrBefore(moment())){
        let tlft = this.timeDiffNow(this.item.end_date, 'hours');
        if (tlft < 0) {
          return 'Event Ended ' + moment(this.item.end_date).fromNow()
        } else {
          return  ' and Ends ' + moment(this.item.end_date).fromNow()
        }
      }  else {
        return ''
      }
    },

  },
  methods: {
    timeDiffNow:function(val, mod = 'minutes'){
      return  moment(val).diff(moment(), mod);
    },
    editItem: function(ev) {
      window.location.href = this.itemEditPath;
    },
    toggleBody: function(ev) {
      if(this.showBody == false) {
        this.showBody = true;
      } else {
        this.showBody = false;
      }
    },

    emitAnnouncementAdd: function(announcementObj){
      // Dispatch an announcement that propagates upward along the parent chain using $emit()
      this.$emit('announcement-added', announcementObj)
    },
    emitAnnouncementRemove: function(announcementObj){
      // IMPORTANT: You must emit the object id as opposed to the entire object because objects loaded from Laravel will be DIFFERENT objects
      this.$emit('announcement-removed', announcementObj.id)
    },
    toggleEmitAnnouncement: function(announcementObj){
      // function will run before this.checked is switched
      if(!this.checked){
        this.emitAnnouncementAdd(announcementObj)
      } else {
        this.emitAnnouncementRemove(announcementObj)
      }
    }
  },
  watch: {
  },
  events: {},
  filters: {
    titleDateLong: function (value) {
      return  moment(value).format("ddd MM/DD")
    },
    momentPretty: {
      read: function(val) {
        return 	val ?  moment(val).format('MM-DD-YYYY') : '';
      },
      write: function(val, oldVal) {
        return moment(val).format('YYYY-MM-DD');
      }
    }
  }

};


</script>
