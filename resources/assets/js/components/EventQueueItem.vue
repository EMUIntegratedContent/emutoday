<template>

  <!-- <div class="box box-default box-solid"> -->
  <div :class="specialItem">

    <div :class="liveTimeStatusClass" class="box box-solid">

      <div class="box-header with-border">
        <div class="row">
          <div class="col-sm 12 col-md-4">
            <div class="box-date-top pull-left">{{item.start_date | titleDateLong}}</div>
            <div class="pull-right">
              <label data-toggle="tooltip" data-placement="top" title="Promoted"><span class="item-promoted-icon" :class="promotedIcon"></span></label>
            </div><!-- /.pull-right -->
          </div><!-- /.col-sm-6 -->
          <div class="col-sm 12 col-md-8">
            <form class="form-inline pull-right">
              <div class="form-group">
                <button v-if="hasPriorityChanged" @click.prevent="updateItem" class="btn footer-btn bg-orange btn-xs" href="#"><span class="fa fa-floppy-o"></span></button>
              </div><!-- /.form-group -->
              <div title="Display order for Eastern's index page" class="form-group"> <!-- For the HOME page. -->
                <label for="home-priority-number" class="priority">Home:</label>
                <select id="home-priority-{{item.id}}" v-model="patchRecord.home_priority" @change="priorityChange($event)" number>
                  <option v-for="option in options" v-bind:value="option.value">
                    {{option.text}}
                  </option>
                </select>
              </div>&nbsp;&nbsp;&nbsp;

              <div title="Display order for News Hub" class="form-group"> <!-- For the NEWS HUB page. -->
                <label for="priority-number" class="priority">Today:</label>
                <select id="priority-{{item.id}}" v-model="patchRecord.priority" @change="priorityChange($event)" number>
                  <option v-for="option in options" v-bind:value="option.value">
                    {{option.text}}
                  </option>
                </select>
              </div>

              <div id="applabel" class="form-group">
                <label>Approved:&nbsp;</label>
              </div><!-- /.form-group -->
              <div class="form-group">
                <vui-flip-switch id="switch-{{item.id}}"
                v-on:click.prevent="changeIsApproved"
                :value.sync="patchRecord.is_approved" >
              </vui-flip-switch>
            </div>
          </form>
        </div><!-- /.col-sm-6 -->
      </div><!-- /.row -->

      <div class="row">
        <a v-on:click.prevent="toggleBody" href="#">
          <div class="col-sm-12">
            <h6 class="box-title">{{item.title}}</h6><span class="event-cancel" v-if="item.is_canceled"> - canceled</span></h6>
          </div><!-- /.col-md-12 -->
        </a>
      </div><!-- /.row -->
    </div>  <!-- /.box-header -->

    <div v-if="showBody" class="box-body">
    <!-- <div class="box-body"> -->
      <template v-if="canHaveImage">
        <img v-if="hasEventImage" :src="imageUrl" />
        <a v-on:click.prevent="togglePanel" class="btn btn-info btn-sm" href="#">{{hasEventImage ? 'Change Image' : 'Promote Event'}}</a>

        <div v-show="showPanel">
        <!-- <div class="panel"> -->
          <form id="form-mediafile-upload{{item.id}}" @submit.prevent="addMediaFile" class="m-t" role="form" action="/api/event/addMediaFile/{{item.id}}"  enctype="multipart/form-data" files="true">
            <input name="eventid" class="hidden" type="input" value="{{item.id}}" v-model="formInputs.event_id">
            <div class="fa fa-photo btn btn-info btn-sm block m-b file-upload">
              <input v-el:eventimg type="file" @change="getFileName" class="file-input" name="eventimg" id="eventimg">
            </div>
            <button v-if="eventimage" id="btn-mediafile-upload" type="submit" class="fa fa-floppy-o btn btn-sm bg-orange block m-b"></button>
            <span class="file-input-helpertext" id="file-name">{{eventimage}}</span>
          </form>
          <form v-if="hasEventImage" id="form-mediafile-remove{{item.id}}" @submit.prevent="removeMediaFile" class="m-t" role="form" action="/api/event/removeMediaFile/{{item.id}}">
            <input name="eventid" class="hidden" type="input" value="{{item.id}}" v-model="formInputs.event_id">
            <button id="btn-mediafile-remove" type="submit" class="fa fa-eraser btn btn-sm btn-danger block m-b"></button>
          </form>
        </div><!-- /.panel mediaform -->

        <hr/>
      </template>

      <p>From: {{item.start_date | momentPretty}}, {{item.start_time}} To: {{item.end_date | momentPretty}}, {{item.end_time}}</p>
      <template v-if="item.all_day">
        <p>All Day Event</p>
      </template>
      <hr/>
      <div class="item-info">
        <p>Title: {{item.title}}</p>
        <p v-if"item.short_title">Short-title: {{item.shor_title}}</p>
        <p>Description: {{item.description}}</p>
        <template v-if="isOnCampus">
          <p>Location: <a href="http://emich.edu/maps/?building={{item.building}}" target="_blank">{{item.location}}</a></p>
        </template>
        <hr/>
        <template v-else>
          <p>Location: {{item.location}}</p>
        </template>
        <template v-if="item.contact_person || item.contact_person || item.contact_person">
          <p>Contact:</p>
          <ul>
            <li v-if="item.contact_person">Person: {{item.contact_person}}</li>
            <li v-if="item.contact_email">Email: {{item.contact_email}}</li>
            <li v-if="item.contact_phone">Phone: {{item.contact_phone}}</li>
          </ul>
        </template>
        <template v-if="item.related_link_1">
          <p>Additional Information: (related links) </p>
          <ul>
            <li><a href="{{item.related_link_1}}" target="_blank">
              <template v-if="item.related_link_1_txt">{{item.related_link_1_txt}}</template>
              <template v-else>{{item.related_link_1}}</template>
            </a></li>
            <li v-if="item.related_link_2"><a href="{{item.related_link_2}}" target="_blank">
              <template v-if="item.related_link_2_txt">{{item.related_link_2_txt}}</template>
              <template v-else>{{item.related_link_2}}</template>
            </a></li>
            <li v-if="item.related_link_3"><a href="{{item.related_link_3}}" target="_blank">
              <template v-if="item.related_link_3_txt">{{item.related_link_3_txt}}</template>
              <template v-else>{{item.related_link_3}}</template>
            </a></li>
          </ul>
        </template>
        <hr/>
        <p v-if="item.free">Cost: Free</p>
        <p v-else>Cost: {{item.cost | currency }}</p>
        <p>Participantion: {{eventParticipation}}</p>
        <template v-if="item.tickets">
          <p v-if="item.ticket_details_online">For Tickets Visit: {{item.ticket_details_online}}</p>
          <p v-if="item.ticket_details_phone">For Tickets Call: {{item.ticket_details_phone}}</p>
          <p v-if="item.ticket_details_office">For Tickets Office: {{item.ticket_details_office}}</p>
          <p v-if="item.ticket_details_other">Or: {{item.ticket_details_other}}</p>
        </template>
        <hr/>
        <p>LBC Approved: {{item.lbc_approved | yesNo }}</p>
        <hr/>
        <p>Submitted by: {{item.submitter}}</p>
      </div>
    </div><!-- /.box-body -->


    <div :class="addSeperator" class="box-footer list-footer">
      <div class="row">
        <div class="col-sm-12 col-md-9">
          <!-- <span>Start {{item.start_date_time}}</span> <span>End {{item.end_date_time}}</span> -->

          <span v-if="itemCurrent" :class="timeFromNowStatus">Live {{timefromNow}}</span> <span :class="timeLeftStatus">{{timeLeft}}</span>



        </div><!-- /.col-md-7 -->
        <div class="col-sm-12 col-md-3">
          {{item.id}}
          <div class="btn-group pull-right">

            <button v-on:click.prevent="editItem" class="btn bg-orange btn-xs footer-btn"><i class="fa fa-pencil"></i></button>
            <!-- <button v-on:click.prevent="previewItem" class="btn bg-orange btn-xs footer-btn"><i class="fa fa-eye"></i></button> -->
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
  display:inline-block;
  margin-top: 1rem;
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
  border-top-left-radius:3px;
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
  /*border-bottom: 6px solid #bfff00;
  border-bottom-right-radius:3px;
  border-bottom-left-radius: 3px;*/
  margin-bottom: 30px;
}
/*.box.box-solid.box-default {
border: 1px solid #999999;
}
.box-body {
padding: 3px 6px;
}*/
</style>
<script>
import moment from 'moment'
import VuiFlipSwitch from './VuiFlipSwitch.vue'
module.exports  = {
  components: {VuiFlipSwitch},
  props: ['item','pid','index'],
  data: function() {
    return {
      eventimage: '',
      hasPriorityChanged:0,
      options: [
        { text: '0', value: 0 },
        { text: '1', value: 1 },
        { text: '2', value: 2 },
        { text: '3', value: 3 },
        { text: '4', value: 4 },
        { text: '5', value: 5 },
        { text: '6', value: 6 },
        { text: '7', value: 7 },
        { text: '8', value: 8 },
        { text: '9', value: 9 },
        { text: '10', value: 10 },
        { text: '99', value: 99 }
      ],
      formInputs: {
        event_id: '',
        attachment: ''

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
      itemCurrent: 1,
      currentDate: {},
      record: {
      }
    }
  },
  created: function () {
    // this.is_approved = this.item.approved;
    // this.currentDate = moment();
    // console.log('this.currentDate=' + this.currentDate)
  },
  ready: function() {
    this.initRecord.is_approved = this.patchRecord.is_approved =  this.item.is_approved;
    this.initRecord.priority = this.patchRecord.priority = this.item.priority;
    this.initRecord.home_priority = this.patchRecord.home_priority = this.item.home_priority;
    this.initRecord.is_canceled = this.patchRecord.is_canceled = this.item.is_canceled;
    this.initRecord.eventimage = this.eventimage = this.patchRecord.eventimage = this.item.eventimage;
  },
  computed: {
    addSeperator: function(){
      let asclass = 'box-footer-normal';
      if(this.pid == 'items-live' && this.index == 3) {
        asclass = 'box-footer-last-special';
      }
      return asclass;
    },
    hasPriorityChanged: function(){
      if (this.initRecord.home_priority != this.patchRecord.home_priority || this.initRecord.priority != this.patchRecord.priority){
        return true
      } else {
        return false
      }
    },
    hasIsApprovedChanged: function(){
      if (this.initRecord.is_approved != this.patchRecord.is_approved){
        console.log('is_approved => initRecord='+ this.initRecord.is_approved  + ' patchRecord=>' +this.patchRecord.is_approved );
        return true
      } else {
        return false
      }
    },
    timeLeftStatus: function(){
      let diff = this.timeDiffNow(this.item.end_date_time)
      if(diff <= 0){
        return 'time-is-over'
      } else if(diff > 0 && diff <=720) {
        return 'time-is-short'
      } else {
        return 'time-is-long'
      }


    },

    timeFromNowStatus: function(){
      let diff = this.timeDiffNow(this.item.start_date_time)
      if(diff <= 0){
        return 'time-is-over'
      } else if(diff > 0 && diff <=720) {
        return 'time-is-short'
      } else {
        return 'time-is-long'
      }
    },
    timefromNow:function() {
      return moment(this.item.start_date_time).fromNow()
    },
    timeLeft: function() {

      if(moment(this.item.start_date_time).isSameOrBefore(moment())){
        let tlft = this.timeDiffNow(this.item.end_date_time);
        console.log('id='+ this.item.id + ' timeLeft'+tlft)
        if (tlft < 0) {
          this.itemCurrent = 0;
          return 'Event Ended ' + moment(this.item.end_date_time).fromNow()
        } else {
          this.itemCurrent = 1;
          return  ' and Ends ' + moment(this.item.end_date_time).fromNow()
        }

      }  else {
        return ''
      }


    },
    specialItem: function(){
      let extrasep;

      if (this.pid == 'items-live' && this.index < 9) {
        if (this.item.home_priority > 0 && this.item.priority > 0){
          extrasep = 'special-item special-item-both';
        } else if ((this.item.home_priority > 0 && this.item.priority == 0)){
          extrasep = 'special-item special-item-home';
        } else if ((this.item.home_priority == 0 && this.item.priority > 0)){
          extrasep = 'special-item special-item-today';
        }

      } else {
        extrasep = ''
      }
      return extrasep;
    },
    liveTimeStatusClass: function(){
      let timepartstatus;

      if (moment().isBetween(this.item.start_date_time, this.item.end_date_time)){
        timepartstatus=  'ongoing';
      } else {
        if(this.timeDiffNow(this.item.start_date_time) < 0 ) {
          timepartstatus = 'event-negative';
        } else {
          timepartstatus = 'event-positive';

        }

      }

      return timepartstatus;


    },
    itemStatus : function() {
      let sclass = 'box-default';

      // console.log('pid' + this.pid + ' index='+ this.index);
      if (this.pid == 'items-live'){
        if(this.index < 4){
          console.log('topitems');
          sclass = 'topitems';
        }
      }
      // if (this.item.is_promoted === 1){
      //     pclass =  'is-promoted'
      //   } else {
      //      pclass = 'box-default'
      //   }
      return sclass;

    },
    promotedIcon: function() {
      if (this.item.is_promoted === 1){
        pIcon = 'fa fa fa-star'
      } else {
        pIcon = ''
      }
      return pIcon
    },
    hasEventImage:function() {
      if(this.item.eventimage){
        return true;
      } else {
        return false;
      }

    },
    canHaveImage:function() {
      if(this.item.is_approved){
        return true;
      } else {
        return false;
      }

    },
    imageUrl:function() {
      var pth = "/imagecache/smallthumb/";
      var fname = this.item.eventimage;
      console.log(pth + fname)
      return pth + fname;
    },

    isApproved: function() {
      return this.item.is_approved;
    },
    itemEditPath: function(){
      return '/admin/event/'+ this.item.id + '/edit'
    },
    itemPreviewPath: function(){
      return '/preview/event/'+ this.item.id
    },
    isOnCampus:function(){
      if(this.item.building === null || this.item.building === "undefined"){
        return false
      } else {
        return true
      }
    },
    eventParticipation:function(){
      switch (this.item.participants){
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
    }
  },
  methods:{
    // We will call this event each time the file upload input changes. This will push the data to our data property above so we can use the data on form submission.
    // onFileChange(event) {
    //     var files = this.$els.eventimg.files;
    //     console.log("onFileChange" + files + "firstFile="+ files[0].name);
    //     this.formInputs.attachment = event.target.file;
    // },
    // Handle the form submission here
    timeDiffNow:function(val){
      return  moment(val).diff(moment(), 'minutes');

    },
    changeIsApproved: function(){
      this.patchRecord.is_approved = (this.item.is_approved === 0)?1:0;
      console.log('this.patchRecord.is_approved ='+this.patchRecord.is_approved );
      this.updateItem();

    },
    editItem: function(ev) {
      window.location.href = this.itemEditPath;
    },
    priorityChange(event){
      console.log('priority=' + this.item.priority)
    },
    getFileName(){
      var files = this.$els.eventimg.files;
      this.eventimage = this.$els.eventimg.files[0].name;
      console.log(this.eventimage);
    },
    addMediaFile(event) {
      event.preventDefault();
      event.stopPropagation();
      var files = this.$els.eventimg.files;
      var data = new FormData();
      data.append('event_id', this.formInputs.event_id);

      data.append('eventimg', files[0]);
      var action = '/api/event/addMediaFile/'+ this.formInputs.event_id;
      this.$http.post(action, data)
      .then((response) => {
        console.log('good?'+ JSON.stringify(response))
        this.checkAfterUpdate(response.data.newdata)
      }, (response) => {
        console.log('bad?'+ response)
      });
    },
    removeMediaFile(event) {
      event.preventDefault();
      event.stopPropagation();
      var data = new FormData();
      data.append('event_id', this.formInputs.event_id);
      var action = '/api/event/removeMediaFile/'+ this.formInputs.event_id;
      this.$http.post(action, data)
      .then((response) => {
        // console.log('good?'+ JSON.stringify(response))
        this.checkAfterUpdate(response.data.newdata)
      }, (response) => {
        console.log('bad?'+ JSON.stringify(response))
      });
    },
    updateItem: function(){
      //    this.patchRecord.is_approved = this.item.is_approved;
      //    this.patchRecord.priority = this.item.priority;

      this.patchRecord.is_canceled = this.item.is_canceled;

      $("#automail").prop('checked') == true ? this.patchRecord.automail = true : this.patchRecord.automail = false;

      console.log(">::patchRecord::< "+JSON.stringify(this.patchRecord));
      this.$http.patch('/api/event/updateitem/' + this.item.id , this.patchRecord , {
        method: 'PATCH'
      } )
      .then((response) => {
        console.log('good?'+ response)
        this.checkAfterUpdate(response.data.newdata)

      }, (response) => {
        console.log('bad?'+ response)
      });
    },
    checkAfterUpdate: function(ndata){
      this.item.is_approved = this.initRecord.is_approved =   ndata.is_approved;
      this.item.is_promoted = this.initRecord.is_promoted =   ndata.is_promoted;
      this.item.priority = this.initRecord.priority =  ndata.priority;
      this.item.home_priority = this.initRecord.home_priority =  ndata.home_priority;
      this.item.is_canceled = this.initRecord.is_canceled = ndata.is_canceled;
      this.item.eventimage = this.eventimage = this.initRecord.eventimage = ndata.eventimage;
      this.hasPriorityChanged = 0;

      console.log(ndata);
    },

    togglePanel: function(ev) {
      if(this.showPanel === false) {
        this.showPanel = true;
      } else {
        this.showPanel = false;
      }
      console.log('this.showPanel' + this.showPanel)
    },
    toggleBody: function(ev) {
      if(this.showBody == false) {
        this.showBody = true;
      } else {
        this.showBody = false;
      }
      console.log('toggleBody' + this.showBody)
    },
    doThis: function(ev) {
      this.item.is_approved = (this.is_approved === 0)?1:0;
      this.$emit('item-change',this.item);
      //console.log('ev ' + ev + 'this.item.id= '+  this.item.priority)
    },
    // addMediaFile: function(ev) {
    //     var formData = new FormData();
    //     formData.append('image', fileInput ,this.$els.finput.files[0]);
    //
    //     // var fileinputObject = this.$els.finput;
    //     // console.log('fileinputObject.name= '+ fileinputObject.name)
    //     // console.log('fileinputObject.value= '+ fileinputObject.value)
    //     // console.log('fileinputObject.files= '+ fileinputObject.files[0])
    //     this.$emit('add-media-file', formData);
    //     console.log('ev ' + ev + 'this.item.id= '+  this.item)
    // }

  },
  watch: {
    priorityChanged: function(val, oldVal) {
      if (val !=  oldVal) {
        return true
      } else {
        return false
      }
    }
  },
  directives: {
    // mydatedropper: require('../directives/mydatedropper.js')
    // dtpicker: require('../directives/dtpicker.js')
  },

  filters: {
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
    momentPretty: {
      read: function(val) {
        console.log('read-val'+ val )

        return val ?  moment(val).format('ddd, MM-DD-YYYY') : '';
      },
      write: function(val, oldVal) {
        console.log('write-val'+ val + '--'+ oldVal)

        return moment(val).format('YYYY-MM-DD');
      }
    }
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
