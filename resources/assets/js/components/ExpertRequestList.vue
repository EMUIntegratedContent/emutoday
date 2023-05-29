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
                <form v-on:submit.prevent="fetchRequests(formData, 1)" class="form-inline" role="search">
                  <label class="btn btn-info">
                    <input
                        type="radio"
                        value="all"
                        v-model="formData.type_filter"
                        class="radio-input"
                        autocomplete="off"
                    />
                    <span class="radio-label">All</span>
                  </label>
                  <label class="btn btn-info">
                    <input
                        type="radio"
                        value="new"
                        v-model="formData.type_filter"
                        class="radio-input"
                        autocomplete="off"
                    />
                    <span class="radio-label">New</span>
                  </label>
                  <label class="btn btn-info">
                    <input
                        type="radio"
                        value="read"
                        v-model="formData.type_filter"
                        class="radio-input"
                        autocomplete="off"
                    />
                    <span class="radio-label">Viewed</span>
                  </label>
                  <div class="form-group">
                    <label for="start-date">| Requests between</label>
                    <flatpickr
                        v-model="formData.start_date"
                        id="start-date"
                        :config="flatpickrConfig"
                        class="form-control"
                        name="startingDate"
                    >
                    </flatpickr>
                   </div>
                  <div class="form-group">
                    <label for="end-date"> and </label>
                    <flatpickr
                        v-model="formData.end_date"
                        id="end-date"
                        :config="flatpickrConfig"
                        class="form-control"
                        name="startingDate"
                    >
                    </flatpickr>
                  </div>
                  <button type="submit" class="btn btn-sm btn-info">Filter</button>
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
              <td>{{ formatDate(request.created_at) }}</td>
              <td>{{ request.name }}</td>
              <td>{{ request.media_outlet }}</td>
              <td>{{ request.expert.first_name + ' ' + request.expert.last_name }}</td>
              <td>{{ request.deadline }}</td>
              <td>
                <span v-if="request.is_acknowledged" class="label label-info">Viewed</span>
                <span v-else class="label label-warning">New</span>
              </td>
              <td>
                <a :href="'/admin/expertrequests/'+request.id+'/edit'" class="button success"><i
                    class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
              </td>
            </tr>
          </table>
          <div class="panel-footer">
            <ul class="pagination">
              <li v-bind:class="{disabled: !hasPrevious}" class="page-item">
                <a href="#" v-on:click.prevent="fetchRequests(formData, pagination.current_page-1)"
                   class="page-link" tabindex="-1">Previous</a>
              </li>
              <li v-for="pg in pagination.last_page" :class="{active: isActivePage(pg)}" class="page-item">
                <a class="page-link" href="#" v-on:click.prevent="fetchRequests(formData, pg)">{{ pg }}</a>
              </li>
              <li v-bind:class="{disabled: !hasNext}" class="page-item">
                <a class="page-link" v-on:click.prevent="fetchRequests(formData, pagination.current_page+1)"
                   href="#">Next</a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<style scoped>
  table {
    border-collapse: separate;
    border-spacing: 1rem;
  }
</style>


<script>
import flatpickr from 'vue-flatpickr-component'
import 'flatpickr/dist/flatpickr.css'
import moment from 'moment'

export default {
  components: { flatpickr },
  props: {
    framework: {
      default: 'bootstrap'
    },
    type: {
      default: 'general'
    },
  },
  data () {
    return {
      currentSearch: '',
      mediarequests: [],
      formErrors: '',
      formData: {
        type_filter: 'all',
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
      flatpickrConfig: {
        altFormat: "m/d/Y", // format the user sees
        altInput: true,
        dateFormat: "Y-m-d", // format sumbitted to the API
      }
    }
  },
  created () {
    let sixMonthsEarlier = moment().subtract(6, 'months')
    let today = moment();
    this.formData.start_date = sixMonthsEarlier.format("YYYY-MM-DD")
    this.formData.end_date = today.format("YYYY-MM-DD")
    this.fetchRequests(this.formData, 1)
  },
  computed: {
    hasPrevious: function () {
      return this.pagination.prev_page_url
    },
    hasNext: function () {
      return this.pagination.next_page_url
    },
    // switch classes based on css framework. foundation or bootstrap
    md6col: function () {
      return (this.framework == 'foundation' ? 'medium-6 columns' : 'col-md-6')
    },
    md12col: function () {
      return (this.framework == 'foundation' ? 'medium-12 columns' : 'col-md-12')
    },
    md8col: function () {
      return (this.framework == 'foundation' ? 'medium-8 columns' : 'col-md-8')
    },
    md4col: function () {
      return (this.framework == 'foundation' ? 'medium-4 columns' : 'col-md-4')
    },
    btnPrimary: function () {
      return (this.framework == 'foundation' ? 'button button-primary' : 'btn btn-primary')
    },
    formGroup: function () {
      return (this.framework == 'foundation' ? 'form-group' : 'form-group')
    },
    formControl: function () {
      return (this.framework == 'foundation' ? '' : 'form-control')
    },
    calloutSuccess: function () {
      return (this.framework == 'foundation') ? 'callout success' : 'alert alert-success'
    },
    calloutFail: function () {
      return (this.framework == 'foundation') ? 'callout alert' : 'alert alert-danger'
    },
    iconStar: function () {
      return (this.framework == 'foundation' ? 'fi-star ' : 'fa fa-star')
    },
    inputGroupLabel: function () {
      return (this.framework == 'foundation') ? 'input-group-label' : 'input-group-addon'
    },
    table: function () {
      return (this.framework == 'foundation') ? 'table' : 'table'
    }
  },
  methods: {
    formatDate: function (date) {
      if (date) {
        return moment(String(date)).format('MM/DD/YYYY')
      }
    },
    toggleRange: function () {
      if (this.isEndDate) {
        this.isEndDate = false
      }
      else {
        this.isEndDate = true
      }
    },
    fetchRequests: function (data, page) {
      // only run if pages within pagination range
      if (page > 0 && page <= this.last_page) {
        this.$http.get('/api/expertmediarequest/list/search?page=' + page + '&start_date=' + data.start_date + '&end_date=' + data.end_date + '&type_filter=' + data.type_filter)
        .then((response) => {
          this.mediarequests = response.data.newdata.data
          this.makePagination(response.data.newdata)
        }).catch((e) => {
          this.formErrors = e.response.data.error.message
        })
      }
    },

    makePagination: function (data) {
      const pagination = {
        current_page: data.current_page,
        last_page: data.last_page,
        next_page_url: data.next_page_url,
        prev_page_url: data.prev_page_url,
        next_page: data.current_page + 1,
        prev_page: data.current_page - 1
      }

      if (data.last_page == 0) {
        this.last_page = 1; //need this to avoid confusing the conditional statement in fetchRequests()
      }
      else {
        this.last_page = data.last_page
      }

      this.pagination = pagination
    },

    isActivePage (page) {
      return page == this.pagination.current_page
    }
  }
};

</script>
