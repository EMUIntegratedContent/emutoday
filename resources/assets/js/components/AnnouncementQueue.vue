<style scoped>

#items-unapproved .box {
  margin-bottom: 4px;
}

#items-approved .box {
  margin-bottom: 4px;
}

#rangetoggle{
    color: #FF851B;
    margin-left: 5px;
    border-bottom: 2px #FF851B dotted;
}

</style>

<template>
    <div class="row">
        <div class="col-xs-12 col-sm-8 col-md-6 col-lg-9">
            <form class="form-inline">
              <div class="form-group">
                  <label for="start-date">Showing announcements starting <span v-if="isEndDate">between</span><span v-else>on or after</span></label>
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
        <div v-if="role == 'admin' || role == 'admin_super'" class="col-xs-12 col-sm-4 col-md-6 col-lg-3 text-right">
            <a class="btn btn-sm btn-default" href="/admin/archive/queue/announcements"><i class="fa fa-archive"></i> Archived Announcements</a>
        </div>
    </div>
    <hr />
  <div class="row">
      <h2 v-if="loading" class="col-md-12">Loading. Please Wait...</h2>
    <div class="col-md-4">
      <h3><span class="badge">{{ itemsUnapproved ? itemsUnapproved.length : 0 }}</span> Unapproved</h3>
      <div id="items-unapproved">
        <announcement-queue-item
        pid="items-unapproved"
        v-for="item in itemsUnapproved | orderBy 'start_date' 1"
        :item="item"
        :index="$index"
        :is="unapproved-list"
        >
      </announcement-queue-item>
    </div>
  </div>
  <!-- /.col-md-6 -->
  <div class="col-md-4">
    <h3><span class="badge">{{ itemsApproved ? itemsApproved.length : 0 }}</span> Approved</h3>
    <div id="items-approved">
      <announcement-queue-item
      pid="items-approved"
      v-for="item in itemsApproved | orderBy 'start_date' -1"
      :item="item"
      :index="$index"
      :is="approved-list"
      >
    </announcement-queue-item>
  </div>
</div>
<div class="col-md-4">
  <h3><span class="badge">{{ itemsLive ? itemsLive.length : 0 }}</span> Live</h3>
  <div id="items-live">
    <announcement-queue-item
    pid="items-live"
    v-for="item in itemsLive | orderBy 'priority' -1"
    :item="item"
    :index="$index"
    :is="items-live"
    >
  </announcement-queue-item>
</div>
</div>
<!-- /.col-md-6 -->
</div>
<!-- ./row -->

</template>

<script>
import moment from 'moment';
import AnnouncementQueueItem from './AnnouncementQueueItem.vue'
import Pagination from './Pagination.vue'
import flatpickr from "../directives/flatpickr.js"

export default {
  directives: {flatpickr},
  components: {AnnouncementQueueItem},
  props: ['atype','cuser', 'role'],
  data: function() {
    return {
      resource: {},
      allitems: [],
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
    itemsApproved:function() {
      return  this.filterItemsApproved(this.allitems);
    },
    itemsUnapproved:function() {
      return  this.filterItemsUnapproved(this.allitems);
    },
    itemsLive:function() {
      return  this.filterItemsLive(this.allitems);
    }
  },

  methods: {
      toggleRange: function(){
          if(this.isEndDate){
              this.isEndDate = false
          } else {
              this.isEndDate = true
          }
      },
    fetchAllRecords: function() {
      this.loading = true

      var routeurl = '/api/announcement/queueload/' + this.atype;

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
          console.log(routeurl)
          this.$set('allitems', response.data.data)
          this.checkOverDataFilter();
          this.loading = false;
      }, (response) => {
          //error callback
          console.log("ERRORS");
      }).bind(this);
    },
    checkOverData: function() {
      console.log('this.items=' + this.allitems)

    },
    filterItemsApproved: function(items) {
      return items.filter(function(item) {
        return moment(item.start_date).isAfter(moment()) && item.is_approved === 1 && item.priority === 0 && item.is_archived === 0;
      });
    },
    filterItemsUnapproved: function(items) {
      return items.filter(function(item) {
        return item.is_approved === 0 && item.is_archived === 0;
      });
    },
    filterItemsLive: function(items) {
      return items.filter(function(item) {
        return moment(item.start_date).isSameOrBefore(moment()) && item.is_approved === 1 && item.is_archived === 0 || item.is_approved === 1 && item.priority > 0 && item.is_archived === 0;  // true

      });
    },
    onCalendarChange: function(){
        // flatpickr directive method
    },
    checkOverDataFilter: function() {
      console.log('items=' + this.items)
    }
  },

  // the `events` option simply calls `$on` for you
  // when the instance is created
  events: {
  }
}

</script>
