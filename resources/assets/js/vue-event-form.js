var Vue = require('vue');

import VueResource from 'vue-resource';
Vue.use(VueResource);

import EventForm from './components/EventForm.vue'
var vm = new Vue({
    el: '#vue-event-form',
    components: {EventForm:EventForm},
    ready() {
      console.log('vue ready');
    }
});

function assignEventListeners(){
  // Cancel and edit buttons need to call vue object methods
  $("#calendar-bar").on("click", ".editBtn", function(event){
    vm.$refs.foo.fetchSubmittedRecord(this.parentNode.id);
  });
  $("#calendar-bar").on("click", ".cancelBtn", function(event){
    vm.$refs.foo.cancelRecord(this.parentNode.id);
  });
}
assignEventListeners();
