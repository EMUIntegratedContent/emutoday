var Vue = require('vue');

import VueResource from 'vue-resource';
Vue.use(VueResource);

// var moment = require('moment');

 import AnnouncementQueue from './components/AnnouncementQueue.vue';


new Vue({
    el: '#vue-announcement-queue',
    components: {
      AnnouncementQueue
    },
        // http: {
        //         headers: {
        //                 // You could also store your token in a global object,
        //                 // and reference it here. APP.token
        //                 'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
        //         }
        // },
    ready() {
      console.log('new Vue Announcement Queue ready');
    }
});
