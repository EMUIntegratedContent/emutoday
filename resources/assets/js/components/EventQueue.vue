<template>
  <div>
    <div class="row">
      <div class="col-xs-12 col-sm-8 col-md-8 col-lg-6">
        <form class="form-inline">
          <div class="form-group">
            <label>Showing events starting <span v-if="isEndDate">between</span><span
                v-else>on or after</span>
              <flatpickr
                  v-if="startdate"
                  v-model="startdate"
                  id="startDatePicker"
                  :config="flatpickrConfig"
                  class="form-control"
                  name="startingDate"
              >
              </flatpickr>
<!--              <date-picker v-if="startdate" v-model="startdate" value-type="YYYY-MM-DD" format="MM/DD/YYYY"></date-picker>-->
            </label>
          </div>
          <div v-if="isEndDate" class="form-group">
            <label> and
              <flatpickr
                  v-if="enddate"
                  v-model="enddate"
                  id="endDatePicker"
                  :config="flatpickrConfig"
                  class="form-control"
                  name="endingDate"
              >
              </flatpickr>
<!--              <date-picker v-if="enddate" v-model="enddate" value-type="YYYY-MM-DD" format="MM/DD/YYYY"></date-picker>-->
            </label>
          </div>
          <button type="button" class="btn btn-sm btn-info" @click="fetchAllRecords">Filter</button>
          <a href="#" id="rangetoggle" @click="toggleRange"><span v-if="isEndDate"> - Remove </span><span
              v-else> + Add </span>Range</a>
        </form>
      </div>
      <!-- TEXT filter -->
      <div class="col-xs-12 col-sm-4 col-md-4 col-lg-6">
        <form class="form-inline" v-on:submit.prevent="">
          <div class="form-group">
            <label for="search-filter">Search titles</label>
            <input v-model="textFilter" id="search-filter" type="text" class="form-control">
          </div>
        </form>
      </div>
    </div>
    <hr/>
    <div class="row">
      <div class="col-xs-12">
        <label id="automail-label" for="automail">Send notification email? <input type="checkbox" name="automail"
                                                                                  id="automail"/></label>
      </div>
    </div>
    <div class="row">
      <h2 v-if="loading" class="col-md-12">Loading. Please Wait...</h2>
      <div class="col-md-4">
        <h3><span class="badge">{{ itemsUnapproved ? itemsUnapproved.length : 0 }}</span> Unapproved Events</h3>
        <div id="items-unapproved">
<!--          v-for="item in itemsUnapproved | orderBy 'start_date' 1"-->
          <event-queue-item
              pid="items-unapproved"
              v-for="(item, i) in itemsUnapproved"
              @item-change="moveToApproved"
              :item="item"
              :index="i"
              :key="'items-unapproved-'+i"
          >
          </event-queue-item>
        </div>
      </div><!-- /.col-md-6 -->
      <div class="col-md-4">
        <h3><span class="badge">{{ itemsApproved ? itemsApproved.length : 0 }}</span> Approved Events</h3>
        <div id="items-approved">
          <event-queue-item
              pid="items-approved"
              v-for="(item, i) in itemsApproved"
              @item-change="moveToUnApproved"
              :item="item"
              :index="i"
              :key="'items-approved-'+i"
          >
          </event-queue-item>
        </div>
      </div><!-- /.col-md-6 -->
      <div class="col-md-4">
        <div id="items-live">
          <h3><span class="badge">{{ itemsLive ? itemsLive.length : 0 }}</span> Live Events</h3>
          <event-queue-item
              pid="items-live"
              v-for="(item, i) in itemsLive"
              @item-change="moveToUnApproved"
              :elevated-events="elevateditems"
              :item="item"
              :index="i"
              :key="'items-live'+i"
          >
          </event-queue-item>
        </div>
      </div><!-- /.col-md-6 -->
    </div><!-- ./row -->
  </div>
</template>
<style scoped>
#items-unapproved .box {
  margin-bottom: 4px;
}

