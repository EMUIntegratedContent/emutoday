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

// Assign events to edit buttons
var editBtns = document.getElementsByClassName('editBtn'); // Get edit elems
for (var i=0;i<editBtns.length;i++){
  // Assign an event listener to call a method within the Vue instance
  editBtns[i].addEventListener('click', function(e){ vm.$refs.foo.fetchSubmittedRecord(this.id) })
};
