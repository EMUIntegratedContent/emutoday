// var Vue = require('vue');
//
// import VueResource from 'vue-resource';
// import CKEditor from 'ckeditor4-vue';
//
// Vue.use(VueResource);
// Vue.use( CKEditor );
//
// // Remember the token we created in the <head> tags? Get it here.
// var CSRFToken = document.querySelector('meta[name="_token"]').getAttribute('content');
// Vue.http.headers.common['X-CSRF-TOKEN'] = CSRFToken;
//
// import StoryForm from './components/StoryForm.vue'
// import BoxTools from './components/BoxTools.vue'
// import store from './vuex/store'
//
//
// new Vue({
// 	el: '#vue-story-form-wrapper',
// 	store,
// 	components: {
// 		StoryForm: StoryForm,
// 		BoxTools: BoxTools
// 	},
// });

import { createApp } from "vue"
import StoryForm from './components/StoryForm.vue'
import BoxTools from './components/BoxTools.vue'
import store from './vuex/store'
import axios from "axios"
import CKEditor from '@ckeditor/ckeditor5-vue'

// Remember the token we created in the <head> tags? Get it here.
const CSRFToken = document.querySelector('meta[name="_token"]').getAttribute('content');
axios.defaults.headers.common['X-CSRF-TOKEN'] = CSRFToken

const app = createApp({
	components: {
		StoryForm,
		BoxTools
	},
})
app.use(store)
app.use(CKEditor)
app.config.globalProperties.$http = axios
app.mount('#vue-story-form-wrapper')
