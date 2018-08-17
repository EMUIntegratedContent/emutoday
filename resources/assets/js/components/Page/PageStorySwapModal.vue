<template>
  <!--STATS MODAL-->
  <div id="pageStorySwapModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Swap Story</h4>
        </div>
        <div class="modal-body">
          <!--<ul>
            <li><strong>Title:</strong> {{ email.title }}</li>
            <li><strong>Sent At:</strong> {{ email.send_at | formatDate }}</li>
            </ul>-->
            <template v-if="storyNumber == 0">
                <p>Choose a <strong>main story</strong> for this hub page. The list below shows all stories in within the date range that have an emutoday_front story type.</p>
            </template>
            <template v-else>
                <p>Choose a <strong>sub story</strong>. The list below shows all stories in within the date range that have an emutoday_small story type.</p>
            </template>

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
              <p><button type="button" class="btn btn-sm btn-info" @click="fetchStories">Filter</button></p>
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
            <div id="swappable-stories">
              <template v-if="!loadingQueue">
                <template v-if="queueStories.length > 0">
                  <page-story-pod
                      :item="story"
                      v-for="story in queueStories | filterBy filterByStoryType | paginate"
                  >
                  </page-story-pod>
                  <ul class="pagination">
                    <li v-bind:class="{disabled: (currentPage <= 1)}" class="page-item">
                      <a href="#" @click.prevent="setPage(currentPage-1)" class="page-link" tabindex="-1">Previous</a>
                    </li>
                    <li v-for="pageNumber in totalPages" :class="{active: (pageNumber+1) == currentPage}" class="page-item">
                      <a class="page-link" href="#" @click.prevent="setPage(pageNumber+1)">{{ pageNumber+1 }} <span v-if="(pageNumber+1) == currentPage" class="sr-only">(current)</span></a>
                    </li>
                    <li v-bind:class="{disabled: (currentPage == totalPages)}" class="page-item">
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


        </div>
        <div class="modal-footer">
          this is the footer
        </div>
      </div>
    </div>
  </div><!--/end modal-->
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
import PageStoryPod from './PageStoryPod.vue'
import iconradio from '../../directives/iconradio.js'
import flatpickr from "../../directives/flatpickr.js"

export default {
  directives: {iconradio, flatpickr},
  components: {PageStoryPod},
  props:{
      storyNumber:{
          type: String,
          default: 2
      },
      stypes: {
        default: []
      }
  },
  data: function() {
    return {
        stories_filter_storytype: '',
        currentDate: moment(),
        queueStories: [],
        frontStories: [],
        startdate: null,
        enddate: null,
        isEndDate: false,
        loadingQueue: false,
        loadingUsed: true,
        eventMsg: null,
        currentPage: 1,
        itemsPerPage: 10,
        resultCount: 0,
    }
  },
  ready: function() {
      let oneMonthEarlier = moment().subtract(1, 'M')
      this.startdate = oneMonthEarlier.format("YYYY-MM-DD")
      this.enddate = oneMonthEarlier.clone().add(1, 'M').format("YYYY-MM-DD")
  },
  computed: {
      totalPages: function() {
        return Math.ceil(this.resultCount / this.itemsPerPage)
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
  methods: {
      // fetch all emutoday_front and emutoday_small stories from the last month
      fetchStories: function(){
          this.loadingQueue = true

          var routeurl = '/api/page/stories';

          // if a start date is set, get stories whose start_date is on or after this date
          if(this.startdate){
              routeurl = routeurl + '/' + this.startdate
          } else {
              routeurl = routeurl + '/' + moment().subtract(1, 'M').format("YYYY-MM-DD")
          }

          // if a date range is set, get stories between the start date and end date
          if(this.isEndDate){
              routeurl = routeurl + '/' + this.enddate
          }

          this.$http.get(routeurl)

          .then((response) =>{
              // sub stories
              if(this.storyNumber > 0){
                  this.$set('queueStories', response.data.newdata.data)
              } else {
                  // main story
                  this.$set('queueStories', response.data.newdata.data.filter(function(story){
                      return story.front_images.length >= 1
                  }))
              }
              this.resultCount = this.queueStories.length
              this.setPage(1) // reset paginator
              this.loadingQueue = false;
          }, (response) => {
              //error callback
              console.log("ERRORS");
          }).bind(this);
      },
      filterByStoryType: function (value) {
          if (this.stories_filter_storytype === '') {
              return value.story_type !== '';
          } else {
              return value.story_type === this.stories_filter_storytype;
          }
      },
      // filter only stories that are emutoday_front
      isString: function(val){
          return toString.call(val) === "[object String]";
      },
      onCalendarChange: function(){
          // flatpickr directive method
      },
      setPage: function(pageNumber) {
        if(pageNumber > 0 && pageNumber <= this.totalPages){
          this.currentPage = pageNumber
        }
      },
      toggleRange: function(){
          if(this.isEndDate){
              this.isEndDate = false
          } else {
              this.isEndDate = true
          }
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
  },
  events: {
      'story-swap-requested': function (story) {
          // Dispatch an event that propagates upward along the parent chain using $dispatch()
          // Tell the parent which story and which position
          this.$dispatch('story-swapped', [story, this.storyNumber])
      },
  },
  watch: {
      // Whenever the storyNumber property is changed (i.e. when user clicks on a story image to swap the story out), fetch relevant stories
      storyNumber: function(){
          this.fetchStories()
      }
  },
}
</script>
