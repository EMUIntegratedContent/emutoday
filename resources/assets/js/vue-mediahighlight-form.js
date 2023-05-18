// var Vue = require('vue');
//
// import VueResource from 'vue-resource';
// Vue.use(VueResource);
//
// // Remember the token we created in the <head> tags? Get it here.
// var CSRFToken = document.querySelector('meta[name="_token"]').getAttribute('content');
// Vue.http.headers.common['X-CSRF-TOKEN'] = CSRFToken;
//
// import MediahighlightForm from './components/MediahighlightForm.vue';
//
// var vm = new Vue({
//     el: '#vue-mediahighlight',
//     components: {MediahighlightForm}
// });


import { createApp } from "vue"
import MediahighlightForm from './components/MediahighlightForm.vue'
import axios from "axios"

// Remember the token we created in the <head> tags? Get it here.
const CSRFToken = document.querySelector('meta[name="_token"]').getAttribute('content');
axios.defaults.headers.common['X-CSRF-TOKEN'] = CSRFToken

const app = createApp({
    components: { MediahighlightForm }
})
app.config.globalProperties.$http = axios
app.mount('#vue-mediahighlight')
