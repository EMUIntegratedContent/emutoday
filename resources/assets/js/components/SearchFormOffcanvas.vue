<template>
  <form action="/search" method="get" id="search-form-offcanvas" class="search-form-offcanvas"
        v-on:submit.prevent="submitSearch">
    <slot name="csrf"></slot>
    <div class="input-group">
      <span class="show-for-sr">Search</span>
      <label class="show-for-sr" for="offcanvassearch">Search EMU Today</label>
      <input class="input-group-field" id="offcanvassearch" type="text" name="searchterm" placeholder="Search"
             v-model="searchterm">
      <div class="input-group-button">
        <button type="submit" class="button secondary small"><i class="fa fa-search"></i><span class="show-for-sr">submit search</span>
        </button>
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

</style>


<script>

export default {
  data () {
    return {
      searchterm: ''
    }
  },
  methods: {
    submitSearch () {
      if (this.searchterm.trim() != '') {
        $("#search-form-offcanvas").submit()
      }
    }
  },
};

</script>
