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
// import moment from 'moment';
// import StoryQueue from './components/StoryQueue.vue';
//
// new Vue({
//     el: '#vue-story-queue',
//     components: {StoryQueue}
// });

import { createApp } from "vue";
import StoryQueue from './components/StoryQueue.vue';
import axios from "axios"

// Remember the token we created in the <head> tags? Get it here.
const CSRFToken = document.querySelector('meta[name="_token"]').getAttribute('content');
axios.defaults.headers.common['X-CSRF-TOKEN'] = CSRFToken

const app = createApp({
    components: { StoryQueue },
})
app.config.globalProperties.$http = axios
app.mount('#vue-story-queue')