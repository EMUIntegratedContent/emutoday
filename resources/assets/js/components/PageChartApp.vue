<template>

                <div class="panel-body">
                <vue-chart
                        :packages="gpackages"
                        :chart-type="chartType"
                        :columns="columns"
                        :rows="rowsLoad"
                        :options="options"
                       ></vue-chart>
            </div>

</template>
<style scoped>
.box-body {
    /*height: 800px;*/
}
</style>
<script>
import moment from 'moment';
export default  {
       components: { },
       props: ['gcols'],
       ready: function() {
           console.log('gcols= '+ this.gcols )
           this.fetchAllRecords()
       },
       data: function () {
              return {
                  newRows:[],
                  alldata:[],
                  gpackages:
                      ['timeline','gantt']
                  ,
                  chartType: 'Timeline',
                  chartEvents: {
                      'select': function() {
                          alert('YEEEEAAAAAH! Nice selection!');
                      },
                      'ready': function() {
                          alert('The chart is ready!');
                      }
                  },
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
                //   rows: this.rowsLoad,
                  options: {
                    hAxis: {title: 'Date'},
                    vAxis: {title: ''},
                    height: '',
                    animation: {
                        duration: 500,
                        easing: 'out',
                    },
                      timeline: {
                          showRowLabels: false,
                          showBarLabels: true
                      }
                    //   title: 'Company Performance',
                    //   hAxis: {
                    //       title: 'Dates',
                    //       minValue: '2015',
                    //       maxValue: '2017'
                    //   },
                    //   vAxis: {
                    //       title: '',
                    //       minValue: 300,
                    //       maxValue: 1200
                    //   },
                    //   showRowLabels: false
                    //   curveType: 'function'
                  }
              }
          },
       computed: {
           rowsLoad: function () {
               var result = new Array();
            //    var json_data = JSON.parse(this.alldata)
                let newdata =  this.alldata;

                return newdata.map(function(item,index){
                    var ddid = item.id;
                    var ddtitle = item.uri;

                    var ddsdate =  moment(item.start_date);
                    var newsdate = new Date(ddsdate.year(),ddsdate.month(),ddsdate.date())
                    var ddedate = (item.end_date === null )? moment("2017-01-01") : moment(item.end_date);
                    var newedate = new Date(ddedate.year(),ddedate.month(),ddedate.date())
                    item = [ddid.toString(),ddtitle.toString(),newsdate,newedate];

                    return item
                });
                console.log('newdata'+ newdata)
                // return  this.formatReturn(this.gcols)
           },
       },

       methods :  {
       fetchAllRecords: function() {
           this.$http.get('/api/page/chartload')

           .then((response) =>{
               //response.status;
               console.log('response.status=' + response.status);
               console.log('response.ok=' + response.ok);
               console.log('response.statusText=' + response.statusText);
               console.log('response.data=' + response.data);
               // data = response.data;
               //
               // this.$set('allitems', response.data.data)
               this.$set('alldata', response.data.data)
            //    this.allitems = response.data.data;


               this.checkOverDataFilter();
           }, (response) => {
               //error callback
               console.log("ERRORS");

               //  this.formErrors =  response.data.error.message;

           }).bind(this);
       },
       checkOverDataFilter:function() {
           console.log('newRows= ' + this.alldata);

       },



         formatReturn: function (items) {
             var itemsArray = [];
             for (item in items) {
                 var itemArray = [
                     item.id,
                     moment(item['start_date']).format('YYYY-MM-DD'),
                     moment(item['end_date']).format('YYYY-MM-DD')
                 ];
                 itemsArray.push(itemArray);
             }
             console.log('itemsArray='+ itemsArray);
             return itemsArray
        },

           formatColumnValues: function(items) {
               return items.filter(function(item) {
                   return item.live === 1
               });
           },

       },


       // the `events` option simply calls `$on` for you
       events: {
           // 'child-msg': function (msg) {
           //   // `this` in event callbacks are automatically bound
           //   // to the instance that registered it
           //   this.messages.push(msg)
           // }
       },
       filters: {
           // momentPretty: {
           // 	read: function(val) {
           // 			console.log('read-val'+ val )
           //
           // 		return 	val ?  moment(val).format('MM-DD-YYYY') : '';
           // 	},
           // 	write: function(val, oldVal) {
           // 		console.log('write-val'+ val + '--'+ oldVal)
           //
           // 		return moment(val).format('YYYY-MM-DD');
           // 	}
           // }
       }
   }


</script>
