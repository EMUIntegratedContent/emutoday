<template>
  <div>
    <div class="row">
        <div class="col-xs-12 col-sm-8 col-md-6 col-lg-9">
          <p>You will only be presented stories that are:</p>
          <ol>
            <li>Approved</li>
            <li>Not archived</li>
            <li>Flagged as "Ready"</li>
            <li>Have a photo of type emutoday_email</li>
          </ol>
          <ul>
            <li>The <strong>top story</strong> image comes from the <mark>emutoday_email</mark> image type as defined in the story's admin area.</li>
            <li>The <strong>sub-main</strong> images come from the <mark>emutoday_small</mark> image type as defined in the story's admin area.</li>
            <li>For the main and both sub-main stories, the <strong>story title</strong> comes from the <mark>"Title/Header"</mark> field in the story's <mark>emutoday_email</mark> image editor area, while the <strong>subtext</strong> comes from the <mark>"Teaser/Byline"</mark> field of that same area.</li>
          </ul>
        </div>
    </div>
    <hr />
    <div class="row">
        <div class="col-md-12">
            <h3>Main Stories</h3>
            <template v-if="!loadingUsed">
              <template v-if="usedStories.length > 0">
                <draggable v-model="usedStories" @start="drag=true" @end="drag=false" @change="updateOrder">
                  <email-story-pod
                      pid="main-story-item"
                      v-for="(story, index) in usedStories"
                      pod-type="mainstory"
                      :item="story"
                      :key="'used-story-draggable-' + index"
                      @main-story-added="handleMainStoryAdded"
                      @main-story-removed="handleMainStoryRemoved"
                  >
                  </email-story-pod>
                </draggable>
              </template>
              <template v-else>
                <p>There are no side stories set for this email.</p>
              </template>
            </template>
            <template v-else>
              <p>Loading this email's stories. Please wait...</p>
            </template>
            <hr/>
            <!-- Date filter -->
            <form class="form-inline">
              <div class="form-group">
                  <label for="start-date">Starting <span v-if="isEndDate">between</span><span v-else>on or after</span></label>
<!--                  <p><input v-if="startdate" v-model="startdate" type="text" :initval="startdate" v-flatpickr="startdate"></p>-->
                  <p>
                    <date-picker
                        id="start-date"
                        v-if="startdate"
                        v-model="startdate"
                        value-type="YYYY-MM-DD"
                        format="MM/DD/YYYY"
                        :clearable="false"
                    ></date-picker>
                  </p>
              </div>
              <div v-if="isEndDate" class="form-group">
                  <label for="end-date"> and </label>
<!--                  <p><input v-if="enddate" type="text" :initval="enddate" v-flatpickr="enddate"></p>-->
                  <p>
                    <date-picker
                        id="end-date"
                        v-if="enddate"
                        v-model="enddate"
                        value-type="YYYY-MM-DD"
                        format="MM/DD/YYYY"
                        :clearable="false"
                    ></date-picker>
                  </p>
              </div>
              <p><button type="button" class="btn btn-sm btn-info" @click="fetchAllRecords">Filter</button></p>
              <p><button type="button" id="rangetoggle" @click="toggleRange"><span v-if="isEndDate"> - Remove </span><span v-else> + Add </span>Range</button></p>
            </form>
            <div class="btn-toolbar" role="toolbar">
                <div class="btn-group btn-group-xs" role="group">
                    <label>Filter: </label>
                </div>
<!--                <div class="btn-group btn-group-xs" role="group" aria-label="typeFiltersLabel" data-toggle="buttons" v-iconradio="items_filter_storytype">-->
                <div class="btn-group btn-group-xs" role="group" aria-label="typeFiltersLabel" data-toggle="buttons">
                    <template v-for="item in storyTypeIcons">
                         <label
                             class="btn btn-default"
                             data-toggle="tooltip"
                             data-placement="top"
                             :title="item.name"
                             @click="items_filter_storytype = item.shortname"
                             :class="{ 'active' : items_filter_storytype == item.shortname || (items_filter_storytype == '' && item.shortname == 'all') }"
                         >
                           <input type="radio" autocomplete="off" :value="item.shortname" />
                           <span class="item-type-icon-shrt" :class="typeIcon(item.shortname)"></span>
                         </label>
                    </template>
                </div>
            </div>
            <div id="email-items">
