<template>
    <div class="row">
        <!-- Date Filter -->
        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-6">
            <form class="form-inline">
              <div class="form-group">
                  <label for="start-date">Showing <template v-if="this.stype == 'featurephoto'">photos</template><template v-else>stories</template> starting <span v-if="isEndDate">between</span><span v-else>on or after</span></label>
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
        <!-- TEXT filter -->
        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-3">
            <form class="form-inline" v-on:submit.prevent="">
              <div class="form-group">
                  <label for="search-filter">Search titles</label>
                  <input v-model="textFilter" id="search-filter" type="text" class="form-control">
              </div>
            </form>
        </div>
        <div v-if="canApprove" class="col-xs-12 col-sm-12 col-md-4 col-lg-3 text-right">
            <a class="btn btn-sm btn-default" href="/admin/archive/queue/stories"><i class="fa fa-archive"></i> Archived Stories</a>
        </div>
    </div>
    <hr />
    <div class="row">
        <h2 v-if="loading" class="col-md-12">Loading. Please Wait...</h2>
        <div class="col-md-4">
            <h4><span class="badge">{{ itemsUnapproved ? itemsUnapproved.length : 0 }}</span> Unapproved<p></p></h4>
            <div v-show="checkRoleAndQueueType" class="btn-toolbar" role="toolbar">
                <div class="btn-group btn-group-xs" role="group">
                    <label>Filter: </label>
                </div>
                <div class="btn-group btn-group-xs" role="group" aria-label="typeFiltersLabel" data-toggle="buttons" v-iconradio="items_unapproved_filter_storytype">
                     <template v-for="item in storyTypeIcons">
                         <label class="btn btn-default" data-toggle="tooltip" data-placement="top" title="{{item.name}}"><input type="radio" autocomplete="off" value="{{item.shortname}}" /><span class="item-type-icon-shrt" :class="typeIcon(item.shortname)"></span></label>
                    </template>
              </div>
            </div>
            <div id="items-unapproved">
                <story-pod
                    pid="items-unapproved"
                    :role="role"
                    :sroute="sroute"
                    :stype="stype"
                    :gtype="gtype"
                    :qtype="qtype"
                    v-for="item in itemsUnapproved | orderBy 'start_date' 1 | filterBy filterUnapprovedByStoryType"
                    @item-change="moveToApproved"

                    :item="item"
                    :index="$index"
                    :is="items-unapproved">
                </story-pod>
            </div>
    </div><!-- /.col-md-4 -->
    <div class="col-md-4">
        <h4><span class="badge">{{ itemsApproved ? itemsApproved.length : 0 }}</span> Approved</h4>
        <div v-show="checkRoleAndQueueType" class="btn-toolbar" role="toolbar">
            <div class="btn-group btn-group-xs" role="group">
                <label>Filter: </label>
            </div>
            <div class="btn-group btn-group-xs" role="group" aria-label="typeFiltersLabel" data-toggle="buttons" v-iconradio="items_approved_filter_storytype">
                 <template v-for="item in storyTypeIcons">
                     <label class="btn btn-default" data-toggle="tooltip" data-placement="top" title="{{item.name}}"><input type="radio" autocomplete="off" value="{{item.shortname}}" /><span class="item-type-icon-shrt" :class="typeIcon(item.shortname)"></span></label>
                </template>
          </div>
      </div>
        <div id="items-approved">
            <story-pod
                pid="items-approved"
                :role="role"
                :sroute="sroute"
                :stype="stype"
                :gtype="gtype"
                :qtype="qtype"
                v-for="item in itemsApproved | orderBy 'start_date' 1 | filterBy filterApprovedByStoryType"
                @item-change="moveToUnApproved"

                :item="item"
                :index="$index"
                :is="items-approved">
            </story-pod>
        </div>
    </div><!-- /.col-md-4 -->
    <div class="col-md-4">
        <div id="items-live">
          <!-- ELEVATED ANNOUNCEMENTS -->
          <template v-if="canElevate">
            <h3><span class="badge">{{ elevateditems ? elevateditems.length : 0 }}</span> Elevated (all story types)</h3>
            <p>To rearrange the order of stories, drag the pod to the desired location. To demote a story, click the red 'X' on the pod. Click "save order" button when done. Note: this list is NOT filtered by date.</p>
            <div v-show="ordersave.isOk"  class="alert alert-success alert-dismissible">
              <button @click.prevent="toggleCallout" class="btn btn-sm close"><i class="fa fa-times"></i></button>
              <h5>{{ordersave.msg}}</h5>
            </div>
            <div v-show="ordersave.isErr"  class="alert alert-danger alert-dismissible">
              <button @click.prevent="toggleCallout" class="btn btn-sm close"><i class="fa fa-times"></i></button>
              <h5>{{ordersave.msg}}</h5>
            </div>
            <template v-if="elevateditemschanged">
              <div class="ordersave-container">
                <button @click="updateElevatedOrder" class="btn btn-info">Save Order</button>
                <button @click="resetElevatedOrder" class="btn btn-default">Reset</button>
              </div>
            </template>
            <template v-if="elevateditems.length > 0">
              <ul class="list-group" v-sortable="{ onUpdate: updateOrder }">
                <li v-for="item in elevateditems" class="list-group-item">
                  <story-pod
                      pid="item-elevated"
                      :role="role"
                      :sroute="sroute"
                      :stype="stype"
                      :gtype="gtype"
                      :qtype="qtype"
                      :item="item"
                      :is="item-elevated"
                      >
                  </story-pod>
                </li>
              </ul>
            </template>
            <template v-else>
              <p>There are no elevated stories.</p>
            </template>
          </template>
          <hr /> <!-- End elevated announcements -->
          <h4><span class="badge">{{ itemsLive ? itemsLive.length : 0 }}</span> Live <small>Approved and Start Date has passed</small></h4>
          <div v-show="checkRoleAndQueueType" class="btn-toolbar" role="toolbar">
              <div class="btn-group btn-group-xs" role="group">
                  <label>Filter: </label>
              </div>
              <div class="btn-group btn-group-xs" role="group" aria-label="typeFiltersLabel" data-toggle="buttons" v-iconradio="items_live_filter_storytype">
                   <template v-for="item in storyTypeIcons">
                       <label class="btn btn-default" data-toggle="tooltip" data-placement="top" title="{{item.name}}"><input type="radio" autocomplete="off" value="{{item.shortname}}" /><span class="item-type-icon-shrt" :class="typeIcon(item.shortname)"></span></label>
                  </template>
            </div>
          </div>
          <story-pod
              pid="items-live"
              :role="role"
              :sroute="sroute"
              :stype="stype"
              :gtype="gtype"
              :qtype="qtype"
              v-for="item in itemsLive | orderBy 'start_date' -1 | filterBy filterLiveByStoryType"
              @item-change="moveToUnApproved"
              :elevated-storys="elevateditems"
              :item="item"
              :index="$index"
              :is="items-live">
          </story-pod>
      </div>
    </div><!-- /.col-md-4 -->
