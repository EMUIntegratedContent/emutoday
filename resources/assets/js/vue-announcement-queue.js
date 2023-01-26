// var Vue = require('vue');
//
// import VueResource from 'vue-resource';
// import Sortable from 'vue-sortable';
// Vue.use(VueResource);
// Vue.use(Sortable);
//
// // Remember the token we created in the <head> tags? Get it here.
// var CSRFToken = document.querySelector('meta[name="_token"]').getAttribute('content');
// Vue.http.headers.common['X-CSRF-TOKEN'] = CSRFToken;
//
// import AnnouncementQueue from './components/AnnouncementQueue.vue';
//
//
// new Vue({
//     el: '#vue-announcement-queue',
//     components: {
//       AnnouncementQueue
//     }
// });

import { createApp } from "vue";
import AnnouncementQueue from './components/AnnouncementQueue.vue';
import axios from "axios"

// Remember the token we created in the <head> tags? Get it here.
const CSRFToken = document.querySelector('meta[name="_token"]').getAttribute('content');
axios.defaults.headers.common['X-CSRF-TOKEN'] = CSRFToken

const app = createApp({
    components: { AnnouncementQueue }
})
app.config.globalProperties.$http = axios
app.mount('#vue-announcement-queue')