var Vue = require('vue');

import VueResource from 'vue-resource';
Vue.use(VueResource);

// var moment = require('moment');
import AnnouncementForm from './components/AnnouncementForm.vue';

new Vue({
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
