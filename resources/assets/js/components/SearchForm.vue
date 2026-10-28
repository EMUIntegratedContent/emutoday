<template>
  <form action="/search" method="get" id="search-form" class="search-form" v-on:submit.prevent="submitSearch">
    <div class="input-group">
      <label for="top-site-search" class="show-for-sr white-label">Search</label>
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
.white-label {
  color: #fff;
}

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

.submit-search-btn:focus-visible {
  outline: 2px solid #fff;
  outline-offset: 1px;
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