</div><!-- ./row -->
</template>
<style scoped>

    h4 {
        margin-top: 3px;
        font-size: 18px;
    }
    .btn-default:active, .btn-default.active, .open > .dropdown-toggle.btn-default {
        background-color: #605ca8;
        color: #ffffff;

    }
    .btn-default:active, .btn-default.active, .open > .dropdown-toggle.btn-default {
        color: #ffffff;
    }

    span.item-type-icon:active, span.item-type-icon.active{
        background-color: #605ca8;
        color: #ffffff;
    }
    #items-unapproved .box {
        margin-bottom: 4px;
    }
    #items-approved .box {
        margin-bottom: 4px;

    }
    #items-live .box {
        margin-bottom: 4px;

    }
    #rangetoggle{
        color: #FF851B;
        margin-left: 5px;
        border-bottom: 2px #FF851B dotted;
    }
    .ordersave-container{
      margin-bottom:10px;
    }
</style>
<script>

import moment from 'moment'
import StoryPod from './StoryPod.vue'
import IconToggleBtn from './IconToggleBtn.vue'
import iconradio from '../directives/iconradio.js'
import Pagination from './Pagination.vue'
import flatpickr from "../directives/flatpickr.js"

export default  {
    directives: {iconradio, flatpickr},
    components: {StoryPod,IconToggleBtn,Pagination},
    props: ['stypes','stype','sroute','qtype','gtype','cuser','role'],
    created(){
    },
    ready() {
        let twoWeeksEarlier = moment().subtract(2, 'w')
        this.startdate = twoWeeksEarlier.format("YYYY-MM-DD")
        this.enddate = twoWeeksEarlier.clone().add(4, 'w').format("YYYY-MM-DD")
        this.fetchAllRecords()
    },
    data: function() {
        return {
            readyStatus: '',
            singleStype: false,
            storytype:'',
            items_unapproved_filter_storytype: '',
            items_approved_filter_storytype: '',
            items_live_filter_storytype: '',
            storytype_approved: '',
            changestorytype:'',
            currentDate: moment(),
            allitems: [],
            elevateditems: [],
            originalelevateditems: [],
            items: [],
            xitems: [],
            items_unapproved_filtered: [],
            items_unapproved: [],
            items_approved: [],
            items_live: [],
            currentTypesFilter: [],
            loading: true,
            eventMsg: null,
            startdate: null,
            enddate: null,
            isEndDate: false,
            elevateditemschanged: false,
            ordersave: {
              isOk: false,
              isErr: false,
              msg: '',
            },
            textFilter:'',
        }
    },
    computed: {
        checkRoleAndQueueType:function() {
            if (this.role === 'admin' || this.role === 'admin_super'){
                if(this.qtype === 'queueall'){
                    return true
                } else {
                    return false
                }
            } else {
                return false
            }
        },
        canApprove: function(){
          if (this.role === 'admin' || this.role === 'admin_super' || this.role === 'contributor_2' || this.role === 'editor'){
              return true
          }
          return false
        },
        canElevate: function(){
          if (this.role === 'admin' || this.role === 'admin_super' || this.role === 'editor'){
              return true
          }
          return false
        },
        s_types:function(){
           // var data = localStorage[key];
              try {
                //   this.singleStype = false;
                  return JSON.parse(this.stypes);
              } catch(e) {
                //   this.singleStype = true;
                  // this.record.story_type = this.stypes;
                  return this.stypes;
              }
        },

        storyTypeIcons:function() {
            if (this.isString(this.s_types)){
                return [
                    {
                    name: 'all',
                    shortname: ''
                    },
                    {
                    name: 'none',
                    shortname: 'x'
                    }
                ]
            } else {
                this.s_types.push({
                    name: 'all',
                    shortname: ''
                })
                return this.s_types;
            }
        },
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
    methods : {
        toggleRange: function(){
            if(this.isEndDate){
                this.isEndDate = false
            } else {
                this.isEndDate = true
            }
        },
        isString: function(val){
            return toString.call(val) === "[object String]";
        },
        filerStoryTypeCustom: function (value) {
            var regexp = new RegExp(this.textFilter, 'gi'); // anywhere in the string, ignore case

            if (this.storytype === '') {
                return value.story_type !== '' && regexp.test(value.title)
            } else {
                return value.story_type === this.storytype && regexp.test(value.title)
            }
        },
        changeFilterByReadyStatus: function(evnt){
            if (this.readyStatus == ''){
                this.resetReadyStatus();
            } else {
                this.filterReadyStatus();
            }
        },
        filterUnapprovedByStoryType: function (value) {
            var regexp = new RegExp(this.textFilter, 'gi'); // anywhere in the string, ignore case

            if (this.items_unapproved_filter_storytype === '') {
                return value.story_type !== '' && regexp.test(value.title);
            } else {
                return value.story_type === this.items_unapproved_filter_storytype && regexp.test(value.title);
            }
        },
        filterApprovedByStoryType: function (value) {
            var regexp = new RegExp(this.textFilter, 'gi'); // anywhere in the string, ignore case

            if (this.items_approved_filter_storytype === '') {
                return value.story_type !== '' && regexp.test(value.title);
            } else {
                return value.story_type === this.items_approved_filter_storytype && regexp.test(value.title);
            }
        },

        filterLiveByStoryType: function (value) {
            var regexp = new RegExp(this.textFilter, 'gi'); // anywhere in the string, ignore case

            if (this.items_live_filter_storytype === '') {
                return value.story_type !== '' && regexp.test(value.title);
            } else {
                return value.story_type === this.items_live_filter_storytype && regexp.test(value.title);
            }
        },

        onCalendarChange: function(){
            // flatpickr directive method
        },

        typeIcon: function(sname) {
            switch (sname) {
                case 'emutoday':
                case 'story':
                faicon = 'fa-file-image-o'
                break
                case 'news':
                faicon = 'fa-file-text-o'
                break
                case 'student':
                faicon = 'fa-graduation-cap'
                break
                case 'external':
                faicon = 'fa-external-link'
                break
                case 'article':
                faicon = 'fa-newspaper-o'
                break
                case '':
                faicon = 'fa-asterisk'
                break
                case 'advisory':
                faicon = 'fa-warning'
                break
                case 'statement':
                faicon = 'fa-commenting'
                break
                case 'featurephoto':
                faicon = 'fa-camera-retro'
                break
                default:
                faicon = 'fa-file-o'
                break
            }
            return 'fa '+ faicon + ' fa-fw'
        },

        movedItemIndex: function(mid) {
            return this.items_unapproved.findIndex(item => item.id == mid)
        },
        moveToApproved: function(changeditem){
            let movedid =  changeditem.id;
            let movedRecord = changeditem;
            let movedIndex = this.movedItemIndex(movedid);

            if (movedRecord.is_approved === 1) {
                this.items_unapproved.splice(movedIndex, 1);
                this.items_approved.push(movedRecord);
            } else {
                this.items_approved.splice(movedIndex, 1);
                this.items_unapproved.push(movedRecord);
            }
        },
        moveToUnApproved: function(changeditem){
            changeditem.is_approved = 0;

            this.updateRecord(changeditem)
        },
        filterItemsApproved: function(items) {
            return items.filter(function(item) {
                return moment(item.start_date).isAfter(moment()) && item.is_approved === 1 && item.is_archived === 0;
            });
        },
        filterItemsUnapproved: function(items) {
            return items.filter(function(item) {
                return item.is_approved === 0 && item.is_archived === 0;
            });
        },
        filterItemsLive: function(items) {
            return items.filter(function(item) {
                return moment(item.start_date).isSameOrBefore(moment()) && item.is_approved === 1 && item.is_archived === 0;  // true
            });
        },
        movedItemIndex: function(mid){
            return this.xitems.findIndex(item => item.id == mid)
        },
        updateRecord: function(item){
            var currentRecordId =  item.id;
            item.start_date =  moment(item.start_date, "MM-DD-YYYY").format("YYYY-MM-DD")

            var currentRecord = item;
            this.$http.patch('/api/story/' + item.id , item , {
                method: 'PATCH'
            } )
            .then((response) => {
            }, (response) => {
            });
        },

        fetchAllRecords: function() {
            this.loading = true

            var routeurl = '/api/'+ this.gtype + '/'+ this.stype + '/'+ this.qtype;
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
                this.loading = false;
            }, (response) => {
                //error callback
                console.log("ERRORS");
            }).bind(this);

            this.fetchElevatedRecords(); //get elevated records regardless of date
        },

        /**
         * Get elevated records REGARDLESS of date range!
         */
        fetchElevatedRecords: function(){
          this.loading = true

          var routeurl = '/api/story/elevated';
          this.$http.get(routeurl)

          .then((response) =>{
              this.$set('elevateditems', response.data.data)
              this.loading = false;
          }, (response) => {
              //error callback
              console.log("ERRORS");
          }).bind(this);
        },

        /**
         * Uses vue-sortable
         */
         updateOrder: function(eventItem){
           // Save the original order the first time this method is called
           if(!this.elevateditemschanged){
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
         * Change the priority ranking of elevated stories in the database
         */
         updateElevatedOrder: function(){
           this.ordersave.isOk = false
           this.ordersave.isErr = false

           var routeurl = '/api/story/elevated/reorder'
           this.$http.put(routeurl, this.elevateditems)

           .then((response) =>{
               this.$set('elevateditems', response.data.data)
               this.ordersave.isOk = true
               this.ordersave.msg = "Order was updated"
           }, (response) => {
               //error callback
               this.ordersave.isErr = true
               this.ordersave.msg = "Order was not updated"
               console.log("ERRORS")
           }).bind(this);

           this.elevateditemschanged = false;
         },

         toggleCallout:function(evt){
           this.ordersave.isOk = false
           this.ordersave.isErr = false
         },

         resetElevatedOrder: function(){
           this.elevateditems = this.originalelevateditems
           this.originalelevateditems = [];
           this.elevateditemschanged = false
         },
    },
    filters: {
        byObject: function(array, options) {
            var entry, found, i, key, len, result, value;
            result = [];

            if (Object.keys(options).length === 0) {
              return array;
            }
            for (i = 0, len = array.length; i < len; i++) {
              entry = array[i];
              found = true;
              for (key in options) {
                value = options[key];

                if(value === ''){
                    break;
                }

                if (entry[key] !== value) {
                  found = false;
                  break;
                }
              }
              if (found) {
                result.push(entry);
              }
            }
            return result;
          }
    },

    events: {
      'story-elevated': function (storyObj) {
        if(storyObj){
          this.elevateditems.push(storyObj)
          this.updateElevatedOrder()
        }
      },
      'story-demoted': function (storyId) {
        for(i = 0; i < this.elevateditems.length; i++){
          if(storyId == this.elevateditems[i].id){
            this.elevateditems.$remove(this.elevateditems[i])
            this.updateElevatedOrder()
          }
        }
      },
    }
}
</script>
