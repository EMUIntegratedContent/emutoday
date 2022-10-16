<template>
    <div class="row">
        <div class="col-xs-12 col-sm-8 col-md-6 col-lg-9">
            <form class="form-inline">
              <div class="form-group">
                  <label for="start-date">Showing LBC events starting <span v-if="isEndDate">between</span><span v-else>on or after</span></label>
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
    <div class="col-md-6">
      <h3><span class="badge">{{ itemsUnapproved ? itemsUnapproved.length : 0 }}</span> Unapproved Events</h3>
      <div id="items-approved">
<!--        v-for="item in itemsUnapproved | orderBy 'start_date' 1"-->
        <event-queue-item
        pid="items-approved"
        v-for="(item, i) in itemsUnapproved"
        @item-change="moveToApproved"
        :item="item"
        :index="i"
        :key="'items-unapproved-'+i"
        :is="approved-list">
        </event-queue-item>
      </div>
    </div><!-- /.col-md-6 -->

    <div class="col-md-6">
      <h3><span class="badge">{{ itemsApproved ? itemsApproved.length : 0 }}</span> Approved Events</h3>
<!--      v-for="item in itemsApproved | orderBy 'start_date' 1"-->
      <div id="items-approved">
        <event-queue-item
        pid="items-approved"
        v-for="(item, i) in itemsApproved"
        @item-change="moveToUnApproved"
        :item="item"
        :index="i"
        :key="'items-approved-'+i"
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
  border-radius: 5px;
	background-color: #eff3fa;
  border: 1px solid #bbb;
}
#rangetoggle{
    color: #FF851B;
    margin-left: 5px;
    border-bottom: 2px #FF851B dotted;
}
</style>
<script>
import moment from 'moment';
import EventQueueItem from './EventLbcQueueItem.vue'
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
      let twoWeeksEarlier = moment().subtract(2, 'w')
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
    itemsApproved:function() {
      return this.filterItemsApproved(this.allitems);
    },
    itemsUnapproved:function() {
      return this.filterItemsUnapproved(this.allitems);
    }
  },
  methods : {
    fetchAllRecords: function() {
      this.loading = true

      var routeurl = '/api/event/lbcqueueload'
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
      }).bind(this);
    },
    filterItemsUnapproved: function(items) {
      return items.filter(function(item) {
        return item.lbc_approved === 0;
      });
    },
    filterItemsApproved: function(items) {
      return items.filter(function(item) {
        return item.lbc_approved === 1;
      });
    },

    moveToApproved: function(changeditem){
      changeditem.lbc_approved = 1;
      this.updateRecord(changeditem)
    },
    moveToUnApproved: function(changeditem){
      changeditem.lbc_approved = 0;
      this.updateRecord(changeditem)
    },
    movedItemIndex: function(mid){
      return this.xitems.findIndex(item => item.id == mid)
    },
    checkOverData: function() {
      console.log('this.items='+ this.allitems)
      for (var i=0; i < this.allitems.length; i++ ) {
        if( this.allitems[i].lbc_approved == 1) {
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
