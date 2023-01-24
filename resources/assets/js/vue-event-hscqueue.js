// var Vue = require('vue');
//
// import VueResource from 'vue-resource';
// Vue.use(VueResource);
//
// // Remember the token we created in the <head> tags? Get it here.
// var CSRFToken = document.querySelector('meta[name="_token"]').getAttribute('content');
// Vue.http.headers.common['X-CSRF-TOKEN'] = CSRFToken;
//
// import EventQueue from './components/EventHscQueue.vue'
//
// new Vue({
//     el: '#vue-event-queue',
//     components: {EventQueue}
// });

import { createApp } from "vue";
import EventQueue from "./components/EventHscQueue"
import axios from "axios"

// Remember the token we created in the <head> tags? Get it here.
const CSRFToken = document.querySelector('meta[name="_token"]').getAttribute('content');
axios.defaults.headers.common['X-CSRF-TOKEN'] = CSRFToken

const app = createApp({
    components: { EventQueue }
})
app.config.globalProperties.$http = axios
app.mount('#vue-event-queue')
