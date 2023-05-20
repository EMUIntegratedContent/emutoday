<template>
  <form action="/search" method="get" id="search-form" class="search-form" v-on:submit.prevent="submitSearch">
    <div class="input-group">
      <label for="top-site-search" class="show-for-sr">Search</label>
      <input class="input-group-field" id="top-site-search" type="text" name="searchterm" placeholder="Search"
             v-model="searchterm">
      <div class="input-group-button">
        <button type="submit" class="button small submit-search-btn" alt="submit search"
                aria-label="submit site search"><i class="fa fa-search"></i></button>
      </div>
    </div>
  </form>
</template>

<style scoped>
input {
  padding: 0;
  padding-left: 1em;
  height: 33px;
  vertical-align: bottom;
  background-color: #535353;
  border: none;
}

.input-group {
  margin: 0;
  padding: 0;
}

.submit-search-btn {
  border: none;
  color: #ffffff;
  background-color: #535353;
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
        $("#search-form").submit()
      }
    }
  }
}
</script>
