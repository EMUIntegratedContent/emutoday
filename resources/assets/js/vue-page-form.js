// var Vue = require('vue');
//
// import VueResource from 'vue-resource';
// import Sortable from 'vue-sortable';
// Vue.use(VueResource);
// Vue.use(Sortable)
//
// // Remember the token we created in the <head> tags? Get it here.
// var CSRFToken = document.querySelector('meta[name="_token"]').getAttribute('content');
// Vue.http.headers.common['X-CSRF-TOKEN'] = CSRFToken;
//
// import PageForm from './components/Page/PageForm.vue';
//
// var vm = new Vue({
//     el: '#vue-page',
//     components: {
//         PageForm,
//     }
// });

import { createApp } from "vue"
import PageForm from "./components/Page/PageForm"
import axios from "axios"

// Remember the token we created in the <head> tags? Get it here.
const CSRFToken = document.querySelector('meta[name="_token"]').getAttribute('content');
axios.defaults.headers.common['X-CSRF-TOKEN'] = CSRFToken

const app = createApp({
    components: { PageForm }
})
app.config.globalProperties.$http = axios
app.mount('#vue-page')
