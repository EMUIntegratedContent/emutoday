<template>
  <div :class="specialItem">
    <div :class="liveTimeStatusClass" class="box box-solid">
      <div class="box-header with-border" >
        <div class="row">
          <div class="col-sm 12 col-md-4">
            <div class="box-date-top pull-left">{{ titleDateLong(item.start_date) }}</div>
          </div><!-- /.col-sm-6 -->
          <div class="col-sm 12 col-md-8">
            <form class="form-inline pull-right">
              <template v-if="pid == 'items-live'">
                <div class="form-check">
                  <label class="form-check-label">
                    Elevate
                    <input type="checkbox" class="form-check-input" @click="toggleEmitAnnouncementElevate(item)" v-model="checked" :checked="isElevatedAnnouncement" /> |
                  </label>
                </div>
              </template>
              <template v-if="pid != 'item-elevated'">
                <div id="applabel" class="form-group ">
                  <label>  approved:</label>
                </div><!-- /.form-group -->
                <div class="form-group">
                  <vui-flip-switch
                      v-model="patchRecord.is_approved"
                      :switch-id="'switch-'+item.id"
                      @update:modelValue="changeIsApproved"
                  >
                  </vui-flip-switch>
                </div>
              </template>
              <template v-if="pid == 'item-elevated'">
                  <label v-if="atype == 'general'"><input type="checkbox" @click="toggleEmitSpecialAnnouncement(item)" v-model="checked" :disabled="item.priority != 1000000 && isSpecialAnnouncementPresent" />  Special</label>
                  <button type="button" class="btn btn-sm btn-danger pull-right remove-announcement-btn" @click="emitAnnouncementDemote(item)"><i class="fa fa-times" aria-hidden="true"></i></button>
              </template>
          </form>
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
            <button v-on:click.prevent="editItem" class="btn bg-orange btn-xs footer-btn" data-toggle="tooltip" data-placement="top" title="edit"><i class="fa fa-pencil"></i></button>
            <button v-on:click.prevent="archiveItem" class="btn bg-orange btn-xs footer-btn" data-toggle="tooltip" data-placement="top" title="archive"><i class="fa fa-archive"></i></button>
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
  /*margin: 0 0 20px 0;*/
  /*padding: 15px 30px 15px 15px;*/
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
  /*border: 1px solid red;*/
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
  border-left: 6px solid #bfff00;

  padding-left: 3px;
  border-top-left-radius:3px;
  border-bottom-left-radius: 3px;
  margin-left: -10px;

}
.special-item-last {
  margin-bottom: 30px;
}
.remove-announcement-btn{
  margin-left: 10px;
}
</style>
<script>

import moment from 'moment'
import VuiFlipSwitch from './VuiFlipSwitch.vue'

