// var Vue = require('vue');
//
// import VueResource from 'vue-resource';
// import draggable from 'vuedraggable'
// Vue.use(VueResource);
// Vue.use(draggable)
//
// // Remember the token we created in the <head> tags? Get it here.
// var CSRFToken = document.querySelector('meta[name="_token"]').getAttribute('content');
// Vue.http.headers.common['X-CSRF-TOKEN'] = CSRFToken;
//
// import MagazineBuilder from './components/Magazine/MagazineBuilder.vue';
// import store from './vuex/store';
//
// var vm = new Vue({
//     el: '#vue-magazine-builder',
//     components: {
//         MagazineBuilder,
//     },
//     store,
//     created() {}
// });

import { createApp } from "vue";
import MagazineBuilder from './components/Magazine/MagazineBuilder.vue'
import store from './vuex/store';
import axios from "axios"

// Remember the token we created in the <head> tags? Get it here.
const CSRFToken = document.querySelector('meta[name="_token"]').getAttribute('content');
axios.defaults.headers.common['X-CSRF-TOKEN'] = CSRFToken

const app = createApp({
    components: { MagazineBuilder },
})
app.use(store)
app.config.globalProperties.$http = axios
app.mount('#vue-magazine-builder')