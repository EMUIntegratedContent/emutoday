<style scoped>

#items-unapproved .box {
  margin-bottom: 4px;
}

#items-approved .box {
  margin-bottom: 4px;
}

</style>

<template>
  <div class="row">
    <div class="col-md-4">
      <h3>Unapproved</h3>
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
  </div>
<!-- ./row -->

</template>

<script>
import moment from 'moment';
import AnnouncementQueueItem from './AnnouncementQueueItem.vue'
// import EventViewContent from './EventViewContent.vue'
export default {
  components: {AnnouncementQueueItem},
  props: ['atype','cuser'],
  data: function() {
    return {
      resource: {},
      allitems: [],
      items: [],
      xitems: [],
      objs: {}
    }
  },


  ready() {
    this.fetchAllRecords();
  },

  computed: {
  },

  methods: {
    fetchAllRecords: function() {
      let route = '/api/announcement/queueload/' + this.atype;

      this.$http.get(route)

      .then((response) => {
        this.$set('allitems', response.data.data)
      }, (response) => {
        //error callback
        console.log("ERRORS");

      }).bind(this);
    },
  },


  // the `events` option simply calls `$on` for you
  // when the instance is created
  events: {
  }
}

</script>
