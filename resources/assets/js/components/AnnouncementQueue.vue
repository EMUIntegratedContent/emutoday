<style scoped>

#items-unapproved .box {
  margin-bottom: 4px;
}

#items-approved .box {
  margin-bottom: 4px;
}

#rangetoggle {
  color: #FF851B;
  margin-left: 5px;
  border-bottom: 2px #FF851B dotted;
}

</style>

<template>
  <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-5">
      <form class="form-inline">
        <div class="form-group">
          <label>Showing announcements starting <span v-if="isEndDate">between</span><span v-else>on or after</span>
            <flatpickr
                v-if="startdate"
                v-model="startdate"
                id="startDatePicker"
                :config="flatpickrConfig"
                class="form-control"
                name="startingDate"
            >
            </flatpickr>
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
          </label>
        </div>
        <button type="button" class="btn btn-sm btn-info" @click="fetchAllRecords">Filter</button>
        <a href="#" id="rangetoggle" @click="toggleRange"><span v-if="isEndDate"> - Remove </span><span
            v-else> + Add </span>Range</a>
      </form>
    </div>
    <!-- TEXT filter -->
    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
      <form class="form-inline" v-on:submit.prevent="">
        <div class="form-group">
          <label for="search-filter">Search titles</label>
          <input v-model="textFilter" id="search-filter" type="text" class="form-control">
        </div>
      </form>
    </div>
    <div v-if="role == 'admin' || role == 'admin_super'" class="col-xs-12 col-sm-12 col-md-4 col-lg-3 text-right">
      <a class="btn btn-sm btn-default" href="/admin/archive/queue/announcements"><i class="fa fa-archive"></i> Archived
        Announcements</a>
    </div>
  </div>
  <hr/>
  <div class="row">
    <h2 v-if="loading" class="col-md-12">Loading. Please Wait...</h2>
    <div class="col-md-4">
      <h3><span class="badge">{{ itemsUnapproved ? itemsUnapproved.length : 0 }}</span> Unapproved</h3>
      <div id="items-unapproved">
        <announcement-queue-item
            pid="items-unapproved"
            v-for="(item, i) in itemsUnapproved"
            :item="item"
            :index="i"
            :key="'unapproved-list-'+i"
            :atype="atype"
            @special-announcement-added="specialAnnouncementAdded"
            @special-announcement-removed="specialAnnouncementRemoved"
            @item-change="moveAnnouncement"
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
            v-for="(item, i) in itemsApproved"
            :item="item"
            :key="'approved-list-'+i"
            :atype="atype"
            @special-announcement-added="specialAnnouncementAdded"
            @special-announcement-removed="specialAnnouncementRemoved"
            @item-change="moveAnnouncement"
        >
        </announcement-queue-item>
      </div>
    </div>
    <div class="col-md-4">

      <div id="items-live">
        <!-- ELEVATED ANNOUNCEMENTS -->
        <template v-if="canElevate">
          <h3><span class="badge">{{ elevateditems ? elevateditems.length : 0 }}</span> Elevated</h3>
          <p>To rearrange the order of announcements, drag the pod to the desired location. To demote an announcement,
            click the red 'X' on the pod. Click "save order" button when done. Note: this list is NOT filtered by
            date.</p>
          <div v-if="ordersave.isOk" class="alert alert-success alert-dismissible">
            <button @click.prevent="toggleCallout" class="btn btn-sm close"><i class="fa fa-times"></i></button>
            <h5>{{ ordersave.msg }}</h5>
          </div>
          <div v-if="ordersave.isErr" class="alert alert-danger alert-dismissible">
            <button @click.prevent="toggleCallout" class="btn btn-sm close"><i class="fa fa-times"></i></button>
            <h5>{{ ordersave.msg }}</h5>
          </div>
          <template v-if="elevateditemschanged">
            <div class="ordersave-container">
              <button @click="updateElevatedOrder" class="btn btn-info">Save Order</button>
              <button @click="resetElevatedOrder" class="btn btn-default">Reset</button>
            </div>
          </template>
          <template v-if="elevateditems.length > 0">
            <Sortable
                :list="elevateditems"
                item-key="id"
                tag="div"
                :options="options"
                @update="updateOrder"
            >
              <template #item="{element, i}">
                  <announcement-queue-item
                    class="draggable list-group-item"
                    pid="item-elevated"
                    :key="'item-elevated-'+i"
                    :item="element"
                    :index="i"
                    :elevated-announcements="elevateditems"
                    :atype="atype"
                    @special-announcement-added="specialAnnouncementAdded"
                    @special-announcement-removed="specialAnnouncementRemoved"
                    @announcement-elevated="announcementElevated"
                    @announcement-demoted="announcementDemoted"
                  >
                  </announcement-queue-item>
              </template>
            </Sortable>
          </template>
          <template v-else>
            <p>There are no elevated announcements.</p>
          </template>
        </template>
        <hr/> <!-- End elevated announcements -->
        <h3><span class="badge">{{ itemsLive ? itemsLive.length : 0 }}</span> Live</h3>
        <announcement-queue-item
            pid="items-live"
            v-for="(item, i) in itemsLive"
            :key="'live-items-'+i"
            :item="item"
            :index="i"
            :atype="atype"
            @special-announcement-added="specialAnnouncementAdded"
            @special-announcement-removed="specialAnnouncementRemoved"
            @announcement-elevated="announcementElevated"
            @announcement-demoted="announcementDemoted"
            @item-change="moveAnnouncement"
        >
        </announcement-queue-item>
      </div>
    </div>
    <!-- /.col-md-6 -->
  </div>
  <!-- ./row -->

