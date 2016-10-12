var Vue = require('vue');

import VueResource from 'vue-resource';
Vue.use(VueResource);

import EventForm from './components/EventForm.vue'
var vm = new Vue({
    el: '#vue-event-form',
    components: {EventForm:EventForm},
    // http: {
    //     headers: {
    //         // You could also store your token in a global object,
    //         // and reference it here. APP.token
    //         'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
    //     }
    // },
    ready() {
      console.log('vue ready');
    }
});

// Assign events to edit buttons
var editBtns = document.getElementsByClassName('editBtn'); // Get edit elems
for (var i=0;i<editBtns.length;i++){
  // Assign an event listener to call a method within the Vue instance
  editBtns[i].addEventListener('click', function(e){ vm.$refs.foo.fetchSubmittedRecord(this.parentNode.id);})
};

// Assign events to cancel buttons
var cancelBtns = document.getElementsByClassName('cancelBtn'); // Get edit elems
for (var i=0;i<cancelBtns.length;i++){
  // Assign an event listener to call a method within the Vue instance
  cancelBtns[i].addEventListener('click', function(e){ vm.$refs.foo.cancelRecord(this.parentNode.id);})
};
