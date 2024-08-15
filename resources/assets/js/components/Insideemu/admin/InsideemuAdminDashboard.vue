<template>
  <v-row>
    <v-col cols="12">
      Inside EMU Dashboard
    </v-col>
  </v-row>
</template>

<script>
import moment from 'moment'
import flatpickr from 'vue-flatpickr-component'
import 'flatpickr/dist/flatpickr.css'
import { mapMutations, mapState } from "vuex"

export default {
  mixins: [],
  components: {
    flatpickr
  },
  created () {
    // this.fetchPosts()
  },
  data: function () {
    return {

    }
  },
  computed: {
    ...mapState([]),
  },
  methods: {
    ...mapMutations([]),
    // async fetchPosts () {
    //   this.loadingPosts = true
    //   let routeurl = '/api/insideemu/posts'
    //
    //   // if a start date is set, get stories whose start_date is on or after this date
    //   if (this.startDate) {
    //     routeurl = routeurl + '?fromDate=' + this.startDate
    //   }
    //   else {
    //     routeurl = routeurl + '?fromDate=' + moment().subtract(3, 'm').format("YYYY-MM-DD")
    //   }
    //
    //   // if a date range is set, get stories between the start date and end date
    //   if (this.isEndDate) {
    //     routeurl = routeurl + '&toDate=' + this.endDate
    //   }
    //
    //   await this.$http.get(routeurl)
    //   .then((r) => {
    //     this.posts = r.data
    //
    //     // this.resultCount = this.queueStories.length
    //     // this.setPage(1) // reset paginator
    //     this.loadingPosts = false
    //   })
    //   .catch((e) => {
    //     console.log(e)
    //   })
    // }
  }
}
</script>
<style scoped>

</style>