</template>
<style>
.ordersave-container {
  margin-bottom: 10px;
}
</style>
<script>
import moment from 'moment';
import AnnouncementQueueItem from './AnnouncementQueueItem.vue'
import flatpickr from 'vue-flatpickr-component'
import 'flatpickr/dist/flatpickr.css'
import {Sortable} from "sortablejs-vue3"

export default {
  components: {
    AnnouncementQueueItem,
    flatpickr,
    Sortable
  },
  props: ['atype', 'cuser', 'role'],
  data: function () {
    return {
      resource: {},
      allitems: [],
      elevateditems: [],
      originalelevateditems: [],
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
        enableTime: false
      },
      options: {

      }
    }
  },

  created() {
    let twoWeeksEarlier = moment().subtract(2, 'w')
    this.startdate = twoWeeksEarlier.format("YYYY-MM-DD")
    this.enddate = twoWeeksEarlier.clone().add(4, 'w').format("YYYY-MM-DD")
    this.fetchAllRecords();
  },

  computed: {
    itemsApproved () {
      const regexp = new RegExp(this.textFilter, 'gi'); // anywhere in the string, ignore case
      return this.allitems.filter(function (item) {
        return moment(item.start_date).isAfter(moment()) && item.is_approved === 1 && item.priority === 0 && item.is_archived === 0 && regexp.test(item.title);
      })
    },
    itemsUnapproved () {
      const regexp = new RegExp(this.textFilter, 'gi'); // anywhere in the string, ignore case
      return this.allitems.filter(function (item) {
        return item.is_approved === 0 && item.is_archived === 0 && regexp.test(item.title);
      })
    },
    itemsLive () {
      const regexp = new RegExp(this.textFilter, 'gi'); // anywhere in the string, ignore case
      return this.allitems.filter(function (item) {
        return (moment(item.start_date).isSameOrBefore(moment())
                && item.is_approved === 1 && item.is_archived === 0
                || item.is_approved === 1 && item.priority > 0 && item.is_archived === 0)
            && regexp.test(item.title);  // true

      })
    },
    canElevate: function () {
      if (this.role === 'admin' || this.role === 'admin_super' || this.role === 'editor') {
        return true
      }
      return false
    },
  },

  methods: {
    toggleRange: function () {
      if (this.isEndDate) {
        this.isEndDate = false
      } else {
        this.isEndDate = true
      }
    },
    fetchAllRecords: function () {
      this.loading = true

      let routeurl = '/api/announcement/queueload/' + this.atype

      // if a start date is set, get stories whose start_date is on or after this date
      if (this.startdate) {
        routeurl = routeurl + '/' + this.startdate
      } else {
        routeurl = routeurl + '/' + moment().subtract(2, 'w').format("YYYY-MM-DD")
      }

      // if a date range is set, get stories between the start date and end date
      if (this.isEndDate) {
        routeurl = routeurl + '/' + this.enddate
      }

      this.$http.get(routeurl)
          .then((response) => {
            this.allitems = response.data.data
            this.loading = false;
          })
          .catch((e) => {
          })

      this.fetchElevatedRecords(); //get elevated records regardless of date
    },

    /**
     * Get elevated records REGARDLESS of date range!
     */
    fetchElevatedRecords: function () {
      this.loading = true

      const routeurl = '/api/announcement/elevated/' + this.atype;
      this.$http.get(routeurl)
          .then((response) => {
            this.elevateditems = response.data.data
            this.loading = false;
          })
          .catch((e) => {
          })
    },
    moveAnnouncement (changeditem) {
      const index = this.allitems.findIndex(item => item.id == changeditem.id)
      console.log(index)
      this.allitems[index] = changeditem
    },
    /**
     * Uses vue-sortable
     */
    updateOrder: function (eventItem) {
      // Save the original order the first time this method is called
      if (!this.elevateditemschanged) {
        // https://forum-archive.vuejs.org/topic/3679/global-method-to-clone-object-in-vuejs-rather-then-reference-it-to-avoid-code-duplication/5
        this.originalelevateditems = JSON.parse(JSON.stringify(this.elevateditems))
        this.elevateditemschanged = true
      }
      // https://stackoverflow.com/questions/34881844/resetting-a-vue-js-list-order-of-all-items-after-drag-and-drop
      let oldIndex = eventItem.oldIndex
      let newIndex = eventItem.newIndex
      // move the item in the underlying array
      this.elevateditems.splice(newIndex, 0, this.elevateditems.splice(oldIndex, 1)[0]);
    },
    /**
     * Change the priority ranking of elevated announcements in the database
     */
    updateElevatedOrder: function () {
      this.ordersave.isOk = false
      this.ordersave.isErr = false

      const routeurl = '/api/announcement/elevated/reorder/' + this.atype;
      this.$http.put(routeurl, this.elevateditems)

          .then((response) => {
            this.elevateditems = response.data.data
            this.ordersave.isOk = true
            this.ordersave.msg = "Order was updated"
          })
          .catch((e) => {
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
    },

    specialAnnouncementAdded (announcementObj) {
      if (announcementObj) {
        announcementObj.priority = 1000000 // 1000000 is an arbitrary high number used to denote a special announcement. There can only be ONE special announcement.
        this.updateElevatedOrder()
      }
    },
    specialAnnouncementRemoved (announcementObj) {
      if (announcementObj) {
        announcementObj.priority = this.elevateditems.length // remove the priority of 1000000 and set it to the length of the elevated items array
        this.updateElevatedOrder()
      }
    },
    announcementElevated (announcementObj) {
      if (announcementObj) {
        this.elevateditems.push(announcementObj)
        this.updateElevatedOrder()
      }
    },
    announcementDemoted (announcementId) {
      for (let i = 0; i < this.elevateditems.length; i++) {
        if (announcementId == this.elevateditems[i].id) {
          this.elevateditems.splice(i, 1)
          this.updateElevatedOrder()
        }
      }
    }
  }
}

</script>
