<template>
  <div>
    <div class="row">
      <div v-bind:class="md12col">
        <h1>Eastern Expert Media Requests</h1>
      </div>
    </div>
    <div class="row">
      <div v-bind:class="md8col">
        <div class="panel panel-default">
          <!-- Default panel contents -->
          <div class="panel-heading">
            <div class="row">
              <div :class="md12col">
                <form class="form-inline" role="search">
                  <!-- Tutorial for button group workaround https://forum-archive.vuejs.org/topic/135/problem-binding-bootstrap-styled-radio-button-groups-with-vue-vm/3 -->
                  <div class="btn-group" data-toggle="buttons" v-radio="formData.type_filter" @click.prevent="fetchRequests(this.formData, 1)">
                    <label class="btn btn-info active">
                      <input type="radio" name="typeFilter" value="all" autocomplete="off"> All
                    </label>
                    <label class="btn btn-info">
                      <input type="radio" name="typeFilter" value="new" autocomplete="off"> New
                    </label>
                    <label class="btn btn-info">
                      <input type="radio" name="typeFilter" value="read" autocomplete="off"> Viewed
                    </label>
                  </div>
                  <div class="form-group">
                      <label for="start-date">| Requests between</label>
                      <input v-if="formData.start_date" v-model="formData.start_date" id="start_date" type="text" :initval="formData.start_date" v-flatpickr="formData.start_date">
                  </div>
                  <div class="form-group">
                      <label for="start-date"> and </label>
                      <input v-if="formData.end_date" type="text" :initval="formData.end_date" id="end-date" v-flatpickr="formData.end_date">
                  </div>
                  <button type="button" class="btn btn-sm btn-info" @click.prevent="fetchRequests(this.formData, 1)">Filter</button>
                </form>
              </div>
            </div>
          </div>

          <!-- Table -->
          <table class="table table-hover table-sm">
            <tr>
              <th>Submitted</th>
              <th>Requester</th>
              <th>Media Outlet</th>
              <th>Requested Expert</th>
              <th>Deadline</th>
              <th>Status</th>
              <th>Actions</th>
            </tr>
            <tr v-for="request in mediarequests">
              <td>{{ request.created_at | formatDate }}</td>
              <td>{{ request.name }}</td>
              <td>{{ request.media_outlet }}</td>
              <td>{{ request.expert.first_name + ' ' + request.expert.last_name }}</td>
              <td>{{ request.deadline }}</td>
              <td>
                <span v-if="request.is_acknowledged" class="label label-info">Viewed</span>
                <span v-else class="label label-warning">New</span>
              </td>
              <td>
                <a href="/admin/expertrequests/{{ request.id }}/edit" class="button success"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
              </td>
            </tr>
          </table>
          <div class="panel-footer">
            <ul class="pagination">
              <li v-bind:class="{disabled: !hasPrevious}" class="page-item">
                <a href="#" v-on:click.prevent="fetchRequests(this.formData, pagination.current_page-1)" class="page-link" tabindex="-1">Previous</a>
              </li>
              <li v-for="pg in pagination.last_page" :class="{active: isActivePage(pg+1)}" class="page-item">
                <a class="page-link" href="#" v-on:click.prevent="fetchRequests(this.formData, pg+1)">{{ pg+1 }} <span v-if="isCurrent" class="sr-only">(current)</span></a>
              </li>
              <li v-bind:class="{disabled: !hasNext}" class="page-item">
                <a class="page-link" v-on:click.prevent="fetchRequests(this.formData, pagination.current_page+1)" href="#">Next</a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<style scoped>

</style>


<script>
import flatpickr from "../directives/flatpickr.js"
import moment from 'moment'

