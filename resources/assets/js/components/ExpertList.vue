<template>
  <div>
    <div class="row">
      <div v-bind:class="md12col">
        <h1>Eastern Experts</h1>
      </div>
    </div>
    <div class="row">
      <div v-bind:class="md8col">
        <div class="panel panel-default">
          <!-- Default panel contents -->
          <div class="panel-heading">
            <div class="row">
              <div :class="md8col">
                <form v-on:submit.prevent="fetchExperts(currentSearch, 1)" class="form-inline" role="search">
                  <div class="btn-group" data-toggle="buttons" v-radio="type_filter" @click.prevent="fetchExperts(currentSearch, 1)">
                    <label class="btn btn-info active">
                      <input type="radio" name="typeFilter" value="all" autocomplete="off"> All
                    </label>
                    <label class="btn btn-info">
                      <input type="radio" name="typeFilter" value="unapproved" autocomplete="off"> Unapproved
                    </label>
                    <label class="btn btn-info">
                      <input type="radio" name="typeFilter" value="new" autocomplete="off"> New
                    </label>
                  </div>
                  <div class="input-group">
                    <label for="narrow" class="sr-only">Narrow results</label>
                    <input type="text" class="form-control" id="narrow" placeholder="Narrow Results" v-model="currentSearch">
                    <div class="input-group-btn">
                      <input type="submit" class="form-control btn btn-info" aria-label="Narrow search results" value="Narrow" />
                    </div>
                  </div>
                </form>
              </div>
              <div :class="md4col">
                <p class="text-right"><a :class="btnPrimary" href="/admin/experts/form">Add Expert</a></p>
              </div>
            </div>
          </div>

          <!-- Table -->
          <table class="table table-hover table-sm">
            <tr>
              <th>Photo</th>
              <th>Last Name</th>
              <th>First Name</th>
              <th>Job Title</th>
              <th>Approved?</th>
              <th>Actions</th>
            </tr>
            <tr v-for="expert in experts">
              <td>
                <img v-if="expert.expert_images[0]" class="small-thumb" v-bind:src="'/imagecache/expertthumb/' + expert.expert_images[0].filename" v-bind:alt="'A photo of ' + expert.first_name + ' ' + expert.last_name">
                <img v-else class="small-thumb" src="/imagecache/expertthumb/no-image.png" v-bind:alt="'No image available for ' + expert.first_name + ' ' + expert.last_name">
              </td>
              <td>{{ expert.last_name }}</td>
              <td>{{ expert.first_name }}</td>
              <td>{{ expert.title }}</td>
              <td>
                <span v-show="expert.is_approved" class="label label-success">Yes</span>
                <span v-show="!expert.is_approved && (expert.created_at != expert.updated_at)" class="label label-danger">No</span>
                <span v-show="!expert.is_approved && (expert.created_at == expert.updated_at)" class="label label-info">New</span>
              </td>
              <td>
                <a href="/admin/experts/{{ expert.id }}/edit" class="button success"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
              </td>
            </tr>
          </table>
          <div class="panel-footer">
            <ul class="pagination">
              <li v-bind:class="{disabled: !hasPrevious}" class="page-item">
                <a href="#" v-on:click.prevent="fetchExperts(currentSearch, pagination.current_page-1)" class="page-link" tabindex="-1">Previous</a>
              </li>
              <li v-for="pg in pagination.last_page" :class="{active: isActivePage(pg+1)}" class="page-item">
                <a class="page-link" href="#" v-on:click.prevent="fetchExperts(currentSearch, pg+1)">{{ pg+1 }} <span v-if="isCurrent" class="sr-only">(current)</span></a>
              </li>
              <li v-bind:class="{disabled: !hasNext}" class="page-item">
                <a class="page-link" v-on:click.prevent="fetchExperts(currentSearch, pagination.current_page+1)" href="#">Next</a>
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
import VuiFlipSwitch from './VuiFlipSwitch.vue'

module.exports = {
  components: {},
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
      experts: [],
      formErrors: '',
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
      type_filter: 'all'
    }
  },
  created: function () {

  },
  ready: function() {
    this.fetchExperts('', 1);
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
    fetchExperts: function(searchterm, page) {
      var url
      searchterm ? url = '/api/experts/search/' + searchterm + '?page=' + page + '&type_filter=' + this.type_filter : url = '/api/experts/search?page=' + page  + '&type_filter=' + this.type_filter

      // only run if pages within pagination range
      if(page > 0 && page <= this.last_page){
        this.$http.get(url)
        .then((response) => {
          this.$set('experts', response.body.newdata.data)
          this.makePagination(response.body.newdata)
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
        this.last_page = 1; //need this to avoid confusing the conditional statement in fetchExperts()
      } else {
        this.last_page = data.last_page
      }

      this.$set('pagination', pagination)
    },

    isActivePage(page){
      return page == this.pagination.current_page
    }
  },
  watch: {
  },
  filters: {
  },
  events: {
  },
  directives: {
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