export default{
  components: {VuiFlipSwitch},
  props: ['item','pid','index','elevatedAnnouncements','atype'],
  data: function() {
    return {
      checked: false,
      showBody: false,
      patchRecord: {
        is_approved: 0,
        priority: 0,
        is_archived: 0,
      },
      itemCopy: null
    }
  },
  created () {
    this.itemCopy = JSON.parse(JSON.stringify(this.item))
    this.patchRecord.is_approved = this.itemCopy.is_approved
    this.patchRecord.priority = this.itemCopy.priority
    this.patchRecord.is_archived = this.itemCopy.is_archived
    if(this.pid == 'item-elevated' && this.itemCopy.priority == 1000000) {
      this.checked = true
    }
  },
  computed: {
    isSpecialAnnouncementPresent: function(){
      if(this.elevatedAnnouncements){
        for(let i = 0; i < this.elevatedAnnouncements.length; i++){
          if(this.elevatedAnnouncements[i].priority == 1000000){
            return true;
          }
        }
      }
      return false;
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
    isApproved: function() {
      return this.itemCopy.is_approved;
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
    isElevatedAnnouncement: function(){
      if(this.elevatedAnnouncements){
        for(let i = 0; i < this.elevatedAnnouncements.length; i++) {
          if(this.elevatedAnnouncements[i].id == this.item.id){
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
    timeDiffNow:function(val, mod = 'minutes'){
      return  moment(val).diff(moment(), mod);
    },
    editItem: function(ev) {
      window.location.href = this.itemEditPath;
    },
    previewItem: function(ev) {
      window.location.href = this.itemPreviewPath;
    },
    toggleBody: function(ev) {
      if(this.showBody == false) {
        this.showBody = true;
      } else {
        this.showBody = false;
      }
    },
    changeIsApproved: function(){
      // this.patchRecord.is_approved = (this.item.is_approved === 0)?1:0;
      this.updateItem();
    },
    archiveItem:function(){
      this.patchRecord.is_archived = 1;

      this.$http.patch('/api/announcement/archiveitem/' + this.item.id , this.patchRecord , {
        method: 'PATCH'
      } )
      .then((response) => {
        this.checkAfterUpdate(response.data.newdata)
      }).catch((e) => {
        console.log(e)
      })
    },
    updateItem: function(){
      this.patchRecord.is_archived = this.item.is_archived;

      this.$http.patch('/api/announcement/updateitem/' + this.itemCopy.id , this.patchRecord , {
        method: 'PATCH'
      } )
      .then((response) => {
        this.checkAfterUpdate(response.data.newdata)
        this.$emit('item-change', this.itemCopy)
      }).catch((e) => {
        console.log(e)
      })
    },
    checkAfterUpdate: function(ndata){
      this.patchRecord.is_approved = this.itemCopy.is_approved = ndata.is_approved
      this.patchRecord.priority = this.itemCopy.priority = ndata.priority
      this.patchRecord.is_archived = this.itemCopy.is_archived = ndata.is_archived

      // Unapproved announcements lose priority status
      if(!this.patchRecord.is_approved){
        this.emitAnnouncementDemote(this.itemCopy)
      }
    },
    emitAnnouncementElevate: function(announcementObj){
      this.$emit('announcement-elevated', announcementObj)
    },
    emitAnnouncementDemote: function(announcementObj){
      // IMPORTANT: You must emit the object id as opposed to the entire object because objects loaded from Laravel will be DIFFERENT objects
      this.$emit('announcement-demoted', announcementObj.id)
    },
    toggleEmitAnnouncementElevate: function(announcementObj){
      // function will run before this.checked is switched

      //Check if browser is Safari. Safari treats the true/false nature of checkboxes differently than chrome and firefox
      // https://www.learningjquery.com/2017/05/how-to-use-javascript-to-detect-browser
      if (navigator.userAgent.search("Safari") >= 0 && navigator.userAgent.search("Chrome") < 0) {
        if(this.checked === true){
          this.emitAnnouncementElevate(announcementObj)
        } else {
          this.emitAnnouncementDemote(announcementObj)
        }
      } else {
        if(this.checked === false){
          this.emitAnnouncementElevate(announcementObj)
        } else {
          this.emitAnnouncementDemote(announcementObj)
        }
      }
    },
    emitSpecialAnnouncementAdd: function(announcementObj){
      // Dispatch an event that propagates upward along the parent chain using $dispatch()
      this.$emit('special-announcement-added', announcementObj)
    },
    emitSpecialAnnouncementRemove: function(announcementObj){
      // Dispatch an event that propagates upward along the parent chain using $dispatch()
      this.$emit('special-announcement-removed', announcementObj)
    },
    toggleEmitSpecialAnnouncement: function(announcementObj){
      // function will run before this.checked is switched

      //Check if browser is Safari. Safari treats the true/false nature of checkboxes differently than chrome and firefox
      // https://www.learningjquery.com/2017/05/how-to-use-javascript-to-detect-browser
      if (navigator.userAgent.search("Safari") >= 0 && navigator.userAgent.search("Chrome") < 0) {
        if(this.checked === true){
          this.emitSpecialAnnouncementAdd(announcementObj)
        } else {
          this.emitSpecialAnnouncementRemove(announcementObj)
        }
      } else {
        if(this.checked === false){
          this.emitSpecialAnnouncementAdd(announcementObj)
        } else {
          this.emitSpecialAnnouncementRemove(announcementObj)
        }
      }
    },
    titleDateLong: function (value) {
      return  moment(value).format("ddd MM/DD")
    },
    momentPretty: function(value) {
      return moment(value).format('ddd, MM-DD-YYYY')
    }
  },
  watch: {
    item () {
      this.itemCopy = JSON.parse(JSON.stringify(this.item))
      this.patchRecord.is_approved = this.itemCopy.is_approved
      this.patchRecord.priority = this.itemCopy.priority
      this.patchRecord.is_archived = this.itemCopy.is_archived
    }
  }
};


</script>