module.exports = {
  components: {flatpickr},
  props: {
    framework: {
      default: 'bootstrap'
    },
    type: {
      default: 'general'
    },
  },
  data: function() {
    return {
      currentSearch: '',
      mediarequests: [],
      formErrors: '',
      formData: {
        type_filter: '',
        start_date: null,
        end_date: null
      },
      pagination: {
        current_page: 1,
        last_page: 1,
        next_page_url: '',
        prev_page_url: '',
        next_page: null,
        prev_page: null
      },
      last_page: 1, //need a second last page in case search results turn up 0 pages
      hasPrevious: true,
      hasNext: true,
      startdatePicker:null,
      enddatePicker:null,
      dateObject:{
        startDateMin: '',
        startDateDefault: '',
        endDateMin: '',
        endDateDefault: ''
      },
    }
  },
  created: function () {

  },
  ready: function() {
    let sixMonthsEarlier = moment().subtract(6, 'months')
    let today = moment();
    this.formData.start_date = sixMonthsEarlier.format("YYYY-MM-DD")
    this.formData.end_date = today.format("YYYY-MM-DD")
    this.fetchRequests(this.formData, 1);
  },
  computed: {
    hasPrevious: function(){
      return this.pagination.prev_page_url
    },
    hasNext: function(){
      return this.pagination.next_page_url
    },
    // switch classes based on css framework. foundation or bootstrap
    md6col: function() {
      return (this.framework == 'foundation' ? 'medium-6 columns' : 'col-md-6')
    },
    md12col: function() {
      return (this.framework == 'foundation' ? 'medium-12 columns' : 'col-md-12')
    },
    md8col: function() {
      return (this.framework == 'foundation' ? 'medium-8 columns' : 'col-md-8')
    },
    md4col: function() {
      return (this.framework == 'foundation' ? 'medium-4 columns' : 'col-md-4')
    },
    btnPrimary: function() {
      return (this.framework == 'foundation' ? 'button button-primary' : 'btn btn-primary')
    },
    formGroup: function() {
      return (this.framework == 'foundation' ? 'form-group' : 'form-group')
    },
    formControl: function() {
      return (this.framework == 'foundation' ? '' : 'form-control')
    },
    calloutSuccess:function(){
      return (this.framework == 'foundation')? 'callout success':'alert alert-success'
    },
    calloutFail:function(){
      return (this.framework == 'foundation')? 'callout alert':'alert alert-danger'
    },
    iconStar: function() {
      return (this.framework == 'foundation' ? 'fi-star ' : 'fa fa-star')
    },
    inputGroupLabel:function(){
      return (this.framework=='foundation')?'input-group-label':'input-group-addon'
    },
    table: function(){
      return (this.framework=='foundation')?'table':'table'
    },
  },

  methods: {
    toggleRange: function(){
        if(this.isEndDate){
            this.isEndDate = false
        } else {
            this.isEndDate = true
        }
    },
    fetchRequests: function(data, page) {
      // only run if pages within pagination range
      if(page > 0 && page <= this.last_page){
        this.$http.get('/api/expertmediarequest/list/search?page=' + page + '&start_date=' + data.start_date + '&end_date=' + data.end_date + '&type_filter=' + data.type_filter)
        .then((response) => {
          this.$set('mediarequests', response.body.newdata.data)
          this.makePagination(response.body.newdata)
          console.log(response.body.newdata)
        }, (response) => {
          this.formErrors = response.data.error.message;
        }).bind(this);
      }
    },

    makePagination: function(data){
      var pagination = {
        current_page: data.current_page,
        last_page: data.last_page,
        next_page_url: data.next_page_url,
        prev_page_url: data.prev_page_url,
        next_page: data.current_page + 1,
        prev_page: data.current_page -1
      }

      if(data.last_page == 0){
        this.last_page = 1; //need this to avoid confusing the conditional statement in fetchRequests()
      } else {
        this.last_page = data.last_page
      }

      this.$set('pagination', pagination)
    },

    isActivePage(page){
      return page == this.pagination.current_page
    },

    setupDatePickers:function(){
      var self = this;

      this.startdatePicker = flatpickr(document.getElementById("start_date"), {
        defaultDate: self.dateObject.startDateDefault,
        enableTime: false,
        altInput: true,
        altInputClass: "form-control",
        dateFormat: "Y-m-d",
        onChange(dateObject, dateString) {
          self.enddatePicker.set("minDate", dateObject);
          self.formData.start_date = dateString;
          self.startdatePicker.value = dateString;
        }
      });

      this.enddatePicker = flatpickr(document.getElementById("end_date"), {
        defaultDate: self.dateObject.endDateDefault,
        enableTime: false,
        altInput: true,
        altInputClass: "form-control",
        dateFormat: "Y-m-d",
        onChange(dateObject, dateString) {
          self.formData.end_date = dateString;
          self.enddatePicker.value = dateString;
        }
      });
    },

    onCalendarChange: function(){
        // flatpickr directive method
    },
  },
  watch: {
  },
  filters: {
    formatDate: function(date){
      if (date) {
        return moment(String(date)).format('MM/DD/YYYY')
      }
    }
  },
  events: {
  },
  directives: {
    flatpickr,
    //Tutorial: https://forum-archive.vuejs.org/topic/135/problem-binding-bootstrap-styled-radio-button-groups-with-vue-vm/3 -->
    radio: {
      twoWay: true,
      bind: function() {
          var self = this;
          var btns = $(self.el).find('.btn');
          btns.each(function() {
              $(this).on('click', function() {
                  var v = $(this).find('input').get(0).value
                  self.set(v);
              })
          });
      },
      update: function() {
          var value = this._watcher.value;
          if (value) {
              this.set(value);
              var btns = $(this.el).find('.btn')
              btns.each(function() {
                  $(this).removeClass('active');
                  var v = $(this).find('input').get(0).value;

                  if (v === value) {
                      $(this).addClass('active');
                  }
              });
          } else {
              var input = $(this.el).find('.active input').get(0);
              if (input) {
                  this.set(input.value);
              }
          }
      }
    }
  }
};

</script>
