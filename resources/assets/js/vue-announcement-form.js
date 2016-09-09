var Vue = require('vue');

import VueResource from 'vue-resource';
Vue.use(VueResource);

// var moment = require('moment');
import AnnouncementForm from './components/AnnouncementForm.vue';

new Vue({
    el: '#vue-announcements',
    components: {AnnouncementForm},
    ready() {
      console.log('AnnouncementForm ready');
    }
});
