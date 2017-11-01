<template>
  <div class="row">
    <div class="col-xs-12 col-sm-8 col-md-6 col-lg-9">
      <form class="form-inline">
        <div class="form-group">
          <label for="start-date">Showing all events starting <span v-if="isEndDate">between</span><span v-else>on or after</span></label>
          <input v-if="startdate" v-model="startdate" type="text" :initval="startdate" v-flatpickr="startdate">
        </div>
        <div v-if="isEndDate" class="form-group">
          <label for="start-date"> and </label>
          <input v-if="enddate" type="text" :initval="enddate" v-flatpickr="enddate">
        </div>
        <button type="button" class="btn btn-sm btn-info" @click="fetchAllRecords">Filter</button>
        <a href="#" id="rangetoggle" @click="toggleRange"><span v-if="isEndDate"> - Remove </span><span v-else> + Add </span>Range</a>
      </form>
    </div>
  </div>
  <hr />

  <div class="row">

  <div class="col-md-4">
      <h3><span class="badge">{{ itemsNoPointsReviewed ? itemsNoPointsReviewed.length : 0 }}</span> No Eagle Rewards Points | Reviewed</h3>
      <div id="items-reviewed">
        <event-queue-item
          pid="items-approved"
          v-for="item in itemsNoPointsReviewed | orderBy 'start_date' 1"
          @item-change="moveToApproved"
          :item="item"
          :index="$index"
          :is="approved-list">
        </event-queue-item>
      </div>
    </div><!-- /.col-md-6 -->

    <div class="col-md-4">
      <h3><span class="badge">{{ itemsNoPoints ? itemsNoPoints.length : 0 }}</span> No Eagle Rewards Points</h3>
      <div>
        <event-queue-item
          pid="items-approved"
          v-for="item in itemsNoPoints | orderBy 'start_date' 1"
          @item-change="moveToApproved"
          :item="item"
          :index="$index"
          :is="approved-list">
        </event-queue-item>
      </div>
      </div>

  <div class="col-md-4">
    <h3><span class="badge">{{ itemsPoints ? itemsPoints.length : 0 }}</span> Has Eagle Rewards Points <i class="fa fa-check green"></i></h3>
    <div id="items-approved">
      <event-queue-item

      pid="items-approved"
      v-for="item in itemsPoints | orderBy 'start_date' 1"
      @item-change="moveToUnApproved"
      :item="item"
      :index="$index"
      :is="approved-list">
    </event-queue-item>
  </div>
</div>
</div><!-- /.col-md-6 -->
</template>

<style scoped>
#items-unapproved .box {
  margin-bottom: 4px;
}
#items-approved .box {
  margin-bottom: 4px;
}
#items-reviewed {
}
#rangetoggle{
  color: #FF851B;
  margin-left: 5px;
  border-bottom: 2px #FF851B dotted;
}
</style>
<script>
import moment from 'moment';
import EventQueueItem from './EventHscQueueItem.vue'
import flatpickr from "../directives/flatpickr.js"

export default  {
  directives: {flatpickr},
  components: {EventQueueItem},
  props: ['annrecords'],
  data: function() {
    return {
      resource: {},
      allitems: [],
      otheritems: [],
      appitems: [],
      unappitems: [],
      items: [],
      xitems: [],
      objs: {},
      loading: true,
      startdate: null,
      enddate: null,
      isEndDate: false,
    }
  },
  ready() {
    let twoWeeksEarlier = moment().subtract(1, 'w')
    this.startdate = twoWeeksEarlier.format("YYYY-MM-DD")
    this.enddate = twoWeeksEarlier.clone().add(4, 'w').format("YYYY-MM-DD")
    this.fetchAllRecords();
  },
  computed: {
    top4:function(){
    },
    currentDateAndTime:function(){
      return moment()
    },
    itemsPoints:function() {
      return this.filterItemsPoints(this.allitems);
    },
    itemsNoPoints:function() {
      return this.filterItemsNoPoints(this.allitems);
    },
    itemsNoPointsReviewed:function() {
      return this.filterItemsNoPointsReviewed(this.allitems);
    }
  },
  methods : {
    fetchAllRecords: function() {
      this.loading = true

      var routeurl = '/api/event/hscqueueload'
      // if a start date is set, get stories whose start_date is on or after this date
      if(this.startdate){
        routeurl = routeurl + '/' + this.startdate
      } else {
        routeurl = routeurl + '/' + moment().subtract(2, 'w').format("YYYY-MM-DD")
      }
      // if a date range is set, get stories between the start date and end date
      if(this.isEndDate){
        routeurl = routeurl + '/' + this.enddate
      }

      this.$http.get(routeurl)

      .then((response) =>{
        this.$set('allitems', response.data.data)
        this.checkOverDataFilter()
        this.loading = false
      }, (response) => {
        //error callback
        console.log("ERRORS")
      }).bind(this);
    },
    checkOverDataFilter: function() {
      console.log('items=' + this.items)
    },
    filterItemsNoPoints: function(items) {
      return items.filter(function(item) {
        return (item.hsc_rewards == false || item.hsc_rewards == null || item.hsc_rewards == 0) && item.hsc_reviewed == 0;
      });
    },
    filterItemsNoPointsReviewed: function(items) {
      return items.filter(function(item) {
        return (item.hsc_rewards == false || item.hsc_rewards == null || item.hsc_rewards == 0) && item.hsc_reviewed == 1;
      });
    },
    filterItemsPoints: function(items) {
      return items.filter(function(item) {
        return !(item.hsc_rewards == false || item.hsc_rewards == null || item.hsc_rewards == 0);
      });
    },

    moveToApproved: function(changeditem){
      // changeditem.hsc_reviewed = 1;
      // this.updateRecord(changeditem)
    },
    moveToUnApproved: function(changeditem){
      // changeditem.hsc_reviewed = 0;
      // this.updateRecord(changeditem)
    },
    onCalendarChange: function(){
      // flatpickr directive method
    },
    movedItemIndex: function(mid){
      return this.xitems.findIndex(item => item.id == mid)
    },
    checkOverData: function() {
      console.log('this.items='+ this.allitems)
      for (var i=0; i < this.allitems.length; i++ ) {
        if( this.allitems[i].hsc_reviewed == 1) {
          this.items.push(this.allitems.splice(i,1));
        } else {
          this.xitems.push(this.allitems.splice(i,1));
        }
      }
    },
    toggleRange: function(){
      if(this.isEndDate){
        this.isEndDate = false
      } else {
        this.isEndDate = true
      }
    },
  },
  events: {
  }
}
</script>
