<template>
  <div class="row">
    <div class="col-xs-12 col-sm-8 col-md-6 col-lg-9">
      <form class="form-inline">
        <div class="form-group">
          <label for="startDatePicker">Showing LBC events starting <span v-if="isEndDate">between</span><span v-else>on or after</span>
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
          <label for="endDatePicker"> and
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
  </div>
  <hr/>
  <div class="row">
    <div class="col-md-6">
      <h3><span class="badge">{{ itemsUnapproved ? itemsUnapproved.length : 0 }}</span> Unapproved Events</h3>
      <div id="items-approved">
        <event-queue-item
            pid="items-unapproved"
            v-for="(item, i) in itemsUnapproved"
            @item-change="moveEvent"
            :item="item"
            :index="i"
            :key="'items-unapproved-'+i">
        </event-queue-item>
      </div>
    </div><!-- /.col-md-6 -->

    <div class="col-md-6">
      <h3><span class="badge">{{ itemsApproved ? itemsApproved.length : 0 }}</span> Approved Events</h3>
      <div id="items-approved">
        <event-queue-item
            pid="items-approved"
            v-for="(item, i) in itemsApproved"
            @item-change="moveEvent"
            :item="item"
            :index="i"
            :key="'items-approved-'+i">
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

#rangetoggle {
  color: #FF851B;
  margin-left: 5px;
  border-bottom: 2px #FF851B dotted;
}
</style>
<script>
import moment from 'moment';
import EventQueueItem from './EventLbcQueueItem.vue'
import flatpickr from 'vue-flatpickr-component'
import 'flatpickr/dist/flatpickr.css'

export default {
  components: {
    EventQueueItem,
    flatpickr
  },
  props: ['annrecords'],
  data: function () {
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
      flatpickrConfig: {
        altFormat: "m/d/Y", // format the user sees
        altInput: true,
        dateFormat: "Y-m-d", // format sumbitted to the API
        enableTime: true
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
    currentDateAndTime: function () {
      return moment()
    },
    itemsApproved: function () {
      return this.allitems.filter(function (item) {
        return item.lbc_approved == 1;
      });
    },
    itemsUnapproved: function () {
      return this.allitems.filter(function (item) {
        return item.lbc_approved == 0;
      });
    }
  },
  methods: {
    fetchAllRecords: function () {
      this.loading = true

      let routeurl = '/api/event/lbcqueueload'
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
        this.loading = false
      }, () => {
      })
    },
    moveEvent (changeditem) {
      const index = this.allitems.findIndex(item => item.id == changeditem.id)
      this.allitems[index] = changeditem
    },
    movedItemIndex: function (mid) {
      return this.xitems.findIndex(item => item.id == mid)
    },
    checkOverData: function () {
      for (let i = 0; i < this.allitems.length; i++) {
        if (this.allitems[i].lbc_approved == 1) {
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
    }
  }
}
</script>
