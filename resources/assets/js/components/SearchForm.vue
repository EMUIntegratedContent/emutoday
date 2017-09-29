<template>
  <form action="/search" method="get" id="search-form" class="search-form" v-on:submit.prevent="submitSearch">
    <div class="input-group">
      <label for="top-site-search" class="show-for-sr">Search</label>
      <input class="input-group-field" id="top-site-search" type="text" name="searchterm" placeholder="Search" v-model="searchterm">
      <div class="input-group-button">
        <button type="submit" class="button secondary small" alt="submit search" aria-label="submit site search"><i class="fa fa-search"></i></span></button>
      </div>
    </div>
  </form>
</template>

<style scoped>
input {
  padding: 0;
  padding-left: 1em;
  height: 34.4px;
  vertical-align: bottom;
}
.input-group {
  margin: .4rem;
  padding: 0;
}
</style>

<script>
module.exports = {
  directives: {},
  components: {},
  props: {},
  data: function() {
    return {
      searchterm:''
    }
  },
  created: function() {

  },
  ready() {
  },
  computed: {


  },
  methods: {
    submitSearch: function (e) {
      if ( $.trim(this.searchterm) != '' ){
        $("#search-form").submit();
      }
    }
  },
  watch: {},
  filters: {},
  events: {}
};
</script>
