<template>
  <div class="row">
    <div class="col-md-6">
      <h3>Unapproved Events</h3>
      <div id="items-approved">
        <event-queue-item

        pid="items-approved"
        v-for="item in itemsUnapproved | orderBy 'start_date' 1"
        @item-change="moveToApproved"
        :item="item"
        :index="$index"
        :is="approved-list">
        </event-queue-item>
      </div>
    </div><!-- /.col-md-6 -->

    <div class="col-md-6">
      <h3>Approved Events</h3>
      <div id="items-approved">
        <event-queue-item

        pid="items-approved"
        v-for="item in itemsApproved | orderBy 'start_date' 1"
        @item-change="moveToUnApproved"
        :item="item"
        :index="$index"
        :is="approved-list">
        </event-queue-item>
      </div>
    </div>
  </div><!-- /.col-md-6 -->
</template>

<!--
<div class="col-md-4">
  <h3>Live Events</h3>
  <div id="items-live">
    <event-queue-item
    pid="items-live"
    v-for="item in itemsLive | orderBy 'priority' -1"
    @item-change="moveToUnApproved"
    :item="item"
    :index="$index"
    :is="other-list">
  </event-queue-item>
</div>
-->
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
</style>
<script>
import moment from 'moment';
import EventQueueItem from './EventLbcQueueItem.vue'

export default  {
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
      objs: {}
    }
  },
  ready() {
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
      this.$http.get('/api/event/lbcqueueload')
      .then((response) =>{
        //response.status;
        console.log('response.status=' + response.status);
        console.log('response.ok=' + response.ok);
        console.log('response.statusText=' + response.statusText);
        console.log('response.data=' + response.data);
        this.$set('allitems', response.data.data)
        this.checkOverDataFilter();
      }, (response) => {
        //error callback
        console.log("ERRORS");
      }).bind(this);
    },
    checkOverDataFilter: function() {
      console.log('items=' + this.items)
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
  },
  events: {
  }
}
</script>