<!--              v-for="item in items | filterBy filterByStoryType | paginate"-->
                <email-story-pod
                    pid="email-items"
                    :main-stories="usedStories"
                    pod-type="mainstoryqueue"
                    v-for="(item, index) in itemsFilteredPaginated"
                    :key="'email-story-item-' + index"
                    :item="item"
                    @main-story-added="handleMainStoryAdded"
                    @main-story-removed="handleMainStoryRemoved"
                >
                </email-story-pod>

                <ul class="pagination">
                  <li v-bind:class="{disabled: (currentPage <= 1)}" class="page-item">
                    <a href="#" @click.prevent="setPage(currentPage-1)" class="page-link" tabindex="-1">Previous</a>
                  </li>
                  <li v-for="pageNumber in totalPages" :class="{active: (pageNumber) == currentPage}" class="page-item">
                    <a class="page-link" href="#" @click.prevent="setPage(pageNumber)">{{ pageNumber }} <span v-if="(pageNumber) == currentPage" class="sr-only">(current)</span></a>
                  </li>
                  <li v-bind:class="{disabled: (currentPage == totalPages)}" class="page-item">
                    <a class="page-link" @click.prevent="setPage(currentPage+1)" href="#">Next</a>
                  </li>
                </ul>
            </div>
        </div><!-- /.col-md-12 -->
    </div><!-- ./row -->
  </div>
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
import Pagination from '../Pagination.vue'
import DatePicker from 'vue2-datepicker'
import draggable from 'vuedraggable'

export default  {
    components: { EmailStoryPod, Pagination, draggable, DatePicker },
    props: ['stypes','mainStories'],
    created(){
      let twoWeeksEarlier = moment().subtract(2, 'w')
      this.startdate = twoWeeksEarlier.format("YYYY-MM-DD")
      this.enddate = twoWeeksEarlier.clone().add(4, 'w').format("YYYY-MM-DD")
      this.fetchAllRecords()
    },
    data: function() {
        return {
            items_filter_storytype: '',
            currentDate: moment(),
            usedStories: [],
            items: [],
            loadingQueue: true,
            loadingUsed: true,
            eventMsg: null,
            startdate: null,
            enddate: null,
            isEndDate: false,
            currentPage: 1,
            itemsPerPage: 10,
            resultCount: 0,
            drag: false,
        }
    },
    computed: {
        itemsFilteredPaginated() {
          let items = []
          if (this.items_filter_storytype != '') {
            items = this.items.filter(it => it.story_type == this.items_filter_storytype)
          } else {
            items = this.items
          }

          if(items.length == 0){ return items }
          this.resultCount = items.length
          if (this.currentPage > this.totalPages) {
            this.currentPage = 1
          }
          let index = (this.currentPage-1) * this.itemsPerPage
          return items.slice(index, index + this.itemsPerPage)
        },

        mainStoryId: function(){
          return this.mainStory ? this.mainStory.id : null
        },
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
          let faicon = ''
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

      fetchAllRecords: function() {
          this.loadingQueue = true

          var routeurl = '/api/email/stories/main';

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
              this.items = response.data.newdata.data
              this.resultCount = this.items.length
              this.setPage(1) // reset paginator
              this.loadingQueue = false;
          }, (response) => {
              //error callback
              console.log("ERRORS");
          }).bind(this);
      },

      setPage: function(pageNumber) {
        if(pageNumber > 0 && pageNumber <= this.totalPages){
          this.currentPage = pageNumber
        }
      },

      onCalendarChange: function(){
          // flatpickr directive method
      },
      /**
       * Uses vue-draggable
       */
      updateOrder: function(event){
        // https://stackoverflow.com/questions/34881844/resetting-a-vue-js-list-order-of-all-items-after-drag-and-drop
        let oldIndex = event.oldIndex
        let newIndex = event.newIndex

        // move the item in the underlying array
        this.usedStories.splice(newIndex, 0, this.usedStories.splice(oldIndex, 1)[0]);
        this.$emit('updated-main-story-order', this.usedStories)
      },
      handleMainStoryAdded(evt) {
        this.$emit('main-story-added', evt)
      },
      handleMainStoryRemoved(evt) {
        this.$emit('main-story-removed', evt)
      }
    },
    filters: {
      paginate: function(list) {
        // only run if there are items in the list
        if(list.length == 0){
          return
        }
        this.resultCount = list.length
        if (this.currentPage > this.totalPages) {
          this.currentPage = 1
        }
        var index = (this.currentPage-1) * this.itemsPerPage
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
      mainStories: function (value) {
        // set events from property to data
        this.usedStories = value
        this.loadingUsed = false
      },

    },
}
</script>