#items-approved .box {
  margin-bottom: 4px;
}

#automail-label {
  font-size: 110%;
  margin: 0;
  padding: 0;
  position: relative;
  top: 10px;
}

#rangetoggle {
  color: #FF851B;
  margin-left: 5px;
  border-bottom: 2px #FF851B dotted;
}

.ordersave-container {
  margin-bottom: 10px;
}
</style>
<script>
import moment from 'moment'
import EventQueueItem from './EventQueueItem.vue'
import flatpickr from 'vue-flatpickr-component'
import 'flatpickr/dist/flatpickr.css'

export default {
  components: {
    EventQueueItem,
    flatpickr
  },
  props: ['annrecords', 'role'],
  data: function () {
    return {
      resource: {},
      allitems: [],
      elevateditems: [],
      originalelevateditems: [],
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
      elevateditemschanged: false,
      ordersave: {
        isOk: false,
        isErr: false,
        msg: '',
      },
      textFilter: '',
      flatpickrConfig: {
        altFormat: "m/d/Y", // format the user sees
        altInput: true,
        dateFormat: "Y-m-d", // format sumbitted to the API
      }
    }
  },
  created () {
    let twoWeeksEarlier = moment().subtract(2, 'w')
    this.startdate = twoWeeksEarlier.format("YYYY-MM-DD")
    this.enddate = twoWeeksEarlier.clone().add(4, 'w').format("YYYY-MM-DD")
    this.fetchAllRecords();
  },
  computed: {
    top4: function () {
    },
    currentDateAndTime: function () {
      return moment()
    },
    itemsApproved: function () {
      return this.filterItemsApproved(this.allitems);
    },
    itemsUnapproved: function () {
      return this.filterItemsUnapproved(this.allitems);
    },
    itemsPromoted: function () {
      return this.filterItemsPromoted(this.itemsApproved);
    },
    itemsLive: function () {
      return this.filterItemsLive(this.allitems);
    },
    canElevate: function () {
      if (this.role === 'admin' || this.role === 'admin_super' || this.role === 'editor') {
        return true
      }
      return false
    },
  },
  methods: {
    fetchAllRecords: function () {
      this.loading = true

      var routeurl = '/api/event/queueload'
      // if a start date is set, get stories whose start_date is on or after this date
      if (this.startdate) {
        routeurl = routeurl + '/' + this.startdate
      }
      else {
        routeurl = routeurl + '/' + moment().subtract(2, 'w').format("YYYY-MM-DD")
      }
      // if a date range is set, get stories between the start date and end date
      if (this.isEndDate) {
        routeurl = routeurl + '/' + this.enddate
      }

      this.$http.get(routeurl)

      .then((response) => {
        this.allitems = response.data.data
        // this.checkOverDataFilter()
        this.loading = false
      }).catch(() => {
      })

      this.fetchElevatedRecords(); //get elevated records regardless of date
    },

    /**
     * Get elevated records REGARDLESS of date range!
     */
    fetchElevatedRecords: function () {
      this.loading = true

      var routeurl = '/api/event/elevated';
      this.$http.get(routeurl)

      .then((response) => {
        this.elevateditems = response.data.data
        this.loading = false;
      }).catch((response) => {
      })
    },

    filterItemsApproved: function (items) {
      const regexp = new RegExp(this.textFilter, 'gi'); // anywhere in the string, ignore case
      return items.filter(function (item) {
        return moment(item.start_date_time).isAfter(moment()) && item.is_approved === 1 && item.priority === 0 && item.is_promoted === 0 && regexp.test(item.title);  // true
      });
    },
    filterItemsUnapproved: function (items) {
      const regexp = new RegExp(this.textFilter, 'gi'); // anywhere in the string, ignore case
      return items.filter(function (item) {
        return item.is_approved === 0 && regexp.test(item.title);
      });
    },
    filterItemsPromoted: function (items) {
      var regexp = new RegExp(this.textFilter, 'gi'); // anywhere in the string, ignore case
      return items.filter(function (item) {
        return item.is_promoted === 1 && regexp.test(item.title);
      });
    },
    filterItemsLive: function (items) {
      var regexp = new RegExp(this.textFilter, 'gi'); // anywhere in the string, ignore case
      return items.filter(function (item) {
        return (
                (moment(item.start_date_time).isSameOrBefore(moment()) && item.is_approved === 1)
                || (item.is_approved === 1 && (item.priority > 0 || item.is_promoted === 1))
            )
            && regexp.test(item.title);
      });
    },

    moveToApproved: function (changeditem) {
      changeditem.is_approved = 1;
      changeditem.priority = changeditem.priority;
      this.updateRecord(changeditem)
    },
    moveToUnApproved: function (changeditem) {
      changeditem.is_approved = 0;

      this.updateRecord(changeditem)
    },
    movedItemIndex: function (mid) {
      return this.xitems.findIndex(item => item.id == mid)
    },
    updateRecord: function (item) {
      this.$http.patch('/api/event/updateItem/' + item.id, item, {
        method: 'PATCH'
      })
      .then((response) => {
      }).catch((e) => {
      })
    },
    checkOverData: function () {
      for (var i = 0; i < this.allitems.length; i++) {
        if (this.allitems[i].is_approved == 1) {
          this.items.push(this.allitems.splice(i, 1));
        }
        else {
          this.xitems.push(this.allitems.splice(i, 1));
        }
      }

    },
    toggleRange: function () {
      if (this.isEndDate) {
        this.isEndDate = false
      }
      else {
        this.isEndDate = true
      }
    },

    /**
     * Uses vue-sortable
     */
    updateOrder: function (eventItem) {
      // Save the original order the first time this method is called
      if (!this.elevateditemschanged) {
        // https://forum-archive.vuejs.org/topic/3679/global-method-to-clone-object-in-vuejs-rather-then-reference-it-to-avoid-code-duplication/5
        this.$set('originalelevateditems', JSON.parse(JSON.stringify(this.elevateditems)))
        this.elevateditemschanged = true
      }
      // https://stackoverflow.com/questions/34881844/resetting-a-vue-js-list-order-of-all-items-after-drag-and-drop
      let oldIndex = eventItem.oldIndex
      let newIndex = eventItem.newIndex
      // move the item in the underlying array
      this.elevateditems.splice(newIndex, 0, this.elevateditems.splice(oldIndex, 1)[0]);
    },
    /**
     * Change the priority ranking of elevated events in the database
     */
    updateElevatedOrder: function () {
      this.ordersave.isOk = false
      this.ordersave.isErr = false

      let routeurl = '/api/event/elevated/reorder';
      this.$http.put(routeurl, this.elevateditems)

      .then((response) => {
        this.$set('elevateditems', response.data.data)
        this.ordersave.isOk = true
        this.ordersave.msg = "Order was updated"
      }).catch(() => {
        //error callback
        this.ordersave.isErr = true
        this.ordersave.msg = "Order was not updated"
      })

      this.elevateditemschanged = false;
    },
    toggleCallout: function (evt) {
      this.ordersave.isOk = false
      this.ordersave.isErr = false
    },

    resetElevatedOrder: function () {
      this.elevateditems = this.originalelevateditems
      this.originalelevateditems = [];
      this.elevateditemschanged = false
    }
  },

  // the `events` option simply calls `$on` for you
  // when the instance is created
  events: {
    'event-elevated': function (eventObj) {
      if (eventObj) {
        this.elevateditems.push(eventObj)
        this.updateElevatedOrder()
      }
    },
    'event-demoted': function (eventId) {
      for (let i = 0; i < this.elevateditems.length; i++) {
        if (eventId == this.elevateditems[i].id) {
          this.elevateditems.$remove(this.elevateditems[i])
          this.updateElevatedOrder()
        }
      }
    },
  }
}
</script>
