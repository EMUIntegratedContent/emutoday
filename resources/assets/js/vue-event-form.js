var Vue = require('vue');

import VueResource from 'vue-resource';
Vue.use(VueResource);

import EventForm from './components/EventForm.vue'
new Vue({
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
