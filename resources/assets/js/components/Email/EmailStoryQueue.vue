<template>
    <div class="row">
        <div class="col-xs-12 col-sm-8 col-md-6 col-lg-9">
          <p>You will only be presented stories that are:</p>
          <ol>
            <li>Approved</li>
            <li>Not archived</li>
            <li>Flagged as "Ready"</li>
            <li>Have a photo of type emutoday_email</li>
          </ol>
        </div>
    </div>
    <hr />
    <div class="row">
        <div class="col-md-12">
            <h3>Main Story</h3>
            <div v-if="mainStory.id" class="row">
                <div class="col-md-12">
                  <email-story-pod
                      pid="main-story-item"
                      :main-story-id="mainStory.id"
                      pod-type="mainstory"
                      :item="mainStory">
                  </email-story-pod>
                </div>
            </div>
            <p v-else>No main story set for this emails. Choose one from the queue below.</p>
            <p v-if="loading" class="col-md-12">Loading. Please Wait...</p>
            <hr/>
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
                <div class="btn-group btn-group-xs" role="group" aria-label="typeFiltersLabel" data-toggle="buttons" v-iconradio="items_filter_storytype">
                     <template v-for="item in storyTypeIcons">
                         <label class="btn btn-default" data-toggle="tooltip" data-placement="top" title="{{item.name}}"><input type="radio" autocomplete="off" value="{{item.shortname}}" /><span class="item-type-icon-shrt" :class="typeIcon(item.shortname)"></span></label>
                    </template>
                </div>
            </div>
            <div id="email-items">
                <email-story-pod
                    pid="email-items"
                    :main-story-id="mainStory.id"
                    pod-type="queue"
                    v-for="item in items | orderBy 'start_date' 1 | filterBy filterByStoryType | paginate"
                    :item="item">
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
    props: ['stypes','mainStory'],
    created(){
    },
    ready() {
        let twoWeeksEarlier = moment().subtract(12, 'w')
        this.startdate = twoWeeksEarlier.format("YYYY-MM-DD")
        this.enddate = twoWeeksEarlier.clone().add(4, 'w').format("YYYY-MM-DD")
        this.fetchAllRecords()
    },
    data: function() {
        return {
            items_filter_storytype: '',
            currentDate: moment(),
            items: [],
            loading: true,
            eventMsg: null,
            startdate: null,
            enddate: null,
            isEndDate: false,
            currentPage: 1,
            itemsPerPage: 10,
            resultCount: 0
        }
    },
    computed: {
        totalPages: function() {
          return Math.ceil(this.items.length / this.itemsPerPage)
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
          if (this.items_filter_storytype === '') {
              return value.story_type !== '';
          } else {
              return value.story_type === this.items_filter_storytype;
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
          this.loading = true

          var routeurl = '/api/email/stories';

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
              this.$set('items', response.data.newdata.data)
              this.resultCount = this.items.length
              this.loading = false;
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

    }
}
</script>
