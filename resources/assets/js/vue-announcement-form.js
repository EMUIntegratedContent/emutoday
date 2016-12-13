var Vue = require('vue');

import VueResource from 'vue-resource';
Vue.use(VueResource);

// var moment = require('moment');
import AnnouncementForm from './components/AnnouncementForm.vue';

var vm = new Vue({
    el: '#vue-announcements',
    components: {AnnouncementForm},
    // http: {
    //     headers: {
    //         // You could also store your token in a global object,
    //         // and reference it here. APP.token
    //         'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
    //     }
    // },
    ready() {
      console.log('AnnouncementForm ready');
    }
});

function assignEventListeners(){
  // Edit buttons need to call vue object methods
  $("#calendar-bar").on("click", ".editBtn", function(event){
    vm.$refs.foo.fetchSubmittedRecord(this.parentNode.id);
  });
}
assignEventListeners();
