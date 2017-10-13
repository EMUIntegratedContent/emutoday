<template>
    <div class="row">
        <div class="col-xs-12 col-sm-8 col-md-6 col-lg-9">
          <p>You will only be presented stories that are:</p>
          <ol>
            <li>Approved</li>
            <li>Not archived</li>
            <li>Flagged as "Ready"</li>
          </ol>
        </div>
    </div>
    <hr />
    <div class="row">
        <div class="col-md-12">
            <h3>Side Stories</h3>
            <template v-if="!loadingUsed">
              <template v-if="usedStories.length > 0">
                <ul class="list-group" v-sortable>
                    <li v-for="story in usedStories" class="list-group-item">
                      <email-story-pod
                          pid="otherstory-list-stories"
                          pod-type="otherstory"
                          :item="story"
                          >
                      </email-story-pod>
                    </li>
                </ul>
              </template>
              <template v-else>
                <p>There are no side stories set for this email.</p>
              </template>
            </template>
            <template v-else>
              <p>Loading this email's stories. Please wait...</p>
            </template>
            <hr />
            <!-- Date filter -->
            <form class="form-inline">
              <div class="form-group">
                  <label for="start-date">Starting <span v-if="isEndDate">between</span><span v-else>on or after</span></label>
                  <p><input v-if="startdate" v-model="startdate" type="text" :initval="startdate" v-flatpickr="startdate"></p>
              </div>
              <div v-if="isEndDate" class="form-group">
                  <label for="start-date"> and </label>
                  <p><input v-if="enddate" type="text" :initval="enddate" v-flatpickr="enddate"><p>
              </div>
              <p><button type="button" class="btn btn-sm btn-info" @click="fetchAllRecords">Filter</button></p>
              <p><a href="#" id="rangetoggle" @click="toggleRange"><span v-if="isEndDate"> - Remove </span><span v-else> + Add </span>Range</a></p>
            </form>
            <div class="btn-toolbar" role="toolbar">
                <div class="btn-group btn-group-xs" role="group">
                    <label>Filter: </label>
                </div>
                <div class="btn-group btn-group-xs" role="group" aria-label="typeFiltersLabel" data-toggle="buttons" v-iconradio="stories_filter_storytype">
                     <template v-for="item in storyTypeIcons">
                         <label class="btn btn-default" data-toggle="tooltip" data-placement="top" title="{{item.name}}"><input type="radio" autocomplete="off" value="{{item.shortname}}" /><span class="item-type-icon-shrt" :class="typeIcon(item.shortname)"></span></label>
                    </template>
                </div>
            </div>
            <div id="email-stories">
              <template v-if="!loadingQueue">
                <template v-if="queueStories.length > 0">
                  <email-story-pod
                      pid="otherstory-queue-stories"
                      pod-type="otherstoryqueue"
                      :item="story"
                      :other-stories="usedStories"
                      v-for="story in queueStories | filterBy filterByStoryType | paginate"
                  >
                  </email-story-pod>
                  <ul class="pagination">
                    <li v-bind:class="{disabled: (currentPage <= 0)}" class="page-item">
                      <a href="#" @click.prevent="setPage(currentPage-1)" class="page-link" tabindex="-1">Previous</a>
                    </li>
                    <li v-for="pageNumber in totalPages" :class="{active: pageNumber == currentPage}" class="page-item">
                      <a class="page-link" href="#" @click.prevent="setPage(pageNumber)">{{ pageNumber+1 }} <span v-if="pageNumber == currentPage" class="sr-only">(current)</span></a>
                    </li>
                    <li v-bind:class="{disabled: (currentPage == totalPages-1)}" class="page-item">
                      <a class="page-link" @click.prevent="setPage(currentPage+1)" href="#">Next</a>
                    </li>
                  </ul>
                </template>
                <template v-else>
                  <p>There are no stories for the date range you've specified.</p>
                </template>
              </template>
              <template v-else>
                <p>Loading queue. Please Wait...</p>
              </template>
            </div>
        </div><!-- /.col-md-12 -->
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

    #rangetoggle{
        color: #FF851B;
        margin-left: 5px;
        border-bottom: 2px #FF851B dotted;
    }
</style>
<script>

import moment from 'moment'
import EmailStoryPod from './EmailStoryPod.vue'
import IconToggleBtn from '../IconToggleBtn.vue'
import iconradio from '../../directives/iconradio.js'
import Pagination from '../Pagination.vue'
import flatpickr from "../../directives/flatpickr.js"

export default  {
    directives: {iconradio, flatpickr},
    components: {EmailStoryPod,IconToggleBtn,Pagination},
    props: ['stypes','mainStory','otherStories'],
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
            stories_filter_storytype: '',
            currentDate: moment(),
            usedStories: [],
            queueStories: [],
            loadingQueue: true,
            loadingUsed: true,
            eventMsg: null,
            startdate: null,
            enddate: null,
            isEndDate: false,
            currentPage: 1,
            itemsPerPage: 10,
            resultCount: 0,
        }
    },
    computed: {
        totalPages: function() {
          return Math.ceil(this.queueStories.length / this.itemsPerPage)
        },
        s_types:function(){
            try {
                return JSON.parse(this.stypes);
            } catch(e) {
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
    },
    methods : {
      toggleRange: function(){
          if(this.isEndDate){
              this.isEndDate = false
          } else {
              this.isEndDate = true
          }
      },
      filterByStoryType: function (value) {
          if (this.stories_filter_storytype === '') {
              return value.story_type !== '';
          } else {
              return value.story_type === this.stories_filter_storytype;
          }
      },
      isString: function(val){
          return toString.call(val) === "[object String]";
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
              default:
              faicon = 'fa-file-o'
              break
          }
          return 'fa '+ faicon + ' fa-fw'
      },

      fetchAllRecords: function() {
          this.loadingQueue = true

          var routeurl = '/api/email/stories/otherstories';

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
              this.$set('queueStories', response.data.newdata.data)
              this.resultCount = this.queueStories.length
              this.loadingQueue = false;
          }, (response) => {
              //error callback
              console.log("ERRORS");
          }).bind(this);
      },

      setPage: function(pageNumber) {
        if(pageNumber > -1 && pageNumber < this.totalPages){
          this.currentPage = pageNumber
        }
      },

      onCalendarChange: function(){
          // flatpickr directive method
      },
    },
    filters: {
      paginate: function(list) {
        // only run if there are items in the list
        if(list.length == 0){
          return
        }
          this.resultCount = list.length
          if (this.currentPage >= this.totalPages) {
            this.currentPage = this.totalPages - 1
          }
          var index = this.currentPage * this.itemsPerPage
          return list.slice(index, index + this.itemsPerPage)
      },

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
    },
    watch: {
      otherStories: function (value) {
        // set events from property to data
        this.usedStories = value
        this.loadingUsed = false
      }
    },
}
</script>
