<template>

    <div class="row">
            <div class="col-md-4">
            <h3>Unapproved Events</h3>
                <div id="items-unapproved">
                    <event-queue-item
                    pid="items-unapproved"
                    v-for="item in itemsUnapproved | orderBy 'start_date' 1"
                    @item-change="moveToApproved"

                    :item="item"
                    :index="$index"
                    :is="unapproved-list">
                </event-queue-item>
                </div>
            </div><!-- /.col-md-6 -->
            <div class="col-md-4">
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
            </div><!-- /.col-md-6 -->
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
            </div><!-- /.col-md-6 -->
</div><!-- ./row -->
</template>
<style scoped>
#items-unapproved .box {
    margin-bottom: 4px;
}
#items-approved .box {
    margin-bottom: 4px;

}
</style>
<script>
import moment from 'moment';
    import EventQueueItem from './EventQueueItem.vue'
    // import EventViewContent from './EventViewContent.vue'
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
                return  this.filterItemsApproved(this.allitems);
            },
            itemsUnapproved:function() {
                return  this.filterItemsUnapproved(this.allitems);
            },
            itemsPromoted:function() {
                return  this.filterItemsPromoted(this.itemsApproved);
            },
            itemsLive:function() {
                return  this.filterItemsLive(this.allitems);
            }
        },
        methods : {
            fetchAllRecords: function() {
                this.$http.get('/api/event/queueload')
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
                // var unapprovedItems = this.allitems.filter(function(item) {
                // 	return item.approved === 0
                // });
                //
                // this.xitems = unapprovedItems;
                //
                //
                // var approvedItems = this.allitems.filter(function(item) {
                // 	return item.approved === 1
                // });
                //
                // this.items = approvedItems.sort(function(a,b){
                // 	return parseFloat(b.priority) - parseFloat(a.priority);
                // });

            },
            filterItemsApproved: function(items) {
                return items.filter(function(item) {
                    return moment(item.start_date_time).isAfter(moment()) && item.is_approved === 1 && item.priority === 0 && item.is_promoted === 0;  // true

                    // return item.is_approved === 1
                });
            },
            filterItemsUnapproved: function(items) {
                return items.filter(function(item) {
                    return item.is_approved === 0
                });
            },
            filterItemsPromoted: function(items) {
                return items.filter(function(item) {
                    return item.is_promoted === 1
                });
            },
            filterItemsLive: function(items) {
                return items.filter(function(item) {
                    return moment(item.start_date_time).isSameOrBefore(moment()) && item.is_approved === 1 || item.is_approved === 1 && item.priority > 0 || item.is_promoted === 1;  // true

                    // let thisDateTime = item.start_date + ' ' + item.start_time;
                    // return moment(thisDateTime, "YYYY-MM-DD h:mm A").isSameOrBefore(moment()) && item.is_approved === 1 || item.is_approved === 1 && item.priority > 0 || item.is_promoted === 1;  // true

                    // return moment(item.start_date).isAfter(moment())
                    // return item.live === 1
                });
            },
                    // checkIndexWithValue: function (chitem){
                    // 	return
                    // },

            moveToApproved: function(changeditem){

            // this.xitems.pop(changeditem);
                console.log('moveToApproved'+ changeditem.priority);
                changeditem.is_approved = 1;
                changeditem.priority = changeditem.priority;
                this.updateRecord(changeditem)
            },
            moveToUnApproved: function(changeditem){

            // this.xitems.pop(changeditem);
                console.log('moveToUnApproved'+ changeditem)
                changeditem.is_approved = 0;

                this.updateRecord(changeditem)
            },
            movedItemIndex: function(mid){
                return this.xitems.findIndex(item => item.id == mid)
            },
            updateRecord: function(item){
                var currentRecordId =  item.id;

                var currentRecord = item;
                this.$http.patch('/api/event/updateItem/' + item.id , item , {
                    method: 'PATCH'
                } )
                .then((response) => {
                    console.log('good_eventQueue'+ response)



                    //var movedIndex = this.movedItemIndex(movedid);
                                // this.xitems.pop(movedRecord);
                            // if (movedRecord.approved == 1) {
                            //         this.xitems.splice(movedIndex, 1);
                            //      this.items.push(movedRecord);
                            //  } else {
                            //      this.items.splice(movedIndex, 1);
                            //     this.xitems.push(movedRecord);
                            //  }

                    //console.log('movedIndex==='+ movedIndex)
                }, (response) => {
                    console.log('bad?'+ response)
                });
        },
        // fetchUnapprovedRecords: function(){
        //     this.$http.get('/api/event/unapprovedItems')
        //
        //         .then((response) =>{
        //             console.log('response.status=' + response.status);
        //             console.log('response.ok=' + response.ok);
        //             console.log('response.statusText=' + response.statusText);
        //             console.log('response.data=' + response.data);
        //
        //             this.$set('unappitems', response.data.data)
        //
        //             this.fetchApprovedRecords();
        //         }, (response) => {
        //             //error callback
        //             console.log("ERRORS");
        //
        //             //  this.formErrors =  response.data.error.message;
        //
        //         }).bind(this);
        // },
        // fetchApprovedRecords: function() {
        //     this.$http.get('/api/event/approvedItems')
        //
        //         .then((response) =>{
        //                 //response.status;
        //                 console.log('response.status=' + response.status);
        //                 console.log('response.ok=' + response.ok);
        //                 console.log('response.statusText=' + response.statusText);
        //                 console.log('response.data=' + response.data);
        //                 // data = response.data;
        //                 //
        //                 this.$set('allitems', response.data.data)
        //
        //                 // this.allitems = response.data.data;
        //                 // console.log('this.record= ' + this.record);
        //
        //                 this.checkOverDataFilter();
        //             }, (response) => {
        //                 //error callback
        //                 console.log("ERRORS");
        //
        //                 //  this.formErrors =  response.data.error.message;
        //
        //             }).bind(this);
        //     },
        //
        // fetchOtherRecords: function() {
        //     this.$http.get('/api/event/otherItems')
        //
        //         .then((response) =>{
        //                 //response.status;
        //                 console.log('response.status=' + response.status);
        //                 console.log('response.ok=' + response.ok);
        //                 console.log('response.statusText=' + response.statusText);
        //                 console.log('response.data=' + response.data);
        //                 // data = response.data;
        //                 //
        //                 this.$set('otheritems', response.data.data)
        //
        //                 // this.allitems = response.data.data;
        //                 // console.log('this.record= ' + this.record);
        //
        //                 this.checkOverDataFilter();
        //             }, (response) => {
        //                 //error callback
        //                 console.log("ERRORS");
        //
        //                 //  this.formErrors =  response.data.error.message;
        //
        //             }).bind(this);
        //         },
                checkOverData: function() {
                    console.log('this.items='+ this.allitems)
                    for (var i=0; i < this.allitems.length; i++ ) {
                        if( this.allitems[i].is_approved == 1) {
                            this.items.push(this.allitems.splice(i,1));
                        } else {
                            this.xitems.push(this.allitems.splice(i,1));
                        }
                    }

                },

        },


        // the `events` option simply calls `$on` for you
        // when the instance is created
        events: {
          // 'child-msg': function (msg) {
          //   // `this` in event callbacks are automatically bound
          //   // to the instance that registered it
          //   this.messages.push(msg)
          // }
        }
    }
</script>
