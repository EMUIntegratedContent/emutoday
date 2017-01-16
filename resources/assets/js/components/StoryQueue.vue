<template>
    <div class="row">
        <h2 v-if="loading" class="col-md-12">Loading. Please Wait...</h2>
        <div class="col-md-4">
            <h4>Unapproved<p></p></h4>
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
        <h4>Approved</h4>
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
        <h4>Live <small>Approved and Start Date has passed</small></h4>
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
        <div id="items-live">
            <story-pod
                pid="items-live"
                :sroute="sroute"
                :stype="stype"
                :gtype="gtype"
                :qtype="qtype"
                v-for="item in itemsLive | orderBy 'priority' -1 | filterBy filterLiveByStoryType"
                @item-change="moveToUnApproved"

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
</style>
<script>

import moment from 'moment'
import StoryPod from './StoryPod.vue'
import IconToggleBtn from './IconToggleBtn.vue'
import iconradio from '../directives/iconradio.js'
// import EventViewContent from './EventViewContent.vue'
export default  {
    directives: {iconradio},
    components: {StoryPod,IconToggleBtn},
    props: ['stypes','stype','sroute','qtype','gtype','cuser','role'],
    created(){
        // this.currentDate = moment().format();
    },
    ready() {
        this.loading = true;
        this.fetchAllRecords();
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
            items: [],
            xitems: [],
            items_unapproved_filtered: [],
            items_unapproved: [],
            items_approved: [],
            items_live: [],
            currentTypesFilter: [],
            loading: true,
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
        isString: function(val){
            return toString.call(val) === "[object String]";
        },
        filerStoryTypeCustom: function (value) {
            console.log('value' + value.story_type + 'stmodel=' + this.storytype)
            if (this.storytype === '') {
                return value.story_type !== '';
            } else {
                return value.story_type === this.storytype;
            }

            // return  moment(value).format("ddd")
        },
        changeFilterByReadyStatus: function(evnt){
            if (this.readyStatus == ''){
                this.resetReadyStatus();
            } else {
                this.filterReadyStatus();
            }
        },
        // filterReadyStatus: function(){
        //     this.itemsUnapproved = this.itemsUnapproved.filter(function(item){
        //         console.log('item.is_ready= ' + item.is_ready);
        //         return item.is_ready === this.readyStatus;
        //     })
        // },
        // resetReadyStatus: function(){
        //     this.itemsUnapproved = this.itemsUnapproved.filter(function(item){
        //         console.log('item.is_ready= ' + item.is_ready);
        //         return item.is_ready !== '';
        //     })
        // },
        filterUnapprovedByStoryType: function (value) {
            console.log('value' + value.story_type + 'stmodel=' + this.items_unapproved_filter_storytype)
            if (this.items_unapproved_filter_storytype === '') {
                return value.story_type !== '';
            } else {
                return value.story_type === this.items_unapproved_filter_storytype;
            }
        },
        // filterUnapprovedByValues: function (value) {
        //     console.log('value.story_type= ' + value.story_type + ' value.is_ready= ' + value.is_ready + ' storytype= ' + this.items_unapproved_filter_storytype  + ' is_ready= ' + this.items_unapproved_filter_isready)
        //     let resetType,resetIsReady
        //     resetType = (this.items_unapproved_filter_storytype === '')?true:false;
        //     resetIsReady = (this.items_unapproved_filter_isready === '')?true:false;
        //     if (resetType)
        //     if (this.items_unapproved_filter_storytype === '' && this.items_unapproved_filter_isready === '') {
        //         return value.story_type !== '' && value.is_ready !== '';
        //     } else if (this.items_unapproved_filter_storytype === '' && this.items_unapproved_filter_isready !== '') {
        //         return value.story_type !== '' && value.is_ready === this.items_unapproved_filter_isready
        //     } else if (this.items_unapproved_filter_storytype !== '' && this.items_unapproved_filter_isready === '') {
        //         return value.story_type === this.items_unapproved_filter_storytype && value.is_ready !== ''
        //     }else {
        //         return value.story_type === this.items_unapproved_filter_storytype && value.is_ready === this.items_unapproved_filter_isready
        //
        //     }
        // },
        filterApprovedByStoryType: function (value) {
            console.log('value' + value.story_type + 'stmodel=' + this.items_approved_filter_storytype)
            if (this.items_approved_filter_storytype === '') {
                return value.story_type !== '';
            } else {
                return value.story_type === this.items_approved_filter_storytype;
            }
        },

        filterLiveByStoryType: function (value) {
            console.log('value' + value.story_type + 'stmodel=' + this.items_live_filter_storytype)
            if (this.items_live_filter_storytype === '') {
                return value.story_type !== '';
            } else {
                return value.story_type === this.items_live_filter_storytype;
            }
        },
        // storyTypeFilter:function (val, arg){
        //     if (val == '' || val == 'all'){
        //         return val.storytype !== '';
        //     } else {
        //         return val.storytype === arg;
        //     }
        //
        //
        // },

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
                faicon = 'fa-file-o'
                break
                case 'article':
                faicon = 'fa-newspaper-o'
                break
                case '':
                faicon = 'fa-asterisk'
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

            // var movedIndex = this.items_unapproved.findIndex(item => item.id == mid)
            console.log('movedid'+movedid +  'movedIndex'+movedIndex)
            if (movedRecord.is_approved === 1) {
                this.items_unapproved.splice(movedIndex, 1);
                this.items_approved.push(movedRecord);
            } else {
                this.items_approved.splice(movedIndex, 1);
                this.items_unapproved.push(movedRecord);
            }
        },
        moveToUnApproved: function(changeditem){

            // this.xitems.pop(changeditem);
            console.log('moveToUnApproved'+ changeditem)
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
                console.log('good?'+ response)

            }, (response) => {
                console.log('bad?'+ response)
            });
    },

        fetchAllRecords: function() {
            let routeurl = '/api/'+ this.gtype + '/'+ this.stype + '/'+ this.qtype;

            // if (this.isString(this.s_types)){
            //     routeurl = '/api/story/queueload/'+ this.stypes;
            // } else {
            //     routeurl = '/api/story/queueload/all';
            // }
            this.$http.get(routeurl)

            .then((response) =>{
                this.$set('allitems', response.data.data)
                this.loading = false;
            }, (response) => {
                //error callback
                console.log("ERRORS");
            }).bind(this);
        },
        // checkOverData: function() {
        //     console.log('this.items='+ this.allitems)
        //
        //
        // },

        // checkOverDataFilter: function() {
        //     let self = this;
        //     console.log('items=' + this.allitems)
        //
        //     this.allitems.forEach(function(item) {
        //     if (item.is_approved === 1) {
        //         self.items_approved.push(item)
        //     } else {
        //         self.items_unapproved.push(item)
        //     }
        //
        // });
        // console.log('items_unapproved'+ this.items_unapproved.length )
        // console.log('items_approved'+ this.items_approved.length )
        // }
    },
    filters: {
        // titleDay: function (value) {
        //     return  moment(value).format("ddd")
        // },
        byObject: function(array, options) {
            var entry, found, i, key, len, result, value;
            result = [];
            console.log(options);
            if (Object.keys(options).length === 0) {
              return array;
            }
            for (i = 0, len = array.length; i < len; i++) {
              entry = array[i];
              found = true;
              for (key in options) {
                value = options[key];
                console.log('options[key]=' + options[key])
                if(value === ''){
                    break;
                }
                console.log('entry[key]= ' + entry[key]);
                if (entry[key] !== value) {
                  found = false;
                  break;
                }


              }
              if (found) {
                result.push(entry);
              }
            }
            console.log(result);
            return result;
          }
    },

    events: {

    }
}
</script>
