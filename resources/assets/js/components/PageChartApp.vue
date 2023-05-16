<template>
  <div class="panel-body">
    <!-- TODO: asked Darcy if this is needed 5/15/23 -->
<!--    <vue-chart-->
<!--        :packages="gpackages"-->
<!--        :chart-type="chartType"-->
<!--        :columns="columns"-->
<!--        :rows="rowsLoad"-->
<!--        :options="options"-->
<!--    ></vue-chart>-->
  </div>
</template>
<style scoped>

</style>
<script>
import moment from 'moment'

export default {
  components: {},
  props: ['gcols'],
  created () {
    this.fetchAllRecords()
  },
  data: function () {
    return {
      newRows: [],
      alldata: [],
      gpackages:
          ['timeline', 'gantt']
      ,
      chartType: 'Timeline',
      chartEvents: {},
      columns: [{
        'type': 'string',
        'label': 'ID'
      }, {
        'type': 'string',
        'label': 'title'
      }, {
        'type': 'date',
        'label': 'Start'
      }, {
        'type': 'date',
        'label': 'End'
      }],
      options: {
        hAxis: { title: 'Date' },
        vAxis: { title: '' },
        height: '',
        animation: {
          duration: 500,
          easing: 'out',
        },
        timeline: {
          showRowLabels: false,
          showBarLabels: true
        }
      }
    }
  },
  computed: {
    rowsLoad: function () {
      let newdata = this.alldata
      return newdata.map(function (item, index) {
        const ddid = item.id
        const ddtitle = item.uri

        const ddsdate = moment(item.start_date);
        const newsdate = new Date(ddsdate.year(), ddsdate.month(), ddsdate.date())
        const ddedate = (item.end_date === null) ? moment("2017-01-01") : moment(item.end_date);
        const newedate = new Date(ddedate.year(), ddedate.month(), ddedate.date())
        item = [ddid.toString(), ddtitle.toString(), newsdate, newedate];

        return item
      })
    },
  },

  methods: {
    fetchAllRecords: function () {
      this.$http.get('/api/page/chartload')
      .then((response) => {
        this.alldata = response.data.data
      }).catch((e) => {
        //error callback
        console.log(e)
      })
    },
    formatReturn: function (items) {
      let itemsArray = [];
      for (let item in items) {
        let itemArray = [
          item.id,
          moment(item['start_date']).format('YYYY-MM-DD'),
          moment(item['end_date']).format('YYYY-MM-DD')
        ]
        itemsArray.push(itemArray)
      }
      return itemsArray
    },
    formatColumnValues: function (items) {
      return items.filter(function (item) {
        return item.live === 1
      })
    }
  }
}


</script>
