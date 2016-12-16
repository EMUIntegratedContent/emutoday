var Vue = require('vue');

import VueResource from 'vue-resource';
Vue.use(VueResource);

// var moment = require('moment');

 import AnnouncementArchiveQueue from './components/AnnouncementArchiveQueue.vue';


new Vue({
    el: '#vue-announcement-archive-queue',
    components: {
      AnnouncementArchiveQueue
    },
        // http: {
        //         headers: {
        //                 // You could also store your token in a global object,
        //                 // and reference it here. APP.token
        //                 'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
        //         }
        // },
    ready() {
      console.log('new Vue Announcement Archive Queue ready');
    }
});
