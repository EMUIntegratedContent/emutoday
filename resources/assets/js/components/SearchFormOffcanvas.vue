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
  padding: 0 0 0 1em;
  height: 33px;
  vertical-align: bottom;
  background-color: #535353;
  color: #fff;
  border: none;
}

input::placeholder {
  color: #e6e6e6;
  opacity: 1;
}

input:focus,
input:focus-visible {
  background-color: #535353;
  border: 1px solid #fff;
  box-shadow: none;
  outline: 2px solid #fff;
  outline-offset: 1px;
}

.input-group {
  margin: 0;
  padding: 0;
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
