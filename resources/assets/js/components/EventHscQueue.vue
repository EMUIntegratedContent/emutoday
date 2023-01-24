<template>
  <div class="row">
    <div class="col-xs-12 col-sm-8 col-md-6 col-lg-9">
      <form class="form-inline">
        <div class="form-group">
          <label for="start-date">Showing HSC events starting <span v-if="isEndDate">between</span><span v-else>on or after</span>
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
          <label for="start-date"> and
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

    <div class="col-md-4">
      <h3><span class="badge">{{ itemsNoPointsReviewed ? itemsNoPointsReviewed.length : 0 }}</span> No Eagle Rewards
        Points | Reviewed</h3>
      <div id="items-reviewed">
        <event-queue-item
            pid="items-nopointsrev"
            v-for="(item, i) in itemsNoPointsReviewed"
            :item="item"
            :index="i"
            :key="'items-nopointsrev-'+i+'-'+counter"
            @item-updated="counter++"
        >
        </event-queue-item>
      </div>
    </div><!-- /.col-md-6 -->

    <div class="col-md-4">
      <h3><span class="badge">{{ itemsNoPoints ? itemsNoPoints.length : 0 }}</span> No Eagle Rewards Points</h3>
      <div>
        <event-queue-item
            pid="items-nopoints"
            v-for="(item, i) in itemsNoPoints"
            :item="item"
            :index="i"
            :key="'items-nopoints-'+i+'-'+counter"
            @item-updated="counter++"
        >
        </event-queue-item>
      </div>
    </div>

    <div class="col-md-4">
      <h3><span class="badge">{{ itemsPoints ? itemsPoints.length : 0 }}</span> Has Eagle Rewards Points <i
          class="fa fa-check green"></i></h3>
      <div id="items-approved">
        <event-queue-item
            pid="items-haspts"
            v-for="(item, i) in itemsPoints"
            :item="item"
            :index="i"
            :key="'items-points-'+i+'-'+counter"
            @item-updated="counter++"
        >
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

#rangetoggle {
  color: #FF851B;
  margin-left: 5px;
  border-bottom: 2px #FF851B dotted;
}
</style>
<script>
import moment from 'moment';
import EventQueueItem from './EventHscQueueItem.vue'
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
      counter: 0,
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
  created() {
    let twoWeeksEarlier = moment().subtract(1, 'w')
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
    itemsPoints: function () {
      return this.allitems.filter(function (item) {
        return !(item.hsc_rewards == false || item.hsc_rewards == null || item.hsc_rewards == 0);
      });
    },
    itemsNoPoints: function () {
      return this.allitems.filter(function (item) {
        return (item.hsc_rewards == false || item.hsc_rewards == null || item.hsc_rewards == 0) && item.hsc_reviewed == 0;
      });
    },
    itemsNoPointsReviewed: function () {
      return this.allitems.filter(function (item) {
        return (item.hsc_rewards == false || item.hsc_rewards == null || item.hsc_rewards == 0) && item.hsc_reviewed == 1;
      });
    }
  },
  methods: {
    fetchAllRecords: function () {
      this.loading = true

      let routeurl = '/api/event/hscqueueload'
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
            this.loading = false
          }, () => {
          })
    },
    toggleRange: function () {
      if (this.isEndDate) {
        this.isEndDate = false
      } else {
        this.isEndDate = true
      }
    },
  },
  events: {}
}
</script>
