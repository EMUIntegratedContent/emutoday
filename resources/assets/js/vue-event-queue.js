var Vue = require('vue');

import VueResource from 'vue-resource';
Vue.use(VueResource);
// Remember the token we created in the <head> tags? Get it here.
var CSRFToken = document.querySelector('meta[name="_token"]').getAttribute('content');
Vue.http.headers.common['X-CSRF-TOKEN'] = CSRFToken;


import EventQueue from './components/EventQueue.vue'
// var moment = require('moment');


new Vue({
    el: '#vue-event-queue',
    components: {
      EventQueue
    },
        // http: {
        //         headers: {
        //                 // You could also store your token in a global object,
        //                 // and reference it here. APP.token
        //                 'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
        //         }
        // },
    ready() {
      console.log('new Vue Event Queue ready');
    }
});
